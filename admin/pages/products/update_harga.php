<?php
    require '../core/config.php';
    require '../core/product/product.php';
?>
<div class="p-5">
    <div class="py-4 bg-white flex space-x-5 items-center justify-between">
        <div class="flex space-x-5 items-center">
            <?php
                $sql = mysqli_query($connect, "SELECT * FROM tb_harga_rumah WHERE id_rumahdetail=".$_GET['id']); ;
                $data = mysqli_fetch_array($sql);
            ?>
            <a title="kembali ke produk" href="../pages/dashboard.php?page=product&id=<?php echo $data['id_rumah']?>"  
                class=" px-4 py-2 bg-slate-300 hover:bg-slate-400 ease-in-out duration-300 rounded-md">
                <i class="fa-solid fa-chevron-left text-lg"></i>
            </a>
            <h1 class="font-playfair text-3xl font-bold text-primary">Update Data Harga Rumah</h1>
        </div>
        <div>
            <?php include('../pages/notifikasi.php')?>
        </div>
    </div>
    <form class="mt-6" method="post">
        <?php
            $sql = "SELECT * FROM tb_harga_rumah WHERE id_rumahdetail =" .$_GET["id"];
            $query = mysqli_query($connect, $sql);
            $data = mysqli_fetch_assoc($query);
        ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-7">
            <input type="hidden" name="id_rumahdetail" value="<?php echo $data["id_rumahdetail"]?>">
            <div>
                <label for="harga" class="font-bold">Harga</label>
                <input id="harga" type="text" autocomplete="off" name="harga" class="mt-2 w-full bg-slate-200 rounded-sm p-2 placeholder:text-sm text-black placeholder:text-slate-400 focus:outline-none focus:border-primary focus:ring-primary block focus:ring-1"
                    value="<?php echo $data["harga"]?>">
            </div>
            <div>
                <label for="harga_pemesanan" class="font-bold">Harga Pemesanan</label>
                <input id="harga_pemesanan" type="text" autocomplete="off" name="harga_pemesanan" class="mt-2 w-full bg-slate-200 rounded-sm p-2 placeholder:text-sm text-black placeholder:text-slate-400 focus:outline-none focus:border-primary focus:ring-primary block focus:ring-1"
                    value="<?php echo $data["harga_pemesanan"]?>">
            </div>
            <div>
                <label for="harga_dp" class="font-bold">Harga Dp</label>
                <input id="harga_dp" type="text" autocomplete="off" name="harga_dp" class="mt-2 w-full bg-slate-200 rounded-sm p-2 placeholder:text-sm text-black placeholder:text-slate-400 focus:outline-none focus:border-primary focus:ring-primary block focus:ring-1"
                    value="<?php echo $data["harga_dp"]?>">
            </div>
            <div>
                <label for="harga_bulanan" class="font-bold">Harga Bulanan</label>
                <input id="harga_bulanan" type="text" autocomplete="off" name="harga_bulanan" class="mt-2 w-full bg-slate-200 rounded-sm p-2 placeholder:text-sm text-black placeholder:text-slate-400 focus:outline-none focus:border-primary focus:ring-primary block focus:ring-1"
                    value="<?php echo $data["harga_bulanan"]?>">
            </div>
            <div>
                <label for="lama_bayar" class="font-bold">Lama Bayar</label>
                <input id="lama_bayar" type="text" autocomplete="off" name="lama_bayar" class="mt-2 w-full bg-slate-200 rounded-sm p-2 placeholder:text-sm text-black placeholder:text-slate-400 focus:outline-none focus:border-primary focus:ring-primary block focus:ring-1"
                    value="<?php echo $data["lama_bayar"]?>">
            </div>
        </div>
        <div class="flex space-x-5 mt-10 justify-end text-white">
            <button class="px-5 py-2 rounded-md bg-primary hover:bg-blue-900 ease-in-out duration-300" name="updateHarga">
                <i class="fa-regular fa-floppy-disk mr-2"></i>
                Simpan
            </button>
            <a onClick="return confirm('Anda yakin ingin menghapus harga rumah Rp<?php echo $data["harga"]?> ?')" href="../core/product/product.php?hapus_harga=<?php echo $data['id_rumahdetail'];?>"
                class="px-5 py-2 bg-red-600 hover:bg-red-700 ease-in-out duration-300 rounded-md">
                <i class="fa-regular fa-trash-can"></i>
                Hapus
            </a>
        </div>
    </form>
</div>