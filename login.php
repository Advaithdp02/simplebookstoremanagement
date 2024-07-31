<?php
$host = "localhost";
$dbname = "bookstore";
$username = "root";
$password = "";

$mysqli = new mysqli($host, $username, $password, $dbname);

if ($mysqli->connect_errno) {
    die("Connection error: " . $mysqli->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get username and password from the form
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Input validation (basic example)
    if (empty($username) || empty($password)) {
        die("Username and password are required.");
    }

    // Prepare the statement to prevent SQL injection
    $stmt = $mysqli->prepare("SELECT * FROM login WHERE admin = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Successful login, handle accordingly (e.g., session start, redirect)
        session_start();
        $_SESSION['admin'] = $result->fetch_assoc()['admin']; // Assuming a user_id column
        header('Location: index.html'); // Replace with desired redirect
        exit;
    } else {
        echo "Incorrect username or password"; // Or handle error appropriately
    }

    $stmt->close();
}
?>
