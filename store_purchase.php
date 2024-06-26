<?php
// Retrieve form data
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$product = $_POST['product'];
$quantity = $_POST['quantity'];
$total_price = $_POST['total_price'];

// Replace 'your_username', 'your_password', and 'your_database' with your actual database credentials
$conn = new mysqli('localhost', 'username', 'password', 'mydatabase');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare SQL statement
$stmt = $conn->prepare("INSERT INTO purchases (username, email, password, product, quantity, total_price) VALUES (?, ?, ?, ?, ?, ?)");

// Bind parameters
$stmt->bind_param("ssssdi", $username, $email, $password, $product, $quantity, $total_price);

// Execute SQL statement
if ($stmt->execute()) {
    // Redirect to buyproduct page
    header('Location: index.html');
    exit;
} else {
    echo "Error: " . $stmt->error;
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
