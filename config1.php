<?php

//$con = mysqli_connect("localhost", "root", "", "etms_db");

$con = mysqli_connect("localhost", "spyderindia_root","Soulsoft@2023","spyderindia_etms_db");

// Check connection
if ($con) {
    echo "connection_success";
    // exit();
}
