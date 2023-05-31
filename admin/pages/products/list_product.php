<?php
     require '../core/product/product.php';
?>
<section>
    <div class="pt-2 pb-5 px-5">
        <div class="w-full bg-white z-50 py-3 flex items-center justify-between sticky top-0">
            <h1 class="font-playfair text-3xl tracking-widest font-bold">List Rumah</h1>
            <div>
                <?php include("../pages/notifikasi.php");?>
            </div>
        </div>
        <div class="flex w-full justify-between space-x-8 items-center mt-6">
            <button class="flex-none items-center bg-blue-500 hover:bg-blue-700 ease-in-out duration-300 flex space-x-3 text-white rounded-md ">
                <a href="./dashboard.php?page=add_product" class="px-5 py-2">
                    <i class="fa-solid fa-square-plus mr-3"></i>
                    Tambah Data
                </a>
            </button>
            <form method="post" class="flex w-full justify-end space-x-3 items-center">
                <input name="search_data" autocomplete="off" required="required" type="text" class="w-1/2 p-2 rounded-md border-2 border-primary focus:outline-none focus:border-primary focus:ring-primary block focus:ring-1">
                <button type="submit" name="search_rumah" class="px-5 flex-none py-2.5 bg-blue-500 rounded-md text-white ease-in-out duration-300 hover:bg-blue-700">
                    <i class="fa-solid fa-magnifying-glass mr-2"></i>
                    Cari
                </button>
            </form>
        </div>
        <?php
            if(isset($_POST['search_rumah'])){
                $data = mysqli_real_escape_string($connect, $_POST['search_data']);
        ?>
        <div class="mt-10 w-full h-full  block overflow-auto whitespace-nowrap">
            <table class="table-auto w-full py-3 mb-5">
                <thead class="bg-slate-200 w-full border-b border-slate-400">
                    <tr class="text-left">
                        <th class="px-2 py-4">No</th>
                        <th class="px-2 py-4">Type</th>
                        <th class="px-2 py-4">Lokasi</th>
                        <th class="px-2 py-4">L.Tanah</th>
                        <th class="px-2 py-4">L. Rumah</th>
                        <th class="px-2 py-4">Lantai</th>
                        <th class="px-2 py-4">Harga</th>
                        <th class="px-2 py-4">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-left">
                    <?php
                        $i = 0;
                        $sql_getProduct = mysqli_query($connect, "SELECT tb_rumah.id_rumah, tb_rumah.tipe, tb_rumah.lokasi, tb_rumah.luas_tanah, tb_rumah.luas_bangunan, tb_rumah.kamar_tidur, tb_rumah.kamar_mandi, tb_rumah.daya_listrik, tb_rumah.jumlah_lantai, MIN(tb_harga_rumah.harga) as harga from tb_rumah LEFT JOIN tb_harga_rumah on tb_rumah.id_rumah = tb_harga_rumah.id_rumah where tb_rumah.lokasi LIKE '%$data%' or  tb_rumah.tipe  LIKE '%$data%' or tb_rumah.lokasi  LIKE '%$data%' or tb_rumah.luas_tanah  LIKE '%$data%' or tb_rumah.luas_bangunan  LIKE '%$data%' or tb_rumah.kamar_tidur  LIKE '%$data%' or tb_rumah.kamar_mandi  LIKE '%$data%' or tb_rumah.daya_listrik  LIKE '%$data%' or tb_rumah.jumlah_lantai  LIKE '%$data%'  or harga  LIKE '%$data%'  GROUP BY id_rumah;");
                        if(mysqli_num_rows($sql_getProduct) < 0){
                            echo '<div class="font-bold text-center italic mb-5 text-slate-500">Tidak ada data produk</div>';
                        }
                        elseif(mysqli_num_rows($sql_getProduct) > 0){
                            while($data = mysqli_fetch_array($sql_getProduct)){
                                $id = $data['id_rumah'];
                                $tipe = $data['tipe'];
                                $lokasi = $data['lokasi'];
                                $luas_tanah = $data['luas_tanah'];
                                $luas_bangunan = $data['luas_bangunan'];
                                $jumlah_lantai = $data['jumlah_lantai'];
                                $harga = $data['harga'];
                    ?>
                    <tr class="odd:bg-slate-50 even:bg-slate-100">
                        <td class="px-2 py-4"><?php echo ++$i?></td>
                        <td class="px-2 py-4">Type <?php echo $tipe;?></td>
                        <td class="px-2 py-4 capitalize"><?php echo $lokasi;?></td>
                        <td class="px-2 py-4"><?php echo $luas_tanah;?> m<sup>2</sup></td>
                        <td class="px-2 py-4"><?php echo $luas_bangunan;?> m<sup>2</sup></td>
                        <td class="px-2 py-4"><?php echo $jumlah_lantai;?> lantai</td>
                        <td class="px-2 py-4">Rp. <?php echo number_format($harga);?></td>
                        <td class="flex space-x-3 text-sm text-white px-2 py-4">
                            <button class=" bg-green-500 hover:bg-green-700 ease-in-out duration-300 rounded-md">
                                <a href="../pages/dashboard.php?page=product&id=<?php echo $id?>" class="px-5 py-1.5 flex items-center space-x-2">
                                    <i class="fa-regular fa-eye"></i>
                                    <span>Lihat</span>
                                </a>
                            </button>
                            <a onClick="return confirm('Anda yakin ingin menghapus data tersebut?')" href="../core/product/product.php?hapus_produk=<?php echo $id; ?>" 
                                class="flex items-center space-x-2 px-5 py-1.5 bg-red-600 hover:bg-red-700 ease-in-out duration-300 rounded-md">
                                <i class="fa-regular fa-trash-can"></i>
                                <span>Hapus</span>
                            </a>
                        </td>
                    </tr>
                    <?php
                            }
                        }else{
                            echo '<div class="font-bold text-center italic mb-5 text-slate-500">Tidak ada data produk</div>';
                        }
                    ?>
                </tbody>
            </table>
        </div>
        <?php
            }else{
        ?>
        <div class="mt-10 w-full h-full  block overflow-auto whitespace-nowrap">
            <table class="table-auto w-full py-3 mb-5">
                <thead class="bg-slate-200 w-full border-b border-slate-400">
                    <tr class="text-left">
                        <th class="px-2 py-4">No</th>
                        <th class="px-2 py-4">Type</th>
                        <th class="px-2 py-4">Lokasi</th>
                        <th class="px-2 py-4">L.Tanah</th>
                        <th class="px-2 py-4">L. Rumah</th>
                        <th class="px-2 py-4">Lantai</th>
                        <th class="px-2 py-4">Harga</th>
                        <th class="px-2 py-4">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-left">
                    <?php
                        $i = 0;
                        $sql_getProduct = mysqli_query($connect, "SELECT tb_rumah.id_rumah, tb_rumah.tipe, tb_rumah.lokasi, tb_rumah.luas_tanah, tb_rumah.luas_bangunan, tb_rumah.kamar_tidur, tb_rumah.kamar_mandi, tb_rumah.daya_listrik, tb_rumah.jumlah_lantai, MIN(tb_harga_rumah.harga) as harga from tb_rumah LEFT JOIN tb_harga_rumah on tb_rumah.id_rumah = tb_harga_rumah.id_rumah GROUP BY id_rumah;");
                        if(mysqli_num_rows($sql_getProduct) < 0){
                            echo '<div class="font-bold text-center italic mb-5 text-slate-500">Tidak ada data produk</div>';
                        }
                        elseif(mysqli_num_rows($sql_getProduct) > 0){
                            while($data = mysqli_fetch_array($sql_getProduct)){
                                $id = $data['id_rumah'];
                                $tipe = $data['tipe'];
                                $lokasi = $data['lokasi'];
                                $luas_tanah = $data['luas_tanah'];
                                $luas_bangunan = $data['luas_bangunan'];
                                $jumlah_lantai = $data['jumlah_lantai'];
                                $harga = $data['harga'];
                    ?>
                    <tr class="odd:bg-slate-50 even:bg-slate-100">
                        <td class="px-2 py-4"><?php echo ++$i?></td>
                        <td class="px-2 py-4">Type <?php echo $tipe;?></td>
                        <td class="px-2 py-4 capitalize"><?php echo $lokasi;?></td>
                        <td class="px-2 py-4"><?php echo $luas_tanah;?> m<sup>2</sup></td>
                        <td class="px-2 py-4"><?php echo $luas_bangunan;?> m<sup>2</sup></td>
                        <td class="px-2 py-4"><?php echo $jumlah_lantai;?> lantai</td>
                        <td class="px-2 py-4">Rp. <?php echo number_format($harga);?></td>
                        <td class="flex space-x-3 text-sm text-white px-2 py-4">
                        <button class=" bg-green-500 hover:bg-green-700 ease-in-out duration-300 rounded-md">
                            <a href="../pages/dashboard.php?page=product&id=<?php echo $id?>" class="px-5 py-1.5 flex items-center space-x-2">
                                <i class="fa-regular fa-eye"></i>
                                <span>Lihat</span>
                            </a>
                        </button>
                        <a onClick="return confirm('Anda yakin ingin menghapus data tersebut?')" href="../core/product/product.php?hapus_produk=<?php echo $id; ?>" 
                            class="flex items-center space-x-2 px-5 py-1.5 bg-red-600 hover:bg-red-700 ease-in-out duration-300 rounded-md">
                            <i class="fa-regular fa-trash-can"></i>
                            <span>Hapus</span>
                        </a>
                    </td>
                </tr>
                <?php
                            }
                        }
                ?>
                </tbody>
            </table>
        </div> 
        <?php
                }
        ?>
    </div>
</section>