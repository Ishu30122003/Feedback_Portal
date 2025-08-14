<?php
session_start();
if (!isset($_SESSION['email']) || $_SESSION['role'] != 'admin') {
    header("Location: loginpage.html");  // 
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Personal Information</title>
    <link rel="stylesheet" href="personal_info.css">
</head>
<body>
    <h1>Personal Information</h1>
    <p>Email:  <?php  echo $_SESSION['email']; ?></p>
    <p>Password:  <?php  echo $_SESSION['password']; ?></p>
    <p>User Type:  <?php  echo $_SESSION['role']; ?></p>
</body>
</html>