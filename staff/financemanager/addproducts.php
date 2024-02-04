<?php
session_start();
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
  <?php
  if (isset($_POST['add'])) {






    if (isset($_POST['add'])) {
      $target_dir = "../../img/perfumes/";
      $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
      $uploadOk = 1;
      $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

      // Check if file already exists
      if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
      }

      // Check file size
      if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
      }

      // // Allow certain file formats
      // $allowedExtensions = array("jpg", "jpeg", "png", "gif", "doc", "docx", "pdf");
      // if (!in_array($imageFileType, $allowedExtensions)) {
      //     echo "Sorry, only JPG, JPEG, PNG, GIF, DOC, DOCX, and PDF files are allowed.";
      //     $uploadOk = 0;
      // }

      // Check if $uploadOk is set to 0 by an error
      if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
      } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
          echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
          $img = basename($_FILES["fileToUpload"]["name"]);
        } else {
          echo "Sorry, there was an error uploading your file.";
        }
      }
    }




    $pname = $_POST['pname'];
    $category = $_POST['category'];
    $quantity = $_POST['quantity'];
    $batch_no = $_POST['batch_no'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "fragrance_loungue";
    //create connection
    $mysqli = new mysqli($servername, $username, $password, $db);

    $sql = $mysqli->query("INSERT INTO products(product_name,category,quantity,batch_no,product_img_name) VALUES('$pname','$category','$quantity','$batch_no','$img')") or die($mysqli->error);
    if ($sql) {

      echo "<script>alert('record added successfully');
        window.location.replace('products.php');

            </script>";

    } else {
      echo "<script><alert>('record updation failed');
            </script>";
    }
  }


  ?>
  <div class="wrapper">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark"></h1>
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
                <div class="card-header">
                  <h3 class="card-title">Request For Products</h3>
                </div>
                <div class="card-body">
                  <form role="form" method="POST" enctype="multipart/form-data">
                    <div class="class-body">
                      <div class="form-group">
                        <label for="product_name">ProductName</label>
                        <input type="text" name="pname" placeholder="enter product name" class="form-control" required /> </br>
                        <label for="product_name">Category</label>
                        <select name="category" placeholder="category" class="form-control" required>
                          <option value="floral">Floral</option>
                          <option value="citrus">Citrus</option>
                          <option value="aquatic">Acquatic</option>
                        </select>
                        </br>
                        <label for="quantity">Quantity</label>
                        <input type="text" name="quantity" placeholder="enter quantity" class="form-control" required /><br />
                        <label for="img">Image</label></br>
                        <input type="file" name="fileToUpload" id="fileToUpload" placeholder="upload image" class="form-control" required />
                        <label for="price">Batch NO</label></br>
                        <input type="text" name="batch_no" value="<?php $result = $mysqli->query('select * from products');
                                                                  while ($row = $result->fetch_assoc()) {
                                                                    $bno = $row['id'];
                                                                  }
                                                                  echo $bno ?>" class="form-control" required readonly /><br/>
                        <input type="submit" class="btn btn-info" name="add" value="Request" />
                        <input type="reset" class="btn btn-danger" name="cancel" value="cancel" />
                      </div>
                    </div>
                  </form>
                </div>
              </div>
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
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
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