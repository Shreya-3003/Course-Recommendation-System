<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection parameters
    $dbHost = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "course_recommendation";

    // Connect to the database
    $conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // User's answers
    $userAnswers = [
        $_POST["science-question1"],
        $_POST["science-question2"],
        $_POST["science-question3"],
        $_POST["science-question4"],
        $_POST["science-question5"],
        $_POST["commerce-question1"],
        $_POST["commerce-question2"],
        $_POST["commerce-question3"],
        $_POST["commerce-question4"],
        $_POST["commerce-question5"],
        $_POST["arts-question1"],
        $_POST["arts-question2"],
        $_POST["arts-question3"],
        $_POST["arts-question4"],
        $_POST["arts-question5"]
    ];

    // Initialize marks for each stream and total marks
    $scienceMarks = 0;
    $commerceMarks = 0;
    $artsMarks = 0;
    $totalMarks = 0;

    // Iterate through user's answers and compare with correct answers
    for ($i = 0; $i < count($userAnswers); $i++) {
        $columnName = "";
        $tableName = "";
        
        if ($i < 5) {
            // Science stream questions
            $columnName = "science_question" . ($i + 1);
            $tableName = "aptitude_answers";
        } elseif ($i < 10) {
            // Commerce stream questions
            $columnName = "commerce_question" . ($i - 4);
            $tableName = "aptitude_answers";
        } else {
            // Arts stream questions
            $columnName = "arts_question" . ($i - 9);
            $tableName = "aptitude_answers";
        }

        // Query to fetch the correct answer for the current question
        $sql = "SELECT $columnName FROM $tableName WHERE id = 1";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $correctAnswer = $row[$columnName];

            // Compare user's answer with the correct answer and update marks accordingly
            if ($userAnswers[$i] == $correctAnswer) {
                if ($i < 5) {
                    // Science stream
                    $scienceMarks++;
                } elseif ($i < 10) {
                    // Commerce stream
                    $commerceMarks++;
                } else {
                    // Arts stream
                    $artsMarks++;
                }
                $totalMarks++;
            }
        }
    }

    // Insert user's answers into the userat_answers table
    $insertSql = "INSERT INTO userat_answers (science_question1, science_question2, science_question3, science_question4, science_question5, commerce_question1, commerce_question2, commerce_question3, commerce_question4, commerce_question5, arts_question1, arts_question2, arts_question3, arts_question4, arts_question5)
                  VALUES ( '" . implode("', '", $userAnswers) . "')";

    if ($conn->query($insertSql) === TRUE) {
        
    } else {
        echo "Error inserting user's answers: " . $conn->error . "<br>";
    }

    // Display marks for each stream and total marks with inline CSS
    echo'<body style=" background: linear-gradient(
      45deg,
      rgb(55, 55, 131),
      rgb(213, 110, 213)
    );">';
    echo '<div style="background-color: #e8d2e4; padding: 20px; margin: 20px; border: 1px solid #ccc;">';
    echo '<p style="font-weight: bold;">Science Marks: <span style="color: blue;">' . $scienceMarks . '</span></p>';
    echo '<p style="font-weight: bold;">Commerce Marks: <span style="color: green;">' . $commerceMarks . '</span></p>';
    echo '<p style="font-weight: bold;">Arts Marks: <span style="color: red;">' . $artsMarks . '</span></p>';
    echo '<p style="font-weight: bold;">Total Marks: <span style="color: purple;">' . $totalMarks . '</span></p>';
    
    if ($scienceMarks > $commerceMarks && $scienceMarks > $artsMarks) {
        echo '<p style="font-weight: bold;">The recommended course for you is <span style="color: blue;">Science Stream</span>.</p>';
    } elseif ($commerceMarks > $scienceMarks && $commerceMarks > $artsMarks) {
        echo '<p style="font-weight: bold;">The recommended course for you is <span style="color: green;">Commerce Stream</span>.</p>';
    } elseif ($artsMarks > $commerceMarks && $artsMarks > $scienceMarks) {
        echo '<p style="font-weight: bold;">The recommended course for you is <span style="color: red;">Arts Stream</span>.</p>';
    }
    echo '<br><br><a href="../Home1.html"><button style="background-color: #007bff; color: #fff; padding: 10px 20px; text-decoration: none;border-radius:15px; border: none; cursor: pointer; transition: background-color 0.3s ease;">Go Back</button></a>';
    
    echo '</div>';
    // echo '<br><br><a href="../Home1.html"><button style="background-color: #007bff; color: #fff; padding: 10px 20px; text-decoration: none; border: none; cursor: pointer; transition: background-color 0.3s ease;">Go Back</button></a>';
    $conn->close();
}
?>
