<?php
require_once '../config.php';

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    mysqli_query($conn, "DELETE FROM rawmaterial WHERE RawMaterialID = $id");
    header("Location: raw_materials.php");
    exit();
}

$query = "
    SELECT r.*, s.CompanyName
    FROM rawmaterial r
    LEFT JOIN supplier s ON r.SupplierID = s.SupplierID
    ORDER BY r.Name ASC
";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Raw Materials</title>
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

        .btn {
            padding: 6px 12px;
            background-color: #00a8ff;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-size: 13px;
            margin: 0 2px;
        }

        .btn:hover {
            background-color: #0077cc;
        }

        .btn-delete {
            background-color: crimson;
        }

        .btn-add {
            display: block;
            width: fit-content;
            margin: 20px auto;
            background-color: green;
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
<h2>Raw Materials</h2>

<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Unit</th>
            <th>Cost/Unit (€)</th>
            <th>In Stock</th>
            <th>Supplier</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?= htmlspecialchars($row['Name']) ?></td>
            <td><?= htmlspecialchars($row['Unit']) ?></td>
            <td><?= $row['CostPerUnit'] ?></td>
            <td><?= $row['StockQuantity'] ?></td>
            <td><?= htmlspecialchars($row['CompanyName'] ?? 'N/A') ?></td>
            <td>
                <a class="btn" href="raw_details.php?id=<?= $row['RawMaterialID'] ?>">Details</a>
                <a class="btn btn-delete" href="?delete=<?= $row['RawMaterialID'] ?>" onclick="return confirm('Delete this material?')">Delete</a>
            </td>
        </tr>
    <?php endwhile; ?>
    </tbody>
</table>

<a class="btn btn-add" href="add_raw.php">+ Add New Raw Material</a>

</body>
</html>

