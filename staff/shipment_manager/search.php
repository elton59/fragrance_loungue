<?php
session_start();
include("../db.php");
include "sidebar.php";
include "navbar.php";
?>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Fragranec Lounge</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="adddrivers.php">New</a></li>
              <li class="breadcrumb-item"><a href="driverdelete.php">Delete</a></li>
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
              <h3 class="card-title">Search Results</h3>
            </div>
            <div class="card-body">
              <?php
              if (isset($_GET['query'])) {
                  $query = $mysqli->real_escape_string($_GET['query']);
                  
                  $searchProducts = $mysqli->query("SELECT * FROM products WHERE product_name LIKE '%$query%' OR category LIKE '%$query%'");
                  $searchCustomers = $mysqli->query("SELECT * FROM customers WHERE firstname LIKE '%$query%' OR lastname LIKE '%$query%' OR email LIKE '%$query%'");

                  echo "<h3>Search Results for '$query':</h3>";

                  if ($searchProducts->num_rows > 0 || $searchCustomers->num_rows > 0) {
                      echo "<ul>";
                      while ($product = $searchProducts->fetch_assoc()) {
                          echo "<li><a href='product.php?id=" . $product['id'] . "'>" . $product['product_name'] . "</a> - " . $product['category'] . "</li>";
                      }
                      while ($customer = $searchCustomers->fetch_assoc()) {
                          echo "<li>" . $customer['firstname'] . " " . $customer['lastname'] . " - " . $customer['email'] . "</li>";
                      }
                      echo "</ul>";
                  } else {
                      echo "<p>No results found.</p>";
                  }
              } else {
                  echo "<p>Please enter a search query.</p>";
              }
              ?>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <footer class="main-footer">
    <strong>Copyright &copy; <a href="http://elton.html">joyleen 2023</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block"></div>
  </footer>
  <aside class="
