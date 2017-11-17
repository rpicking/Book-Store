<?php
session_start();
include("common.php");
db_open();
$con = $link;

$action = $_POST['action'];	// contains value from input
if ($action) {
	header("location: ".$action);
}
/*
if ($_POST["register_submit"])
	{
		include("register_customer.php");
		create_customer($con);
	}
	
else if ($_POST["donotregister"]== "yes") {
	echo "helllo";
}*/
?>
<title>Welcome to Best Book Buy Online Bookstore!</title>
<body>
	<table align="center" style="border:1px solid blue;">
	<tr><td><h2>Best Book Buy (3-B.com)</h2></td></tr>
	<tr><td><h4>Online Bookstore</h4></td></tr>
	<tr><td>
		<form action="" method="post">
			<input type="radio" name="action" value="search.php"checked>Search Online<br/>
			<input type="radio" name="action" value="customer_registration.php">New Customer<br/>
			<input type="radio" name="action" value="user_login.php">Returning Customer<br/>
			<input type="radio" name="action" value="admin_login.php">Administrator<br/>
			<input type="submit" name="submit" value="ENTER">
		</form>
	</td></tr>
	</table>
</body>
</html>