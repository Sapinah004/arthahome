<?php
include("../core/config.php");

session_start();
if(isset($_POST['login']))
{
    $username = mysqli_real_escape_string($connect, $_POST['username']);
    $password = mysqli_real_escape_string($connect,$_POST['password']);
    $sql = mysqli_query($connect, "SELECT id_admin, username, password FROM tb_admin where username = '".$username."' and password = '".$password."' LIMIT 1");
    $data = mysqli_fetch_assoc($sql);
    if(mysqli_num_rows($sql) > 0 ){
        
        $_SESSION['id_admin'] = $data['id_admin'];
        $_SESSION['username'] = $data['username'];
        $_SESSION['loggedin'] = true;
        header('location: ../pages/dashboard.php?page=product_list');
    }
    else{
        header ("location: ../pages/index.php?pesan=gagal");
    }
}
?>