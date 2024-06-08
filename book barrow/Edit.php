<?php
include("connect.php");

$BorrowIDD = $_GET['Editid'];

// Fetch existing data
$allData = "SELECT * FROM bookborrower WHERE borrow_id = '$BorrowIDD'";
$result = mysqli_query($conn, $allData);
$row = mysqli_fetch_assoc($result);

$BorrowID = $row["borrow_id"];
$BookID = $row["book_id"];
$MemberID = $row["member_id"];
$Borrow_status = $row["borrow_status"];
$Modified_date = $row["borrower_date_modified"];

if (isset($_POST['submit'])) {
    $BorrowID = $_POST["BorrowID"];
    $BookID = $_POST["BookID"];
    $MemberID = $_POST["MemberID"];
    $Borrow_status = $_POST["Borrow_status"];
    $Modified_date = $_POST["Modified_date"];

    // Check if the new book_id exists in the book table
    $checkBookSQL = "SELECT * FROM book WHERE book_id = '$BookID'";
    $resultBook = mysqli_query($conn, $checkBookSQL);
    $isBook = mysqli_num_rows($resultBook) > 0;

    if ($isBook) {
        $sql = "UPDATE bookborrower SET borrow_id = '$BorrowID', book_id = '$BookID', member_id = '$MemberID', borrow_status = '$Borrow_status', borrower_date_modified = '$Modified_date' WHERE borrow_id = '$BorrowIDD'";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo "<script>alert('Data updated successfully.');</script>";
        } else {
            echo "<script>alert('Error updating data.');</script>". mysqli_error($conn);
        }
    } else {
        echo "<script>alert('Error: Book ID does not exist.');</script>";
        
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Book Borrow System - Admin Panel</title>
    <link rel="stylesheet" href="Book_barrow.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h1 style="text-align: center;">Book Borrow System - Updating Panel</h1>
    <a href="Display.php" style=" float:right; top:10px;"><button class="btn btn-primary">Barrow Book List</button></a>

    <form method="post">
        <div class="mb-3">
            <label for="BorrowID" class="form-label">Borrow ID</label>
            <input type="text" name="BorrowID" id="BorrowID" class="form-control" value="<?php echo $BorrowID; ?>" required/>
        </div>

        <div class="mb-3">
            <label for="BookID" class="form-label">Book ID</label>
            <input type="text" name="BookID" id="BookID" class="form-control" value="<?php echo $BookID; ?>" required/>
        </div>

        <div class="mb-3">
            <label for="MemberID" class="form-label">Member ID</label>
            <input type="text" name="MemberID" id="MemberID" class="form-control" value="<?php echo $MemberID; ?>" required/>
        </div>

        <div class="mb-3">
            <label for="Borrow_status" class="form-label">Borrow Status</label>
            <select name="Borrow_status" id="Borrow_status" class="form-select" required>
                <option value="available" <?php echo ($Borrow_status == 'available') ? 'selected' : ''; ?>>Available</option>
                <option value="borrowed" <?php echo ($Borrow_status == 'borrowed') ? 'selected' : ''; ?>>Borrowed</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="Modified_date" class="form-label">Modified Date</label>
            <input type="datetime-local" name="Modified_date" id="Modified_date" class="form-control" value="<?php echo $Modified_date; ?>" required/>
        </div>

        <input type="submit" class="btn btn-primary" name="submit" value="Update">
    </form>
</div>
</body>
</html>
