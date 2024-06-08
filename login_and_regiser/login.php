<?php 
     
       include_once 'header.php';
?>
        <form action="include/login.include.php" method="post" >
        <div class="box" > 
        <br>
        <h2 class="hid">Library Staff Login here </h2>
        <br>
        <br>
           
            <div class="form-group">
            <input type="text" class="form-control" id="username" name="username" placeholder="Enter Email Here" required>
            </div>

            <div class="form-group">
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter passwold Here" required>
            </div>

            <button name="submit" type="submit" class="btn" >Login</button>

             <!-- display error for users name it mean error handle -->
            <?php 
               if(isset($_GET["error"])) {
                     if ($_GET["error"] == "empty_data" ) {
                            echo '<div class="mistake_error" > check again ! must be fill all textboxs </div>';
                     } else if 
                            ($_GET["error"] == "unvalid_userinputs" ) {
                                   echo '<div class="mistake_error" > check again ! The user name enterd is not valid </div>';

                     }  else if 
                     ($_GET["error"] == "invalid_password" ) {
                            echo '<div class="mistake_error" > check again ! The password  is worng </div>';
                    }  else if 
                       ($_GET["error"] == "success_login" ) {
                           echo '<div class="mistake_error" > success login </div>';
                    }  else if 
                    ($_GET["error"] == "create_account!" ) {
                        echo '<div class="mistake_error" > success  create_account! </div>';
                    
               } 
              }
               ?>

            
            
            <p class="link"> <br> 
                     Don't Have An Account 
			<a href="signup.php">Sign Up </a> Here </p>
			<p class="paragrph">Log in With</p>
        </div>
        </form>
<?php 
       include_once'footer.php';
?>