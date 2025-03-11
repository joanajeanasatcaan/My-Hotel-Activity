<?php
require_once 'database.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $guest = getGuest($conn, $id);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($id)) {
    $firstname = $_POST['firstname'] ?? '';
    $lastname = $_POST['lastname'] ?? '';
    $email = $_POST['email'] ?? '';
    $photo = $guest['photo'] ?? ''; 
    $document = $guest['document'] ?? ''; 

    if (!empty($_FILES['photo']['name'])) {
        $targetDir = "uploads/";
        $photo = basename($_FILES['photo']['name']);
        $targetFilePath = $targetDir . $photo;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        $allowedImageTypes = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        if (in_array(strtolower($fileType), $allowedImageTypes)) {
            if (move_uploaded_file($_FILES['photo']['tmp_name'], $targetFilePath)) {
                echo "<script>alert('Photo uploaded successfully.');</script>";
            } else {
                echo "<script>alert('Error uploading photo.');</script>";
            }
        } else {
            echo "<script>alert('Invalid image type. Only JPG, JPEG, PNG, GIF, WEBP files are allowed.');</script>";
        }
    }

    if (!empty($_FILES['document']['name'])) {
        $targetDir = "uploads/";
        $document = basename($_FILES['document']['name']);
        $targetFilePath = $targetDir . $document;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        $allowedDocumentTypes = ['pdf', 'doc', 'docx', 'ppt', 'pptx', 'txt', 'xls', 'xlsx'];
        if (in_array(strtolower($fileType), $allowedDocumentTypes)) {
            if (move_uploaded_file($_FILES['document']['tmp_name'], $targetFilePath)) {
                echo "<script>alert('Document uploaded successfully.');</script>";
            } else {
                echo "<script>alert('Error uploading document.');</script>";
            }
        } else {
            echo "<script>alert('Invalid document type. Only PDF, DOC, DOCX, PPT, PPTX, TXT, XLS, XLSX files are allowed.');</script>";
        }
    }

    if (!empty($firstname) && !empty($lastname) && !empty($email)) {
        updateGuest($conn, $id, $firstname, $lastname, $email, $photo, $document); 
        header("Location: myGuests.php"); 
        exit();
    } else {
        echo "<script>alert('Please fill in all required fields.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Guest</title>
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
        </div>
    </div>
    <h1>Update Guest Information</h1>

    <div class="container">
        <form method="post" enctype="multipart/form-data">
            <label for="firstname">First Name:</label>
            <input type="text" name="firstname" id="firstname" value="<?php echo htmlspecialchars($guest['firstname'] ?? ''); ?>" required>

            <label for="lastname">Last Name:</label>
            <input type="text" name="lastname" id="lastname" value="<?php echo htmlspecialchars($guest['lastname'] ?? ''); ?>" required>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($guest['email'] ?? ''); ?>" required>

            <label for="photo">New Photo (Optional):</label>
            <input type="file" name="photo" accept=".jpg, .jpeg, .png, .gif, .webp">

            <label for="document">New Document (Optional):</label>
            <input type="file" name="document" accept=".pdf, .doc, .docx, .ppt, .pptx, .txt, .xls, .xlsx">

            <button type="submit">Update</button>
            <a href="myGuests.php">Cancel</a>
        </form>
    </div>
</body>

</html>
