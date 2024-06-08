<?php 
//use isset method for get a user details //
if (isset($_POST["submit"])) {
    $user_Name=$_POST["username"];
    $user_password =$_POST["password"];

    require_once 'include.database.php';
    require_once 'function.include.php';

    if (empty_datalogin($user_Name,$user_password) !== false) {
        exit();
    }
    Login_user($db_conn,$user_Name,$user_password);

} 
else {
    header('Location:../login.php');
}