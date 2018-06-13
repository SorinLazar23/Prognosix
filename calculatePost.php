<?php

session_start();

if(!isset($_POST['calculare']))
{
    return false;
}

if(!ValidateLoginSubmission())
{
    return false;
}

if(!LoadFromDatabase())
{
    return false;
}

return true;

function ValidateLoginSubmission(){
    if(!isset($_POST["grade_file_id"])){
        return false;
    }

    if(!isset($_POST["runda"])){
        return false;
    }

    if(!isset($_POST["nota"])){
        return false;
    }

    return true;
}

function LoadFromDatabase(){

    $conn = new mysqli("localhost", "root", "","Prognosix");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($result = $conn->query(sprintf('SELECT * from  grade_files WHERE id=%d', intval($_POST["grade_file_id"])))) {
        if ($result->num_rows > 0) {
            if($row = $result->fetch_assoc()) {

                $pathinfo = pathinfo($row['url']);

                $id = '';
                $name = '';
                if($pathinfo['extension'] === 'csv'){
                    $fd = fopen($row['url'], 'r');
                    $header = fgets($fd);
                    $header = explode(',', $header);
                    $id = '';
                    foreach($header as $key => &$column){
                        $column = rtrim(trim($column), '*');
                        if($column === $_POST['runda']){
                            $id = $key;
                            break;
                        }
                    }

                    if(!empty($id)) {
                        while ($row2 = fgets($fd)) {
                            $row2 = explode(',', $row2);
                            if ($row2[0] === $_SESSION['user']['name']) {
                                $nota = floatval($row2[$id]);
                                break;
                            }
                        }

                        if (!empty($nota) && $nota == $_POST['nota']) {

                            if ($conn->query(sprintf('INSERT INTO grades (user_id,discipline_id,round,grade) VALUES(%d,%d,"%s",%d)', intval($_SESSION['user']['id']), intval($row['discipline_id']),$_POST['runda'], $nota + floatval($row['punctaj_p'])))) {
                                header('Location: notaIsOk.php');
                            }
                        } else {

                            if ($conn->query(sprintf("INSERT INTO grades (user_id,discipline_id,round,grade) VALUES(%d,%d,%s,%d)", intval($_SESSION['user']['id']), intval($row['discipline_id']),$_POST['runda'], $nota - floatval($row['punctaj_m'])))) {
                                header('Location: notaIsNotOk.php');
                            }
                        }
                    }
                }
            }
        }
    }

    $conn->close();
}