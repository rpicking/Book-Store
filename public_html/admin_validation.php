<?php
	session_start();
	include("common.php");
	db_open();
  
	$con = $link;
	$username = $_POST['username'];
	$pin = $_POST['pin'];
	
	if ($username == "" || $pin == "")
	{
		echo 3;
	}
	else if ($pin != "password")
	{
		echo 0;
	}
	else if ($username == "admin" && $pin == "password")
	{
		$_SESSION["loggedIn"] = $username;
		echo 1;
	}
	
	else
	{
		echo 2;
	}
?>