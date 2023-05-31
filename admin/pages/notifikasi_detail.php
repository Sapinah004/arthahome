<?php
    include('../core/config.php');
    include('../core/notifikasi.php');
   ?>
<div class="p-3 font-yantramanav">
    <form method="post">
        <div class="sticky top-0 py-4 bg-white flex items-center justify-between space-x-5">
            <div class="flex space-x-5 items-center">
                <!-- <button title="kembali ke produk" onclick="history.back()" class="px-4 py-2 bg-slate-300 hover:bg-slate-400 ease-in-out duration-300 rounded-md">
                    <i class="fa-solid fa-chevron-left text-lg"></i>
                </button> -->
                <h1 class="font-playfair text-3xl tracking-wider font-bold text-primary">Notifikasi</h1>
            </div>
            <div class="flex space-x-5 items-center">
                <button type="submit" name="deleteNotifikasi" class="font-semibold tracking-wider cursor-pointer px-4 py-2 rounded-md bg-red-500 hover:bg-red-700 ease-in-out duration-300 text-white">
                    <i class="fa-solid fa-trash-can text-2xl"></i>
                </button>
                <?php include("../pages/notifikasi.php")?>
            </div>
        </div>
        <div class="overflow-y-auto px-2">
            <div class="mt-6">
                <div class="divide-y"> 
                    <?php
                    // $sql = "SELECT tb_user.username, tb_notifikasi.*, tb_pesanan.tipe, (SELECT lokasi FROM tb_rumah JOIN tb_pesanan ON tb_rumah.id_rumah = tb_pesanan.id_rumah WHERE id_order = tb_notifikasi.id_order) as lokasi FROM tb_notifikasi JOIN tb_pesanan ON tb_notifikasi.id_order = tb_pesanan.id_order JOIN tb_user ON tb_user.id_user = tb_notifikasi.id_user WHERE tb_notifikasi.status = 0 ORDER BY tb_notifikasi.time  DESC";
                        $sql_getNotification = mysqli_query($connect, "SELECT tb_user.username, tb_notifikasi.*, tb_pesanan.tipe, (SELECT lokasi FROM tb_rumah JOIN tb_pesanan ON tb_rumah.id_rumah = tb_pesanan.id_rumah WHERE id_order = tb_notifikasi.id_order) as lokasi FROM tb_notifikasi JOIN tb_pesanan ON tb_notifikasi.id_order = tb_pesanan.id_order JOIN tb_user ON tb_user.id_user = tb_notifikasi.id_user ORDER BY tb_notifikasi.tanggal  DESC");
                        if(mysqli_num_rows($sql_getNotification) > 0){
                            while($data = mysqli_fetch_array($sql_getNotification)){
                    ?>
                    <div class="py-5 px-3 flex items-center space-x-5 <?php if($data['status'] == 0){echo 'bg-slate-50';} ?>">
                        <input type="checkbox" name='id_notifikasi[]' class="w-3 h-3 text-primary focus:text-primary" value="<?php echo $data['id_notifikasi']?>">
                        <input type="hidden"  class="w-3 h-3 text-primary focus:text-primary" value="<?php echo $data['id_notifikasi']?>">
                        <div>
                            <div class="text-sm text-slate-500">
                                <?php echo date_format(new DateTime($data['tanggal']), "d-m-Y")?>, <?php echo date_format(new DateTime($data['tanggal']), "H:i") ?> WIB
                            </div>
                            <div>
                                <?php 
                                    if($data['tipe_notifikasi'] == 0){
                                ?>
                                    <div class="mt-2 flex flex-wrap space-x-3 items-center">
                                        <span class="capitalize mr-1"><?php echo $data['username']?></span>baru saja membeli rumah tipe <?php echo $data['tipe']?> yang berlokasi di <?php echo $data['lokasi']?>.
                                        <a href="../core/notifikasi.php?notifikasi=<?php echo $data['id_notifikasi']?>" class="text-sm italic hover:underline text-secondary">Klik untuk melihat</a>
                                    </div>
                                <?php
                                    }elseif ($data['tipe_notifikasi'] == 1) {
                                ?>
                                    <div class="mt-2 flex flex-wrap space-x-3 items-center">
                                        <span class="capitalize mr-1"><?php echo $data['username']?></span> baru saja mengunggah bukti pembayaran untuk rumah tipe <?php echo $data['tipe']?> yang berlokasi di <?php echo $data['lokasi']?>
                                        <a href="../core/notifikasi.php?notifikasi=<?php echo $data['id_notifikasi']?>" class="text-sm italic hover:underline text-secondary">Klik untuk melihat</a>
                                    </div>
                                <?php
                                    }
                                    else {
                                ?>
                                    <div class="mt-2 flex flex-wrap space-x-3 items-center">
                                        <span class="capitalize mr-1"><?php echo $data['username']?></span> baru saja mengunggah kembali bukti pembayaran yang telah ditolak sebelumnya
                                        <a href="../core/notifikasi.php?notifikasi=<?php echo $data['id_notifikasi']?>" class="text-sm italic hover:underline text-secondary">Klik untuk melihat</a>
                                    </div>
                                <?php
                                    }
                                ?>
                            
                            </div>
                        </div>
                    </div>
                    <?php
                            }
                        }else{
                            echo '<div class="font-bold text-xl text-slate-500">Tidak ada Notifikasi</div>';
                        }
                    ?>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- <div class="p-3 font-yantramanav">
    <form method="post">
        <div class="sticky top-0 py-4 bg-white flex items-center justify-between space-x-5">
            <div class="flex space-x-5 items-center">
            
                <h1 class="font-playfair text-3xl tracking-wider font-bold text-primary">Notifikasi</h1>
            </div>
            <div class="flex space-x-5 items-center">
                <button type="submit" name="delete" class="font-semibold tracking-wider cursor-pointer px-4 py-2 rounded-md bg-red-500 hover:bg-red-700 ease-in-out duration-300 text-white">
                    <i class="fa-solid fa-trash-can text-2xl"></i>
                </button>
                <?php include("../pages/notifikasi.php")?>
            </div>
        </div>
        <div class="overflow-y-auto px-2">
            <div class="mt-6">
                <div class="divide-y"> 
                    <?php
                        $sql_getNotification = mysqli_query($connect, "SELECT tb_user.username, tb_notifikasi.*, tb_pesanan.tipe, (SELECT lokasi FROM tb_rumah JOIN tb_pesanan ON tb_rumah.id_rumah = tb_pesanan.id_rumah WHERE id_order = tb_notifikasi.id_order) as lokasi FROM tb_notifikasi JOIN tb_pesanan ON tb_notifikasi.id_order = tb_pesanan.id_order JOIN tb_user ON tb_user.id_user = tb_notifikasi.id_user ORDER BY tb_notifikasi.tanggal  DESC");
                        if(mysqli_num_rows($sql_getNotification) > 0){
                            while($data = mysqli_fetch_array($sql_getNotification)){
                    ?>
                    <div class="py-5 px-3 flex items-center space-x-5 <?php if($data['status'] == 0){echo 'bg-slate-50';} ?>">
                        <input type="checkbox" name="id_notifikasi[]" class="w-3 h-3 text-primary focus:text-primary" value="<?php echo $data['id_notifikasi']?>">
                        <div>
                            <div class="text-sm text-slate-500">
                                <?php echo date_format(new DateTime($data['tanggal']), "d-m-Y")?>, <?php echo date_format(new DateTime($data['tanggal']), "H:i") ?> WIB
                            </div>
                            <div>
                                <?php 
                                    if($data['tipe_notifikasi'] == 0){
                                ?>
                                    <div class="mt-2 flex flex-wrap space-x-3 items-center">
                                        <span class="capitalize mr-1"><?php echo $data['username']?></span>baru saja membeli rumah tipe <?php echo $data['tipe']?> yang berlokasi di <?php echo $data['lokasi']?>.
                                        <a href="../core/notifikasi.php?notifikasi=<?php echo $data['id_notifikasi']?>" class="text-sm italic hover:underline text-secondary">Klik untuk melihat</a>
                                    </div>
                                <?php
                                    }elseif ($data['tipe_notifikasi'] == 1) {
                                ?>
                                    <div class="mt-2 flex flex-wrap space-x-3 items-center">
                                        <span class="capitalize mr-1"><?php echo $data['username']?></span> baru saja mengunggah bukti pembayaran untuk rumah tipe <?php echo $data['tipe']?> yang berlokasi di <?php echo $data['lokasi']?>
                                        <a href="../core/notifikasi.php?notifikasi=<?php echo $data['id_notifikasi']?>" class="text-sm italic hover:underline text-secondary">Klik untuk melihat</a>
                                    </div>
                                <?php
                                    }
                                    else {
                                ?>
                                    <div class="mt-2 flex flex-wrap space-x-3 items-center">
                                        <span class="capitalize mr-1"><?php echo $data['username']?></span> baru saja mengunggah kembali bukti pembayaran yang telah ditolak sebelumnya
                                        <a href="../core/notifikasi.php?notifikasi=<?php echo $data['id_notifikasi']?>" class="text-sm italic hover:underline text-secondary">Klik untuk melihat</a>
                                    </div>
                                <?php
                                    }
                                ?>
                            
                            </div>
                        </div>
                    </div>
                    <?php
                            }
                        }else{
                            echo '<div class="font-bold text-xl text-slate-500">Tidak ada Notifikasi</div>';
                        }
                    ?>
                </div>
            </div>
        </div>
    </form>
</div> -->
