<!-- Ordinary level general -->
<?php

include('connection.php');

$stmt = $conn->prepare("SELECT * FROM products where product_description='O/l general' ORDER BY product_name ");
$stmt->execute();

$o_level = $stmt->get_result();

if(isset($_GET['product_id'])){

    $product_id = $_GET['product_id'];
  
    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id= ? ");
    $stmt->bind_param("i",$product_id);
    $stmt->execute();
  
    if($product = $stmt->get_result()){
            header('location: gce_o_level.php?subject_updated=Subject has been added successfully');
    }else{
            header('location: gce_o_level.php?subject_failed=Error occured, Try again');
    }
    
    
  
  // no product is was given
  }
?>