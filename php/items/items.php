<?php
	include(__DIR__ . "/../../install.php");
	if ($_POST['cartify'] === "Cartify")
		include (__DIR__ . "/php/items/add_to_cart.php");
	$sql = "SELECT * FROM $db_table_items";
	$category = mysqli_real_escape_string($db_connection, $_GET["category"]);
	if ($category != 0)
		$sql .= " JOIN $db_table_item_categories ON $db_table_items.id=$db_table_item_categories.id_item WHERE $db_table_item_categories.id_category=" . $category;
	$result = mysqli_query($db_connection, $sql);
	foreach ($result as $item)
	{
		echo "
			<table>
				<tr>
					<td><img src=".$item["img"]."></td>
					<td>".$item["name"]."</td>
				</tr>
				<tr>
					<td>".$item["price"]."</td>
				</tr>
				<tr>
					<td>".$item["description"]."</td>
				</tr>
				<tr>
					<td>
						<form action='' method='post'>
							<input type='hidden' name='item_id' value='".$item["item_id"]."' />
							<input type='submit' name='cartify' value='Cartify' />
						</form>
					</td>
				</tr>
			</table>
		";
	}
?>
