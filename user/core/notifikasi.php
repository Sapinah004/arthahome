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

?>