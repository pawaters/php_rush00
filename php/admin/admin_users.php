<div>
    <h1>CURRENT USERS</h1>
</div>

<?php
    include("install.php");
    $sql = "SELECT * FROM users ORDER BY `type`ASC";
    $query = mysqli_query($db_connection, $sql) OR
    die ('Error showing `current users` table: ') . mysqli_error($db_connection);
    if ($query > 0){
        echo "<br> 
            <table class=\"adminTable\">
            <thread>
                <tr>
                    <th>id_customer</th>
                    <th>login</th>
                    <th>password</th>
                </tr>
            </thread>";    
        while($row = mysqli_fetch_assoc($query)){
                $button = ($row['type'] == 'admin') ? ('Make user') : ('Make admin');
                $name = ($row['type'] == 'admin') ? ('make_user') : ('make_admin');
                $id = $row['id_customer'];
                echo "<tbody> 
                    <tr>
                <td>" . $row['id_customer'] . "</td>
                <td>" . $row['login'] . "</td>
                <td>" . $row['password'] . "</td>
                <td><form action='' method= 'post'>
                                <input type='hidden' name='id_customer' value='$id'>
                                <input type='submit' name='delete' value='Delete'>
                            </form>
                        </td>
                <td><form action='' method= 'post'>
                                <input type='hidden' name='id_customer' value='$id'>
                                <input type='submit' name='$name' value='$button'>
                            </form>
                        </td>
                </tr>
                </tbody>";
        }
        echo "</table>";
    }

    if (isset($_POST['delete'])) {

        if ($_POST['delete'] == "Delete") {
            $id = $_POST['id_customer'];

            $sql = "SELECT * FROM `users` WHERE id_customer = '$id'";
            $query = mysqli_query($db_connection, $sql) OR
            die ('Error 1 removing user from `users` table: ') . mysqli_error($db_connection);

			if ($query) {
				if ($id != 1){
					$sql = "DELETE FROM `users` WHERE id_customer = '$id'";
					$query = mysqli_query($db_connection, $sql) OR
					die ('Error 2 removing user from `users` table: ') . mysqli_error($db_connection);
					$_SESSION['loggued_on_user'] = "";
					echo "<meta http-equiv='refresh' content='0'>";
				}
				else {
					echo "<p> You can't delete super super user</p>";
				}
            }
        }
    }

    if (isset($_POST['make_admin'])) {
        if ($_POST['make_admin'] == "Make admin") {
            $id = $_POST['id_customer'];
            $sql = "SELECT * FROM `users` WHERE id_customer = '$id'";
            $query = mysqli_query($db_connection, $sql) OR
            die ('Error 1 changing user rights from `users` table: ') . mysqli_error($db_connection);

            if ($query) {
                $sql = "UPDATE `users` SET type = 'admin' WHERE id_customer = '$id'";
                $query = mysqli_query($db_connection, $sql) OR
                die ('Error 2 changing user rights from `users` table: ') . mysqli_error($db_connection);
                echo "<meta http-equiv='refresh' content='0'>";
            }
        }
    }

    if (isset($_POST['make_user'])) {
        if ($_POST['make_user'] == "Make user") {
            $id = $_POST['id_customer'];
            $sql = "SELECT * FROM `users` WHERE id_customer = '$id'";
            $query = mysqli_query($db_connection, $sql) OR
            die ('Error 1 changing user rights from `users` table: ') . mysqli_error($db_connection);

            if ($query) {
				if ($id != 1){
					$sql = "UPDATE `users` SET type = 'user' WHERE id_customer = '$id'";
					$query = mysqli_query($db_connection, $sql) OR
					die ('Error 2 changing user rights from `users` table: ') . mysqli_error($db_connection);
					echo "<meta http-equiv='refresh' content='0'>";
				}
				else {
					echo "<p> Super admin cannot be a user</p>";
				}
			}
			
        }
    }
 

?>