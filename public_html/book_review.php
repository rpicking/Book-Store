
<!DOCTYPE html>
<?php
  // Turn on the Session for this page
  session_start();

  // Include database stuff
  include("common.php");
  db_open();
  
  $con = $link;
  $array;
  $array2;
  
  reset($_POST);
  $book_num = key($_POST);
    
  $sql_query_review = "SELECT * from review where isbn = $book_num";
  $sql_query_book = "select title, author from book where isbn = $book_num";
  
  if ($is_query_run = mysqli_query($con, $sql_query_review))
  	{
  		$reviewResults = mysqli_query($con, $sql_query_review);
  		
  	}
  if ($is_query_run = mysqli_query($con, $sql_query_book))
  	{
  		$bookResults = mysqli_query($con, $sql_query_book);
  	}
?>
<html>
<head>
<title>Book Reviews - 3-B.com</title>
<style>
.field_set
{
	border-style: inset;
	border-width:4px;
}
</style>
</head>
<body>
	<table align="center" style="border:1px solid blue;">
				<?php
				while ($variable = mysqli_fetch_array($bookResults)) {
					echo "<tr>";
      				echo "<td> Book: ".$variable["title"]."</td>";
					echo "</tr>";
					echo "<tr>";
					echo "<td> By: ".$variable["author"]."</td>";
					echo "</tr>";
      				}
				?>
		<tr>
			<td colspan="2">
			<div id="bookdetails" style="overflow:scroll;height:200px;width:300px;border:1px solid black;">
			<table>
				<?php
				while ($row = mysqli_fetch_assoc($reviewResults)) {
      				$array[] = $row["content"];
      				echo "<tr><div><td>".$array[0]."</td></div></tr>";
    			}
				?>		
			</table>
			</div>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<form action="search_results.php" method="post">
					<input type="submit" value="Done">
				</form>
			</td>
		</tr>
	</table>
</body>

</html>
<?php
  db_close();
?>

