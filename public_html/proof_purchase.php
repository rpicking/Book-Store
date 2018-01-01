<?php
	// Turn on the Session for this page
	session_start();

	// Include database stuff
	include("common.php");
	db_open();

	$con = $link;

	$username = $_SESSION["loggedIn"];
	$type = $_GET['type'];
	$number = $_GET['num'];
	if ($type && $number) {
		$updateUser_query = "UPDATE customer SET card_type = '$type', card_num = '$number' WHERE username = '$username';";
		mysqli_query($con, $updateUser_query);

		// go to base url to remove ?stuff from url
		header('Location: proof_purchase.php');
	}

	// user information
	$username = $_SESSION["loggedIn"];
	$sql_select_user = "SELECT * from customer where username = 'charlie2';";
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

	// clear shopping cart
	unset($_SESSION['cart']);
	
	// get time
	$datetime = new DateTime("now", new DateTimeZone('America/Detroit'));
	$timestamp = $datetime->format('Y-m-d');

	// totals
	$subtotal = 0;
	foreach ($results as $book) {
		$subtotal += $book['price'] * $book['quantity'];
	}
	$subtotal = number_format((float)$subtotal, 2, '.', '');
	$shipping = number_format((float)count($_SESSION['cart']) * 2, 2, '.', '');
	$total = number_format((float)$subtotal + $shipping, 2, '.', '');

	$sql_create_order = "INSERT INTO purchase (total, purchase_date)
		VALUES ($total, '$timestamp');";
	
	mysqli_query($con, $sql_create_order);
	$purchase_id = mysqli_insert_id($con);

	foreach ($results as $book) {
		$isbn = $book['isbn'];
		$quantity = $book['quantity'];
		$sql_book_order = "INSERT INTO orders values('$username', '$isbn', $purchase_id, $quantity);";
		//var_dump($sql_book_order);
		mysqli_query($con, $sql_book_order);
	}

?>

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
				<?php
					echo $user['fname']." ".$user["lname"]."<br>";
					echo $user['street']."<br>";
					echo $user['city']."<br>";
					echo $user['state']."  ".$user['zip'];
				?>
			</td>
			<td colspan="1" align="right" >
				<strong>UserID:</strong><br>
				<strong>  Date:</strong><br>
				<strong>  Time:</strong>
			</td>
			<td colspan="1" align="left" >
				<?php
					$time = time();
					

					echo $user['username']."<br>";
					echo $datetime->format('m/d/Y')."<br>";
					echo $datetime->format('h:i:s');
				?>
			</td>
			<tr>
				<td colspan="1">
					<strong>Credit Card Information:</strong><br>
					<?php
						echo $user['card_type']." - ".$user['card_num']."<br>";
					?>
				</td>
			</tr>
		</tr>

		<tr bgcolor="#ff7575">
			<th colspan="2"><strong>Book Description</strong></th>
			<th colspan="1"><strong>Qty</strong></th>
			<th colspan="1"><strong>Price</strong></th>
		</tr>

		<?php
			foreach ($results as $book) {
				$book_subtotal = number_format((float)$book['price'] * $book['quantity'], 2, '.', '');
				echo "<tr class='red_border'>";
				echo "<td colspan='2' align='left'>";
				echo $book['title']."<br>";
				echo "<strong>By </strong>".$book['author']."<br>";
				echo "<strong>Price: </strong>$".$book['price'];
				echo "</td>";
				echo "<td colspan='1' align='center'>".$book['quantity']."</td>";
				echo "<td colspan='1' align='center'>$".$book_subtotal."</td>";
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
				<button name="buy" onclick="window.print()">Print</button>
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
