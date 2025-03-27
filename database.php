<?php

$db_server = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "sample";

$conn = new mysqli($db_server, $db_user, $db_password, $db_name);

if ($conn->connect_error) {
    logError($conn, "Connection failed: " . $conn->connect_error);
    die("Connection failed. Check Logs for details.");
}

$tableSql = "CREATE TABLE IF NOT EXISTS MyGuests (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(30) NOT NULL,
    lastname VARCHAR(30) NOT NULL,
    email VARCHAR(50),
    document VARCHAR(500),
    photo VARCHAR(500),
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP)";

$logTableSql = "CREATE TABLE IF NOT EXISTS ErrorLogs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    error_message TEXT NOT NULL,
    error_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP)";

function logError($conn, $message) {
    $stmt = $conn->prepare("INSERT INTO ErrorLogs(error_message) VALUES (?)");
    if ($stmt) {
        $stmt->bind_param("s", $message);
        $stmt->execute();
        $stmt->close();
    }
}

if (!$conn->query($tableSql)) {
    logError($conn, "Error creating MyGuests table: " . $conn->error);
    die("MyGuests table creation failed.");
}

if (!$conn->query($logTableSql)) {
    logError($conn, "Error creating ErrorLogs table: " . $conn->error);
    die("ErrorLogs table creation failed.");
}

$checkData = "SELECT COUNT(*) AS total FROM MyGuests";
$result = $conn->query($checkData);
$row = $result->fetch_assoc();

if ($row['total'] == 0) {
    $insertSql = "INSERT INTO MyGuests (firstname, lastname, email) VALUES
    ('Joana Jean', 'Astacaan', 'joana@gmail.com')";

    if (!$conn->query($insertSql)) {
        die("Error inserting data: " . $conn->error);
    }
}

function fetchGuests($conn) {
    $sql = "SELECT id, firstname, lastname, email, reg_date, photo, document FROM MyGuests ORDER BY id ASC";
    $result = $conn->query($sql);
    if (!$result) {
        logError($conn, "Error fetching guests: " . $conn->error);
        return false;
    }
    return $result;
}

function addGuest($conn, $firstname, $lastname, $email, $photo, $document) {
    $stmt = $conn->prepare("INSERT INTO MyGuests(firstname, lastname, email, photo, document) VALUES (?, ?, ?, ?, ?)");
    if (!$stmt) {
        logError($conn, "Error preparing addGuest statement: " . $conn->error);
        return false;
    }
    $stmt->bind_param("sssss", $firstname, $lastname, $email, $photo, $document);
    if (!$stmt->execute()) {
        logError($conn, "Error executing addGuest statement: " . $stmt->error);
        return false;
    }
    $stmt->close();
    return true;
}

function getGuest($conn, $id) {
    $stmt = $conn->prepare("SELECT * FROM MyGuests WHERE id=?");
    if (!$stmt) {
        logError($conn, "Error preparing getGuest statement: " . $conn->error);
        return false;
    }
    $stmt->bind_param("i", $id);
    if (!$stmt->execute()) {
        logError($conn, "Error executing getGuest statement: " . $stmt->error);
        return false;
    }
    $result = $stmt->get_result()->fetch_assoc();
    $stmt->close();
    return $result;
}

function deleteGuest($conn, $id) {
    $stmt = $conn->prepare("DELETE FROM MyGuests WHERE id=?");
    if (!$stmt) {
        logError($conn, "Error preparing deleteGuest statement: " . $conn->error);
        return false;
    }
    $stmt->bind_param("i", $id);
    if (!$stmt->execute()) {
        logError($conn, "Error executing deleteGuest statement: " . $stmt->error);
        return false;
    }
    $stmt->close();
    return true;
}

function updateGuest($conn, $id, $firstname, $lastname, $email, $photo, $document) {
    $stmt = $conn->prepare("UPDATE MyGuests SET firstname = ?, lastname= ?, email= ?, photo=?, document=? WHERE id=?");
    if (!$stmt) {
        logError($conn, "Error preparing updateGuest statement: " . $conn->error);
        return false;
    }
    $stmt->bind_param("sssssi", $firstname, $lastname, $email, $photo, $document, $id);
    if (!$stmt->execute()) {
        logError($conn, "Error executing updateGuest statement: " . $stmt->error);
        return false;
    }
    $stmt->close();
    return true;
}

function fetchLogs($conn) {
    $sql = "SELECT * FROM ErrorLogs ORDER BY error_time DESC";
    return $conn->query($sql);
}

logError($conn, "Theres an error");

?>
