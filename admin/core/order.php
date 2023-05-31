<?php
    include('../core/config.php');

    if(isset($_POST['terima_pembayaran'])){
        $id_pembayaran = trim($_POST['id_pembayaran']);
        $id_order = trim($_POST['id_order']);
        $sql_acceptPayment = mysqli_query($connect, "UPDATE tb_pembayaran SET status_pembayaran = 1 WHERE id_pembayaran = $id_pembayaran");
        if($sql_acceptPayment == TRUE){
            $message = "Bukti pembayaran diterima";
            echo "<script type='text/javascript'>alert('$message')</script>";
            $url = "../../Admin/pages/dashboard.php?page=order_detail&order=$id_order" ;
            echo '<script>window.location.replace("'.$url.'");</script>';
        }else{
            $message = "Bukti pembayaran gagal diterima, harap coba lagi";
            echo "<script type='text/javascript'>alert('$message')</script>";
            $url = "../../Admin/pages/dashboard.php?page=order_detail&order=$id_order" ;
            echo '<script>window.location.replace("'.$url.'");</script>';
        }
    }
    if(isset($_POST['tolak_pembayaran'])){
        $id_pembayaran = trim($_POST['id_pembayaran']);
        $id_order = trim($_POST['id_order']);
        $sql_rejectPayment = mysqli_query($connect, "UPDATE tb_pembayaran SET status_pembayaran = 2 WHERE id_pembayaran = $id_pembayaran");
        if($sql_rejectPayment == TRUE){
            $message = "Bukti pembayaran berhasil ditolak";
            echo "<script type='text/javascript'>alert('$message')</script>";
            $url = "../../Admin/pages/dashboard.php?page=order_detail&order=$id_order" ;
            echo '<script>window.location.replace("'.$url.'");</script>';
        }else{
            $message = "Bukti pembayaran gagal ditolak, harap coba lagi";
            echo "<script type='text/javascript'>alert('$message')</script>";
            $url = "../../Admin/pages/dashboard.php?page=order_detail&order=$id_order" ;
            echo '<script>window.location.replace("'.$url.'");</script>';
        }
    }
    if(isset($_POST['tambah_catatan'])){
        $id_pembayaran = trim($_POST['id_pembayaran']);
        $id_order = trim($_POST['id_order']);
        $catatan = trim(mysqli_real_escape_string($connect, $_POST['catatan']));
        $sql_addNotes = mysqli_query($connect, "UPDATE tb_pembayaran SET catatan = '".$catatan."' WHERE id_pembayaran = $id_pembayaran");
        if($sql_addNotes == TRUE){
            $message = "Catatan berhasil diupload";
            echo "<script type='text/javascript'>alert('$message')</script>";
        }else{
            $message = "Catatan gagal diupload";
            echo "<script type='text/javascript'>alert('$message')</script>";
        }
    }
?>