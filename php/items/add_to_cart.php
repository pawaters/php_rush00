<?php
	include (__DIR__ . "/../../install.php");

	$item_id = $_POST["item_id"];
	$sql = "SELECT * FROM $db_table_items WHERE id=$item_id";
	$query = mysqli_query($db_connection, $sql) OR
		exit ('error selecting from table `$db_table_items`') . mysqli_error($db_connection);
	$arr = mysqli_fetch_assoc($query);
	var_dump($arr);
?>
