<?php
	// Turn on the Session for this page
	session_start();

	// Include database stuff
	include("common.php");
	db_open();

	$con = $link;

	//delete all occurance of isbn from session variable cart
	$del_item = $_GET['del'];	
	if($del_item) {
		removeBook($del_item);
	}

	// update quantities removing if quantity is 0
	$quantities = json_decode($_GET['update']);
	//var_dump($quantities);
	if ($quantities) {
		foreach ($quantities as $isbn => $quantity) {
			removeBook($isbn);
			if ($quantity != 0) {
				for ($i = 0; $i < $quantity; $i++) {
					$_SESSION['cart'][] = $isbn;
				}
			}
		}
		header('Location: shopping_cart.php');
	}
	

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

	// remove all occurances of book from cart
	function removeBook($book) {
		foreach($_SESSION['cart'] as $key => $value) {
			if ($value == $book) {
				unset($_SESSION['cart'][$key]);
			}
		}
	}
?>

<head>
	<title>Shopping Cart</title>
	<script>
		function delCart(isbn) {
			window.location.href="shopping_cart.php?del="+ isbn;
		}

		function recalculate() {
			var books = document.getElementsByClassName('quantity');
			var update = {};
			for(var i = 0; i < books.length; ++i) {
				var isbn = books[i].name;
				var quantity = books[i].value;
				update[isbn] = quantity;
			}
			
			window.location.href="shopping_cart.php?update="+ JSON.stringify(update);
		}
	</script>
	<style>
		#bookdetails .quantity {
			width: 50px;
			text-align: center;
		}
	</style>
</head>
<body>
	<table align="center" style="border:2px solid blue;">
		<tr>
			<td align="center">
				<form id="checkout" action="confirm_order.php" method="get">
					<input type="submit" name="checkout_submit" id="checkout_submit" value="Proceed to Checkout">
				</form>
			</td>
			<td align="center">
				<form id="new_search" action="search.php" method="post">
					<input type="submit" name="search" id="search" value="New Search">
				</form>								
			</td>
			<td align="center">
				<form id="exit" action="index.php" method="post">
					<input type="submit" name="exit" id="exit" value="EXIT 3-B.com">
				</form>					
			</td>
		</tr>
		
		<tr>
			<td  colspan="3">
				<div id="bookdetails" style="overflow:scroll;height:300px;width:500px;border:1px solid black;">
					<table align="center" BORDER="2" CELLPADDING="2" CELLSPACING="2" WIDTH="100%">
						<th width='20%'>Remove</th>
						<th width='60%'>Book Description</th>
						<th width='10%'>Qty</th>
						<th width='10%'>Price</th>

						<?php
							foreach ($results as $book) {
								$subtotal = number_format((float)$book['price'] * $book['quantity'], 2, '.', '');
								echo "<tr>";
								echo "<td><button name='delFromCart' onclick='delCart(".$book['isbn'].")'>Delete Item</button></td>";
								echo "<td>".$book['title']."<br><b>By  </b>".$book['author']."<br><b>Price:  </b>$".$book['price']."</td>";
								echo "<td> <input class='quantity' type='number' name='".$book['isbn']."'value='".$book['quantity']."'></td>";
								echo "<td>$".$subtotal."</td>";
								echo "</tr>";
							}
						?>

					</table>
				</div>
			</td>
		</tr>
		<tr>
			<td align="center">
				<button name="addCart" onclick="recalculate()">Recalculate Payment</button>		
			</td>
			<td align="center">
				&nbsp;
			</td>
			<td align="center">
				<?php
					$total = 0;
					foreach ($results as $book) {
						$total += $book['price'] * $book['quantity'];
					}
					$total = number_format((float)$total, 2, '.', '');
					echo "<b>Subtotal: $".$total."</b>";
				?>		
			</td>
		</tr>
	</table>
</body>
