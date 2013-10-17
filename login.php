<?php
require('sample.php');
session_start();
if (isset($_POST['email']) && isset($_POST['pass'])) {
    if (isset($_POST['login'])) {
        if ($app->login($_POST['email'], $_POST['pass'])) {
            $_SESSION['guid'] = $app->get_guid($_POST['email']);
            header("location:index.php");
        }
    }
    else if (isset($_POST['register'])) {
        $app->register($_POST['email'], $_POST['pass']);
        $_SESSION['guid'] = $app->get_guid($_POST['email']);
        $twonet->user_register($_SESSION['guid']);
        header("location:index.php");
    }
}
?>
<!DOCTYPE HTML>
<html lang="en" dir="ltr">
<head>
    <title>Diabetes management made easy</title>
    <meta charset="utf-8" />
    <meta name="description" content="A mobile newspaper template homepage" />
    <meta name="viewport" content="initial-scale=1, maximum-scale=1" />
    <link rel="stylesheet" type="text/css" href="style.css" />
    <!--SET MEDIA HANDELD HERE-->
</head>
<body>
<header>
    <div id="logo">
        <div class="top-title">
            <h1><a href="index.php">Diabetes<span>Manager</span></a></h1>
        </div>
        <!--/.top-title-->
    </div>
    <!--/#logo-->
</header>
<div id="main-wrapper">
    <section class="main-content">
        <p class="device-name">Login</p>
        <hr />
        <form class="login" name="contact-form" method="post" action="login.php">
            <p><input type="text" placeholder="Username" name="email"/></p>
            <p><input type="password" placeholder="Password" name="pass"/></p>
            <p><input type="submit" name="login" value="Login"/> <input type="submit" class="register" name="register" value="Register"/></p>
        </form>
    </section>
</div>
</body>
</html>
