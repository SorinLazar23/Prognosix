<?php

session_start();

require 'fpdf/fpdf.php';

$pdf = new FPDF('L','mm','A4');
$pdf->AddPage();
$pdf->SetFont('Arial','',10);

$conn = new mysqli("localhost", "root", "","Prognosix");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($result = $conn->query(sprintf('SELECT * FROM grades WHERE discipline_id=%d',$_GET['id']))) {

    if($result->num_rows > 0){

        $header = [];
        $headerCount = 0;
        $headerCopied = false;
        $output = '';
        $outputArray = [];
        while($row = $result->fetch_assoc()) {

            if($result2 = $conn->query(sprintf('SELECT * FROM grade_files WHERE discipline_id=%d', intval($_GET['id'])))) {

                if ($result2->num_rows > 0) {

                    $discipline = $result2->fetch_assoc();

                    $pathinfo = pathinfo($discipline['url']);

                    if ($pathinfo['extension'] === 'csv') {

                        $fd = fopen($discipline['url'], 'r');

                        if(!$headerCopied){
                            $header = fgets($fd);
                            $header = explode(',', $header);
                            $headerCount = count($header);

                            foreach($header as $column){
                                $id = rtrim(trim($column), '*');
                                $pdf->Cell(277/$headerCount,10, $id, 1);
                            }
                            $pdf->Ln(10);
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

                            $header[] = ['nume_prenume'];

                            foreach($students as $student){
                                foreach($student['note'] as $key => $proba){
                                    if(!in_array($key, $header)) {
                                        $header[] = $key;
                                    }
                                }
                            }

                            $headerCount = count($header);
                            $header = ['nume_prenume'];

                            $pdf->Cell(277/$headerCount,10, 'nume_prenume', 1);

                            foreach ($students as $student){

                                foreach($student['note'] as $key => $proba){

                                    if(!in_array($key, $header)){
                                        $pdf->Cell(277/$headerCount,10, $proba['denumire'], 1);
                                        $header[] = $key;
                                    }
                                }
                            }

                            $pdf->Ln(10);
                        }

                        $outputArray[$row['user_id']][$row['round']] = $row['grade'];
                    } else if($pathinfo['extension'] === 'xml'){
                        if(!$headerCopied){
                            $students = json_decode(json_encode(simplexml_load_file($discipline['url']), true), true);

                            $header = ['nume_prenume'];

                            foreach($students as $student){
                                foreach($student['note'] as $key => $proba){
                                    if(!in_array($key, $header)) {
                                        $header[] = $key;
                                    }
                                }
                            }

                            $headerCount = count($header);
                            $header = ['nume_prenume'];

                            $pdf->Cell(277/$headerCount,10, 'nume_prenume', 1);

                            foreach ($students as $student){

                                foreach($student['note'] as $key => $proba){

                                    if(!in_array($key, $header)){
                                        $pdf->Cell(277/$headerCount,10, $proba['denumire'], 1);
                                        $header[] = $key;
                                    }
                                }
                            }

                            $pdf->Ln(10);
                        }

                        $outputArray[$row['user_id']][$row['round']] = $row['grade'];
                    }
                }
            }

            $headerCopied = true;
        }

        if($result3 = $conn->query(sprintf('SELECT * FROM disciplines where id = %d', intval($_GET['id'])))){

            if($result3->num_rows > 0) {

                $discipline = $result3->fetch_assoc();

                array_shift($header);

                foreach($outputArray as $userId => $grades) {
                    if ($result4 = $conn->query(sprintf('SELECT * FROM users where id = %d', intval($userId)))) {

                        if ($result4->num_rows > 0) {

                            $user = $result4->fetch_assoc();

                            $pdf->Cell(277/$headerCount,10, $user['name'], 1);

                            foreach($header as $column){
                                $column = rtrim(trim($column), '*');
                                $grade = !empty($grades[$column]) ? $grades[$column] : ',-';
                                $pdf->Cell(277/$headerCount,10, $grade, 1);
                            }

                            $pdf->Ln();
                        }
                    }
                }
            }
        }
    }
}

$pdf->Output();