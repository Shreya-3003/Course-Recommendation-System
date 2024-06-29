<?php
session_start();
require 'C:\xampp\htdocs\final year project\PHPMailer\src\PHPMailer.php';
require 'C:\xampp\htdocs\final year project\PHPMailer\src\SMTP.php';
require 'C:\xampp\htdocs\final year project\PHPMailer\src\Exception.php';
$mail = new PHPMailer\PHPMailer\PHPMailer();

// SMTP configuration
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com'; // Your SMTP server
$mail->SMTPAuth = true;
$mail->Username = 'shreyuchoubey@gmail.com'; // Your SMTP username
$mail->Password = 'tfrmfqiopcgzrntk'; // Your SMTP password
$mail->SMTPSecure = 'tls'; // TLS or SSL
$mail->Port = 587; // SMTP port

$email=$_SESSION['email'];

// Email content
$mail->setFrom('shreyuchoubey@gmail.com', 'Course_Recommendation');
$mail->addAddress($email);
$mail->Subject = 'Test Email';
$mail->Body = 'Welcome to my Website. Thank you for the registration. Hope you will like this site.';

if ($mail->send()) {
    header('Location: ../welcome.html');
} else {
    echo "Email could not be sent. Error: " . $mail->ErrorInfo;
}
?>