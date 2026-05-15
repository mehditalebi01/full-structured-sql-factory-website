<?php
require_once '../config.php';

if (!isset($_GET['order_id'])) {
    die("Order ID is missing.");
}

$orderID = $_GET['order_id'];


$sql = "
    SELECT o.OrderID, o.OrderDate, o.Status,
           c.FullName, f.Name AS OfficeName
    FROM `order` o
    LEFT JOIN customer c ON o.CustomerID = c.CustomerID
    LEFT JOIN office f ON o.OfficeID = f.OfficeID
    WHERE o.OrderID = ?
";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $orderID);
$stmt->execute();
$order = $stmt->get_result()->fetch_assoc();
if (!$order) die("Order not found.");


$product_sql = "
    SELECT p.Name, op.Quantity, op.UnitPriceAtTime
    FROM orderproduct op
    JOIN product p ON op.ProductID = p.ProductID
    WHERE op.OrderID = ?
";
$stmt = $conn->prepare($product_sql);
$stmt->bind_param("i", $orderID);
$stmt->execute();
$products = $stmt->get_result();


$transaction = $conn->query("SELECT * FROM transaction WHERE OrderID = $orderID")->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Details</title>
    <style>
        body {
            background-image: url('../images/fabric_1.png');  
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;            
            
            font-family: Arial; background-color: #f5f6fa; padding: 30px; }
        .container {
            max-width: 800px;
            margin: auto;
            background-color: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 0 10px #ccc;
        }
        h2, h3 { color: #2f3640; margin-bottom: 10px; }
        table {
            width: 100%;
            margin-top: 15px;
            border-collapse: collapse;
            background: #fff;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
        }
        th { background: #dcdde1; }
        .back-link {
            display: block;
            margin-top: 20px;
            text-align: center;
            color: #718093;
            text-decoration: none;
        }
    </style>
</head>
<body>


<div class="container">
    <h2>Order #<?= $order['OrderID'] ?> Details</h2>

    <p><strong>Customer:</strong> <?= htmlspecialchars($order['FullName'] ?? '') ?></p>
    <p><strong>Office:</strong> <?= htmlspecialchars($order['OfficeName']) ?></p>
    <p><strong>Date:</strong> <?= $order['OrderDate'] ?></p>
    <p><strong>Status:</strong> <?= $order['Status'] ?></p>

    <h3>Products Ordered</h3>
    <table>
        <thead>
            <tr><th>Product</th><th>Unit Price</th><th>Quantity</th><th>Subtotal</th></tr>
        </thead>
        <tbody>
        <?php
        $total = 0;
        while ($row = $products->fetch_assoc()):
            $subtotal = $row['UnitPriceAtTime'] * $row['Quantity'];
            $total += $subtotal;
        ?>
            <tr>
                <td><?= htmlspecialchars($row['Name']) ?></td>
                <td><?= number_format($row['UnitPriceAtTime'], 2) ?></td>
                <td><?= $row['Quantity'] ?></td>
                <td><?= number_format($subtotal, 2) ?> €</td>
            </tr>
        <?php endwhile; ?>
        </tbody>
        <tfoot>
            <tr><th colspan="3" style="text-align:right;">Total</th><th><?= number_format($total, 2) ?> €</th></tr>
        </tfoot>
    </table>

    <h3>Payment</h3>
    <?php if ($transaction): ?>
        <p><strong>Paid:</strong> <?= number_format($transaction['AmountPaid'], 2) ?> €</p>
        <p><strong>Method:</strong> <?= $transaction['Method'] ?></p>
        <p><strong>Status:</strong> <?= $transaction['Status'] ?></p>
        <p><strong>Date:</strong> <?= $transaction['PaymentDate'] ?></p>
    <?php else: ?>
        <p>No transaction found for this order.</p>
    <?php endif; ?>

    <a class="back-link" href="orders.php">← Back to Orders</a>
</div>

</body>
</html>
