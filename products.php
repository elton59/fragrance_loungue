<?php
include("navbar.php");
include("db.php");
$id=$_GET['id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Fragrance Loungue</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="css/style.min.css" rel="stylesheet">
</head>

<body>

<?php
if (isset($_POST['addcart'])) {
  $qty = $_POST['qty'];
  $user=$_SESSION['username'];

  $result = $mysqli->query("SELECT * FROM customers WHERE email='$user' LIMIT 1") or die($mysqli->error);
  $row = $result->fetch_assoc();
  $cid = $row['customer_id'];

  if ($cid == 0) {
    echo "<script>
      alert('Please create an account first');
      window.location.replace('login.php');
    </script>";
    exit; // Add exit to stop executing the rest of the code if the redirect is triggered
  }

  $result2 = $mysqli->query("INSERT INTO orders (product_id, customer_id,quantity) VALUES ('$id', '$cid','$qty')");
  echo "<script>window.location.replace('index.php');</script>";
}
?>
  <!--Main layout-->
  <main class="mt-5 pt-4">
    <div class="container dark-grey-text mt-5">

      <!--Grid row-->
      <div class="row wow fadeIn">

        <!--Grid column-->
        <center>
        <div class="col-md-6 mb-4">
          
        <?php
          if(isset($_GET['id']))
          {
            $id=$_GET['id'];
            $result = $mysqli->query("SELECT * FROM products where id='$id'");
            while ($obj = $result->fetch_object()) {

              echo"<img src='./img/perfumes/$obj->product_img_name' class='img-fluid' style='width:400px'alt=''>";
              
          }}
          ?>

          

        </div>
        </center>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-md-6 mb-4">

          <!--Content-->
          <div class="p-4">

            <div class="mb-3">
              <a href="">
                <span class="badge purple mr-1"><?php
          if(isset($_GET['id']))
          {
            $id=$_GET['id'];
            $result = $mysqli->query("SELECT * FROM products where id='$id'");
            while ($obj = $result->fetch_object()) {

              echo"$obj->category";
              
          }}
          ?></span>
              </a>
             
            <p class="lead">
              <span class="mr-1">
                <del><?php
          if(isset($_GET['id']))
          {
            $id=$_GET['id'];
            $result = $mysqli->query("SELECT * FROM products where id='$id'");
            while ($obj = $result->fetch_object()) {
              $p2=$obj->cost_per_item +200;
              echo"$p2";
              
          }}
          ?></del>
              </span>
              <span><?php
          if(isset($_GET['id']))
          {
            $id=$_GET['id'];
            $result = $mysqli->query("SELECT * FROM products where id='$id'");
            while ($obj = $result->fetch_object()) {
              $p2=$obj->cost_per_item;
              echo"$p2";
              
          }}
          ?></span>
            </p>

            <p class="lead font-weight-bold">Description</p>

            <p><?php
          if(isset($_GET['id']))
          {
            $id=$_GET['id'];
            $result = $mysqli->query("SELECT * FROM products where id='$id'");
            while ($obj = $result->fetch_object()) {
              $p2=$obj->description;
              echo"$p2";
              
          }}
          ?></p>
  

            <form class="d-flex justify-content-left" method="post">
              <!-- Default input -->
              
              <input type="quantity" name="qty" placeholder="input quantity" required aria-label="Search" class="form-control" style="width: 100px">
              <input name="addcart" class="btn btn-primary btn-md my-0 p" type="submit" value="Add to cart"/>
  <i class="fas fa-shopping-cart ml-1"></i>
</a>

            </form>

          </div>
          <!--Content-->

        </div>
        <!--Grid column-->

      </div>
      <!--Grid row-->

      <hr>

      <!--Grid row-->
      <div class="row d-flex justify-content-center wow fadeIn">

        <!--Grid column-->
        <div class="col-md-6 text-center">

          <h4 class="my-4 h4">Related Products</h4>

          <p class="hidden">Introducing our innovative and cutting-edge product that is sure to revolutionize your everyday life! With its exceptional features and unmatched functionality, this product stands out from the crowd. However, don't just take our word for it. We encourage you to explore similar products in the market and compare them side by side</p>

        </div>
        <!--Grid column-->

      </div>
      <!--Grid row-->

      <!--Grid row-->
      
      <div class="row wow fadeIn">

        <!--Grid column-->

        <!--Grid column-->
        <?php
          $i = 0;
          $product_id = array();
          $result = $mysqli->query("SELECT * FROM products where status='instock' limit 3");
          if ($result === FALSE) {
            die($mysqli->error);
          }

          if ($result) {

            while ($obj = $result->fetch_object()) {
              

              echo"
              <center>
              <a href='products.php?id=$obj->id'>
        <div class='col-lg-4 col-md-6 mb-4'>
         
        <img src='./img/perfumes/$obj->product_img_name' style='width:400px class='img-fluid' alt=''>

        </div></a></center>";}}
        ?>
      

      </div>
      <!--Grid row-->

    </div>
  </main>
  <?php
  include("footer.php")
  ?>
  <!--Main layout-->

 
  <!-- SCRIPTS -->
  <!-- JQuery -->
  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="js/mdb.min.js"></script>
  <!-- Initializations -->
  <script type="text/javascript">
    // Animations initialization
    new WOW().init();

  </script>
</body>

</html>
