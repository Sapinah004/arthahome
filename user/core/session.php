<?php
session_start();
    include('../core/config.php');
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location : ../pages/auth/login.php");
        exit;
    }
    $user_id = $_SESSION['id_user'];
    $username = $_SESSION['username'];
?>