<?php
    require '../core/config.php';
    require '../core/product/product.php';
?>
<div class="p-5">
<div class="py-4 bg-white flex space-x-5 justify-between">
    <div class="flex space-x-5 items-center">
        <?php
            $sql = mysqli_query($connect, "SELECT * FROM tb_gambar_rumah WHERE id_gambar_rumah=".$_GET['id']); ;
            $data = mysqli_fetch_array($sql);
        ?>
        <a title="kembali ke produk" href="../pages/dashboard.php?page=product&id=<?php echo $data['id_rumah']?>"  
            class=" px-4 py-2 bg-slate-300 hover:bg-slate-400 ease-in-out duration-300 rounded-md">
            <i class="fa-solid fa-chevron-left text-lg"></i>
        </a>
        <h1 class="font-playfair text-3xl font-bold text-primary">Update Gambar Rumah</h1>
    </div>
    <div>
        <?php include("../pages/notifikasi.php")?>
    </div>
    </div>
    <form method="post" enctype="multipart/form-data" action="" class="mt-6">
        <?php
            $sql = "SELECT * FROM tb_gambar_rumah WHERE id_gambar_rumah = ".$_GET['id'];
            $query = mysqli_query($connect, $sql);
            $data = mysqli_fetch_assoc($query);
        ?>
        <div class="grid grid-cols-2 gap-12 items-st">
            <div>
                <input type="hidden" name="id_gambar_rumah" value="<?php echo $data['id_gambar_rumah']?>">
                <picture>
                    <img class="w-full h-full" src="../core/product/images/<?php echo $data['gambar']?>" alt="">
                </picture>
            </div>
            <div>
                <div class="mb-2 font-bold" for="gambar">Gambar Rumah</div>
                <input id="gambar" type="file" name="gambar" required="required" multiple class="block rounded-sm bg-slate-200 px-2 w-full text-sm text-slate-500
                    file:mr-4 file:py-1 file:px-4 file:rounded-sm file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-primary hover:file:bg-violet-100" value="<?php echo $data['gambar']?>" />
                <div class="mt-7 flex justify-end space-x-5 text-white place-self-start">
                    <button type="submit" class="px-5 py-2 rounded-md bg-primary hover:bg-blue-900 ease-in-out duration-300" name="updateGambar">
                        <i class="fa-regular fa-floppy-disk mr-2"></i>
                        Simpan
                    </button>
                    <a onClick="return confirm('Anda yakin menghapus gambar <?php echo $data['gambar']?>')" href="../core/product/product.php?hapus_gambar=<?php echo $data['id_gambar_rumah'];?>"
                        class="px-5 py-2 bg-red-600 hover:bg-red-700 ease-in-out duration-300 rounded-md">
                        <i class="fa-regular fa-trash-can"></i>
                        Hapus
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>
