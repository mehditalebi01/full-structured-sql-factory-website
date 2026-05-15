<?php
require_once '../config.php';
$suppliers = mysqli_query($conn, "SELECT SupplierID, CompanyName FROM Supplier");

if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $unit = $_POST['unit'];
    $cost = $_POST['cost'];
    $stock = $_POST['stock'];
    $supplier_id = $_POST['supplier_id'];

    mysqli_query($conn, "
        INSERT INTO rawmaterial (Name, Unit, CostPerUnit, StockQuantity, SupplierID)
        VALUES ('$name', '$unit', $cost, $stock, $supplier_id)
    ");

    header("Location: raw_materials.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Add Raw Material</title>
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

<a class="btn-back" href="raw_materials.php">← Back to Raw Materials</a>

<div class="form-box">
    <h2>Add Raw Material</h2>
    <form method="POST">
        <input type="text" name="name" placeholder="Material Name" required>
        <input type="text" name="unit" placeholder="Unit (e.g. kg, litre)" required>
        <input type="number" step="0.01" name="cost" placeholder="Cost Per Unit (€)" required>
        <input type="number" name="stock" placeholder="Stock Quantity" required>
        <label>Supplier</label>
        <select name="supplier_id" required>
            <option value="">Select Supplier</option>
            <?php while ($s = mysqli_fetch_assoc($suppliers)): ?>
                <option value="<?= $s['SupplierID'] ?>"><?= htmlspecialchars($s['CompanyName']) ?></option>
            <?php endwhile; ?>
        </select>
        <input class="btn" type="submit" name="add" value="Add Material">
    </form>
</div>

</body>
</html>
