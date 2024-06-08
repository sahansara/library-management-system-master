<?php
include_once 'header.php';


?>

<h1 class="h_admin" > Welcome to the Admin user </t> <b> <u><?php echo $_SESSION['name_user']; ?>! </u> </b></h1>
<br> <br>

<?php
require_once 'include/include.database.php';


//show a data base for admin //
$code_sql = "SELECT * FROM user";
$code_statement= mysqli_query($db_conn, $code_sql);

if (mysqli_num_rows($code_statement) > 0) {
    echo "<table class='table'>";
    echo "<thead><tr><th>User ID</th><th>First Name</th><th>Last Name</th><th>Username</th><th>Email</th><th>Actions</th></tr></thead>";
    echo "<tbody>";
    while ($tupple= mysqli_fetch_assoc($code_statement)) {
        echo "<tr>";
        echo "<td>" . $tupple['user_id'] . "</td>";
        echo "<td>" . $tupple['first_name'] . "</td>";
        echo "<td>" . $tupple['last_name'] . "</td>";
        echo "<td>" . $tupple['username'] . "</td>";
        echo "<td>" . $tupple['email'] . "</td>";
        echo "<td>
        <a href='user_update.php?user_id=" . $tupple['user_id'] . "'>Update</a> |
        <a href='user_delete.php?user_id=" . $tupple['user_id'] . "'>Delete</a></td>";

        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
     // display all error message for users //
    if(isset($_GET["error"])) {
        if ($_GET["error"] == "updated!" ) {
               echo '<div class="mistake_error"  style="margin:auto" > user input update success! </div>';
    
            } }

        if(isset($_GET["error"])) {
        if ($_GET["error"] == "user_delete!" ) {
        echo '<div class="mistake_error"  style="margin:auto" >delete user sucess! </div>';

        } }
} else {
    echo "No users found.";
}

include_once 'footer.php';
?>
