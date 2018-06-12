<?php


if(!isset($_POST['login']))
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
	if(!isset($_POST["e-mail"])){
		return false;
	}


	if(!isset($_POST["parola"])){
		return false;
	}


	return true;

}


function LoadFromDatabase(){

	$conn = new mysqli("localhost", "root", "","Prognosix");

	if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);
	}

	if ($result = $conn->query(sprintf('SELECT * from  users where email="%s" and password="%s" ',$_POST["e-mail"],md5($_POST["parola"])))) {
        if ($result->num_rows > 0) {
            if($row = $result->fetch_assoc()) {
                session_start();
                // salvez in sesiune user-ul care s-a logat
                $_SESSION['user'] = $row;
                header ("Location:indexFinal.php");
            }
        }
	}

    $conn->close();
}

