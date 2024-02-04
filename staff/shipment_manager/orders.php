
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
  <title>Fragrance Loungue</title>
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
          
          </div><!-- /.col -->
       
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-12">
          <div class="card">
            <div class="card-header">
            <h3 class="card-title">Pending Deliveries</h3>
          </div>
          <!--card body-->
                  <div class="class-body">
                   <div class="table-responsive ps">
                    <table id="example2" class="table table-responsive table-hover" id="page1">
                      <thead>
                        <tr><th>PRODUCT NAME</th><th>DESCRIPTION</th><th>QUANTITY</th>
                        <th>CUSTOMER FIRSTNAME</th><th>CUSTOMER LAST NAME</th><th>CUSTOMERLOCATION</th><th>DRIVER_NAME</th>
                        <th>DRIVER_PHONENUMBER</th>
                        <th>DELIVERY STATUS</th></tr>
                      </thead>
                      <?php
                  
                  $result = $mysqli->query("SELECT
                  orders.quantity AS qty,
                  products.cost_per_item AS pci,
                  orders.id AS orderid,
                  orders.order_status AS order_status,
                  products.product_name AS prodname,
                  products.description AS proddesc,
                  customers.customer_id AS custid,
                  customers.firstname AS cfirstname,
                  customers.lastname AS clastname,
                  customers.location AS clocation,
                  drivers.driver_name AS driver_name,
                  drivers.phone_number AS phone_number
              FROM
                  orders
              JOIN
                  products ON orders.product_id = products.id
              JOIN
                  customers ON customers.customer_id = orders.customer_id
              JOIN
                  drivers ON orders.driver_id = drivers.driver_id where order_status='payment_approved'
            ") or die($mysqli->error);
              
              while ($row = $result->fetch_assoc()) {
                  echo "
                      <tbody>
                      <td>".$row['prodname']."</td>
                      <td>".$row['proddesc']."</td>
                      <td>".$row['qty']."</td>
                      <td>".$row['cfirstname']."</td>
                      <td>".$row['clastname']."</td>
                      <td>".$row['clocation']."</td>
                      <td>".$row['driver_name']."</td>
                      <td>".$row['phone_number']."</td>
                      
                      <td>".$row['order_status']."</td>
                      
                      </tbody>
                  ";
              }
              ?>
              
</table>


</div>
<div class="card">
            <div class="card-header">
            <h3 class="card-title">Completed Deliveries</h3>
          </div>
          <!--card body-->
                  <div class="class-body">
                   <div class="table-responsive ps">
                    <table id="example2" class="table table-responsive table-hover" id="page1">
                      <thead>
                        <tr><th>PRODUCT NAME</th><th>DESCRIPTION</th><th>QUANTITY</th>
                        <th>CUSTOMER FIRSTNAME</th><th>CUSTOMER LAST NAME</th><th>CUSTOMERLOCATION</th><th>DRIVER_NAME</th>
                        <th>DRIVER_PHONENUMBER</th>
                        <th>DELIVERY STATUS</th></tr>
                      </thead>
                      <?php
                  
                  $result = $mysqli->query("SELECT
                  orders.quantity AS qty,
                  products.cost_per_item AS pci,
                  orders.id AS orderid,
                  orders.order_status AS order_status,
                  products.product_name AS prodname,
                  products.description AS proddesc,
                  customers.customer_id AS custid,
                  customers.firstname AS cfirstname,
                  customers.lastname AS clastname,
                  customers.location AS clocation,
                  drivers.driver_name AS driver_name,
                  drivers.phone_number AS phone_number
              FROM
                  orders
              JOIN
                  products ON orders.product_id = products.id
              JOIN
                  customers ON customers.customer_id = orders.customer_id
              JOIN
                  drivers ON orders.driver_id = drivers.driver_id where orders.order_status='delivered'
            ") or die($mysqli->error);
              
              while ($row = $result->fetch_assoc()) {
                  echo "
                      <tbody>
                      <td>".$row['prodname']."</td>
                      <td>".$row['proddesc']."</td>
                      <td>".$row['qty']."</td>
                      <td>".$row['cfirstname']."</td>
                      <td>".$row['clastname']."</td>
                      <td>".$row['clocation']."</td>
                      <td>".$row['driver_name']."</td>
                      <td>".$row['phone_number']."</td>
                     
                      <td>".$row['order_status']."</td>
                      
                      </tbody>
                  ";
              }
              ?>
              
</table>

</div>

</div>




  
         

            
          </section>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
   
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

<<!-- jQuery -->
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
<script src="../../Admin/Admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
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
