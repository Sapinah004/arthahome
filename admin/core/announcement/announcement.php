<?php
    include($_SERVER['DOCUMENT_ROOT'] . '/ArthaHome/Admin/core/config.php');
    if(isset($_POST['addAnnouncement'])){
        global $connect;
        $limit = 5 * 1024 * 1024;
        $limit = 5 * 1024 * 1024;
        $ekstensi = array('png','jpg','jpeg','webp');
        $gambar = ($_FILES["gambar"]["name"]);
        $jumlah_gambar = count($gambar);
        for($i=0; $i<$jumlah_gambar; $i++){
            $gambar = $_FILES['gambar']['name'][$i];
            $tmp = $_FILES['gambar']['tmp_name'][$i];
            $fileType = pathinfo($gambar, PATHINFO_EXTENSION);
            $size = $_FILES['gambar']['size'][$i];
            if($size > $limit){
                $message = "Ukuran gambar terlalu besar, maksimal 5 MB";
                echo "<script type='text/javascript'>alert('$message')</script>";
            }
            elseif(!in_array($fileType, $ekstensi)){
                $message = "Ekstensi gambar tidak diperbolehkan, gambar harus berekstensi png, jpeg, jpg, atau webp";
                echo "<script type='text/javascript'>alert('$message')</script>";
            }
            else{
                move_uploaded_file($tmp,$_SERVER['DOCUMENT_ROOT'] . '/ArthaHome/Admin/core/announcement/images/'.date('d-m-Y').'-'.$gambar);
                $x = date('d-m-Y').'-'.$gambar;
                $sql_addAnnouncement = mysqli_query($connect, "INSERT INTO tb_pengumuman (gambar) VALUES ('".$x."')");
                if($sql_addAnnouncement == TRUE){
                    $message = "Gambar berhasil diupload";
                    echo "<script type='text/javascript'>alert('$message')</script>";
                }
                else{
                    $message = "Gambar gagal diupload";
                    echo "<script type='text/javascript'>alert('$message')</script>";
                }
            }
        }
    }
    if(isset($_GET['delete_image'])){
        $sql_getAnnouncement = mysqli_query($connect, "SELECT * FROM tb_pengumuman WHERE id_announcement =" .$_GET['delete_image']);
        $result = mysqli_fetch_assoc($sql_getAnnouncement);
        $getImageName = $result['gambar'];
        $deletePath = "images/".$getImageName;

        if(unlink($deletePath)){
            $sqlDeleteAnnouncement = mysqli_query($connect, "DELETE from tb_pengumuman where id_announcement =".$result['id_announcement']);
            $url = '../../pages/dashboard.php?page=announcement';
            echo '<script> window.location.replace("'. $url .'");</script>';
        }else{
            $message = "Gambar gagal dihapus";
            echo "<script type='text/javascript'>alert('$message')</script>";
            $url = '../../pages/dashboard.php?page=announcement';
            echo '<script> window.location.replace("'. $url .'");</script>';
        }
    }
?>