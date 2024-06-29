<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Database connection parameters
    $dbHost = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "course_recommendation";

    $conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $userAnswers = [];

    // Initialize variables to store scores for each subject
    $scienceScore = 0;
    $commerceScore = 0;
    $artsScore = 0;

    // Loop through the questions
    for ($i = 0; $i <= 9; $i++) {
        $questionName = "question" . $i;
        if (isset($_POST[$questionName])) {
            $userAnswer = $_POST[$questionName];
            $userAnswers[$i] = $userAnswer;

            $sql = "SELECT question_" . $i . " FROM psychometrics_responses WHERE id = 1";
            $result = $conn->query($sql);

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $correctAnswer = $row["question_" . $i];

                if ($userAnswer == $correctAnswer) {
                    // Increment the score for the corresponding subject
                    if ($i <= 2) {
                        $scienceScore++;
                    } elseif ($i >= 3 && $i <= 5) {
                        $commerceScore++;
                    } elseif ($i >= 6 && $i <= 8) {
                        $artsScore++;
                    }
                }
            }
        }
    }

    // Determine the user's interest based on scores
    $userInterest = "undetermined";

    if ($scienceScore >= 3) {
        $userInterest = "Science";
    } elseif ($commerceScore >= 3) {
        $userInterest = "Commerce";
    } elseif ($artsScore >= 3) {
        $userInterest = "Arts";
    }

    // CSS style for better appearance
    echo '<style>';
    echo 'body { background: linear-gradient(45deg, rgb(55, 55, 131), rgb(213, 110, 213)); font-family: "General Sans-Medium"; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }';
    echo '.result-card { background-color: #e8d2e4; color: black; padding: 20px; border-radius: 10px; text-align: center; }';
    echo 'button { background-color: #6a3ec2; color: white; padding: 10px 20px; border: none; border-radius: 50px; cursor: pointer; margin-top: 20px; }';
    echo 'button:hover { background-color: #441f9d; }';
    echo '</style>';

    // Display the user's interest in a centered result card
    echo '<div class="result-card">';
    if ($userInterest != "undetermined") {
        echo "<h2>Your interest is in {$userInterest}.</h2>";
    } else {
        echo "<h2>Your interest is undetermined.</h2>";
    }

    // Insert user responses into the database
    $insertSql = "INSERT INTO user_responses (question_0, question_1, question_2, question_3, question_4, question_5, question_6, question_7, question_8, question_9)
                  VALUES ('" . implode("', '", $userAnswers) . "')";

    if ($conn->query($insertSql) === TRUE) {
        echo '<a href="../Questionsa.html"><button>Next Page</button></a>';
    } else {
        echo "Error inserting user's answers: " . $conn->error;
    }

    echo '</div>'; // Close the result card

    $conn->close();
}
?>
