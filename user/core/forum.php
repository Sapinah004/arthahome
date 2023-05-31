<?php
    $docroot = $_SERVER['DOCUMENT_ROOT'];
    include("$docroot/ArthaHome/User/core/config.php");
    // session_start();

    if(isset($_POST['unggahTopik'])){
        global $connect;
        $judul = trim($_POST["judul"]);
        $topik = trim($_POST["topik"]);
        $id_user = $_SESSION['id_user'];
        $sql = "INSERT INTO tb_forum (judul, topik, id_user, tanggal, update_at ) VALUES ('".$judul."', '".$topik."',  '".$id_user."', NOW(), NOW())";
        $query = mysqli_query($connect, $sql);
        if($query == TRUE){
            $id_forum = $connect->insert_id;
            $sql = "INSERT INTO tb_view_forum (total_view, id_forum) VALUES ('0', '".$id_forum."')";
            $query = mysqli_query($connect, $sql);
            $url = "../pages/index.php?page=list-forum";
            echo '<script> window.location.replace("'. $url .'");</script>';
            return true;
        }
        else{
            echo "<div class='alert alert-danger text-center'> Failed upload blog. Please try again. </div>";                
        }
    }
    if(isset($_POST['unggahKomentar'])){
        global $connect;
        $komentar = trim($_POST["komentar"]);
        $id_user = $_SESSION['id_user'];
        $sql = "INSERT INTO tb_komentar (komentar, id_user, tanggal , id_forum) VALUES ('".$komentar."','".$id_user."', NOW(), '".$_GET['id']."')";
        $query = mysqli_query($connect, $sql);
        if($query == TRUE){
            $url = "../pages/index.php?page=forum&id=".$_GET['id'];
            echo '<script> window.location.replace("'. $url .'");</script>';
            return true;
        }
        else{
            echo "<div class='alert alert-danger text-center'> Failed upload comment. Please try again. </div>";  
        }
    }
    if(isset($_POST['updateForum'])){
        $id_forum = trim($_POST['id_forum']);
        $judul = trim($_POST['judul']);
        $topik = trim($_POST['topik']);
        $id_user = $_SESSION['id_user'];
        $sql = "UPDATE tb_forum SET
        judul = '".$judul."',
        topik = '".$topik."',
        update_at = NOW(),
        id_user = '".$id_user."' WHERE id_forum = '".$id_forum."'";

        $query = mysqli_query($connect, $sql);
        if($query == TRUE){
            $message = "Forum berhasil diubah";
             echo "<script type='text/javascript'>alert('$message')</script>";
            $url = "../pages/index.php?page=forum-detail&id='".$id_forum."'" ;
            echo '<script>window.location.replace("'.$url.'");</script>';
            return true;
        }
        else{
            $message = "forum gagal diubah";
            echo "<script type='text/javascript'>alert('$message')</script>";
        }
    }
    if(isset($_GET['hapus_forum'])){
        $sql = "SELECT tb_forum.*, tb_komentar.* , tb_view_forum.* FROM tb_forum LEFT JOIN tb_komentar ON tb_forum.id_forum = tb_komentar.id_forum LEFT JOIN tb_view_forum ON tb_view_forum.id_forum = tb_forum.id_forum WHERE tb_forum.id_forum =" .$_GET['hapus_forum'];
        $query = mysqli_query($connect, $sql);
        if($query == true){
            $sql_delete = "DELETE  k , v ,f FROM tb_forum AS f LEFT JOIN tb_komentar AS k ON k.id_forum = f.id_forum LEFT JOIN tb_view_forum AS v ON v.id_forum = f.id_forum WHERE f.id_forum =" .$_GET['hapus_forum'];
            $queryHapus = mysqli_query($connect, $sql_delete);
            if($queryHapus == TRUE){
                $message = "Forum berhasil dihapus";
                echo "<script type='text/javascript'>alert('$message')</script>";
                $url = '../pages/index.php?page=forum-saya';
                echo '<script> window.location.replace("'. $url .'");</script>';
            }else{
                $message = "Forum gagal dihapus";
                echo "<script type='text/javascript'>alert('$message')</script>";
            }
        }

    }
    if(isset ($_POST['count'])){
        $id_forum = trim($_POST['id_forum']);
        $sql = "UPDATE tb_view_forum SET total_view = total_view + 1 WHERE id_forum = '".$id_forum."'";
        $query = mysqli_query($connect, $sql);
        if($query == TRUE){
            $url = '../pages/index.php?page=forum&id='.$id_forum;
            echo '<script> window.location.replace("'. $url .'");</script>';
        }
    }


?>
