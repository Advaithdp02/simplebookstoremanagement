<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BOOKLIST</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    <h1>BOOKLIST</h1>
    <table>
        <tr>
            <th>BOOKID</th>
            <th>BOOKNAME</th>
            <th>AUTHOR</th>
            <th>PUBLISHER</th>
            <th>LANGUAGE</th>
            <th>QUANTITY</th>
            <th>PRICE</th>
        </tr>
        <?php
        $mysqli = require __DIR__ . "/db.php";

        // Updated SQL query to include the language column
        $sql = "SELECT Distinct
                    book.book_id, 
                    book.book_name, 
                    book.author, 
                    book.quantity, 
                    book.price, 
                    publisher.publisher,
                    publisher.language
                FROM 
                    book
                JOIN 
                    main ON book.book_id = main.book_id
                JOIN 
                    publisher ON main.publisher_id = publisher.publisher_id;";

        $result = $mysqli->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . htmlspecialchars($row["book_id"]) . "</td>
                        <td>" . htmlspecialchars($row["book_name"]) . "</td>
                        <td>" . htmlspecialchars($row["author"]) . "</td>
                        <td>" . htmlspecialchars($row["publisher"]) . "</td>
                        <td>" . htmlspecialchars($row["language"]) . "</td>
                        <td>" . htmlspecialchars($row["quantity"]) . "</td>
                        <td>" . htmlspecialchars($row["price"]) . "</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No records found</td></tr>";
        }
        $mysqli->close();
        ?>
    </table>
</body>
</html>
