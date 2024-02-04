<!DOCTYPE html>
<?php
include("db.php");
include("navbar.php");
 if(!isset($_SESSION['username']))
 {
   header('location:login.php');
 }

?>
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

<body class="grey lighten-3">



  <!--Main layout-->
  <main class="mt-5 pt-4">
    <div class="container wow fadeIn">

      <!-- Heading -->
      <h2 class="my-5 h2 text-center">Orders</h2>

      <!--Grid row-->
      <div class="row">

        <!--Grid column-->
    
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-md-12 mb-12">

          <!-- Heading -->
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted"> Orders</span>
          
          </h4>
          <?php
          if(isset($_GET['uid']))
          {
            $uid=$_GET['uid'];
            $result=$mysqli->query("UPDATE  orders set order_status='received' where id=$uid");
            echo "<script>windows.location.replace('orders.php')</script>";
          }
          ?>
           <!-- Cart -->
           <ul class='list-group mb-3 z-depth-1'>
           <?php
           $total = 0;
           $cemail=$_SESSION['username'];
           $result=$mysqli->query("SELECT orders.quantity as qty,products.cost_per_item as pci,orders.id as orderid,orders.order_status as order_status,products.product_name as prodname,products.description as proddesc,customers.customer_id as custid from orders join products on orders.product_id=products.id join customers on customers.customer_id=orders.customer_id where customers.email='$cemail'and orders.order_status!='pending'");
           while($row=$result->fetch_assoc())
           {
            $orderid=$row['orderid'];
            $order_status=$row['order_status'];
            $productname=$row['prodname'];
            $description=$row['proddesc'];
            $pci=$row['pci'];
            $qty=$row['qty'];
            $cost=$qty*$pci;
            $total += $cost;
          echo"
         
            <li class='list-group-item d-flex justify-content-between lh-condensed'>
              <div>
                <h6 class='my-0'>$productname</h6>
                <small class='text-muted'>$description</small><br/>
                <small class='text-muted'>quantity:$qty</small>
              </div>
              <span class='text-muted'>Ksh:$cost</span>&nbsp
              <span class='text-muted'>
              <p style='color:red'>$order_status</p></span>
            </li>
            
          
          <!-- Cart -->
         ";
        }
        echo" <a href='oreport.php?cemail=$cemail' class='btn btn-danger'>Export to PDF</a>";
       ;
        ?>
       
        </ul>
          <!-- Promo code -->

        </div>
        <!--Grid column-->
        <div class="col-md-12 mb-12">

<!-- Heading -->
<h4 class="d-flex justify-content-between align-items-center mb-3">
  <span class="text-muted">Confirm Delivery</span>

</h4>

 <!-- Cart -->
 <ul class='list-group mb-3 z-depth-1'>
 <?php
 $total = 0;
 $cemail=$_SESSION['username'];
 $result=$mysqli->query("SELECT orders.quantity as qty,products.cost_per_item as pci,orders.id as orderid,orders.order_status as order_status,products.product_name as prodname,products.description as proddesc,customers.customer_id as custid from orders join products on orders.product_id=products.id join customers on customers.customer_id=orders.customer_id where customers.email='$cemail'and orders.order_status='delivered'");
 while($row=$result->fetch_assoc())
 {
  $orderid=$row['orderid'];
  $order_status=$row['order_status'];
  $productname=$row['prodname'];
  $description=$row['proddesc'];
  $pci=$row['pci'];
  $qty=$row['qty'];
  $cost=$qty*$pci;
  $total += $cost;
echo"

  <li class='list-group-item d-flex justify-content-between lh-condensed'>
    <div>
      <h6 class='my-0'>$productname</h6>
      <small class='text-muted'>$description</small><br/>
      <small class='text-muted'>quantity:$qty</small>
    </div>
    <span class='text-muted'>Ksh:$cost</span>&nbsp
    <span class='text-muted'>
    
    <p style='color:red'>$order_status</p></span>
    <span class='text-muted'>
    <a href='orders.php?uid=$orderid'class='text-m btn btn-success'> <p>Received</p></a></span>
  </li>
  

<!-- Cart -->

";

}

;
?>

</ul>
<!-- Promo code -->

</div>
<!--Grid column-->

        <div class="col-md-8 mb-4">



 
  </main>
  <!--Main layout-->

  <!--Footer-->
<?php include('footer.php')?>
  <!--/.Footer-->

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
