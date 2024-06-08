<?php

if (isset($_POST["submit"])) {
   //create variable for store a user inputs //
    $firstName=$_POST["firstname"];
    $lastName =$_POST["lastname"];
    $userName =$_POST["username"];
    $userId =$_POST["userid"];
    $email =$_POST["email"];
    $password =$_POST["password"];
    $passRepeat =$_POST["pass_repeat"];




    require_once 'include.database.php';
    require_once 'function.include.php';
    //call a functions //
    $emptyData=emptysignup($firstName,$lastName,$userName,$userId,$email,$password,$passRepeat);
    $invalid_Userid=invalidUid($userId);
    $invalid_Email=invalidEmail($email);
    $same_pass=samePass($password,$passRepeat);
    $repeat_Userid=repeatUid($db_conn ,$userId,$email,$userName);


   // errors can see url //

    if ($emptyData !== false) { 
        header("Location:../signup.php?error=empty_data");
        exit();
    }
    if ($invalid_Userid !== false) { 
        header("Location:../signup.php?error=invalid_userid");
        exit();
    }
    if ($invalid_Email !== false) { 
        header("Location:../signup.php?error=invalid_email");
        exit();
    }
    if ($same_pass!== false) { 
        header("Location:../signup.php?error=dontmatch_password");
        exit();
    }
    if ($repeat_Userid !== false) { 
        header("Location:../signup.php?error=repeat_username");
        exit();
    }

     // call create accoumt function //
    create_Account($db_conn,$firstName,$lastName,$userName,$userId,$email,$password);
   
} 
else {
    header('Location:../signup.php');
    exit();
    
}