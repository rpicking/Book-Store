
<head>
<title>Admin Login</title>
</head>
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script>
	$(document).ready(function() {  
  
        
        //when button is clicked  
        $('#login').click(function(){          
                //else show the cheking_text and run the function to check  
                validate();    
        });  
  
  });  
  
	//function to check username availability  
	function validate(){  
	  
			//get the username  
			var username = $('#username').val();  
			var pin = $('#pin').val();
			//use ajax to run the check  
			$.post("admin_validation.php", { 
				username: username, 
				pin: pin 
			},  
				function(result){ 
					if (result == 0)
					{
						$('#error_message').html('incorrect password')
					}
					else if (result == 1)
					{
						window.location.href = "admin.php";
					}
					else if (result == 2)
					{
						$('#error_message').html('user not found');
					}
					else if (result == 3)
					{
						$('#error_message').html('please enter username and password');
					}
			});  
	} 
</script>
<body>
	<table align="center" style="border:2px solid blue;">
		<form action="" method="post" id="login_screen">
		<tr>
			<td align="right">
				Admin Name<span style="color:red">*</span>:
			</td>
			<td align="left">
				<input type="text" name="username" id="username">
			</td>
			<form action="" method="post">
			<td align="right">
				<input type="button" name="login" id="login" value="Login">
			</td>
			</form>
		</tr>
		<tr>
			<td align="right">
				PIN<span style="color:red">*</span>:
			</td>
			<td align="left">
				<input type="password" name="pin" id="pin">
			</td>
		</form>
			<td align="right">
				<input type="submit" name="cancel" id="cancel" value="Cancel">
			</td>
		</tr>
		<tr>
			<td align = "left">	
				<div  style = "color: red;" id = "error_message"></div>
			</td>
		</tr>
	</table>
</body>
</html>

