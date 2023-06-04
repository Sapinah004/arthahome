<?php
    include('../core/function.php');
    include('../core/config.php')
?>
<div class="font-yantramanav text-primary">
    <?php
        $sql = "SELECT tb_user.username, tb_notifikasi.*, tb_pesanan.tipe, (SELECT lokasi FROM tb_rumah JOIN tb_pesanan ON tb_rumah.id_rumah = tb_pesanan.id_rumah WHERE id_order = tb_notifikasi.id_order) as lokasi FROM tb_notifikasi JOIN tb_pesanan ON tb_notifikasi.id_order = tb_pesanan.id_order JOIN tb_user ON tb_user.id_user = tb_notifikasi.id_user WHERE tb_notifikasi.status = 0 AND tb_notifikasi.tipe_notifikasi NOT IN (3,4) ORDER BY tb_notifikasi.tanggal DESC";
        $query = mysqli_query($connect, $sql);
        $count = mysqli_num_rows($query);
    ?>
    <button id="dropdownNotificationMenu" data-dropdown-toggle="drodownNotification" class="relative inline-flex items-center px-4 py-2 bg-gray-100 text-sm font-medium text-center text-gray-900  rounded-lg hover:bg-gray-200 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50" type="button"> 
        <div class="relative">
            <i class="fa-solid fa-bell text-2xl text-primary"></i>
            <?php
                if($count > 0){
            ?>
            <span class="absolute -top-1 -right-2 w-4 h-4 text-white bg-red-600 rounded-full text-xs ">
                <?php echo $count?>
            </span>
            <?php
                }
            ?>
        </div>    
    </button>
    <div id="drodownNotification" class="hidden p-3 z-10 w-80 overflow-y-auto max-h-96 !-left-10 bg-white rounded divide-y divide-gray-100 shadow-xl dark:bg-gray-700 dark:divide-gray-600">
        <div class="justify-between flex space-x-5 items-center  mb-4">
            <div class="font-playfair text-xl font-bold tracking-widest">
                Notifikasi
            </div>
            <a href="../pages/dashboard.php?page=notification" class="text-secondary hover:underline font-semibold">
                Lihat Semua
            </a>
        </div>
        
        <div>
            <?php 
                if(mysqli_num_rows($query) > 0){
                    while($data = mysqli_fetch_array($query)){
                        if($data['tipe_notifikasi'] == 0){
            ?>
                <div class="text-sm p-2 hover:bg-slate-100 rounded-md ease-in-out duration-300">
                    <a href="../core/notifikasi.php?notifikasi=<?php echo $data['id_notifikasi']?>" class="">
                        <div>
                            <span class="capitalize"><?php echo $data['username']?> </span>baru saja membeli rumah tipe <?php echo $data['tipe']?> di lokasi <?php echo $data['lokasi']?>
                        </div>
                        <time class="text-xs text-slate-300">
                            <?php echo time_ago($data['tanggal']) ?>
                        </time>
                    </a>
                </div>
            <?php
                        }
                        elseif($data['tipe_notifikasi'] == 1){
            ?>
                <div class="text-sm p-2 hover:bg-slate-100 rounded-md ease-in-out duration-300">
                    <a href="../core/notifikasi.php?notifikasi=<?php echo $data['id_notifikasi']?>" class="">
                        <div>
                            <span class="capitalize"><?php echo $data['username']?></span> baru saja mengunggah bukti pembayaran untuk rumah tipe <?php echo $data['tipe']?> yang berlokasi di <?php echo $data['lokasi']?>
                        </div>
                        <time class="text-xs text-slate-300">
                            <?php echo time_ago($data['tanggal'])?>
                        </time>
                    </a>
                </div>
            <?php
                        }
                        elseif($data['tipe_notifikasi'] == 2){
            ?>
                <div class="text-sm p-2 hover:bg-slate-100 rounded-md ease-in-out duration-300">
                    <a href="../core/notifikasi.php?notifikasi=<?php echo $data['id_notifikasi']?>" class="">
                        <div>
                            <span class="capitalize"><?php echo $data['username']?></span> baru saja mengunggah kembali bukti pembayaran yang telah ditolak sebelumnya
                        </div>
                        <time class="text-xs text-slate-300">
                            <?php echo time_ago($data['tanggal'])?>
                        </time>
                    </a>
                </div>
            <?php
                        }
                    }
                }else{
                    echo '<div class="py-2 text-gray-400">Tidak ada notifikasi</div>';
                }
            ?>
        </div>
        <!-- <div class="pt-4 pb-1 text-right">
           
            <form >
                <a href="../core/notifikasi.php?read_all" name="read_all" type="submit" class="px-3 py-2 bg-primary hover:bg-blue-900 ease-in-out duration-300 rounded-md text-white text-xs">
                    Tandai telah dibaca
            </a>
            </form>
            
        </div> -->
    </div>
</div>