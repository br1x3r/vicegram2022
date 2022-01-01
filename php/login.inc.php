<?php
    if (isset($_POST["submit"])) {
        $uid = $_POST["uid"];
        $pwd = $_POST["pwd"];

        require_once('dbh.inc.php');
        require_once('functions.inc.php');

        if (emptyInputsLogin($uid, $pwd) !== false) {
            header("location: ../?error=emptyinput");
            exit();
        }

        loginUser($conn, $uid, $pwd);
    } else {
        header("location: ../");
        exit();
    }
?>
