<?php
// Database connection
$conn = mysqli_connect("localhost", "root", "", "mydatabase");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve form data
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$phone = $_POST['phone']; // Add phone number retrieval

// Secure the inputs
$username = mysqli_real_escape_string($conn, $username);
$email = mysqli_real_escape_string($conn, $email);
$password = mysqli_real_escape_string($conn, $password);
$phone = mysqli_real_escape_string($conn, $phone); // Secure phone number input

// Hash the password (for security)
$passwordHash = password_hash($password, PASSWORD_DEFAULT);

// Insert user data into the database
$sql = "INSERT INTO users (username, email, password, phone) VALUES ('$username', '$email', '$passwordHash', '$phone')"; // Include phone in SQL query

if (mysqli_query($conn, $sql)) {
    // Sign-up successful, redirect to homepage
    header("Location: index.html");
    exit; // Ensure script execution stops after redirection
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>
