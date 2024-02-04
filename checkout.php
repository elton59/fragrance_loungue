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
 
    <?php
if(isset($_POST['checkout']))
{
  $custid = $_POST['custid'];
  $otime = $_POST['otime'];
  $total = $_POST['total'];
  $tid = $_POST['tid'];
  $oids = explode(',', $_POST['oids']);
  $oidsString = implode(',', $oids);

  $result1 = $mysqli->query("UPDATE orders SET orderdate='$otime',order_status='awaiting_payment_approval' WHERE id IN ($oidsString)" ) or die($mysqli->error);
$result2 = $mysqli->query("INSERT INTO payments (customer_id, amount, transaction_code, product_id,order_id) VALUES ('$custid', '$total', '$tid', '$oidsString','$oidsString')") or die($mysqli->error);

echo "<script>
  window.location.replace('orders.php?$oidsString');
</script>";
// echo "<script>
//   window.location.replace('orders.php');
// </script>";
}
?>
  
      <!-- Heading -->
      <h2 class="my-5 h2 text-center">Checkout form</h2>

      <!--Grid row-->
      <div class="row">

        <!--Grid column-->
    
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-md-4 mb-4">

          <!-- Heading -->
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Your cart</span>
            <span class="badge badge-secondary badge-pill">
            <?php
                 if(isset($_SESSION['username']))
                 {
                  $total=0;
                  $cemail=$_SESSION['username'];
                  $result=$mysqli->query("SELECT count(orders.id) as oid from orders join customers on orders.customer_id=customers.customer_id where customers.email='$cemail' and orders.order_status='pending'") or die(mysqli_error($mysqli));
               
                  while($row=$result->fetch_assoc())
                  {

                   $roid=$row['oid'];
                   $total=$total+$roid;
                   if($total>0)
                   {
                    echo "<h3>$total</h3>";
                   }
                   else
                   {
                    echo "0";
                   }
                 
                  }}
                  else{echo "0";}
                  
                  ?>
            </span>
          </h4>
          <?php
          if(isset($_GET['delid']))
          {
            $delid=$_GET['delid'];
            $result=$mysqli->query("delete from orders where id=$delid");
            echo "<script>windows.location.replace('checkout.php?id=$delid')</script>";
          }
          ?>
           <!-- Cart -->
           <ul class='list-group mb-3 z-depth-1'>
           <?php
           $total = 0;
           $cemail=$_SESSION['username'];
           $result=$mysqli->query("SELECT orders.quantity as qty,products.cost_per_item as pci,orders.id as orderid,products.product_name as prodname,products.description as proddesc,customers.customer_id as custid from orders join products on orders.product_id=products.id join customers on customers.customer_id=orders.customer_id where customers.email='$cemail'and orders.order_status='pending'");
           while($row=$result->fetch_assoc())
           {
            $orderid=$row['orderid'];
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
              <a href='checkout.php?delid=$orderid'class='text-m'> <p style='color:red'>remove</p></a></span>
            </li>
            
          
          <!-- Cart -->";
        }
        echo "<li class='list-group-item d-flex justify-content-between'>
        <span>Total (KSH) $total</span>
        <strong></strong>
      </li>";
        ?>
        </ul>
          <!-- Promo code -->

        </div>
        <!--Grid column-->
        <div class="col-md-8 mb-4">

<!--Card-->
<div class="card">

  <!--Card content-->
  <form class="card-body" method='post'>

    <!--Grid row-->
    <div class="row">
<center>
  <img src="./img/perfumes/Add-a-heading.png" style="width:400px"/>
</center><br/>
      <!--Grid column-->
      <div class="col-md-6 mb-2">
     
<?php
$total = 0;
$orderIds = [];
$cemail = $_SESSION['username'];
$result = $mysqli->query("SELECT orders.quantity as qty, products.cost_per_item as pci, orders.id as orderid, products.product_name as prodname, products.description as proddesc,customers.email as cemail, customers.customer_id as custid, customers.firstname as cfirstname,customers.address as caddress, customers.lastname as clastname from orders join products on orders.product_id = products.id join customers on customers.customer_id = orders.customer_id where customers.email='$cemail' and orders.order_status='pending'") or die($mysqli->error);

while ($row = $result->fetch_assoc()) {
    $orderid = $row['orderid'];
    $custid = $row['custid'];
    $cemail = $row['cemail'];
    $caddress = $row['caddress'];
    $productname = $row['prodname'];
    $description = $row['proddesc'];
    $cfirstname = $row['cfirstname'];
    $clastname = $row['clastname'];
    $pci = $row['pci'];
    $qty = $row['qty'];
    $cost = $qty * $pci;
    $total += $cost;
    $orderIds[] = $orderid;
    $otime=time();
}

echo
"
<!--firstName-->
<div class='md-form'>
<input type='text' id='firstName' name='custid' value=$custid readonly class='form-control'>
<label for='firstName' >ID</label>
</div>
<div class='md-form'>
<input type='text' id='firstName'  value=$cfirstname class='form-control' readonly>
<label for='firstName' class=''>First name</label>
</div>

</div>
<!--Grid column-->

<!--Grid column-->
<div class='col-md-6 mb-2'>
<!--address-2-->

<!--lastName-->
<div class='md-form'>
<input type='text' id='lastName' readonly  value=$clastname class='form-control'>
<label for='lastName' class=''>Last name</label>
</div>

</div>
<!--Grid column-->

</div>
<!--Grid row-->



<!--email-->
<div class='md-form mb-5'>
<input type='text' id='email' readonly class='form-control' placeholder='youremail@example.com' value=$cemail>
<label for='email' class=''>Email (optional)</label>
</div>

<!--address-->
<div class='md-form mb'>
<input type='text' id='address' readonly value=$caddress class='form-control' placeholder='1234 Main St'>
<label for='address' class=''>Address</label>
</div>
<!--email-->
<div class='md-form mb-5'>
<input type='text' readonly id='address-2' class='form-control' placeholder='Total' name='total' value=$total>
<label for='address-2' class=''>Total</label>
</div>

<!--address-2-->
<div class='md-form mb-5'>
<input type='text' required id='address-2' name='tid' class='form-control' placeholder='Transaction ID'>
<label for='address-2' class=''>Transaction ID</label>
</div>
<!--time-->

<input type='hidden' readonly id='address-2' placeholder='time'name='oids'  value='" . implode(',', $orderIds) . "'>


<input type='hidden'  placeholder='time'name='otime' value=$otime>



<hr class='mb-4'>
<button class='btn btn-primary btn-lg btn-block' name='checkout' type='submit'>Continue Make Payment</button>

</form>

</div>
<!--/.Card-->

</div>";?>

      </div>
      <!--Grid row-->

    </div>
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
