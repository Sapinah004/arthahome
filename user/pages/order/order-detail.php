<?php
    include('./core/order.php');
?>
<div class="px-5 pt-36 lg:pt-52 pb-24 container mx-auto text-primary font-yantramanav">
    <?php
        $sql = "SELECT tb_pesanan.*, tb_gambar_rumah.gambar, tb_rumah.*, tb_harga_rumah.* FROM tb_pesanan JOIN tb_rumah ON tb_pesanan.id_rumah = tb_rumah.id_rumah JOIN tb_gambar_rumah ON tb_gambar_rumah.id_rumah = tb_rumah.id_rumah JOIN tb_harga_rumah ON tb_pesanan.id_rumahdetail = tb_harga_rumah.id_rumahdetail WHERE id_order =" .$_GET['order'];
        $query = mysqli_query($connect, $sql);
        $data = mysqli_fetch_array($query);
    ?>
    <div class="grid grid-cols-12 gap-2 md:gap-8 items-center">
        <picture class="col-span-12 lg:col-span-5">
            <img src="./../Admin/core/product/images/<?php echo $data['gambar']?>" alt="">
        </picture>
        <div class="col-span-12 lg:col-span-7">
            <h1 class="text-2xl font-bold text-primary font-playfair">Rumah Tipe <?php echo $data['tipe']?></h1>
            <div class="flex items-center space-x-2 mt-3 text-lg">
                <i class="fa-solid fa-location-dot text-secondary text-sm"></i>
                <span class="font-semibold capitalize"><?php echo $data['lokasi']?></span>
            </div>
            <div>
                <h2 class="font-bold mt-2 text-lg tracking-wider">Tanggal Pembelian :  <?php echo date_format(new DateTime($data['tanggal']), "d-m-Y")?></h2>
                <h2 class="font-bold mt-2 text-lg tracking-wider">Spesifikasi Rumah</h2>
                <table class="w-full">
                    <tbody class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-2 mt-2">
                        <tr class="flex justify-between">
                            <td class="font-semibold mr-3">Luas Bangunan : </td>
                            <td><?php echo $data['luas_bangunan']?> m<sup>2</sup></td>
                        </tr>
                        <tr class="flex justify-between">
                            <td class="font-semibold mr-3">Luas Tanah : </td>
                            <td><?php echo $data['luas_tanah']?> m<sup>2</sup></td>
                        </tr>
                        <tr class="flex justify-between">
                            <td class="font-semibold mr-3">Kamar Tidur </td>
                            <td><?php echo $data['kamar_tidur']?> ruang</td>
                        </tr>
                        <tr class="flex justify-between">
                            <td class="font-semibold mr-3">Kamar Mandi : </td>
                            <td><?php echo $data['kamar_mandi']?> ruang</td>
                        </tr>
                        <tr class="flex justify-between">
                            <td class="font-semibold mr-3">Jumlah lantai : </td>
                            <td><?php echo $data['jumlah_lantai']?> lantai</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="mt-4 md:mt-2 font-bold text-lg flex space-x-3 items-center">
                <span>Harga Rumah :</span>
                <span>Rp <?php echo number_format($data['harga'])?></span> 
            </div>
            <?php
                if($data['harga_pemesanan'] > 0){
                    ?>
                    <div class="mt-4 md:mt-2 font-bold text-lg flex space-x-3 items-center">
                <span>Harga Pemesanan :</span>
                <span>Rp <?php echo number_format($data['harga_pemesanan'])?></span> 
            </div>
                    <?php
                }
            ?>
            <?php
                if($data['harga_dp'] > 0){
                    ?>
                    <div class="mt-4 md:mt-2 font-bold text-lg flex space-x-3 items-center">
                <span>Harga Dp :</span>
                <span>Rp <?php echo number_format($data['harga_dp'])?></span> 
            </div>
                    <?php
                }
            ?>
             <?php
                if($data['harga_bulanan'] > 0){
                    ?>
                   <div class="mt-4 md:mt-2 font-bold text-lg flex space-x-3 items-center">
                <span>Harga Per Bulan :</span>
                <span>Rp <?php echo number_format($data['harga_bulanan'])?></span> 
            </div>
                    <?php
                }
            ?>
             <?php
                if($data['lama_bayar'] > 0){
                    ?>
                   <div class="mt-4 md:mt-2 font-bold text-lg flex space-x-3 items-center">
                <span>Lama Bayar :</span>
                <span> <?php echo number_format($data['lama_bayar'])?> Bulan</span> 
            </div>
                    <?php
                }
            ?>
             <?php
                if($data['lama_bayar'] > 1){
                    ?>
                  <div class="mt-4 md:mt-2 font-bold text-lg flex space-x-3 items-center">
                <span>Jatuh Tempo :</span>
                <span>Setiap tanggal <?php echo date_format(new DateTime($data['tanggal']), "d")?></span> 
            </div>
                    <?php
                }
            ?>
            
        </div>
    </div>
    <div class="mt-8">
        <div>
            <div class="flex flex-wrap md:justify-between gap-5 items-center">
                <?php
                    if($data['status_pembelian'] == 0){
                        echo '<div class=" text-xl font-bold tracking-wider">Status pembelian : Dalam Pembayaran</div>';
                    }else{
                        echo '<div class="text-xl font-bold tracking-wider">Status pembelian : Lunas</div>';
                    }
                ?>
                <button class="items-center md:w-auto flex md:ml-auto text-white bg-primary font-medium rounded-tr-xl rounded-bl-xl tracking-wider px-5 py-2.5 text-center ease-in-out duration-300 hover:bg-blue-900 " type="button" data-modal-toggle="medium-modal">
                    <i class="fa-solid fa-upload mr-2"></i>
                    <span>Upload Bukti Pembayaran</span> 
                </button>
            </div>
            <div id="medium-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 p-4 w-full md:inset-0 h-modal md:h-full">
                <div class="relative w-full max-w-lg h-full md:h-auto">
                    <div class="relative bg-white rounded-lg shadow">
                        <div class="flex justify-between items-center p-5 rounded-t border-b dark:border-gray-600">
                            <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                                Upload bukti pembayaran
                            </h3>
                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="medium-modal">
                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                <span class="sr-only">Close modal</span> 
                            </button>
                        </div>
                        <form method="post" enctype="multipart/form-data">
                            <div class="p-6">
                                <input type="hidden" name="id_order" value=<?php echo $data['id_order']?>>
                                <label for="gambar" class="block font-medium">Upload Gambar</label>
                                <input name="gambar" required="required" class="block w-full mt-3 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="gambar" type="file">
                            </div>
                            <div class="flex items-center justify-end p-6 space-x-2 rounded-b border-t border-gray-200 dark:border-gray-600">
                                <button data-modal-toggle="medium-modal" type="submit" name="upload" class="tracking-wider text-white bg-primary hover:bg-blue-900 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Upload</button>
                                <button data-modal-toggle="medium-modal" type="button"  class="tracking-wider text-gray-500 bg-white hover:bg-gray-100 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="overflow-x-auto w-full">
            <table class="table-auto w-full border-collapse border mt-6 bg-slate-200 border-b border-slate-100">
                <thead>
                    <tr>
                        <th class="border border-gray-300 p-4  text-left">No</th>
                        <th class="border border-gray-300 p-4  text-left">Tanggal</th>
                        <th class="border border-gray-300 p-4 text-left">Bukti Pembayaran</th>
                        <th class="border border-gray-300 p-4  text-left">Status</th>
                        <th class="border border-gray-300 p-4 text-left">Catatan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $i = 0;
                        $x = 0;
                        $sql ="SELECT * FROM tb_pembayaran WHERE id_user = '".$_SESSION['id_user']."' AND id_order = '".$_GET['order']."'  ORDER BY tanggal DESC";
                        $query = mysqli_query($connect, $sql);
                        if(mysqli_num_rows($query) > 0){
                            while($data = mysqli_fetch_array($query)){
                    ?>
                    <tr class="font-medium odd:bg-slate-50 even:bg-slate-100">
                        <td class="border border-gray-300 p-3"><?php echo ++$x?></td>
                        <td class="border border-gray-300 p-3">
                            <?php echo date_format(new DateTime($data['tanggal']), "d/m/Y")?>
                        </td>
                        <td class="border border-gray-300 p-3">
                            <div class="flex space-x-12 justify-between items-center">
                                <div>
                                    <?php echo $data['gambar']?>
                                </div>
                                <div class="flex space-x-3 items-start" <?php $a = ++$i;?>>
                                    <div>
                                        <button type="button" data-modal-toggle="defaultModal<?php echo $a?>" class="px-5 py-1.5 space-x-2 flex items-center bg-blue-600 hover:bg-blue-800 ease-in-out duration-300 text-white text-sm rounded-md">
                                            <i class="fa-regular fa-eye"></i>    
                                            <span>Lihat</span> 
                                        </button>
                                        <div id="defaultModal<?php echo $a?>" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
                                            <div class="relative w-full h-full max-h-[35rem] overflow-y-auto max-w-2xl md:h-auto">
                                                <div class="relative bg-white rounded-lg shadow">
                                                    <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                                                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                            Bukti Pembayaran
                                                        </h3>
                                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="defaultModal<?php echo $a?>">
                                                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                            <span class="sr-only">Close modal</span>
                                                        </button>
                                                    </div>
                                                    <div class="p-6 space-y-6">
                                                        <img src="./assets/images/bukti_pembayaran/<?php echo $data['gambar']?>" alt="<?php echo $data['gambar']?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                        if($data['status_pembayaran'] == 2){
                                    ?>
                                    <div>
                                        <button class="flex-none px-5 py-1.5 space-x-2 text-sm text-white bg-primary hover:bg-blue-900 ease-in-out duration-300 rounded-md" type="button" data-modal-toggle="updateImageModal<?php echo $a?>">
                                            <i class="fa-solid fa-upload"></i>    
                                            <span>Upload</span> 
                                        </button>
                                        <div id="updateImageModal<?php echo $a?>" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
                                            <div class="relative w-full h-full max-w-2xl md:h-auto">
                                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                    <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                                                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                            Upload Bukti Pembayaran
                                                        </h3>
                                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="updateImageModal<?php echo $a?>">
                                                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                            <span class="sr-only">Close modal</span>
                                                        </button>
                                                    </div>
                                                    <div class="p-6">
                                                        <form action="" method="post" enctype="multipart/form-data">
                                                            <input type="hidden" name="id_order" value=<?php echo $data['id_order']?>>
                                                            <input type="hidden" name="id_pembayaran" value=<?php echo $data['id_pembayaran']?>>
                                                            <label for="update_gambar" required="required" class="block font-medium">Upload Gambar</label>
                                                            <input name="update_gambar" class="block w-full mt-3 mb-5 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="gambar" type="file">
                                                            <div class="flex justify-end items-center py-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                                <button data-modal-toggle="updateImageModal<?php echo $a?>" type="submit" name="updateImage" class="tracking-wider text-white bg-primary hover:bg-blue-900 ease-in-out duration-300 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Upload</button>
                                                                <button data-modal-toggle="updateImageModal<?php echo $a?>" type="button" class="tracking-wider text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">Batal</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                        }
                                        elseif($data['status_pembayaran'] == 0){
                                    ?>
                                    <a onClick="return confirm('Anda yakin menghapus gambar <?php echo $data['gambar']?>')" href="./core/order.php?hapus_gambar=<?php echo $data['id_pembayaran']?>" class="px-5 py-1.5 bg-red-500 hover:bg-red-700 flex items-center space-x-2 ease-in-out duration-300 text-white text-sm rounded-md">
                                        <i class="fa-regular fa-trash-can"></i>
                                        <span>Hapus</span>
                                    </a>
                                    <?php
                                        }
                                    ?>
                                </div>
                            </div>
                        </td>
                        <?php
                            if($data['status_pembayaran'] == 0){
                                echo '<td class="border border-gray-300 p-3">Menunggu Konfirmasi</td>';
                            }elseif($data['status_pembayaran'] == 1){
                                echo '<td class="border border-gray-300 p-3">Bukti Pembayaran Diterima</td>';
                            }else{
                                echo '<td class="border border-gray-300 p-3">Bukti Pembayaran Ditolak</td>';
                            }
                        ?>
                        <td class="p-3 border border-gray-300">
                            <?php echo $data['catatan']?>
                        </td>
                    </tr>
                    <?php
                            }
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>



<!-- <script src="https://unpkg.com/flowbite@1.5.4/dist/flowbite.js"></script>  -->
<script>
//     // set the modal menu element
// const targetEl = document.getElementById('modalEl');

// // options with default values
// const options = {
//   placement: 'bottom-right',
//   backdrop: 'dynamic',
//   backdropClasses: 'bg-gray-900 bg-opacity-50 dark:bg-opacity-80 fixed inset-0 z-40',
//   onHide: () => {
//       console.log('modal is hidden');
//   },
//   onShow: () => {
//       console.log('modal is shown');
//   },
//   onToggle: () => {
//       console.log('modal has been toggled');
//   }
// };

// const modal = new Modal(targetEl, options);

// // show the modal
// modal.show();

// // hide the modal
// modal.hide();

// // toggle the modal
// modal.toggle();
// // true or false
// modal.isHidden();
if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>