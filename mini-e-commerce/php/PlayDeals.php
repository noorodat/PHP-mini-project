<?php 
session_start();

if ($_SESSION['is_logged_in']) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $productName = $_POST["product_name"];
        $productPrice = $_POST["product_price"];
        $productImage = $_FILES["product_image"];

        $imageName = $productImage['name'];
        $imageType = $productImage['type'];
        $imageTmp = $productImage['tmp_name'];
        $imageSize = $productImage['size'];

        $allowedFiles = array('jpg', 'gif', 'jpeg', 'png');

        $fileExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION)); // Use pathinfo to get file extension

        if (in_array($fileExtension, $allowedFiles)) {
            // Specify the destination directory for the image
            $destinationDir = 'C:/xampp/htdocs/PHP-mini-project/mini-e-commerce/images/products/';
            $destinationPath = $destinationDir . $imageName;

            // Check if the destination directory exists, create it if not

            // Move the uploaded image to the destination directory
            if (move_uploaded_file($imageTmp, $destinationPath)) {
                $product = array(
                    "name" => $productName,
                    "price" => $productPrice,
                    "image" => str_replace($_SERVER['DOCUMENT_ROOT'], '', $destinationPath) // Save the relative image path in the array
                );

                // Add the product array to the session
                if (!isset($_SESSION["products"])) {
                    $_SESSION["products"] = array();
                }
                $_SESSION["products"][] = $product;
                header("Location: PlayDeals.php");
                exit();
            }
        }
    }
}
else {
    header("Location: ../html/login.html");
}




// echo "<pre>";
// print_r($_SESSION["products"]);
// echo "</pre>";

// echo "<img src='{$_SESSION['products'][1]['image']}' alt='Product Image'>";

// session_destroy();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PlayDeals</title>
        <!-- Start CSS Links -->
        <link rel="stylesheet" href="../css/normalize.css">
        <link rel="stylesheet" href="../css/normalize.css">
        <link rel="stylesheet" href="../css/bootstrap.css.map">
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/styles.css">
        <!-- End CSS Links -->
</head>
<body>
    
<?php include('./navbar.php') ?>

<section class="landing-page">
    <div class="container">
    <div class="text text-center">
        <h2>PlayDeals</h2>
        <p>Welcome to PlayDeals, your ultimate gaming card marketplace where players unite to buy, sell, and trade the most sought-after cards for epic adventures</p>
    </div>
    </div>
</section>

<section class="our-products section">
    <div class="container">
        <h2 class="main-heading">Our Products</h2>
        <button id="addProduct">Add a product</button>
        <?php
            if (isset($_SESSION["products"]) && count($_SESSION["products"]) > 0) {
                echo '<button id="addProduct"><a href="viewProducts.php" style="color: #7fffd6">View Products</a></button>';
            }
        ?>
            <div class="add-product-form section">
            <div id="closeBtn"><i class="fa-solid fa-xmark mb-3"></i></div>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="inpt">
                    <label for="product_name">Product Name:</label>
                    <input type="text" id="product_name" name="product_name" required>
                </div>
                
                <div class="inpt">
                    <label for="product_price">Product Price:</label>
                    <input type="number" id="product_price" name="product_price" required>
                </div>

                <div class="inpt">
                    <label for="">Product Image:</label>
                    <input type="file" placeholder="Image" id="product_image" name="product_image" required>
                </div>

                <button type="submit">Add</button>
            </form>
        </div>
    </div>
</section>

<section class="products d-flex flex-wrap text-center justify-content-center" id="products">
<?php 

// print_r($_SESSION["products"][0]["image"]);

if(isset($_SESSION["products"])) {
    for($i = 0;  $i < count($_SESSION["products"]); $i++) {
        echo "<div class='product p-4' style='color:#7fffd6'>";
        echo "<img src='{$_SESSION['products'][$i]['image']}' alt='Product Image' width='250px'>";
        echo "<div class='txt p-2' style='background-color: #0a3442'>
                <p class= name'>{$_SESSION['products'][$i]['name']}</p>
                <p class= name'>\${$_SESSION['products'][$i]['price']}</p>
            </div>";
        echo "</div>";
        if($i == 3) {
            break;
        }
    }

}

else {
    echo "<p style='color:red'>No products to show</p>";
}

?>

</section>


    <!-- Start JS Links -->
    <script src="../js/all.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js.map"></script>
    <script src="../js/PlayDeals.js"></script>
    <!-- End JS Links -->
</body>
</html>


