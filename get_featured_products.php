<!-- advance general -->
<?php

include('connection.php');

$stmt = $conn->prepare("SELECT * FROM products where product_description='A/l general' ORDER BY product_name ");
$stmt->execute();

$featured_products = $stmt->get_result();


if(isset($_GET['product_id'])){

    $product_id = $_GET['product_id'];
  
    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id= ? ");
    $stmt->bind_param("i",$product_id);
    $stmt->execute();
  
    if($product = $stmt->get_result()){
            header('location: gce_a_level.php?subject_updated=Subject has been added successfully');
    }else{
            header('location: gce_a_level.php?subject_failed=Error occured, Try again');
    }
}
?>