<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "library_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $member_id = $_POST["update_member_id"];
    $firstname = $_POST["update_firstname"];
    $lastname = $_POST["update_lastname"];
    $birthday = $_POST["update_birthday"];
    $email = $_POST["update_email"];

    $fields = [];
    if ($firstname) $fields[] = "first_name='$firstname'";
    if ($lastname) $fields[] = "last_name='$lastname'";
    if ($birthday) $fields[] = "birthday='$birthday'";
    if ($email) $fields[] = "email='$email'";

    if (!empty($fields)) {
        $sql = "UPDATE member SET " . implode(", ", $fields) . " WHERE member_id='$member_id'";

        if ($conn->query($sql) === TRUE) {
            echo "Member updated successfully";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } else {
        echo "No fields to update";
    }

    $conn->close();
}
?>
