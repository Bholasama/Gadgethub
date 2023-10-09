<?php
// Include your database connection code here (e.g., connect.php)
include 'connect.php';

if (isset($_GET['search_query'])) {
    $search_query = $_GET['search_query'];

    // Sanitize the search query to prevent SQL injection
    $search_query = mysqli_real_escape_string($con, $search_query);

    // Perform a search query on your product data table
    $sql = "SELECT * FROM tblproduct WHERE PName LIKE '%$search_query%'";

    $result = mysqli_query($con, $sql);

    if (!$result) {
        die("Database query failed: " . mysqli_error($con));
    }
    while ($row = mysqli_fetch_array($result)) {
        // Check if 'PImage' exists in the row and provide a default image if it doesn't
        $image = isset($row['Pimage']) ? '../admin/product/' . $row['Pimage'] : 'path_to_default_image.jpg';
        
        echo '<div class="col-md-3 col-lg-4 m-auto mb-4">';
        echo '<div class="card m-auto" style="width: 18rem;">';
        echo '<img src="' . $image . '" class="card-img-top m-auto" style="width:230px; height:180px;">';
        echo '<div class="card-body text-center">';
        echo '<h5 class="card-title text-danger fs-4 fw-bold">' . $row['PName'] . '</h5>';
        echo '<p class="card-text text-danger fs-4 fw-bold">Rs. ' . number_format($row['PPrice'], 2) . '</p>';
        echo '<h5 class="card-title text-danger fs-4 fw-bold">In stock: ' . $row['PStock'] . '</h5>';
        echo '<form action="insertcart.php" method="POST">';
        echo '<input type="hidden" name="PName" value="' . $row['PName'] . '">';
        echo '<input type="hidden" name="PPrice" value="' . $row['PPrice'] . '">';
        echo '<input type="hidden" name="PStock" value="' . $row['PStock'] . '">';
        echo '<input type="number" name="PQuantity" style="width: 40%" min="1" max="' . $row['PStock'] . '" placeholder="Quantity"><br><br>';
        echo '<input type="submit" name="addCart" class="btn btn-warning text-white w-100" value="Add To Cart">';
        echo '</form>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
    
    
    
    }
    

?>
