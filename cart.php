<?php
session_start();
include('server/connection.php');

if(isset($_POST['add_to_cart'])){

        // if user have already added a product
        if(isset($_SESSION['cart'])){
            $products_array_ids = array_column($_SESSION['cart'],"product_id");
            // check whether product has beeen added or nott
            if( !in_array($_POST['product_id'], $products_array_ids)){

              // $product_id = $_POST['product_id'];

                    $product_id = $_POST['product_id'];
                    $product_name = $_POST['product_name'];
                    $product_price = $_POST['product_price'];
                    // $product_image = $_POST['product_image'];
                    $product_quantity = $_POST['product_quantity'];
    
              $product_array = array(
                      'product_id'=> $product_id,
                      'product_name'=> $product_name,
                      'product_price'=> $product_price,
                      // 'product_image'=> $product_image,
                      'product_quantity'=> $product_quantity

                    // 'product_id'=>$_POST['$product_id'],
                    // 'product_name'=>$_POST['$product_name'],
                    // 'product_price'=>$_POST['$product_price'],
                    // 'product_image'=>$_POST['$product_image'],
                    // 'product_quantity'=>$_POST['$product_quantity']
              );
              $_SESSION['cart'][$product_id] = $product_array;

              // product has alread been added
            }else{

              echo '<script>alert("Product was already added to cart");</script>';

            }

             // calculate total
        calculateTotalCart();

          // this is the 1st product user adds
        }else{
          $product_id = $_POST['product_id'];
          $product_name = $_POST['product_name'];
          $product_price = $_POST['product_price'];
          // $product_image = $_POST['product_image'];
          $product_quantity = $_POST['product_quantity'];

          $product_array = array(
                'product_id'=> $product_id,
                'product_name'=> $product_name,
                'product_price'=> $product_price,
                // 'product_image'=> $product_image,
                'product_quantity'=> $product_quantity
          );

          $_SESSION['cart'][$product_id] = $product_array;
        }

        // calculate total
        calculateTotalCart();

        // remove product from the cart
}else if(isset($_POST['remove_product'])){

  $product_id = $_POST['product_id'];
  unset($_SESSION['cart'][$product_id]);

   // calculate total incase we remove
   calculateTotalCart();


}else if(isset($_POST['edit_quantity'])){

  // get id and quantity fron form
  $product_id = $_POST['product_id'];
  $product_quantity = $_POST['product_quantity'];

   // // get product array from  session
  $product_array = $_SESSION['cart'][$product_id];

  // // update product quantity
  $product_array['product_quantity'] = $product_quantity;

  // //return array back to its place
  $_SESSION['cart'][$product_id] = $product_array;

   // calculate total incase we update
   calculateTotalCart();
   
}else{
  // header('location:index.php');
}


function calculateTotalCart(){
  $total_price = 0;

  $total_quantity=0;
  foreach($_SESSION['cart'] as $key => $value){
    $product = $_SESSION['cart'][$key];

    $price = $product['product_price'];
    $quantity = $product['product_quantity'];

    $total_price = $total_price + ($price * $quantity);
    $total_quantity = $total_quantity + $quantity;
  }
  $_SESSION['total'] = $total_price;
  $_SESSION['quantity'] = $total_quantity;
}

?>







<?php include('layouts/header.php'); ?>

      <!-- cart -->
      <section class="cart container my-5 py-5">
        <div class="container mt-5">
            <h2 class="font-weight-bold">Your Cart</h2>
            <hr>
        </div>

        <table class="mt-5 pt5">
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>

            <?php if(isset($_SESSION['cart'])) { ?>

            <?php foreach($_SESSION['cart'] as $key => $value){ ?>
            <!-- one -->
            <tr>
                <td>
                    <div class="product-info">
                       
                        <div>
                            <p><?php echo $value['product_name']; ?></p>
                            <small><span></span><?php echo $value['product_price']; ?> frs/yr</small>
                            <br>

                            <form method="POST" action="cart.php">
                              <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>" class="remove-btn" />
                              <input type="submit" name="remove_product" value="remove" class="remove-btn" />
                            </form>
                            
                        </div>
                    </div>
                </td>

                <td>
                  
                      <form method="POST" action="cart.php">
                              <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>"  />
                              <input type="number" name="product_quantity" value="<?php echo $value['product_quantity']; ?>" style="width:70px;text-align:center;" />
                              <input type="submit" name="edit_quantity" value="edit" class="edit-btn" />
                     </form>
                </td>

                <td>
                  
                  <span class="product-price"><?php echo $value['product_quantity'] * $value['product_price']; ?></span>
                  <span>frs</span>
                </td>
            </tr>
            <?php } ?>

            <?php } ?>
           
        </table>

       <div class="cart-total mt-3">
        <table>
            <td>Total</td>

            <?php if(isset($_SESSION['cart'])) { ?>
            <td><?php echo $_SESSION['total']; ?>frs</td>
            <?php  } ?>
          </tr>
        </table>
       </div> 

       <!-- checkout buttton -->
       <div class="checkout-container">
        <form method="POST" action="checkout.php">
        <input type="submit" class="checkout-btn" value="checkout"  name="checkout" />
        </form>
        
       </div>
      </section>




        <!-- footer -->
        <?php include('layouts/footer.php'); ?>