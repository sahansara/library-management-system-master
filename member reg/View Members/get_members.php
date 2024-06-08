<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "library_system";

    $conn = mysqli_connect($servername,$username,$password,$dbname);
    if(!$conn){
        die ("Connection failed".mysqli_connect_error());
    }



?>
