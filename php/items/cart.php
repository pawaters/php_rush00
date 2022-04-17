<?php
	include(__DIR__ . "/../../install.php");

	function	remove_from_cart($id)
	{
		$item_ids = array_keys($_SESSION["cart"]);
		foreach ($item_ids as $item_id)
		{
			if ($item_id != $id)
				continue ;
			unset($_SESSION["cart"][$item_id]);
			if (empty($_SESSION["cart"]))
				unset($_SESSION["cart"]);
			break ;
		}
	}

	if (isset($_POST['del']) && $_POST['del'] === "Delete")
		remove_from_cart($_POST['item_id']);

	if (isset($_POST["minus_one"]) && $_POST["minus_one"] == "-")
	{
		$item_ids = array_keys($_SESSION["cart"]);
		foreach ($item_ids as $item_id)
		{
			if ($item_id != $_POST["item_id"])
				continue ;
			$_SESSION["cart"][$item_id] -= 1;
			if ($_SESSION["cart"][$item_id] <= 0)
				unset($_SESSION["cart"][$item_id]);
			if (empty($_SESSION["cart"]))
				unset($_SESSION["cart"]);
			break ;
		}
	}

	if (isset($_POST["plus_one"]) && $_POST["plus_one"] = "+")
	{
		$item_ids = array_keys($_SESSION["cart"]);
		foreach ($item_ids as $item_id)
		{
			if ($item_id != $_POST["item_id"])
				continue ;
			$_SESSION["cart"][$item_id] += 1;
			if ($_SESSION["cart"][$item_id] <= 0)
				unset($_SESSION["cart"][$item_id]);
			if (empty($_SESSION["cart"]))
				unset($_SESSION["cart"]);
			break ;
		}
	}

	if (isset($_SESSION["cart"]) === false)
		exit ("<h1>You haven't got any cartified products! Keep feeding the cookies, please!</h1>");
	echo "
	<br>
	<table>
		<thead>
			<tr>
				<th>PRODUCT</th>
				<th>UNIT PRICE</th>
				<th>QUANTITY</th>
				<th>TOTAL</th>
			</tr>
		<thead>";
	$item_ids = array_keys($_SESSION["cart"]);
	foreach ($item_ids as $item_id)
	{
		$sql = "SELECT * FROM $db_table_items WHERE id=$item_id";
		$query = mysqli_query($db_connection, $sql) OR
			exit ("error querying database table: `$db_name.$db_table_items`" .  mysqli_error($db_connection));
		$item = mysqli_fetch_array($query);
		$name = $item["name"];
		$price = $item["price"];
		$description = $item["description"];
		$image = $item["img"];
		$quantity = $_SESSION["cart"][$item_id];
		$item_total = $price * $quantity;
		$grand_total += $item_total;
		echo "
		<tbody>
			<tr>
				<td><img src=".$image."></td>
				<td>$name</td>
				<td>$price BTC</td>
				<td>$quantity
					<form action='' method= 'post'>
						<input type='hidden' name='item_id' value='$item_id'>
						<input type='submit' name='minus_one' value='-'>
					</form>
					<form action='' method= 'post'>
						<input type='hidden' name='item_id' value='$item_id'>
						<input type='submit' name='plus_one' value='+'>
					</form>
				</td>
				<td>$item_total BTC</td>
				<td>
					<form action='' method= 'post'>
						<input type='hidden' name='item_id' value='$item_id'>
						<input type='submit' name='del' value='Delete'>
					</form>
				</td>
			</tr>
		</tbody>
		";
	}
	echo "
		<tfoot>
			<tr>
				<td colspan=\"4\"></td>
				<td>TOTAL: $grand_total BTC</td>
				<td>
					<form action='' method= 'post'>
						<input type='hidden' name='total' value='$grand_total'>
						<input type='submit' name='order' value='Confirm order'>
					</form>
				</td>
			</tr>
		</tfoot>
	</table>";
?>
