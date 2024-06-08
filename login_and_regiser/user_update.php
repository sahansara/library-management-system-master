<?php
include_once 'header.php';
require_once 'include/include.database.php';
   
//get a user id use get method 

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    $code_sql = "SELECT * FROM user WHERE user_id = ?"; //use select keyword for get a user id full tupple.
    $code_statement = mysqli_prepare($db_conn, $code_sql);
    mysqli_stmt_bind_param($code_statement, 's', $user_id);
    mysqli_stmt_execute($code_statement);
    $sql_data = mysqli_stmt_get_result($code_statement); 
     //assing a user data variable name tupple,
    if ($tupple= mysqli_fetch_assoc($sql_data)) {
        
        ?>
        <form action="user_update.php" method="post">
            <div class="box"> 
            <input type="hidden" name="user_id" value="<?php echo $tupple['user_id']; ?>">
            
                <label for="first_name">Update:First Name</label>
                <input type="text" id="first_name" name="first_name" value="<?php echo $tupple['first_name']; ?>">
                
                <label for="last_name">Update:Last Name</label>
                <input type="text" id="last_name" name="last_name" value="<?php echo $tupple['last_name']; ?>">
                 
                <label for="username">Update:Username</label>
                <input type="text" id="username" name="username" value="<?php echo $tupple['username']; ?>">
                <div>
                <label for="email">Update:Email</label> <br>
                <input type="email" id="email" name="email" value="<?php echo $tupple['email']; ?>">
                </dIv>
                <button type="submit" name="user_data" class="btn">Update Now</button>
            </div>
        </form>
        <?php
    } else {
        echo "sorry.can't userdetails find. please tryagin!";
    } // save a new value in pre variable
} elseif (isset($_POST['user_data'])) {
    $user_id = $_POST['user_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];


    $code_sql = "UPDATE user SET first_name = ?, last_name = ?, username = ?, email = ? WHERE user_id = ?";
    $code_statement = mysqli_prepare($db_conn, $code_sql); //new value update a database use sql code.
    mysqli_stmt_bind_param($code_statement, 'sssss', $first_name, $last_name, $username, $email, $user_id);
    if (mysqli_stmt_execute($code_statement)) {
        header("Location:admin.php?error=updated!"); //finaly after update a user data go to back admin.php page use location .
    } else {
        echo "user details not update please tryagain!";
    }
} else {
    echo "somthig went wrong! ";
}

include_once 'footer.php';
?>
