<?php
	session_start();
	include("common.php");
	db_open();
  
	$con = $link;
	
	//Create queries
	$query_1 = "Select count(*) from customer";
	
	$query_2 = "select distinct count(title), genre from book 
				group by genre";
	
	$query_3 = "select AVG(p.total), MONTH(p.purchase_date) from orders  
	join purchase as p on p.purchaseID = orders.purchaseID  
	where YEAR(p.purchase_date) = YEAR(CURRENT_DATE)
	 group by MONTH(p.purchase_date)";
	
	$query_4 = "select b.title, count(r.isbn) from book as b 
				join review as r on r.isbn = b.isbn 
				group by b.isbn";
	
	//execute and save queries in array			
	$query_results1 = mysqli_query($con, $query_1);
	//$results1 = mysqli_fetch_array($query_results1);
	
	$query_results2 = mysqli_query($con, $query_2);
	//$results2 = mysqli_fetch_array($query_results2);
	
	$query_results3 = mysqli_query($con, $query_3);
	
	$query_results4 = mysqli_query($con, $query_4);
	//$results4 = mysqli_fetch_array($query_results4);
	
	
?>
<!DOCTYPE HTML>
<head>
<title>Administrator</title>

<style>
	table {
		border-collapse: collapse;
		margin-bottom: 10px; 
	}
	th {
		padding: 10px;
		border: 1px solid black;
	}
	td {
		padding: 5px;
		text-align: center;
		min-width: 50px;
		border: 1px solid black;
	}
</style>
</head>

<body>
<h1 align="center">Administor Reports</h1>
<table align="center" style="border:2px solid blue;">
		<?php
		foreach ($query_results1 as $customer)
		{
			echo "<tr>";
				echo "<td>Registered Customers:</td>";
				echo "<td>".$customer['count(*)']."</td>";
			echo "</tr>";
		}
		?>
		<tr>
			<th>Category</th>
			<th>Number of Titles</th>
		</tr>
		<tr>
		<?php
		foreach ($query_results2 as $book)
		{
			echo "<tr>";
				echo "<td>".$book['genre']."</td>";
				echo "<td>".$book['count(title)']."</td>";
			echo "</tr>";
		}
		?>
		</tr>
		<tr>
			<th>Month</th>
			<th>Monthly Sales</th>
		</tr>
		<?php
		$jan = 0;
		$feb = 0;
		$march = 0;
		$april = 0;
		$may = 0;
		$june = 0;
		$july = 0;
		$aug = 0;
		$sept = 0;
		$oct = 0;
		$nov = 0;
		$dec = 0;
		foreach ($query_results3 as $order)
		{
			if  ($order['MONTH(p.purchase_date)'] == 1)
				$jan = round($order['AVG(p.total)'], 2);
			else if  ($order['MONTH(p.purchase_date)'] == 2)
				$feb = round($order['AVG(p.total)'], 2);
			else if  ($order['MONTH(p.purchase_date)'] == 3)
				$march = round($order['AVG(p.total)'], 2);
			else if  ($order['MONTH(p.purchase_date)'] == 4)
				$april = round($order['AVG(p.total)'], 2);
			else if  ($order['MONTH(p.purchase_date)'] == 5)
				$may = round($order['AVG(p.total)'], 2);
			else if  ($order['MONTH(p.purchase_date)'] == 6)
				$june = round($order['AVG(p.total)'], 2);
			else if  ($order['MONTH(p.purchase_date)'] == 7)
				$july = round($order['AVG(p.total)'], 2);
			else if  ($order['MONTH(p.purchase_date)'] == 8)
				$aug = round($order['AVG(p.total)'], 2);
			else if  ($order['MONTH(p.purchase_date)'] == 9)
				$sept = round($order['AVG(p.total)'], 2);
			else if  ($order['MONTH(p.purchase_date)'] == 10)
				$oct = round($order['AVG(p.total)'], 2);
			else if  ($order['MONTH(p.purchase_date)'] == 11)
				$nov = round($order['AVG(p.total)'], 2);
			else if  ($order['MONTH(p.purchase_date)'] == 12)
				$dec = round($order['AVG(p.total)'], 2);	
		}
		echo "<tr>";
			echo "<td>January</td>";
			echo "<td>$".$jan."</td>";
		echo "</tr>";
		echo "<tr>";
			echo "<td>February</td>";
			echo "<td>$".$feb."</td>";
		echo "</tr>";
		echo "<tr>";
			echo "<td>March</td>";
			echo "<td>$".$march."</td>";
		echo "</tr>";
		echo "<tr>";
			echo "<td>April</td>";
			echo "<td>$".$april."</td>";
		echo "</tr>";
		echo "<tr>";
			echo "<td>May</td>";
			echo "<td>$".$may."</td>";
		echo "</tr>";
		echo "<tr>";
			echo "<td>June</td>";
			echo "<td>$".$june."</td>";
		echo "</tr>";
		echo "<tr>";
			echo "<td>July</td>";
			echo "<td>$".$july."</td>";
		echo "</tr>";
		echo "<tr>";
			echo "<td>August</td>";
			echo "<td>$".$aug."</td>";
		echo "</tr>";
		echo "<tr>";
			echo "<td>September</td>";
			echo "<td>$".$sept."</td>";
		echo "</tr>";
		echo "<tr>";
			echo "<td>October</td>";
			echo "<td>$".$oct."</td>";
		echo "</tr>";
		echo "<tr>";
			echo "<td>November</td>";
			echo "<td>$".$nov."</td>";
		echo "</tr>";
		echo "<tr>";
			echo "<td>December</td>";
			echo "<td>$".$dec."</td>";
		echo "</tr>";
		?>
		<tr>
			<th>Book</th>
			<th>Number of Reviews</th>
		</tr>
		<tr>
		<?php
		foreach ($query_results4 as $book)
		{
			echo "<tr>";
				echo "<td>".$book['title']."</td>";
				echo "<td>".$book['count(r.isbn)']."</td>";
			echo "</tr>";
		}
		?>
		</tr>
		
	</table>

	<form align="center" action="index.php" method="post">
		<input type="submit" name="exit" value="EXIT 3-B.com">
	</form>
</body>



</html>
