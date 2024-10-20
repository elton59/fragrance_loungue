<?php
session_start();
include("db.php");
include("sidebar.php");
include("navbar.php");

// Extract product_name from URL
$product_name = isset($_GET['product_name']) ? $_GET['product_name'] : '';

// Fetch product details from the database
if ($product_name) {
  $result = $mysqli->query("SELECT * FROM products WHERE product_name = '$product_name'") or die($mysqli->error);
  $product = $result->fetch_assoc();
}


  if (isset($_POST['restock'])) {

  $pid = $_POST['pid'];
  $quantity = $_POST['quantity'];
  $stock = $_POST['stock'];
  $nquantity=$quantity+$stock;
  $sql = $mysqli->query("UPDATE products SET stock_in='$quantity',quantity='$nquantity', status='pending' where id='$pid'") or die($mysqli->error);
  if ($sql) {
    echo "<script>
            alert('Success');
            window.location.replace('products.php');
          </script>";
  } else {
    echo "<script>
            alert('Record updation failed');
          </script>";
  }
}



?>

<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Fragrance Lounge</title>
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
    <div class="content-wrapper">
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark"></h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
              </ol>
            </div>
          </div>
        </div>
      </div>

      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Restock Products</h3>
                </div>
                <div class="card-body">
                  <?php if ($product) { ?>
                  <form role="form" method="POST" enctype="multipart/form-data">
                    <div class="class-body">
                      <div class="form-group">
                        <label for="product_name">Product Name</label>
                        <input type="hidden" name="pid" value="<?php echo $product['id']; ?>" class="form-control" readonly /> </br>
                        <input type="text" name="pname" value="<?php echo $product['product_name']; ?>" class="form-control" readonly /> </br>
                        <label for="category">Category</label>
                        <input type="text" name="category" value="<?php echo $product['category']; ?>" class="form-control" readonly /></br>
                        <label for="quantity">Stock Balance</label>
                        <input type="text" name="quantity" value="<?php echo $product['stock_balance']; ?>" class="form-control" readonly /><br />
                        <input type="hidden" name="stock" value="<?php echo $product['quantity']; ?>" class="form-control" readonly /><br />
                        <label for="description">Description</label>
                        <input type="text" name="description" value="<?php echo $product['description']; ?>" class="form-control" readonly /><br />
                        <label for="img">Image</label></br>
                        <img src="../../img/perfumes/<?php echo $product['product_img_name']; ?>" alt="Product Image" class="img-fluid" /><br/>
                        <label for="batch_no">Batch No</label></br>
                        <input type="text" name="batch_no" value="<?php echo $product['batch_no']; ?>" class="form-control" readonly /><br/>
                        <input type="text" name="category" value="<?php echo $product['category']; ?>" class="form-control" readonly /></br>
                        <label for="quantity">Quantity</label>
                        <input type="text" name="quantity"  class="form-control"  /><br />
                        <input type="submit" class="btn btn-info" name="restock" value="request" />
                      </div>
                    </div>
                  </form>
                  <?php } else { ?>
                  <p>Product not found.</p>
                  <?php } ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
    <footer class="main-footer">
      <strong>Copyright &copy; <a href="http://elton.html">joyleen 2023</a>.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
      </div>
    </footer>
    <aside class="control-sidebar control-sidebar-dark">
    </aside>
  </div>

  <script src="../../Admin/Admin/plugins/jquery/jquery.min.js"></script>
  <script src="../../Admin/Admin/plugins/jquery-ui/jquery-ui.min.js"></script>
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../../Admin/Admin/plugins/chart.js/Chart.min.js"></script>
  <script src="../../Admin/Admin/plugins/sparklines/sparkline.js"></script>
  <script src="../../Admin/Admin/plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="../../Admin/Admin/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
  <script src="../../Admin/Admin/plugins/jquery-knob/jquery.knob.min.js"></script>
  <script src="../../Admin/Admin/plugins/moment/moment.min.js"></script>
  <script src="../../Admin/Admin/plugins/daterangepicker/daterangepicker.js"></script>
  <script src="../../Admin/Admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <script src="../../Admin/Admin/plugins/summernote/summernote-bs4.min.js"></script>
  <script src="../../Admin/Admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <script src="../../Admin/Admin/dist/js/adminlte.js"></script>
  <script src="../../Admin/Admin/dist/js/pages/dashboard.js"></script>
  <script src="../../Admin/Admin/dist/js/demo.js"></script>
</body>

</html>
