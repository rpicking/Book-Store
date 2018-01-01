<?php
  // Turn on the Session for this page
  session_start();
	//
  // Include database stuff
  include("common.php");
  db_open();
  
  $con = $link;
  

  
?>
<head>
<title> CUSTOMER REGISTRATION </title>
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script>
	function cancel() {
		if (document.referrer.includes("confirm_order.php"))
			window.location.href = "message.php";
		else 
			window.location.href = "index.php";
	}
	
	$(document).ready(function() {  
  
        //the min chars for username  
        var min_chars = 3;  
  
        //result texts  
        var characters_error = 'Minimum amount of chars is 3';  
        var checking_html = 'Checking...';  
  
        //when button is clicked  
        $('#register_submit').click(function(){          
                
                check_availability();    
        });  
  
  });  
  
	//function to check username availability  
	function check_availability(){  
	  
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
			$.post("register_customer.php", { 
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
					if (result == 0)
					{
						$('#pin_mismatch').html('Please enter pins');
					}
					else if (result == 1)
					{
						$('#pin_mismatch').html('Pins do not match');
					}
					if(result == 3){  
						//show that the username is NOT available  
						$('#username_availability_result').html(username + ' is not Available');  
					}
					else if (result == 2)
					{

						if (document.referrer.includes("shopping_cart.php"))
							window.location.href = "confirm_order.php";
						else 
							window.location.href = "index.php";
					}
			});  
	  
	} 
	
</script>
</head>
<body>
	<table align="center" style="border:2px solid blue;">
		<tr>
			<form id="register" action="" method="post">
			<td align="right">
				Username<span style="color:red">*</span>:
			</td>
			<td align="left">
				<input type="text" id="username" name="username" placeholder="Enter your username" required>  
			</td>
			<td align = "right">
				<div style = "color: red" id = "username_availability_result"></div>
			</td>
			
		<tr>
		<tr>
			<td align="right">
				PIN<span style="color:red">*</span>:
			</td>
			<td align="left">
				<input type="password" id="pin" name="pin" required>
			</td>
			<td align="right">
				Re-type PIN<span style="color:red">*</span>:
			</td>
			<td align="left">
				<input type="password" id="retype_pin" name="retype_pin" required>
			</td>
		</tr>
		<tr>
			<td align="right">
				Firstname<span style="color:red">*</span>:
			</td>
			<td  align = "left">
				<input type="text" id="firstname" name="firstname" placeholder="Enter your firstname">
			</td>
			<td align = "left">
				<div style = "color: red" id = "pin_mismatch"></div>
			</td>
		</tr>
		<tr>
			<td align="right">
				Lastname<span style="color:red">*</span>:
			</td>
			<td colspan="3" align="left">
				<input type="text" id="lastname" name="lastname" placeholder="Enter your lastname">
			</td>
		</tr>
		<tr>
			<td align="right">
				Address<span style="color:red">*</span>:
			</td>
			<td colspan="3" align="left">
				<input type="text" id="address" name="address">
			</td>
		</tr>
		<tr>
			<td align="right">
				City<span style="color:red">*</span>:
			</td>
			<td colspan="3" align="left">
				<input type="text" id="city" name="city">
			</td>
		</tr>
		<tr>
			<td align="right">
				State<span style="color:red">*</span>:
			</td>
			<td align="left">
				<select id="state" name="state">
				<option selected disabled>select a state</option>
				<option>MI</option>
				<option>CO</option>
				<option>FL</option>
				</select>
			</td>
		</tr>
		<tr>
			<td align="right">
				Zip<span style="color:red">*</span>:
			</td>
			<td align="left">
				<input type="number" id="zip" name="zip">
			</td>
		</tr>
		<tr>
			<td align="right">
				Credit Card<span style="color:red">*</span>
			</td>
			<td align="left">
				<select id="credit_card" name="credit_card">
				<option selected disabled>select a card type</option>
				<option>VISA</option>
				<option>MASTER</option>
				<option>DISCOVER</option>
				</select>
			</td>
			<td colspan="2" align="left">
				<input type="text" id="card_number" name="card_number" placeholder="Credit card number">
			</td>
		</tr>
		<tr>
			<td  align="right">
					Expiration Date<span style="color:red">*</span>:
				</td>
				<td  align="left">
					<input type="text" id="expiration" name="expiration" placeholder="MM/YY">
				</td>
			</tr>
		<tr>
			<form action = "" method = "post" onsubmit = "">
			 <td colspan="2" align="center"> 
				<input type="button" id="register_submit" name="register_submit" value="Register">
			</td>
			</form>
			</form>
			<td colspan="2" align="center">
				<button id="donotregister" name="donotregister" onClick = "cancel()">Don't Register</button>
			</td>
		</tr>
	</table>
</body>
</HTML>