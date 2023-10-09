<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GadgetHub</title>
    <!-- add icon link -->
    <link rel = "icon" href = "no.png" type = "image/x-icon">
     <!------Bootstrap CDN---->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-------font awesome cdn------>
    <script src="https://kit.fontawesome.com/8fe6b34cc3.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php
    session_start();
    $count = 0;
    if(isset($_SESSION['cart'])){
        $count = count($_SESSION['cart']);
    } 
    ?>
<nav class="navbar navbar-light bg-light">
  <div class="container-fluid font-monospace">
      <a href="index.php" class="navbar-brand"><img src="no.png"  width="150px" height="70px" alt=""></a>

<div class="d-flex">
    <a href="index.php" class="text-warning text-decoration-none pe-2 "><i class="fa-solid fa-house"></i>Home</a>
    <a href="viewCart.php" class="text-warning text-decoration-none pe-2 "><i class="fa-solid fa-cart-shopping"></i>Cart (<?php echo $count ?>) |</a>
     
    <span class="text-warning pe-2">
    <?php

    if(isset($_SESSION['user'])){
    echo "Hello,".$_SESSION['user'];
    echo"
    | <a href='form/logout.php'class='text-warning text-decoration-none pe-2'><i class='fa-solid fa-arrow-right-to-bracket'></i>Logout</a>
    ";
    }
    else{
        echo"
        Guest | <a href='form/login.php' class='text-warning text-decoration-none pe-2'><i class='fa-solid fa-arrow-right-to-bracket'></i>Login</a>
    ";
    }


    ?>
    |
    
    <a href="../admin/mystore.php"class="text-warning text-decoration-none pe-2 ">Admin</a>

</span>
    </form>
  
</nav>
</div>
</body>
</html>