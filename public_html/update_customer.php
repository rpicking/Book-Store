
<!-- UI: Prithviraj Narahari, php code: Alexander Martens -->
<head>
<title>UPDATE CUSTOMER PROFILE - 3-B.com</title>
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
				Username here
			</td>
		</tr>
		<tr>
			<td align="right">
				New PIN:
			</td>
			<td align="left">
				<input type="password" id="pin" name="pin">
			</td>
			<td align="right">
				Re-type New PIN:
			</td>
			<td align="left">
				<input type="password" id="retype_pin" name="retype_pin">
			</td>
		</tr>
		<tr>
			<td align="right">
				Firstname:
			</td>
			<td colspan="3" align="left">
				<input type="text" id="firstname" name="firstname" placeholder="Enter your firstname">
			</td>
		</tr>
		<tr>
			<td align="right">
				Lastname:
			</td>
			<td colspan="3" align="left">
				<input type="text" id="lastname" name="lastname" placeholder="Enter your lastname">
			</td>
		</tr>
		<tr>
			<td align="right">
				Address:
			</td>
			<td colspan="3" align="left">
				<input type="text" id="address" name="address">
			</td>
		</tr>
		<tr>
			<td align="right">
				City:
			</td>
			<td colspan="3" align="left">
				<input type="text" id="city" name="city">
			</td>
		</tr>
		<tr>
			<td align="right">
				State:
			</td>
			<td align="left">
				<select id="state" name="state">
				<option selected disabled>select a state</option>
				<option>Michigan</option>
				<option>California</option>
				<option>Tennessee</option>
				</select>
			</td>
			<td align="right">
				Zip:
			</td>
			<td align="left">
				<input type="text" id="zip" name="zip">
			</td>
		</tr>
		<tr>
			<td align="right">
				Credit Card
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
			<td colspan="2" align="right">
				Expiration Date:
			</td>
			<td colspan="2" align="left">
				<input type="text" id="expiration" name="expiration" placeholder="MM/YY">
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center"> 
				<input type="submit" id="update_submit" name="update_submit" value="Update">
			</td>
			</form>
			<form id="no_registration" action="" method="post">
			<td colspan="2" align="center">
				<input type="submit" id="cancel" name="cancel" value="Cancel">
			</td>
			</form>
		</tr>
	</table>
</body>
</HTML>