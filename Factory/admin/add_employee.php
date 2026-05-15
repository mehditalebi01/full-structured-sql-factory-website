<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include '../config.php';

$factories = mysqli_query($conn, "SELECT FactoryID, Name FROM Factory");
$offices = mysqli_query($conn, "SELECT OfficeID, Name FROM Office");

if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $nid = $_POST['nid'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $hire_date = $_POST['hire_date'];
    $salary = $_POST['salary'];
    $type = $_POST['type'];

    $sql = "INSERT INTO Employee (Name, NationalID, Phone, Email, HireDate, Salary, Type)
            VALUES ('$name', '$nid', '$phone', '$email', '$hire_date', '$salary', '$type')";
    mysqli_query($conn, $sql);
    $emp_id = mysqli_insert_id($conn);

    if ($type == 'Manager') {
        $level = $_POST['level'];
        $manages_type = $_POST['manages_type'];
        $manages_id = $_POST['manages_id'];
        mysqli_query($conn, "INSERT INTO Manager VALUES ($emp_id, '$level', '$manages_type', $manages_id)");

        if ($manages_type == 'Factory') {
            mysqli_query($conn, "UPDATE Factory SET ManagerID = $emp_id WHERE FactoryID = $manages_id");
        } elseif ($manages_type == 'Office') {
            mysqli_query($conn, "UPDATE Office SET ManagerID = $emp_id WHERE OfficeID = $manages_id");
        }
    } elseif ($type == 'Worker') {
        $factory_id = $_POST['factory_id'];
        $shift = $_POST['shift'];
        $skills = $_POST['skills'];
        $is_fulltime = isset($_POST['is_fulltime']) ? 1 : 0;
        mysqli_query($conn, "INSERT INTO Worker VALUES ($emp_id, $factory_id, '$shift', '$skills', $is_fulltime)");
    } elseif ($type == 'OfficeEmployee') {
        $office_id = $_POST['office_id'];
        $role = $_POST['role'];
        $dept = $_POST['department'];
        mysqli_query($conn, "INSERT INTO OfficeEmployee VALUES ($emp_id, $office_id, '$role', '$dept')");
    }

    header("Location: manage_employees.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Employee</title>
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

        .sub-form {
            display: none;
            margin-top: 10px;
            border: 1px dashed #ccc;
            padding: 15px;
            border-radius: 6px;
            background-color: #f0f3f5;
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
    <script>
        function showSubForm() {
            const type = document.getElementById("type").value;
            document.querySelectorAll('.sub-form').forEach(e => e.style.display = 'none');
            if (type) document.getElementById(type + '-form').style.display = 'block';
        }
    </script>
</head>
<body>
<a href="manage_employees.php" class="btn-back">&larr; Back</a>
<div class="form-box">
    <h2>Add New Employee</h2>
    <form method="POST">
        <input type="text" name="name" placeholder="Full Name" required>
        <input type="text" name="nid" placeholder="National ID" required>
        <input type="text" name="phone" placeholder="Phone" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="date" name="hire_date" required>
        <input type="number" name="salary" placeholder="Salary" required>

        <select name="type" id="type" onchange="showSubForm()" required>
            <option value="">Employee Type</option>
            <option value="Manager">Manager</option>
            <option value="Worker">Worker</option>
            <option value="OfficeEmployee">Office Employee</option>
        </select>

        <div id="Manager-form" class="sub-form">
            <input type="text" name="level" placeholder="Manager Level">
            <select name="manages_type">
                <option value="Factory">Factory</option>
                <option value="Office">Office</option>
            </select>
            <select name="manages_id">
                <option value="">Select Entity</option>
                <optgroup label="Factories">
                    <?php
                    mysqli_data_seek($factories, 0);
                    while ($f = mysqli_fetch_assoc($factories)): ?>
                        <option value="<?= $f['FactoryID'] ?>">Factory: <?= htmlspecialchars($f['Name']) ?></option>
                    <?php endwhile; ?>
                </optgroup>
                <optgroup label="Offices">
                    <?php
                    mysqli_data_seek($offices, 0);
                    while ($o = mysqli_fetch_assoc($offices)): ?>
                        <option value="<?= $o['OfficeID'] ?>">Office: <?= htmlspecialchars($o['Name']) ?></option>
                    <?php endwhile; ?>
                </optgroup>
            </select>
        </div>

        <div id="Worker-form" class="sub-form">
            <input type="number" name="factory_id" placeholder="Factory ID">
            <select name="shift">
                <option value="Morning">Morning</option>
                <option value="Evening">Evening</option>
                <option value="Night">Night</option>
            </select>
            <textarea name="skills" placeholder="Skills (comma separated)"></textarea>
            <label class="checkbox-label"><input type="checkbox" name="is_fulltime"> Full Time</label>
        </div>

        <div id="OfficeEmployee-form" class="sub-form">
            <input type="number" name="office_id" placeholder="Office ID">
            <input type="text" name="role" placeholder="Role">
            <input type="text" name="department" placeholder="Department">
        </div>

        <input type="submit" name="add" value="Add Employee" class="btn">
    </form>
</div>
</body>
</html>
