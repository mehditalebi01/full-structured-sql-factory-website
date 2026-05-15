<?php
require_once '../config.php';

if (!isset($_GET['id'])) {
    die("No material ID provided.");
}

$id = intval($_GET['id']);
$material = mysqli_fetch_assoc(mysqli_query($conn, "
    SELECT r.*, s.CompanyName, s.Email, s.Phone
    FROM rawmaterial r
    LEFT JOIN supplier s ON r.SupplierID = s.SupplierID
    WHERE RawMaterialID = $id
"));

if (!$material) die("Material not found.");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Material Details</title>
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
            width: 140px;
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

<a class="btn-back" href="raw_materials.php">← Back to Raw Materials</a>

<div class="details-box">
    <h2><?= htmlspecialchars($material['Name']) ?></h2>

    <div class="detail-row"><strong>Unit:</strong> <?= htmlspecialchars($material['Unit']) ?></div>
    <div class="detail-row"><strong>Cost/Unit:</strong> €<?= $material['CostPerUnit'] ?></div>
    <div class="detail-row"><strong>Stock:</strong> <?= $material['StockQuantity'] ?></div>
    <div class="detail-row"><strong>Supplier:</strong> <?= htmlspecialchars($material['CompanyName'] ?? 'N/A') ?></div>
    <div class="detail-row"><strong>Phone:</strong> <?= htmlspecialchars($material['Phone'] ?? '-') ?></div>
    <div class="detail-row"><strong>Email:</strong> <?= htmlspecialchars($material['Email'] ?? '-') ?></div>
</div>

</body>
</html>
