<?php

	$db_host = 'localhost';
	$db_user = 'root';
	$db_pass = 'wosfaj5godranyxRuc';
	$db_name = 'db_shop_thakala_pwaters';

	$csv_items = "./db/items.csv";
	$csv_categories = "./db/categories.csv";
	$csv_item_categories = "./db/item_categories.csv";

	$db_table_items = "items";

	$db_initial_connection = mysqli_connect($db_host, $db_user, $db_pass);
	if (mysqli_connect_error())
		exit ("mysqli_connect returned NULL");
	print_r($db_initial_connection);



	$sql_create_db = "CREATE DATABASE IF NOT EXISTS $db_name";
	mysqli_query($db_initial_connection, $sql_create_db) OR
		exit ("error creating database: `$db_name`" .  mysqli_error($db_initial_connection));
	// $db_statement = mysqli_prepare($db_initial_connection, $sql_create_db);
	// mysqli_stmt_bind_param($db_statement, 's', $db_name);
	// if (mysqli_stmt_execute($db_statement) === false)
	// exit ("mysqli_stmt_execute to create the database ($db_name) failed");
	mysqli_close($db_initial_connection);

	$db_connection = mysqli_connect($db_host, $db_user, $db_pass, $db_name) OR
		exit ("mysqli_connect returned NULL" . mysqli_error($db_connection));

	// id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,

	$sql_create_table = "CREATE TABLE IF NOT EXISTS $db_table_items(
		id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		name VARCHAR(100),
		price INT,
		description VARCHAR(2048),
		img VARCHAR(300)
	)";
	mysqli_query($db_connection, $sql_create_table) OR
		exit ("error creating table: `$db_table_items`" . mysqli_error($db_connection));
	mysqli_query($db_connection, "ALTER TABLE table_name AUTO_INCREMENT = 0") OR
		exit("error altering table: `$db_table_items`" . mysqli_error($db_connection));

	// mysqli_query($db_connection, "INSERT INTO items (name, price, description, img) VALUES ('php_e_commerce', '16935', 'Purchase a ready-made electronic commerce website design!', '')");
	// exit();
	$csv_file = fopen($csv_items, "r");
	echo ("<br><br><br><br><br>");
	if (($csv_fields = fgetcsv($csv_file)) === false)
		exit ("fgetcsv returned `false` for `$csv_file`");
	unset($csv_fields[0]);
	$csv_fields_str = implode(", ", $csv_fields);
	echo ("<br><br><br><br><br>");
	print($csv_fields_str);
	while (($tuple = fgetcsv($csv_file)) !== false)
	{
		unset($tuple[0]);
		$sql_insert_csv_row = "INSERT INTO $db_table_items ($csv_fields_str)
		VALUES ('".implode("', '", $tuple)."')";
		echo $sql_insert_csv_row;
		mysqli_query($db_connection, $sql_insert_csv_row) OR
			exit ("error inserting `$sql_insert_csv_row` into table: `$db_table_items`" . mysqli_error($db_connection));
	}

	// $sql_insert_into_test = "INSERT INTO test(id, label) VALUES (?, ?)";
?>
