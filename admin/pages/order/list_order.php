<?php
     include("../core/artikel.php");
?>
<div class="pt-2 pb-5 px-5">
    <div class="w-full bg-white py-3 flex items-center justify-between sticky top-0">
        <h1 class="font-playfair text-3xl tracking-widest font-bold">Pesanan</h1>
        <div>
            <?php include("../pages/notifikasi.php");?>
        </div>
    </div>
    <div class="mt-5 w-full h-full  block overflow-auto whitespace-nowrap">
        <table class="table-auto w-full py-3 mb-5">
            <thead class="bg-slate-200 border-b border-slate-400">
                <tr class="text-left">
                    <th class="px-2 py-4">No</th>
                    <th class="px-2 py-4">Tanggal</th>
                    <th class="px-2 py-4">Pembeli</th>
                    <th class="px-2 py-4">Telephone</th>
                    <th class="px-2 py-4">Tipe Rumah</th>
                    <th class="px-2 py-4">Lokasi</th>
                    <th class="px-2 py-4">Harga</th>
                    <th class="px-2 py-4">Status Pembayaran</th>
                    <th class="px-2 py-4">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-left">
                <?php
                    $i = 0;
                    $sql_getOrder = mysqli_query($connect, "SELECT tb_user.username, tb_pesanan.id_order, tb_pesanan.telephone, tb_pesanan.tipe, tb_pesanan.tanggal, tb_rumah.lokasi, tb_pesanan.no_rumah, tb_harga_rumah.harga, tb_pesanan.status_pembelian FROM tb_pesanan JOIN tb_user ON tb_pesanan.id_user = tb_user.id_user JOIN tb_rumah ON tb_pesanan.id_rumah = tb_rumah.id_rumah JOIN tb_harga_rumah ON tb_pesanan.id_rumahdetail = tb_harga_rumah.id_rumahdetail ORDER BY tb_pesanan.tanggal DESC");
                    if(mysqli_num_rows($sql_getOrder) < 1){
                        echo '<div class="font-bold mb-5 italic text-slate-500">Tidak ada pesanan</div>';
                    }
                    elseif(mysqli_num_rows($sql_getOrder) > 0){
                        while($data = mysqli_fetch_array($sql_getOrder)){
                            $date = date_format(new DateTime($data['tanggal']), "Y/m/d");
                ?>
                <tr class="odd:bg-slate-50 even:bg-slate-100">
                    <td class="px-2 py-4 "><?php echo ++$i?></td>
                    <td class="px-2 py-4"><?php echo getHari($date)?>, <?php echo date_format(new DateTime($data['tanggal']), "d/m/Y")?></td>
                    <td class="px-2 py-4 capitalize"><?php echo $data['username']?></td>
                    <td class="px-2 py-4"><?php echo $data['telephone']?></td>
                    <td class="px-2 py-4">Type <?php echo $data['tipe'] ?></td>
                    <td class="px-2 py-4 capitalize"><?php echo $data['lokasi']?> </td>
                    <td class="px-2 py-4">Rp <?php echo number_format($data['harga']) ?></td>
                    <td class="px-2 py-4"><?php if($data['status_pembelian'] == 0){
                        echo "Dalam Pembayaran";
                    }else{
                        echo "Lunas";
                    }?>
                    </td>
                    <td class="text-white px-2 py-4">
                        <button class="text-sm flex items-center space-x-1 bg-green-500 hover:bg-green-700 ease-in-out duration-300 rounded-md">
                            <a href="../pages/dashboard.php?page=order_detail&order=<?php echo $data['id_order']?>" class="px-5 py-1.5">
                                <i class="fa-regular fa-eye"></i>
                                 <span>View</span>
                            </a>
                        </button>
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