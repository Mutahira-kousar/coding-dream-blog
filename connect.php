<?php 


session_start();
ob_start();


$server 	= 'localhost';
$root 		= 'root';
$pass 		= '';
$dbname 	= 'mydreamblog'; 

$db = new mysqli($server, $root, $pass, $dbname);


if($db->connect_error){

	echo $db->connect_error;
	
}


if(isset($_SESSION['id']) && isset($_SESSION['role'])){

$logid    			= $_SESSION['id'];
$logrole    		= $_SESSION['role'];

}


?>