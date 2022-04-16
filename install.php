<?php

	$db_host = 'localhost';
	$db_user = 'root';
	$db_pass = 'wosfaj5godranyxRuc';
	$db_name = 'db_shop_thakala_pwaters';

	$csv_items = "./db/items.csv";
	$csv_categories = "./db/categories.csv";
	$csv_item_categories = "./db/item_categories.csv";

	$db_table_items = "items";
	$db_table_categories = "categories";
	$db_table_item_categories = "item_categories";

	$db_initial_connection = mysqli_connect($db_host, $db_user, $db_pass);
	if (mysqli_connect_error())
		exit ("mysqli_connect returned NULL");

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

	$sql_create_table = "CREATE TABLE IF NOT EXISTS $db_table_items (
		id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		name VARCHAR(100),
		price INT,
		description VARCHAR(2048),
		img VARCHAR(300)
	)";
	mysqli_query($db_connection, $sql_create_table) OR
		exit ("error creating table: `$db_table_items`" . mysqli_error($db_connection));
	$sql = "SELECT * FROM $db_name.$db_table_items";
	$query = mysqli_query($db_connection, $sql);
	$query_row = mysqli_fetch_array($query);
	if ($query_row == 0)
	{
		$csv_file = fopen($csv_items, "r");
		if (($csv_fields = fgetcsv($csv_file)) === false)
			exit ("fgetcsv returned `false` for `$csv_file`");
		$csv_fields_str = implode(", ", $csv_fields);
		while (($tuple = fgetcsv($csv_file)) !== false)
		{
			$sql_insert_csv_row = "INSERT INTO $db_table_items ($csv_fields_str)
			VALUES ('".implode("', '", $tuple)."')";
			mysqli_query($db_connection, $sql_insert_csv_row) OR
				exit ("error inserting `$sql_insert_csv_row` into table: `$db_table_items`" . mysqli_error($db_connection));
		}
	}

	$sql_create_table = "CREATE TABLE IF NOT EXISTS $db_table_categories (
		id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		name VARCHAR(100)
	)";
	mysqli_query($db_connection, $sql_create_table) OR
		exit ("error creating table: `$db_table_categories`" . mysqli_error($db_connection));
	$sql = "SELECT * FROM $db_name.$db_table_categories";
	$query = mysqli_query($db_connection, $sql);
	$query_row = mysqli_fetch_array($query);
	if ($query_row == 0)
	{
		$csv_file = fopen($csv_categories, "r");
		if (($csv_fields = fgetcsv($csv_file)) === false)
			exit ("fgetcsv returned `false` for `$csv_file`");
		$csv_fields_str = implode(", ", $csv_fields);
		while (($tuple = fgetcsv($csv_file)) !== false)
		{
			$sql_insert_csv_row = "INSERT INTO $db_table_categories ($csv_fields_str)
			VALUES ('".implode("', '", $tuple)."')";
			mysqli_query($db_connection, $sql_insert_csv_row) OR
				exit ("error inserting `$sql_insert_csv_row` into table: `$db_table_categories`" . mysqli_error($db_connection));
		}
	}

	$sql_create_table = "CREATE TABLE IF NOT EXISTS $db_table_item_categories (
		id_item INT NOT NULL,
		id_category INT NOT NULL
	)";
	mysqli_query($db_connection, $sql_create_table) OR
		exit ("error creating table: `$db_table_item_categories`" . mysqli_error($db_connection));
	$sql = "SELECT * FROM $db_name.$db_table_item_categories";
	$query = mysqli_query($db_connection, $sql);
	$query_row = mysqli_fetch_array($query);
	if ($query_row == 0)
	{
		$csv_file = fopen($csv_item_categories, "r");
		if (($csv_fields = fgetcsv($csv_file)) === false)
			exit ("fgetcsv returned `false` for `$csv_file`");
		$csv_fields_str = implode(", ", $csv_fields);
		while (($tuple = fgetcsv($csv_file)) !== false)
		{
			$sql_insert_csv_row = "INSERT INTO $db_table_item_categories ($csv_fields_str)
			VALUES ('".implode("', '", $tuple)."')";
			mysqli_query($db_connection, $sql_insert_csv_row) OR
				exit ("error inserting `$sql_insert_csv_row` into table: `$db_table_item_categories`" . mysqli_error($db_connection));
		}
	}
	// $sql_insert_into_test = "INSERT INTO test(id, label) VALUES (?, ?)";

?>
