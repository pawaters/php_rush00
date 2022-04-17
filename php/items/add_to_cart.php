<?php
	include (__DIR__ . "/../../install.php");

	if (empty($_POST["item_id"]) === true)
		exit ("item_id is empty");
	if (empty($_SESSION["cart"]))
	{
		$_SESSION["cart"][$_POST["item_id"]] = 1;
	}
	$found = 0;
	foreach ($_SESSION["cart"] as $item_id => $quantity)
	{
		if ($item_id == $_POST["item_id"])
		{
			$found = 1;
			$_SESSION["cart"][$item_id] = $quantity + 1;
		}
	}
	if ($found === 0)
	{
		$_SESSION["cart"][$_POST["item_id"]] = 1;
	}
	// $_SESSION["cart"] = array();
?>
