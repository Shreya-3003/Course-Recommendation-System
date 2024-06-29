<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AdminView Page</title>
  <style>
    body {
      font-family: "General Sans-Medium";
      background-image: linear-gradient(#4d99b4, rgb(160, 35, 219));
      width: 100%;
      height: 100vh;
      margin: 0;
      padding: 0;
    }

    table {
      width: 80%;
      margin: 20px auto;
      border-collapse: collapse;
    }

    th,
    td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
      font-weight: 800;
      font-size: large;
    }

    th {
      background-color: #f2f2f2;
    }

    tr:hover {
      background-color: lightcyan;
    }

    input[type="text"],
    input[type="password"] {
      padding: 5px;
      width: 100%;
    }

    /* Navbar Styles */
    .navbar {
      background-color: #333498db;
      padding: 10px 0;
      text-align: center;
    }

    .navbar a {
      text-decoration: none;
      color: #fff;
      font-weight: bold;
      font-size: 18px;
      margin: 0 15px;
      /* Add margin between navbar items */
    }

    .navbar a:hover {
      text-decoration: underline;
    }

    /* Centered Header */
    h1 {
      text-align: center;
      color: #fff;
      margin-top: 20px;
    }
  </style>
</head>

<body>
  <nav class="navbar">
    <a href="../Home1.html">Home View</a>
    <a href="adminview.php">Registeration View</a>
    <a href="process_form.php">Contact us View</a>
    <a href="process_feedback.php">Feedback View</a>
    <a href="process_details.php">User Details View</a>
  </nav>
  <center>
    <h1>User Feedback</h1>
  </center>
  <form action="" method="post">
    <table>
      <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Feedback</th>
        <th>Ratings</th>
        <th>Recommend this site</th>
        <th>Action</th>
      </tr>
      <?php

      $dbHost = "localhost";
      $dbUsername = "root";
      $dbPassword = "";
      $dbName = "course_recommendation";

      $conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      if (isset($_POST['delete'])) {
        $fullNameToDelete = $_POST['fullnameToDelete'];
        $deleteQuery = "DELETE FROM feedback WHERE name = '$fullNameToDelete'";
        if ($conn->query($deleteQuery) === TRUE) {
        } else {
          echo "<p style='color: red;'>Error deleting row: " . $conn->error . "</p>";
        }
      }
      $sql = "Select * from feedback";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {
          echo "<tr>";
          echo "<td>" . $row["name"] . "</td>";
          echo "<td>" . $row["email"] . "</td>";
          echo "<td>" . $row["feedback"] . "</td>";
          echo "<td>" . $row["rating"] . "</td>";
          echo "<td>" . $row["recommend"] . "</td>";
          echo "<td>";
          echo "<form action='' method='post'>";
          echo "<input type='hidden' name='fullnameToDelete' value='" . $row["name"] . "'>";
          echo "<button type='submit' name='delete'>Delete</button>";
          echo "</form>";
          echo "</td>";
          echo "</tr>";
        }
      } else {
        echo "<tr><td colspan='5'>No data available</td></tr>";
      }
      $conn->close();
      ?>
    </table>
  </form>

</body>

</html>