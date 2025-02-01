<?php
include 'connection.php';
$status=$_POST['status'];
$id=$_POST['id'];
$sql="UPDATE `dashboard` SET `status`='$status' WHERE `id`='$id'";
$result=mysqli_query($conn,$sql);
if ($result) {
    echo "ok";
} else {
    echo "Database Error";
}

?>
