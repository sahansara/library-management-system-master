<?php
include ("connect.php");
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
      /* Additional custom styles */
      .table-responsive {
        margin-top: 20px;
      }
      .btn-container {
        display: flex;
        justify-content: center;
        margin: 20px 0;
      }
      .btn-container .btn {
        margin: 0 10px;
      }
    </style>
  </head>
  <body>
    <div class="container">
    <h1 style="text-align: center;">Book Borrow Details</h1>
      <div class="btn-container">
        <a href="Book_barrow.php"><button class="btn btn-primary">Add Book</button></a>
      </div>
    </div>
    <div class="container">
      <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">Borrow ID</th>
              <th scope="col">Book ID</th>
              <th scope="col">Member ID</th>
              <th scope="col">Borrow Status</th>
              <th scope="col">Borrow Date</th>
              <th>Edit Options</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $allData = "SELECT * FROM bookborrower";
            $result = mysqli_query($conn, $allData);
            if ($result) {
              while ($row = mysqli_fetch_assoc($result)) {
                $BorrowID = $row["borrow_id"];
                $BookID = $row["book_id"];
                $MemberID = $row["member_id"];
                $Modified_date = $row["borrow_status"];
                $Borrow_status = $row["borrower_date_modified"];
                echo '<tr>
                        <th scope="row">' . $BorrowID . '</th>
                        <td>' . $BookID . '</td>
                        <td>' . $MemberID . '</td>
                        <td>' . $Modified_date . '</td>
                        <td>' . $Borrow_status . '</td>
                        <td>
                          <a href="Edit.php?Editid='.$BorrowID.'"><button class="btn btn-primary btn-sm" name="edit">Edit</button></a>
                          <a href="Delete.php?Deleteid='.$BorrowID .'"><button class="btn btn-danger btn-sm" name="delete">Delete</button></a>
                          
                        </td>
                      </tr>';
              }
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
