<?php
session_start();
include 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approval Dashboard</title>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            background: #f8f9fa;
            transition: background 0.3s ease-in-out;
        }
        .sidebar {
            width: 250px;
            background: #2c3e50;
            color: white;
            padding: 20px;
            height: 100vh;
            position: fixed;
        }
        .sidebar h2 {
            font-size: 20px;
            margin-bottom: 20px;
            text-align: center;
        }
        .sidebar ul {
            list-style: none;
            padding: 0;
        }
        .navbar-link{
            text-decoration:none;
            color: white;
        }
        .sidebar ul li {
            padding: 12px;
            cursor: pointer;
            border-bottom: 1px solid #34495e;
            font-weight: bold;
            font-size: 16px;
        }
        .sub-menu {
            display: none;
            padding-left: 15px;
            font-size: 14px;
            font-weight: normal;
        }
        .sidebar ul li:hover .sub-menu {
            display: block;
        }
        .header {
            position: fixed;
            width: calc(100% - 250px);
            top: 0;
            left: 250px;
            background: #ecf0f1;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            padding: 15px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        }
        .profile-container {
            position: relative;
        }
        .profile-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #3498db;
            color: white;
            font-size: 20px;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: 0.3s;
        }
        .profile-btn:hover {
            background: #2980b9;
        }
        .profile-dropdown {
            display: none;
            position: absolute;
            right: 0;
            top: 50px;
            background: white;
            width: 180px;
            border-radius: 5px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
            z-index: 1000;
        }
        .profile-dropdown a {
            display: block;
            padding: 10px;
            color: black;
            text-decoration: none;
            border-bottom: 1px solid #ddd;
            transition: 0.3s;
        }
        .profile-dropdown a:last-child {
            border-bottom: none;
        }
        .profile-dropdown a:hover {
            background: #f1f1f1;
        }
        .main-content {
            flex: 1;
            margin-left: 250px;
            padding: 80px 20px 20px;
        }
        .approval-status {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
            width: 60%;
            margin: auto;
            text-align: center;
        }
        .status-box {
            background: #f1f1f1;
            padding: 12px;
            margin-top: 10px;
            border-radius: 5px;
            font-weight: bold;
        }
        .toggle-dark {
            padding: 8px 15px;
            background: #2c3e50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-right: 15px;
        }
        .toggle-dark:hover {
            background: #1a252f;
        }
        /* Dark Mode */
        .dark-mode {
            background: #121212;
            color: white;
        }
        .dark-mode .header {
            background: #1a1a1a;
            color: white;
        }
        .dark-mode .approval-status {
            background: #222;
            color: white;
        }
        .dark-mode .status-box {
            background: #333;
            color: white;
        }
    </style>
</head>
<body>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link rel="stylesheet" href="styles.css">
        <title>Dashboard</title>
    </head>
    <body>
        <div class="menu-button" onclick="toggleSidebar()">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </div>
    
        <div class="sidebar" id="sidebar">
            <h2><i class="fas fa-bars"></i> Dashboard</h2>
            <ul>
                <li>
                    <i class="fas fa-folder"></i> <strong>Application Form</strong>
                    <ul class="sub-menu">
                        <li>📌 Club</li>
                        <li>🎉 Event</li>
                        <li>📚 Workshop</li>
                        <li><a href="fest.php" class="navbar-link">🎭 Fest</a></li>
                        <li>📝 Others</li>
                    </ul>
                </li>
                <li><i class="fas fa-check-circle"></i> <strong>My Approval</strong></li>
                <li><i class="fas fa-trash"></i> <strong>Recycle Bin</strong></li>
            </ul>
        </div>
    
        <script src="script.js"></script>
    </body>
    </html>
    <div class="header">
        <button class="toggle-dark">Toggle Dark Mode</button>
        <div class="profile-container">
            <button class="profile-btn"><i class="fas fa-user"></i></button>
            <div class="profile-dropdown">
                <a href="#">🔄 Switch Account</a>
                <a href="#">➕ Add Account</a>
                <a href="#">❌ Delete Account</a>
                <a href="#">👤 Account Details</a>
            </div>
        </div>
    </div>
    <div class="main-content">
        <?php

        ?>
        <div class="approval-status">
            <h3>Approval Status</h3>
            <div class="status-box">✅ Approved Status: <span id="approved-status">Loading...</span></div>
            <div class="status-box">👤 Last Approved by: <span id="last-approved">Loading...</span></div>
            <div class="status-box">🔄 Currently in Approval by: <span id="current-approval">Loading...</span></div>
        </div>
    </div>

    <script>
        document.querySelector(".toggle-dark").addEventListener("click", function () {
            document.body.classList.toggle("dark-mode");
        });

        document.querySelector(".profile-btn").addEventListener("click", function () {
            const dropdown = document.querySelector(".profile-dropdown");
            dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
        });

        window.addEventListener("click", function(event) {
            if (!event.target.closest(".profile-container")) {
                document.querySelector(".profile-dropdown").style.display = "none";
            }
        });
    </script>
</body>
</html>
