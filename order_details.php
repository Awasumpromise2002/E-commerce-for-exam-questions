<?php

/*
Not Paid
shipped
delivered
*/

include('server/connection.php');

if(isset($_POST['order_details_btn']) && isset($_POST['order_id'])){

    $order_id = $_POST['order_id'];
    $order_status = $_POST['order_status'];

    $stmt = $conn->prepare("SELECT * FROM order_items WHERE order_id=? ");
    $stmt->bind_param('i',$order_id);
    $stmt->execute();

    $order_details = $stmt->get_result();

    $order_total_price = calculateTotalOrderPrice($order_details);
}else{
    header('location: account.php');
    exit;
}



function calculateTotalOrderPrice($order_details){
  $total = 0;

  foreach( $order_details as $row){
   $product_price = $row['product_price'];
   $product_quantity = $row['product_quantity'];

  $total = $total + ($product_price * $product_quantity);

  }
 
  return $total;
}
?>

<?php include('layouts/header.php'); ?>

    <!-- orders details -->
    <section id="orders" class="orders container my-5 py-5">
        <div class="container mt-5">
            <h2 class="font-weight-bold text-center">Order Details</h2>
            <hr>
        </div>

        <table class="mt-5 pt-5 mx-auto">
            <tr>

            <!-- include date -->
                <th>Product Name</th>
                <th>Price</th>
                <th>Quantity</th>

               
            </tr>

            <?php foreach($order_details as $row){ ?>
            
            <!-- one -->
                <tr>
                    <td>
                      <div class="product-info">
                         
                        <div>
                          <p class="mt-3"><?php echo $row['product_name']; ?></p>
                        </div>
                      </div>
                    </td>


                    <td>
                      <span><?php echo $row['product_price']; ?>frs</span>
                    </td>

                    <td>
                      <span><?php echo $row['product_quantity']; ?></span>
                    </td>

                    
                  
                </tr>
           <?php  } ?>

        </table>

        <?php if ($order_status == "Verified") {?>
            <form action="payment.php" method="POST" style="float:right;">
            <input type="hidden" name="order_total_price" value="<?php echo $order_total_price; ?>" />
            <input type="hidden" name="order_status" value="<?php echo $order_status; ?>" />
              <input type="submit" name="order_pay_btn" class="btn btn-primary mt-3" value="Pay Now">
            </form>
        <?php } ?>

       
      </section>





 <!-- footer -->
 <?php include('layouts/footer.php'); ?>