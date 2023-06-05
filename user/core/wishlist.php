<?php
    include($_SERVER['DOCUMENT_ROOT'] . "/ArthaHome/User/core/config.php");
    global $connect;

    if(isset($_POST['addWishlist'])){
        $id_rumah = trim($_POST['id_rumah']);
        $id_user = $_SESSION['id_user'];
        $sql = mysqli_query($connect, "INSERT INTO tb_wishlist (id_rumah, id_user, status) VALUES ('".$id_rumah."', '".$id_user."', '1')");
        if($sql == FALSE){
            $message = "gagal menambah wishlist, mohon coba lagi";
            echo "<script type='text/javascript'>alert('$message')</script>";
        }
    }
    if(isset($_GET['hapus_wishlist'])){
        session_start();
        $id_user = $_SESSION['id_user'];
        $sql = mysqli_query($connect, "DELETE FROM tb_wishlist WHERE id_user = '".$id_user."' AND id_rumah =" .$_GET['hapus_wishlist']."");
        if($sql == TRUE){
            $url = "../index.php?page=wishlist";
            echo '<script>window.location.replace("'.$url.'")</script>';
        }else{
            $message = "Wishlist gagal dihapus, mohon coba kembali";
            echo "<script type='text/javascript'>alert('$message')</script>";
        }
    }
    if(isset($_GET['delete_wishlist'])){
        session_start();
        $id_user = $_SESSION['id_user'];
        $sql = mysqli_query($connect, "DELETE FROM tb_wishlist WHERE id_user = '".$id_user."' AND id_rumah =" .$_GET['delete_wishlist']."");
        if($sql == TRUE){
            header("location:../index.php?page=produk&id=".$_GET['delete_wishlist']);
        }else{
            $message = "Wishlist gagal dihapus, mohon coba kembali";
            echo "<script type='text/javascript'>alert('$message')</script>";
        }
    }
?>
