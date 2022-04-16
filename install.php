<?php

	$db_host = 'localhost';
	$db_user = 'root';
	$db_pass = 'wosfaj5godranyxRuc';
	$db_name = 'db_shop_thakala_pwaters';

	$csv_items = "/db/items.csv";
	$csv_categories = "/db/categories.csv";
	$csv_item_categories = "/db/item_categories.csv";

	$db_initial_connection = mysqli_connect($db_host, $db_user, $db_pass);
	if (mysqli_connect_error()) exit("mysqli_connect returned NULL");
	print_r($db_initial_connection);



	$sql_create_db = "CREATE DATABASE IF NOT EXISTS $db_name";
	mysqli_query($db_initial_connection, $sql_create_db) OR
		exit("error creating database: `$db_name`" .  mysqli_error($db_initial_connection));
	// $db_statement = mysqli_prepare($db_initial_connection, $sql_create_db);
	// mysqli_stmt_bind_param($db_statement, 's', $db_name);
	// if (mysqli_stmt_execute($db_statement) === false)
		// exit ("mysqli_stmt_execute to create the database ($db_name) failed");
	mysqli_close($db_initial_connection);

	$db_connection = mysqli_connect($db_host, $db_user, $db_pass, $db_name) OR
		exit("mysqli_connect returned NULL" . mysqli_error($db_connection));

	// id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,

	$sql_create_table = "CREATE TABLE IF NOT EXISTS items(
		id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		name VARCHAR(100),
		price INT,
		description VARCHAR(2048),
		img VARCHAR(300)
	)";
	mysqli_query($db_connection, $sql_create_table) OR
		exit("error creating table: `items`" . mysqli_error($db_connection));

	// $sql_insert_into_test = "INSERT INTO test(id, label) VALUES (?, ?)";
?>
