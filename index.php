<?php
session_start();
include("install.php");

if(!isset($_GET['page']) || $_GET['page'] == "home")
{
    $page = "php/pages/home.php";
}
else if($_GET['page'] == "items"){
    $page = "php/items/items.php";
}
else if($_GET['page'] == "login"){
    $page = "php/users/login.php";
}
else if($_GET['page'] == "create"){
    $page = "php/users/create.php";
}
else if($_GET['page'] == "modify" ){
    $page = "php/users/modify.php";
}
else if($_GET['page'] == "logout"){
    $page = "php/users/logout.php";
}
else if($_GET['page'] == "cart"){
    $page = "php/items/cart.php";
}
else if($_GET['page'] == "admin"){
    $page = "php/admin/admin_users.php";
}
else if($_GET['page'] == "delete_user"){
    $page = "php/users/delete_user.php";
}
?>

<!DOCTYPE html>
<head>
    <title>Our portfolio of services</title>
    <link href="css/home.css" rel="stylesheet">
    <link href="css/navbar.css" rel="stylesheet">
    <link href="css/items.css" rel="stylesheet">
    <link href="css/login.css" rel="stylesheet">
    <link href="css/cart.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar">
        <ul>
            <li><a href="index.php?page=home">HOME</a></li>
            <li><a href="index.php?page=items&category=0">ALL SERVICES</a>
                <ul class ="dropdown">
                    <li><a href="index.php?page=items&category=1"></a>WEB</li>
                    <li><a href="index.php?page=items&category=2"></a>C</li>
                    <li><a href="index.php?page=items&category=3"></a>DEVOPS</li>
                    <li><a href="index.php?page=items&category=4"></a>CONSULTING</li>
                </ul>
            </li>
                <?php
                    if ($_SESSION['loggued_on_user'] == "")
                    {
                        echo "<li> <a href=\"index.php?page=login\">Login</a></li>";
                    }
                    else 
                    {
                        echo "<li> <a href=\"index.php?page=modify\">Edit Password</a></li>";
                        echo "<li> <a href=\"index.php?page=logout\">Log Out</a></li>";
                    }
                ?>
            <li><a href="index.php?page=cart">BASKET</a></li>
        </ul>
    </nav>
    <div class="contents-under">
            <?php include $page; ?>
    </div>
</body>
</html>
