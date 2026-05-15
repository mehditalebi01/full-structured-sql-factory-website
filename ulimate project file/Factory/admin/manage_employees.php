<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include '../config.php';


if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM Manager WHERE EmployeeID = $id");
    mysqli_query($conn, "DELETE FROM Worker WHERE EmployeeID = $id");
    mysqli_query($conn, "DELETE FROM OfficeEmployee WHERE EmployeeID = $id");
    mysqli_query($conn, "DELETE FROM Employee WHERE EmployeeID = $id");
    header("Location: manage_employees.php");
    exit();
}

$search = isset($_GET['search']) ? $_GET['search'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Employees</title>
    <style>
        body {
            
            background-image: url('../images/fabric_1.png'); 
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
                        
            font-family: Arial, sans-serif;
            background-color: #f5f6fa;
            padding: 30px;
        }

        h2.section {
            text-align: center;
            margin-top: 50px;
            color: #2f3640;
        }

        table {
            margin: 20px auto;
            border-collapse: collapse;
            width: 95%;
            background-color: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }

        th {
            background-color: #dcdde1;
        }

        .btn-back {
            display: inline-block;
            margin-bottom: 20px;
            text-decoration: none;
            color: #718093;
            font-size: 14px;
        }

        .btn-add {
            display: block;
            margin: 40px auto 10px auto;
            text-align: center;
            width: fit-content;
            padding: 10px 20px;
            background-color: #00a8ff;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
        }

        .search-box {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 20px;
        }

        .search-box input {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px 0 0 4px;
        }

        .search-box button {
            padding: 8px 12px;
            border: none;
            background-color: #00a8ff;
            color: white;
            border-radius: 0 4px 4px 0;
            cursor: pointer;
        }

        a.action {
            color: #00a8ff;
            text-decoration: none;
            margin: 0 5px;
        }
    </style>
</head>
<body>
    

    <a href="../index.php" class="btn-back">&larr; Back to Home</a>

    <form method="GET" class="search-box">
        <input type="text" name="search" placeholder="Search by name" value="<?= htmlspecialchars($search) ?>">
        <button type="submit">Search</button>
    </form>

    <h2 class="section">Managers</h2>
    <table>
        <tr><th>ID</th><th>Name</th><th>Level</th><th>Manages</th></tr>
        <?php
        $q = mysqli_query($conn, "SELECT e.EmployeeID, e.Name, m.Level, CONCAT(m.ManagesEntityType, ' #', m.ManagesEntityID) AS Manages FROM Manager m JOIN Employee e ON m.EmployeeID = e.EmployeeID WHERE e.Name LIKE '%$search%'");
        while ($row = mysqli_fetch_assoc($q)) {
            echo "<tr><td>{$row['EmployeeID']}</td><td>{$row['Name']}</td><td>{$row['Level']}</td><td>{$row['Manages']}</td></tr>";
        }
        ?>
    </table>

    <h2 class="section">Workers</h2>
    <table>
        <tr><th>ID</th><th>Name</th><th>Factory</th><th>Shift</th><th>Skills</th><th>Full Time</th></tr>
        <?php
        $q = mysqli_query($conn, "SELECT e.EmployeeID, e.Name, w.FactoryID, w.Shift, w.Skills, w.IsFullTime FROM Worker w JOIN Employee e ON w.EmployeeID = e.EmployeeID WHERE e.Name LIKE '%$search%'");
        while ($row = mysqli_fetch_assoc($q)) {
            echo "<tr><td>{$row['EmployeeID']}</td><td>{$row['Name']}</td><td>{$row['FactoryID']}</td><td>{$row['Shift']}</td><td>{$row['Skills']}</td><td>" . ($row['IsFullTime'] ? 'Yes' : 'No') . "</td></tr>";
        }
        ?>
    </table>

    <h2 class="section">Office Employees</h2>
    <table>
        <tr><th>ID</th><th>Name</th><th>Office</th><th>Role</th><th>Department</th></tr>
        <?php
        $q = mysqli_query($conn, "SELECT e.EmployeeID, e.Name, o.OfficeID, o.Role, o.Department FROM OfficeEmployee o JOIN Employee e ON o.EmployeeID = e.EmployeeID WHERE e.Name LIKE '%$search%'");
        while ($row = mysqli_fetch_assoc($q)) {
            echo "<tr><td>{$row['EmployeeID']}</td><td>{$row['Name']}</td><td>{$row['OfficeID']}</td><td>{$row['Role']}</td><td>{$row['Department']}</td></tr>";
        }
        ?>
    </table>

    <h2 class="section">All Employees (with Actions)</h2>
    <table>
        <tr><th>ID</th><th>Name</th><th>Phone</th><th>Email</th><th>Type</th><th>Actions</th></tr>
        <?php
        $all = mysqli_query($conn, "SELECT * FROM Employee WHERE Name LIKE '%$search%'");
        while ($e = mysqli_fetch_assoc($all)) {
            echo "<tr>";
            echo "<td>{$e['EmployeeID']}</td>";
            echo "<td>{$e['Name']}</td>";
            echo "<td>{$e['Phone']}</td>";
            echo "<td>{$e['Email']}</td>";
            echo "<td>{$e['Type']}</td>";
            echo "<td>
                    <a class='action' href='edit_employee.php?id={$e['EmployeeID']}'>Edit</a>
                    |
                    <a class='action' href='?delete={$e['EmployeeID']}' onclick=\"return confirm('Are you sure?')\">Delete</a>
                  </td>";
            echo "</tr>";
        }
        ?>
    </table>
    <a href="add_employee.php" class="btn-add">+ Add New Employee</a>

</body>

</html>
