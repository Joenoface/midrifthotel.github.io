<?php
// Database connection
$host = 'localhost'; // Update with your host
$db = 'midrift';
$user = 'root'; // Update with your database username
$pass = ''; // Update with your database password

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$password = $_POST['password'];
$phone_number = $_POST['phone_number'];
$address = $_POST['address'];

// Hash the password for security
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO customer (first_name, last_name, email, password, phone_number, address) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ssssss', $first_name, $last_name, $email, $hashed_password, $phone_number, $address);

if ($stmt->execute()) {
    echo "Sign up successful!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
