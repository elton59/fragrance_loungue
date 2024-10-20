// remove_from_cart.php
<?php
session_start();
include('db.php');

if (isset($_POST['product_id']) && isset($_SESSION['username'])) {
    $product_id = $_POST['product_id'];
    $email = $_SESSION['username'];

    $result = $mysqli->query("SELECT customer_id FROM customers WHERE email='$email'");
    $row = $result->fetch_assoc();
    $customer_id = $row['customer_id'];

    $query = "DELETE FROM orders WHERE customer_id='$customer_id' AND product_id='$product_id' AND order_status='pending'";
    
    if ($mysqli->query($query)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to remove product from cart']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
?>
