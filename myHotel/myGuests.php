<?php
require_once 'database.php';

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    deleteGuest($conn, $id);
    header("Location: myGuests.php");
    exit();
}

$dataResult = fetchGuests($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guest List</title>
    <style>
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
    table {
        width: 90%;
        margin: 20px auto;
        border-collapse: collapse;
        background: white;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        overflow: hidden;
    }
    th, td {
        padding: 15px;
        text-align: center;
    }
    th {
        background-color: #ff5c8d;
        color: white;
    }
    tr:nth-child(even) {
        background-color: #f8f8f8;
    }
    tr:hover {
        background-color: #f1f1f1;
    }
    .actions a {
        text-decoration: none;
        color: #ff5c8d;
        font-weight: bold;
        margin: 0 5px;
        transition: color 0.3s;
    }
    .actions a:hover {
        color: #d14789;
    }
    img {
        border-radius: 50%;
        display: block;
        margin: 0 auto;
    }
    i {
        font-size: 15px;
    }
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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

    <h1>Guest List</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Photo</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Registration Date</th>
                <th>Document</th> 
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($dataResult && $dataResult->num_rows > 0) {
                while ($row = $dataResult->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['id']}</td>
                        <td>";
                    if (!empty($row['photo'])) {
                        echo "<img src='uploads/" . $row['photo'] . "' width='50' height='50' class='rounded-circle'>";
                    } else {
                        echo "No Photo";
                    }
                    echo "</td>
                        <td>{$row['firstname']}</td>
                        <td>{$row['lastname']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['reg_date']}</td>
                        <td>";

                    if (!empty($row['document'])) {
                        echo "<a href='uploads/" . $row['document'] . "' target='_blank'><i class='bi bi-file-earmark-arrow-down-fill'></i>" . htmlspecialchars($documentName) . "</a>";
                    
                    } else {
                        echo "No Document";
                    }
                    echo "</td>
                        <td class='actions'>
                            <a href='editGuests.php?id={$row['id']}'>Edit</a> |
                            <a href='?delete={$row['id']}' onclick='return confirm(\"Are you sure you want to delete this guest?\")'>Delete</a>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='8'>No guests found</td></tr>";
            }
            ?>
        </tbody>
    </table>

</body>
</html>
