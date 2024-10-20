<?php
include("navbar.php");
include("db.php");

 if(!isset($_SESSION['username']))
 {
   header('location:login.php');
 }
$user = $_SESSION['username'];
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
          <h4 class="mb-3">Shipment Cost</h4>
          <h1 class="mb-3">Indoor Delivery Costs</h1>
          <form action="checkout.php" method="get">
            <p>Select Shipping Location:</p>
           
            <input type="radio" name="scost" value="300"> Within Nairobi Ksh 300 <br>
            <input type="radio" name="scost" value="600"> Nairobi Diaspora Ksh 600<br>
            <input type="radio" name="scost" value="1000"> Outside Nairobi Ksh 1000<br><br>

            <!-- Input field for location -->
            <div class="form-group">
              <label for="location">Enter Shipping Location (if none type NA):</label>
              <input type="text" class="form-control" id="location" name="location" placeholder="Enter location" required>
            </div>
            <a href="checkout.php?scost=0&location=NA"> I prefer to visit shop and collect goods</a><br/>
            <button type="submit" class="btn btn-primary">Proceed to Checkout</button>
            <a href="index.php" class="btn btn-primary"> Continue Shopping?</a>
          </form>
        </div>
      </div>
    </div>
    <!-- Feedback Form -->

    <hr>

    <!-- Display Feedback Messages -->

  </div>
</main>

<?php
include("footer.php");
?>

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
