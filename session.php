<?php
session_start();
if (!isset($_SESSION['guid'])) {
    header("location:login.php");
    return;
}
