<?php include('layouts/header.php'); ?>
<?php

/*
Not Paid
shipped
delivered
*/

include('server/connection.php');




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
<section class="pt-3 mt-3 py-5 my-5">
<div>
<h2 class="text-center pt-5 mt-5">Ordinary Level General</h2>


<?php if(isset($_GET['subject_updated'])){?>
      <p class="text-center" style="color:green;"> <?php echo $_GET['subject_updated']; ?> </p>
    <?php } ?>
    <?php if(isset($_GET['subject_failed'])){?>
      <p class="text-center" style="color:red;"> <?php echo $_GET['subject_failed']; ?> </p>
    <?php } ?>

<table class="table pt-5 mt-5 ">
  <thead>
    <tr>
      
      <!-- <th scope="col">Image</th> -->
      <th scope="col" style="color:coral;font-size:30px;">Subjects</th>
      <th scope="col" style="color:coral;font-size:30px">Price</th>
      <th scope="col" style="color:coral;font-size:30px">Quantity</th>
      
    </tr>
  </thead>
  <?php include('server/get_o.php'); ?>
     <?php while($row = $o_level->fetch_assoc()){ ?>
     
  <tbody>
    <tr>
      
      
      <td><?php echo $row['product_name']; ?></td>
      <td><?php echo $row['product_price']; ?>frs/yr</td>

      


      <td>
      <form action="cart.php" method="POST">
                   <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                   <input type="hidden" name="product_name" value="<?php echo $row['product_name']; ?>">
                    <input type="hidden" name="product_price" value="<?php echo $row['product_price']; ?>">

                    <input type="number" value="0" min="1" name="product_quantity" style="width:50px;">
                    <button class="btn btn-success" type="submit" name="add_to_cart">Add</button>
                 
          
        </form>
      </td>
      
    </tr>
    
  
  </tbody>
  <?php } ?>


</table>
</div>

<!-- <div class="cart-total mt-3">
        <table>
            <td>Total</td>
            <td>frs</td>
           
          </tr>
        </table>
       </div>  -->

</section>


 <!-- footer -->
 <?php include('layouts/footer.php'); ?>

 