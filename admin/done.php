<?php 
$con = mysqli_connect('localhost','root','','gadgethub');

$id=mysqli_real_escape_string($con,$_GET['id']);

mysqli_query($con,"update tblorder set state='Done' where id='$id'");
header('Location:order.php');
?>