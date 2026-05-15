<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Factory Management System</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-image: url('images/benjamin-child-GWe0dlVD9e0-unsplash.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            padding: 100px 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            backdrop-filter: blur(3px);
        }

        h1 {
            color: #ffffff;
            margin-bottom: 40px;
            font-size: 36px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.4);
        }

        .section {
            background: rgba(255, 255, 255, 0.4); 
            border-radius: 16px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
            padding: 30px;
            width: 90%;
            max-width: 400px;
            margin-bottom: 30px;
            text-align: center;
            backdrop-filter: blur(6px); 
            border: 1px solid rgba(255, 255, 255, 0.25);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .section:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.3);
        }

        .section h2 {
            font-size: 22px;
            color: #2f3640;
            margin-bottom: 15px;
        }

        .section a {
            display: inline-block;
            padding: 10px 22px;
            background-color:rgba(56, 26, 5, 0.76);
            color: white;
            border-radius: 10px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.2s ease, transform 0.2s ease;
        }

        .section a:hover {
            background-color:rgba(76, 36, 8, 0.76);
            transform: scale(1.05);
        }

        .icon {
            font-size: 28px;
            color: #f1c40f;
            margin-bottom: 10px;
        }

        @media (max-width: 500px) {
            h1 {
                font-size: 26px;
            }

            .section {
                padding: 20px;
            }

            .section h2 {
                font-size: 18px;
            }

            .section a {
                padding: 8px 16px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>

    <h1>Factory Management System</h1>

    <div class="section">
        <div class="icon"><i class="fas fa-users-cog"></i></div>
        <h2>Human Resources</h2>
        <a href="admin/manage_employees.php">Go to HR Management</a>
    </div>

    <div class="section">
        <div class="icon"><i class="fas fa-box-open"></i></div>
        <h2>Customers & Orders</h2>
        <a href="customers_orders/customers_orders.php">Go to Orders</a>
    </div>

    <div class="section">
        <div class="icon"><i class="fas fa-industry"></i></div>
        <h2>Factory & Raw Materials</h2>
        <a href="factory_raw/factories.php">Go to Factory</a>
    </div>
</body>
</html>
