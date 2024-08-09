<?php
include('server/connection.php');

session_start();

// if(isset($_SESSION['logged_in'])){
//   header('location: index.php');
//   exit;
// }

if(isset($_POST['login_btn'])){

  $email = $_POST['email'];
  $password = md5($_POST['password']);

  $stmt = $conn->prepare("SELECT user_id,user_name,user_email,user_password FROM users WHERE user_email=? and user_password=? LIMIT 1");
  $stmt->bind_param('ss',$email,$password);

  if($stmt->execute()){
     $stmt->bind_result($user_id,$user_name,$user_email,$user_password);
     $stmt->store_result();

     if($stmt->num_rows() == 1){
      $stmt->fetch();
    

      $_SESSION['user_id'] = $user_id;
      $_SESSION['user_name'] = $user_name;
      $_SESSION['user_email'] = $user_email;
      $_SESSION['logged_in'] = true;

      header('location: index.php?login_success=login Successfully');
     }else{
      header('location: login.php?error=No account with this credential');
     }
  }else{
    // error
    header('location: login.php?error=Something went wrong');
  }

}




?>





  <?php include('logincss.php'); ?>


  
  <!-- login -->
  <section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
        <h2 class="form-weight-bold">Login</h2>
        <!-- <hr class="mx-auto"> -->
    </div>
    <div class="mx-auto container">
        <form action="login.php" method="POST" id="login-form" style="">
        <p style="color:red;" class="text-center"><?php  if(isset($_GET['error'])){ echo $_GET['error']; }?></p>
            <div class="form-group">
                <label for="">Email</label>
                <input type="text" class="form-control" id="login-email" name="email" placeholder="Email" required>
            </div>
            <div class="form-group">
                <label for="">Password</label>
                <input type="password" class="form-control" id="login-email" name="password" placeholder="Passwword" required>
            </div>
            <div class="form-group">
                <input type="submit" class="btn" id="login-btn" name="login_btn" value="login">
            </div>
            <div class="form-group">
               <a href="register.php" id="register-url" class="btn" >Don't have an accont? Register</a>
            </div>
        </form>
    </div>
  </section>
  
  
 