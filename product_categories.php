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

// SQL query to join product_categories, categories, and roastoast_menu tables
$sql = "SELECT c.category_name, c.category_details, r.item_name, r.price, r.description
        FROM product_categories pc
        INNER JOIN categories c ON pc.category_id = c.category_id
        INNER JOIN roastoast_menu r ON pc.item_id = r.item_id
        ORDER BY c.category_name, r.item_name";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Categories</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 50px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

    <h2>Product Categories</h2>

    <table>
        <thead>
            <tr>
                <th>Category Name</th>
                <th>Category Details</th>
                <th>Item Name</th>
                <th>Price (USD)</th>
                <th>Item Description</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Check if there are results and display them in the table
            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . htmlspecialchars($row['category_name']) . "</td>
                            <td>" . htmlspecialchars($row['category_details']) . "</td>
                            <td>" . htmlspecialchars($row['item_name']) . "</td>
                            <td>" . htmlspecialchars($row['price']) . "</td>
                            <td>" . htmlspecialchars($row['description']) . "</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No products found</td></tr>";
            }

            // Close the database connection
            $conn->close();
            ?>
        </tbody>
    </table>

</body>
</html>
