<?php

$mysqli = new mysqli("localhost", "spyderindia_root","Soulsoft@2023","spyderindia_etms_db");

//$mysqli = new mysqli("localhost", "root", "", "etms_db");

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
