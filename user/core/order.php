<?php
    include('./core/config.php');
    if(isset($_POST['order'])){
        global $connect;
        $id_rumah = trim($_POST['id_rumah']);
        $id_rumahdetail = trim($_POST['id_rumahdetail']);
        $email = trim($_POST['email']);
        $telephone = trim($_POST['telephone']);
        $no_ktp = trim($_POST['no_ktp']);
        $tipe = trim($_POST['tipe']);
        $no_rumah = trim($_POST['no_rumah']);
        $limit = 10 * 1024 * 1024;
        $ekstensi = array('png','jpg','jpeg','webp');
        $gambar_ktp = $_FILES['gambar_ktp']['name'];
        $gambar_kk = $_FILES['gambar_kk']['name'];
        $gambar_npwp = $_FILES['gambar_npwp']['name'];
        $tmp_ktp = $_FILES['gambar_ktp']['tmp_name'];
        $tmp_kk = $_FILES['gambar_kk']['tmp_name'];
        $tmp_npwp = $_FILES['gambar_npwp']['tmp_name'];
        $fileTypeKTP = pathinfo($gambar_ktp, PATHINFO_EXTENSION);
        $fileTypeKK = pathinfo($gambar_kk, PATHINFO_EXTENSION);
        $fileTypeNPWP = pathinfo($gambar_npwp, PATHINFO_EXTENSION);
        $size_ktp = $_FILES['gambar_ktp']['size']; 
        $size_kk = $_FILES['gambar_kk']['size'];
        $size_npwp = $_FILES['gambar_npwp']['size'];
        if($size_ktp > $limit){
            $message = "Size gambar KTP terlalu besar, maksimal 10 MB";
            echo "<script type='text/javascript'>alert('$message')</script>";
        }
        elseif($size_kk > $limit){
            $message = "Size gambar Kartu Keluarga terlalu besar, maksimal 10 MB";
            echo "<script type='text/javascript'>alert('$message')</script>";
        }
        elseif(strlen($telephone) < 11 || strlen($telephone) > 12){
            $message = "Harap periksa kembali nomor telepon anda, nomor minimal 11 angka dan maksimal 12 angka";
            echo "<script type='text/javascript'>alert('$message')</script>";
        }
        elseif(strlen($no_ktp) < 16 || strlen($no_ktp) > 16){
            $message = "Harap periksa kembali nomor ktp anda";
            echo "<script type='text/javascript'>alert('$message')</script>";
        }
        elseif($size_npwp > $limit){
            $message = "Size gambar surat NPWP terlalu besar, maksimal 10 MB";
            echo "<script type='text/javascript'>alert('$message')</script>";
        }
        elseif(!in_array($fileTypeKTP, $ekstensi)){
            $message = "Ekstensi gambar ktp tidak sesuai, gambar harus berekstensi png, jpg, jpeg, atau webp";
            echo "<script type='text/javascript'>alert('$message')</script>";
        }
        elseif(!in_array($fileTypeKK, $ekstensi)){
            $message = "Ekstensi gambar kartu keluarga tidak sesuai, gambar harus berekstensi png, jpg, jpeg, atau webp";
            echo "<script type='text/javascript'>alert('$message')</script>";
        }
        elseif(!in_array($fileTypeNPWP, $ekstensi)){
            $message = "Ekstensi surat NPWP tidak sesuai, gambar harus berekstensi png, jpg, jpeg, atau webp";
            echo "<script type='text/javascript'>alert('$message')</script>";
        }
        else{
            move_uploaded_file($tmp_ktp,'./assets/images/ktp/'.date('d-m-Y').'-'.$gambar_ktp);
            $ktp_image = date('d-m-Y').'-'.$gambar_ktp;
            move_uploaded_file($tmp_kk,'./assets/images/kartu-keluarga/'.date('d-m-Y').'-'.$gambar_kk);
            $kk_image = date('d-m-Y').'-'.$gambar_kk;
            move_uploaded_file($tmp_npwp,'./assets/images/surat-npwp/'.date('d-m-Y').'-'.$gambar_npwp);
            $npwp_image = date('d-m-Y').'-'.$gambar_npwp;
            $sql = "INSERT INTO tb_pesanan (id_rumah, id_user, id_rumahdetail, tanggal, email, telephone, tipe, no_rumah, status_pembelian, gambar_ktp, gambar_kk, gambar_npwp, no_ktp)
            VALUES ('".$id_rumah."', '".$_SESSION['id_user']."', '".$id_rumahdetail."', NOW(), '".$email."', '".$telephone."', '".$tipe."',
            '".$no_rumah."', '0','".$ktp_image."','".$kk_image."','".$npwp_image."','".$no_ktp."')";
    $query = mysqli_query($connect, $sql);
    if($query == true){
        $last_id = $connect->insert_id;
        $sql = "INSERT INTO tb_notifikasi (id_order, tipe_notifikasi, id_user, status, tanggal)
        VALUES ('".$last_id."', '0','".$_SESSION['id_user']."','0', NOW())";
        $queryNotifikasi = mysqli_query($connect, $sql);
    }   
    if($queryNotifikasi == true){
        $sql = "DELETE FROM tb_norumah WHERE no_rumah ='".$no_rumah."' AND id_rumah = '".$id_rumah."'";
        $querydelete = mysqli_query($connect, $sql);
        if($querydelete == true){
            $url = "./pages/thankyou.php";
            echo '<script> window.location.replace("'. $url .'");</script>';
        }else{
            $message = "Harap periksa kembali form anda dan coba lagi";
            echo "<script type='text/javascript'>alert('$message')</script>";
        }
    }
    else{
        $message = "Harap periksa kembali form anda dan coba lagi";
        echo "<script type='text/javascript'>alert('$message')</script>";
    }
         
         
        }
        
    }
    if(isset($_POST['upload'])){
        global $connect;
        $limit = 10 * 1024 * 1024;
        $extension = array('png', 'jpg','jpeg','gif');
        $gambar = ($_FILES["gambar"]["name"]);
        $id_order = trim($_POST['id_order']);
        $size = ($_FILES["gambar"]["size"]);
        $fileType = pathinfo($gambar, PATHINFO_EXTENSION);
        $tmp = $_FILES["gambar"]["tmp_name"];

        if($size > $limit){
            $message = "Ukuran gambar terlalu besar, maksimal 10 MB";
            echo "<script type='text/javascript'>alert('$message')</script>";
        }
        elseif(!in_array($fileType, $extension)){
            $message = "Ekstensi gambar tidak diperbolehkan, gambar harus png / jpg / jpeg / gif";
            echo "<script type='text/javascript'>alert('$message')</script>";
        }
        else{
            move_uploaded_file($tmp,$_SERVER['DOCUMENT_ROOT'] . '/ArthaHome/User/assets/images/bukti_pembayaran/'.date('d-m-Y').'-'.$gambar);
            $image = date('d-m-Y').'-'.$gambar;
            $sqlInsertPembayaran = "INSERT INTO tb_pembayaran (id_order, id_user, gambar, tanggal, status_pembayaran) VALUES ('".$id_order."', '".$_SESSION['id_user']."', '".$image."', NOW(), '0')";
            $queryBayar = mysqli_query($connect, $sqlInsertPembayaran);
            if($queryBayar == TRUE){
                $sqlNotifikasi = "INSERT INTO tb_notifikasi (id_order, tipe_notifikasi, id_user, status, tanggal) VALUES 
                        ('".$id_order."','1', '".$_SESSION['id_user']."', '0', NOW())";
                $query = mysqli_query($connect, $sqlNotifikasi);
                if($query == TRUE){
                    $message = "Bukti pembayaran berhasil diupload";
                    echo "<script type='text/javascript'>alert('$message')</script>";
                }else{
                    $message = "Gagal upload bukti pembayaran, mohon coba kembali";
                    echo "<script type='text/javascript'>alert('$message')</script>";
                }
            }
            
        }
    }
    if(isset($_GET['hapus_gambar'])){
        global $connect;
        $sql = "SELECT * FROM tb_pembayaran WHERE id_pembayaran =" .$_GET['hapus_gambar'];
        $query = mysqli_query($connect, $sql);
        $data = mysqli_fetch_array($query);
        $id_pembayaran = $data['id_pembayaran'];
        $id_order = $data['id_order'];
        $gambar = $data['gambar'];
        $deletePath = $_SERVER['DOCUMENT_ROOT']. "/ArthaHome/User/assets/images/bukti_pembayaran/".$gambar;

        if(unlink($deletePath)){
            $sql = "DELETE FROM tb_pembayaran WHERE id_pembayaran = '".$id_pembayaran."'";
            $query = mysqli_query($connect, $sql);
            if($query == TRUE){
                $message = "Bukti pembayaran berhasil dihapus";
                echo "<script type='text/javascript'>alert('$message')</script>";
                $url = "./../User/pages/index.php?page=order-detail&order=$id_order";
                echo '<script>window.location.replace("'.$url.'");</script>';
            }else{
                $message = "Bukti pembayaran gagal dihapus";
                echo "<script type='text/javascript'>alert('$message')</script>";
            }
        }
    }
    if(isset($_POST['updateImage'])){
        global $connect;
        $limit = 10 * 1024 * 1024;
        $ekstensi = array('png', 'jpg', 'jpeg');
        $gambar = ($_FILES["update_gambar"]["name"]);
        $folder = $_SERVER['DOCUMENT_ROOT']. "/ArthaHome/User/assets/images/bukti_pembayaran/";
        $id_pembayaran = trim($_POST['id_pembayaran']);
        $tmp = $_FILES["update_gambar"]["tmp_name"];
        $id_order = trim($_POST['id_order']);
        $fileType = pathinfo($gambar, PATHINFO_EXTENSION);
        $size = $_FILES['update_gambar']['size'];

        if($size > $limit){
            $message = "Size gambar terlalu besar, maksimal gambar 10 MB";
            echo "<script type='text/javascript'>alert('$message')</script>";
        }
        elseif(!in_array($fileType, $ekstensi)){
            $message = "Ekstensi gambar tidak sesuai, gambar harus berekstensi png, jpg, atau jpeg";
            echo "<script type='text/javascript'>alert('$message')</script>";
        }
        else{
            $sql = "SELECT * FROM tb_pembayaran WHERE id_pembayaran = $id_pembayaran";
            $query = mysqli_query($connect, $sql);
            $data = mysqli_fetch_array($query);
            $gambarLama = $data['gambar'];

            unlink($folder.$gambarLama);
            move_uploaded_file($tmp, $_SERVER['DOCUMENT_ROOT']. "/ArthaHome/User/assets/images/bukti_pembayaran/".date('d-m-Y').'-'.$gambar);
            $x = date('d-m-Y').'-'.$gambar;
            $sql = "UPDATE tb_pembayaran SET
                    gambar = '".$x."',
                    tanggal = NOW(),
                    status_pembayaran = 0,
                    catatan = '' WHERE id_pembayaran = '".$id_pembayaran."'";
            $query = mysqli_query($connect, $sql);
            if($query == TRUE){
                $sql = "INSERT INTO tb_notifikasi (id_order, tipe_notifikasi, id_user, status, tanggal) VALUES 
                        ('".$id_order."','2', '".$_SESSION['id_user']."', '0', NOW())";
                $query = mysqli_query($connect, $sql);
                if($query == TRUE){
                    $message = "Bukti pembayaran berhasil diubah";
                    echo "<script type='text/javascript'>alert('$message')</script>";
                }else{
                    $message = "Bukti pembayaran gagal diubah";
                    echo "<script type='text/javascript'>alert('$message')</script>";
                }
            }
            
        }

    }
?>