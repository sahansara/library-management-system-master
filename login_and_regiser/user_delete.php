<?php 
include_once "header.php";
require_once "include/include.database.php";
   //get a user user id use get method 
if (!isset($_GEt["user_id"])) {
    $user_id=$_GET["user_id"];
    $code_sql="DELETE FROM user WHERE user_id= ?";
    $code_statement=mysqli_prepare($db_conn,$code_sql);
    mysqli_stmt_bind_param($code_statement,"s",$user_id); //bind parameters 
    
    if(mysqli_stmt_execute($code_statement)) {
        header("Location:admin.php?error=user_delete!");
        

    }else {
        echo "can't delete user . please try again!";
    }

}else {
    echo "something went wrong! try again";
}

include_once "footer.php";