<?php
require_once '../config.php';

if (!isset($_GET['id'])) {
    die("No product ID provided.");
}

$id = intval($_GET['id']);
$product = mysqli_fetch_assoc(mysqli_query($conn, "
    SELECT p.*, f.Name AS FactoryName
    FROM product p
    LEFT JOIN factory f ON p.FactoryID = f.FactoryID
    WHERE ProductID = $id
"));

if (!$product) die("Product not found.");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Product Details</title>
    <style>
        body {

            background-image: url('../images/fabric_1.png'); 
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;

            font-family: Arial;
            background-color: #f5f6fa;
            padding: 30px;
        }

        .details-box {
            max-width: 500px;
            margin: auto;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px #ccc;
        }

        .detail-row {
            margin: 10px 0;
            font-size: 15px;
        }

        .detail-row strong {
            width: 120px;
            display: inline-block;
        }

        .btn-back {
            display: inline-block;
            margin-bottom: 20px;
            text-decoration: none;
            color: #718093;
            font-size: 14px;
        }

        h2 {
            text-align: center;
        }
    </style>
</head>
<body>

<a class="btn-back" href="products.php">← Back to Products</a>

<div class="details-box">
    <h2><?= htmlspecialchars($product['Name']) ?></h2>

    <div class="detail-row"><strong>Category:</strong> <?= htmlspecialchars($product['Category']) ?></div>
    <div class="detail-row"><strong>Price:</strong> €<?= $product['UnitPrice'] ?></div>
    <div class="detail-row"><strong>Stock:</strong> <?= $product['StockQuantity'] ?></div>
    <div class="detail-row"><strong>Factory:</strong> <?= htmlspecialchars($product['FactoryName']) ?></div>
    <div class="detail-row"><strong>Production Date:</strong> <?= $product['ProductionDate'] ?></div>
    <div class="detail-row"><strong>Expiration Date:</strong> <?= $product['ExpirationDate'] ?></div>
</div>

</body>
</html>
