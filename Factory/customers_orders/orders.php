<?php
require_once '../config.php';

$search = '';
if (isset($_GET['search'])) {
    $search = $_GET['search'];
}


$sql = "
    SELECT o.OrderID, c.FullName, f.Name AS OfficeName, o.OrderDate, o.Status,
           t.AmountPaid
    FROM `order` o
    LEFT JOIN customer c ON o.CustomerID = c.CustomerID
    LEFT JOIN office f ON o.OfficeID = f.OfficeID
    LEFT JOIN transaction t ON o.OrderID = t.OrderID
    WHERE c.FullName LIKE ? OR f.Name LIKE ?
    ORDER BY o.OrderDate DESC
";

$stmt = $conn->prepare($sql);
$searchTerm = "%$search%";
$stmt->bind_param("ss", $searchTerm, $searchTerm);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Orders</title>
    <style>
        body {
            font-family: Arial;
            background-color: #f5f6fa;
            margin: 0;
            padding: 20px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        h2 {
            color: #2f3640;
        }

        .search-box {
            display: flex;
        }

        input[type="text"] {
            padding: 8px;
            width: 200px;
            border-radius: 4px 0 0 4px;
            border: 1px solid #ccc;
        }

        button.search-btn {
            padding: 8px 12px;
            border: none;
            background-color: #00a8ff;
            color: white;
            border-radius: 0 4px 4px 0;
            cursor: pointer;
        }

        table {
            width: 100%;
            background-color: white;
            border-collapse: collapse;
            border-radius: 8px;
            overflow: hidden;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        th {
            background-color: #dcdde1;
        }

        .details-btn {
            background-color: #40739e;
            color: white;
            padding: 6px 12px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 13px;
        }

        .back-link {
            display: inline-block;
            margin-bottom: 15px;
            text-decoration: none;
            color: #718093;
            font-size: 14px;
        }
    </style>
</head>
<body>

    <a class="back-link" href="customers_orders.php">← Back to Customers & Orders</a>

    <div class="header">
        <h2>All Orders</h2>
        <form method="GET" class="search-box">
            <input type="text" name="search" placeholder="Search..." value="<?= htmlspecialchars($search) ?>">
            <button class="search-btn" type="submit">Search</button>
        </form>
    </div>

    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Customer</th>
                <th>Office</th>
                <th>Date</th>
                <th>Status</th>
                <th>Amount Paid (€)</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['OrderID'] ?></td>
                <td><?= htmlspecialchars($row['FullName'] ?? '') ?></td>
                <td><?= htmlspecialchars($row['OfficeName']) ?></td>
                <td><?= $row['OrderDate'] ?></td>
                <td><?= $row['Status'] ?></td>
                <td><?= $row['AmountPaid'] ?? '0.00' ?></td>
                <td>
                    <a class="details-btn" href="order_details.php?order_id=<?= $row['OrderID'] ?>">Details</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>

</body>
</html>
