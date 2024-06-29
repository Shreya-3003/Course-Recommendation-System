<?php
session_start();
// Database configuration
$dbHost = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "course_recommendation";

// Create a database connection
$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $fullName = $_POST["fullname"];
  $username = $_POST["username"];
  $email = $_POST["email"];
  $password = $_POST["password"]; // Hash the password
  $_SESSION['email'] = $email;
 
  // Insert data into the database
  $sql = "INSERT INTO user (fullname, username, email, password) VALUES ('$fullName', '$username', '$email', '$password')";

  if ($conn->query($sql) === TRUE) {
    echo "Registration successful!";
    header('Location: ../success.html');
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

// Close the database connection
$conn->close();
?>