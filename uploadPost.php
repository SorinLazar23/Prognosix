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

            header ("Location:indexFinal.php");
        }
    }

    $conn->close();
}