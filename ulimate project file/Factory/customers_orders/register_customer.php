<?php
require_once '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = $_POST['fullname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $date = $_POST['registered_date'];

    $stmt = $conn->prepare("INSERT INTO customer (FullName, Phone, Email, Address, RegisteredDate) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $fullName, $phone, $email, $address, $date);

    if ($stmt->execute()) {
        header("Location: customers.php");
        exit();
    } else {
        $error = "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register New Customer</title>
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
            background-color: #00a8ff;
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
    <h2>Register New Customer</h2>

    <?php if (!empty($error)): ?>
        <p class="error"><?= $error ?></p>
    <?php endif; ?>

    <form method="POST">
        <label for="fullname">Full Name</label>
        <input type="text" name="fullname" id="fullname" required>

        <label for="phone">Phone</label>
        <input type="text" name="phone" id="phone">

        <label for="email">Email</label>
        <input type="email" name="email" id="email">

        <label for="address">Address</label>
        <textarea name="address" id="address" rows="3"></textarea>

        <label for="registered_date">Registered Date</label>
        <input type="date" name="registered_date" id="registered_date" required>

        <button type="submit">Register</button>
    </form>

    <a class="back-link" href="customers.php">← Back to Customers</a>
</div>

</body>
</html>
