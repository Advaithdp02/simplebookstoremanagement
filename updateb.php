<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (empty($_POST["id"])) {
    die("ID is required");
}
if (empty($_POST["name"])) {
    die("Publisher Name is required");
}
if (empty($_POST["language"])) {
    die("Language is required");
}

$mysqli = require __DIR__ . "/db.php";

$sql = "UPDATE publisher SET publisher = ?, language = ? WHERE publisher_id = ?";

$stmt = $mysqli->prepare($sql);

if (!$stmt) {
    die("SQL error: " . $mysqli->error);
}

$stmt->bind_param("sis",
    $_POST["name"],
    $_POST["language"],
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
?>
