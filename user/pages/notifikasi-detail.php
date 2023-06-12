<?php
    include('./core/config.php');
    include('./core/notifikasi.php');
?>
<div class="container mx-auto px-5 pt-32 lg:pt-52 pb-12">
    <h1 class="font-playfair text-4xl lg:text-5xl font-bold tracking-wider text-center">Notifikasi</h1>
    <?php
         $sql = mysqli_query($connect,"SELECT tb_user.*, tb_pesanan.*, tb_notifikasi.*, (SELECT lokasi FROM tb_rumah JOIN tb_pesanan ON tb_rumah.id_rumah = tb_pesanan.id_rumah WHERE tb_pesanan.id_order = tb_notifikasi.id_order) as lokasi FROM tb_notifikasi JOIN tb_pesanan ON tb_notifikasi.id_order = tb_pesanan.id_order JOIN tb_user ON tb_pesanan.id_user = tb_user.id_user WHERE tb_notifikasi.tipe_notifikasi NOT IN (0,1,2) AND tb_user.id_user = ".$_SESSION['id_user']." ORDER BY tb_notifikasi.tanggal DESC");
         $count = mysqli_num_rows($sql);
    ?>
    <div class="text-center mt-2">Anda memiliki <?php echo $count?> notifikasi </div>
    <form  method="post">
        <button type="submit" name="deleteNotifikasi" class="my-8 px-5 py-2 bg-red-500 hover:bg-red-600 ease-in-out duration-300 text-white rounded-md">
            Hapus Notifikasi
        </button>
        <?php
            if($count > 0){
                while($data = mysqli_fetch_array($sql)){
        ?>
        <div class="py-5 px-3 flex items-center space-x-5 <?php if($data['status'] == 0){echo 'bg-slate-50';} ?>">
            <input type="checkbox" name='id_notifikasi[]' class="w-3 h-3 text-primary focus:text-primary" value="<?php echo $data['id_notifikasi']?>">
            <input type="hidden" class="w-3 h-3 text-primary focus:text-primary" value="<?php echo $data['id_notifikasi']?>">
            <div>
                <div class="text-sm text-slate-500">
                    <?php echo date_format(new DateTime($data['tanggal']), "d-m-Y")?>, <?php echo date_format(new DateTime($data['tanggal']), "H:i") ?> WIB
                </div>
                <div>
                    <?php 
                        if($data['tipe_notifikasi'] == 3){
                    ?>
                    <div class="mt-2 flex flex-wrap space-x-3 items-center">
                        <div class="capitalize mr-1">
                            Artha Home telah menerima bukti pembayaran yang telah anda unggah untuk rumah tipe <?php echo $data['tipe']?> lokasi <?php echo $data['lokasi']?>
                        </div>
                        <a href="./core/notifikasi.php?notifikasi=<?php echo $data['id_notifikasi']?>" class="text-sm italic hover:underline text-secondary">Klik untuk melihat</a>
                    </div>
                    <?php
                        }elseif ($data['tipe_notifikasi'] == 4) {
                    ?>
                    <div class="mt-2 flex flex-wrap space-x-3 items-center">
                        <div class="capitalize mr-1">
                            Artha Home menolak bukti pembayaran yang telah anda unggah untuk rumah tipe <?php echo $data['tipe']?> lokasi <?php echo $data['lokasi']?>. Harap cek kembali bukti pembayaran anda
                        </div>
                        <a href="./core/notifikasi.php?notifikasi=<?php echo $data['id_notifikasi']?>" class="text-sm italic hover:underline text-secondary">Klik untuk melihat</a>
                    </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>
        <?php
                }
            }
        ?>
    </form>
</div>
<script>
    // function agar tidak resubmission ketika refresh browser
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>