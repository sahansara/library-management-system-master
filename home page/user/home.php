<?php 
     session_start();
?> 
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Library Management System</title>
    <link rel="stylesheet" href="styles.css" />
  </head>
  <body>
    <!-- Navigation Bar -->
    <nav>
      <div class="logo">
        <img src="./img/book.jpg" alt="Logo" />
        <h1>Library Management System</h1>
      </div>
      <ul>
        <li><a href="#home">Home</a></li>
        <li><a href="#services">Services</a></li>
        <li><a href="#contact">Contact</a></li>
        <?php
        if (isset($_SESSION["name_user"]))
        //uncomplete admin panal. ist can user every one  
    {
            if (isset($_SESSION["user_admin"]) && $_SESSION["user_admin"] === true) {
                echo '<li><a href="/library-management-system-master/home page/admin/home.html">Admin Panel</a></li>';
            }           
                        echo '<li style="float:right"><a href="#">'. $_SESSION["name_user"] .'</a> </li>';   
                        echo '<li style="float:right"> <a href="/library-management-system-master/login_and_regiser/include/logout.include.php">logout <a> </li>';
                                        
                     } else {
                        echo  '<li style="float:right"><a href="/library-management-system-master/login_and_regiser/login.php"> login </a> </li>';
                      }
                    
          ?>
      </ul>
    </nav>

    <!-- Hero Section -->
    <section id="hero">
      <div class="hero-content">
        <h1>Welcome to the Library Management System</h1>
        <p>Your gateway to a world of knowledge</p>
      </div>
    </section>

    <!-- Home Section -->
    <section id="home">
      <h2>One Knowledge Partner for you</h2>
      <p>
        Welcome to the home section of our library management system. Here you
        can find a comprehensive collection of books, journals, and digital
        resources to aid your learning and research.
      </p>
    </section>

    <!-- Services Section -->
    <div class="card-con">
      <h1 id="services">Services</h1>
      <section id="features">
        <div class="card">
          <img
            src="./img/memberReg.png"
            alt="Member Registration"
            class="card-image"
          />
          <div class="card-content">
            <h3>Member Registration</h3>
          </div>
        </div>
        <div class="card">
          <img src="./img/barrow.jpeg" alt="Book Borrow" class="card-image" />
          <div class="card-content">
            <h3>Book Borrow</h3>
          </div>
        </div>
        <div class="card">
          <img
            src="./img/bookReg.jpeg"
            alt="Book Registration"
            class="card-image"
          />
          <div class="card-content">
            <h3>Book Registration</h3>
          </div>
        </div>
        <div class="card">
          <img src="./img/login.png" alt="Login" class="card-image" />
          <div class="card-content">
            <h3>Login & Registration</h3>
            <a href="/library-management-system-master/login_and_regiser/login.php" class="btn btn-primary">Login & Registration</a>
          </div>
        </div>
      </section>
    </div>

    <!-- Read Image Section -->
    <section class="readImg">
      <img src="./img/read.png" alt="Reading" />
      <div class="read-content">
        <h2>About Our Library</h2>
        <p>
          Our library offers a vast collection of books across various genres,
          providing resources for education, research, and leisure reading. We
          are committed to fostering a love for reading and learning in our
          community. Our friendly staff are here to assist you with finding the
          right materials and using our services effectively.
        </p>
        <a href="#more" class="btn-read-more">Learn More</a>
      </div>
    </section>

    <!-- Contact Section -->
    <section id="contact">
      <h2>Contact</h2>
      <p>Contact us for more information or assistance.</p>
      <img src="../../home page/user/img/svgs/email_24dp.svg" alt="" />
      <p>Email: library@domain.com</p>
      <img src="../../home page/user/img/svgs/phone_24dp.svg" alt="" />
      <p>Phone: (123) 456-7890</p>
      <img src="../../home page/user/img/svgs/home_24dp.svg" alt="" />
      <p>Address: 123 Library Lane, Booktown</p>
    </section>

<!-- SignUp Section -->
<section id="signup">
  <h2>SignUp</h2>
  <p>Sign up to become a member of our library.</p>
  <a href="/library-management-system-master/login_and_regiser/Signup.php" class="btn-signup">Sign Up Now</a>
</section>

  </body>
</html>
