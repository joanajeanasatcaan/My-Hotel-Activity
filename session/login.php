<?php
include "db.php";
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if($stmt->num_rows) {
        $stmt->bind_result($id, $hashed_password);
        $stmt->fetch();

        if(password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $username;
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Incorrect password.";
        }
    } else {
        $error = "User not found.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: 'Comic Sans MS', cursive, sans-serif;
            background: #ffe6f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background: #fff0f5;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(255, 105, 180, 0.2);
            width: 350px;
        }

        h3 {
            text-align: center;
            margin-bottom: 20px;
            color: #ff66b2;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-top: 8px;
            margin-bottom: 15px;
            border: 1px solid #ffb6c1;
            border-radius: 8px;
            background: #fffafc;
        }

        button {
            width: 100%;
            padding: 10px;
            background: #ff66b2;
            color: #fff;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: #e64d99;
        }

        .message {
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 4px;
        }

        .error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        p {
            text-align: center;
            margin-top: 10px;
            color: #cc6699;
        }

        a {
            color: #ff66b2;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <h3>Login</h3>

        <?php if(!empty($error)) : ?>
            <div class="message error"><?php echo $error; ?></div>
        <?php endif; ?>

        <form action="" method="POST">
            <label for="username">Username:</label>
            <input type="text" name="username" placeholder="Enter username" id="username" required>

            <label for="password">Password:</label>
            <input type="password" name="password" placeholder="Enter password" id="password" required>

            <button type="submit">Login</button>

            <p>Doesn't have an account? <a href="register.php">Register</a></p>
        </form>
    </div>
</body>

</html>
