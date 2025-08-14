<?php
session_start();
$server = "localhost";
$username = "root";
$pwd = "";
$database = "project";

$user = $_POST["email"];
$pass = $_POST["psw"];
$role = $_POST["role"];
echo $role;
if(isset($_POST['LOGIN'])){
    if(isset($_POST['role'])){
            echo $_POST['role'];
    }
}

$con= new mysqli($server,$username,$pwd,$database);
if ($con){
    echo "Database connected";
    echo "<br>";
}
$select = mysqli_query($con,"SELECT * FROM tbl_logs WHERE Email_ID = '$user' AND log_password = '$pass'");
//$result = mysqli_query($con, $query);
if($select->num_rows>0){
    $_SESSION['email'] = $user;
    $_SESSION['password']=$pass;
    $_SESSION['role']=$role;
    if($role == "admin")
    {
        header("Location:admin_dashboard.html");
        exit();
    }
    elseif($role == "user")
    {
        header("Location:user_dashboard.html");
        exit();
    }
    else {
        echo" Invalid role selected.";
    }
 }

else{
    echo "Invalid ID Password";
}
$con->close();
?>