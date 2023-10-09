
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product-page</title>
        <!------Bootstrap CDN---->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
<?php

$id = $_GET['ID'];
include 'connect.php';
$Record = mysqli_query($con, "SELECT * FROM `tblproduct` WHERE Id = $id");
$data = mysqli_fetch_array($Record);


?>
    <div class="container">
        <div class="row">
            <div class="col-md-6 m-auto border border-primary mt-3">
        <form action="update.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
        <p class="text-center fw-bold fs-3 text-warning">Product Update</p>
        </div>
        <div class="mb-3">
        <label class="form-label">Product Name:</label>
         <input type="text" value="<?php echo $data['PName'] ?>" name="Pname" class="form-control"  placeholder="Enter product name">
        </div>
        <div class="mb-3">
        <label class="form-label">Product Price:</label>
         <input type="number" value="<?php echo $data['PPrice'] ?>" name="Pprice" class="form-control"  placeholder="Enter product price">
        </div>
        <div class="mb-3">
        <label class="form-label">Product Stock:</label>
         <input type="number" value="<?php echo $data['PStock'] ?>" name="Pstock" class="form-control"  placeholder="Enter product stock">
        </div>
        <div class="mb-3">
        <label class="form-label">Add Product Image:</label>
         <input type="file" name="Pimage" class="form-control"><br>
         <img src=" <?php echo $data['Pimage']?>"  alt="" style="height: 100px";>
        </div>
        <div class="mb-3">
        <label class="form-label">Select Page Category</label>
        <select class="form-select" name="Pages">
        <option value="Laptop">Laptop</option>
        <option value="Mobile">Mobile</option>
        <option value="Headphone">Headphone</option>
        <option value="Smartwatch">Smartwatch</option>
        </select>
        </div>
        <input type ="hidden" name="id" value="<?php echo $data['Id']?>">
        <button name="update" class="bg-danger fs-4 fw-bold my-3 form-control text-white">Update</button>
    </form>
        </div>
    </div>
</div>

    <!------php update code---->
<?php
if(isset($_POST['update'])){
    $id = $_POST['id'];

$product_name = $_POST['Pname'];
$Pdesc = $_POST['Pdesc'];
$product_price = $_POST['Pprice'];
$product_stock = $_POST['Pstock'];
$product_image = $_FILES['Pimage'];
$image_loc = $_FILES['Pimage']['tmp_name'];
$image_name = $_FILES['Pimage']['name'];
$img_des = "Uploadimage/".$image_name;
move_uploaded_file($image_loc, "Uploadimage/".$image_name);

$product_category = $_POST['Pages'];
include 'connect.php';

mysqli_query($con,"UPDATE `tblproduct` SET `PName`='$product_name',`PPrice`='$product_price',
            `Pstock`='$product_stock',`Pimage`='$img_des ',`PCategory`='$product_category' WHERE Id = $id");
            header("location:index.php");


}



?>



</body>
</html>


