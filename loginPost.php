<?php


if(!isset($_POST['login']))
{
   return false;
}

$formvars = array();

if(!ValidateLoginSubmission())
{
    return false;
}

if(!SaveToDatabase($formvars))
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


function SaveToDatabase($formvars){

	$conn = new mysqli("localhost", "root", "","Prognosix");

	if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);
	} 

	if ($result=$conn->query(sprintf("SELECT * from  users where email='%s' and password='%s' ",$_POST["e-mail"],md5($_POST["parola"])) ) === TRUE) {
    	
	}




if ($result->num_rows > 0) {
    // output data of each row
    if($row = $result->fetch_assoc()) {
    	session_start();
        
    }
} 

header ("Location:indexFinal.html");

}

