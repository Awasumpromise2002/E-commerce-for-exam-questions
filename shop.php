<?php 

include('server/connection.php');

// use the search section and search button
if(isset($_POST['search'])){
  $category = $_POST['category'];
  $price = $_POST['price'];

  $stmt = $conn->prepare("SELECT * from products Where product_category=? and product_price=?");
  $stmt->bind_param("si",$category,$price);
  $stmt->execute();
  $products = $stmt->get_result();
}else{
   //4) get all products
   $stmt = $conn->prepare("SELECT * from products ");

   $stmt->execute();
   $products = $stmt->get_result();
}
?>

<?php
  // pagination
    if(isset($_GET['page_no']) && $_GET['page_no'] != ""){
      // if user just enter a page number, then default number is the one they selected
      $page_no = $_GET['page_no'];
    }else{
      // if user just enter a page number, then default number is 1
      $page_no = 1;
    }
      //2) return number of products
    $stmt1 = $conn->prepare("SELECT COUNT(*) as total_records FROM products");
    $stmt1->execute();
    $stmt1->bind_result($total_records);
    $stmt1->store_result();
    $stmt1->fetch();
      // 3products per page
    $total_records_per_page = 20;
    $offset = ($page_no-1) * $total_records_per_page;
    $previous_page = $page_no - 1;
    $next_page = $page_no + 1;

    $adjacent = "2";

    $total_no_of_pages = ceil($total_records/$total_records_per_page);

    //4) get all products
    $stmt2 = $conn->prepare("SELECT * from products ORDER BY product_name LIMIT $offset,$total_records_per_page");

    $stmt2->execute();
    $products = $stmt2->get_result();


 
 


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- stylesheet -->
    <link rel="stylesheet" href="style.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  
     <!-- font-awesome -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

     <link rel="stylesheet" href="https://cdn.lineicons.com/4.0/lineicons.css" />


    <title>Shop</title>
    <style>
        .product img{
            width: 100%;
            height: auto;
            box-sizing: border-box;
            object-fit: cover;
        }
        .pagination a{
            color: coral;
        }
        .pagination li:hover a{
            color: white;
            background-color: coral;
        }
    </style>
</head>
<body>
<!-- nav bar -->
<?php include("layouts/header.php"); ?>

<!-- search -->
<!-- <section id="search" class="my-5 py-5 ms-2">
    <div class="container mt-5 py-5">
      <p>Search Products</p>
      <!-- <hr> -->
    </div>

      <form action="shop.php" method="POST"> -->
        <!-- <div class="row mx-auto container">
          <div class="col-lg-12 col-md-12 col-sm-12">
            <p>Category</p>
              <div class="form-check">
                <input type="radio" class="form-check-input"  value="GCE" name="category" id="category_one" <?php if(isset($category) && $category=='GCEE'){ echo 'checked';} ?> />
                <label for="flexRadioDefault1" class="form-check-label">
                  GCE
                </label>
              </div>

              <div class="form-check">
                <input type="radio" class="form-check-input"  value="tvee" name="category" id="category_two" <?php if(isset($category) && $category=='Tvee'){ echo 'checked';} ?> />
                <label for="flexRadioDefault2" class="form-check-label">
                  Tvee
                </label>
              </div>

                <div class="row mx-auto container mt-5">
                  <div class="col-lg-12 col-md-12 col-sm-12">

                    <p>Price</p>
                    <input type="range" name="price" class="form-range w-50" value="<?php if(isset($price)){ echo $price;}else{echo "100";} ?>" min="1" max="1000" id="customRage2" />
                    <div class="w-50">
                      <span style="float: left;">1</span>
                      <span style="float: right;">1000</span>
                    </div>
                  </div>
                </div>
          
          </div>
        </div> 

        <div class="form-group my-3 mx-3">
          <input type="submit" class="btn btn-primary" name="search" value="Search" />
        </div>
      </form>
</section> -->

<!-- feature product-->
<section id="features" class="my-5 py-5">
     
    <div class="container mt-5 py-5">
      <h3 class="text-center">Our Products</h3>
      <hr>
      <p class="text-center">Here you can check our new featured products</p>
    </div>
    <div class="row mx-auto container">

    <?php while($row = $products->fetch_assoc()){ ?>
       <!-- one -->
      <div onclick="window.location.href='single_product.html';" class="product text-center col-lg-3 col-d-4 col-sm-12">
        
        <div class="star">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          
        </div>
        <h4 class="p-name"><?php echo $row['product_name']; ?></h4>
        <h3 class="p-price"><?php echo $row['product_price']; ?>frs</h3>
        <a class="btn buy-btn" href="<?php echo "single_product.php?product_id=".$row['product_id']; ?>">Buy now</a>
      </div>
      
       <?php } ?>
         
       
        

          <nav aria-label="Page navigation example" class="mx-auto">
            <ul class="pagination mt-5 mx-auto">

                <li class="page-item <?php if($page_no <= 1){ echo 'disable';} ?>">
                  <a href="<?php if($page_no <= 1){ echo '#';}else{ echo "?page_no=".($page_no-1);} ?>" class="page-link">Previous</a>
                </li>
                <li class="page-item"><a href="?page_no=1" class="page-link">1</a></li>
                <li class="page-item"><a href="?page_no=2" class="page-link">2</a></li>

                <?php if($page_no>=3){ ?>
                <li class="page-item"><a href="#" class="page-link">...</a></li>
                <li class="page-item"><a href="<?php echo "?page_no=".$page_no;?>" class="page-link"><?php echo $page_no;?></a></li>
                <?php } ?>

                <li class="page-item <?php if($page_no >= $total_no_of_pages){ echo 'disable';}?>">
                  <a href="<?php if($page_no >= $total_no_of_pages){ echo '#';}else{ echo "?page_no=".($page_no+1); }?>" class="page-link">Next</a>
                </li>
                
            </ul>
          </nav>
    </div>
  </section>

     <!-- footer -->
     <?php include('layouts/footer.php'); ?>