<?php
    include ('../core/artikel.php');
    include('../core/order.php')
?>
<section>
    <div class="pt-2 pb-5 font-yantramanav">
        <div class="w-full bg-white py-3 flex items-center justify-between px-5 sticky top-0">
            <div class="flex space-x-5 items-center">
                <button>
                    <a title="list produk" href="../pages/dashboard.php?page=orders" class=" px-4 py-3.5 bg-slate-300 hover:bg-slate-400 ease-in-out duration-300 rounded-md">
                        <i class="fa-solid fa-chevron-left text-lg"></i>
                    </a>
                </button>
                <h1 class="font-playfair text-3xl tracking-widest font-bold">Detail Pesanan</h1>
            </div>
            <div>
                <?php include("../pages/notifikasi.php")?>
            </div>
        </div>
        <?php
            $sql_getOrder = mysqli_query($connect, "SELECT tb_pesanan.*, tb_user.username, tb_rumah.*, tb_harga_rumah.* FROM tb_pesanan LEFT JOIN tb_rumah ON tb_pesanan.id_rumah = tb_rumah.id_rumah LEFT JOIN tb_harga_rumah ON tb_pesanan.id_rumahdetail = tb_harga_rumah.id_rumahdetail LEFT JOIN tb_user ON tb_pesanan.id_user = tb_user.id_user WHERE tb_pesanan.id_order =".$_GET['order']);
            $data = mysqli_fetch_array($sql_getOrder);
            $date = date_format(new DateTime($data['tanggal']), "Y/m/d");
        ?>
        <div class="mt-6 px-5">
            <div class=" p-5 shadow-md rounded-md border border-slate-400">
                <h3 class="mb-3 text-xl font-playfair font-semibold">Data Pembeli</h3>
                <div class="font-bold">
                    No : <?php echo $data['id_order']?>
                </div>
                <div class="font-semibold">
                    <?php echo getHari($date)?>, <?php echo date_format(new DateTime($data['tanggal']), "d/m/Y")?>
                </div>
                <div class="columns-1 lg:columns-2 space-y-6 mt-5">
                    <div class="capitalize break-inside-avoid">
                        Nama Pembeli : <?php echo $data['username']?>
                    </div>
                    <div class="capitalize break-inside-avoid">
                        Nomor KTP : <?php echo $data['no_ktp']?>
                    </div>
                    <div class="break-inside-avoid">
                        <div class="capitalize mb-3 ">
                            Nomor Telephone : <?php echo $data['telephone']?>
                        </div>
                        <div class="flex space-x-3"> 
                            <button>
                                <a class="px-4 text-sm py-2.5 text-white bg-blue-700 hover:bg-blue-900 ease-in-out duration-300 rounded-md" href="tel:<?php echo $data['telephone']?>" class="basis-1/2"> Hubungi Pembeli </a>
                            </button>
                            <button>
                                <a class="px-4 text-sm py-2.5 text-white bg-green-500 hover:bg-green-700 ease-in-out duration-300 rounded-md" href="https://api.whatsapp.com/send/?phone=<?php echo $data['telephone']?>&text=Hai+terimakasih+telah+mempercayai+arthahome+sebagai+pilihan+hunian+anda.+berikut+pembayaran+..." target="blank" class="basis-1/2"> Whatsapp Pembeli </a>
                            </button>
                        </div>
                    </div>
                    <div class="break-inside-avoid">
                        <div class="mb-3">
                            Email : <?php echo $data['email']?>
                        </div>
                        <button>
                            <a class="px-4 text-sm py-2.5 text-white bg-green-500 hover:bg-green-700 ease-in-out duration-300 rounded-md" href="mailto:<?php echo $data['email']?>" class="basis-1/2"> Hubungi Pembeli </a>
                        </button>
                    </div>
                    <div class="break-inside-avoid">
                        <div class="capitalize mb-3">
                            Jatuh Tempo Pembayaran : Setiap tanggal <?php echo date_format(new DateTime($data['tanggal']), "d")?>
                        </div>
                        <button class="">
                            <a href="https://api.whatsapp.com/send/?phone=<?php echo $data['telephone']?>&text=Hallo+<?php echo $data['username']?>,+anda+masih+memiliki+tagihan+untuk+rumah+tipe+<?php echo $data['tipe']?>+lokasi+<?php echo $data['lokasi']?>+seharga+<?php echo $data['harga_bulanan']?>+yang+akan+jatuh+tempo+pada+tanggal+<?php echo date_format(new DateTime($data['tanggal']),"d")?>+harap+segera+dibayar+sebelum+melewati+tempo+pembayaran" target="blank" class="px-4 py-2.5 text-sm bg-green-500 text-white rounded-md hover:bg-green-700 ease-in-out duration-300">Kirim Reminder</a>
                        </button>
                    </div>
                    <div class="break-inside-avoid">
                        <div class="capitalize mb-3">
                            Berkas Pembeli
                        </div>
                        <div class="flex gap-3 flex-wrap items-center">
                            <div>
                                <button type="button" data-modal-toggle="gambar_ktp" class="flex  space-x-2 items-center px-4 py-2.5 text-sm bg-green-500 hover:bg-green-700 ease-in-out duration-300 text-white rounded-md">
                                    <i class="fa-regular fa-eye"></i>
                                    <span>Lihat KTP</span>
                                </button>
                                <div id="gambar_ktp" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
                                    <div class="relative w-full h-full max-w-2xl max-h-[35rem] overflow-y-auto md:h-auto">
                                        <div class="relative pb-5 bg-white rounded-lg shadow dark:bg-gray-700">
                                            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                                                <div class="text-xl font-semibold text-gray-900 dark:text-white">
                                                    Gambar KTP
                                                </div>
                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="gambar_ktp">
                                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                            </div>
                                            <div>
                                                <img src="../../User/assets/images/ktp/<?php echo $data['gambar_ktp']?>" alt="<?php echo $data['gambar_ktp']?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <button type="button" data-modal-toggle="gambar_kk" class="flex space-x-2 items-center px-4 py-2.5 text-sm bg-green-500 hover:bg-green-700 ease-in-out duration-300 text-white rounded-md">
                                    <i class="fa-regular fa-eye"></i>
                                    <span>Lihat Kartu Keluarga</span>
                                </button>
                                <div id="gambar_kk" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
                                    <div class="relative w-full h-full max-w-2xl max-h-[35rem] overflow-y-auto md:h-auto">
                                        <div class="relative pb-5 bg-white rounded-lg shadow dark:bg-gray-700">
                                            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                                                <div class="text-xl font-semibold text-gray-900 dark:text-white">
                                                    Gambar Kartu Keluarga
                                                </div>
                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="gambar_kk">
                                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                            </div>
                                            <div>
                                                <img src="../../User/assets/images/kartu-keluarga/<?php echo $data['gambar_kk']?>" alt="<?php echo $data['gambar_kk']?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <button type="button" data-modal-toggle="surat_npwp" class="flex space-x-2 items-center px-4 py-2 text-sm bg-green-500 hover:bg-green-700 ease-in-out duration-300 text-white rounded-md">
                                    <i class="fa-regular fa-eye"></i>
                                    <span>Lihat NPWP</span>
                                </button>
                                <div id="surat_npwp" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
                                    <div class="relative w-full h-full max-w-2xl max-h-[35rem] overflow-y-auto md:h-auto">
                                        <div class="relative pb-5 bg-white rounded-lg shadow dark:bg-gray-700">
                                            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                                                <div class="text-xl font-semibold text-gray-900 dark:text-white">
                                                    Gambar Surat NPWP
                                                </div>
                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="surat_npwp">
                                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                            </div>
                                            <div>
                                                <img src="../../User/assets/images/surat-npwp/<?php echo $data['gambar_npwp']?>" alt="<?php echo $data['gambar_npwp']?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="rounded-md mt-5 shadow-md p-5 border border-slate-400">
                <h2 class="mb-3 text-xl font-playfair font-semibold">Data Rumah</h2>
                <div class="flex space-x-3">
                    <span class="basis-1/6">Tipe Rumah</span>
                    <span class="basis-4/6">: Tipe <?php echo $data['tipe']?></span>
                </div>
                <div class="flex space-x-3">
                    <span class="basis-1/6">Lokasi</span>
                    <span class="basis-4/6 capitalize">: <?php echo $data['lokasi']?></span>
                </div>
                <div class="flex space-x-3">
                    <span class="basis-1/6">No Rumah</span>
                    <span class="basis-4/6">: <?php echo $data['no_rumah']?></span>
                </div>
                <div class="flex space-x-3">
                    <span class="basis-1/6">Harga Rumah</span>
                    <span class="basis-4/6">: Rp <?php echo number_format($data['harga'])?></span>
                </div>
                <?php
                    if($data['harga_pemesanan'] > 0){
                ?>
                <div class="flex space-x-3">
                    <span class="basis-1/6">Harga Pemesanan</span>
                    <span class="basis-4/6">: Rp <?php echo number_format($data['harga_pemesanan'])?></span>
                </div>
                <?php
                    }
                ?>
                <?php
                    if($data['harga_dp'] > 0){
                ?>
                <div class="flex space-x-3">
                    <span class="basis-1/6">Harga DP</span>
                    <span class="basis-4/6">: Rp <?php echo number_format($data['harga_dp'])?></span>
                </div>
                <?php
                    }
                ?>
                <?php
                    if($data['harga_bulanan'] > 0){
                ?>
                <div class="flex space-x-3">
                    <span class="basis-1/6">Harga Bulanan</span>
                    <span class="basis-4/6">: Rp <?php echo number_format($data['harga_bulanan'])?></span>
                </div>
                <?php
                    }
                ?>
                <?php
                    if($data['lama_bayar'] > 0){
                ?>
                <div class="flex space-x-3">
                    <span class="basis-1/6">Lama Bayar </span>
                    <span class="basis-4/6">: <?php echo $data['lama_bayar']?> Bulan</span>
                </div>
                <?php
                    }
                ?>
            </div>
            <div class="mt-14">
                <div class="flex justify-between items-center space-x-3 text-xl font-semibold font-playfair">   
                    <h4 class="text-3xl">Pembayaran</h4>
                    <div class="flex space-x-3">
                        <span>Status Pembelian :</span> 
                        <div>
                            <?php
                                $jumlahPembayaran = $data['lama_bayar']+1;
                                $id_order = $_GET['order'];
                                $sql_countPayment = mysqli_query($connect, "SELECT  COUNT(status_pembayaran) as status_pembayaran FROM tb_pembayaran WHERE status_pembayaran = 1 AND id_order =" .$_GET['order']);
                                $data = mysqli_fetch_array($sql_countPayment);
                                $pembayaran = $data['status_pembayaran'];
                                if($jumlahPembayaran == $pembayaran){
                                    $sql_updateStatusOrder = mysqli_query($connect, "UPDATE tb_pesanan SET status_pembelian = 1 WHERE id_order =" .$_GET['order']);
                                    echo "Lunas";
                                 
                                }else{
                                    $sql = mysqli_query($connect, "UPDATE tb_pesanan SET status_pembelian = 0 WHERE id_order =" .$_GET['order']);
                                        echo "Dalam Pembayaran";
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="overflow-auto">
                    <table class="table-auto w-full py-3 mt-6">
                        <thead class="bg-slate-200 border-b border-slate-400">
                            <tr class="text-left">
                                <th class="px-2 py-4">No</th>
                                <th class="px-2 py-4">Tanggal</th>
                                <th class="px-2 py-4 w-40">Bukti Pembayaran</th>
                                <th class="px-2 py-4">Konfirmasi</th>
                                <th class="px-2 py-4">Catatan</th>
                                <th class="px-2 py-4">Hubungi Pembeli </th>
                            </tr>
                        </thead>
                        <tbody class="text-left">
                            <?php
                                $i = 0;
                                $x = 0;
                                $sql = "SELECT tb_pembayaran.*, tb_pesanan.telephone FROM tb_pembayaran JOIN tb_pesanan ON tb_pembayaran.id_order = tb_pesanan.id_order WHERE tb_pembayaran.id_order=".$_GET['order']." ORDER BY tanggal DESC ";
                                $query = mysqli_query($connect, $sql);
                                if(mysqli_num_rows($query) > 0){
                                    while($data = mysqli_fetch_array($query)){
                                        $date = date_format(new DateTime($data['tanggal']), "Y/m/d");
                            ?>
                            <tr class="odd:bg-slate-50 even:bg-slate-100" <?php $y = ++$x?>>
                                <td class="px-2 py-4"><?php echo ++$i?></td>
                                <td class="px-2 py-4"> 
                                    <?php echo getHari($date)?>, <?php echo date_format(new DateTime($data['tanggal']), "d/m/Y")?>
                                </td>
                                <td class="px-2 py-4" >
                                    <div class="flex max-w-sm items-center justify-between space-x-5">
                                        <div class="truncate">
                                            <?php echo $data['gambar']?>
                                        </div>
                                        <div>
                                            <button type="button" data-modal-toggle="defaultModal<?php echo $y?>" class="flex text-sm space-x-2 items-center px-4 py-1.5 bg-green-500 hover:bg-green-700 ease-in-out duration-300 text-white rounded-md !mr-6">
                                                <i class="fa-regular fa-eye"></i>
                                                <span>Lihat</span>
                                            </button>
                                            <div id="defaultModal<?php echo $y?>" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
                                                <div class="relative w-full h-full max-w-2xl max-h-[35rem] overflow-y-auto md:h-auto">
                                                    <div class="relative pb-5 bg-white rounded-lg shadow dark:bg-gray-700">
                                                        <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                                                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                                Bukti Pembayaran
                                                            </h3>
                                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="defaultModal<?php echo $y?>">
                                                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                                <span class="sr-only">Close modal</span>
                                                            </button>
                                                        </div>
                                                        <div>
                                                            <img src="../../User/assets/images/bukti_pembayaran/<?php echo $data['gambar']?>" alt="<?php echo $data['gambar']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <?php
                                    if($data['status_pembayaran'] == '0'){
                                ?>
                                <td class="text-white px-2 py-4">
                                    <div class="flex space-x-2 text-sm">
                                        <form method="POST">
                                            <input type="hidden" name="id_pembayaran" value="<?php echo $data['id_pembayaran']?>">
                                            <input type="hidden" name="id_order" value="<?php echo $data['id_order']?>">
                                            <div class="flex items-center space-x-2">
                                                <button name="terima_pembayaran" class="flex items-center space-x-1 bg-primary hover:bg-blue-900 ease-in-out duration-300 rounded-md">
                                                    <a href="../pages/dashboard.php?page=order_detail&order=<?php echo $data['id_order']?>" class="px-3 py-1.5 flex items-center space-x-1.5">
                                                        <i class="fa-solid fa-check pb-0.5"></i>
                                                        <span>Terima</span>
                                                    </a>
                                                </button>
                                                <button name="tolak_pembayaran" class="flex items-center space-x-1 bg-red-500 hover:bg-red-700 ease-in-out duration-300 rounded-md">
                                                    <a href="../pages/dashboard.php?page=order_detail&order=<?php echo $data['id_order']?>" class="px-3 py-1.5 flex items-center space-x-1.5">
                                                    <i class="fa-solid fa-xmark pb-0.5"></i>
                                                        <span>Tolak</span>
                                                    </a>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </td>
                                <?php
                                    }elseif($data['status_pembayaran'] == '1'){
                                        echo '<td class="text-sm">Pembayaran dikonfirmasi</td>';
                                    }else{
                                        echo '<td class="text-sm">Pembayaran ditolak</td>';
                                    }
                                ?>
                                <td class="px-2 py-4 text-sm">
                                    <?php
                                        if($data['catatan'] == ''){
                                    ?>
                                    <button type="button" data-modal-toggle="catatanModal<?php echo $y?>" class="px-3 py-1.5 flex items-center space-x-1.5 text-sm bg-blue-500 hover:bg-blue-700 ease-in-out duration-300 rounded-md text-white">
                                        <i class="fa-solid fa-plus"></i>
                                        <span>Tambah</span> 
                                    </button>
                                    <div id="catatanModal<?php echo $y?>" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
                                        <div class="relative w-full h-full max-w-2xl md:h-auto">
                                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                        Catatan Untuk Pembeli
                                                    </h3>
                                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="catatanModal<?php echo $y?>">
                                                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                        <span class="sr-only">Close modal</span>
                                                    </button>
                                                </div>
                                                <div class="p-6">
                                                    <form action="" method="post" class="mb-5">
                                                        <input type="hidden" name="id_order" value="<?php echo $data['id_order']?>">
                                                        <input type="hidden" name="id_pembayaran" value="<?php echo $data['id_pembayaran']?>">
                                                        <label for="catatan" class="font-bold">Catatan</label>
                                                        <textarea name="catatan" id="catatan" cols="30" rows="5" placeholder="masukkan catatan untuk pembeli" class="block w-full mt-3 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"></textarea>
                                                        <div class="flex items-center pt-5 justify-end space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                            <button data-modal-toggle="catatanModal<?php echo $y?>" type="submit" name="tambah_catatan" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Upload</button>
                                                            <button data-modal-toggle="catatanModal<?php echo $y?>" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Batal</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                        }else{
                                            echo $data['catatan'];
                                        }
                                    ?>
                                </td>
                                <td class="px-2 py-4">
                                    <?php
                                        if($data['status_pembayaran'] == 1){
                                    ?>
                                    <button>
                                        <a class="px-4 whitespace-nowrap text-sm py-2.5 text-white bg-green-500 hover:bg-green-700 ease-in-out duration-300 rounded-md" href="https://api.whatsapp.com/send/?phone=<?php echo $data['telephone']?>&text=Pelanggan+kami+yang+terhormat,+bukti+pembayaran+rumah+anda+telah+diterima,+Terimakasih" target="blank" class="basis-1/2"> Whatsapp Pembeli </a>
                                    </button>
                                    <?php
                                        }elseif($data['status_pembayaran'] == 2){
                                    ?>
                                    <button>
                                        <a class="px-4 whitespace-nowrap text-sm py-2.5 text-white bg-green-500 hover:bg-green-700 ease-in-out duration-300 rounded-md" href="https://api.whatsapp.com/send/?phone=<?php echo $data['telephone']?>&text=Pelanggan+kami+yang+terhormat,+bukti+pembayaran+rumah+anda+ditolak+karena+tidak+sesuai+dengan+ketentuan.+Harap+cek+kembali+terimakasih" target="blank" class="basis-1/2"> Whatsapp Pembeli </a>
                                    </button>
                                    <?php
                                        }else{
                                            echo '<div class="text-sm">anda belum mengkonfirmasi bukti pembayaran</div>';
                                        }
                                    ?>
                                </td>
                            </tr>
                            <?php
                                    }
                                }else{
                                    echo '<div class="mt-3 font-bold italic text-slate-500">Pembeli belum mengupload bukti pembayaran</div>';
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                
            </div>
        </div>
    </div>
</section>

