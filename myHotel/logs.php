<?php
require 'database.php';

$logs = fetchLogs($conn);
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logs</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f9;
            text-align: center;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #ff5c8d;
            padding: 0px 20px;
            color: white;
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
            background: rgba(255, 255, 255, 0.2);
        }

        h1 {
            color: #ff5c8d;
            margin-top: 20px;
        }

        a {
            display: inline-block;
            margin: 20px;
            text-decoration: none;
            color: #ff5c8d;
            font-weight: bold;
            border: 2px solid #ff5c8d;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background 0.3s, color 0.3s;
        }

        a:hover {
            background-color: #ff5c8d;
            color: white;
        }

        .container {
            display: flex;
            flex-direction: row-reverse;
            width: 30%;
            margin: 20px auto;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
            padding-top: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            width: 300px;
            margin: 0 auto;
        }

        form label {
            text-align: left;
            margin-top: 10px;
            font-weight: bold;
            color: #333;
        }

        form input[type="text"],
        form input[type="email"],
        form input[type="file"] {
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            margin-top: 15px;
        }

        button {
            background: #d14789;
            color: white;
            padding: 10px;
            border: none;
            width: 100%;
            margin-top: 10px;
            cursor: pointer;
            border-radius: 5px;
        }

        button:hover {
            background: #a8326a;
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
    <h2>System Logs</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Error Message</th>
                <th>Error Time</th>
            </tr>
        </thead>
        <tbody>
            <?php if($logs && $logs->num_rows > 0) : ?>
                <?php while($row = $logs->fetch_assoc()) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                        <td><?php echo htmlspecialchars($row['error_message']); ?></td>
                        <td><?php echo htmlspecialchars($row['error_time']); ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else : ?>
                <tr>
                    <td colspan="3">No logs found</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
