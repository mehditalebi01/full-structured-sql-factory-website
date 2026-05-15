<?php
require_once '../config.php';

if (!isset($_GET['id'])) {
    die("Invalid customer ID");
}

$customerID = $_GET['id'];
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = $_POST['fullname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $date = $_POST['registered_date'];

    $stmt = $conn->prepare("UPDATE customer SET FullName=?, Phone=?, Email=?, Address=?, RegisteredDate=? WHERE CustomerID=?");
    $stmt->bind_param("sssssi", $fullName, $phone, $email, $address, $date, $customerID);

    if ($stmt->execute()) {
        header("Location: customers.php");
        exit();
    } else {
        $error = "Error updating customer: " . $stmt->error;
    }
} else {
    $stmt = $conn->prepare("SELECT * FROM customer WHERE CustomerID = ?");
    $stmt->bind_param("i", $customerID);
    $stmt->execute();
    $result = $stmt->get_result();
    $customer = $result->fetch_assoc();

    if (!$customer) {
        die("Customer not found.");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Customer</title>
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

        .form-container {
            max-width: 500px;
            margin: auto;
            background-color: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 0 10px #ccc;
        }

        h2 {
            text-align: center;
            color: #2f3640;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-top: 15px;
            margin-bottom: 5px;
        }

        input, textarea {
            padding: 10px;
            font-size: 14px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        button {
            margin-top: 20px;
            padding: 10px;
            background-color: #44bd32;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .back-link {
            display: block;
            margin-top: 20px;
            text-align: center;
            color: #718093;
            text-decoration: none;
        }

        .error {
            color: red;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Edit Customer</h2>

    <?php if (!empty($error)): ?>
        <p class="error"><?= $error ?></p>
    <?php endif; ?>

    <form method="POST">
        <label for="fullname">Full Name</label>
        <input type="text" name="fullname" id="fullname" value="<?= htmlspecialchars($customer['FullName']) ?>" required>

        <label for="phone">Phone</label>
        <input type="text" name="phone" id="phone" value="<?= htmlspecialchars($customer['Phone']) ?>">

        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="<?= htmlspecialchars($customer['Email']) ?>">

        <label for="address">Address</label>
        <textarea name="address" id="address" rows="3"><?= htmlspecialchars($customer['Address']) ?></textarea>

        <label for="registered_date">Registered Date</label>
        <input type="date" name="registered_date" id="registered_date" value="<?= $customer['RegisteredDate'] ?>" required>

        <button type="submit">Update</button>
    </form>

    <a class="back-link" href="customers.php">← Back to Customers</a>
</div>

</body>
</html>
