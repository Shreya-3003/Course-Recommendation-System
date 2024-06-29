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

// Check if the delete request was sent
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the ID or other criteria to identify the data to be deleted
    $idToDelete = $_POST["id"];

    // Construct and execute the SQL query to delete the data
    $name= $_POST['username'];
    $sql = "DELETE FROM user WHERE username = '$name'";
    

    if (mysqli_query($conn, $sql)) {
        echo "Data has been successfully deleted.";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);
?>
