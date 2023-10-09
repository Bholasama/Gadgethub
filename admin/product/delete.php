<?php

include 'connect.php';
$Id = $_GET['ID'];
include 'connect.php';
mysqli_query($con, "DELETE FROM `tblproduct` WHERE Id = $Id");
header('location:index.php');

?>