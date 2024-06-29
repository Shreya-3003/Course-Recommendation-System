<?php
if (isset($_POST['password'])) {
  $adminusername = 'shreya';
  $adminpassword = 'shreya';

  $username = $_POST['username'];
  $password = $_POST['password'];

  if ($adminusername == $username && $adminpassword == $password) {
    header('Location: ../php/adminview.php');
    exit;
  } else {
    echo 'fail';
  }
}
?>
