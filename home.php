<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - My Hotel</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #ff5c8d;
            padding: 10px 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        
        .navbar .logo {
            font-size: 28px;
            font-weight: bold;
            color: white;
        }
        
        .navbar .menu {
            display: flex;
            gap: 20px;
        }
        
        .navbar .menu a {
            color: white;
            text-decoration: none;
            font-size: 16px;
            padding: 8px 15px;
            border-radius: 20px;
            transition: background 0.3s;
        }
        
        .navbar .menu a:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        .hero {
            background-image: url('https://images.rawpixel.com/image_800/cHJpdmF0ZS9sci9pbWFnZXMvd2Vic2l0ZS8yMDIzLTAzL3JtNjA2ZGVzaWduLXJlbWl4LWJnLTEzLWEuanBn.jpg');
            background-size: cover;
            background-position: center;
            height: 60vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            padding: 0 20px;
            text-align: center;
        }

        .hero h1 {
            font-size: 48px;
            margin: 0;
        }

        .hero p {
            font-size: 22px;
        }
        .actions {
            margin-top: 30px;
        }

        .actions a {
            text-decoration: none;
            color: white;
            background-color: #ff5c8d;
            padding: 10px 20px;
            border-radius: 5px;
            margin: 10px;
            transition: background 0.3s;
            display: inline-block;
        }

        .actions a:hover {
            background-color: #d14789;
        }

        .content {
            justify-content: center;
            padding: 40px 20px;
        }

        .content h2 {
            color: #ff5c8d;
            margin-bottom: 20px;
        }

        .footer {
            background-color: #333;
            color: white;
            padding: 10px 0;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <div class="logo">My Hotel</div>
        <div class="menu">
            <a href="home.php">Home</a>
            <a href="addGuests.php">Add Guest</a>
            <a href="myGuests.php">Guests List</a>
            <a href="logs.php">System Logs</a>

        </div>
    </div>

    <div class="hero">
        <div>
            <h1>Welcome to My Hotel</h1>
            <p>Manage your guests with ease and style.</p>
        </div>
    </div>

    <div class="content">
        <h2>Get Started</h2>
        <div class="actions">
            <a href="addGuests.php">Add New Guest</a>
            <a href="myGuests.php">View Guests List</a>
        </div>
    </div>

    <div class="footer">
        &copy; <?php echo date("Y"); ?> My Hotel. All rights reserved.
    </div>
</body>
</html>
