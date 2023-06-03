<?php
   require '../core/product/product.php';
?>
<div class="p-3 font-yantramanav">
    <div class="sticky top-0 py-4 bg-white flex items-center justify-between space-x-5">
        <div class="flex space-x-5 items-center">
            <button>
                <a title="list produk" href="../pages/dashboard.php?page=product_list" class=" px-4 py-3 bg-slate-300 hover:bg-slate-400 ease-in-out duration-300 rounded-md">
                    <i class="fa-solid fa-chevron-left text-lg"></i>
                </a>
            </button>
            <h1 class="font-playfair text-3xl tracking-wider font-bold text-primary">Tambah Rumah</h1>
        </div>
        <div>
            <?php include("../pages/notifikasi.php")?>
        </div>
    </div>
    <div class="overflow-y-auto px-2">
        <div class="mt-6">
            <form method="post"  enctype="multipart/form-data">
                <div class="grid grid-cols-4 gap-6 ">
                    <div>
                        <label for="tipe" class="font-semibold">Tipe</label>
                        <input id="tipe" type="number" autocomplete="off" name="tipe" required="required"
                            class="mt-2 w-full bg-slate-200 rounded-sm p-2 placeholder:text-sm text-black placeholder:text-slate-400 focus:outline-none focus:border-primary focus:ring-primary block focus:ring-1"
                            placeholder="32">
                    </div>
                    <div>
                        <label for="luas_bangunan" class="font-semibold">Luas Bangunan</label>
                        <input id="luas_bangunan" name="luas_bangunan" type="number" autocomplete="off" required="required"
                            class="mt-2 w-full bg-slate-200 rounded-sm p-2 placeholder:text-sm text-black placeholder:text-slate-400 focus:outline-none focus:border-primary focus:ring-primary block focus:ring-1"
                            placeholder="500">
                    </div>
                    <div>
                        <label for="luas_tanah" class="font-semibold">Luas Tanah</label>
                        <input id="luas_tanah" name="luas_tanah" autocomplete="off" type="number" required="required"
                            class="mt-2 w-full bg-slate-200 rounded-sm p-2 placeholder:text-sm text-black placeholder:text-slate-400 focus:outline-none focus:border-primary focus:ring-primary block focus:ring-1"
                            placeholder="400">
                    </div>
                    <div>
                        <label for="kamar_tidur" class="font-semibold">Jumlah Kamar Tidur</label>
                        <input id="kamar_tidur" name="kamar_tidur" type="number" autocomplete="off" required="required"
                            class="mt-2 w-full bg-slate-200 rounded-sm p-2 placeholder:text-sm text-black placeholder:text-slate-400 focus:outline-none focus:border-primary focus:ring-primary block focus:ring-1"
                            placeholder="3">
                    </div>
                    <div>
                        <label for="kamar_mandi" class="font-semibold">Jumlah Kamar Mandi</label>
                        <input id="kamar_mandi" name="kamar_mandi" type="number" autocomplete="off" required="required"
                            class="mt-2 w-full bg-slate-200 rounded-sm p-2 placeholder:text-sm text-black placeholder:text-slate-400 focus:outline-none focus:border-primary focus:ring-primary block focus:ring-1"
                            placeholder="2">
                    </div>
                    <div>
                        <label for="jumlah_lantai" class="font-semibold">Jumlah Lantai</label>
                        <input id="jumlah_lantai" name="jumlah_lantai" type="number" autocomplete="off" required="required"
                            class="mt-2 w-full bg-slate-200 rounded-sm p-2 placeholder:text-sm text-black placeholder:text-slate-400 focus:outline-none focus:border-primary focus:ring-primary block focus:ring-1"
                            placeholder="2">
                    </div>
                    <div>
                        <label for="daya_listrik" class="font-semibold">Daya Listrik</label>
                        <input id="daya_listrik" name="daya_listrik" type="number" autocomplete="off" required="required"
                            class="mt-2 w-full bg-slate-200 rounded-sm p-2 placeholder:text-sm text-black placeholder:text-slate-400 focus:outline-none focus:border-primary focus:ring-primary block focus:ring-1"
                            placeholder="5000">
                    </div>
                    <div>
                        <label for="lokasi" class="font-semibold">Lokasi</label>
                            <select id="location" name="lokasi" class="mt-2 w-full bg-slate-200 rounded-sm p-2 placeholder:text-sm text-black placeholder:text-slate-400 focus:outline-none focus:border-primary focus:ring-primary block focus:ring-1">
                                <option value="batam centre">Batam Centre</option>
                                <option value="sekupang">Sekupang</option>
                                <option value="batu aji">Batu Aji</option>
                                <option value="sadai">Sadai</option>
                                <option value="nongsa">Nongsa</option>
                            </select>
                    </div>
                </div>
                <div class="mt-12">
                    <div id="form_harga">
                        <div class="grid grid-cols-4 gap-6">
                            <div>
                                <label for="harga" class="font-semibold">Harga</label>
                                <input id="harga" name="harga[]" type="number" autocomplete="off" required="required"
                                    class="mt-2 w-full bg-slate-200 rounded-sm p-2 placeholder:text-sm text-black placeholder:text-slate-400 focus:outline-none focus:border-primary focus:ring-primary block focus:ring-1"
                                    placeholder="Masukkan hanya angka">
                            </div>
                            <div>
                                <label for="harga_pemesanan" class="font-semibold">Harga Pemesanan</label>
                                <input id="harga_pemesanan" name="harga_pemesanan[]" type="number" autocomplete="off" required="required"
                                    class="mt-2 w-full bg-slate-200 rounded-sm p-2 placeholder:text-sm text-black placeholder:text-slate-400 focus:outline-none focus:border-primary focus:ring-primary block focus:ring-1"
                                    placeholder="Masukkan hanya angka">
                            </div>  
                            <div>
                                <label for="dp" class="font-bold">Harga DP</label>
                                <input id="dp" type="number" name="harga_dp[]" autocomplete="off" required="required"
                                    class="mt-2 w-full bg-slate-200 rounded-sm p-2 placeholder:text-sm text-black placeholder:text-slate-400 focus:outline-none focus:border-primary focus:ring-primary block focus:ring-1"
                                    placeholder="masukkan hanya angka">
                            </div>
                            <div>
                                <label for="harga_bulanan" class="font-bold">Harga per Bulan</label>
                                <input id="harga_bulanan" name="harga_bulanan[]" type="number" autocomplete="off" required="required"
                                    class="mt-2 w-full bg-slate-200 rounded-sm p-2 placeholder:text-sm text-black placeholder:text-slate-400 focus:outline-none focus:border-primary focus:ring-primary block focus:ring-1"
                                    placeholder="masukkan hanya angka">
                            </div>
                            <div>
                                <label for="lama_bayar" class="font-bold">Lama Bayar</label>
                                <input id="lama_bayar" name="lama_bayar[]" type="number" autocomplete="off" required="required"
                                    class="mt-2 w-full bg-slate-200 rounded-sm p-2 placeholder:text-sm text-black placeholder:text-slate-400 focus:outline-none focus:border-primary focus:ring-primary block focus:ring-1"
                                    placeholder="masukkan hanya angka">
                            </div>
                        </div>
                </div>
                <div class="flex space-x-5 mt-3">
                    <button id="add" value="add new" onclick="tambahHarga();" type="button"
                        class="mt-4 px-5 py-2 text-white rounded-md bg-blue-500 hover:bg-blue-700 ease-in-out duration-300">
                        <i class="fa-solid fa-square-plus mr-3"></i>
                        Tambah Form
                    </button>
                    <button id="remove" type="button" value="Remove last element" onclick="hapusHarga()"
                        class="mt-4 px-5 py-2 bg-red-600 hover:bg-red-700 text-white ease-in-out rounded-md duration-300 ">
                        <i class="fa-regular fa-trash-can mr-2"></i>
                        Hapus Form 
                    </button>
                </div>
            </div>
            <div class="flex space-x-6 items-end mt-12">
                <div id="no_rumah" class="w-2/5">
                    <label for="no_rumah" class="font-bold">No Rumah</label>
                    <input id="no_rumah" type="text" name="no_rumah[]" autocomplete="off" required="required"
                        class="mt-2 w-full bg-slate-200 rounded-sm p-2 placeholder:text-sm text-black placeholder:text-slate-400 focus:outline-none focus:border-primary focus:ring-primary block focus:ring-1" placeholder="A01">
                    </div>
                    <div class="flex space-x-3 mt-7">
                        <button id="add" value="add new" onclick="tambahNorumah();" type="button" class="px-5 py-2 rounded-md text-white bg-blue-500 hover:bg-blue-700 ease-in-out duration-300 ">
                            <i class="fa-solid fa-square-plus mr-3"></i>
                            Tambah Form
                        </button>
                        <button id="remove" type="button" value="Remove last element" onclick="hapusNorumah()" class="px-5 py-2 rounded-md text-white bg-red-600 hover:bg-red-700 ease-in-out duration-300 ">
                            <i class="fa-regular fa-trash-can mr-2"></i>
                            Hapus Form
                        </button>
                    </div>
                </div>
                <div class="mt-12">
                    <div id="picture">
                        <label fpr="gambar" class="font-bold">Gambar</label>
                        <div class="flex space-x-6 items-center">
                            <div class="w-full lg:w-2/5">
                                <input id="gambar" type="file" name="gambar[]" required="required" multiple class="mt-2 block rounded-sm bg-slate-200 px-2  w-full text-sm text-slate-500
                                    file:mr-4 file:py-1 file:px-4 file:rounded-sm file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-primary hover:file:bg-violet-100" />
                            </div>
                            <div class="font-bold ">
                                <i class="text-sm">Mohon upload gambar dengan format png, jpg, jpeg, atau webp dengan ukuran maksimal 10MB</i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-12">
                    <label for="deskripsi" class="font-bold">Deskripsi Rumah</label>
                    <textarea name="deskripsi" class="mt-2 w-full bg-slate-200 rounded-sm p-2 placeholder:text-sm text-black placeholder:text-slate-400 focus:outline-none focus:border-primary focus:ring-primary block focus:ring-1" placeholder="Rumah baru dengan konsep minimalis" id="" cols="30" rows="5"></textarea>
                </div>
                <button type="submit" name="addProduct" class="flex items-center ml-auto px-5 py-2 mt-12 bg-primary rounded-md hover:bg-blue-900 ease-in-out duration-200 text-white">
                    <i class="fa-regular fa-floppy-disk mr-2"></i>
                    <span>Simpan</span>
                </button>
            </form>
        </div>
    </div>
</div>
