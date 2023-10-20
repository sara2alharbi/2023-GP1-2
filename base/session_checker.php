<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
}
$userName = $_SESSION["user"];
$userEmail = $_SESSION["email"];

?>