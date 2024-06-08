<?php
include ("connect.php");
include ("Display.php");

if(isset($_GET['Deleteid'])){
    $BorrowIDD=($_GET["Deleteid"]);
    $sql="DELETE FROM bookborrower WHERE borrow_id='$BorrowIDD'";
    mysqli_query($conn,$sql);
    if($sql){
//echo "delete suc";
header("location:Display.php");
    }
    else{
        echo "delete not";
    }
}
?>