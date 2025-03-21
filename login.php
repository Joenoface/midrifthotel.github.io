<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'midrift');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the user exists
    $sql = "SELECT customer_id, password FROM customer WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    
    // If user exists, verify password
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($customer_id, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            // Password matches, log the user in
            $_SESSION['customer_id'] = $customer_id;
            echo "Login successful! Redirecting...";
            // Redirect or take any further action here (e.g., header("Location: dashboard.php");)
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No account found with that email.";
    }

    $stmt->close();
    $conn->close();
}
?>
