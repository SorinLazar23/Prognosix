<?php

session_start();

if(!isset($_POST['upload']))
{
    return false;
}

if(!ValidateLoginSubmission())
{
    return false;
}

if(!SaveToDatabase())
{
    return false;
}

function ValidateLoginSubmission(){
    if(!isset($_POST["disciplina"])){
        return false;
    }


    if(!isset($_FILES["fisier_note"])){
        return false;
    }

    return true;
}

function SaveToDatabase(){

    $conn = new mysqli("localhost", "root", "","Prognosix");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $path = str_replace('\\', '/', dirname(__FILE__)) . '/uploads/' . time() . '_' . $_FILES['fisier_note']['name'];
    if(move_uploaded_file($_FILES['fisier_note']['tmp_name'], $path)){

        if ($conn->query(sprintf('INSERT INTO grade_files (user_id, discipline_id, url) VALUES (%d, %d, "%s")',intval($_SESSION["user"]["id"]),intval($_POST["disciplina"]),$path))) {

            if ($result = $conn->query(sprintf('SELECT * FROM grade_files WHERE id=%d',intval($conn->insert_id)))) {

                if($result->num_rows > 0){

                    $discipline = $result->fetch_assoc();

                    $feed = simplexml_load_file('feed.xml');

                    /*$item = '<item2>';
                    $item .= '<title>Tocmai s-au uploadat notele pentru obiectul' . $discipline['name'] . '</title>';
                    $item .= '<description>A fost uploadat fiserul cu note pentru materia '. $discipline['name'] . '. Fiecare student care are aceasta materie poate acum sa isi "ghiceasca nota" accesand acest <a href="http://localhost/Prognosix/indexFinal.php">link</a></description>';
                    $item .= '<link>http://localhost/Prognosix/indexFinal.php</link>';
                    $item .= '<pubDate>' . date("D, d M Y H:i:s O", time()) .'</pubDate>';
                    $item .= '</item2>';*/

                    // $item = new SimpleXMLElement('<item><title>Tocmai s-au uploadat notele pentru obiectul' . $discipline['name'] . '</title></item>');
                    /*$item->addChild('title', 'Tocmai s-au uploadat notele pentru obiectul' . $discipline['name']);
                    $item->addChild('description', 'A fost uploadat fiserul cu note pentru materia '. $discipline['name'] . '. Fiecare student care are aceasta materie poate acum sa isi "ghiceasca nota" accesand acest <a href="http://localhost/Prognosix/indexFinal.php">link</a>');
                    $item->addChild('link', 'http://localhost/Prognosix/indexFinal.php');
                    $item->addChild('pubDate', date("D, d M Y H:i:s O", time()));*/

                    $item = $feed->channel->addChild('item');
                    $item->addChild('title', 'Tocmai s-au uploadat notele pentru obiectul' . $discipline['name']);
                    $item->addChild('description', 'A fost uploadat fiserul cu note pentru materia '. $discipline['name'] . '. Fiecare student care are aceasta materie poate acum sa isi "ghiceasca nota" accesand acest <a href="http://localhost/Prognosix/indexFinal.php">link</a>');
                    $item->addChild('link', 'http://localhost/Prognosix/indexFinal.php');
                    $item->addChild('pubDate', date("D, d M Y H:i:s O", time()));

                    $feed->saveXML('feed.xml');

                    header ("Location:indexFinal.php");
                }
            }
        }
    }

    $conn->close();
}