<?php 

ob_start();
session_start();    // allow storing and retrieving data across different pages

$_SESSION['id']     	= null;
$_SESSION['role']     	= null;


header("Location: index.php");

 ?>