<?php include('layouts/header.php'); ?>
 
 <!-- mock -->
 <section id="features" class="my-5 py-5">
     
     <div class="container text-center mt-5 py-5">
       <h3>Our featured Mock Questions</h3>
       <hr>
       <p>Here you can check our new featured Mock Questions</p>
     </div>
     <div class="row mx-auto container-fluid">

     
     <?php include('server/get_mocks.php'); ?>
     <?php while($row= $mocks->fetch_assoc()){ ?>
        <!-- one -->
       <div class="product text-center col-lg-3 col-d-4 col-sm-12">
         <img class="img-fluid" mb-3 src="assets/img/<?php echo $row['product_image']; ?>" alt="" />
         <div class="star">
           <i class="fas fa-star"></i>
           <i class="fas fa-star"></i>
           <i class="fas fa-star"></i>
           <i class="fas fa-star"></i>
           <i class="fas fa-star"></i>
           
         </div>
         <h4 class="p-name"><?php echo $row['product_name']; ?></h4>
         <h3 class="p-price"><?php echo $row['product_price']; ?>frs/yr</h3>
         <a href="<?php echo "single_product.php?product_id=". $row['product_id']; ?>"><button class="buy-btn">Buy now</button></a> 
       </div>
         <!-- one -->
        <?php }?>
       
     </div>
   </section>
