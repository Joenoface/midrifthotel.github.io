<?php
// Database connection parameters
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "midrift"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to get all categories and associated products
$sql = "SELECT c.category_name, r.item_name, r.price, r.description
        FROM product_categories pc
        INNER JOIN categories c ON pc.category_id = c.category_id
        INNER JOIN roastoast_menu r ON pc.item_id = r.item_id
        ORDER BY c.category_name, r.item_name";

$result = $conn->query($sql);

// Structure the data
$menu = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $menu[$row['category_name']][] = $row;
    }
}

$conn->close();
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
            background: url('coffee.jpg');
            color: #fff;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .menu-carousel {
            position: relative;
            width: 100%;
            max-width: 600px;
            margin-top: 20px;
            background-color: rgba(59, 59, 59, 0.6);
            
        }
        .category-container {
            display: none; /* Initially hide all categories */
            width: 100%;
            text-align: center;
        }
        .category-container.active {
            display: block; /* Display only the active category */
        }
        .category-preview {
            width: 100px;
            height: 100px;
            background-color: #222;
            color: #ff6600;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 10px auto;
            cursor: pointer;
            border-radius: 50%;
            font-size: 18px;
        }
        .category-name {
            font-size: 16px;
            font-weight: bold;
            margin: 0;

        }
        .menu-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            color: #ff6600;
        }
        .menu-item-description {
            font-size: 0.9em;
            color: #aaa;
        }
        .menu-item-price {
            font-weight: bold;
            color: #aaa;
        }
        .controls {
            margin-top: 20px;
            display: flex;
            justify-content: center;
            gap: 20px;
        }
        .arrow {
            font-size: 30px;
            cursor: pointer;
            color: #ff6600;
            user-select: none;
            background-color: rgba(59, 59, 59, 0.6);
        }
        .note {
            font-size: 0.8em;
            color: #f2f2f2;
            text-align: center;
            margin-top: 20px;
        }
        .heading{
            color: #ff6600;
            background-color: #000;
        }
        .category-container h2{
            color: #f170d1;
        }

         /* Footer */
    footer {
    background-color: #333;
    color: white;
    text-align: center;
    padding: 20px 0;
    margin-top: auto;
    box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
    }
    
    footer p {
    margin: 0;
    font-size: 1em;
    }
    
    </style>
</head>
<body>

<h1 class="heading">Roastoast Coffee Lounge Menu</h1>

    <div class="menu-carousel">
        <?php
        // Display categories and items
        $categoryIndex = 0;
        foreach ($menu as $category_name => $items) {
            $isActive = $categoryIndex === 0 ? 'active' : '';
            echo "<div class='category-container $isActive' data-index='$categoryIndex'>";
            echo "<h2>" . htmlspecialchars($category_name) . "</h2>";

            foreach ($items as $item) {
                echo "<div class='menu-item'>";
                echo "<div>";
                echo "<strong>" . htmlspecialchars($item['item_name']) . "</strong><br>";
                echo "<span class='menu-item-description'>" . htmlspecialchars($item['description']) . "</span>";
                echo "</div>";
                echo "<div class='menu-item-price'>" . htmlspecialchars($item['price']) . "</div>";
                echo "</div>";
            }

            echo "</div>";
            $categoryIndex++;
        }
        ?>
    </div>

    <div class="controls">
        <span class="arrow" id="prev">&larr; Prev</span>
        <span class="arrow" id="next">Next &rarr;</span>
    </div>

    <div class="note">
        <p>All meals served with a side of your choice: French fries / Smashed potatoes / Garden salad</p>
    </div>

    <script>
        let currentIndex = 0;
        const categories = document.querySelectorAll('.category-container');
        const totalCategories = categories.length;

        // Show the current category and hide others
        function showCategory(index) {
            categories.forEach((category, i) => {
                if (i === index) {
                    category.classList.add('active');
                } else {
                    category.classList.remove('active');
                }
            });
        }

        // Next arrow functionality
        document.getElementById('next').addEventListener('click', function() {
            currentIndex = (currentIndex + 1) % totalCategories;
            showCategory(currentIndex);
        });

        // Previous arrow functionality
        document.getElementById('prev').addEventListener('click', function() {
            currentIndex = (currentIndex - 1 + totalCategories) % totalCategories;
            showCategory(currentIndex);
        });

        // Initial display
        showCategory(currentIndex);
    </script>

</body>
<footer>
         <p>&copy; 2024 Midrift Hotel. All rights reserved.</p>
     </footer>
</html>
