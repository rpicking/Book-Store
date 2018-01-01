<?php
	session_start();
	 // Include database stuff
	include("common.php");
	db_open();  
	$con = $link;
	
	$username = $_SESSION['loggedIn'];
	$userInfo_query = "Select * from customer where username = '$username'";
	$userInfo_results = mysqli_query($con, $userInfo_query);
	$userInfo = mysqli_fetch_array($userInfo_results);

?>
<head>
<title>UPDATE CUSTOMER PROFILE - 3-B.com</title>
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script>
	$(document).ready(function() {  
  
        
        //when button is clicked  
        $('#update_submit').click(function(){   
                update();    
        });  
  
  });  
  
	//function to check updates user with validation  
	function update(){  
	  
			//get the info  
			var username = $('#username').val();  
			var pin = $('#pin').val();
			var rpin = $('#retype_pin').val();
			var fname = $('#firstname').val();
			var lname = $('#lastname').val();
			var address = $('#address').val();
			var city = $('#city').val();
			var state = $('#state').val();
			var zip = $('#zip').val();
			var card = $('#credit_card').val();
			var card_num = $('#card_number').val();
			var expiration = $('#expiration').val();
			//use ajax to run the check  
			$.post("customer_update.php", { 
				username: username, 
				pin: pin, 
				rpin: rpin, 
				fname: fname, 
				lname: lname, 
				address: address, 
				city: city, 
				state: state, 
				zip: zip, 
				creditCard: card, 
				card_num: card_num, 
				expiration: expiration
			},  
				function(result){ 
					if (result == 1)
					{
						window.location.href = "confirm_order.php";
					}
					else if (result == 2)
					{
						$('#error_message').html('please enter new pins')
					}
					else if (result == 3)
					{
						$('#error_message').html('pins do not match')
					}

			});  
	} 
</script>
</head>
<body>
    <h2 align="center">Update Customer Profile</h2>
	<table align="center" style="border:2px solid blue;">
		<tr>
		<form id="register" action="" method="post">
			<td align="right">
				Username:
			</td>
			<td align="left" colspan="3">
				<?php
					if ($username == "")
						echo "<p>user not logged in</p>";
					else
						echo "<p>".$username."</p>";
				?>
				<input type = "hidden" id = "username" value="<?php echo $userInfo['username'];?>">
			</td>
		</tr>
		<tr>
			<td align="right">
				New PIN:
			</td>
			<td align="left">
				<input type="password" id="pin" name="pin" value="<?php echo $userInfo['pin'];?>">
			</td>
			<td align="right">
				Re-type New PIN:
			</td>
			<td align="left">
				<input type="password" id="retype_pin" name="retype_pin" value="<?php echo $userInfo['pin'];?>">
			</td>
		</tr>
		<tr>
			<td align="right">
				Firstname:
			</td>
			<td align="left">
				<input type="text" id="firstname" name="firstname" value="<?php echo $userInfo['fname'];?>">
			</td>
			<td align = "left">
				<div style = "color: red" id = "error_message"></div>
			</td>
		</tr>
		<tr>
			<td align="right">
				Lastname:
			</td>
			<td colspan="3" align="left">
				<input type="text" id="lastname" name="lastname" value="<?php echo $userInfo['lname'];?>">
			</td>
		</tr>
		<tr>
			<td align="right">
				Address:
			</td>
			<td colspan="3" align="left">
				<input type="text" id="address" value="<?php echo $userInfo['street'];?>">
			</td>
		</tr>
		<tr>
			<td align="right">
				City:
			</td>
			<td colspan="3" align="left">
				<input type="text" id="city" name="city" value="<?php echo $userInfo['city'];?>">
			</td>
		</tr>
		<tr>
			<td align="right">
				State:
			</td>
			<td align="left">
				<select id="state" name="state" value="<?php echo $userInfo['state'];?>">
				<option selected disabled>select a state</option>
				<option>Michigan</option>
				<option>California</option>
				<option>Tennessee</option>
				</select>
			</td>
		</tr>
		<tr>
			<td align="right">
				Zip:
			</td>
			<td align="left">
				<input type="text" id="zip" name="zip" value="<?php echo $userInfo['zip'];?>">
			</td>
		</tr>
		<tr>
			<td align="right">
				Credit Card
			</td>
			<td align="left">
				<select id="credit_card" name="credit_card" value="<?php echo $userInfo['card_type'];?>">
				<option selected disabled>select a card type</option>
				<option>VISA</option>
				<option>MASTER</option>
				<option>DISCOVER</option>
				</select>
			</td>
			<td colspan="2" align="left">
				<input type="text" id="card_number" name="card_number"  value="<?php echo $userInfo['card_num'];?>">
			</td>
		</tr>
		<tr>
			<td  align="right">
				Expiration Date:
			</td>
			<td align="left">
				<input type="text" id="expiration" name="expiration" value="<?php echo $userInfo['exp_date'];?>">
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center"> 
				<input type="button" id="update_submit" name="update_submit" value="Update">
			</td>
		</form>
			<form id="no_registration" action="confirm_order.php" method="post">
			<td colspan="2" align="center">
				<input type="submit" id="cancel" name="cancel" value="Cancel">
			</td>
			</form>
		</tr>
	</table>
</body>
</HTML>