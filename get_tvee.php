<?php

include('connection.php');

$stmt = $conn->prepare("SELECT * FROM products where product_description='TVEE/A' ORDER BY product_name ");
$stmt->execute();

$tvee_a = $stmt->get_result();


if(isset($_GET['product_id'])){

    $product_id = $_GET['product_id'];
  
    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id= ? ");
    $stmt->bind_param("i",$product_id);
    $stmt->execute();
  
    if($product = $stmt->get_result()){
            header('location: tvee_a_level.php?subject_updated=Subject has been added successfully');
    }else{
            header('location: tvee_a_level.php?subject_failed=Error occured, Try again');
    }
}
?>