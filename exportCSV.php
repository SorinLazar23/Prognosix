<?php

session_start();

$conn = new mysqli("localhost", "root", "","Prognosix");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($result = $conn->query(sprintf('SELECT * FROM grades WHERE discipline_id=%d',$_GET['id']))) {

    if($result->num_rows > 0){

        $header = [];
        $headerCopied = false;
        $output = '';
        $outputArray = [];
        while($row = $result->fetch_assoc()){

            if($result2 = $conn->query(sprintf('SELECT * FROM grade_files WHERE discipline_id=%d', intval($_GET['id'])))){

                if($result2->num_rows > 0){

                    $discipline = $result2->fetch_assoc();

                    $pathinfo = pathinfo($discipline['url']);

                    if($pathinfo['extension'] === 'csv'){

                        $fd = fopen($discipline['url'], 'r');

                        if(!$headerCopied){
                            $output = fgets($fd);
                            $header = explode(',', $output);
                        }

                        foreach($header as $column){
                            $col = rtrim(trim($column), '*');
                            if($col === $row['round']){
                                $outputArray[$row['user_id']][$row['round']] = $row['grade'];
                            }
                        }

                        fclose($fd);
                    } else if($pathinfo['extension'] === 'json'){

                        if(!$headerCopied){
                            $students = json_decode(file_get_contents($discipline['url']), true);

                            $output .= 'nume_prenume';

                            $header[] = 'nume_prenume';

                            foreach ($students as $student){

                                foreach($student['note'] as $key => $proba){

                                    if(!in_array($key, $header)){
                                        $output .= ',' . $proba['denumire'];
                                        $header[] = $key;
                                    }
                                }
                            }

                            $output .= "\r\n";
                        }

                        $outputArray[$row['user_id']][$row['round']] = $row['grade'];
                    } else if($pathinfo['extension'] === 'xml'){
                        if(!$headerCopied){
                            $students = json_decode(json_encode(simplexml_load_file($discipline['url']), true), true);

                            $output .= 'nume_prenume';

                            $header[] = 'nume_prenume';

                            foreach ($students as $student){

                                foreach($student['note'] as $key => $proba){

                                    if(!in_array($key, $header)){
                                        $output .= ',' . $proba['denumire'];
                                        $header[] = $key;
                                    }
                                }
                            }

                            $output .= "\r\n";
                        }

                        $outputArray[$row['user_id']][$row['round']] = $row['grade'];
                    }
                }
            }

            $headerCopied = true;
        }

        if($result3 = $conn->query(sprintf('SELECT * FROM disciplines where id = %d', intval($_GET['id'])))){

            if($result3->num_rows > 0){

                $discipline = $result3->fetch_assoc();

                array_shift($header);

                foreach($outputArray as $userId => $grades){
                    if($result4 = $conn->query(sprintf('SELECT * FROM users where id = %d', intval($userId)))){

                        if($result4->num_rows > 0) {

                            $user = $result4->fetch_assoc();

                            $output .= $user['name'];

                            foreach($header as $column){
                                $column = rtrim(trim($column), '*');
                                $output .= !empty($grades[$column]) ? ',' . $grades[$column] : ',-';
                            }

                            $output .= "\r\n";
                        }
                    }
                }

                $disciplineName = str_replace(' ', '_', $discipline['name']);
                header('Content-Type:  text/csv');
                header('Content-Disposition: attachment; filename=Note_' . $disciplineName . '.csv');
                header('Content-Length: ' . sizeof($output));

                echo $output;

                $conn->close();
                exit;
            }
        }
    }
}