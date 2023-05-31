<?php
    include("../core/config.php");
    include("../core/product/product.php");
?>
<div class="p-5 font-raleway">
    <div class="sticky z-50 top-0 py-4 bg-white flex items-center space-x-5 justify-between">
        <div class="flex space-x-5 items-center">
            <button>
                <a title="list produk" href="../pages/dashboard.php?page=product_list" class=" px-4 py-3.5 bg-slate-300 hover:bg-slate-400 ease-in-out duration-300 rounded-md">
                    <i class="fa-solid fa-chevron-left text-lg"></i>
                </a>
            </button>
            <h1 class="font-playfair text-3xl tracking-wider font-bold text-primary">Tambah Rumah</h1>
        </div>
        <div>
            <?php include("../pages/notifikasi.php")?>
        </div>
    </div>
    <div class="overflow-y-auto mt-5">
        <div class="border border-primary rounded-md px-3 py-5">
            <h2 class="text-2xl font-bold font-playfair">Data Rumah</h2>
            <?php
                $sql_getProduct = mysqli_query($connect, "SELECT * FROM tb_rumah WHERE id_rumah = " .$_GET['id']);
                while($data = mysqli_fetch_assoc($sql_getProduct)){
                        $id_rumah = $data['id_rumah']
            ?>
            <div class="grid grid-cols-4 gap-5 my-5 font-medium">
                <span class="hidden"><?php echo $id_rumah?></span>
                <div class="flex space-x-5">
                    <span class="font-bold">Tipe :</span>
                    <span><?php echo $data['tipe'];?></span>
                </div>
                <div class="flex space-x-5">
                    <span class="font-bold">Luas Tanah :</span>
                    <span><?php echo $data['luas_tanah'];?> m<sup>2</sup></span>
                </div>
                <div class="flex space-x-5">
                    <span class="font-bold">Kamar Tidur :</span>
                    <span><?php echo $data['kamar_tidur'];?> ruang</span>
                </div>
                <div class="flex space-x-5">
                    <span class="font-bold">Daya Listrik :</span>
                    <span><?php echo $data['daya_listrik'];?> VA</span>
                </div>
                <div class="flex space-x-5">
                    <span class="font-bold">Lokasi :</span>
                    <span class="capitalize"><?php echo $data['lokasi'];?></span>
                </div>
                <div class="flex space-x-5">
                    <span class="font-bold">Luas Bangunan :</span>
                    <span><?php echo $data['luas_bangunan'];?> m<sup>2</sup></span>
                </div>
                <div class="flex space-x-5">
                    <span class="font-bold">Kamar Mandi :</span>
                    <span><?php echo $data['kamar_mandi'];?> ruang</span>
                </div>
                <div class="flex space-x-5">
                    <span class="font-bold">Jumlah Lantai :</span>
                    <span><?php echo $data['jumlah_lantai'];?> lantai</span>
                </div>
            </div>
            <div class="mb-5">
                <span class="block font-bold">Deskripsi</span>
                <p><?php echo $data['deskripsi'];?></p>
            </div>
            <a href="../pages/dashboard.php?page=update_rumah&id=<?php echo $id_rumah?>">
                <button class="px-5 py-2 rounded-md bg-green-500 hover:bg-green-700 ease-in-out duration-200 text-white">
                    <i class="fa-regular fa-pen-to-square mr-2"></i>
                    Edit Data
                </button>
            </a>
            <?php
                }
            ?>
        </div>
        <div class="mt-5 border border-primary rounded-md px-3 py-5">
            <h3 class="text-2xl font-bold font-playfair">Nomor Rumah</h3>
            <div class="columns-4 my-5 gap-5">
                <?php
                    $sql_getHouseNumber = mysqli_query($connect, "SELECT * FROM tb_norumah WHERE id_rumah=".$_GET['id']);
                    if(mysqli_num_rows($sql_getHouseNumber) > 0){
                        while($data = mysqli_fetch_array($sql_getHouseNumber)){
                ?>
                <div class="flex space-x-5 mb-3">
                    <span class="font-bold">Nomor :</span>
                    <span><?php echo $data['no_rumah']?></span>
                </div>
                <?php
                        }
                    }else{
                        echo '<div class="font-bold italic text-slate-500">Tidak ada no rumah</div>';
                    }
                ?>
            </div>
            <div class="flex space-x-5">
                <button onclick="addNoRumah()" class="px-5 py-2 text-white rounded-md bg-blue-500 hover:bg-blue-700 ease-in-out duration-200">
                    <i class="fa-solid fa-square-plus mr-2"></i>
                    Tambah Data
                </button>
                <a href="../pages/dashboard.php?page=update_norumah&id=<?php echo $id_rumah?>">
                    <button class="px-5 py-2 rounded-md bg-green-500 hover:bg-green-700 ease-in-out duration-200 text-white">
                        <i class="fa-regular fa-pen-to-square mr-2"></i>
                        Edit Data
                    </button>
                </a>
            </div>
            <form id="form_add_norumah" class="hidden border-t border-primary mt-5" method="post">
                <div class="flex space-x-5 items-end">
                    <div id="no_rumah" class="space-y-6 my-5 w-2/5 2xl:w-1/5">
                        <input type="hidden" name="id_rumah" id="id_rumah" value="<?php echo $_GET['id']?>">
                        <div id="no_rumah">
                            <label for="no_rumah" class="font-bold">No Rumah</label>
                            <input id="no_rumah" type="text" name="no_rumah[]" autocomplete="off" required="required"
                                class="mt-2 w-full bg-slate-200 rounded-sm p-2 placeholder:text-sm text-black placeholder:text-slate-400 focus:outline-none focus:border-slate-600 focus:ring-slate-600 block focus:ring-2" placeholder="A01">
                        </div>
                    </div>
                    <div class="flex space-x-5 mb-5">
                        <button id="add" value="add new" onclick="tambahNorumah();" type="button" class="px-5 py-2 rounded-md bg-blue-500 hover:bg-blue-700 ease-in-out duration-300  text-white">
                            <i class="fa-solid fa-square-plus mr-2"></i>
                            Tambah Form
                        </button>
                        <button id="remove" type="button" value="Remove last element" onclick="hapusNorumah()" class="px-5 py-2 rounded-md text-white bg-red-600 hover:bg-red-700 ease-in-out duration-300 ">
                            <i class="fa-regular fa-trash-can mr-2"></i>
                            Hapus Form
                        </button>
                    </div>
                </div>
                <div>
                    <button type="submit" name="tambahNoRumah" class="px-5 py-2 hover:bg-blue-900 ease-in-out duration-200 bg-primary rounded-md text-white">
                        <i class="fa-regular fa-floppy-disk mr-2"></i>
                        Simpan
                    </button>
                </div>
            </form>
        </div>
        <div class="mt-5 border border-primary rounded-md px-3 py-5">
            <h4 class="text-2xl font-bold font-playfair">Harga Rumah</h4>
            <div class="columns-3 my-5 gap-3">
                <?php
                    $sql_getPrice = mysqli_query($connect, "SELECT * FROM tb_harga_rumah WHERE id_rumah =" .$_GET['id']);
                    if(mysqli_num_rows($sql_getPrice) > 0){
                        while($data = mysqli_fetch_assoc($sql_getPrice)){
                ?>
                <div class="break-inside-avoid bg-white shadow-md rounded-md shadow-black/10 p-3">
                    <div class="w-full">
                        <table class="w-full">
                            <tr>
                                <td class="font-bold">Harga</td>
                                <td>Rp <?php echo number_format($data["harga"])?>,-</td>
                            </tr>
                            <?php if($data["harga_pemesanan"] > 0){
                                ?>
                            <tr>
                                <td class="font-bold">Harga Pemesanan</td>
                                <td>Rp <?php echo number_format($data["harga_pemesanan"])?>,-</td>
                            </tr>
                            <?php
                            } 
                            ?>
                            <?php if($data["harga_dp"] > 0){
                                ?>
                            <tr>
                                <td class="font-bold">Harga Dp</td>
                                <td>Rp <?php echo number_format($data["harga_dp"])?>,-</td>
                            </tr>
                            <?php
                            } 
                            ?>
                               <?php if($data["harga_bulanan"] > 0){
                                ?>
                            <tr>
                                <td class="font-bold">Harga Bulanan</td>
                                <td>Rp <?php echo number_format($data["harga_bulanan"])?>,-</td>
                            </tr>
                            <?php
                            } 
                            ?>
                               <?php if($data["lama_bayar"] > 0){
                                ?>
                            <tr>
                                <td class="font-bold">Lama Bayar</td>
                                <td><?php echo number_format($data["lama_bayar"])?> Bulan</td>
                            </tr>
                            <?php
                            } 
                            ?>
                               <!-- <?php if($data["lama_bayar"] > 0){
                                ?>
                             <tr>
                                <td class="font-bold">Bunga</td>
                                <td><?php echo number_format($data["bunga"])?> %</td>
                            </tr>
                            <?php
                            } 
                            ?> -->
                        </table>
                    </div>
                    <a href="../pages/dashboard.php?page=update_harga&id=<?php echo ($data["id_rumahdetail"])?>" class="flex-none">
                        <button class="px-5 mt-4 py-2 rounded-md bg-green-500 hover:bg-green-700 ease-in-out duration-200 text-white">
                            <i class="fa-regular fa-pen-to-square mr-2"></i>
                            Edit Data
                        </button>
                    </a>
                </div>
                <?php
                        }
                    }else{
                        echo '<div class="font-bold italic text-slate-500">Tidak ada harga rumah</div>';
                    }
                ?>
            </div>
            <button onclick="addHarga()" class="px-5 py-2 text-white rounded-md bg-blue-500 hover:bg-blue-700 ease-in-out duration-200">
                <i class="fa-solid fa-square-plus mr-2"></i>
                Tambah Data
            </button>
            <form id="form_tambah_harga_rumah" class="hidden border-t border-primary mt-5" method="post">
            <div id="form_harga_rumah">
                <div id="form_harga">
                    <input type="hidden" name="id_rumah" id="id_rumah" value="<?php echo $_GET['id']?>">
                    <div class="gap-6 grid grid-cols-3 my-5 ">
                        <label>
                            <span class="font-bold">Harga</span>
                            <input id="harga" name="harga[]" type="text" autocomplete="off" required="required"
                                class="mt-2 w-full bg-slate-200 rounded-sm p-2 placeholder:text-sm text-black placeholder:text-slate-400 focus:outline-none focus:border-slate-600 focus:ring-slate-600 block focus:ring-2" placeholder="Masukkan hanya angka">
                        </label>
                        <label>
                            <span class="font-bold">Harga DP</span>
                            <input id="dp" type="text" name="harga_dp[]" autocomplete="off" required="required"
                                class="mt-2 w-full bg-slate-200 rounded-sm p-2 placeholder:text-sm text-black placeholder:text-slate-400 focus:outline-none focus:border-slate-600 focus:ring-slate-600 block focus:ring-2" placeholder="masukkan hanya angka">
                        </label>
                        <label>
                            <span class="font-bold">Harga per Bulan</span>
                            <input id="harga_bulanan" name="harga_bulanan[]" type="text" autocomplete="off"
                                required="required"
                                class="mt-2 w-full bg-slate-200 rounded-sm p-2 placeholder:text-sm text-black placeholder:text-slate-400 focus:outline-none focus:border-slate-600 focus:ring-slate-600 block focus:ring-2" placeholder="masukkan hanya angka">
                        </label>
                        <label>
                            <span class="font-bold">Lama Bayar</span>
                            <input id="lama_bayar" name="lama_bayar[]" type="text" autocomplete="off"
                                required="required"
                                class="mt-2 w-full bg-slate-200 rounded-sm p-2 placeholder:text-sm text-black placeholder:text-slate-400 focus:outline-none focus:border-slate-600 focus:ring-slate-600 block focus:ring-2" placeholder="masukkan hanya angka">
                        </label>
                        <!-- <label>
                            <span class="font-bold">Bunga</span>
                            <input id="bunga" name="bunga[]" type="text" autocomplete="off" required="required"
                                class="mt-2 w-full bg-slate-200 rounded-sm p-2 placeholder:text-sm text-black placeholder:text-slate-400 focus:outline-none focus:border-slate-600 focus:ring-slate-600 block focus:ring-2" placeholder="masukkan hanya angka">
                        </label> -->
                    </div>
                </div>
            </div>
            <div class="flex space-x-5 mt-8 mb-16">
                <button id="add" value="add new" onclick="tambahHarga();" type="button" class= "px-5 py-2 text-white rounded-md bg-blue-500 hover:bg-blue-700 ease-in-out duration-300">
                    <i class="fa-solid fa-square-plus mr-3"></i>
                    Tambah Form
                </button>
                <button id="remove" type="button" value="Remove last element" onclick="hapusHarga()" class="px-5 py-2 rounded-md text-white bg-red-600 hover:bg-red-700 ease-in-out duration-300 ">
                    <i class="fa-regular fa-trash-can mr-2"></i>
                    Hapus Form
                </button>
            </div>
            <div>
                <button type="submit" name="tambahDataHarga" class="px-5 py-2 bg-primary hover:bg-blue-900 ease-in-out duration-200 rounded-md text-white">
                    <i class="fa-regular fa-floppy-disk mr-2"></i>
                    Simpan
                </button>
            </div>
        </form>
    </div>
    <div class="mt-5 border border-primary rounded-md px-3 py-5">
        <h5 class="text-2xl font-bold font-playfair">Gambar Rumah</h5>
        <div class="columns-3 my-5 gap-5">
            <?php
                $sql_getHousePicture = mysqli_query($connect, "SELECT * FROM tb_gambar_rumah WHERE id_rumah=" .$_GET['id']);
                if(mysqli_num_rows($sql_getHousePicture) > 0){
                    while($data = mysqli_fetch_assoc($sql_getHousePicture)){
            ?>
            <div class="shadow-md break-inside-avoid rounded-md p-2">
                <input type="hidden" value="<?php echo $data['id_gambar_rumah']?>">
                <picture>
                    <img src="../core/product/images/<?php echo $data['gambar']?>" alt="">
                </picture>
                <a href="../pages/dashboard.php?page=update_gambar&id=<?php echo ($data["id_gambar_rumah"])?>">
                    <button class="mt-2 px-5 py-2 rounded-md bg-green-500 hover:bg-green-700 ease-in-out duration-200 text-white">
                        <i class="fa-regular fa-pen-to-square mr-2"></i>
                        Edit Data
                    </button>
                </a>
            </div>
            <?php
                    }
                }
                else{
                    echo '<div class="font-bold italic text-slate-500">Tidak ada gambar rumah</div>';
                }
            ?>
        </div>
        <button onclick="addPicture()" class="px-5 py-2 text-white rounded-md bg-blue-500 hover:bg-blue-700 ease-in-out duration-200">
            <i class="fa-solid fa-square-plus mr-2"></i>
            Tambah Data
        </button>
        <form id="form_add_picture" class="hidden mt-5 border-t border-primary" method="post" enctype="multipart/form-data">
            <div class="my-5 ">
                <div id="picture">
                    <div class="mb-3 font-bold">Gambar</div>
                    <input type="hidden" name="id_rumah" value="<?php echo $_GET['id']?>">
                    <div class="flex items-start space-x-5">
                        <div>
                            <label for="id" class="w-1/2">
                                <input id="gambar" type="file" name="gambar[]" required="required" multiple class="block rounded-sm bg-slate-200 px-2 mb-2 w-full text-sm text-slate-500
                                file:mr-4 file:py-1 file:px-4 file:rounded-sm file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-primary hover:file:bg-violet-100" />
                            </label>
                            <i class="font-semibold text-sm">Mohon upload gambar dengan format png, jpg, jpeg, atau webp dengan ukuran maksimal 10MB</i>
                        </div>
                        <button type="submit" name="tambahGambar" class="px-5 mt-[2px] py-2 bg-primary rounded-md hover:bg-blue-900 ease-in-out duration-200 text-white">
                            <i class="fa-regular fa-floppy-disk mr-2"></i>
                            Simpan
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- <script>
    // Tambah dan hapus form no rumah
var no_rumah = '<input id="no_rumah" type="text" name="no_rumah[]" autocomplete="off" required="required" class="mt-2 w-full bg-slate-200 rounded-sm p-2 placeholder:text-sm text-black placeholder:text-slate-400 focus:outline-none focus:border-slate-600 focus:ring-slate-600 block focus:ring-2" placeholder="A01">'
function tambahNorumah() {
    var newContent = document.createElement('div');
    newContent.innerHTML = no_rumah;
    document.getElementById('no_rumah').appendChild(newContent);
}
function hapusNorumah() {
    document.getElementById('no_rumah').lastChild.remove()
}


// Tambah dan hapus form harga
var form_harga = '<div class="grid grid-cols-4 gap-6 mt-5 border-t border-primary py-5"><label><span class="font-bold">Harga</span><input id="harga" name="harga[]" type="text" autocomplete="off" class="mt-2 w-full bg-slate-200 rounded-sm p-2 placeholder:text-sm text-black placeholder:text-slate-400 focus:outline-none focus:border-slate-600 focus:ring-slate-600 block focus:ring-2"placeholder="Masukkan hanya angka"></label><label><span class="font-bold">Harga DP</span><input id="dp" type="text" name="harga_dp[]" autocomplete="off"class="mt-2 w-full bg-slate-200 rounded-sm p-2 placeholder:text-sm text-black placeholder:text-slate-400 focus:outline-none focus:border-slate-600 focus:ring-slate-600 block focus:ring-2"placeholder="masukkan hanya angka"></label><label><span class="font-bold">Harga per Bulan</span><input id="harga_bulanan" name="harga_bulanan[]" type="text" autocomplete="off"class="mt-2 w-full bg-slate-200 rounded-sm p-2 placeholder:text-sm text-black placeholder:text-slate-400 focus:outline-none focus:border-slate-600 focus:ring-slate-600 block focus:ring-2"placeholder="masukkan hanya angka"></label><label><span class="font-bold">Lama Bayar</span><input id="lama_bayar" name="lama_bayar[]" type="text" autocomplete="off"class="mt-2 w-full bg-slate-200 rounded-sm p-2 placeholder:text-sm text-black placeholder:text-slate-400 focus:outline-none focus:border-slate-600 focus:ring-slate-600 block focus:ring-2"placeholder="masukkan hanya angka"></label><label><span class="font-bold">Bunga</span><input id="bunga" name="bunga[]" type="text" autocomplte="off"class="mt-2 w-full bg-slate-200 rounded-sm p-2 placeholder:text-sm text-black placeholder:text-slate-400 focus:outline-none focus:border-slate-600 focus:ring-slate-600 block focus:ring-2"placeholder="masukkan hanya angka"></label></div>';
function tambahHarga() {
    var newContent = document.createElement('div');
    newContent.innerHTML = form_harga;
    document.getElementById('form_harga').appendChild(newContent);
}
function hapusHarga() {
    document.getElementById('form_harga').lastChild.remove()
}

// Show hide No Rumah
let addNewFormNoRumah = document.getElementById("form_add_norumah");
function addNoRumah() {
    addNewFormNoRumah.classList.toggle("!block");
}


// show hide Harga Rumah
let addNewFormHarga = document.getElementById("form_tambah_harga_rumah");
function addHarga() {
    addNewFormHarga.classList.toggle("!block");
}
</script> -->