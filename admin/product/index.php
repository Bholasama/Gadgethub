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
    include 'mystore.php';
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-6 m-auto border border-primary mt-3">
        <form action="insert.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
        <p class="text-center fw-bold fs-3 text-warning">Product Details</p>
        </div>
        <div class="mb-3">
        <label class="form-label">Product Name:</label>
         <input type="text" name="Pname" class="form-control"  placeholder="Enter product name">
        </div>
        <div class="mb-3">
        <label class="form-label">Product Price:</label>
         <input type="number" name="Pprice" class="form-control"  placeholder="Enter product price">
        </div>
        <div class="mb-3">
        <label class="form-label">Product Stock:</label>
         <input type="number" name="Pstock" class="form-control"  placeholder="Enter product stock">
        </div>
        <div class="mb-3">
        <label class="form-label">Add Product Image:</label>
         <input type="file" name="Pimage" class="form-control">
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
        <button name="submit" class="bg-danger fs-4 fw-bold my-3 form-control text-white">Upload</button>
    </form>
        </div>
    </div>
</div>
<!-----fetch data--->
<div class="container ">
    <div class="row">
        <div class="col-md-8 m-auto">
  

<table class="table border border-warning table-hover border my-5">
<thead class="bg-dark text-white fs-5 font-monospace text-center">    
<th>Id</th>
<th>Name</th>
<th>Price</th>
<th>Stock</th>
<th>Image</th>
<th>Category</th>
<th>Delete</th>
<th>Update</th>
</thead>

<tbody class="text-center">
    <?php
    include 'connect.php';
    $Record = mysqli_query($con, "SELECT * FROM `tblproduct`");
        while($row = mysqli_fetch_array($Record))
        echo"
        <tr>
        <td>$row[Id]</td>
        <td>$row[PName]</td>
        <td>$row[PPrice]</td>
        <td>$row[PStock]</td>
        <td><img src='$row[Pimage]' height='120px' width='200px'></td>
        <td>$row[PCategory]</td>
        <td><a href = 'delete.php? ID= $row[Id]' class = 'btn btn-danger'>Delete</a></td>
        <td><a href = 'update.php? ID= $row[Id]' class = 'btn btn-warning'>Update</a></td>
        </tr>
        ";

    ?>
</tbody>
</table>
</div>
</div>
</div>

</body>
</html>

