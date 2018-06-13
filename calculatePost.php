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

                            if ($conn->query(sprintf('INSERT INTO grades (user_id,discipline_id,round,grade) VALUES(%d,%d,"%s",%f)', intval($_SESSION['user']['id']), intval($row['discipline_id']),$_POST['runda'], $nota + floatval($row['punctaj_p'])))) {
                                header('Location: indexFinal.php');
                            }
                        } else {

                            if ($conn->query(sprintf('INSERT INTO grades (user_id,discipline_id,round,grade) VALUES(%d,%d,"%s",%f)', intval($_SESSION['user']['id']), intval($row['discipline_id']),$_POST['runda'], $nota - floatval($row['punctaj_m'])))) {
                                header('Location: indexFinal.php');
                            }
                        }
                    }
                }else if($pathinfo['extension'] === 'json'){

                    $students = json_decode(file_get_contents($row['url']), true);

                    foreach($students as $student){
                        if($student['nume_prenume'] === $_SESSION['user']['name']){
                            foreach($student['note'] as $key => $proba){
                                if($key === $_POST['runda']){
                                    $nota = $proba['nota'];
                                    break;
                                }
                            }
                        }
                    }

                    if (!empty($nota) && $nota == $_POST['nota']) {

                        if ($conn->query(sprintf('INSERT INTO grades (user_id,discipline_id,round,grade) VALUES(%d,%d,"%s",%f)', intval($_SESSION['user']['id']), intval($row['discipline_id']),$_POST['runda'], $nota + floatval($row['punctaj_p'])))) {
                            header('Location: indexFinal.php');
                        }
                    } else {

                        if ($conn->query(sprintf('INSERT INTO grades (user_id,discipline_id,round,grade) VALUES(%d,%d,"%s",%f)', intval($_SESSION['user']['id']), intval($row['discipline_id']),$_POST['runda'], $nota - floatval($row['punctaj_m'])))) {
                            header('Location: indexFinal.php');
                        }
                    }
                }else if($pathinfo['extension'] === 'xml'){

                    $students = json_decode(json_encode(simplexml_load_file($row['url'])), true);

                    foreach($students as $student){
                        if($student['nume_prenume'] === $_SESSION['user']['name']){
                            foreach($student['note'] as $key => $proba){
                                if($key === $_POST['runda']){
                                    $nota = $proba['nota'];
                                    break;
                                }
                            }
                        }
                    }

                    if (!empty($nota) && $nota == $_POST['nota']) {

                        if ($conn->query(sprintf('INSERT INTO grades (user_id,discipline_id,round,grade) VALUES(%d,%d,"%s",%f)', intval($_SESSION['user']['id']), intval($row['discipline_id']),$_POST['runda'], $nota + floatval($row['punctaj_p'])))) {
                            header('Location: indexFinal.php');
                        }
                    } else {

                        if ($conn->query(sprintf('INSERT INTO grades (user_id,discipline_id,round,grade) VALUES(%d,%d,"%s",%f)', intval($_SESSION['user']['id']), intval($row['discipline_id']),$_POST['runda'], $nota - floatval($row['punctaj_m'])))) {
                            header('Location: indexFinal.php');
                        }
                    }
                }
            }
        }
    }

    $conn->close();
}