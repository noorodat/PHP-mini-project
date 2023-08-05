<?php 

session_start();

$_SESSION["is_logged_in"] = false;

// Admin info
$adminEmail = "noor.feraas@gmail.com";
$adminPassword = "0000";


if(isset($_POST["email"]) && isset($_POST["password"])) {
    // Get input values
    $userEmail = $_POST["email"];
    $userPassword = $_POST["password"];

    // Check if they are identical with the admin info
    if($userEmail == $adminEmail && $adminPassword == $userPassword){
        $_SESSION["username"] = explode('@', $userEmail)[0];
        $_SESSION["is_logged_in"] = true;
        header("Location: PlayDeals.php");
        exit();
    }
    else {
        echo "<p class='errorLogin' style='color: red'> Invalid username or password. <a href='../html/login.html'>Please try again.</a></p>";
    }
}

?>






