<?php
include("db.php");

if (isset($_POST['username'])) {
    $username = $_POST['username'];
    $email = '';

    // Fetch email based on the username
    $query = "SELECT email FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        if ($row) {
            $email = $row['email'];
        }
    }

    // Redirect back to feedback form with email as a query parameter
    header("Location: feedback.php?email=" . urlencode($email));
    exit();
}
?>
