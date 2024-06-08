<?php

// this is a user register sesions codes link to sinup.php and sinup.include,php file.(database connections add name db_conn)//
// first function check empty data //
function emptysignup($firstName,$lastName,$userName,$userId,$email,$password,$passRepeat) {
      $output;
      if(empty($firstName) || empty($lastName) || empty($userName) || empty($userId) || empty($email) || empty($password) || empty($passRepeat)) {
        
       $output = true;

      } else {
        $output=false;
      }
      return $output;
    }

 // this use to add only given  password petten //
 function invalidUid($userId) {
  $output;
  if (!preg_match("/^U[0-9]+$/", $userId)) {
      $output = true;
  } else {
      $output = false;
  }
  return $output;
}

//check email validations //
 function invalidEmail($email) {
    $output;
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
      
     $output = true;

    } else {
      $output=false;
    }
    return $output;
}
//check same password //
function samePass($password, $passRepeat) {
  $output;
  if ($password !== $passRepeat || strlen($password) < 8) {
      $output = true;
  } else {
      $output = false;
  }
  return $output;
}

// check repeat email or username or user id use bind parameters //
function repeatUid($db_conn ,$userId,$email,$userName) {
    $code_sql="SELECT * FROM user  WHERE user_id =? OR email=? OR username =?;";
    $code_statement=mysqli_stmt_init($db_conn);
    if(!mysqli_stmt_prepare($code_statement,$code_sql)) {
        header("Location:../signup.php?error=codefailed");
        exit();
    }
    mysqli_stmt_bind_param($code_statement,"sss",$userId,$email,$userName);
    mysqli_stmt_execute($code_statement);
    $sql_data=mysqli_stmt_get_result($code_statement);

    if ($tupple=mysqli_fetch_assoc($sql_data)) {
        return $tupple ;
    }else {
        return  false;
    }
    mysqli_stmt_close($code_statement);
}
 //finaly create a user account and add a user data in library data base  //
function create_Account($db_conn, $firstName, $lastName, $userName, $userId, $email, $password) {

  $code_sql = "INSERT INTO user (user_id, email, first_name, last_name, username, password) VALUES (?, ?, ?, ?, ?, ?);";
  $code_statement = mysqli_stmt_init($db_conn);

  if (!mysqli_stmt_prepare($code_statement, $code_sql)) {
      header("Location: ../signup.php?error=codefailed");
      exit();
  }
  //use hash password this a safe method //
  $hide_password = password_hash($password, PASSWORD_DEFAULT);

  mysqli_stmt_bind_param($code_statement, "ssssss", $userId, $email, $firstName, $lastName, $userName, $hide_password);
  mysqli_stmt_execute($code_statement);
  mysqli_stmt_close($code_statement);
  header("Location: ../login.php?error=create_account!");
  exit();
}

// this is a user login sesions code link to login.php and login.include.php file.(database connections add name db_conn)//
//check again empty input//
function empty_datalogin($user_Name,$user_password)  {

  $output;
  if(empty($user_Name) || empty($user_password)) {
    
   $output = true;

  } else {
    $output=false;
  }
  return $output;
}
//check validations //
function Login_user($db_conn,$user_Name,$user_password) {
  $check_input=repeatUid($db_conn ,$user_Name,$user_Name,$user_Name);
  if($check_input==false) {
    header("location:../login.php?error=unvalid_userinputs");
    exit();
  }
  $hide_password=$check_input["password"];
  $check_password=password_verify($user_password,$hide_password);

  if ($check_password === false) {
    header("location:../login.php?error=invalid_password");
    exit();
  } 
  elseif($check_password === true ){ 
    session_start(); //session start for user login //
    $_SESSION["id_user"]=$check_input["user_Name"];
    $_SESSION["name_user"]=$check_input["username"];
   
    //when login user check a user id wheter match in database use checkinput function// 
    if ($check_input["user_id"] === "U001" || $check_input["email"] === "kamal@gmail.com" ) {
          $_SESSION["user_admin"] = true;
          
      } else {
          $_SESSION["is_admin"] = false;
      }


    header("location:../../home page/user/home.php?error=success_login");
    exit();
  }
} 

/* <h1>This is home page</h1>

<h1>hellow world  <?php  
if(isset($_SESSION["name_user"])) {
   echo $_SESSION["name_user"] . "!";
} else {
   echo "user !" ;
}
?>

</h1> */