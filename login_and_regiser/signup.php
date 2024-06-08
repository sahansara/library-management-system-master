<?php 
       include_once'header.php';
?>
        <form action="include/signup.include.php" method="post" class="mt-4">
        <div class="box" style=" height: 900px" > 
        <br>
        <h2 class="hid">Library Staff signup </h2>
        <br>
        <br>
        
            <div class="form-group">
            <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Enter your first name " required>
            </div>

            <div class="form-group">
            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Enter your last name " required>
            </div>

            <div class="form-group">
            <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username " required>
            </div>

            
            <div class="form-group">
            <input type="text" class="form-control" id="userid" name="userid" placeholder="Enter your  user id" required>
            </div>


            <div class="form-group">
            <input type="text" class="form-control" id="email" name="email" placeholder="Enter your Email address " required>
            </div>

            <div class="form-group">
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter your Password " required>
            </div>

            <div class="form-group">
            <input type="password" class="form-control" id="pass_repeat" name="pass_repeat" placeholder="Enter your Password again" required>
            </div>


            <button name="submit" type="submit" class="btn">Signup</button>

              <!-- display error for users name it mean error handle -->
            
            <?php 
               if(isset($_GET["error"])) {
                     if ($_GET["error"] == "empty_data" ) {
                            echo '<div class="mistake_error" > check again ! must be fill all textboxs </div>';
                     } else if 
                            ($_GET["error"] == "invalid_userid" ) {
                                   echo '<div class="mistake_error" > check again ! The user name enterd is not valid </div>';

                     }  else if 
                     ($_GET["error"] == "invalid_email" ) {
                            echo '<div class="mistake_error" > check again ! The email addres enterd is not valid </div>';
                    }  else if 
                       ($_GET["error"] == "dontmatch_password" ) {
                           echo '<div class="mistake_error" > check again ! The paswords is wrong </div>';
                    } else if 
                    ($_GET["error"] == "repeat_username" ) {
                        echo '<div class="mistake_error" > check again ! repeat id or email or userid </div>';
                    
              } }
               ?>


            
            <p class="link"> <br> 
                     Already you have an account ? 
					<a href="login.php">login now </a> Here </p>
					<p class="paragrph">Log in With</p>
        </div>
        </form>
<?php 
       include_once'footer.php';
?>