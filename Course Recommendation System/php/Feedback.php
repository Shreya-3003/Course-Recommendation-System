<?php
// Database configuration
$db_host = 'localhost';
$db_user ='root';
$db_pass = '';
$db_name = 'course_recommendation';

// Create a database connection
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $feedback = $_POST["feedback"];
    $rating = $_POST["rating"];
    $recommend = $_POST["recommend"];
    
    // Insert data into the database
    $sql = "INSERT INTO feedback (name, email, feedback, rating, recommend) VALUES ('$name', '$email', '$feedback', '$rating', '$recommend')";
    
    if (mysqli_query($conn, $sql)) {
        echo "Feedback has been successfully submitted.";
        header('Location: ../Home1.html');
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    
    // Close the database connection
    mysqli_close($conn);
}
?>
