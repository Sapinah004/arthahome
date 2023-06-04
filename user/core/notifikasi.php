<?php
      include($_SERVER['DOCUMENT_ROOT'] . '/ArthaHome/user/core/config.php');
     
    if(isset($_GET['notifikasi'])){
        $sql_updateNotification = mysqli_query($connect, "UPDATE tb_notifikasi SET status = 1 WHERE id_notifikasi =" .$_GET['notifikasi']);
        if($sql_updateNotification == TRUE){
            $sql_getNotification = mysqli_query($connect, "SELECT * FROM tb_notifikasi WHERE id_notifikasi =" .$_GET['notifikasi']);
            $data = mysqli_fetch_array($sql_getNotification);
            $id_order = $data['id_order'];
            if($sql_getNotification == TRUE){
                $url = "../index.php?page=order-detail&order=$id_order";
                echo '<script>window.location.replace("'.$url.'");</script>';
            }
        }
    }
    if(isset($_POST['deleteNotifikasi'])){
        // $notifikasi = $_POST['id_notifikasi'];
        if(!isset($_POST['id_notifikasi'])){
            $message = "Pilih terlebih dahulu notifikasi yang ingin anda hapus";
            echo "<script type='text/javascript'>alert('$message')</script>";
        }
        else{
            $id_notifikasi = ($_POST["id_notifikasi"]);
            $notifikasi = sizeof($id_notifikasi);
            for($i = 0; $i < $notifikasi; $i++){
                $del = $id_notifikasi[$i];
                $sql_deleteNotifikasi = mysqli_query($connect, "DELETE FROM tb_notifikasi WHERE id_notifikasi = $del");
                if($sql_deleteNotifikasi == FALSE){
                    $message = "Notifikasi gagal dihapus, coba lagi beberapa saat";
                    echo "<script type='text/javascript'>alert('$message')</script>";
                }
            }
            
        }
    }

?>