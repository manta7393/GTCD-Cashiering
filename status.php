<?php include('db_connect.php');
$id = $_GET['id'];
$status = $_GET['status'];
$student = "UPDATE student SET status=$status WHERE id=$id";
mysqli_query($conn,$student);
header('location:index.php?page=students')
?>
