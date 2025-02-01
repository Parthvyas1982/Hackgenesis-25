<?php
session_start();
include "connection.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentication System</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Splash Screen */
        .splash-screen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: white;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .splash-screen img {
            width: 200px; /* Adjust as per logo size */
        }

        /* Login Page Styling */
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background: url('letter-background.jpg') no-repeat center center/cover;
        }

        .container {
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 350px;
        }

        .logo {
            width: 100px;
            margin-bottom: 15px;
        }

        h2 {
            font-family: "Times New Roman", serif;
            font-weight: bold;
            margin-bottom: 20px;
        }

        label {
            display: block;
            text-align: left;
            margin-top: 10px;
            font-family: "Times New Roman", serif;
        }

        input, select, button {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #a8a8a8;
            border-radius: 5px;
        }

        button {
            background-color: #4a47a3;
            color: white;
            cursor: pointer;
            margin-top: 15px;
            font-weight: bold;
        }

        button:hover {
            background-color: #312e81;
        }

        p {
            margin-top: 15px;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <!-- Splash Screen -->
    <div class="splash-screen">
        <img src="company-logo.png" alt="Company Logo">
    </div>

    <!-- Login Form -->
    <div class="container" id="loginContainer" style="display:none;">
        <img class="logo" src="company-logo.png" alt="Company Logo">
        <div>

            <?php
            if (isset($_POST['submit'])) {
                $email=$_POST['email'];
                $password=$_POST['password'];
                $sql="SELECT * FROM `registration` WHERE `email`='$email'";
                $result=mysqli_query($conn,$sql);
                $num_row=mysqli_num_rows($result);
                if ($num_row>0) {
                    $sqlForPassword="SELECT * FROM `registration` WHERE `email`='$email' and `hashedPassword`='$password'";
                    $resultForPassword=mysqli_query($conn,$sqlForPassword);
                    $userType=mysqli_fetch_assoc($resultForPassword)["Registeras"];
                    // echo $userType;
                    $num_rowForPassword=mysqli_num_rows($resultForPassword);
                    if ($num_rowForPassword>0) {
                        $_SESSION['email']=$email;
                        $_SESSION['userType'] = $userType;
                        // Redirect based on user type
                        if ($userType == "Student") {
                            header("Location: dash.php");
                        }elseif ($userType == "Admin") {
                            header("Location: admin.php");
                        }
                        exit();
                    } else {
                        echo "Enter correct password";
                    }
                } else {
                    echo "Enter correct password";
                }
                    
                } else {

                    echo "user not Found";
                }
                
            
            ?> 
        </div>
        <h2>Login</h2>
        <form id="loginForm" method="post" action="">
    <label for="userType">Login as:</label>
    <select id="userType" name="userType" required>
        <option value="student">Student</option>
        <option value="admin">Admin</option>
    </select>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" placeholder="Enter your email" required>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" placeholder="Enter your password" required>

    <input type="submit" name="submit" value="Login">
</form>

        
        <p>Don't have an account? <a href="register.php">Register here</a></p>
    </div>

    <script>
        // Show splash screen for 1 second
        setTimeout(() => {
            document.querySelector('.splash-screen').style.display = 'none';
            document.getElementById('loginContainer').style.display = 'block';
        }, 1000);
      

    </script>

</body>
</html>
