<?php
	var_dump($_GET);
	$searchIn = $_GET['searchon'];
	$searchFor = $_GET['searchfor'];
	$category = $_GET['category'];
	$search_query = "Select * from book where";
	for ($i = 0; $i < sizeof($searchIn); $i++)
	{
		if ($searchIn[$i] == "anywhere") {
			$search_query = $search_query . " title = '$searchFor'
											  or author = '$searchFor' or publisher = '$searchFor'
											  or isbn = '$searchFor'";
			break;
		}
		if ($searchIn[$i] == "title") {
			$search_query = $search_query . " title = '$searchFor'";
		}
		if ($searchIn[$i] == "author") {
			$search_query = $search_query . " or author = '$searchFor'";
		}
		if ($searchIn[$i] == "publisher") {
			$search_query = $search_query . " or publisher = '$searchFor'";
		}
		if ($searchIn[$i] == "isbn") {
			$search_query = $search_query . " or isbn = '$searchFor'";
		}
	}
	
	for ($i = 0; $i < sizeof($category); $i++)
	{
		if ($category == "all") {
			/*$search_query = $search_query . " genre = '$category[$i]'
											  or genre = '$category[$i]' or genre = '$category[$i]'
											  or genre = '$category[$i]'";*/
			break;
		}
		if ($category == "romance") {
			$search_query = $search_query . " or genre = '$category'";
		}
		if ($category == "action") {
			$search_query = $search_query . " or genre = '$category'";
		}
		if ($category == "adventure") {
			$search_query = $search_query . " or genre = '$category'";
		}
		if ($category == "horror") {
			$search_query = $search_query . " or genre = '$category'";
		}
		if ($category == "self help") {
			$search_query = $search_query . " or genre = '$category'";
		}
	}
	echo $search_query;
?>
<html>
<head>
	<title> Search Result - 3-B.com </title>
	<script>

	</script>
</head>
<body>
	<table align="center" style="border:1px solid blue;">
		<tr>
			<td align="left">
				
					<h6> <fieldset>Your Shopping Cart has 0 items</fieldset> </h6>
				
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
		<td style="width: 350px" colspan="3" align="center">
			<div id="bookdetails" style="overflow:scroll;height:180px;width:400px;border:1px solid black;background-color:LightBlue">
			<table>
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
