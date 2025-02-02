
<?php
session_start();
include "connection.php";
if (isset($_POST['submit'])) {
  $name=$_POST['applicantName'];
  $branch=$_POST['branch'];
  $activityType=$_POST['activityType'];
  $activityName=$_POST['activityName'];
  $description=$_POST['description'];
  $authorityName=$_POST['authorityName'];
  $applicationDate=$_POST['applicationDate'];
  $user=$_SESSION['email'];
  $target_dir = "uploads/";
  $sqlForUsername="SELECT * FROM `registration` WHERE `email`='$user'";
  $resultForusername=mysqli_query($conn,$sqlForUsername);
  $name=mysqli_fetch_assoc($resultForusername)['name'];
  $target_file = $target_dir . basename($_FILES["documents"]["name"]);
  if (move_uploaded_file($_FILES["documents"]["tmp_name"], $target_file)) {
    $sql="INSERT INTO `dashboard`(`id`, `name`, `activity`, `description`, `authority`, `dateofapp`, `docs`, `branch`,`user`,`status`) VALUES 
    (null,'$name','$activityName','$description','$authorityName','$applicationDate','$target_file','$branch','$name','')";
    $result=mysqli_query($conn,$sql);
    if ($result) {
      header("Location: dash.php");
    } else {
      echo "Database Error";
    }
    
  } else {
    
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Application Submission</title>
  <link rel="stylesheet" href="formstyles.css">
</head>
<body>
  <div class="container">
    <h2>Application Submission</h2>
    <form id="submissionForm" method="post" action=""  enctype="multipart/form-data">
      <label for="applicantName">Your Name:</label>
      <input type="text" id="applicantName" name="applicantName" required>

      <label for="branch">Branch:</label>
      <input type="text" id="branch" name="branch" required>

      <label for="activityType">Activity Type:</label>
      <select id="activityType" name="activityType" required>
        <option value="event">Event</option>
        <option value="club">Club Request</option>
        <option value="workshop">Workshop</option>
        <option value="other">Other</option>
      </select>

      <label for="activityName">Activity Name:</label>
      <input type="text" id="activityName" name="activityName" required>

      <label for="description">Description:</label>
      <textarea id="description" name="description" required></textarea>

      <label for="authorityName">Authority Name:</label>
      <input type="text" id="authorityName" name="authorityName" required>

      <label for="applicationDate">Date of Application:</label>
      <input type="date" id="applicationDate" name="applicationDate" required>

      <label for="documents">Upload Required Documents:</label>
      <input type="file" id="documents" name="documents" required>

      <button type="submit" name="submit">Submit Application</button>
    </form>
  </div>
  <script src="script.js"></script>
</body>
</html>
