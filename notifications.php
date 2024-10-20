<?php
include("navbar.php");
include("db.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Feedback - Fragrance Lounge</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="css/style.min.css" rel="stylesheet">
</head>

<body>

    <main class="mt-5 pt-4">
        <div class="container dark-grey-text mt-5">

            <!-- Feedback Form -->
            <div class="row wow fadeIn">
                <div class="col-md-12 mb-4">
                    <div class="p-4">
                        <h4 class="mb-3">Notifications</h4>
                        <div class="alert alert-info" role="alert">
                            <?php
                            if (isset($_SESSION['username'])) {
                                $user = $_SESSION['username'];
                                $cemail = $_SESSION['username'];
                                $query = "SELECT * FROM customers WHERE email='$cemail' LIMIT 1";
                                $result2 = $mysqli->query($query);
                                $row = $result2->fetch_assoc();
                                $a = $row['customer_id'];
                                $query1 = "SELECT * FROM orders WHERE customer_id='$a'";
                                $result = $mysqli->query($query1);
                                if ($result) {
                                    while ($row = $result->fetch_assoc()) {
                                        $order_id = $row['id'];
                                        $order_status = $row['order_status'];
                                        echo "Your order $order_id is $order_status;<br>";
                                    }
                                }
                            }
                            ?>
                        </div>
                        <!-- End of Notification component -->
                    </div>
                </div>
            </div>
            <!-- Feedback Form -->

            <hr>

            <!-- Display Feedback Messages -->

        </div>
    </main>

   
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
