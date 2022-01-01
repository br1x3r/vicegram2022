<?php
if (isset($_COOKIE["userid"])) {
    header("location: /");
}
?>
<html lang="en">

<head>
    <title>Vicegram</title>
    <link rel="stylesheet" href="/css/login.css">
    <?php
    include("includes/header.php");
    ?>
</head>

<body>
    <div class="vignette"></div>
    <div class="container text-center">
        <div class="row">
            <div class="col jumbotron-25">
                <h1><img src="/assets/logos/vice_water.png" height="150px" width="150px"></h1>
                <p> Vicegram is a British microblogging and social networking service on which users post and interact with messages to gain followers. Registered users can post, like, and repost things, but unregistered users can only read those that are publicly available.</p>
                <a class="d-grid btn btn-primary" href="/learn-more.php"> Learn More?</a>
            </div>
            <div class="col order-1 jumbotron-25">
                <div class="loginbox">
                    <img src="/assets/logos/White-NoBg-Logo.png" class="avatar">
                    <h3>Login to Vicegram</h3>
                    <br>
                    <form action="/php/login.inc.php" method="post">
                        <p>Username</p>
                        <input type="text" name="uid" placeholder="Enter Username or Email">
                        <p>Password</p>
                        <input type="password" name="pwd" placeholder="Enter Password">
                        <div class="d-grid gap-2">
                            <button class="nav-link btn btn-outline-success mb-4" type="submit" name="submit"><i class="fas fa-sign-in-alt"></i>Login</button>
                        </div>
                        <div class="row">
                            <div class="col-sm-5 col-md-6">
                                <div class="d-grid">
                                    <a class="fs-6" href="#"><i class="fas fa-question"></i> Lost your password?</a><br>
                                </div>
                            </div>
                            <div class="col-sm-5 offset-sm-2 col-md-6 offset-md-0">
                                <div class="d-grid">
                                    <a class="fs-6" href="/sign-up.php"><i class="fas fa-hammer"></i> Dont have an account?</a>
                                </div>
                            </div>
                        </div>
                    </form>
                    <?php
                    if (isset($_GET["error"])) {
                        if ($_GET["error"] == "emptyinput") {
                            include "errors/emptyinput.php";
                        }
                        if ($_GET["error"] == "wronglogin") {
                            include "errors/wronglogin.php";
                        }
                        if ($_GET["error"] == "wrongpassword") {
                            include "errors/wrongpassword.php";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
