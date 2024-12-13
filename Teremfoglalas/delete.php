<?php
session_start();
include_once("imports.php");

BookingService::deleteBooking($_GET["halls_id"], $_GET["id"]);

header("Location: {$_SERVER['HTTP_REFERER']}");
exit();

?>