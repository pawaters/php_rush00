<?php
session_start();
include("install.php");

if(!isset($_GET['page']) || $_GET['page'] == "home")
{
    $page = "src/pages/home.php";
}
else if($_GET['page'] == "items"){
    $page = "src/pages/items.php";
}
else if($_GET['page'] == "contact"){
    $page = "pages/contact.html";
}
else if($_GET['page'] == "login"){
    $page = "src/auth/login.php";
}
else if($_GET['page'] == "create"){
    $page = "src/admin/create.php";
}
else if($_GET['page'] == "modify" ){
    $page = "src/admin/modify.php";
}
else if($_GET['page'] == "logout"){
    $page = "src/admin/logout.php";
}
else if($_GET['page'] == "cart"){
    $page = "src/items/cart.php";
}
else if($_GET['page'] == "admin"){
    $page = "src/admin/admin.php";
}
else if($_GET['page'] == "profile"){
    $page = "src/admin/profile.php";
}
else if($_GET['page'] == "delete_user"){
    $page = "src/admin/delete_user.php";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My portfolio of services</title>
</head>
<body>
    
</body>
</html>