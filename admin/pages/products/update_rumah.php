<?php
    include('../core/config.php');
    include('../core/product/product.php');
?>
<div class="p-5">
    <div class="sticky top-0 py-4 bg-white flex space-x-5 items-center justify-between">
        <div class="flex space-x-5 items-center">
            <button title="kembali ke produk" onclick="history.back()" class="px-4 py-2 bg-slate-300 hover:bg-slate-400 ease-in-out duration-300 rounded-md">
                <i class="fa-solid fa-chevron-left text-lg"></i>
            </button>
            <h1 class="font-playfair text-3xl tracking-wider font-bold text-primary">Update Data Rumah</h1>
        </div>
        <div>
            <?php include("../pages/notifikasi.php")?>
        </div>
    </div>
    <?php
        $sql_getProduct = mysqli_query($connect, "SELECT * FROM tb_rumah WHERE id_rumah = " .$_GET['id']);
        while($data = mysqli_fetch_assoc($sql_getProduct)){
    ?>
    <form method="post">
        <div>
            <input type="hidden" name="id_rumah" id="" value="<?php echo $data['id_rumah']?>">
        </div>
        <div class="grid grid-cols-4 gap-5 mt-6">
            <div>
                <label for="tipe" class="font-bold">Tipe Rumah</label>
                <input id="tipe" type="text" autocomplete="off" name="tipe" class="mt-2 w-full bg-slate-200 rounded-sm p-2 placeholder:text-sm text-black placeholder:text-slate-400 focus:outline-none focus:border-primary focus:ring-primary block focus:ring-1"
                    value="<?php echo $data['tipe']?>">
            </div>
            <div>
                <label for="luas_tanah" class="font-bold">Luas Tanah</label>
                <input id="luas_tanah" type="text" autocomplete="off" name="luas_tanah" class="mt-2 w-full bg-slate-200 rounded-sm p-2 placeholder:text-sm text-black placeholder:text-slate-400 focus:outline-none focus:border-primary focus:ring-primary block focus:ring-1"
                    value="<?php echo $data['luas_tanah']?>">
            </div>
            <div>
                <label for="kamar_tidur" class="font-bold">Kamar Tidur</label>
                <input id="kamar_tidur" type="text" autocomplete="off" name="kamar_tidur" class="mt-2 w-full bg-slate-200 rounded-sm p-2 placeholder:text-sm text-black placeholder:text-slate-400 focus:outline-none focus:border-primary focus:ring-primary block focus:ring-1"
                    value="<?php echo $data['kamar_tidur']?>">
            </div>
            <div>
                <label for="daya_listrik" class="font-bold">Daya Listrik</label>
                <input id="daya_listrik" type="text" autocomplete="off" name="daya_listrik" class="mt-2 w-full bg-slate-200 rounded-sm p-2 placeholder:text-sm text-black placeholder:text-slate-400 focus:outline-none focus:border-primary focus:ring-primary block focus:ring-1"
                    value="<?php echo $data['daya_listrik']?>">
            </div>
            <div>
                <label for="lokasi" class="font-bold">Lokasi</label>
                <input id="lokasi" type="text" autocomplete="off" name="lokasi" class="mt-2 w-full bg-slate-200 rounded-sm p-2 placeholder:text-sm text-black placeholder:text-slate-400 focus:outline-none focus:border-primary focus:ring-primary block focus:ring-1"
                    value="<?php echo $data['lokasi']?>">
            </div>
            <div>
                <label for="luas_bangunan" class="font-bold">Luas Bangunan</label>
                <input id="luas_bangunan" type="text" autocomplete="off" name="luas_bangunan" class="mt-2 w-full bg-slate-200 rounded-sm p-2 placeholder:text-sm text-black placeholder:text-slate-400 focus:outline-none focus:border-primary focus:ring-primary block focus:ring-1"
                    value="<?php echo $data['luas_bangunan']?>">
            </div>
            <div>
                <label for="kamar_mandi" class="font-bold">Kamar Mandi</label>
                <input id="kamar_mandi" type="text" autocomplete="off" name="kamar_mandi" class="mt-2 w-full bg-slate-200 rounded-sm p-2 placeholder:text-sm text-black placeholder:text-slate-400 focus:outline-none focus:border-primary focus:ring-primary block focus:ring-1"
                    value="<?php echo $data['kamar_mandi']?>">
            </div>
            <div>
                <label for="jumlah_lantai" class="font-bold">Jumlah Lantai</label>
                <input id="jumlah_lantai" type="text" autocomplete="off" name="jumlah_lantai" class="mt-2 w-full bg-slate-200 rounded-sm p-2 placeholder:text-sm text-black placeholder:text-slate-400 focus:outline-none focus:border-primary focus:ring-primary block focus:ring-1"
                    value="<?php echo $data['jumlah_lantai']?>">
            </div>
        </div>
        <div class="mt-5">
            <label for="deskrispi" class="font-bold">Deskripsi</label>
            <textarea id="deskripsi" name="deskripsi" class="mt-2 w-full bg-slate-200 rounded-sm p-2 placeholder:text-sm text-black placeholder:text-slate-400 focus:outline-none focus:border-primary focus:ring-primary block focus:ring-1" id="" cols="30" rows="5"><?php echo $data['deskripsi']?></textarea>
        </div>
        <button type="submit" name="updateRumah" class="flex items-center ml-auto px-5 py-2 rounded-md bg-primary hover:bg-blue-900 ease-in-out duration-200 text-white mt-6">
            <i class="fa-regular fa-floppy-disk mr-3"></i>
            Simpan 
        </button>
    </form>
    <?php
        }
    ?>
</div>