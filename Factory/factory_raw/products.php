<?php
require_once '../config.php';

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    mysqli_query($conn, "DELETE FROM product WHERE ProductID = $id");
    header("Location: products.php");
    exit();
}

$products = mysqli_query($conn, "
    SELECT p.*, f.Name AS FactoryName
    FROM product p
    LEFT JOIN factory f ON p.FactoryID = f.FactoryID
    ORDER BY p.ProductionDate DESC
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Products</title>
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

        h2 {
            text-align: center;
            color: #2f3640;
        }

        table {
            width: 95%;
            margin: 30px auto;
            background-color: white;
            border-collapse: collapse;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 10px #ccc;
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }

        th {
            background-color: #dcdde1;
        }

        a.btn {
            padding: 6px 12px;
            background-color: #00a8ff;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-size: 13px;
            margin: 0 2px;
        }

        a.btn:hover {
            background-color: #0077cc;
        }

        .btn-add {
            display: block;
            width: fit-content;
            margin: 20px auto;
            background-color: green;
        }

        .btn-delete {
            background-color: crimson;
        }

        .btn-back {
            display: inline-block;
            margin-bottom: 20px;
            text-decoration: none;
            color: #718093;
            font-size: 14px;
        }
    </style>
</head>
<body>

<a class="btn-back" href="../index.php">← Back to Home</a>
<h2>Product List</h2>

<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Category</th>
            <th>Price (€/unit)</th>
            <th>Stock</th>
            <th>Production</th>
            <th>Expiration</th>
            <th>Factory</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php while ($p = mysqli_fetch_assoc($products)): ?>
        <tr>
            <td><?= htmlspecialchars($p['Name']) ?></td>
            <td><?= htmlspecialchars($p['Category']) ?></td>
            <td><?= $p['UnitPrice'] ?></td>
            <td><?= $p['StockQuantity'] ?></td>
            <td><?= $p['ProductionDate'] ?></td>
            <td><?= $p['ExpirationDate'] ?></td>
            <td><?= htmlspecialchars($p['FactoryName'] ?? 'N/A') ?></td>
            <td>
                <a class="btn" href="product_details.php?id=<?= $p['ProductID'] ?>">Details</a>
                <a class="btn btn-delete" href="products.php?delete=<?= $p['ProductID'] ?>" onclick="return confirm('Delete this product?')">Delete</a>
            </td>
        </tr>
    <?php endwhile; ?>
    </tbody>
</table>

<a class="btn btn-add" href="add_product.php">+ Add New Product</a>

</body>
</html>
