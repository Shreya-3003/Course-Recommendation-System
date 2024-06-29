<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Database configuration
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "course_recommendation"; // Use the name of your database

  // Create a connection to the database
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check the connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Retrieve data from the form
  $name = $_POST["name"];
  $standard = $_POST["standard"];
  $percentage10 = $_POST["percentage10"];
  $percentageScience = $_POST["percentageScience"];
  $percentageCommerce = $_POST["percentageCommerce"];
  $coursePriority1 = $_POST["course1"];
  $coursePriority2 = $_POST["course2"];
  $coursePriority3 = $_POST["course3"];

  // Insert data into the database
  $sql = "INSERT INTO student_info (name, standard, percentage10, percentageScience, percentageCommerce, coursePriority1, coursePriority2, coursePriority3)
            VALUES ('$name', '$standard', $percentage10, $percentageScience, $percentageCommerce, '$coursePriority1', '$coursePriority2', '$coursePriority3')";

  if ($conn->query($sql) === TRUE) {
    echo "Form submitted successfully!";
    header('Location: ../Questionp.html');
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  // Close the database connection
  $conn->close();
} else {
  echo "Form not submitted.";
}
