<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if (empty($_POST["id"])) {
    die("ID is required");
}
if (empty($_POST["name"])) {
    die("Name is required");
}
if (empty($_POST["author"])) {
    die("Author is required");
}
if (empty($_POST["quantity"])) {
    die("Quantity is required");
}
if (empty($_POST["price"])) {
    die("Price is required");
}

$mysqli = require __DIR__ . "/db.php";

$sql = "UPDATE book SET book_name = ?, author = ?, quantity = ?, price = ? WHERE book_id = ?";

$stmt = $mysqli->prepare($sql);

if (!$stmt) {
    die("SQL error: " . $mysqli->error);
}

$stmt->bind_param("ssiis",
    $_POST["name"],
    $_POST["author"],
    $_POST["quantity"],
    $_POST["price"],
    $_POST["id"]
);

if ($stmt->execute()) {
    header("Location: index.html");
    exit;
} else {
    echo "Error updating record: " . $stmt->error;
}

$stmt->close();
$mysqli->close();
