<?php
    function emptyInputsSignup($email, $uid, $name, $pwd, $pwdrepeat)
    {
        $result;
        if (empty($name) || empty($email) || empty($uid) || empty($pwd) || empty($pwdrepeat)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
    function invalidUid($uid)
    {
        $result;
        if (!preg_match("/^[a-zA-Z0-9_ .]*$/", $uid)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
    function invalidEmail($email)
    {
        $result;
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
    function pwdMatch($pwd, $pwdrepeat)
    {
        $result;
        if ($pwd !== $pwdrepeat) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
    function uidExists($conn, $uid, $email)
    {
        $sql = "SELECT * FROM users WHERE usersUid = ? or usersEmail = ?;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../sign-up.php?error=StmtFail");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "ss", $uid, $email);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($resultData)) {
            return $row;
        } else {
            $result = false;
            return $result;
        }

        mysqli_stmt_close($stmt);
    }
    function createUser($conn, $name, $email, $uid, $pwd)
    {
        $sql = "INSERT INTO users (usersName, usersEmail, usersUid, usersPwd) VALUES (?, ?, ?, ?);";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../sign-up.php?error=StmtFail");
            exit();
        }

        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

        mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $uid, $hashedPwd);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header("location: ../sign-up.php?error=none");
        exit();
    }
    function emptyInputsLogin($uid, $pwd)
    {
        $result;
        if (empty($uid) || empty($pwd)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
    function loginUser($conn, $uid, $pwd)
    {
        $uidExists = uidExists($conn, $uid, $uid);
        if ($uidExists === false) {
            header("location: ../");
            exit();
        }

        $pwdHashed = $uidExists["usersPwd"];
        $checkPwd = password_verify($pwd, $pwdHashed);

        if ($checkPwd === false) {
            header("location: ../");
            exit();
        }
        if ($checkPwd === true) {
            session_start();
            $_SESSION["userid"] = $uidExists["usersId"];
            $_SESSION["useruid"] = $uidExists["usersUid"];
            $_SESSION["userpwd"] = $uidExists["usersPwd"];
            setcookie('userid', $uidExists["usersId"], time() * 90, "/");
            setcookie('useruid', $uidExists["usersUid"], time() * 90, "/");
            setcookie('userpwd', $checkPwd, time() * 90, "/");

            header("location: /");
            exit();
        }
    }
    function loginUserCookie($conn, $uid, $pwd)
    {
        $uidExists = uidExists($conn, $uid, $uid);
        if ($uidExists === false) {
            header("location: ../sign-up.php");
            exit();
        }

        $pwdHashed = $uidExists["usersPwd"];


        if ($pwdHashed !== $pwd) {
            header("location : ../unset-cookies.php");
            exit();
        }
        session_start();
        $_SESSION["userid"] = $uidExists["usersId"];
        $_SESSION["useruid"] = $uidExists["usersUid"];
        $_SESSION["userpwd"] = $uidExists["usersPwd"];

        header("location: /");
        exit();
    }
?>
