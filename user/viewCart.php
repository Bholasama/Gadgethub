<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ViewCart</title>
</head>
<body>
    <?php 
    error_reporting(0);
    
    include 'header.php';
    
    include 'connect.php';
    if(isset($_POST['place-order'])){

      $fullname=$_POST['fname'];
      $email=$_POST['email'];
      $address=$_POST['address'];
      $address2=$_POST['address2'];
      $phonenumber=$_POST['phonenumber'];
      $country=$_POST['country'];
      $state=$_POST['state'];

      if(isset($_SESSION['cart'])){
      foreach($_SESSION['cart'] as $key => $value){
        
      mysqli_query($con, "update tblproduct set PStock=PStock-".$value['productQuantity']." where PName='".$value['productName']."'");
        $productDetails=$productDetails."Product=".$value['productName'].",Price=".$value['productPrice'].",Quantity=".$value['productQuantity'].",Total=".($value['productPrice'] * $value['productQuantity']).",";
      }}
      if(!$address2 || $address2==null){
        $address2="";
      }
      mysqli_query($con,"insert into `tblorder` values (NULL,'$fullname','$email','$address','$address2','$productDetails','$phonenumber','processing')");




echo "<h1>Order has been places successfully</h1>";
unset($_SESSION['cart']);
        die();
    }
    if(!isset($_POST['checkout'])){
    ?>

    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center bg-light mb-5 rounded">
                <h1 class="text-warning">My Cart</h1>

</div>
</div>
</div>
<div class="container-fluid">
    <div class="row justify-content-around">
        <div class="col-sm-12 col-md-6 col-lg-9">
            <table class="table table-border text-center">
                <thead class="bg-danger text-white fs-5">
                    <th>S.No.</th>
                    <th>Product Name</th>
                    <th>Product Price</th>
                    <th>Product Quantity</th>
                    <th>Total Price</th>
                    <th>Update</th>
                    <th>Delete</th>

</thead>
<tbody>
    <?php
   
    $ptotal = 0;
    $total = 0;
    $i = 0;

    if(isset($_SESSION['cart'])){
        foreach($_SESSION['cart'] as $key => $value){
            $ptotal = $value['productPrice'] * $value['productQuantity'];      
            $total += $value['productPrice'] * $value['productQuantity'];      
            $ptotal = $value['productPrice'] * $value['productQuantity']; 
            $i = $key +1;
            echo"
            <form action='insertcart.php' method='POST'>

            <tr>
            <td>$i</td>
            <td><input type='hidden' name='PName' value='$value[productName]'>$value[productName]</td>
            <td><input type='hidden' name='PPrice' value='$value[productPrice]'>$value[productPrice]</td>
            <td><input type='' name='PQuantity' value='$value[productQuantity]'></td>
            <td>$ptotal</td>
            <td><button name='update' class= 'btn-warning'>Update</button></td>
            <td><button name='remove' class= 'btn-danger'>Delete</button></td>
            <td><input type='hidden' name='item' value='$value[productName]'</td>
            </tr>
            </form>
            ";
        }

    }

    
    ?>
</tbody>
</table>
</div>
<div class="col-lg-3 text-center">
<h3>Total</h3>
<h2 class="bg-danger text-white"><?php echo number_format($total,2) ?></h2>
<div class="mb-3">
    <form action="" method="POST">
<button type="submit" class="w-100 bg-primary fs-4 text-white" name="checkout">CHECKOUT</button></form>
</div>
</div>
</div>
<?php }
else{
    ?>
    
    
<div class="container mt-5 border border-success">
    <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Your cart</span>
        <span class="badge badge-secondary badge-pill">1</span>
      </h4>
      <ul class="list-group mb-3">
        <li class="list-group-item d-flex justify-content-between lh-condensed">
          <div>
            <h6 class="my-0"></h6>
            <small class="text-muted"></small>
          </div>
          <span class="text-muted"></span>
        </li>
        <li class="list-group-item ">
          <span>Total </span>
          <br>
          <br>
          <?php 
          
          

    if(isset($_SESSION['cart'])){
        foreach($_SESSION['cart'] as $key => $value){
            $ptotal = $value['productPrice'] * $value['productQuantity'];     
            $pname=$value['productName'];
            echo "<br><strong>$pname</strong><br><small>RS. $ptotal</small>";
        }
    }
          ?>
          
        </li>
      </ul>

    </div>
    <div class="col-md-8 order-md-1">
      <h4 class="mb-3">Billing address</h4>
      <form action="" method="POST">
        <div class="row">
          <div class=" mb-3">
            <label for="firstName">Full name</label>
            <input type="text" class="form-control" name="fname" placeholder="" value="" required="">
            
          </div>
        </div>
        <div class="mb-3">
          <label for="email">Email </label>
          <input type="email" required  class="form-control" name="email" placeholder="you@example.com">
        </div>
        <div class="mb-3">
          <label for="address">Address</label>
          <input type="text" class="form-control" name="address" required="">
        </div>
        <div class="mb-3">
          <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
          <input type="text" class="form-control" name="address2">
        </div>
        <div class="mb-3">
          <label for="phonenumber">Phone Number</label>
          <input type="number" required class="form-control" name="phonenumber">
        </div>
        <div class="row">
          <div class="col-md-5 mb-3">
            <label for="country">Country</label>
            <select class="custom-select d-block w-100" name="country" required="">
              <option value="">Choose...</option>
              <option>Nepal</option>
            </select>
            
          </div>
          <div class="col-md-4 mb-3">
            <label for="state">State</label>
            <select class="custom-select d-block w-100" name="state" required="">
              <option value="">Choose...</option>
              <option>State No 1</option>
              <option>State No 2</option>
              <option>State No 3</option>
              <option>State No 4</option>
              <option>State No 5</option>
              <option>State No 6</option>
              <option>State No 7</option>
            </select>
          </div>
        <button class="btn btn-primary btn-lg btn-block" type="submit" name="place-order">Place Order</button>
      </form>
    </div>
  </div>
    <?php 
}

?>

</body>

</html>