<?php
include "db.php";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if(empty($username) || empty($password)) {
        $error = "All fields are required";
    } else {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $hashed_password);

        if($stmt->execute()) {
            $success = "Register successful <a href='login.php'>Log in</a>";
        } else {
            $error = "Error: " . $stmt->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
        <h3>Register</h3>

        <?php if(!empty($error)) : ?>
            <div class="message error"><?php echo $error; ?></div>
        <?php endif; ?>

        <?php if(!empty($success)) : ?>
            <div class="message success"><?php echo $success; ?></div>
        <?php endif; ?>

        <form action="" method="POST">
            <label for="username">Username:</label>
            <input type="text" name="username" placeholder="Create username" id="username" required>

            <label for="password">Password:</label>
            <input type="password" name="password" placeholder="Create password" id="password" required>

            <button type="submit">Register</button>

            <p>Already have account? <a href="login.php">Login</a></p>
            

        </form>
    </div>
</body>

</html>
