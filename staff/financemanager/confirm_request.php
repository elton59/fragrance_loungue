<?php
session_start();
error_reporting(0);
include("db.php");
include("sidebar.php");
include("navbar.php");
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
              <h1 class="m-0 text-dark">Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
              </ol>
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
                <div class="card-header card-header-primary">
                  <h3 class="card-title">product</h3>
                </div>
                <!--card body-->
                <div class="card-body">
                  <div class="table-responsive ps">
                    <table class="table table-bordered table-hover" id="page1">
                      <thead class="text-primary">
                        <tr>
                          <th>PRODUCT_ID</th>
                          <th>PRODUCT_NAME</th>
                          <th>PRODUCT_Image</th>
                          <th>QUANTITY</th>

                          <th>ACTION</th>
                        </tr>
                      </thead>
                      <?php
                      $result = $mysqli->query("select * from products where status='pending' and cost_per_item>0") or die($mysqli->error);
                      while ($row = $result->fetch_assoc()) {
                        echo

                        "
                    <tbody>
                    <td>" . $row['id'] . "</td>
                    <td>" . $row['product_name'] . "</td>
                    <td><img src='../../img/perfumes/" . $row['product_img_name'] . "' alt='Product Image'></td>
                    <td>" . $row['quantity'] . "</td>
                    <td> <a href='confirm_request.php?fpid=$row[id]' class='btn btn-success'>Make Payment<a>
                     </td>
                    </tbody>
                    ";
                      }
                      ?>
                    </table>
                  </div>
                </div>

              </div>
              <div class="card">
                <?php
                if (isset($_GET['fpid'])) {
                  $product_id = $_GET['fpid'];
                  $result = $mysqli->query("select * from products where id=$product_id") or die($mysqli->error);
                  $row = $result->fetch_array();
                  $pid = $row['id'];
                  $pname = $row['product_name'];
                  $sid = $row['supplier_id'];
                  $quantity = $row['quantity'];
                  $cpi =$row['cost_per_item'];
                  $total=$row['total_cost'];
                  $s_finance=$_SESSION['username'];
                  $finance = $mysqli->query("select * from finance_manager where email='$s_finance'") or die($mysqli->error);
                  $frow = $finance->fetch_array();
                  $fid = $frow['id'];
                  echo "input product cost";
                } else {
                  echo "hi there ignore me";
                }
                ?>
                <div class="card-header card-header-primary">
                  <h3 class="card-title">
                    <h3>Product</h3>
                    <!--card body-->
                    <div class="card-body">
                      <div class="row justify-content-center ">
                        <div class="form-group">
                          <form method='POST' action='confirm_req_update.php' enctype="multipath/form-data">
                         
                            <input type='text' name='pid' value='<?php echo $_GET['fpid']; ?>' readonly  hidden/></br>
                            <input type='text' name='sid' value='<?php echo $sid ?>' readonly  hidden/></br>
                            <input type='text' name='fid' value='<?php echo $fid ?>' readonly hidden/></br>
                            <label for="customer_name">Product Name</label>
                            <input type="text" class="form-control" id="customer_name" placeholder="customer name" value='<?php echo $pname; ?>' required readonly>
                            <label for="email">Quantity</label>
                            <input type="text" class="form-control" id="occupation" placeholder="email" value='<?php echo $quantity; ?>'readonly required><br />
                            <label for="location">Total Cost</label>
                            <input type="text" class="form-control" id="location" placeholder="price per item" name="amount" value='<?php echo $total; ?>' required readonly><br />
                            <label for="customer_name">Batch_NO</label>
                            <input type="text" class="form-control" id="customer_name" placeholder="Batch Number" name="batch_no" value='<?php echo "BAT00$pid"; ?>' required readonly>
                            <label for="email">Purchase Date</label>
                            <input type="date" class="form-control" id="occupation" placeholder="Purchase Date" name="pdate" required><br />
                            <label for="location">Transaction ID</label>
                            <input type="text" class="form-control" id="location" placeholder="Transaction ID" name="tid" required><br />
                            <input type='submit' name='update_request' class='btn btn-success' value='confirm' />
                            
                          </form>





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
    <strong>Copyright &copy; <a href="http://elton.html">eltonokoth 2023</a>.</strong>
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