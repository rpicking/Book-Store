<?php
	session_start();
 // Include database stuff
	include("common.php");
	db_open();  
	$con = $link;
	
	$username = $_POST['username'];
	$pin = $_POST["pin"];
	$rpin = $_POST["rpin"];
	$fname = $_POST["fname"];
	$lname = $_POST["lname"];
	$street = $_POST["address"];
	$city = $_POST["city"];
	$state = $_POST["state"];
	$zip = $_POST["zip"];
	$creditCard = $_POST["creditCard"];
	$card_number = $_POST["card_num"];
	$expiration = $_POST["expiration"];
	$userUpdate_query = "UPDATE customer
						SET pin = '$pin', 
							fname = '$fname', 
							lname = '$lname', 
							street = '$street', 
							city = '$city', 
							state = '$state', 
							zip = $zip, 
							card_type = '$creditCard', 
							card_num = '$card_number', 
							exp_date = '$expiration'
						WHERE username = '$username'";
			
	$user_query = "Select pin from customer where username = '$username'";
	$query_results = mysqli_query($con, $user_query);
	$db_pin = mysqli_fetch_array($query_results);

	if ($pin == ""  || $rpin == "")
	{	
		echo 2;
	}
	else if ($pin != $rpin)
	{
		echo 3;
	}
	else
	{
		mysqli_query($con, $userUpdate_query);
		echo 1;
	} 

?>