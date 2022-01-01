<?php
session_start();
if (!isset($_COOKIE["useruid"])) {
    include("./main.php");
} else {
    include("./home.php");
}
