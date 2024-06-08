<?php
//db connect
$db_server = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "library_system";
$conn = "";

$conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
if (!$conn) {
    die("Failed to connect to database.");
}

if (isset($_POST['submit'])) {
    $BorrowID = $_POST["BorrowID"];
    $BookID = $_POST["BookID"];
    $MemberID = $_POST["MemberID"];
    $Borrow_status = $_POST["Borrow_status"];
    $Modified_date = $_POST["Modified_date"];

    // Check if member ID exists
    $checkMemberSQL = "SELECT * FROM member WHERE member_id = '$MemberID'";
    $resultMember = mysqli_query($conn, $checkMemberSQL);
    $isMember = mysqli_num_rows($resultMember) > 0;

    // Check if book ID exists
    $checkBookSQL = "SELECT * FROM book WHERE book_id = '$BookID'";
    $resultBook = mysqli_query($conn, $checkBookSQL);
    $isBook = mysqli_num_rows($resultBook) > 0;

    if ($isMember && $isBook) {
        $sql = "INSERT INTO bookborrower (borrow_id, book_id, member_id, borrow_status, borrower_date_modified)
        VALUES ('$BorrowID', '$BookID', '$MemberID', '$Borrow_status', '$Modified_date')";

try {
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "<script>alert('Data inserted successfully.');</script>";
    } else {
        echo "<script>alert('Failed to insert data.');</script>";
    }
} catch (Exception $e) {
    echo "<script>alert('This book is already borrowed.');</script>";
}

    } else {
        echo "<script>alert('Member or book does not exist in the library.');</script>";
    }
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Book Borrow System - Admin Panel</title>
    <link rel="stylesheet" href="Book_barrow.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Additional custom styles */
        .container {
            padding: 20px;
        }

        /* Adjust the form inputs for small screens */
        @media (max-width: 576px) {
            .mb-3 {
                margin-bottom: 15px;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <h1 style="text-align: center;">Book Borrow System - Admin Panel</h1>
    <a href="Display.php" style="float: right;"><button class="btn btn-primary" >Barrow Book List</button></a>

    <form method="post">
        <div class="mb-3">
            <label for="BorrowID" class="form-label">Borrow ID</label>
            <input type="text" name="BorrowID" id="BorrowID" class="form-control" required/>
        </div>

        <div class="mb-3">
            <label for="BookID" class="form-label">Book ID</label>
            <input type="text" name="BookID" id="BookID" class="form-control" required/>
        </div>

        <div class="mb-3">
            <label for="MemberID" class="form-label">Member ID</label>
            <input type="text" name="MemberID" id="MemberID" class="form-control" required/>
        </div>

        <div class="mb-3">
            <label for="Borrow_status" class="form-label">Borrow Status</label>
            <select name="Borrow_status" id="Borrow_status" class="form-select" required>
                <option value="available">Available</option>
                <option value="borrowed">Borrowed</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="Modified_date" class="form-label">Modified Date</label>
            <input type="datetime-local" name="Modified_date" id="Modified_date" class="form-control" required/>
        </div>

        <input type="submit" class="btn btn-primary" name="submit">
    </form>
</div>
</body>
</html>
