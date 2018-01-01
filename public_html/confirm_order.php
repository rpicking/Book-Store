<?php
	// Turn on the Session for this page
	session_start();

	// Include database stuff
	include("common.php");
	db_open();

	$con = $link;

	// user information
	$username = $_SESSION["loggedIn"];
	if (!$username) {
		header('Location: customer_registration.php');	
	}
	
	$sql_select_user = "SELECT * from customer where username = '$username';";
	$sqlresults = mysqli_query($con, $sql_select_user);
	$user = mysqli_fetch_assoc($sqlresults);

	// book information
	$done = array();
	$results = array();

	foreach ($_SESSION['cart'] as $isbn) {
		if (!in_array($isbn, $done)) {
			$done[] = $isbn;
			$sql_select_book = "SELECT * from book where isbn = $isbn";

			$sqlresults = mysqli_query($con, $sql_select_book);
			$result = mysqli_fetch_array($sqlresults);
			$result['quantity'] = 1;

			$results[$result['isbn']] = $result;

		}
		else {
			$results[$isbn]['quantity'] += 1;
		}
	}
?>
<html>
<head>
	<title>CONFIRM ORDER - 3-B.com </title>

	<style type="text/css">
		table {
			border-collapse: collapse;
		}
		.red_border > td{
			border: 2px solid #ff7575;
		}
	</style>

	<script>
		function buy() {
			var value = document.getElementById("card").elements['group1'].value;
			if (value === "onfile") {
				window.location.href="proof_purchase.php";
			}
			else {
				var sel = document.getElementById("credit_card");
				var type = sel.options[sel.selectedIndex].text;
				var number = document.getElementById("card_number").value;

				if (type && number && validateNumber(number)) {
					window.location.href="proof_purchase.php?type=" + type + "&num=" + number;
				}
			}
		}

		function validateNumber(number) {
			if (number.toString().length === 16) return true;
			return false;
		}

	</script>
</head>
<body>
	<h2 align="center">Confirm Order</h2>
	<table align="center" >
		<tr>
			<td colspan="1">
				<strong>Shipping Address:</strong><br>

				<?php
					echo $user['fname']." ".$user["lname"]."<br>";
					echo $user['street']."<br>";
					echo $user['city']."<br>";
					echo $user['state']."  ".$user['zip'];
				?>
			</td>
			<td colspan="2">
				<form id="card">
					<input type="radio" name="group1" value="onfile"checked>Use Credit Card on file<br/>&emsp;
						<?php
							echo $user['card_type']." - ".$user['card_num']."<br>";
						?>
					<input type="radio" name="group1" value="new">New Credit Card<br/>
					<select id="credit_card" name="credit_card">
						<option selected disabled>select a card type</option>
						<option>VISA</option>
						<option>MASTER</option>
						<option>DISCOVER</option>
					</select>
					<input type="number" id="card_number" name="card_number" placeholder="Credit card number" minlength="16" maxlength="16">
				</form>
			</td>
		</tr>

		<tr bgcolor="#ff7575">
			<th colspan="2"><strong>Book Description</strong></th>
			<th colspan="1"><strong>Qty</strong></th>
			<th colspan="1"><strong>Price</strong></th>
		</tr>
		
		<?php
			foreach ($results as $book) {
				$subtotal = number_format((float)$book['price'] * $book['quantity'], 2, '.', '');
				echo "<tr class='red_border'>";
				echo "<td colspan='2' align='left'>";
				echo $book['title']."<br>";
				echo "<strong>By </strong>".$book['author']."<br>";
				echo "<strong>Price: </strong>$".$book['price'];
				echo "</td>";
				echo "<td colspan='1' align='center'>".$book['quantity']."</td>";
				echo "<td colspan='1' align='center'>$".$subtotal."</td>";
				echo "</tr>";
			}
		?>

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
					<?php
						$subtotal = 0;
						foreach ($results as $book) {
							$subtotal += $book['price'] * $book['quantity'];
						}
						$subtotal = number_format((float)$subtotal, 2, '.', '');
						$shipping = number_format((float)count($_SESSION['cart']) * 2, 2, '.', '');
						$total = number_format((float)$subtotal + $shipping, 2, '.', '');
						echo "$".$subtotal."</br>";
						echo "$".$shipping."</br>";
						echo "--------<br>";
						echo "$".$total;
					?>
				</strong>
			</td>
		</tr>
		
		<tr>
			<td align= "center">
				<form action="search.php" method="get">
					<input type="submit" value="Cancel" id="cancel" name="Cancel">
				</form>
			</td>
			<td align="center">
				<form action="update_customer.php" method="post">
					<input type="submit" value="Update Customer Profile">
				</form>
			</td>
			<td align="center">
				<button name="buy" onclick="buy()">BUY IT!</button>
			</td>
		</tr>
	</table>
</body>
</html>
