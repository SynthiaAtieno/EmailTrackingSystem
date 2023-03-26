<?php
session_start();
unset($_SESSION['user_id']);
unset($_SESSION['fullname']);
unset($_SESSION['email']);
unset($_SESSION['loggedin']);

header("location:login.php");
echo '<script>alert("Logged out successfully")</script>';

?>