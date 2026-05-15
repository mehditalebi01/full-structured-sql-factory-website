<?php
require_once '../config.php';
$sql = "
    SELECT f.FactoryID, f.Name AS FactoryName, f.Status,
           e.Name AS ManagerName
    FROM factory f
    LEFT JOIN manager m ON f.ManagerID = m.EmployeeID
    LEFT JOIN employee e ON m.EmployeeID = e.EmployeeID
    ORDER BY f.Status DESC, f.Name ASC
";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Factories</title>
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
            width: 90%;
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

        .details-btn {
            padding: 8px 16px;
            background-color: #00a8ff;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-size: 14px;
        }

        .details-btn:hover {
            background-color: #0077cc;
        }

        .status-active {
            color: green;
            font-weight: bold;
        }

        .status-inactive {
            color: red;
            font-weight: bold;
        }

        .back-link {
            display: inline-block;
            margin-bottom: 20px;
            text-decoration: none;
            color: #718093;
            font-size: 14px;
        }

        .action-links {
            text-align: center;
            margin-top: 40px;
        }
    </style>
</head>
<body>

<a class="back-link" href="../index.php">← Back to Home</a>

<h2>Factory List</h2>

<table>
    <thead>
        <tr>
            <th>Factory Name</th>
            <th>Status</th>
            <th>Manager</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($row['FactoryName'] ?? 'N/A') ?></td>
            <td class="<?= $row['Status'] == 'Active' ? 'status-active' : 'status-inactive' ?>">
                <?= htmlspecialchars($row['Status'] ?? '-') ?>
            </td>
            <td><?= htmlspecialchars($row['ManagerName'] ?? 'N/A') ?></td>
            <td>
                <a class="details-btn" href="factory_details.php?id=<?= $row['FactoryID'] ?>">Details</a>
            </td>
        </tr>
    <?php endwhile; ?>
    </tbody>
</table>

<div class="action-links">
    <a href="products.php" class="details-btn">Manage Products</a>
    <a href="raw_materials.php" class="details-btn" style="margin-left: 20px;">Manage Raw Materials</a>
</div>

</body>
</html>
