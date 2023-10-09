<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// You should replace the next line with an include statement that brings in your database connection.
// include 'your_database_connection_file.php';

if (!isset($_SESSION['user'])) {
    echo "<script>
    alert('Must Be Logged In');
    window.location.href='/gadgethub/user/form/login.php';
    </script>";
    exit();
}

// Initialize the cart if it doesn't exist
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

$product_name = $_POST['PName'] ?? '';
$product_price = $_POST['PPrice'] ?? '';
$product_quantity = $_POST['PQuantity'] ?? '';

// Add to cart operation
if (isset($_POST['addCart'])) {
    if ($product_quantity < 1) {
        header('location:/gadgethub/user');
        exit();
    }

    $check_product = array_column($_SESSION['cart'], 'productName');
    if (in_array($product_name, $check_product)) {
        echo "<script>
        alert('Product Already added');
        window.location.href ='index.php';
        </script>";
        exit();
    } else {
        $_SESSION['cart'][] = array('productName' => $product_name,
            'productPrice' => $product_price,
            'productQuantity' => $product_quantity);
        header("location:viewCart.php");
        exit();
    }
}

// Remove product operation
if (isset($_POST['remove'])) {
    foreach ($_SESSION['cart'] as $key => $value) {
        if ($value['productName'] === $_POST['item']) {
            unset($_SESSION['cart'][$key]);
            $_SESSION['cart'] = array_values($_SESSION['cart']);
            header('location:viewCart.php');
            exit();
        }
    }
}

// Update product operation
if (isset($_POST['update'])) {
    foreach ($_SESSION['cart'] as $key => $value) {
        if ($value['productName'] === $_POST['item']) {
            $_SESSION['cart'][$key] = array('productName' => $product_name,
                'productPrice' => $product_price,
                'productQuantity' => $product_quantity);
            header("location:viewCart.php");
            exit();
        }
    }
}

// Place order operation
if (isset($_POST['place-order'])) {
    // Input sanitization
    $fullname = mysqli_real_escape_string($con, $_POST['fname']);
    // ... (other sanitization operations)

    $productDetails = "";

    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $key => $value) {
            $productName = mysqli_real_escape_string($con, $value['productName']);
            // ... (your code for processing products in cart)

            $stockResult = mysqli_query($con, "SELECT PStock FROM tblproduct WHERE PName='$productName'");
            $row = mysqli_fetch_assoc($stockResult);
            $currentStock = $row['PStock'];
            $newStock = $currentStock - $product_quantity;
            
            if ($newStock >= 0) {
                mysqli_query($con, "UPDATE tblproduct SET PStock='$newStock' WHERE PName='$productName'");
            } else {
                echo "Error: Not enough stock for $productName";
                exit();
            }
        }
        
        // Inserting order into database
        $insertOrderQuery = "INSERT INTO tblorder (FullName, Email, Address, Address2, ProductDetails, PhoneNumber, Status) VALUES ('$fullname', '$email', '$address', '$address2', '$productDetails', '$phonenumber', 'processing')";
        $orderResult = mysqli_query($con, $insertOrderQuery);
        if ($orderResult) {
            echo "<h1>Order has been placed successfully</h1>";
            unset($_SESSION['cart']);
        } else {
            echo "Error: Could not place the order. Please try again.";
        }
    }
}

?>