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
<h2 class="text-center pt-5 mt-5">TVEE Advance Level</h2>


<table class="table pt-5 mt-5 ">
  <thead>
    <tr>
      
      <!-- <th scope="col">Image</th> -->
      <th scope="col">Subjects</th>
      <th scope="col">Price</th>
      <th scope="col">Add</th>
      
    </tr>
  </thead>
  <?php include('server/get_tvee.php'); ?>
     <?php while($row= $tvee_a->fetch_assoc()){ ?>
  <tbody>
    <tr>
      
      
      <td><?php echo $row['product_name']; ?></td>
      <td><?php echo $row['product_price']; ?>frs/yr</td>
      <td>
      <form action="cart.php" method="POST">
                   <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                   <input type="hidden" name="product_name" value="<?php echo $row['product_name']; ?>">
                    <input type="hidden" name="product_price" value="<?php echo $row['product_price']; ?>">

                    <input type="number" value="0" name="product_quantity" style="width:50px;">
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

 