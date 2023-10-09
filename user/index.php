<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GadgetHub</title>
    <?php
    include 'header1.php';
    ?>
</head>
<body>
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="row">
                <h1 class="text-warning font-monospace text-center my-3">Home</h1>

                <!-- HTML form for search -->
                <form id="search-form" action="#" method="GET" class="mb-3">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search_query" id="search_query" placeholder="Search products...">
                    </div>
                </form>

                <!-- Container for search results -->
                <div id="search-results">
                    <!-- Search results will be displayed here -->
                </div>

                <?php
                include 'connect.php';
                ?>

                <script>
                // Function to perform an AJAX search
                function performSearch() {
                    const searchQueryInput = document.getElementById("search_query");
                    const searchResultsContainer = document.getElementById("search-results");

                    const searchQuery = searchQueryInput.value.trim(); // Get the search query

                    if (searchQuery !== "") {
                        // Perform an AJAX request to search.php
                        const xhr = new XMLHttpRequest();
                        xhr.open("GET", "search.php?search_query=" + encodeURIComponent(searchQuery), true);

                        xhr.onreadystatechange = function () {
                            if (xhr.readyState === 4 && xhr.status === 200) {
                                // Append the search results to the search-results container
                                searchResultsContainer.innerHTML = xhr.responseText;
                            }
                        };

                        xhr.send();
                    } else {
                        // Clear the search results if the query is empty
                        searchResultsContainer.innerHTML = "";
                    }
                }

                // Listen for input changes in the search field
                document.getElementById("search_query").addEventListener("input", function () {
                    performSearch();
                });
                </script>
                <?php
include 'connect.php';

// Check if a search query is provided
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

    // Check if any products were found
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            // Display the searched products
            echo '<div class="col-md-3 col-lg-4 m-auto mb-4">';
            echo '<div class="card m-auto" style="width: 18rem;">';

            // Check if 'PImage' exists in the row and provide a default image if it doesn't
            $image = isset($row['Pimage']) ? '../admin/product/' . $row['Pimage'] : 'path_to_default_image.jpg';

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
    } else {
        echo "No products found matching your search query.";
    }
} else {
    // If no search query is provided, display all products
    $sql = "SELECT * FROM tblproduct";

    $result = mysqli_query($con, $sql);

    if (!$result) {
        die("Database query failed: " . mysqli_error($con));
    }

    while ($row = mysqli_fetch_array($result)) {
        echo '<div class="col-md-3 col-lg-4 m-auto mb-4">';
        echo '<div class="card m-auto" style="width: 18rem;">';

        // Check if 'PImage' exists in the row and provide a default image if it doesn't
        $image = isset($row['Pimage']) ? '../admin/product/' . $row['Pimage'] : 'path_to_default_image.jpg';

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

            </div>
        </div>
    </div>
    <?php
    include 'footer.php';
    ?>
  
</body>
</html>

