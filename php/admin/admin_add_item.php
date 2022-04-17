<h1>Add an item</h1>

<form action="" method="post">
	name: <input type="text" name="name" value="<?= @mysqli_real_escape_string($db_connection, $_POST['name']); ?>" />
	<br>
	description: <input type="text" name="description" value="<?= @mysqli_real_escape_string($db_connection, $_POST['description']) ?>" />
	<br>
	price: <input type="number" name="price" value="<?= @mysqli_real_escape_string($db_connection, $_POST['price']) ?>" />
	<br>
	image: <input type="text" name="image" value="<?= @mysqli_real_escape_string($db_connection, $_POST['image']) ?>" />
	<br>
	<?php
		$sql = "SELECT * FROM $db_table_categories";
		$query = mysqli_query($db_connection, $sql);
		$arr = mysqli_fetch_all($query);
		foreach ($arr as $row)
		{
			$checked = "";
			if (in_array($row[0], $_POST["category"]))
				$checked = "checked";
			echo "<input type='checkbox' id='$row[1]' name='category[]' value='$row[0]' $checked /><label for='$row[1]'>$row[1]</label>";
		}
	?>
	<input name="submit" type="submit" value="add" />
</form>

<?php
	include("../../install.php");

	if (empty($_POST['name']) || empty($_POST['description'])
		|| empty($_POST['price']) || empty($_POST['image'])
		|| !isset($_POST["category"]))
	{
		exit ("please leave no field blank");
	}
	$name = mysqli_real_escape_string($db_connection, $_POST['name']);
	$price = mysqli_real_escape_string($db_connection, $_POST['price']);
	$description = mysqli_real_escape_string($db_connection, $_POST['description']);
	$image = mysqli_real_escape_string($db_connection, $_POST['image']);
	$sql = "INSERT INTO $db_table_items (`name`, `price`, `description`, `img`)
		VALUES ('$name', '$price', '$description', '$image')";
	mysqli_query($db_connection, $sql);

	$query = mysqli_query($db_connection, "SELECT LAST_INSERT_ID()") OR
		exit("error querying database" . mysqli_error($db_connection));
	$item_id = mysqli_fetch_assoc($query)["LAST_INSERT_ID()"];
	foreach ($_POST["category"] as $category)
	{
		$sql = "INSERT INTO $db_table_item_categories (id_item, id_category)
			VALUES ($item_id, $category)";
		mysqli_query($db_connection, $sql);
	}

?>
