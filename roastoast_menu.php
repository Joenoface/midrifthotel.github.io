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

// SQL query to retrieve data from roastoast_menu including the item_id
$sql = "SELECT item_id, item_name, price, description FROM roastoast_menu";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roastoast Menu</title>
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

    <h2>Roastoast Menu</h2>

    <table>
        <thead>
            <tr>
                <th>Item ID</th>
                <th>Item Name</th>
                <th>Price (USD)</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Check if there are results and display them in the table
            if ($result->num_rows > 0) {
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . htmlspecialchars($row['item_id']) . "</td>
                            <td>" . htmlspecialchars($row['item_name']) . "</td>
                            <td>" . htmlspecialchars($row['price']) . "</td>
                            <td>" . htmlspecialchars($row['description']) . "</td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No menu items available</td></tr>";
            }

            // Close the database connection
            $conn->close();
            ?>
        </tbody>
    </table>

</body>
</html>
