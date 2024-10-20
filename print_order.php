<?php
include("db.php");

// Retrieve the order ID from the query parameter
$orderid = isset($_GET['orderid']) ? intval($_GET['orderid']) : 0;

// Prepare and execute the query to get the order details
$query = "SELECT * FROM orders WHERE id = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param('i', $orderid);
$stmt->execute();
$result = $stmt->get_result();
$order = $result->fetch_assoc();
$stmt->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Print Order</title>
    <style>
        /* Add styles to make the page print-friendly */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .print-button {
            display: none; /* Hide the print button on the print page */
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</head>
<body>
    <h1>Order Details</h1>
    <table>
        <tr>
            <th>Order ID</th>
            <td><?php echo htmlspecialchars($order['id']); ?></td>
        </tr>
        <tr>
            <th>Customer Name</th>
            <td><?php echo htmlspecialchars($order['customer_name']); ?></td>
        </tr>
        <tr>
            <th>Order Date</th>
            <td><?php echo htmlspecialchars($order['order_date']); ?></td>
        </tr>
        <tr>
            <th>Order Status</th>
            <td><?php echo htmlspecialchars($order['order_status']); ?></td>
        </tr>
        <!-- Add more order details as needed -->
    </table>
    <button class="print-button" onclick="window.print()">Print</button>
</body>
</html>
