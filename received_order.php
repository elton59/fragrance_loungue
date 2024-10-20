<?php
include("db.php");

if(isset($_POST['orderid'])) {
    $orderid = $_POST['orderid'];

    $query = "UPDATE orders SET order_status='received' WHERE id=?";
    if ($stmt = $mysqli->prepare($query)) {
        $stmt->bind_param('i', $orderid);
        $stmt->execute();
        $stmt->close();
    }

    header('Location: orders.php');
    exit();
}
?>
