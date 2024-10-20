<?php
include("db.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $orderid = $_POST['orderid'];
    $reason = $_POST['reason'];
    
    // Update the order status to rejected and save the reason
    $stmt = $mysqli->prepare("UPDATE orders SET order_status='rejected', comment=? WHERE id=?");
    $stmt->bind_param("si", $reason, $orderid);
    
    if ($stmt->execute()) {
        // Redirect to orders page with success message
        header("Location: orders.php?msg=Order rejected successfully");
    } else {
        // Redirect to orders page with error message
        header("Location: orders.php?msg=Error rejecting order");
    }
    
    $stmt->close();
}
?>
