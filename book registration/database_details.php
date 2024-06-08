<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Database Details</title>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<style>
    .highlight {
        background-color: yellow;
    }
    .form-inline .form-control {
        width: auto;
        flex: 1;
    }
    .table-responsive {
        margin-top: 20px;
    }
    .custom-button {
        margin-top: 10px;
    }
</style>
<script>
    window.onload = function() {
        if (window.history && window.history.pushState) {
            window.history.pushState(null, null, document.URL);
            window.addEventListener('popstate', function () {
                window.location.assign('book_registration_index.php');
            });
        }
    }
</script>
</head>
<body>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center">
        <h2>Database Details</h2>
        
        <form method='post' action='book_registration_index.php' class="custom-button">
            <button type='submit' class="btn btn-dark">Back to Book Registration</button>
        </form>
    </div>
    <br>
    <form method="post" class="form-inline mt-3">
        <label for="search_book_id" class="mr-2">Search Book ID (B001) :</label>
        <input type="text" id="search_book_id" name="search_book_id" class="form-control mr-2">
        <button type="submit" name="search" class="btn btn-primary">Search</button>
    </form>
    <br>
    <?php
    require 'connection.php';

    function showMessageSuccess($message) {
        echo "
        <br>
        <div class='alert alert-success' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
            </button>
            <h4 class='alert-heading'>Done!</h4>
            <hr/>
            <p>$message</p>
            
        </div>";

    }function showMessageError($message) {
        echo "
        <div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>$message</strong>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>";
    }

    function checkIfBorrowed($conn, $book_id) {
        $sql = "SELECT borrow_id FROM bookborrower WHERE book_id = ? AND borrow_status = 'borrowed'";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            showMessageError("Error: " . $conn->error);
            return false;
        }
        $stmt->bind_param("s", $book_id);
        $stmt->execute();
        $stmt->bind_result($borrow_id);
        if ($stmt->fetch()) {
            $stmt->close();
            return $borrow_id;
        }
        $stmt->close();
        return false;
    }
    $highlighted_book_id = null;
    if (isset($_POST['search'])) {
        $highlighted_book_id = $_POST['search_book_id'];
        $bookFound = false;
        $sql = "SELECT book_id FROM book WHERE book_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $highlighted_book_id);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $bookFound = true;
        }
        $stmt->close();
        if (!$bookFound) {
            echo "<br>";
            showMessageError("Book ID $highlighted_book_id not found.");
        }
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['delete_record'])) {
            $book_id = $_POST['book_id'];
            $borrow_id = checkIfBorrowed($conn, $book_id);
            if ($borrow_id) {
                echo "<br>";
                showMessageError("This book has been borrowed under a borrow ID: " . $borrow_id);
            } else {
                $sql = "DELETE FROM book WHERE book_id = ?";
                $stmt = $conn->prepare($sql);
                if ($stmt === false) {
                    showMessageError("Error: " . $conn->error);
                } else {
                    $stmt->bind_param("s", $book_id);
                    if ($stmt->execute()) {
                        showMessageSuccess("Record with Book ID $book_id deleted successfully.");
                    } else {
                        showMessageError("Error deleting record: " . $stmt->error);
                    }
                    $stmt->close();
                }
            }
        } elseif (isset($_POST['update_record'])) {
            $book_id = $_POST['book_id'];
            $book_name = $_POST['book_name'];
            $category_id = $_POST['category_id'];
            $borrow_id = checkIfBorrowed($conn, $book_id);
            if ($borrow_id) {
                showMessageError("This book has been borrowed under a borrow ID: " . $borrow_id);
            } else {
                $sql = "UPDATE book SET book_name = ?, category_id = ? WHERE book_id = ?";
                $stmt = $conn->prepare($sql);
                if ($stmt === false) {
                    showMessageError("Error: " . $conn->error);
                } else {
                    $stmt->bind_param("sss", $book_name, $category_id, $book_id);
                    if ($stmt->execute()) {
                        showMessageSuccess("Record with Book ID $book_id updated successfully.");
                    } else {
                        showMessageError("Error updating record: " . $stmt->error);
                    }
                    $stmt->close();
                }
            }
        }
    }
    $sql = "SELECT book_id, book_name, category_id FROM book";
    $result = $conn->query($sql);
    if ($result === false) {
        showMessageError("Error: " . $conn->error);
    } else {
        if ($result->num_rows > 0) {
            echo "<div class='table-responsive mt-4'>";
            echo "<table class='table table-bordered'>";
            echo "<thead class='thead-dark'><tr><th>Book ID</th><th>Book Name</th><th>Category ID</th><th>Delete</th><th>Edit</th></tr></thead>";
            echo "<tbody>";
            while ($row = $result->fetch_assoc()) {
                $book_id = $row['book_id'];
                $book_name = $row['book_name'];
                $category_id = $row['category_id'];
                $highlightClass = ($highlighted_book_id && $highlighted_book_id == $book_id) ? 'highlight' : '';
                echo "<tr class='$highlightClass'>";
                echo "<td id='book_$book_id'>" . $book_id . "</td>";
                echo "<td>" . $book_name . "</td>";
                echo "<td>" . $category_id . "</td>";
                echo "<td>";
                echo "<form method='post' align='center' style='margin-left:auto; margin-right:auto;' style='display:inline;'>";
                echo "<input type='hidden' name='book_id' value='$book_id'>";
                echo "<button type='submit' name='delete_record' class='btn btn-danger'>Delete</button>";
                echo "</form>";
                echo "</td>";
                echo "<td>";
                echo "<form method='post' align='center' style='margin-left:auto; margin-right:auto;' style='display:inline;'>";
                echo "<input type='hidden' name='book_id' value='$book_id'>";
                echo "<button type='submit' name='edit_record' class='btn btn-dark'>Edit</button>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
                if (isset($_POST['edit_record']) && $_POST['book_id'] == $book_id) {
                    $borrow_id = checkIfBorrowed($conn, $book_id);
                    if ($borrow_id) {
                        showMessageError("This book has been borrowed under a borrow ID: ". $borrow_id);
                    } else {
                        $sql = "SELECT book_name, category_id FROM book WHERE book_id = ?";
                        $stmt = $conn->prepare($sql);
                        if ($stmt === false) {
                            showMessageError("Error: " . $conn->error);
                        } else {
                            $stmt->bind_param("s", $book_id);
                            $stmt->execute();
                            $stmt->bind_result($book_name, $category_id);
                            $stmt->fetch();
                            $stmt->close();
                            echo "<tr><td colspan='5'>";
                            echo "<div style='display: inline;'>";
                            echo "<form method='post' class='form-inline'>";
                            echo "<input type='hidden' name='book_id' value='$book_id'>";
                            echo "<label for='book_name' class='mr-2'>Book Name:</label>";
                            echo "<input type='text' id='book_name' name='book_name' value='$book_name' class='form-control mr-2' required>";
                            echo "<label for='category_id' class='mr-2'>Category ID:</label>";
                            echo "<select id='book_category' name='category_id' class='form-control mr-2' required>";
                            echo "<option value='C001' " . ($category_id == 'C001' ? 'selected' : '') . ">Sci-fi</option>";
                            echo "<option value='C002' " . ($category_id == 'C002' ? 'selected' : '') . ">Adventure</option>";
                            echo "</select>";
                            echo "<button type='submit' name='update_record' class='btn btn-dark'>Update Record</button>";
                            echo "</form>";
                            echo "</div>";
                            echo "</td></tr>";
                        }
                    }
                }
            }
            echo "</tbody>";
            echo "</table>";
            echo "</div>";
        } else {
            showMessage("No records found.");
        }
    }
    $conn->close();
    ?>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

