<?php
if (empty($_POST["id"])) {
    die("ID is required");
}
if (empty($_POST["publisher_id"])) {
    die("Publisher ID is required");
}
if (empty($_POST["name"])) {
    die("Name is required");
}
if (empty($_POST["author"])) {
    die("Author is required");
}
if (empty($_POST["Quantity"])) {
    die("Quantity is required");
}
if (empty($_POST["price"])) {
    die("Price is required");
}

$mysqli = require __DIR__ . "/db.php";

// Insert into book table
$sql = "INSERT INTO book (book_id, book_name, author, quantity, price)
        VALUES (?, ?, ?, ?, ?)";
$stmt = $mysqli->stmt_init();

if (!$stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}
$stmt->bind_param("sssii",
    $_POST["id"],
    $_POST["name"],
    $_POST["author"],
    $_POST["Quantity"],
    $_POST["price"]
);

if (!$stmt->execute()) {
    die("Execute error: " . $stmt->error . " " . $stmt->errno);
}

// Insert into main table
$sql = "INSERT INTO main (publisher_id, book_id)
        VALUES (?, ?)";
$stmt = $mysqli->stmt_init();

if (!$stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}

$stmt->bind_param("ss",
    $_POST["publisher_id"],
    $_POST["id"]  // Use the correct variable here
);

if ($stmt->execute()) {
    header("Location: index.html");
    exit;
} else {
    die("Execute error: " . $stmt->error . " " . $stmt->errno);
}
?>
