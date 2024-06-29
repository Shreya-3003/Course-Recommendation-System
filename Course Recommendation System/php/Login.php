<?php
// Database configuration
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'course_recommendation';

// Create a database connection
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    // You should implement your own user authentication logic here.
    // For example, you can query your database to check if the username and password match.
    // Replace 'users' with the actual table name where user data is stored.
    $sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        // Authentication successful, redirect to a welcome page or perform other actions.
        // Example redirect:
        header("Location:../Home1.html");
        exit();
    } else {
        // Authentication failed, display an error message or redirect to a login error page.
        // Example redirect:
       echo("error");
       
    }
    
    // Close the database connection
    mysqli_close($conn);
}
?>
