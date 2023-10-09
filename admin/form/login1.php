<?php
$con = mysqli_connect('localhost','root','','gadgethub');
$A_name = mysqli_escape_string($con,$_POST['username']);
$A_password =  mysqli_escape_string($con,$_POST['userpassword']);

$result = mysqli_query($con,"SELECT * FROM `admin` WHERE username = '$A_name' AND userpassword = '$A_password'");

//$result = mysqli_query($con,"SELECT * FROM `admin` WHERE username = '' AND userpassword = 'admin'");
//1 //0  ' or 1='1
session_start();

if(mysqli_num_rows($result)){

    $_SESSION['admin'] = $A_name;
    echo"
    <script>
    alert('Login successfully');
    window.location.href='../mystore.php';
    </script>
    ";
}
else{
    echo"
    <script>
    alert('Invalid username/password');
    window.location.href='login.php';
    </script>
    ";

}
?>


