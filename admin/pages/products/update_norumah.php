<?php
    include('../core/config.php');
    include('../core/product/product.php');
?>
<div class="p-5">
    <div class="py-4 bg-white flex space-x-5 justify-between items-center">
        <div class="flex items-center space-x-5">
            <a title="kembali ke produk" href="../pages/dashboard.php?page=product&id=<?php echo $_GET['id']?>"  
                class=" px-4 py-2 bg-slate-300 hover:bg-slate-400 ease-in-out duration-300 rounded-md">
                <i class="fa-solid fa-chevron-left text-lg"></i>
            </a>
            <h1 class="font-playfair text-3xl font-bold text-primary mt-1">Update Data No Rumah</h1>
        </div>
        <div>
            <?php include("../pages/notifikasi.php")?>
        </div>
    </div>
    <form class="mt-6" method="post">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-8 mb-6">
            <?php 
                $sql_getHouseNumber = mysqli_query($connect, "SELECT * FROM tb_norumah WHERE id_rumah =" .$_GET['id']);
                while($data = mysqli_fetch_array($sql_getHouseNumber)){
            ?>
            <div class="flex space-x-3 items-end">
                <div id="no_rumah" class="w-3/4">
                    <span class="font-bold">No Rumah</span>
                    <input type="hidden" name='id_rumah' value="<?php echo $data['id_rumah']?>">
                    <input type="hidden" name='id_norumah[]' value="<?php echo $data['id_norumah']?>">
                    <label>
                        <input type="text" name="no_rumah[]" autocomplete="off" class="mt-2 w-full bg-slate-200 rounded-sm p-2 placeholder:text-sm text-black placeholder:text-slate-400 focus:outline-none focus:border-primary focus:ring-primary block focus:ring-1"
                            value="<?php echo $data['no_rumah']?>">
                    </label>
                </div>
                <a name="deleteNoRumah" onClick="return confirm('Anda yakin ingin menghapus no rumah <?php echo $data['no_rumah']?> ?')" href="../core/product/product.php?hapus_norumah=<?php echo $data['id_norumah'];?>"
                    class="px-3 py-2 rounded-md bg-red-600 hover:bg-red-700 ease-in-out duration-200 text-white">
                    <i class="fa-regular fa-trash-can"></i>
                </a>
            </div>
            <?php
                }
            ?>
        </div>
        <button type="submit" name="updateNoRumah" class="flex ml-auto items-center px-5 py-2 rounded-md bg-primary hover:bg-blue-900 ease-in-out duration-300 text-white mt-6">
            <i class="fa-regular fa-floppy-disk mr-2"></i>
            Simpan
        </button>
    </form>
</div>