<?php

$serverName = "localhost";
$database_username="root";
$database_password="";
$database_Name="library_system";

$db_conn = mysqli_connect($serverName,$database_username,$database_password,$database_Name);
if(!$db_conn) {
    die("Database connections is Failed :" .mysqli_connect_error());
} // database connections //