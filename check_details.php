<?php
session_start();
include('db_connection.php'); 


if (!isset($_SESSION['email'])) {
    echo '<script>alert("Please log in first."); window.location="loginpage.html";</script>';
    exit();
}

$email = $_SESSION['email']; 


$sql = "SELECT * FROM completeinfo WHERE email_ID = '$email'";
$result = $con->query($sql);

if ($result->num_rows > 0) 
{
    
    $row = $result->fetch_assoc();
    $name = $row['name'];
    $college =$row['college'];
    $course = $row['course'];
    $phoneno = $row['phoneno'];
    $date_of_birth = $row['date_of_birth'];
    $picpath =  $row['picpath'];
}
 else 
 {
    echo '<script>alert("No details found."); window.location="user_dashboard.html";</script>';
    exit();
}

$con->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Details</title>
    <link rel="Stylesheet"  href="details_css">
</head>
<body>
    <h1>Your Details</h1>
    <p>Name: <?php           echo $name; ?></p>
    <p>College:<?php         echo $college; ?></p>
    <p>Course: <?php         echo $course; ?></p>
    <p>Phone Number: <?php   echo $phoneno; ?></p>
    <p>Date of Birth: <?php  echo $date_of_birth; ?></p>
    <p>picpath: <?php        echo $picpath; ?></P>
</body>
</html>