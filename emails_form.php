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
  <title>Feedback</title>
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

          <h4 class="mb-3">Contact Us</h4>
          <form method="GET" action='feedback.php'>
            <div class="form-group">
              <label for="searchUser">Select User</label>
              <select id="searchUser" name="emails" class="form-control">
                <option value="">Select User</option>
                <option value="finance_manager">finance_manager</option>
                <option value="drivers">drivers</option>
                <option value="stock_manager">stock_manager</option>
                <option value="admininfo">Admin</option>
              </select><br/>
              <input type='submit' class='btn btn-success'value='Get Email'/>
            </div>
            <div class="form-group">
              
            </div>
            <form>
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

  function getUserEmail() {
    var username = document.getElementById('searchUser').value;

    if (username) {
      // Create a form and submit it to get_user_email.php
      var form = document.createElement('form');
      form.method = 'POST';
      form.action = 'get_user_email.php';

      var input = document.createElement('input');
      input.type = 'hidden';
      input.name = 'username';
      input.value = username;

      form.appendChild(input);
      document.body.appendChild(form);
      form.submit();
    } else {
      alert('Please select a user.');
    }
  }
</script>

</body>
</html>
