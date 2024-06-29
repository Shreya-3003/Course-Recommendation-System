<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AdminForm Page</title>
  <style>
    body {
      font-family: "General Sans-Medium";
      background-image: linear-gradient(#4d99b4, rgb(160, 35, 219));
      width: 100%;
      height: 100vh;
      margin: 0;
      /* Remove default margin to avoid extra space */
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
      background-color: lightgray;
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
    }

    .navbar ul {
      list-style: none;
      margin: 0;
      padding: 0;
      text-align: center;
    }

    .navbar li {
      display: inline;
      margin-right: 20px;
    }

    .navbar a {
      text-decoration: none;
      color: #fff;
      font-weight: bold;
      font-size: 18px;
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
    <div class="container-fluid">
      <ul>
        <li><a href="../Home1.html">Home View</a></li>
        <li><a href="adminview.php">Registeration View</a></li>
        <li><a href="process_form.php">Contact us View</a></li>
        <li><a href="process_feedback.php">Feedback View</a></li>
        <li><a href="process_details.php">User Details View</a></li>
      </ul>
    </div>
  </nav>
  <center>
    <h1>User Information</h1>
  </center>
  <form action="" method="post">
    <table>
      <tr>
        <th>Name</th>
        <th>Standard</th>
        <th>10th Percentage</th>
        <th>Science Percentage</th>
        <th>Mathematics Percentage</th>
        <th>Course Priority 1 </th>
        <th>Course Priority 2</th>
        <th>Course Priority 3</th>
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
        $deleteQuery = "DELETE FROM student_info WHERE name = '$fullNameToDelete'";
        if ($conn->query($deleteQuery) === TRUE) {
        } else {
          echo "<p style='color: red;'>Error deleting row: " . $conn->error . "</p>";
        }
      }
      $sql =  $sql = "Select * from student_info";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {
          echo "<tr>";
          echo "<td>" . $row["name"] . "</td>";
          echo "<td>" . $row["standard"] . "</td>";
          echo "<td>" . $row["percentage10"] . "</td>";
          echo "<td>" . $row["percentageScience"] . "</td>";
          echo "<td>" . $row["percentageCommerce"] . "</td>";
          echo "<td>" . $row["coursePriority1"] . "</td>";
          echo "<td>" . $row["coursePriority2"] . "</td>";
          echo "<td>" . $row["coursePriority3"] . "</td>";
          echo "<td>";
          echo "<form action='' method='post'>";
          echo "<input type='hidden' name='fullnameToDelete' value='" . $row["name"] . "'>";
          echo "<button type='submit' name='delete'>Delete</button>";
          echo "</form>";
          echo "</td>";
          echo "</tr>";
        }
      } else {
        echo "<tr><td colspan='4'>No data available</td></tr>";
      }
      $conn->close();
      ?>
    </table>
  </form>
</body>

</html>