<?php

session_start();

if (!$_SESSION['is_logged_in']) {
    header("Location: ../html/login.html");
}

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
<style>
    nav.navbar {
        background-color: #03090d !important;
    }

    nav .navbar-nav .nav-item a {
        color: var(--second-color) !important;
    }
</style>

<body>
    <?php include('./navbar.php') ?>

    <div class="viewProducts section">
        <div class="container">
            <h2>Products</h2>

            <section class="products d-flex flex-wrap text-center mt-4 justify-content-center" id="products">
                <?php

                // print_r($_SESSION["products"][0]["image"]);

                if (isset($_SESSION["products"])) {
                    for ($i = 0; $i < count($_SESSION["products"]); $i++) {
                        echo "<div class='product p-4' style='color:#7fffd6'>";
                        echo "<img src='{$_SESSION['products'][$i]['image']}' alt='Product Image' width='250px'>";
                        echo "<div class='txt p-2' style='background-color: #0a3442'>
                <p class= name'>{$_SESSION['products'][$i]['name']}</p>
                <p class= name'>\${$_SESSION['products'][$i]['price']}</p>
            </div>";
                        echo "</div>";
                    }
                } else {
                    echo "<p style='color:red'>No products to show</p>";
                }

                ?>
        </div>
    </div>
    </section>

    <?php include('./footer.php') ?>


    <!-- Start JS Links -->
    <script src="../js/all.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js.map"></script>
    <script src="../js/PlayDeals.js"></script>
    <!-- End JS Links -->
</body>

</html>