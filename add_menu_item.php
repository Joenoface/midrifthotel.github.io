<?php
// Database connection parameters
$servername = "localhost"; // Your server name
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "midrift"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data and escape inputs to prevent SQL injection
    $item_name = $conn->real_escape_string($_POST['item_name']);
    $price = $_POST['price'];
    $description = $conn->real_escape_string($_POST['description']);

    // Insert data into the roastoast_menu table
    $sql = "INSERT INTO roastoast_menu (item_name, price, description) 
            VALUES ('$item_name', '$price', '$description')";

    if ($conn->query($sql) === TRUE) {
        echo "<p style='color:green;'>New menu item added successfully!</p>";
    } else {
        echo "<p style='color:red;'>Error: " . $sql . "<br>" . $conn->error . "</p>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Menu Item</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 50px;
        }
        form {
            max-width: 400px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
        }
        label {
            display: block;
            margin-bottom: 10px;
        }
        input[type="text"], input[type="number"], textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

    <h2>Add New Item to Roastoast Menu</h2>

    <form action="" method="POST">
        <label for="item_name">Item Name</label>
        <input type="text" id="item_name" name="item_name" required>

        <label for="price">Price (USD)</label>
        <input type="number" id="price" name="price" step="0.01" required>

        <label for="description">Description</label>
        <textarea id="description" name="description" rows="4" required></textarea>

        <button type="submit">Add Menu Item</button>
    </form>

</body>
</html>
