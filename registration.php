<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include('db_connection.php');
    
    $email = $_POST['email'];
    $name = $_POST['name'];
    $college = $_POST['college'];
    $course = $_POST['course'];
    $phoneno = $_POST['phoneno'];
    $date = $_POST['date'];
    
    $target_dir = "images/";
    $fileName = basename($_FILES["fileToUpload"]["name"]);
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $uniqueFileName = pathinfo($fileName, PATHINFO_FILENAME) . "_" . time() . "." . $fileExtension;
    $target_file = $target_dir . $uniqueFileName;
    $uploadOk = 1;
    $profilePicPath = ""; 

    
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size (limit to 500KB)
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    $allowedFormats = ["jpg", "jpeg", "png", "gif"];
    if (!in_array($fileExtension, $allowedFormats)) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Attempt to upload file if all checks passed
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $profilePicPath = $target_file;
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    // Check if $profilePicPath is set before using it in the SQL
    if (!empty($profilePicPath)) {
        // Use prepared statements to prevent SQL injection
        $stmt = $con->prepare("SELECT * FROM completeinfo WHERE email_ID = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo '<script>alert("You have already registered"); window.location="registration.html";</script>';
        } else {
            // Prepare and bind
            $stmt = $con->prepare("INSERT INTO completeinfo (Email_ID, name, college, course, phoneno, date_of_birth, picpath) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssss", $email, $name, $college, $course, $phoneno, $date, $profilePicPath);

            if ($stmt->execute() === TRUE) {
                echo '
                <!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Registration Success</title>
                    <link rel="stylesheet" href="message.css">
                </head>
                <body>
                    <div class="navbar">
                        <a href="homepage.html"><i class="fa-solid fa-house"></i>Home</a>
                        <a href="SignUp.html">Sign Up</a>
                        <a href="loginpage.html">Login</a>
                        <a href="feedback.html"><u>Feedback</u></a>
                    </div>
                    <div class="container">
                        You have successfully registered. Now fill the feedback form
                    </div>
                </body>
                </html>';
            } else {
                echo "Error: " . $stmt->error;
            }
        }
        $stmt->close();
    }

    $con->close();
}
?>