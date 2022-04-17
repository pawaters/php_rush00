<?php
    $login = $_SESSION['loggued_on_user'];

	$sql = "SELECT * FROM `users` WHERE username = '$login'";
	$query = mysqli_query($db_connection, $sql) OR
	die ('Error 1 removing user from `users` table: ') . mysqli_error($db_connection);

	if ($query) {
		$sql = "DELETE FROM `users` WHERE username = '$login'";
		$query = mysqli_query($db_connection, $sql) OR
		die ('Error 2 removing user from `users` table: ') . mysqli_error($db_connection);
		echo "<meta http-equiv='refresh' content='0'>";
	}
	$_SESSION['loggued_on_user'] = "";
	header("Location: index.php?page=about");
?>