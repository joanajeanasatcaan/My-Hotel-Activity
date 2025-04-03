<?php
session_start();

if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            font-family: 'Comic Sans MS', cursive, sans-serif;
            background: #ffe6f0;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background: #ff99cc;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: #fff;
            border-bottom: 3px solid #ff66b2;
        }

        .navbar h2 {
            margin: 0;
        }

        .logout-btn {
            padding: 8px 16px;
            background: #ff66b2;
            color: #fff;
            text-decoration: none;
            border-radius: 20px;
            transition: 0.3s;
        }

        .logout-btn:hover {
            background: #e64d99;
        }

        .container {
            background: #fff0f5;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(255, 105, 180, 0.2);
            width: 400px;
            margin: 50px auto;
            text-align: center;
        }

        h3 {
            margin-bottom: 20px;
            color: #ff66b2;
        }

        p {
            margin-bottom: 30px;
            color: #cc6699;
        }
    </style>
</head>

<body>

    <div class="navbar">
        <h2>Dashboard</h2>
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>

    <div class="container">
        <h3>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h3>
        <p>You have successfully logged in.</p>
    </div>

</body>

</html>
