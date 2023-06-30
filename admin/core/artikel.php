<?php
    include("../core/config.php");
    function getHari($date){
        setlocale(LC_ALL, 'id-ID');
        return strftime("%A", strtotime($date));
    }
    if(isset($_POST['buat_artikel'])){
        global $connect;
        $judul = trim(mysqli_real_escape_string($connect, $_POST["judul"]));
        $limit = 5 * 1024 * 1024;
        $ekstensi = array('png','jpg','jpeg','webp');
        $gambar = ($_FILES["gambar"]["name"]);
        $tmp = $_FILES['gambar']['tmp_name'];
        $fileType = pathinfo($gambar, PATHINFO_EXTENSION);
        $size = $_FILES['gambar']['size'];
        $artikel = trim($_POST['artikel']);
        if($size > $limit){
            $message = "Gambar terlalu besar, maksimal 5 MB";
            echo "<script type='text/javascript'>alert('$message')</script>";
        }
        elseif(!in_array($fileType, $ekstensi)){
            $message = "Ektensi gambar tidak sesuai, gambar harus berekstensi png, jpg, jpeg, atau webp";
            echo "<script type='text/javascript'>alert('$message')</script>";
        }else{
            move_uploaded_file($tmp,$_SERVER['DOCUMENT_ROOT'] . '/ArthaHome/Admin/assets/images/article/'.date('d-m-Y').'-'.$gambar);
            $x = date('d-m-Y').'-'.$gambar;
            $sql_addArticle = mysqli_query($connect, "INSERT INTO tb_artikel (tanggal , judul, gambar, artikel) VALUES (NOW(), '".$judul."', '".$x."', '".$artikel."')");
            if($sql_addArticle == TRUE){
                $message = "Artikel berhasil diunggah";
                echo "<script type='text/javascript'>alert('$message')</script>";
                $url = '../pages/dashboard.php?page=artikel-list';
                echo '<script> window.location.replace("'. $url .'");</script>';
            }
            else{
                $message = "Artikel gagal diunggah";
                echo "<script type='text/javascript'>alert('$message')</script>";
            }
        }
    }
    if(isset($_POST['update_judul'])){
        $id_artikel = trim($_POST['id_artikel']);
        $judul = trim(mysqli_real_escape_string($connect, $_POST['judul']));
        $sql_updateTitle = mysqli_query($connect, "UPDATE tb_artikel SET judul = '".$judul."', waktu = NOW() WHERE id_artikel = $id_artikel");
        if($sql_updateTitle == TRUE){
            $message = "Judul artikel berhasil diubah";
            echo "<script type='text/javascript'>alert('$message')</script>";
            $url = "../pages/dashboard.php?page=artikel&id=$id_artikel";
            echo '<script> window.location.replace("'. $url .'");</script>';
        }
        else{
            $message = "Judul artikel gagal diubah";
            echo "<script type='text/javascript'>alert('$message')</script>";
        }
    }
    if(isset($_POST['update_gambar'])){
        $id_artikel = trim($_POST['id_artikel']);
        $limit = 5 * 1024 * 1024;
        $ekstensi = array('png','jpg','jpeg','webp');
        $gambar = ($_FILES["gambar"]["name"]);
        $tmp = $_FILES['gambar']['tmp_name'];
        $folder = $_SERVER['DOCUMENT_ROOT'] . '/ArthaHome/Admin/assets/images/article/';
        $fileType = pathinfo($gambar, PATHINFO_EXTENSION);
        $size = $_FILES['gambar']['size'];

        if($size > $limit){
            $message = "Gambar terlalu besar, ukuran gambar maksimal 5 MB";
            echo "<script type='text/javascript'>alert('$message')</script>";
        }
        elseif(!in_array($fileType, $ekstensi)){
            $message = "Ektensi gambar tidak sesuai, gambar harus berekstensi png, jpg, jpeg, atau webp";
            echo "<script type='text/javascript'>alert('$message')</script>";
        }else{
            $sql_getArticle = mysqli_query($connect, "SELECT * FROM tb_artikel WHERE id_artikel = $id_artikel") ;
            $data = mysqli_fetch_array($sql_getArticle);
            $oldImage = $data["gambar"];

            unlink($folder.$oldImage);
            move_uploaded_file($tmp,$folder.date('d-m-Y').'-'.$gambar);
            $x = date('d-m-Y').'-'.$gambar;
            $sql_updatePicture = mysqli_query($connect, "UPDATE tb_artikel SET gambar = '".$x."', waktu = NOW() WHERE id_artikel = $id_artikel");
            if($sql_updatePicture == TRUE){
                $message = "Gambar artikel berhasil diunggah";
                echo "<script type='text/javascript'>alert('$message')</script>";
            }
            else{
                $message = "Gambar artikel gagal diunggah";
                echo "<script type='text/javascript'>alert('$message')</script>";
            }
        }
    }
    if(isset($_POST['update_artikel'])){
        $judul = trim($_POST['judul']);
        $artikel = trim($_POST['artikel']);
        $id_artikel = trim($_POST['id_artikel']);
        $limit = 5 * 1024 * 1024;
        $ekstensi = array('png','jpg','jpeg','webp');
        $gambar = ($_FILES["gambar"]["name"]);
        $tmp = $_FILES['gambar']['tmp_name'];
        $folder = $_SERVER['DOCUMENT_ROOT'] . '/ArthaHome/Admin/assets/images/article/';
        $fileType = pathinfo($gambar, PATHINFO_EXTENSION);
        $size = $_FILES['gambar']['size'];
        if(empty($gambar)){
            $sql_updateArticle = mysqli_query($connect, "UPDATE tb_artikel SET
            judul = '".$judul."',
            tanggal = NOW(),
            artikel = '".$artikel."'
            WHERE id_artikel = '".$id_artikel."'");
            if($sql_updateArticle == TRUE){
                $message = "Artikel berhasil diunggah";
                echo "<script type='text/javascript'>alert('$message')</script>";
                // $url = '../pages/dashboard.php?page=artikel-list';
                // echo '<script> window.location.replace("'. $url .'");</script>';
            }
            else{
                $message = "Artikel gagal diunggah";
                echo "<script type='text/javascript'>alert('$message')</script>";
            }
        }
        if(!empty($gambar)){
            if($size > $limit){
                $message = "Gambar terlalu besar, ukuran gambar maksimal 5 MB";
                echo "<script type='text/javascript'>alert('$message')</script>";
            }
            elseif(!in_array($fileType, $ekstensi)){
                $message = "Ektensi gambar tidak sesuai, gambar harus berekstensi png, jpg, jpeg, atau webp";
                echo "<script type='text/javascript'>alert('$message')</script>";
            }else{
                $sql_getArticle = mysqli_query($connect, "SELECT * FROM tb_artikel WHERE id_artikel = $id_artikel") ;
                $data = mysqli_fetch_array($sql_getArticle);
                $oldImage = $data["gambar"];
    
                unlink($folder.$oldImage);
                move_uploaded_file($tmp,$folder.date('d-m-Y').'-'.$gambar);
                $x = date('d-m-Y').'-'.$gambar;
                $sql_updatePicture = mysqli_query($connect, "UPDATE tb_artikel SET
                gambar = '".$x."',
                judul = '".$judul."',
                tanggal = NOW(),
                artikel = '".$artikel."'
                WHERE id_artikel = '".$id_artikel."'");
                if($sql_updatePicture == TRUE){
                    $message = "Gambar artikel berhasil diunggah";
                    echo "<script type='text/javascript'>alert('$message')</script>";
                }
                else{
                    $message = "Gambar artikel gagal diunggah";
                    echo "<script type='text/javascript'>alert('$message')</script>";
                }
            }
        }
    }
    if(isset($_POST['tambahParagraf'])){
        $id_artikel = trim($_POST['id_artikel']);
        $artikel = $_POST['artikel'];
        $jumlah_baris = sizeof($artikel);
        for($i = 0; $i<$jumlah_baris; $i++){
            $sql_addNewParagraf = mysqli_query($connect, "INSERT INTO tb_artikel_detail (artikel, id_artikel) VALUES ('".$artikel[$i]."', '".$id_artikel."')");
        }
        if($sql_addNewParagraf == TRUE){
            $message = "Paragraf baru berhasil ditambah";
            echo "<script type='text/javascript'>alert('$message')</script>";
        }
        else{
            $message = "Paragraf baru gagal ditambah";
            echo "<script type='text/javascript'>alert('$message')</script>";
        }
    }
    if(isset($_GET['id_artikel'])){
        $results = array();
        $sql_getArticle = mysqli_query($connect, "SELECT * FROM tb_artikel WHERE id_artikel=" .$_GET['id_artikel']);
        if($sql_getArticle == TRUE){
            while($data = mysqli_fetch_array($sql_getArticle)){
                $gambar = $data['gambar'];
                $id_artikel = $data['id_artikel'];
                $deletePath = "../assets/images/article/".$gambar;
                $results[ $gambar] = @unlink($deletePath);
            }
            $sql_deleteArticle = mysqli_query($connect, "DELETE FROM tb_artikel WHERE id_artikel  =".$_GET['id_artikel']);
            if($sql_deleteArticle == TRUE){
                $message = "artikel berhasil dihapus";
                echo "<script type='text/javascript'>alert('$message')</script>";
                $url = '../pages/dashboard.php?page=artikel-list';
                echo '<script> window.location.replace("'. $url .'");</script>';
            }
            else{
                $message = "artikel gagal dihapus";
                echo "<script type='text/javascript'>alert('$message')</script>";
            }
        }
    }
?>