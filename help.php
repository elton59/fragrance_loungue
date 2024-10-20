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

    <!-- Help Module -->
    <div class="row wow fadeIn">
      <div class="col-md-12 mb-4">
        <div class="p-4">
          <h4 class="mb-3">Help Module</h4>
          <div>
            <h5>Welcome to Fragrance Lounge</h5>
            <p>Welcome to Fragrance Lounge, your premier destination for purchasing high-quality perfumes online. We strive to provide an excellent shopping experience with a wide range of fragrances to choose from. This help module will guide you through the process of registering and purchasing products on our platform.</p>

            <h5>How to Register</h5>
            <p>To register on Fragrance Lounge, follow these steps:</p>
            <ol>
              <li>Click on the "Register" button located at the top-right corner of the homepage.</li>
              <li>Fill in the required information, including your name, email address, and password.</li>
              <li>Click on the "Submit" button to complete the registration process.</li>
              <li>You will receive a confirmation email. Click on the link provided in the email to verify your account.</li>
            </ol>

            <h5>How to Purchase Products</h5>
            <p>Purchasing products on Fragrance Lounge is simple and secure:</p>
            <ol>
              <li>Browse our collection of perfumes and select the ones you wish to purchase.</li>
              <li>Click on the product to view its details, then click the "Add to Cart" button.</li>
              <li>Once you have added all desired products to your cart, click on the "Cart" icon at the top-right corner of the page.</li>
              <li>Review your cart and click on the "Proceed to Checkout" button.</li>
              <li>If you are not logged in, you will be prompted to log in or register.</li>
              <li>Fill in your shipping details and select your preferred payment method.</li>
              <li>Review your order and click on the "Place Order" button to complete the purchase.</li>
              <li>You will receive an order confirmation email with the details of your purchase.</li>
            </ol>

            <h5>Frequently Asked Questions (FAQs)</h5>
            <p><strong>Q1: How can I reset my password?</strong></p>
            <p>A: Click on the "Forgot Password" link on the login page and follow the instructions to reset your password.</p>
            <p><strong>Q2: Can I track my order?</strong></p>
            <p>A: Yes, once your order is shipped, you will receive a tracking number via email.</p>
            <p><strong>Q3: What payment methods are accepted?</strong></p>
            <p>A: We current only support MPESA Option.</p>
            <p><strong>Q4: How can I contact customer support?</strong></p>
            <p>A: Please refer to the Contact Support section below.</p>

            <h5>Contact Support</h5>
            <p>If you need further assistance, our customer support team is here to help. You can reach us through the following methods:</p>
            <ul>
              <li><strong>Email:</strong> joyleen@gmail.com</li>
              <li><strong>Phone:</strong> 07123456789</li>
            
            </ul>

            <p>We hope this help module assists you in having a smooth and enjoyable shopping experience at Fragrance Lounge. If you have any additional questions, please do not hesitate to reach out to our support team. Thank you for choosing Fragrance Lounge!</p>
          </div>
        </div>
      </div>
    </div>
    <!-- Help Module -->

    <hr>

    <!-- Display Feedback Messages -->

  </div>
</main>

<?php
include("footer.php")
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
