<?php
if($_SERVER["REQUEST_METHOD"]=="POST")
{
 include('db_connection.php');

$email = $_POST['email'];
$feedback1_rating = $_POST['feedback1_rating'];
$feedback2_rating = $_POST['feedback2_rating'];
$feedback3_rating = $_POST['feedback3_rating'];
$remarks = $_POST['remarks'];

$sql ="SELECT * FROM tbl_feedback WHERE Email_ID = '$email'";
$result = $con->query($sql);
if($result)
{
 if($result->num_rows > 0)
   {
     echo'<script>alert("You have already filled the feedback form");
     window.location ="feedback.html";</script>';
   }
 else {
         // Insert new user
   $sql = "INSERT INTO tbl_feedback (email_ID,feedback1_rating, feedback2_rating, feedback3_rating, remarks) VALUES ('$email', '$feedback1_rating', '$feedback2_rating', '$feedback3_rating', '$remarks')";
         
   if ($con->query($sql) === TRUE) {
      echo '
       <!DOCTYPE html>
       <html lang="en">
       <head>
         <meta charset="UTF-8">
         <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <title>Feedback Success</title>
         <link rel="stylesheet" href="feed.css">
         </head>
         <body>
         <a href="logout.php" class="logout-link">Log out</a>

           <div class="container"> 
             <div class="message-box">
           <h1>Thank you for your response.</h1>
           <p>You have successfully filled the feedback form !</p>
           </div>
           </body>
           </html>';
    } 
     else {
      echo "Error: " . $sql . "<br>" . $con->error;
   }
  }
 } 
 else {
     echo "Error: " . $con->error;
 }

 $con->close();
}
?>

