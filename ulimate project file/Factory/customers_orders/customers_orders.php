<?php
session_start();
include '../config.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customers & Orders</title>
    <style>
        body {
            background-image: url('../images/fabric_1.png'); 
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;

            font-family: Arial, sans-serif;
            background-color: #f5f6fa;
            margin: 0;
            padding: 20px;
        }

        .top-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .back-button {
            text-decoration: none;
            color: white;
            background-color: #718093;
            padding: 8px 16px;
            border-radius: 5px;
            font-size: 14px;
        }

        .container {
            max-width: 600px;
            margin: 40px auto;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #2f3640;
        }

        ul {
            list-style-type: none;
            padding: 0;
            text-align: center;
        }

        li {
            margin: 15px 0;
        }

        a.link-button {
            text-decoration: none;
            background-color: #00a8ff;
            color: white;
            padding: 12px 24px;
            border-radius: 8px;
            font-size: 16px;
            display: inline-block;
        }

        a.link-button:hover {
            background-color: #0097e6;
        }
    </style>
</head>
<body>

    <div class="top-bar">
        <a href="../index.php" class="back-button">← Back to Home</a>
    </div>

    <div class="container">
        <h1>Customers & Orders</h1>

        <ul>
            <li><a class="link-button" href="customers.php">Manage Customers</a></li>
            <li><a class="link-button" href="orders.php">Manage Orders</a></li>
        </ul>
    </div>

</body>
</html>
