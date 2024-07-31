<?php
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

// Insert into publisher table
$sql = "INSERT INTO publisher (publisher_id, publisher, language)
        VALUES (?, ?, ?)";
$stmt = $mysqli->stmt_init();

if (!$stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}
$stmt->bind_param("ssi",
    $_POST["id"],
    $_POST["name"],
    $_POST["language"]
);

if ($stmt->execute()) {
    header("Location: index.html");
    exit;
} else {
    die("Execute error: " . $stmt->error . " " . $stmt->errno);
}
?>
