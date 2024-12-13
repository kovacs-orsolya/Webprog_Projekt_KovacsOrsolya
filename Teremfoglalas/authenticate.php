<?php
session_start();
include_once("imports.php");

if (!isset($_POST['email'], $_POST['password'])) {
    exit('Please fill both the username and password fields!');
}
UserService::loginUser($_POST['email'], $_POST['password']);

?>
