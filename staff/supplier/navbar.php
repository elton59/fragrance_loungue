<?php

if (!isset($_SESSION['username'])) {
    header('location:login.php');
    exit();
}
?>

<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="index3.html" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Contact</a>
        </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3" action="search.php" method="GET">
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" name="query" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-comments"></i>
                <span class="badge badge-danger navbar-badge">
                    <?php
                    $uname=$_SESSION['username'];
                    // Assuming $mysqli is already created and connected to the database
                    $result = $mysqli->query("SELECT COUNT(id) AS total FROM feedback WHERE receiver='$uname' and status='pending'");
                    $values = $result->fetch_assoc();
                    $num_rows = $values["total"];
                    echo "$num_rows";
                    ?>
                </span>
            </a>
            <a href="feedback.php">
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header"><a href="feedback.php">View messages</a></span>
            </div></a>
        </li>
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge">15</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">View Notifications</span>
            </div>
        </li>
        <!-- View profiles -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-user"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header"><i class="far fa-user"></i> My profiles</span>
                <a href="logout.php">
                    <span class="dropdown-item dropdown-header"><i class="fas fa-file-export"></i> Logout</span>
                </a>
            </div>
        </li>
    </ul>
</nav>
<!-- /.navbar -->
