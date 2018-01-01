<?php
	session_start();
	include("common.php");
	db_open();
  
	$con = $link;
	$username = $_POST['username'];
	$pin = $_POST['pin'];
	$user_query = "Select pin from customer where username = '$username'";
	$query_results = mysqli_query($con, $user_query);
	$db_pin = mysqli_fetch_array($query_results);
	
	if ($username == "" || $pin == "")
	{
		echo 3;
	}
	else if ($db_pin[0] != $pin)
	{
		echo 0;
	}
	else if ($db_pin[0] == $pin)
	{
		$_SESSION["loggedIn"] = $username;
		echo 1;
	}
	else
	{
		echo 2;
	}
?>