<?php
// Database configuration
$servername = "localhost";
$username = "root"; // Change this if needed
$password = ""; // Change this if needed
$dbname = "midrift";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$room_type = $checkin_date = $checkout_date = $guests = $requests = "";

// Check if form data is submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Sanitize and validate form inputs
    $room_type = $conn->real_escape_string($_POST['room_type']);
    $checkin_date = $conn->real_escape_string($_POST['checkin_date']);
    $checkout_date = $conn->real_escape_string($_POST['checkout_date']);
    $guests = $conn->real_escape_string($_POST['guests']);
    $requests = $conn->real_escape_string($_POST['requests']);

    // SQL query to insert booking information into the database
    $sql = "INSERT INTO booking (room_type, checkin_date, checkout_date, guests, requests)
            VALUES ('$room_type', '$checkin_date', '$checkout_date', '$guests', '$requests')";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        // If the booking is successful, continue to display confirmation
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        exit;
    }
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Booking confirmation for your stay at Midrift Hotel.">
    <meta name="keywords" content="Midrift Hotel, Nakuru, hotel booking, booking confirmation, luxury hotel">
    <title>Booking Confirmation - Midrift Hotel</title>
    <style>
        /* Your CSS from previous code */

          /* General Styles */
          body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
            background-color: linear-gradient(135deg, #3b3b3b, #944c4c, #0a0a0a);
            line-height: 1.6;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header {
            background: linear-gradient(135deg, #0073e6, #773127);
            color: white;
            padding: 20px 0;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        header h1 {
            margin: 0;
            font-size: 2.5em;
        }

        nav {
            background-color: #333;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        nav a {
            color: white;
            padding: 14px 20px;
            text-decoration: none;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: bold;
            display: inline-block;
        }

        nav a:hover {
            background-color: #0073e6;
            transition: background-color 0.3s ease;
        }

        section {
            padding: 40px 20px;
            max-width: 800px;
            margin: 0 auto;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        section h2 {
            font-size: 2em;
            margin-bottom: 20px;
        }

        .confirmation-details {
            text-align: left;
            margin-bottom: 40px;
        }

        .confirmation-details p {
            margin: 10px 0;
            font-size: 1.2em;
        }

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

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #0073e6;
            color: white;
            border-radius: 4px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #005bb5;
        }
    </style>
</head>
<body>
    <header>
        <h1>Midrift Hotel - Booking Confirmation</h1>
    </header>

    <nav>
        <a href="index.html">Home</a>
        <a href="index.html#about">About Us</a>
        <a href="index.html#rooms">Rooms</a>
        <a href="index.html#services">Services</a>
        <a href="index.html#contact">Contact</a>
    </nav>

    <section>
        <h2>Thank You for Your Booking!</h2>
        <div class="confirmation-details">
            <p><strong>Room Type:</strong> <?php echo htmlspecialchars($room_type); ?></p>
            <p><strong>Check-in Date:</strong> <?php echo htmlspecialchars($checkin_date); ?></p>
            <p><strong>Check-out Date:</strong> <?php echo htmlspecialchars($checkout_date); ?></p>
            <p><strong>Number of Guests:</strong> <?php echo htmlspecialchars($guests); ?></p>
            <p><strong>Additional Requests:</strong> <?php echo htmlspecialchars($requests); ?></p>
        </div>

        <p>We look forward to welcoming you to Midrift Hotel. If you have any questions or need further assistance, please don't hesitate to <a href="hotel.html" class="btn">Contact Us</a>.</p>
        <p>Return to the <a href="index.html" class="btn">Home Page</a> or <a href="booking.html" class="btn">Make Another Booking</a>.</p>
    </section>

    <footer>
        <p>&copy; 2024 Midrift Hotel. All rights reserved.</p>
    </footer>
</body>
</html>
