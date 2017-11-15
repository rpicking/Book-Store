
<html>
<head>
	<title>PROOF OF PURCHASE - 3-B.com </title>

	<style type="text/css">
		table {
			border-collapse: collapse;
		}
		.red_border > td{
			border: 2px solid #ff7575;
		}
	</style>
</head>
<body>
	<h2 align="center">Proof of Purchase</h2>
	<table align="center" >
		<tr>
			<td colspan="1">
				<strong>Shipping Address:</strong><br>
				Customer Name <br>
				Street Address <br>
				City <br>
				State  Zip Code
			</td>
			<td colspan="1" align="right" >
				<strong>UserID:</strong><br>
				<strong>  Date:</strong><br>
				<strong>  Time:</strong>
			</td>
			<td colspan="1" align="left" >
				username<br>
				MM/DD/YY<br>
				HH:MM:SS
			</td>
			<tr>
				<td colspan="1">
					<strong>Credit Card Information:</strong><br>
					VISA - 1234567890
				</td>
			</tr>
		</tr>

		<tr bgcolor="#ff7575">
			<th colspan="2"><strong>Book Description</strong></th>
			<th colspan="1"><strong>Qty</strong></th>
			<th colspan="1"><strong>Price</strong></th>
		</tr>
		<tr class="red_border">
			<td colspan="2" align="left">
				SQL Server 2000 for Experienced DBA's<br>
				<strong>By </strong> Brian Knight<br>
				<strong>Price: </strong>$34.99
			</td>
			<td colspan="1">1</td>
			<td colspan="1">$34.99</td>
		</tr>
		<tr class="red_border">
			<td colspan="2" align="left">
				The Guru's Guide to Transact-SQL<br>
				<strong>By </strong> Ken Henderson<br>
				<strong>Price: </strong>$38.49
			</td>
			<td colspan="1">1</td>
			<td colspan="1">$34.99</td>
		</tr>

		<tr>
			<td colspan="1" width="50px" style="font-size: 12px" align="right" bgcolor="#a0dcff">
				<strong>SHIPPING NOTE: </strong></td>
			<td colspan="1"width="75px" style="font-size: 12px" bgcolor="#a0dcff">The books will be delivered with 5 business days.</td>
			<td colspan="1" align="right">
				<strong>Subtotal:<br>
				Shipping & Handling:<br><br>
				Total:</strong>
			</td>
			<td colspan="1" align="left">
				<strong>
					$73.98<br>
					$4.00<br>
					-------<br>
					$77.98
				</strong>
			</td>
		</tr>
		
		<tr>
			<td align= "center">
				<form action="" method="get">
					<input type="submit" value="Print" id="print" name="Print">
				</form>
			</td>
			<td align="center">
				<form action="search.php" method="post">
					<input type="submit" value="New Search">
				</form>
			</td>
			<td align="center">
				<form action="index.php" method="post">
					<input type="submit" name="exit" value="EXIT 3-B.com">
				</form>
			</td>
		</tr>
	</table>
</body>
</html>
