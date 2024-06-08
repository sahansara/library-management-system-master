<?php

    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "library_system";
    
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if($_SERVER['REQUEST_METHOD']=="POST"){
        $member_id = $_POST['memberId'];

        $sql = "DELETE FROM member WHERE member_id = '$member_id'";

        $result = $conn->query($sql);

        if($result){
            die("Member deleted successfully");
        }
        else{
            die("No member from this member id");
        }
    }
    
?>
