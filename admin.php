<?php
include 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approval Dashboard</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            background: #f8f9fa;
        }
        .sidebar {
            width: 220px;
            background: #2c3e50;
            color: white;
            padding: 20px;
            height: 100vh;
        }
        .sidebar h2 {
            font-size: 18px;
            margin-bottom: 20px;
        }
        .sidebar ul {
            list-style: none;
            padding: 0;
        }
        .sidebar ul li {
            padding: 10px;
            cursor: pointer;
            border-bottom: 1px solid #34495e;
        }
        .sidebar ul li:hover {
            background: #1a252f;
        }
        .sub-menu {
            display: none;
            padding-left: 10px;
            font-size: 14px;
        }
        .sidebar ul li:hover .sub-menu {
            display: block;
        }
        .header {
            position: fixed;
            width: calc(100% - 220px);
            top: 0;
            left: 220px;
            background: #ecf0f1;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        }
        .main-content {
            flex: 1;
            margin-left: 220px;
            padding: 80px 20px 20px;
        }
        .approval-status {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
            width: 50%;
            margin: auto;
            text-align: center;
        }
        .approval-status h3 {
            margin-bottom: 10px;
        }
        .approval-box {
            background: #f1f1f1;
            padding: 10px;
            margin-top: 10px;
            border-radius: 5px;
        }
        a {
            text-decoration: none;
            color: white;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Dashboard</h2>
        <ul>
            <li><strong>Application Form</strong>
                <ul class="sub-menu">
                    <li>Starting Club</li>
                    <li>Event</li>
                    <li>Workshop</li>
                    <li>Fest</li>
                    <li>Other</li>
                </ul>
            </li>
            <li><a href="past_approved.html">My Approval</a></li>
            <li><a href="past_deleted.html">Recycle Bin</a></li>
        </ul>
    </div>
    <div class="header">
        <div><strong>LOGO</strong></div>
        <div><strong>Profile Details</strong></div>
    </div>
    
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="styless1.css">
</head>
<body>
    <div class="admin-panel">
        <h2>Project Plan Details</h2>
        <pre class="project-plan">
            <!-- Insert the project plan content here -->
            a club
            <!-- Continue with the full project plan text -->
        </pre>
        <h1>Pending Document Approvals</h1>
        <table>
            <thead>
                <tr>
                    <th>Document ID</th>
                    <th>Title</th>
                    <th>Submitted By</th>
                    <th>Submission Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Example Row -->


                <?php 

                $sql="SELECT * FROM `dashboard`";
                $result=mysqli_query($conn,$sql);
                while ($row=mysqli_fetch_assoc($result)) {
                    if ($row['status']=="") {
                        echo '<tr>
                    <td>'.$row['id'].'</td>
                    <td>'.$row['name'].'</td>
                    <td>'.$row['user'].'</td>
                    <td>'.$row['dateofapp'].'</td>
                    <td>
                        <button onclick="approve('.$row['id'].')" class="approve">Approve</button>
                        <button onclick="reject('.$row['id'].')" class="reject">Reject</button>
                    </td>
                </tr>';
                    }
                    
                }
                ?>
               
                <!-- Add more rows as needed -->
            </tbody>
        </table>
    </div>
    <script>
        function approve(id){
            $.ajax({
    url: "updateStatus.php",  // Change this to your PHP script (e.g., "process.php")
    type: "POST",           // Use POST method
    data: {                 // Data to send
        status: "Approved",
        id: id
    },
    success: function(result) {
        location.reload();
    },
    error: function(xhr, status, error) {
        console.error("Error:", error);
    }
});

        }
        function reject(id){
            $.ajax({
    url: "updateStatus.php",  // Change this to your PHP script (e.g., "process.php")
    type: "POST",           // Use POST method
    data: {                 // Data to send
        status: "Rejected",
        id: id
    },
    success: function(result) {
        location.reload();
    },
    error: function(xhr, status, error) {
        console.error("Error:", error);
    }
});
        }
    </script>
</body>
</html>
