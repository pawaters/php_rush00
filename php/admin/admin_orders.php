<?php
	include("../../install.php");

	if ($_POST["delete"] === "delete" && isset($_POST["order_id"]))
	{
		$sql = "DELETE FROM $db_table_orders WHERE id=" . mysqli_real_escape_string($db_connection, $_POST["order_id"]);
		mysqli_query($db_connection, $sql);
	}

	$sql = "SELECT order_id, item_id, date, total, username FROM orders JOIN order_details ON orders.id = order_details.order_id JOIN users ON orders.id_user = users.id ORDER BY order_id, item_id";
	$query = mysqli_query($db_connection, $sql);

	echo "
	<br>
	<table>
		<thead>
			<tr>
				<th>order_id</th>
				<th>item_id</th>
				<th>datetime</th>
				<th>total</th>
				<th>username</th>
			</tr>
		</thead>
	";
	while ($arr = mysqli_fetch_assoc($query))
	{
		$order_id = $arr["order_id"];
		$item_id = $arr["item_id"];
		$date = $arr["date"];
		$total = $arr["total"];
		$username = $arr["username"];
		echo "
			<tbody>
				<tr>
					<td> $order_id </td>
					<td> $item_id </td>
					<td> $date </td>
					<td> $total </td>
					<td> $username </td>
					<td>
						<form method='post' action=''>
							<input type='text' name='order_id' value='$order_id' hidden />
							<input type='submit' name='delete' value='delete' />
						</form>
					</td>
				</tr>
			</tbody>
		";
	}
?>
