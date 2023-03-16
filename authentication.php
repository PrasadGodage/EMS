<?php

$mysqli = new mysqli("localhost", "wwwsoulsoft_dev","0pezkIMj*u*.","wwwsoulsoft_etms_db");

// Check connection
if (!$mysqli) {
  die("Connection failed: " . mysqli_connect_error());
}
ob_start();
session_start();
require 'classes/admin_class.php';
$obj_admin = new Admin_Class();

if (isset($_GET['logout'])) {
	$obj_admin->admin_logout();
}
