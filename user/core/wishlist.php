<?php
    include("../core/config.php");
    global $connect;

    if(isset($_POST['addWishlist'])){
        $id_rumah = trim($_POST['id_rumah']);
        $id_user = $_SESSION['id_user'];
        $sql = "INSERT INTO tb_wishlist (id_rumah, id_user, status) VALUES ('".$id_rumah."', '".$id_user."', '1')";
        $query = mysqli_query($connect, $sql);
        if($query == FALSE){
            $message = "gagal menambah wishlist, mohon coba lagi";
            echo "<script type='text/javascript'>alert('$message')</script>";
        }
    }
    if(isset($_GET['hapus_wishlist'])){
        session_start();
        $id_user = $_SESSION['id_user'];
        $sql = "DELETE FROM tb_wishlist WHERE id_user = '".$id_user."' AND id_rumah =" .$_GET['hapus_wishlist']."";
        $query = mysqli_query($connect, $sql);
        
        if($query == TRUE){
            // header("location:javascript://history.go(-1)");
            $url = "../pages/index.php?page=wishlist";
            echo '<script>window.location.replace("'.$url.'")</script>';
            // echo "gagal";
        }else{
            $message = "Wishlist gagal dihapus, mohon coba kembali";
            echo "<script type='text/javascript'>alert('$message')</script>";
        }
    }
    if(isset($_GET['delete_wishlist'])){
        session_start();
        $id_user = $_SESSION['id_user'];
        $sql = "DELETE FROM tb_wishlist WHERE id_user = '".$id_user."' AND id_rumah =" .$_GET['delete_wishlist']."";
        $query = mysqli_query($connect, $sql);
        
        if($query == TRUE){
            header("location:../pages/index.php?page=produk&id=".$_GET['delete_wishlist']);
            // $url = "../pages/index.php?page=list-rumah";
            // echo '<script>window.location.replace("'.$url.'")</script>';
            // echo "gagal";
        }else{
            $message = "Wishlist gagal dihapus, mohon coba kembali";
            echo "<script type='text/javascript'>alert('$message')</script>";
        }
    }
?>