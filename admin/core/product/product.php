<?php
    $direktori = $_SERVER['DOCUMENT_ROOT'].'/ArthaHome/Admin/core/config.php';
    include($direktori);
    // include("../core/config.php");
    // Tambah Product
    if(isset($_POST['addProduct'])){
        global $connect;
        $tipe = mysqli_real_escape_string($connect, $_POST["tipe"]);
        $luas_tanah = mysqli_real_escape_string($connect, $_POST["luas_tanah"]);
        $luas_bangunan = mysqli_real_escape_string($connect, $_POST["luas_bangunan"]);
        $daya_listrik = mysqli_real_escape_string($connect, $_POST["daya_listrik"]);
        $lokasi = mysqli_real_escape_string($connect, $_POST["lokasi"]);
        $deskripsi = trim(mysqli_real_escape_string($connect, $_POST["deskripsi"]));
        $kamar_mandi = mysqli_real_escape_string($connect, $_POST["kamar_mandi"]);
        $kamar_tidur = mysqli_real_escape_string($connect, $_POST["kamar_tidur"]);
        $jumlah_lantai = mysqli_real_escape_string($connect, $_POST["jumlah_lantai"]);
        $no_rumah =  $_POST["no_rumah"];
        $jumlah_norumah = sizeof($no_rumah);
        $harga =  $_POST["harga"];
        $harga_dp =  $_POST["harga_dp"];
        $harga_bulanan =  $_POST["harga_bulanan"];
        $lama_bayar =  $_POST["lama_bayar"];
        // $bunga =  $_POST["bunga"];
        $harga_pemesanan = $_POST["harga_pemesanan"];
        $jumlah_harga = sizeof($harga);
        
        $sql_addProduct = mysqli_query($connect, "INSERT INTO tb_rumah (tipe,luas_tanah,luas_bangunan,daya_listrik,lokasi,deskripsi,kamar_mandi,kamar_tidur,jumlah_lantai) VALUES ('".$tipe."','".$luas_tanah."','".$luas_bangunan."','".$daya_listrik."','".$lokasi."','".$deskripsi."','".$kamar_mandi."','".$kamar_tidur."','".$jumlah_lantai."')") ;
        if($sql_addProduct == TRUE){
            $id_rumah = $connect->insert_id;
            for($i=0; $i<$jumlah_norumah; $i++){
                $sql_addHouseNumber= mysqli_query($connect, "INSERT INTO tb_norumah (no_rumah, id_rumah) VALUES ('".$no_rumah[$i]."', '".$id_rumah."')"); 
            }
            if($sql_addHouseNumber == TRUE){
                for($i=0; $i<$jumlah_harga; $i++){
                    $sql_addPrice= mysqli_query($connect, "INSERT INTO tb_harga_rumah (id_rumah, harga,harga_dp,harga_bulanan,lama_bayar, harga_pemesanan) VALUES ('".$id_rumah."','".$harga[$i]."','".$harga_dp[$i]."','".$harga_bulanan[$i]."', '".$lama_bayar[$i]."','".$harga_pemesanan[$i]."')");
                };
                if($sql_addPrice == TRUE){
                    $limit = 10 * 1024 * 1024;
                    $ekstensi = array('png','jpg','jpeg','webp');
                    $gambar = ($_FILES["gambar"]["name"]);
                    $jumlah_gambar = count($gambar);
                    for($i=0; $i<$jumlah_gambar; $i++){
                        $gambar = $_FILES['gambar']['name'][$i];
                        $tmp = $_FILES['gambar']['tmp_name'][$i];
                        $fileType = pathinfo($gambar, PATHINFO_EXTENSION);
                        $size = $_FILES['gambar']['size'][$i];
                        if($size > $limit){
                            $message = "Size gambar terlalu besar, maksimal 10 MB";
                            echo "<script type='text/javascript'>alert('$message')</script>";
                        }
                        elseif(!in_array($fileType, $ekstensi)){
                            $message = "Ekstensi gambar tidak sesuai, gambar harus berekstensi png, jpg, jpeg, atau webp";
                            echo "<script type='text/javascript'>alert('$message')</script>";
                        }
                        else{
                            move_uploaded_file($tmp,$_SERVER['DOCUMENT_ROOT'].'/ArthaHome/Admin/core/product/images/'.date('d-m-Y').'-'.$gambar);
                            $x = date('d-m-Y').'-'.$gambar;
                            $sql_addHousePicture = mysqli_query($connect, "INSERT INTO tb_gambar_rumah (gambar , id_rumah) VALUES ('".$x."','".$id_rumah."')");
                            if($sql_addHousePicture == TRUE){
                                $message = "Produk berhasil disimpan";
                                echo "<script type='text/javascript'>alert('$message')</script>";
                                $url = '../../Admin/pages/dashboard.php?page=product_list';
                                echo '<script> window.location.replace("'. $url .'");</script>';
                            }else{
                                $message = "Produk gagal disimpan";
                                echo "<script type='text/javascript'>alert('$message')</script>";
                            }
                        }
                    }
                }
            }
        }
    }
    if(isset($_POST['tambahNoRumah'])){
        $no_rumah = ($_POST["no_rumah"]);
        $jumlah_norumah = sizeof($no_rumah);
        for($i = 0; $i<$jumlah_norumah; $i++){
            $sql_addNewHouseNumber= mysqli_query($connect, "INSERT INTO tb_norumah (no_rumah, id_rumah) VALUES ('".$no_rumah[$i]."', '".$_GET['id']."')"); 
        }
        if($sql_addNewHouseNumber == TRUE){
            $message = "No rumah berhasil disimpan";
            echo "<script type='text/javascript'>alert('$message')</script>";
        }
        else{
            $message = "No rumah gagal disimpan";
            echo "<script type='text/javascript'>alert('$message')</script>";
        }
    }
    if(isset($_POST['tambahDataHarga'])){
        global $connect;
        $harga = ($_POST['harga']);
        $harga_dp = ($_POST['harga_dp']);
        $harga_bulanan = ($_POST['harga_bulanan']);
        $lama_bayar = ($_POST['lama_bayar']);
        // $bunga = ($_POST['bunga']);
        $jumlah_harga = sizeof($harga);
        for($i = 0; $i < $jumlah_harga; $i++){
            $sql_addNewPrice = mysqli_query($connect, "INSERT INTO tb_harga_rumah (harga, harga_dp, harga_bulanan, lama_bayar,  harga_pemesanan, id_rumah) VALUES 
                ('".$harga[$i]."','".$harga_dp[$i]."','".$harga_bulanan[$i]."', '".$lama_bayar[$i]."',0,'".$_GET['id']."' )");
        }
        if($sql_addNewPrice == TRUE){
            $message = "Harga rumah berhasil disimpan";
            echo "<script type='text/javascript'>alert('$message')</script>";
        }
        else{
            $message = "Harga rumah gagal disimpan";
            echo "<script type='text/javascript'>alert('$message')</script>";
        }
    }
    if(isset($_POST['tambahGambar'])){
        $limit = 10 * 1024 * 1024;
        $ekstensi = array('png','jpg','jpeg','webp');
        $gambar = ($_FILES["gambar"]["name"]);
        $jumlah_gambar = count($gambar);
        for($i=0; $i<$jumlah_gambar; $i++){
            $gambar = $_FILES['gambar']['name'][$i];
            $tmp = $_FILES['gambar']['tmp_name'][$i];
            $fileType = pathinfo($gambar, PATHINFO_EXTENSION);
            $size = $_FILES['gambar']['size'][$i];
            if($size > $limit){
                $message = "Gambar terlalu besar, maksimal 10 MB";
                echo "<script type='text/javascript'>alert('$message')</script>";
            }
            else{
                if(!in_array($fileType, $ekstensi)){
                    $message = "Ektensi gambar tidak sesuai gambar harus beresktensi png, jpg, jpeg, atau webp";
                    echo "<script type='text/javascript'>alert('$message')</script>";
                }else{
                    move_uploaded_file($tmp,$_SERVER['DOCUMENT_ROOT'] . '/ArthaHome/Admin/core/product/images/'.date('d-m-Y').'-'.$gambar);
                    $x = date('d-m-Y').'-'.$gambar;
                    $sql_addNewHousePicture = mysqli_query($connect, "INSERT INTO tb_gambar_rumah (gambar , id_rumah) VALUES ('".$x."','".$_GET['id']."')");
                   
                }
            }
        }
        if($sql_addNewHousePicture == TRUE){
            $message = "Gambar rumah berhasil disimpan";
            echo "<script type='text/javascript'>alert('$message')</script>";
        }
        else{
            $message = "Gambar rumah gagal disimpan";
            echo "<script type='text/javascript'>alert('$message')</script>";
        }
    }
    if(isset($_POST['updateRumah'])){
        global $connect;
        $id_rumah = mysqli_real_escape_string($connect, $_POST["id_rumah"]);
        $tipe = mysqli_real_escape_string($connect, $_POST["tipe"]);
        $luas_tanah = mysqli_real_escape_string($connect, $_POST["luas_tanah"]);
        $luas_bangunan =mysqli_real_escape_string($connect, $_POST["luas_bangunan"]);
        $kamar_tidur = mysqli_real_escape_string($connect, $_POST["kamar_tidur"]);
        $kamar_mandi = mysqli_real_escape_string($connect, $_POST["kamar_mandi"]);
        $daya_listrik = mysqli_real_escape_string($connect, $_POST["daya_listrik"]);
        $lokasi = mysqli_real_escape_string($connect, $_POST["lokasi"]);
        $jumlah_lantai =mysqli_real_escape_string($connect, $_POST["jumlah_lantai"]);
        $deskripsi = trim(mysqli_real_escape_string($connect, $_POST["deskripsi"]));

        $sql_updateProduct = mysqli_query($connect, "UPDATE tb_rumah SET
            tipe = '".$tipe."',
            luas_tanah = '".$luas_tanah."',
            luas_bangunan = '".$luas_bangunan."',
            daya_listrik = '".$daya_listrik."',
            kamar_mandi = '".$kamar_mandi."',
            kamar_tidur = '".$kamar_tidur."',
            lokasi = '".$lokasi."',
            jumlah_lantai = '".$jumlah_lantai."',
            deskripsi = '".$deskripsi."'
            WHERE id_rumah = '".$id_rumah."'");
        if($sql_updateProduct == TRUE){
            $message = "Data rumah berhasil di ubah";
            echo "<script type='text/javascript'>alert('$message')</script>";
            $url = "../../Admin/pages/dashboard.php?page=product&id=$id_rumah" ;
            echo '<script>window.location.replace("'.$url.'");</script>';
        }
        else{
            $message = "Data rumah gagal di ubah";
            echo "<script type='text/javascript'>alert('$message')</script>";
        }
    }
    if(isset($_POST['updateNoRumah'])){
        global $connect;
        $no_rumah = ($_POST["no_rumah"]);
        $jumlah_norumah = sizeof($no_rumah);
        $id_rumah = $_POST["id_rumah"];
        $id_norumah = ($_POST["id_norumah"]);

        for($i=0; $i<$jumlah_norumah; $i++){
            $sql_updateHouseNumber = mysqli_query($connect, "UPDATE tb_norumah SET
                no_rumah = '".$no_rumah[$i]."'
                WHERE id_rumah = '".$id_rumah."' AND id_norumah = '".$id_norumah[$i]."'");
        }
        if($sql_updateHouseNumber == TRUE){
            $message = "No rumah berhasil diubah";
            echo "<script type='text/javascript'>alert('$message')</script>";
            $url = "../../Admin/pages/dashboard.php?page=product&id=$id_rumah" ;
            echo '<script>window.location.replace("'.$url.'");</script>';
        }
        else{
            $message = "No rumah gagal diubah";
            echo "<script type='text/javascript'>alert('$message')</script>";
        }
    }
    if(isset($_GET['hapus_norumah'])){
        global $connect;
        $sql_getHouseNumber = mysqli_query($connect, "SELECT * FROM tb_norumah WHERE id_norumah =" .$_GET['hapus_norumah']);
        $data = mysqli_fetch_assoc($sql_getHouseNumber);
        $id_rumah = $data['id_rumah'];
        if($sql_getHouseNumber == TRUE){
            $sql_deleteHouseNumber = mysqli_query($connect, "DELETE FROM tb_norumah WHERE id_norumah =" .$_GET['hapus_norumah']);
            if($sql_deleteHouseNumber == TRUE){
                $url = "../../pages/dashboard.php?page=update_norumah&id=$id_rumah";
                echo '<script>window.location.replace("'.$url.'");</script>';
            }else{
                $message = "No rumah gagal dihapus";
                echo "<script type='text/javascript'>alert('$message')</script>";
            }
        }
    }
    if(isset($_POST['updateHarga'])){
        global $connect;
        $id_rumahdetail = mysqli_real_escape_string($connect, $_POST['id_rumahdetail']);
        $harga = mysqli_real_escape_string($connect, $_POST['harga']);
        $harga_pemesanan = mysqli_real_escape_string($connect, $_POST['harga_pemesanan']);
        $harga_dp = mysqli_real_escape_string($connect, $_POST['harga_dp']);
        $harga_bulanan = mysqli_real_escape_string($connect, $_POST['harga_bulanan']);
        $lama_bayar = mysqli_real_escape_string($connect, $_POST['lama_bayar']);
        // $bunga = mysqli_real_escape_string($connect, $_POST['bunga']);
        $sql_getPrice = mysqli_query($connect, "SELECT * FROM tb_harga_rumah WHERE id_rumahdetail =" .$_GET['id']);
        $data = mysqli_fetch_assoc($sql_getPrice);
        $id_rumah = $data['id_rumah'];
        if($sql_getPrice == TRUE){
            $sql_updatePrice = mysqli_query($connect, "UPDATE tb_harga_rumah SET 
            harga = '".$harga."',
            harga_pemesanan = '".$harga_pemesanan."',
            harga_dp = '".$harga_dp."',
            harga_bulanan = '".$harga_bulanan."',
            lama_bayar = '".$lama_bayar."'
            WHERE id_rumahdetail = '".$id_rumahdetail."'");
            if($sql_updatePrice == TRUE){
                $message = "Harga rumah berhasil diubah";
                 echo "<script type='text/javascript'>alert('$message')</script>";
                $url = "../../Admin/pages/dashboard.php?page=product&id=$id_rumah" ;
                echo '<script>window.location.replace("'.$url.'");</script>';
            }
            else{
                $message = "Harga rumah gagal diubah";
                echo "<script type='text/javascript'>alert('$message')</script>";
            }
        }
    }
    if(isset($_GET['hapus_harga'])){
        $sql_getPrice = mysqli_query($connect, "SELECT * FROM tb_harga_rumah WHERE id_rumahdetail =" .$_GET['hapus_harga']);
        $data = mysqli_fetch_assoc($sql_getPrice);
        $id_rumah = $data['id_rumah'];
        if($sql_getPrice == TRUE){
            $sql_deletePrice = mysqli_query($connect, "DELETE FROM tb_harga_rumah WHERE id_rumahdetail = " .$_GET['hapus_harga']);
            if($sql_deletePrice == TRUE){
                $url = "../../pages/dashboard.php?page=product&id=$id_rumah";
                echo '<script>window.location.replace("'.$url.'");</script>';
            }else{
                $message = "Harga rumah gagal dihapus";
                echo "<script type='text/javascript'>alert('$message')</script>";
            }
        }
    }
    if(isset($_POST['updateGambar'])){
        global $connect;
        $limit = 10 * 1024 * 1024;
        $ekstensi = array('png','jpg','jpeg','webp');
        $gambar = ($_FILES["gambar"]["name"]);
        $folder = $_SERVER['DOCUMENT_ROOT'] . '/ArthaHome/Admin/core/product/images/';
        $id_gambar_rumah = trim($_POST['id_gambar_rumah']);
        $tmp = $_FILES['gambar']['tmp_name'];
        $fileType = pathinfo($gambar, PATHINFO_EXTENSION);
        $size = $_FILES['gambar']['size'];
        if($tmp!=''){
            if($size > $limit){
                $message = "Size gambar terlalu besar, maksimal 10 MB";
                echo "<script type='text/javascript'>alert('$message')</script>";
            }elseif(!in_array($fileType, $ekstensi)){
                $message = "Ekstensi gambar tidak sesuai, gambar harus berekstensi png, jpg, jpeg, atau webp";
                echo "<script type='text/javascript'>alert('$message')</script>";
            }
            else{
                $sql_getHousePicture = mysqli_query($connect, "SELECT * FROM tb_gambar_rumah WHERE id_gambar_rumah =".$_GET['id']);
                if($data = mysqli_fetch_array($sql_getHousePicture)){
                    $deleteOldImage = $data['gambar'];
                    $id_rumah = $data['id_rumah'];
                }
                unlink($folder.$deleteOldImage);
                move_uploaded_file($tmp,$_SERVER['DOCUMENT_ROOT'] . '/ArthaHome/Admin/core/product/images/'.date('d-m-Y').'-'.$gambar);
                $x = date('d-m-Y').'-'.$gambar;
                $sql_updateHousePicture = mysqli_query($connect, "UPDATE tb_gambar_rumah SET gambar = '".$x."' WHERE id_gambar_rumah = '".$id_gambar_rumah."'");
                if($sql_updateHousePicture == TRUE){
                    $message = "Gambar berhasil diubah";
                    echo "<script type='text/javascript'>alert('$message')</script>";
                    return true;
                }
                else{
                    $message = "Gambar gagal diubah";
                    echo "<script type='text/javascript'>alert('$message')</script>";
                }
            }
        }
    }
    if(isset($_GET['hapus_gambar'])){
        $sql_getHousePicture = mysqli_query($connect, "SELECT * FROM tb_gambar_rumah WHERE id_gambar_rumah =" .$_GET['hapus_gambar']);
        $data = mysqli_fetch_assoc($sql_getHousePicture);
        $id_rumah = $data['id_rumah'];
        $id_gambar_rumah = $data['id_gambar_rumah'];
        $gambar = $data['gambar'];
        $deletePath = "images/".$gambar;

        if(unlink($deletePath)){
            $sql_deleteHousePicture = mysqli_query($connect, "DELETE FROM tb_gambar_rumah WHERE id_gambar_rumah =".$id_gambar_rumah);
            if($sql_deleteHousePicture == TRUE){
                $url = "../../pages/dashboard.php?page=product&id=$id_rumah";
                echo '<script>window.location.replace("'.$url.'");</script>';
            }else{
                $message = "Gambar gagal dihapus";
                echo "<script type='text/javascript'>alert('$message')</script>";
            }
        }
    }
    if(isset($_GET['hapus_produk'])){
        $results = array();
        $sql_getProduct = mysqli_query($connect,"SELECT tb_rumah.* , tb_norumah.*, tb_harga_rumah.*, tb_gambar_rumah.* FROM tb_rumah LEFT JOIN tb_norumah ON 
                tb_rumah.id_rumah = tb_norumah.id_rumah LEFT JOIN tb_harga_rumah ON tb_rumah.id_rumah = tb_harga_rumah.id_rumah 
                LEFT JOIN tb_gambar_rumah ON tb_rumah.id_rumah = tb_gambar_rumah.id_rumah where tb_rumah.id_rumah =" .$_GET['hapus_produk']);
        if($sql_getProduct == TRUE){
            while($data = mysqli_fetch_array($sql_getProduct)){
                $gambar = $data['gambar'];
                $id = $data['id_rumah'];
                $deletePath = "images/".$gambar;
                $results[ $gambar] = @unlink($deletePath);
            }
            $sql_deleteProduct = mysqli_query($connect, "DELETE r, nr, rd ,gr FROM tb_rumah AS r LEFT JOIN tb_norumah AS nr ON r.id_rumah = nr.id_rumah LEFT JOIN tb_harga_rumah AS rd ON r.id_rumah = rd.id_rumah LEFT JOIN tb_gambar_rumah AS gr ON r.id_rumah = gr.id_rumah WHERE r.id_rumah  =".$_GET['hapus_produk']);
            if($sql_deleteProduct == TRUE){
                $message = "Produk berhasil dihapus";
                echo "<script type='text/javascript'>alert('$message')</script>";
                $url = '../../pages/dashboard.php?page=product_list';
                echo '<script> window.location.replace("'. $url .'");</script>';
            }
            else{
                $message = "Produk gagal dihapus";
                echo "<script type='text/javascript'>alert('$message')</script>";
                $url = '../../pages/dashboard.php?page=product_list';
                echo '<script> window.location.replace("'. $url .'");</script>';
            }
        }
        $message = "Produk gagal dihapus";
        echo "<script type='text/javascript'>alert('$message')</script>";
        $url = '../../pages/dashboard.php?page=product_list';
        echo '<script> window.location.replace("'. $url .'");</script>';
    }
?>