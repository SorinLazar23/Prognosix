<?php


if(!isset($_POST['inregistrare']))
{
   return false;
}

$formvars = array();

if(!ValidateRegistrationSubmission())
{
    return false;
}

if(!SaveToDatabase($formvars))
{
    return false;
}

return true;

function ValidateRegistrationSubmission(){
	if(!isset($_POST["e-mail"])){
		return false;
	}

	if(!isset($_POST["nume"])){
		return false;
	}

	if(!isset($_POST["prenume"])){
		return false;
	}

	if(!isset($_POST["parola"])){
		return false;
	}


	return true;

}


function SaveToDatabase($formvars){

	$conn = new mysqli("localhost", "root", "","Prognosix");

	if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);
	} 

	if ($conn->query(sprintf('INSERT INTO users(name, password, email, type) 
		values ("%s","%s","%s",%d)',$_POST["nume"]." ".$_POST["prenume"],md5($_POST["parola"]),$_POST["e-mail"],1)) === TRUE) {
	}

	// preiau id-ul user-ului inserat mai sus.
	if($result = $conn->query(sprintf('SELECT * FROM users WHERE id = %d', $conn->insert_id))){
        if($result->num_rows > 0){
            if($row = $result->fetch_assoc()) {
                session_start();
                // salvez in sesiune user-ul care s-a inregistrat
                $_SESSION['user'] = $row;
                header ("Location:indexFinal.php");
            }
        }
    }

    $conn->close();
}

