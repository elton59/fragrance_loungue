<?php
include("db.php");

if (isset($_POST['username'])) {
    $username = $_POST['username'];
   

    // Fetch email based on the username
    $query = "SELECT email FROM $username WHERE EMAIL = '$username'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        if ($row) {
            $email = $row['email'];
        }
           // Redirect back to feedback form with email as a query parameter
           echo '<script>alert("Record Approved!");
        window.location.replace( feedback.php?email="$email")';
    
    }

 
}
?>
