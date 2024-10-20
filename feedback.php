<?php
session_start(); // Ensure session is started
include("navbar.php");
include("db.php");
$user = $_POST['username'];
if (isset($_POST['username'])) {
  $user = $_POST['username'];
}

if (isset($_GET['emails'])) {
    $emails = $_GET['emails'];

    // Use prepared statements to prevent SQL injection
    $result=$mysqli->query("SELECT email FROM $emails limit 1")or die;
    while($row=$result->fetch_assoc()){
        $_SESSION['emails'] = $row['email'];
    }} else {
        $_SESSION['emails'] = ''; // Default to empty if no email found
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Feedback - Inaya Water</title>
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
                    <form method="POST" action="process2.php">
                        <label for="fdreceiver">Email</label>
                        <div class="form-group">
                            <input id="fdreceiver" name="fdreceiver" class="form-control" value="<?php echo htmlspecialchars($_SESSION['emails']); ?>" readonly>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="fdmessage" placeholder="Compose Message" required></textarea>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="fdemail" placeholder="Email" value="<?php echo htmlspecialchars($user); ?>" required />
                        </div>
                        <div class="form-group">
                            <input class="form-control btn btn-primary" type="submit" value="Submit" name="createfeedback"/>
                            <input class="form-control btn btn-danger" type="reset" value="Cancel"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Feedback Form -->

        <hr>

        <?php 
        if (isset($_POST['username']) || isset($_SESSION['username'])) {
          echo '
        <!-- Inbox -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Inbox</h3>
              </div>
              <div class="card-body">
                <table id="inboxTable" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>Message ID</th>
                      <th>Sender</th>
                      <th>Message</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>';
                  
                  $username = $_SESSION['username'];
                  $result = $mysqli->query("SELECT * FROM feedback WHERE receiver='$username'") or die($mysqli->error);
                  while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['message']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                    echo "<td>
                            <a href='feedback.php?rmid=" . htmlspecialchars($row['id']) . "' class='btn btn-success'>Mark as read</a>
                            <a href='createfeedback.php' class='btn btn-danger'>Reply</a>
                          </td>";
                    echo "</tr>";
                  }
                  
        echo '
                  </tbody>
                </table>
              </div>
            </div>

            <!-- Handling read and rejected actions -->
            ';
            if (isset($_GET['rmid'])) {
              $id = $_GET['rmid'];
              $result = $mysqli->query("UPDATE feedback SET status='read' WHERE id=$id") or die($mysqli->error);
              echo '<script>alert("Message marked as read!"); window.location.replace("index.php");</script>';
            }

            if (isset($_GET['rjrpid'])) {
              $product_id = $_GET['rjrpid'];
              $result = $mysqli->query("UPDATE products SET status='rejected' WHERE product_id=$product_id") or die($mysqli->error);
              echo '<script>alert("Product rejected!"); window.location.replace("products.php");</script>';
            }
            echo '
            <!-- Sent Messages -->
            <div class="card mt-4">
              <div class="card-header">
                <h3 class="card-title">Sent Messages</h3>
              </div>
              <div class="card-body">
                <table id="sentMessagesTable" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>Message ID</th>
                      <th>Receiver</th>
                      <th>Message</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>';
                  
                  $result = $mysqli->query("SELECT * FROM feedback WHERE email='$username'") or die($mysqli->error);
                  while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['receiver']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['message']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                    echo "</tr>";
                  }

        echo '
                  </tbody>
                </table>
              </div>
            </div>

          </div>
        </div>';
        } else {
            echo "Please log in to view messages.";
        }
        ?>
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
