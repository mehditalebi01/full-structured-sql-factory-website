<?php
require_once '../config.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

$factories = mysqli_query($conn, "SELECT FactoryID, Name FROM Factory");

if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $factory_id = $_POST['factory_id'];
    $prod_date = $_POST['production_date'];
    $exp_date = $_POST['expiration_date'];

    $sql = "INSERT INTO product (FactoryID, Name, Category, UnitPrice, StockQuantity, ProductionDate, ExpirationDate)
            VALUES ($factory_id, '$name', '$category', $price, $stock, '$prod_date', '$exp_date')";
    mysqli_query($conn, $sql);

    header("Location: products.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Add Product</title>
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

        .form-box {
            max-width: 500px;
            margin: auto;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px #ccc;
        }

        input, select {
            display: block;
            width: 100%;
            margin: 10px 0;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        .btn {
            background-color: #00a8ff;
            color: white;
            border: none;
            padding: 10px;
            width: 100%;
            margin-top: 15px;
            border-radius: 6px;
            cursor: pointer;
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

<div class="form-box">
    <h2>Add New Product</h2>
    <form method="POST">
        <input type="text" name="name" placeholder="Product Name" required>
        <input type="text" name="category" placeholder="Category" required>
        <input type="number" step="0.01" name="price" placeholder="Unit Price" required>
        <input type="number" name="stock" placeholder="Stock Quantity" required>
        <label>Factory</label>
        <select name="factory_id" required>
            <option value="">Select Factory</option>
            <?php while ($f = mysqli_fetch_assoc($factories)): ?>
                <option value="<?= $f['FactoryID'] ?>"><?= htmlspecialchars($f['Name']) ?></option>
            <?php endwhile; ?>
        </select>
        <label>Production Date</label>
        <input type="date" name="production_date" required>
        <label>Expiration Date</label>
        <input type="date" name="expiration_date" required>

        <input class="btn" type="submit" name="add" value="Add Product">
    </form>
</div>

</body>
</html>
