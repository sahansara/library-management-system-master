<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "library_system";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $member_id = $_POST["reg_member_id"];
    $firstname = $_POST["reg_firstname"];
    $lastname = $_POST["reg_lastname"];
    $birthday = $_POST["reg_birthday"];
    $email = $_POST["reg_email"];

    $sql = "INSERT INTO member (member_id, first_name, last_name, birthday, email)
            VALUES ('$member_id', '$firstname', '$lastname', '$birthday', '$email')";

    if ($conn->query($sql) === TRUE) {
        echo "New member registered successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
