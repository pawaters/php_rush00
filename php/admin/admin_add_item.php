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
		$sql = "SELECT * FROM $db_table_categories";
		$query = mysqli_query($db_connection, $sql);
		$arr = mysqli_fetch_assoc($query);
		var_dump($arr);
		echo "<input type='checkbox' name='category' value='' /></label>"
	?>
</form>

<?php

?>
