<?php

	$db_host = 'localhost';
	$db_user = 'root';
	$db_pass = 'wosfaj5godranyxRuc';
	$db_name = 'db_shop_thakala_pwaters';

	$db_initial_connection = mysqli_connect($db_host, $db_user, $db_pass);
	if (mysqli_connect_error()) exit("mysqli_connect returned NULL");
	print_r($db_initial_connection);

	$sql_create_db = "CREATE DATABASE IF NOT EXISTS $db_name";
	$db_statement = mysqli_prepare($db_initial_connection, $sql_create_db);
	mysqli_stmt_bind_param($db_statement, 's', $db_name);
	if (mysqli_stmt_execute($db_statement) === false)
		exit ("mysqli_stmt_execute to create the database ($db_name) failed");
	mysqli_close($db_initial_connection);

	$db_connection = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

	$sql_create_table = "CREATE TABLE test(id INT, label TEXT)";
	$db_table_statement = mysqli_prepare($db_connection, $sql_create_table);

	$sql_insert_into_"INSERT INTO test(id, label) VALUES (?, ?)"
?>
