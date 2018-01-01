<?php  
		session_start();
		include("common.php");
		db_open();
		$con = $link;
		
		$username = $_POST['username'];
		$pin = $_POST["pin"];
		$rpin = $_POST["rpin"];
		$fname = $_POST["fname"];
		$lname = $_POST["lname"];
		$address = $_POST["address"];
		$city = $_POST["city"];
		$state = $_POST["state"];
		$zip = $_POST["zip"];
		$card = $_POST["creditCard"];
		$card_num = $_POST["card_num"];
		$expiration = $_POST["expiration"];
		
		if ($zip == "")
		{
			$createUser_query = "INSERT INTO customer(username, pin, fname, lname, street, city, state, card_type, card_num, exp_date)";
			$createUser_query = $createUser_query . "VALUES ('$username', '$pin', '$fname', '$lname', '$street', '$city', '$state', '$credit_card', '$card_number', '$expiration');";
		}
		else {
		$newzip = (int)$zip;
   	 	// Generate the SQL statement for creating user.
   		$createUser_query = "INSERT INTO customer(username, pin, fname, lname, street, city, state, zip, card_type, card_num, exp_date)
        	   VALUES ('$username', '$pin', '$fname', '$lname', '$street', '$city', '$state', ".$newzip.", '$credit_card', '$card_number', '$expiration');"; 
    	}
    	//$createUser_query = "insert into customer(username) values('username')";
    	$checker_query = "Select username from customer where username = '$username'";
		$results = mysqli_query($con, $checker_query);
		$r = mysqli_num_rows($results);
		
    	// Run the query, if it doesn't return ANYTHING than user doesn't already exist.

		if ($pin == "" || $rpin == "")
		{
			echo 0;
		}
		else if ($pin != $rpin)
		{
			echo 1;
		}
		else if ($r == 0) {
			mysqli_query($con, $createUser_query);
			$_SESSION['loggedIn'] = $username;
			echo 2;
    	}
    	else if ($r != 0)
    	{
    		echo 3;
    	}	
	    	

?>  
  
  
  
  
  
  