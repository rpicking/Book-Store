<html>
<head>
	<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script>
		
		$( document ).ready(function() 
		{
			$('#submitSearch').attr('disabled', true);

			function updateFormEnabled() {
				if (verifySelection()) {
					$('#submitSearch').attr('disabled', false);
				} else {
					$('#submitSearch').attr('disabled', true);
				}
			}

			function verifySelection() {
				if ($('#searchIn').val() != '') {
					return true;
				} else {
					return false
				}
			}

			$('#searchIn').change(updateFormEnabled);
		});
	</script>
	<title>SEARCH - 3-B.com</title>
</head>
<body>
	<table align="center" style="border:1px solid blue;">
		<tr>
			<td>Search for: </td>
	<form action="search_results.php" method="get">
				<td><input name="searchfor" /></td>
				<td><input id = "submitSearch" type="submit" name="search" value="Search" /></td>
		</tr>
		<tr>
			<td>Search In: </td>
				<td>
					<select id = "searchIn" name="searchon[]" size = "5" multiple >
						<option value='anywhere' selected = 'selected'>Keyword anywhere</option>
						<option value='title'>Title</option>
						<option value='author'>Author</option>
						<option value='publisher'>Publisher</option>
						<option value='isbn'>ISBN</option>				
					</select>
				</td>
				<td><a href="shopping_cart.php"><input type="button" name="manage" value="Manage Shopping Cart" /></a></td>
		</tr>
		<tr>
			<td>Category: </td>
				<td><select name="category">
						<option value='all' selected='selected'>All Categories</option>
						<option value='romance'>Romance</option>
						<option value='action'>Action</option>
						<option value='fiction'>Fiction</option>
						<option value='horror'>Horror</option>>
						<option value='self help'>Self Help</option>
					</select>
				</td>
			</form>
	<form action="index.php" method="post">	
				<td><input type="submit" name="exit" value="EXIT 3-B.com" /></td>
			</form>
		</tr>
	</table>
</body>
</html>
