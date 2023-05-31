<?php
    include("../core/config.php");
    global $connect;

    if(isset($lokasi)){
        $lokasi = trim($_GET['lokasi']);
        $sql = "SELECT * FROM tb_rumah WHERE ";
    }
?>