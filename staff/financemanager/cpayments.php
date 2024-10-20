<?php
session_start();
include("db.php");
include  "sidebar.php";
include  "navbar.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Payments</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../Admin/Admin/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="../../Admin/Admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <link rel="stylesheet" href="../../Admin/Admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="../../Admin/Admin/plugins/jqvmap/jqvmap.min.css">
    <link rel="stylesheet" href="../../Admin/Admin/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="../../Admin/Admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="../../Admin/Admin/plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="../../Admin/Admin/plugins/summernote/summernote-bs4.css">
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
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-body">
                                <p>Pending Payments</p>
                                <table id="example2" class="table table-responsive table-hover">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>FIRSTNAME</th>
                                        <th>LASTNAME</th>
                                        <th>TRANSACTION CODE</th>
                                        <th>PAYMENT DATE</th>
                                        <th>TOTAL COST</th>
                                        <th>STATUS</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $result = $mysqli->query("SELECT payments.id as id, payments.amount as amount, payments.payment_date as payment_date, payments.customer_id as customer_id, payments.order_id as order_id, payments.transaction_code as transaction_code, customers.firstname as customer_firstname, customers.lastname as customer_lastname, payments.payment_status as payment_status FROM payments JOIN customers ON payments.customer_id=customers.customer_id WHERE payments.payment_status='pending' ORDER BY payment_status") or die($mysqli->error);
                                    while ($row = $result->fetch_assoc()) {
                                        echo "
                                            <tr>
                                                <td>{$row['id']}</td>
                                                <td>{$row['customer_firstname']}</td>
                                                <td>{$row['customer_lastname']}</td>
                                                <td>{$row['transaction_code']}</td>
                                                <td>{$row['payment_date']}</td>
                                                <td>{$row['amount']}</td>
                                                <td>{$row['payment_status']}</td>
                                                <td>
                                                    <a href='cpayments.php?ap_pid={$row['id']}&oid={$row['order_id']}' class='btn btn-success'>Approve</a>
                                                    <a href='oders.php?rj_pid={$row['id']}' class='btn btn-danger'>Reject</a>
                                                </td>
                                            </tr>";
                                    }
                                    ?>
                                    </tbody>
                                </table>
                                <a href='../rawreport.php' class='btn btn-danger'>Export to PDF</a>
                            </div>
                        </div>

                        <?php
                        if (isset($_GET['ap_pid'])) {
                            $id = $_GET['ap_pid'];
                            $oid = $_GET['oid'];

                            // Explode oid to remove commas and store as an array
                            $oidArray = explode(',', $oid);

                            // Build a comma-separated string for the IN clause, ensuring each element is properly escaped
                            $oidString = implode(',', array_map('intval', $oidArray));

                            $result1 = $mysqli->query("UPDATE orders SET order_status = 'payment_approved' WHERE id IN ($oidString)") or die($mysqli->error);
                            $result2 = $mysqli->query("UPDATE payments SET payment_status='approved' WHERE id='$id'") or die($mysqli->error);

                            echo '<script>
                                alert("Payment Approved!");
                                window.location.replace("cpayments.php");
                            </script>';
                        }
                        if (isset($_GET['rjoid'])) {
                            $oder_id = $_GET['rjoid'];
                            $result = $mysqli->query("UPDATE oders SET status= 'rejected' WHERE oder_id = $oder_id") or die($mysqli->error);

                            echo '<script>alert("Record Rejected!")</script>';
                        }
                        ?>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <div class="card-body">
                                <p>Approved Payments</p>
                                <table id="example2" class="table table-responsive table-hover">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>FIRSTNAME</th>
                                        <th>LASTNAME</th>
                                        <th>TRANSACTION CODE</th>
                                        <th>PAYMENT DATE</th>
                                        <th>TOTAL COST</th>
                                        <th>STATUS</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $result = $mysqli->query("SELECT payments.id as id, payments.amount as amount, payments.payment_date as payment_date, payments.customer_id as customer_id, payments.order_id as order_id, payments.transaction_code as transaction_code, customers.firstname as customer_firstname, customers.lastname as customer_lastname, payments.payment_status as payment_status FROM payments JOIN customers ON payments.customer_id=customers.customer_id WHERE payments.payment_status='approved' ORDER BY payment_status") or die($mysqli->error);
                                    while ($row = $result->fetch_assoc()) {
                                        echo "
                                            <tr>
                                                <td>{$row['id']}</td>
                                                <td>{$row['customer_firstname']}</td>
                                                <td>{$row['customer_lastname']}</td>
                                                <td>{$row['transaction_code']}</td>
                                                <td>{$row['payment_date']}</td>
                                                <td>{$row['amount']}</td>
                                                <td>{$row['payment_status']}</td>
                                            </tr>";
                                    }
                                    ?>
                                    </tbody>
                                </table>
                                <a href='../rawreport.php' class='btn btn-danger'>Export to PDF</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <strong>Copyright &copy; <a href="http://elton.html">joyleen 2023</a>.</strong>
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
