<?php
$Name = $_POST['name'];
$Password = $_POST['password'];

$Con = mysqli_connect('localhost','root','','gadgethub');
$result = mysqli_query($Con,"SELECT * FROM `tbluser` WHERE (UserName = '$Name' OR Email = '$Name') AND Password = '$Password' ");

session_start();
if(mysqli_num_rows($result)){
    $_SESSION['user'] = $Name;

    echo"
    <script>
    alert('Successfully Login');
    window.location.href= '../index.php';
    </script>
    ";


}
else{
    echo"
    <script>
    alert('Incorrect email/username/password');
    window.location.href= 'login.php';
    </script>
    ";
}

?>