<?php
include("layouts/header.php");
include("server/connection.php");
?>


<?php 
$stmt = $conn->prepare("SELECT * FROM boths");
$stmt->execute();
$boths = $stmt->get_result();

?>


 <section class="my-5 py-5">
 <div class="container text-center mt-3 pt-5">
   <h2 class="text-center">Marking guide and timetable</h2>
</div>


 <div class="row mx-auto container-fluid">
    <?php foreach($boths as $product){ ?>
    <div class="container col-lg-3 col-d-4 col-sm-12">
    <div class="product text-center ">
        
        <p><?php echo $product['product_name']; ?></p>

        <a href="addboth.php?product_name=<?php echo $product['product_name']; ?>" class="btn btn-success" download>Download</a>
        <!-- <button class="btn btn-danger">Delete</button> -->
          
    </div>
    </div>
    <?php } ?>
 </section>
 
 <?php include("layouts/footer.php");
?>