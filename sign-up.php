<?php
if (isset($_COOKIE["userid"])) {
    header("location: /");
}
?>
<html lang="en">

<head>
    <?php
    include("./includes/header.php")
    ?>
    <title>Vicegram | Sign Up</title>
    <link rel="stylesheet" href="/css/sign-up.css">
</head>

<body>
    <div class="vignette"></div>
    <div class="text-center container">
        <div class="loginbox">
            <img src="/assets/logos/White-NoBg-Logo.png" class="avatar">
            <h1 class="text-center">Sign Up</h1>
            <form action="/php/sign-up.inc.php" method="POST">
                <p>Email</p>
                <input type="text" name="email" placeholder="Enter your Email">
                <p>Name</p>
                <input type="text" name="name" placeholder="Enter your Name">
                <p>Username</p>
                <input type="text" name="uid" placeholder="Enter your Username">
                <p>Password</p>
                <input type="password" name="pwd" placeholder="Enter a Password">
                <p>Confirmation</p>
                <input type="password" name="pwdrepeat" placeholder="Confirm Password">
                <div class="d-grid">
                    <button class="nav-link btn btn-outline-success mb-2" type="submit" name="submit">Sign Up</button>
                </div>
            </form>
            <p class="text-center fs-6">Already have an account? <a class="fs-6" href=" /">Sign In?</a></p>
            <?php
            if (isset($_GET["error"])) {
                if ($_GET["error"] == "emptyinput") {
                    include "errors/emptyinput.php";
                }
                if ($_GET["error"] == "invalidUid") {
                    include "errors/invaliduid.php";
                }
                if ($_GET["error"] == "invalidEmail") {
                    include "errors/invalidemail.php";
                }
                if ($_GET["error"] == "nonmatchpass") {
                    include "errors/passwordrepeat.php";
                }
                if ($_GET["error"] == "UsernameTaken") {
                    include "errors/usernametaken.php";
                }
                if ($_GET["error"] == "StmtFail") {
                    include "errors/smtmerror.php";
                }
                if ($_GET["error"] == "none") {
                    include "errors/succses.php";
                }
            }
            ?>
        </div>
    </div>
</body>

</html>