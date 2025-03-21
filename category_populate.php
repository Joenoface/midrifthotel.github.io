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
    $category_name = $conn->real_escape_string($_POST['category_name']);
    $category_details = $conn->real_escape_string($_POST['category_details']);

    // Insert data into the categories table
    $sql = "INSERT INTO categories (category_name, category_details) 
            VALUES ('$category_name', '$category_details')";

    if ($conn->query($sql) === TRUE) {
        echo "<p style='color:green;'>New category added successfully!</p>";
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
    <title>Add Category</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 50px;
        }
        form {
            max-width: 500px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
        }
        label {
            display: block;
            margin-bottom: 10px;
        }
        input[type="text"], textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <h2>Add New Category</h2>

    <form action="" method="POST">
        <label for="category_name">Category Name</label>
        <input type="text" id="category_name" name="category_name" required>

        <label for="category_details">Category Details</label>
        <textarea id="category_details" name="category_details" rows="4"></textarea>

        <button type="submit">Add Category</button>
    </form>

</body>
</html>
