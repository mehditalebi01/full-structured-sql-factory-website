<?php
require_once '../config.php';


if (!isset($_GET['customer_id'])) {
    die("Customer ID is missing.");
}

$customerID = $_GET['customer_id'];


$stmt = $conn->prepare("SELECT * FROM customer WHERE CustomerID = ?");
$stmt->bind_param("i", $customerID);
$stmt->execute();
$result = $stmt->get_result();
$customer = $result->fetch_assoc();
if (!$customer) die("Customer not found.");


$offices = $conn->query("SELECT OfficeID, Name FROM office");
$products = $conn->query("SELECT ProductID, Name, UnitPrice FROM product");


$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $officeID = $_POST['office'];
    $orderDate = $_POST['order_date'];
    $status = $_POST['status'];

    $conn->begin_transaction();
    try {
        
        $stmt = $conn->prepare("INSERT INTO `order` (CustomerID, OfficeID, OrderDate, Status) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiss", $customerID, $officeID, $orderDate, $status);
        $stmt->execute();
        $orderID = $conn->insert_id;

      
        foreach ($_POST['products'] as $productID => $quantity) {
            if ((int)$quantity > 0) {
                $stmt = $conn->prepare("SELECT UnitPrice FROM product WHERE ProductID = ?");
                $stmt->bind_param("i", $productID);
                $stmt->execute();
                $res = $stmt->get_result();
                $row = $res->fetch_assoc();
                $unitPrice = $row['UnitPrice'];

                $stmt = $conn->prepare("INSERT INTO orderproduct (OrderID, ProductID, Quantity, UnitPriceAtTime) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("iiid", $orderID, $productID, $quantity, $unitPrice);
                $stmt->execute();
            }
        }

        
        $amountPaid = $_POST['amount'];
        $paymentDate = $_POST['payment_date'];
        $method = $_POST['method'];
        $payStatus = $_POST['payment_status'];

        $stmt = $conn->prepare("INSERT INTO transaction (OrderID, PaymentDate, AmountPaid, Method, Status) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("isdss", $orderID, $paymentDate, $amountPaid, $method, $payStatus);
        $stmt->execute();

        $conn->commit();
        header("Location: customers.php");
        exit();
    } catch (Exception $e) {
        $conn->rollback();
        $error = "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Order</title>
    <style>
        body {
            
            background-image: url('../images/fabric_1.png'); 
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;

            font-family: Arial; background-color: #f5f6fa; padding: 30px; }
        .form-container {
            max-width: 700px;
            margin: auto;
            background-color: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 0 10px #ccc;
        }
        h2 { text-align: center; color: #2f3640; }
        label { margin-top: 15px; display: block; font-weight: bold; }
        input, select {
            width: 100%; padding: 10px; font-size: 14px;
            border-radius: 4px; border: 1px solid #ccc; margin-top: 5px;
        }
        .products-table {
            width: 100%; margin-top: 15px; border-collapse: collapse;
        }
        .products-table th, .products-table td {
            border: 1px solid #ccc; padding: 8px;
        }
        button {
            margin-top: 20px; padding: 10px;
            background-color: #00a8ff; color: white; border: none;
            border-radius: 5px; font-size: 16px; cursor: pointer;
        }
        .back-link {
            display: block; margin-top: 20px; text-align: center;
            color: #718093; text-decoration: none;
        }
        .error { color: red; text-align: center; margin-top: 10px; }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Create Order for <?= htmlspecialchars($customer['FullName']) ?></h2>

    <?php if ($error): ?>
        <p class="error"><?= $error ?></p>
    <?php endif; ?>

    <form method="POST">
        <label for="office">Select Office</label>
        <select name="office" id="office" required>
            <?php while ($office = $offices->fetch_assoc()): ?>
                <option value="<?= $office['OfficeID'] ?>"><?= htmlspecialchars($office['Name']) ?></option>
            <?php endwhile; ?>
        </select>

        <label for="order_date">Order Date</label>
        <input type="date" name="order_date" id="order_date" required>

        <label for="status">Order Status</label>
        <select name="status" id="status" required>
            <option value="Pending">Pending</option>
            <option value="Completed">Completed</option>
            <option value="Cancelled">Cancelled</option>
        </select>

        <label>Products</label>
        <table class="products-table">
            <thead>
                <tr><th>Product</th><th>Price</th><th>Quantity</th></tr>
            </thead>
            <tbody>
            <?php while ($product = $products->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($product['Name']) ?></td>
                    <td><?= $product['UnitPrice'] ?></td>
                    <td><input type="number" name="products[<?= $product['ProductID'] ?>]" min="0" value="0"></td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>

        <label for="amount">Amount Paid (€)</label>
        <input type="number" name="amount" id="amount" step="0.01" required>

        <label for="payment_date">Payment Date</label>
        <input type="date" name="payment_date" id="payment_date" required>

        <label for="method">Payment Method</label>
        <select name="method" id="method" required>
            <option value="Cash">Cash</option>
            <option value="Card">Card</option>
            <option value="Online">Online</option>
        </select>

        <label for="payment_status">Payment Status</label>
        <select name="payment_status" id="payment_status" required>
            <option value="Success">Success</option>
            <option value="Failed">Failed</option>
            <option value="Refunded">Refunded</option>
        </select>

        <button type="submit">Submit Order</button>
    </form>

    <a class="back-link" href="customers.php">← Back to Customers</a>
</div>

</body>
</html>
