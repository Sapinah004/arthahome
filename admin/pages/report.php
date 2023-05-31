<div class="pt-2 pb-5 px-5 print:px-0">
    <div class="w-full bg-white py-3 flex items-center justify-between sticky top-0">
        <h1 class="font-playfair text-3xl tracking-widest font-bold">Laporan Penjualan</h1>
        <div>
            <?php include("../pages/notifikasi.php");?>
        </div>
    </div>
    <div class="mt-5 w-full h-full  block overflow-auto font-yantramanav whitespace-nowrap">
        <div class="flex space-x-3 items-center text-lg font-bold">
            <div>
                Filter Laporan Berdasarkan :
            </div>
            <select class="w-48 p-2 border-2 border-gray-600 rounded-md font-medium"  onchange="location = this.value;">
                <option value="">Pilih Filter</option>    
                <option value="./dashboard.php?page=report">Terbaru</option>
                <option value="./dashboard.php?page=report-month">Bulan</option>
                <option value="./dashboard.php?page=report-year">Tahun</option>
            </select>
        </div>
    <div>
    <button>
        <a href="../core/report-pdf.php" target="_blank" class="flex space-x-3 mt-7 items-center justify-end text-white rounded-md px-5 py-2 bg-green-500 hover:bg-green-600 ease-in-out duration-300">
            <i class="fa-solid fa-download"></i>    
            <span>Download</span> 
        </a>    
    </button>
    <table class="table-auto w-full py-3 my-5">
        <thead class="bg-slate-200 border-b border-slate-400">
            <tr class="text-left">
                <th class="px-2 py-4 w-20">No</th>
                <th class="px-2 py-4 w-32">Tanggal</th>
                <th class="px-2 py-4 w-32">Pembeli</th>
                <th class="px-2 py-4 w-32">Telephone</th>
                <th class="px-2 py-4 w-32">Tipe Rumah</th>
                <th class="px-2 py-4 w-32">Lokasi</th>
                <th class="px-2 py-4 w-32">No Rumah</th>
                <th class="px-2 py-4 w-32">Harga</th>
            </tr>
        </thead>
        <tbody class="text-left">
        <?php
            $i = 0;
            $sql = "SELECT tb_user.username, tb_pesanan.id_order, tb_pesanan.telephone, tb_pesanan.tipe, tb_pesanan.tanggal, tb_rumah.lokasi, tb_pesanan.no_rumah, tb_harga_rumah.harga FROM tb_pesanan JOIN tb_user ON tb_pesanan.id_user = tb_user.id_user JOIN tb_rumah ON tb_pesanan.id_rumah = tb_rumah.id_rumah JOIN tb_harga_rumah ON tb_pesanan.id_rumahdetail = tb_harga_rumah.id_rumahdetail WHERE status_pembelian = 1 ORDER BY tb_pesanan.tanggal DESC";
            $query= mysqli_query($connect, $sql);
            if(mysqli_num_rows($query) == 0){
                echo '<div class="font-bold mt-5">Tidak ada data penjualan bulan ini</div>';
            }
            elseif(mysqli_num_rows($query) > 0){
                while($data = mysqli_fetch_array($query)){
        ?>
            <tr class="odd:bg-slate-50 even:bg-slate-100">
                <td class="px-2 py-4 w-20 "><?php echo ++$i?></td>
                <td class="px-2 py-4 w-32"><?php echo date_format(new DateTime($data['tanggal']), "d/m/Y")?></td>
                <td class="px-2 py-4 w-32 capitalize"><?php echo $data['username']?></td>
                <td class="px-2 py-4 w-32"><?php echo $data['telephone']?></td>
                <td class="px-2 py-4 w-32">Type <?php echo $data['tipe'] ?></td>
                <td class="px-2 py-4 w-32 capitalize"><?php echo $data['lokasi']?> </td>
                <td class="px-2 py-4 w-32"><?php echo $data['no_rumah']?></td>
                <td class="px-2 py-4 w-32">Rp <?php echo number_format($data['harga']) ?></td>
            </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>
</div>
     