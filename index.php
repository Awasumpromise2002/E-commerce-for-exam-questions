<?php include('layouts/header.php'); ?>
<?php

// include('server/connection.php');


// if(isset($_SESSION['logged_in'])){
//   header('location:index.php');
//   exit;
// }else{
//   header('location:login.php');
// }
?>



<!-- start of home -->
<section class="home" id="home">

    <div class="contents">
        <h3>High quality questions</h3>
        <p>Everyday begins with a fresh set of learning possibilities</p>
        <a href="#" class="btn btn-primary">learn <span>more</span></a>
    </div>

     <div class="image">
        <img src="assets/img/homepage.png" alt="">
     </div> 
  </section>

<!-- new -->
    <section id="new" class="w-100 my-0 pb-0 mt-3" >
      <div class="row p-0 m-0">
        <!-- one -->
        <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
          <img class="img-fluid" src="assets/img/maths.jpg"></img>
          <div class="details">
            <h2>Extremely Awesome</h2>
            <button class="text-uppercase">Shop Now</button>
          </div>
        </div>
        <!-- end of one -->
        <!-- two -->
        <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
          <img class="img-fluid" src="assets/img/physics.jpg"></img>
          <div class="details">
            <h2> Awesome Question</h2>
            <button class="text-uppercase">Shop Now</button>
          </div>
        </div>
        <!-- end of two -->
        <!-- three -->
        <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
          <img class="img-fluid" src="assets/img/biology.jpg"></img>
          <div class="details">
            <h2>100% off</h2>
            <button class="text-uppercase">Shop Now</button>
          </div>
        </div>
        <!-- end of three -->
      </div>
    </section>

    <!-- feature gce product-->
    

    <!-- banner -->
    <section id="banner" class="my-5 pb-5">
      <div class="container">
        <h4>MID SEASON's SALE</h4>
        <h1>Enough collection <br>Up to 30% off</h1>
        <button class="text-uppercase">shop now</button>
      </div>
    </section>

    <!-- mock setion -->
   

    <!-- shoes -->
    <section id="features" class="my-5 ">
     
      <div class="container text-center mt-5 py-5">
        <h3>Exam Questions</h3>
        <hr>
        <p>Here you can check our amazing Exams</p>
      </div>
      <div class="row mx-auto container-fluid">
         <!-- one -->
        <div class="product text-center col-lg-3 col-d-4 col-sm-12">
          <img class="img-fluid" mb-3 src="yolo health2.png" alt="" />
          <div class="star">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            
          </div>
          <h4 class="p-name">Ordinary Level</h4>
          <h3 class="p-price">50-300frs/paper</h3>
          <a href="gce_o_level.php"><button class="btn btn-success">Buy now</button></a>
        </div>
          <!-- one -->
          <div class="product text-center col-lg-3 col-d-4 col-sm-12">
            <img class="img-fluid" mb-3 src="yolo health2.png" alt="" />
            <div class="star">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              
            </div>
            <h4 class="p-name">Advance level</h4>
            <h3 class="p-price">50-300frs/paper</h3>
            <a href="gce_a_level.php"><button class="btn btn-success">Buy now</button></a>
          </div>
            <!-- one -->
        <div class="product text-center col-lg-3 col-d-4 col-sm-12">
          <img class="img-fluid" mb-3 src="yolo health2.png" alt="" />
          <div class="star">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            
          </div>
          <h4 class="p-name">TVEE Odinary Level</h4>
          <h3 class="p-price">50-300frs/paper</h3>
          <a href="index.php"><button class="btn btn-success">Buy now</button></a>
        </div>
          <!-- one -->
          <div class="product text-center col-lg-3 col-d-4 col-sm-12">
            <img class="img-fluid" mb-3 src="yolo health2.png" alt="" />
            <div class="star">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              
            </div>
            <h4 class="p-name">TVEE Advance Level</h4>
            <h3 class="p-price">50-300frs/paper</h3>
            <a href="tvee_a_level.php"><button class="btn btn-success">Buy now</button></a>
          </div>
      </div>
    </section>
    

    <!-- footer -->
    <?php include('layouts/footer.php'); ?>
    