<?php  

function create_customer($con){
		
		
		$username = $_POST["username"];
    	$pin = $_POST["pin"];
    	$rpin = $_POST["retype_pin"];
    	$fname = $_POST["firstname"];
    	$lname = $_POST["lastname"];
    	$street = $_POST["address"];
    	$city = $_POST["city"];
    	$state = $_POST["state"];
    	$zip = $_POST["zip"];
    	$creditCard = $_POST["credit_card"];
    	$card_number = $_POST["card_number"];
    	$expiration = $_POST["expiration"];

   	 	// Generate the SQL statement for creating user.
   		$createUser_query = "INSERT INTO customer(username, pin, fname, lname, street, city, state_name, zip)
        	   VALUES ('$username', '$pin', '$fname', '$lname', '$street', '$city', '$state', '$zip')";
   		 // Generate the SQL statement for creating card with user.  
    	$createCard_query = "INSERT INTO creditcard(card_type, card_no, exp_date, username)
    			VALUES ('$creditCard', '$card_number', '$expiration', '$username')";
    	$checker_query = "Select username from customer where username = '$username'";
		$results = mysqli_query($con, $checker_query);
		$r = mysqli_num_rows($results);
		
    	// Run the query, if it doesn't return ANYTHING than user doesn't already exist.
    	if ($r == 0) {
    	$_SESSION["alreadyExists"] = false;
    	$_SESSION["noUsername"] = false;
		mysqli_query($con, $createUser_query); 
    	mysqli_query($con, $createCard_query);
    	}
    	else if (empty($username))
    	{
    		$_SESSION["noUsername"] = true;
    		$_SESSION["alreadyExists"] = false;
    		header('Location: customer_registration.php');
    	}
    	else if ($r != 0)
    	{
    		$_SESSION["alreadyExists"] = true;
    		$_SESSION["noUsername"] = false;
    		header('Location: customer_registration.php');
    	}	
    	
  }
?>  
  
  
  
  
  
  