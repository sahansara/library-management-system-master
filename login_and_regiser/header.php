<?php 
     session_start();
?> 
<!DOCTYPE html>
<html>
<head>
    <title>Library Staff Login</title>
    
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" type="text/css" href="/library-management-system-master/login_and_regiser/login.css">


</head>
    <!-- Navigation Bar -->
    <nav>
      <div class="logo">
        <img src="../home page/user/img/book.jpg" alt="Logo" />
        <h1>Library Management System</h1>
      </div>
      <ul>
        <li><a href="../home page/user/home.php">Home</a></li>
        <li><a href="#services">Services</a></li>
        <li><a href="#contact">Contact</a></li>
        <?php
        if (isset($_SESSION["name_user"]))
        // admin panal. ist can use only admin
    {
            if (isset($_SESSION["user_admin"]) && $_SESSION["user_admin"] === true) {
                echo '<li><a href="/library-management-system-master/login_and_regiser/admin.php">Admin Panel</a></li>';
            }           
                        echo '<li style="float:left"><a href="#">'. $_SESSION["name_user"] .'</a> </li>';   
                        echo '<li style="float:right"> <a href="/library-management-system-master/login_and_regiser/include/logout.include.php">logout <a> </li>';
                                        
                     } else {
                        echo  '<li style="float:right"><a href="/library-management-system-master/login_and_regiser/login.php"> login </a> </li>';
                      }
                    
          ?>
      </ul>
    </nav>
<body id="login-body">
   
    
<div class="container" id="login-container">
