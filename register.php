<?php
include('server/connection.php');
session_start();

if(isset($_SESSION['logged_in'])){
  header('location: login.php');
  exit;
}

if(isset($_POST['register'])){

  $name = $_POST['name'];
  $region = $_POST['region'];
  $division = $_POST['division'];
  $subdivision = $_POST['subdivision'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirmpassword = $_POST['confirmpassword'];


  // if password dont match
      if($password !== $confirmpassword ){
        header('location: register.php?error=passwords donot match');
      

      // if password length is atleast 6 characters
      }else if(strlen($password) < 6){
        header('location: register.php?error=passwords must be atleast 6characters');
      

      // theres is no errror
      }else{
              // check whether there's a user with this email
                $stmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE user_email=?");
                $stmt->bind_param('s',$email);
                $stmt->execute();
                $stmt->bind_result($num_rows);
                $stmt->store_result();
                $stmt->fetch();

                // if there's a user already registered with this email
                if($num_rows != 0){
                      header('location: register.php?error=User with this email already exist');

                // create a new account with a new email
                }else{

                      // create a new user
                      $stmt = $conn->prepare("INSERT INTO users (user_name,user_region,user_division,user_subdivision,user_email,user_password)
                      VALUES (?,?,?,?,?,?) ");

                      $stmt->bind_param('ssssss', $name,$region,$division,$subdivision,$email,md5($password));

                      if($stmt->execute()){
                        $user_id = $stmt->insert_id;
                        $_SESSION['user_id'] = $user_id;
                        $_SESSION['user_email'] = $email;
                        $_SESSION['user_name'] = $name;
                        $_SESSION['user_region'] = $user_region;
                        $_SESSION['user_division'] = $user_division;
                        $_SESSION['user_sudivision'] = $user_subdivision;
                        $_SESSION['logged_in'] = true;
                        header('location: login.php?register_success=Your registered Sucessfully');

                        // account could not be created
                      }else{
                        header('location: register.php?error=Could not create an account at the moment');
                      }

                 }



    }

  }

?>


<?php include('layouts/header.php'); ?>
  
  <!-- Register -->
  <section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
        <h2 class="form-weight-bold">Register</h2>
        <!-- <hr class="mx-auto"> -->
    </div>
    <div class="mx-auto container">
        <form action="register.php" method="POST" id="register-form">
          <p style="color:red;"><?php  if(isset($_GET['error'])){ echo $_GET['error']; }?></p>

            <div class="form-group">
                <label for=""> School Name</label>
                <input type="text" class="form-control" id="register-name" name="name" placeholder="Name" required>
            </div>
            <div class="form-group">
                <label for=""> Region</label>
                <input type="text" class="form-control" id="register-region" name="region" placeholder="Region" required>
            </div>
            <div class="form-group">
                <label for=""> Division</label>
                <input type="text" class="form-control" id="register-division" name="division" placeholder="Division" required>
            </div>
            <div class="form-group">
                <label for=""> Sub-Division</label>
                <input type="text" class="form-control" id="register-subdivision" name="subdivision" placeholder="Sub-division" required>
            </div>
            <div class="form-group">
                <label for="">Email</label>
                <input type="text" class="form-control" id="register-email" name="email" placeholder="Email" required>
            </div>
            <div class="form-group">
                <label for="">Password</label>
                <input type="password" class="form-control" id="register-password" name="password" placeholder="Password" required>
            </div>
            <div class="form-group">
                <label for="">Confirm Password</label>
                <input type="password" class="form-control" id="register-confirm-password" name="confirmpassword" placeholder="Confirm Passwword" required>
            </div>
            <div class="form-group">
                <input type="submit" class="btn" id="register-btn" name="register" value="Register">
            </div>
            <div class="form-group">
               <a href="login.php" id="login-url" class="btn" >Do you have an accont? login</a>
            </div>
        </form>
    </div>
  </section>
  
  
  <!-- footer -->
  <?php include('layouts/footer.php'); ?>