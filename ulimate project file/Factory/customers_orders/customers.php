<?php
require_once '../config.php';

$search = '';
if (isset($_GET['search'])) {
    $search = $_GET['search'];
}

if (isset($_GET['delete'])) {
    $deleteID = $_GET['delete'];
    
    $delStmt = $conn->prepare("DELETE FROM customer WHERE CustomerID = ?");
    $delStmt->bind_param("i", $deleteID);
    $delStmt->execute();
    
    header("Location: customers.php");
    exit();
}


$sql = "SELECT * FROM customer WHERE FullName LIKE ?";
$stmt = $conn->prepare($sql);
$searchParam = "%$search%";
$stmt->bind_param("s", $searchParam);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Customers</title>
    <style>
        body {
            background-image: url('../images/fabric_1.png');  
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;

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

        .action-btn {
            margin-right: 8px;
            text-decoration: none;
            padding: 6px 10px;
            border-radius: 6px;
            color: white;
            font-size: 13px;
        }

        .edit-btn { background-color: #44bd32; }
        .delete-btn { background-color: #e84118; }
        .order-btn { background-color: #40739e; }

        .register-btn {
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 15px;
            background-color: #273c75;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }

        .back-link {
            text-decoration: none;
            color: #718093;
            font-size: 14px;
            margin-bottom: 15px;
            display: inline-block;
        }
    </style>
</head>
<body>

    <a class="back-link" href="customers_orders.php">← Back to Customers & Orders</a>

    <div class="header">
        <h2>All Customers</h2>
        <form method="GET" class="search-box">
            <input type="text" name="search" placeholder="Search by name..." value="<?= htmlspecialchars($search) ?>">
            <button class="search-btn" type="submit">Search</button>
        </form>
    </div>

    <table>
        <thead>
            <tr>
                <th>CustomerID</th>
                <th>Full Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Address</th>
                <th>Registered Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['CustomerID'] ?></td>
                <td><?= $row['FullName'] ?></td>
                <td><?= $row['Phone'] ?></td>
                <td><?= $row['Email'] ?></td>
                <td><?= $row['Address'] ?></td>
                <td><?= $row['RegisteredDate'] ?></td>
                <td>
                    <a class="action-btn edit-btn" href="edit_customer.php?id=<?= $row['CustomerID'] ?>">Edit</a>
                    <a class="action-btn delete-btn" href="customers.php?delete=<?= $row['CustomerID'] ?>" onclick="return confirm('Are you sure you want to delete this customer?')">Delete</a>

                    <a class="action-btn order-btn" href="create_order.php?customer_id=<?= $row['CustomerID'] ?>">Order</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>

    <a class="register-btn" href="register_customer.php">+ Register New Customer</a>

</body>
</html>
