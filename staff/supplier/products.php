
<?php
session_start();
include("db.php");
include  "sidebar.php";
include  "navbar.php";
?>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Fragranec Loungue</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../Admin/Admin/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="../../Admin/Admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../../Admin/Admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="../../Admin/Admin/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../Admin/Admin/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../../Admin/Admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../../Admin/Admin/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../../Admin/Admin/plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
    

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
      <!-- <a hre -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      <!-- /.container-fluid -->
    
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="card">
            <div class="card-header">
            
                	<div class="card-body">
                    <p> product History</p>
                    <table id="example2" class="table table-responsive table-hover">
                      <thead>
                        <tr><th>PRODUCT_ID</th><th>PRODUCT_NAME</th><th>PRODUCT_Image</th><th>QUANTITY</th><th>COST PER ITEM</th><th>TOTAL COST<th><th>STATUS</th></tr>
                      </thead>
                    
                       <?php
                  $result=$mysqli->query("select * from products where status!='payment_completed' and cost_per_item>0")or die($mysqli->error);
                  while($row=$result->fetch_assoc())
                  {
                    echo

                    "
                    <tbody>
                    <td>".$row['id']."</td>
                    <td>".$row['product_name']."</td>
                    <td><img src='../../img/perfumes/".$row['product_img_name']."' alt='Product Image'></td>
                    <td>".$row['quantity']."</td>
                    <td>".$row['cost_per_item']."</td>
                    <td>".$row['total_cost']."</td>
                    <td>".$row['status']."</td>
                   
                   </tbody>
                    "
                  ;}
            ?>

</table>
<td><a href='../rawreport.php' class='btn btn-danger'>Export to PDF</a></td>
</div>
</div>

         
               
</section>              
<div class="row">
          <!-- Left col -->
         <!-- right col -->
        </div>
        <div class="row">
          <div class="card">
            
                	<div class="card-body">
                    <p> Products paid for</p>
                    <table id="example2" class="table table-responsive table-hover">
                      <thead>
                        <tr><th>PRODUCT_ID</th><th>PRODUCT_NAME</th><th>PRODUCT_Image</th><th>QUANTITY</th><th>STATUS</th><th>ACTION</th></tr>
                      </thead>
                    
                       <?php
                  $result=$mysqli->query("select * from products where status='payment_completed' order by status desc")or die($mysqli->error);
                  while($row=$result->fetch_assoc())
                  {
                    echo

                    "
                    <tbody>
                    <td>".$row['id']."</td>
                    <td>".$row['product_name']."</td>
                    <td><img src='../../img/perfumes/".$row['product_img_name']."' alt='Product Image'></td>
                    <td>".$row['quantity']."</td>
                    <td>".$row['status']."</td>
                   <td> <a href='products.php?aprpid=$row[id]' class='btn btn-success'>Dispatch<a>
                   <a href='products.php? rjrpid=$row[id]' class='btn btn-danger'>Reject<a></td>
                   </tbody>
                    "
                  ;}
            ?>

</table>
<td><a href='../rawreport.php' class='btn btn-danger'>Export to PDF</a></td>
</div>
<?php
    if(isset($_GET['aprpid']))
  {
    $product_id=$_GET['aprpid'];
    $result = $mysqli->query("UPDATE products SET Status= 'intransit' WHERE id = $product_id") or die($mysqli->error);
   
  
        echo '<script>alert("Record Approved!");
        window.location.replace("products.php")';
   
  }
     if(isset($_GET['rjrpid']))
  {
    $product_id=$_GET['rjrpid'];
    $result = $mysqli->query("UPDATE products SET Status= 'rejected' WHERE product_id = $product_id") or die($mysqli->error);
   
  
        echo '<script>alert("Record Approved!");
        window.location.replace("products.php")';
   
  }
  ?>
</div>

         
               
</section>              
<div class="row">
          <!-- Left col -->
         <!-- right col -->
        </div>
    
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy;  <a href="http://elton.html">joyleen 2023</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
    
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../../Admin/Admin/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../../Admin/Admin/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../../Admin/Admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="../../Admin/Admin/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="../../Admin/Admin/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../../Admin/Admin/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../../Admin/Admin/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="../../Admin/Admin/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../../Admin/Admin/plugins/moment/moment.min.js"></script>
<script src="../../Admin/Admin/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../../Admin/Admin/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../../Admin/Admin/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../../Admin/Admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../../Admin/Admin/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../../Admin/Admin/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../Admin/Admin/dist/js/demo.js"></script>
</body>
</html>
