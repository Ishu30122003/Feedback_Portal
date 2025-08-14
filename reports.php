
<?php
include('db_connection.php');
$sql = "SELECT 
            c.Email_ID, 
            c.name, 
            c.college, 
            c.course, 
            c.phoneno, 
            c.date_of_birth, 
            c.picpath, 
            f.feedback1_rating, 
            f.feedback2_rating, 
            f.feedback3_rating, 
            f.remarks
        FROM 
            completeinfo c
        JOIN 
            tbl_feedback f 
        ON 
            c.Email_ID = f.Email_ID";

$result = $con->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report</title>
    <link rel="stylesheet" href="reports.css">
</head>
<body>
    <div class="container">
        <div class ="top-right">
            <a href="admin_dashboard.html">Back to Admin Dashboard</a>
        <h1>User Reports</h1>
        <?php
        if ($result->num_rows > 0) {
            echo '<table class="styled-table">
                    <thead>
                        <tr>
                            <th>Email ID</th>
                            <th>Name</th>
                            <th>College</th>
                            <th>Course</th>
                            <th>Phone No</th>
                            <th>Date of Birth</th>
                            <th>Picture Path</th>
                            <th>Feedback 1 Rating</th>
                            <th>Feedback 2 Rating</th>
                            <th>Feedback 3 Rating</th>
                            <th>Remarks</th>
                        </tr>
                    </thead>
                    <tbody>';
    
            while($row = $result->fetch_assoc()) {
                echo '<tr>
                        <td>' . $row['Email_ID'] . '</td>
                        <td>' . $row['name'] . '</td>
                        <td>' . $row['college'] . '</td>
                        <td>' . $row['course'] . '</td>
                        <td>' . $row['phoneno'] . '</td>
                        <td>' . $row['date_of_birth'] . '</td>
                        <td>' . $row['picpath'] . '</td>
                        <td>' . $row['feedback1_rating'] . '</td>
                        <td>' . $row['feedback2_rating'] . '</td>
                        <td>' . $row['feedback3_rating'] . '</td>
                        <td>' . $row['remarks'] . '</td>
                      </tr>';
            }
            echo '  </tbody>
                  </table>';
        } else {
            echo '<p>No records found.</p>';
        }
        $con->close();
        ?>
    </div>
</body>
</html>




