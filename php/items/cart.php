<?php
	include(__DIR__ . "/../../install.php");
	var_dump($db_connection);
	if (isset($_SESSION["cart"]) === false)
		exit ();
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
	foreach ($_SESSION["cart"] as $item)
	{
		
	}
?>
