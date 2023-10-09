<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order</title>
     <!------Bootstrap CDN---->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <?php
     include 'mystore.php';
    $con = mysqli_connect('localhost','root','','gadgethub');

    ?>
     <div class="container mt-5">
        <div class="row">
            <div class="col-md-10">
<table class="table table-secondary table-bordered">
    <thead class="text-center">
            <th>S.N</th>
            <th>Fullname</th>
            <th>Email</th>
            <th>Address</th>
            <th>Address 2</th>
            <th>Phonenumber</th>
            <th>ProductDetails</th>
            <th>Status</th>
        
            
            
</thead>
<tbody class="text-center text-danger">
    <?php
    $Record = mysqli_query($con, "SELECT * FROM `tblorder`");
    
    while($row = mysqli_fetch_array($Record)){

        if($row['state']=="processing"){
            $text="<a href=done.php?id=$row[id]>Done</a>";
        }else{
            $text="";
        }
        echo"
        <tr>
        <td>$row[id]</td>
        <td>$row[fullname]</td>
        <td>$row[email]</td>
        <td>$row[address]</td>
        <td>$row[address2]</td>
        <td>$row[phonenumber]</td>
        <td>$row[productdetails]</td>
        <td>$row[state] $text</td>

        
        </tr>
        ";
    }

    ?>
</tbody>
</table>
</div>
</div>
</div>
    
</body>
</html>