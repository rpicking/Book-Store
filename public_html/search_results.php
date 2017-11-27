<?php
	session_start();
	include("common.php");
	db_open();
  
	$con = $link;
	//var_dump($_GET['searchon']);
	
	$isbn = $_GET['cart'];
	if($isbn) {
		$_SESSION['cart'][] = $isbn;
	}
	
	$searchFor = $_GET['searchfor'];
	$category = $_GET['category'];
	$search_query = "Select * from book where";
    $count = 0;
	foreach ($_GET['searchon'] as $searchIn)
	{
		if ($count > 0)
			$search_query  = $search_query . " or";
		if ($searchIn == "anywhere") {
			$search_query = $search_query . " title like '%$searchFor%'
											  or author like '%$searchFor%' or publisher like '$%searchFor%'
											  or isbn like '%$searchFor%'";
			break;
		}
		if ($searchIn == "title") {
			$search_query = $search_query . " title like '%$searchFor%'";
		}
		if ($searchIn == "author") {
			$search_query = $search_query . " author like '%$searchFor%'";
		}
		if ($searchIn == "publisher") {
			$search_query = $search_query . " publisher like '%$searchFor%'";
		}
		if ($searchIn == "isbn") {
			$search_query = $search_query . " isbn like '%$searchFor%'";
		} 
		$count++;
	}
	
	if ($category == "romance") {
		$search_query = $search_query . " or genre like '%$category%'";
	}
	else if ($category == "action") {
		$search_query = $search_query . " or genre like '%$category%'";
	}
	else if ($category == "adventure") {
		$search_query = $search_query . " or genre like '%$category%'";
	}
	else if ($category == "horror") {
		$search_query = $search_query . " or genre like '%$category%'";
	}
	else if ($category == "self help") {
		$search_query = $search_query . " or genre like '%$category%'";
	}
	$search_query = $search_query . ";";
	
	$query_results = mysqli_query($con, $search_query);
?>
<html>
<head>
	<title> Search Result - 3-B.com </title>
	<script>
		function addCart(isbn) {
			this.disabled=true;
			window.location.href = window.location.href + "&cart=" + isbn;
		}
		
		function getReview(isbn) {
			this.disabled=true;
			window.location.href = "book_review.php?book=" + isbn;
		}
		
	</script>
</head>
<body>
	<table align="center" style="border:1px solid blue;">
		<tr>
			<td align="left">
				
					<!--<h6> <fieldset>Your Shopping Cart has 0 items</fieldset> </h6>-->
				
			</td>
			<td>
				&nbsp
			</td>
			<td align="right">
				<form action="shopping_cart.php" method="post">
					<input type="submit" value="Manage Shopping Cart">
				</form>
			</td>
		</tr>	
		<tr>
		<td style="width: 350px" colspan="10" align="center">
			<div id="bookdetails" style="overflow:scroll;height:180px;width:400px;border:1px solid black;background-color:LightBlue">
			<table>
				 <?php
					foreach ($query_results as $book) {
							echo "<tr align = 'left'>";
							echo "<td colspan='3' style = 'padding-top: 5px;'>
							<button style = 'padding: 4px 12px; font: 15px; text: center;' 'name='book' onclick='addCart(".$book["isbn"].")'>Add to cart</button>
							<br><br>
							<button style = 'padding: 4px 19px; font: 15px; text: center;' 'name='getReview' onclick = 'getReview(".$book["isbn"].")'>Reviews</button>
							</td>";
							echo "<td>Book: ".$book["title"]."<br>
							By: ".$book["author"]."<br>
							<b>Publisher:</b> ".$book["publisher"]."<br>
							<b>isbn</b>: ".$book["isbn"]. "&nbsp&nbsp&nbsp&nbsp<b>Price</b>: $".$book["price"]."</td>";
							echo "</tr>";
						}
				?>
			</table>
			</div>
			
			</td>
		</tr>
		<tr>
			<td align= "center">
				<form action="" method="get">
					<input type="submit" value="Proceed To Checkout" id="checkout" name="checkout">
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
