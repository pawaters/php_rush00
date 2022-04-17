<h1>Add an item</h1>

<form>
	name: <input type="text" name="name" />
	<br>
	description: <input type="text" name="description" />
	<br>
	price: <input type="text" name="price" />
	<br>
	image: <input type="text" name="image" />
	<br>
	<?php
		$sql = "SHOW COLUMNS FROM $db_table_categories";
		var_dump(mysqli_query($db_connection, $sql));
		echo "<input type='checkbox' name='category' value='' /></label>"
	?>
</form>

<?php

?>
