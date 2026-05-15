<?php
require_once '../config.php';

if (!isset($_GET['id'])) {
    die("No factory ID provided.");
}

$factory_id = intval($_GET['id']);


$factory = mysqli_fetch_assoc(mysqli_query($conn, "
    SELECT f.*, e.Name AS ManagerName
    FROM factory f
    LEFT JOIN manager m ON f.ManagerID = m.EmployeeID
    LEFT JOIN employee e ON m.EmployeeID = e.EmployeeID
    WHERE f.FactoryID = $factory_id
"));

if (!$factory) die("Factory not found.");


$products = mysqli_query($conn, "
    SELECT * FROM product
    WHERE FactoryID = $factory_id
");


$workers = mysqli_query($conn, "
    SELECT e.Name, w.Shift, w.Skills, w.IsFullTime
    FROM worker w
    JOIN employee e ON w.EmployeeID = e.EmployeeID
    WHERE w.FactoryID = $factory_id
");

// مواد اولیه مصرفی
$materials = mysqli_query($conn, "
    SELECT r.Name, fr.QuantityUsed, fr.DateUsed
    FROM factoryrawmaterial fr
    JOIN rawmaterial r ON fr.RawMaterialID = r.RawMaterialID
    WHERE fr.FactoryID = $factory_id
");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Factory Details</title>
    <style>
        body {
            background-image: url('../images/fabric_1.png');  
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            
            font-family: Arial; background-color: #f5f6fa; padding: 30px; }
        h2 { text-align: center; color: #2f3640; margin-top: 40px; }
        .section { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px #ccc; margin-bottom: 30px; width: 90%; margin-left: auto; margin-right: auto; }
        .row { margin: 10px 0; }
        .row strong { width: 150px; display: inline-block; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: center; }
        th { background-color: #dcdde1; }
        .btn-back { display: inline-block; margin-bottom: 20px; text-decoration: none; color: #718093; font-size: 14px; }
    </style>
</head>
<body>

<a class="btn-back" href="factories.php">← Back to Factories</a>

<div class="section">
    <h2>Factory: <?= htmlspecialchars($factory['Name']) ?></h2>
    <div class="row"><strong>Location:</strong> <?= htmlspecialchars($factory['Location']) ?></div>
    <div class="row"><strong>Established:</strong> <?= $factory['EstablishedDate'] ?></div>
    <div class="row"><strong>Status:</strong> <?= $factory['Status'] ?></div>
    <div class="row"><strong>Manager:</strong> <?= htmlspecialchars($factory['ManagerName'] ?? 'N/A') ?></div>
</div>

<div class="section">
    <h2>Products</h2>
    <?php if (mysqli_num_rows($products) > 0): ?>
        <table>
            <tr><th>Name</th><th>Category</th><th>Price</th><th>Stock</th><th>Production</th><th>Expiration</th></tr>
            <?php while ($p = mysqli_fetch_assoc($products)): ?>
                <tr>
                    <td><?= htmlspecialchars($p['Name']) ?></td>
                    <td><?= htmlspecialchars($p['Category']) ?></td>
                    <td>€<?= $p['UnitPrice'] ?></td>
                    <td><?= $p['StockQuantity'] ?></td>
                    <td><?= $p['ProductionDate'] ?></td>
                    <td><?= $p['ExpirationDate'] ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No products found.</p>
    <?php endif; ?>
</div>

<div class="section">
    <h2>Workers</h2>
    <?php if (mysqli_num_rows($workers) > 0): ?>
        <table>
            <tr><th>Name</th><th>Shift</th><th>Skills</th><th>Full Time</th></tr>
            <?php while ($w = mysqli_fetch_assoc($workers)): ?>
                <tr>
                    <td><?= htmlspecialchars($w['Name']) ?></td>
                    <td><?= $w['Shift'] ?></td>
                    <td><?= htmlspecialchars($w['Skills']) ?></td>
                    <td><?= $w['IsFullTime'] ? 'Yes' : 'No' ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No workers found.</p>
    <?php endif; ?>
</div>

<div class="section">
    <h2>Used Raw Materials</h2>
    <?php if (mysqli_num_rows($materials) > 0): ?>
        <table>
            <tr><th>Name</th><th>Quantity</th><th>Date Used</th></tr>
            <?php while ($m = mysqli_fetch_assoc($materials)): ?>
                <tr>
                    <td><?= htmlspecialchars($m['Name']) ?></td>
                    <td><?= $m['QuantityUsed'] ?></td>
                    <td><?= $m['DateUsed'] ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No raw material usage data found.</p>
    <?php endif; ?>
</div>

</body>
</html>
