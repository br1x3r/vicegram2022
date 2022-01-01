<?php
if (isset($_POST["submit"])) {
    $email = $_POST["email"];
    $name = $_POST["name"];
    $uid = $_POST["uid"];
    $pwd = $_POST["pwd"];
    $pwdrepeat = $_POST["pwdrepeat"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if (emptyInputsSignup($email, $uid, $name, $pwd, $pwdrepeat) !== false) {
        header("location: ../sign-up.php?error=emptyinput");
        exit();
    }
    if (invalidUid($uid) !== false) {
        header("location: ../sign-up.php?error=invalidUid");
        exit();
    }
    if (invalidEmail($email) !== false) {
        header("location: ../sign-up.php?error=invalidEmail");
        exit();
    }
    if (pwdMatch($pwd, $pwdrepeat) !== false) {
        header("location: ../sign-up.php?error=nonmatchpass");
        exit();
    }
    if (uidExists($conn, $uid, $email) !== false) {
        header("location: ../sign-up.php?error=UsernameTaken");
        exit();
    }

    createUser($conn, $name, $email, $uid, $pwd);
} else {
    header("location: ../sign-up.php");
    exit();
}
