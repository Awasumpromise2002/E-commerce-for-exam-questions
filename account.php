<?php
session_start();
include('server/connection.php');

if(!isset($_SESSION['logged_in'])){
  header('location: login.php');
  exit;
}
if(isset($_GET['logout'])){
  if(isset($_SESSION['logged_in'])){
    unset($_SESSION['logged_in']);
    unset($_SESSION['user_name']);
    unset($_SESSION['user_email']);
    header('location: login.php');
    exit;
  }
}

if(isset($_POST['change_password'])){

      $password = $_POST['password'];
      $confirmpassword = $_POST['confirmpassword'];
      $user_email = $_SESSION['user_email'];

      // if password dont match
      if($password !== $confirmpassword ){
            header('location: account.php?error=passwords do not match');
          

          // if password length is atleast 6 characters
      }else if(strlen($password) < 6){
            header('location: account.php?error=passwords must be atleast 6 characters');
      }else{
        $stmt = $conn->prepare("UPDATE users SET user_password=? WHERE user_email=?");
        $stmt->bind_param('ss',md5($password),$user_email);

        if($stmt->execute()){
          header('location: account.php?message=Password Updated successsfully');
        }else{
          header('location: account.php?error=Password could not Update successsfully');
        }
      }
}

// get orders

if(isset($_SESSION['logged_in'])){

  $user_id = $_SESSION['user_id'];

  $stmt = $conn->prepare("SELECT * FROM orders WHERE user_id=? ");
  $stmt->bind_param('i',$user_id);
  $stmt->execute();
  $orders = $stmt->get_result();
}


?>





<?php include('layouts/header.php'); ?> 
  
  <!-- Account -->
      <section class="my-5 py-5">
        <div class="row container mx-auto">

        <?php if(isset($_GET['payment_message'])){  ?>
          <p class="text-center" style="color:green; ><?php echo $_GET['payment_message']; ?></p>
          <?php } ?>

            <div class="text-center mt-3 pt-5 col-lg-6 col-md-12 col-sm-12">
            <p class="text-center" style="color:green;"><?php if(isset($_GET['register_success'])){ echo $_GET['register_success']; } ?></p>
            <p class="text-center" style="color:green;"><?php if(isset($_GET['login_success'])){ echo $_GET['login_success']; } ?></p>
                <h3 class="font-weight-bold">Account Info</h3>
                <div class="account-info">
                    <p><span style="color:coral;">School Name:</span> <span><?php if(isset($_SESSION['user_name'])){ echo $_SESSION['user_name']; }?></span></p>
                    <p><span style="color:coral;">School Email:</span> <span><?php if(isset($_SESSION['user_email'])){ echo $_SESSION['user_email']; }?></span></p>
                    <p><a href="#orders" id="orders-btn">Your Orders</a></p>
                    <p><a href="account.php?logout=1" id="logout-btn">Logout</a></p>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 ">
                <form action="account.php" method="POST" id="account-form" class="form-group">
                <p class="text-center" style="color:red;"><?php if(isset($_GET['error'])){ echo $_GET['error']; } ?></p>
                <p class="text-center" style="color:green;"><?php if(isset($_GET['message'])){ echo $_GET['message']; } ?></p>
                <h3>Change Password</h3>
                <!-- <hr> -->
                <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" class="form-control" id="account-password" name="password" placeholder="password" required>
                </div>
                <div class="form-group">
                    <label for="">Confirm Password</label>
                    <input type="password" class="form-control" id="account-password" name="confirmpassword" placeholder="confirm password" required>
                </div>
                <div class="form-group">
                    <input type="submit" name="change_password" id="change-pass-btn" class="change-pass-btn" value="Change password">
                </div>
                </form>
                
            </div>
        </div>
      </section>


      <!-- orders -->
      <section id="orders" class="orders container my-2 py-3">
        <div class="container mt-2">
            <h2 class="font-weight-bold text-center">Your Orders</h2>
            <hr>
        </div>
        <h5 class="text-center">If order status changes to <b style="color:coral">"VERIFIED"</B>, you can procced to pay by clicking on details under order Info</h5>
        <table class="mt-5 pt-5">
            <tr>
                <th>Order Id</th>
                <th>Order cost</th>
                <th>Order Status</th>
                <th>Order Date</th>
                <th>Order Info</th>

               
            </tr>
            <?php while ($row = $orders->fetch_assoc() ){ ?>
            <!-- one -->
                <tr>
                    <!-- <td>
                      <div class="product-info">
                         <img src="" alt=""> 
                        <div>
                          <p class="mt-3"><?php echo $row['order_id']; ?></p>
                        </div>
                      </div>
                    </td> -->

                    <td>
                      <span><?php echo $row['order_id']; ?></span>
                    </td>

                    <td>
                      <span><?php echo $row['order_price']; ?></span>
                    </td>

                    <td>
                      <span><?php echo $row['order_status']; ?></span>
                    </td>

                    <td>
                      <span><?php echo $row['order_date']; ?></span>
                    </td>

                    <td>
                      <form method="POST" action="order_details.php">
                        <input type="hidden" value="<?php echo $row['order_status']; ?>" name="order_status" />
                        <input type="hidden" value="<?php echo $row['order_id']; ?>" name="order_id" />
                        
                        <?php if(($row['order_status'] == "Verified")){?>
                        <input class="btn order-details-btn" name="order_details_btn" type="submit" value="details"> 
                        <?php } ?> 

                      </form>
                    </td>
                  
                </tr>
           <?php } ?>
        </table>

      

       
      </section>
  
  
  <!-- footer -->
  <?php include('layouts/footer.php'); ?>