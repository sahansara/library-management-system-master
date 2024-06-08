<?php
    include('get_members.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Records</title>
    <link rel="stylesheet" href="bootstrap.min.css">
    <style>
        body {
            background-color: #ffffff; /* Light dark grey color */
        }
        .card {
            border: 1px solid black; /* Black border for the card */
            border-radius: 15px; /* Rounded corners */
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Slight shadow for a lifted effect */
        }
        .card-header {
            text-align: center;
            font-weight: bold;
            color: black;
            font-size: 24px;
        }
        .table thead th {
            background-color: #007bff; /* Blue header */
            color: white;
        }
        .table tbody tr:hover {
            background-color: #f1f1f1; /* Light grey on hover */
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h2 class="text-center mb-4">Member Records</h2>"> 
                <div class="card">
                    <div class="card-header">
                        
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Member ID</th>
                                    <th>Firstname</th>
                                    <th>Lastname</th>
                                    <th>Birthday</th>
                                    <th>Email address</th>
                                </tr>
                            </thead>
                            <tbody id="membersTableBody">

                                <?php
                                $sql = "SELECT * FROM member";
                                $result = $conn->query($sql);
                            
                            
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row['member_id'] . "</td>";
                                    echo "<td>" . $row['first_name'] . "</td>";
                                    echo "<td>" . $row['last_name'] . "</td>";
                                    echo "<td>" . $row['birthday'] . "</td>";
                                    echo "<td>" . $row['email'] . "</td>";
                                    echo "</tr>";
                                }
                                ?>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>
</html>
