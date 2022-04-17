<div class= "login">
    <h1>CHANGE PASSWORD</h1>
    <p>To change your password fillout the form:</p>
</div>
<div class= "login">
    <form action = "" method="POST"> 
        <input type="text" name="login" placeholder="Login" value="" />
        <br/>
        <input type="password" name="old_passwd" placeholder="Old password" value="" />
        <br/>
        <input type="password" name="new_passwd" placeholder="New password" value="" />
        <br/>
        <input name="submit" type="submit" value="OK"></p>
		<div><a href="index.php?page=delete_user">delete account</div>
    </form>
</div>

<?php
    if(isset($_POST['submit']) && $_POST['submit'] == "OK"){
		$login = mysqli_real_escape_string($db_connection, $_POST['login']);
        $old_passwd = mysqli_real_escape_string($db_connection, $_POST['old_passwd']);
		$hashed_passwd_old = hash('whirlpool', $old_passwd);
		$new_passwd = mysqli_real_escape_string($db_connection, $_POST['new_passwd']);
		$hashed_passwd_new = hash('whirlpool', $new_passwd);

        $sql = "SELECT * FROM `users` WHERE username = '$login'";
        $query = mysqli_query($db_connection, $sql);
        $row = mysqli_fetch_array($query);
        
        if($row){
            if($row['password'] == $hashed_passwd_old){
                $sql = "UPDATE users SET password = '$hashed_passwd_new' WHERE username = '$login'";
                $query = mysqli_query($db_connection, $sql);
                echo "<p class=\"login\">You password has been successfully changed.</p>";
            }
            else{
                echo "<p>Error: Current Password is not correct.</p>";
            }
        }
        else{
            echo "<p>Error: Account does not exist.</p>";
        }
    }
?>