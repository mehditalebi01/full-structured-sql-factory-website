<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include '../config.php';

if (!isset($_GET['id'])) {
    die("Employee ID is required.");
}

$emp_id = intval($_GET['id']);
$employee = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM Employee WHERE EmployeeID = $emp_id"));
if (!$employee) die("Employee not found.");

$sub_info = [];
if ($employee['Type'] == 'Manager') {
    $sub_info = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM Manager WHERE EmployeeID = $emp_id"));
    $factories = mysqli_query($conn, "SELECT FactoryID, Name FROM Factory");
    $offices = mysqli_query($conn, "SELECT OfficeID, Name FROM Office");
} elseif ($employee['Type'] == 'Worker') {
    $sub_info = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM Worker WHERE EmployeeID = $emp_id"));
} elseif ($employee['Type'] == 'OfficeEmployee') {
    $sub_info = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM OfficeEmployee WHERE EmployeeID = $emp_id"));
}

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $nid = $_POST['nid'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $hire_date = $_POST['hire_date'];
    $salary = $_POST['salary'];

    mysqli_query($conn, "UPDATE Employee SET Name='$name', NationalID='$nid', Phone='$phone', Email='$email', HireDate='$hire_date', Salary='$salary' WHERE EmployeeID=$emp_id");

    if ($employee['Type'] == 'Manager') {
        $level = $_POST['level'];
        $manages_type = $_POST['manages_type'];
        $manages_id = $_POST['manages_id'];
        mysqli_query($conn, "UPDATE Manager SET Level='$level', ManagesEntityType='$manages_type', ManagesEntityID=$manages_id WHERE EmployeeID=$emp_id");

        if ($manages_type == 'Factory') {
            mysqli_query($conn, "UPDATE Factory SET ManagerID = $emp_id WHERE FactoryID = $manages_id");
        } elseif ($manages_type == 'Office') {
            mysqli_query($conn, "UPDATE Office SET ManagerID = $emp_id WHERE OfficeID = $manages_id");
        }
    } elseif ($employee['Type'] == 'Worker') {
        $factory_id = $_POST['factory_id'];
        $shift = $_POST['shift'];
        $skills = $_POST['skills'];
        $is_fulltime = isset($_POST['is_fulltime']) ? 1 : 0;
        mysqli_query($conn, "UPDATE Worker SET FactoryID=$factory_id, Shift='$shift', Skills='$skills', IsFullTime=$is_fulltime WHERE EmployeeID=$emp_id");
    } elseif ($employee['Type'] == 'OfficeEmployee') {
        $office_id = $_POST['office_id'];
        $role = $_POST['role'];
        $dept = $_POST['department'];
        mysqli_query($conn, "UPDATE OfficeEmployee SET OfficeID=$office_id, Role='$role', Department='$dept' WHERE EmployeeID=$emp_id");
    }

    header("Location: manage_employees.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Employee</title>
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

        .form-box {
            max-width: 500px;
            margin: auto;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #2f3640;
        }

        input, select, textarea, label {
            display: block;
            width: 100%;
            margin: 10px 0;
            padding: 10px;
            font-size: 14px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        input[type="checkbox"] {
            width: auto;
            display: inline-block;
        }

        .checkbox-label {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn {
            background-color: #00a8ff;
            color: white;
            border: none;
            border-radius: 6px;
            padding: 10px;
            cursor: pointer;
            margin-top: 20px;
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
<a href="manage_employees.php" class="btn-back">&larr; Back</a>
<div class="form-box">
    <h2>Edit Employee</h2>
    <form method="POST">
        <input type="text" name="name" value="<?= $employee['Name'] ?>" placeholder="Full Name" required>
        <input type="text" name="nid" value="<?= $employee['NationalID'] ?>" placeholder="National ID" required>
        <input type="text" name="phone" value="<?= $employee['Phone'] ?>" placeholder="Phone" required>
        <input type="email" name="email" value="<?= $employee['Email'] ?>" placeholder="Email" required>
        <input type="date" name="hire_date" value="<?= $employee['HireDate'] ?>" required>
        <input type="number" name="salary" value="<?= $employee['Salary'] ?>" placeholder="Salary" required>

        <?php if ($employee['Type'] == 'Manager') { ?>
            <input type="text" name="level" value="<?= $sub_info['Level'] ?>" placeholder="Manager Level">

            <select name="manages_type">
                <option value="Factory" <?= $sub_info['ManagesEntityType'] == 'Factory' ? 'selected' : '' ?>>Factory</option>
                <option value="Office" <?= $sub_info['ManagesEntityType'] == 'Office' ? 'selected' : '' ?>>Office</option>
            </select>

            <select name="manages_id">
                <option value="">Select Entity</option>
                <optgroup label="Factories">
                    <?php
                    mysqli_data_seek($factories, 0);
                    while ($f = mysqli_fetch_assoc($factories)): ?>
                        <option value="<?= $f['FactoryID'] ?>" <?= ($sub_info['ManagesEntityType'] == 'Factory' && $sub_info['ManagesEntityID'] == $f['FactoryID']) ? 'selected' : '' ?>>
                            Factory: <?= htmlspecialchars($f['Name']) ?>
                        </option>
                    <?php endwhile; ?>
                </optgroup>
                <optgroup label="Offices">
                    <?php
                    mysqli_data_seek($offices, 0);
                    while ($o = mysqli_fetch_assoc($offices)): ?>
                        <option value="<?= $o['OfficeID'] ?>" <?= ($sub_info['ManagesEntityType'] == 'Office' && $sub_info['ManagesEntityID'] == $o['OfficeID']) ? 'selected' : '' ?>>
                            Office: <?= htmlspecialchars($o['Name']) ?>
                        </option>
                    <?php endwhile; ?>
                </optgroup>
            </select>
        <?php } elseif ($employee['Type'] == 'Worker') { ?>
            <input type="number" name="factory_id" value="<?= $sub_info['FactoryID'] ?>" placeholder="Factory ID">
            <select name="shift">
                <option value="Morning" <?= $sub_info['Shift'] == 'Morning' ? 'selected' : '' ?>>Morning</option>
                <option value="Evening" <?= $sub_info['Shift'] == 'Evening' ? 'selected' : '' ?>>Evening</option>
                <option value="Night" <?= $sub_info['Shift'] == 'Night' ? 'selected' : '' ?>>Night</option>
            </select>
            <textarea name="skills"><?= $sub_info['Skills'] ?></textarea>
            <label class="checkbox-label">
                <input type="checkbox" name="is_fulltime" <?= $sub_info['IsFullTime'] ? 'checked' : '' ?>> Full Time
            </label>
        <?php } elseif ($employee['Type'] == 'OfficeEmployee') { ?>
            <input type="number" name="office_id" value="<?= $sub_info['OfficeID'] ?>" placeholder="Office ID">
            <input type="text" name="role" value="<?= $sub_info['Role'] ?>" placeholder="Role">
            <input type="text" name="department" value="<?= $sub_info['Department'] ?>" placeholder="Department">
        <?php } ?>

        <input type="submit" name="update" value="Update Employee" class="btn">
    </form>
</div>
</body>
</html>
