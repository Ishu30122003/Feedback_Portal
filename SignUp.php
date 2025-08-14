<?php
$servername = "localhost";
$username = "root";
$pwd = "";
$dbname = "project";

$email = $_POST["email"];
$pass = $_POST["psw"];


$con = new mysqli($servername, $username, $pwd, $dbname);


if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}


$sql_check = "SELECT * FROM tbl_logs WHERE Email_ID = '$email' OR log_password = '$pass'";
$result_check = $con->query($sql_check);

if ($result_check->num_rows > 0) {
    echo '<script>alert("Email or password already exists"); window.location = "signup.html";</script>';
} else {
    
    $sql_insert = "INSERT INTO tbl_logs (Email_ID, log_Password) VALUES ('$email', '$pass')";
    if ($con->query($sql_insert) === TRUE) {
        echo '<script>alert("Your SignUp was successful"); window.location = "loginpage.html";</script>';
    } else {
        echo "Error: " . $con->error;
    }
}
$con->close();
?>