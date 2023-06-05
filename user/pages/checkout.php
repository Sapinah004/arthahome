<?php
    include('./core/order.php');
    if( !isset($_SESSION['loggedin']) ){
    ?>
       <script>window.location.replace("./pages/auth/login.php");</script> 
    <?php
    die;
    }
?>
<div class="pt-52 pb-24 container mx-auto font-yantramanav text-primary">
    <a class="px-5 text-secondary font-semibold text-xl" href="./index.php?page=list-rumah">
        <i class="fa-solid fa-arrow-left-long mr-2"></i>
        <span class="hover:underline underline-offset-4 ">Kembali Berbelanja</span>
    </a>
    <h1 class="mt-12 text-3xl font-playfair font-bold text-primary tracking-wider">
        Detail Pesanan
    </h1>
    <?php
        $sql = mysqli_query($connect, "SELECT tb_rumah.* , tb_gambar_rumah.* FROM tb_rumah LEFT JOIN tb_gambar_rumah ON tb_rumah.id_rumah = tb_gambar_rumah.id_rumah WHERE tb_rumah.id_rumah = ".$_GET['rumah']);
        if($sql == TRUE){
            $data = mysqli_fetch_array($sql);
        }
    ?>
    <div class="grid grid-cols-2 gap-5 mt-10">
        <picture>
            <img class=" h-60 rounded-lg w-full object-center object-cover" src="./../Admin/core/product/images/<?php echo $data['gambar']?>" alt="">
        </picture>
        <div>
            <h2 class="text-primary font-playfair font-semibold text-2xl">
                Type <?php echo $data['tipe']?>
            </h2>
            <h3 class="mt-3 text-secondary font-bold flex space-x-2 items-center">
                <i class="fa-sharp fa-solid fa-location-dot"></i>
                <span><?php echo $data['lokasi']?></span>
            </h3>
            <div class="mt-3 flex items-center gap-4 md:gap-7 flex-wrap justify-around md:justify-start">
                <div class="py-2 flex justify-center items-center space-x-2">
                    <picture>
                        <img class="w-5" src="../assets/images/icon/width.png" alt="">
                    </picture>
                    <span class="text-primary mt-1"><?php echo $data['luas_bangunan']?> m <sup>2</sup></span>
                </div>
                <div class="py-2 flex justify-center items-center space-x-2">
                    <picture>
                        <img class="w-5" src="../assets/images/icon/bedroom.png" alt="">
                    </picture>
                    <span class="text-primary mt-1"><?php echo $data['kamar_tidur']?> Kamar Tidur</span>
                </div>
                <div class="py-2 flex items-center space-x-2">
                    <picture>
                        <img class="w-5" src="../assets/images/icon/bathroom.png" alt="">
                    </picture>
                    <span class="text-primary mt-1"><?php echo $data['kamar_mandi']?> Kamar Mandi</span>
                </div>
                <div class="py-2 flex items-center space-x-2">
                    <picture>
                        <img class="w-5" src="../assets/images/icon/floor.png" alt="">
                    </picture>
                    <span class="text-primary"><?php echo $data['jumlah_lantai']?> Lantai</span>
                </div>
            </div>
            <div>
                <form method="post" class="w-full">
                    <div class="mt-5 flex space-x-5 items-end">
                        <div class="w-full">
                            <label for="paket_harga" class=" font-semibold text-lg">Pilih Paket Harga</label>
                            <select id="harga" name="paket_harga" class="mt-2 border-primary  w-full px-3 py-2  text-primary focus:border-primary focus:ring-primary focus:outline-none border-2 font-semibold placeholder-primary focus:placeholder-transparent rounded-md">
                            <?php 
                                $sql = "SELECT * FROM tb_harga_rumah WHERE id_rumah =" .$_GET['rumah']." ORDER BY harga ASC";
                                $query = mysqli_query($connect, $sql);
                                while($data = mysqli_fetch_array($query)){
                            ?>
                                <option value="<?php echo $data['harga']?>">Rp. <?php echo number_format($data['harga']) ?></option>
                            <?php
                                }
                            ?>    
                            </select>
                        </div>
                        <button type="submit" name="pilih" class="flex-none px-5 py-2 tracking-wider text-lg text-white bg-primary  hover:bg-blue-900 font-medium rounded-tr-xl rounded-bl-xl ease-in-out duration-300">
                            Pilih 
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="bg-blueMain px-5 py-8 rounded-md mt-12">
        <h3 class="text-3xl  font-playfair text-primary font-bold tracking-wider mb-10">
            Detail Pembayaran
        </h3>
        <form action="" method="post" enctype="multipart/form-data">
            <?php 
                $sql = "SELECT * FROM tb_rumah WHERE id_rumah =" .$_GET['rumah'];
                $query = mysqli_query($connect, $sql);
                $data = mysqli_fetch_array($query);
            ?>
            <input type="hidden" name="id_user" value="<?php echo $_SESSION['id_user']?>">
            <input type="hidden" name="id_rumah" value=<?php echo $data['id_rumah']?>>
            <div class="grid grid-cols-3 mt-5 gap-x-5  gap-y-7">
                <div>
                    <label for="email" class="font-semibold text-lg">Email</label>
                    <input id="email" name="email" type="email" class="mt-2 border-primary bg-blueMain w-full px-3 py-2  text-primary focus:outline-none border-2 focus:border-primary focus:ring-primary font-semibold placeholder-primary focus:placeholder-transparent rounded-md" required="required" value="<?php echo $_SESSION['email']?>">
                    <p class="text-xs mt-1 text-slate-500 font-medium italic before:content-['*']">Kami akan mengirim informasi mengenai pembayaran di email yang anda masukkan</p>
                </div>
                <div>
                    <label for="telephone" class="font-semibold text-lg">No Whatsapp</label>
                    <input type="number" name="telephone" id="telephone"  class="mt-2 border-primary bg-blueMain w-full px-3 py-2 text-primary focus:outline-none focus:border-primary focus:ring-primary border-2 font-semibold placeholder-primary focus:placeholder-transparent rounded-md" placeholder="0858xxxxxxxx" autocomplete="off" required="required"> 
                </div>
                <div>
                    <label for="no_ktp" class="font-semibold text-lg">No KTP</label>
                    <input type="number" name="no_ktp" id="no_ktp"  class="mt-2 border-primary bg-blueMain w-full px-3 py-2 text-primary focus:outline-none focus:border-primary focus:ring-primary border-2 font-semibold placeholder-primary focus:placeholder-transparent rounded-md" placeholder="Masukkan no ktp pembeli" autocomplete="off" required="required"> 
                </div>
                <div>
                    <label for="tipe" class="font-semibold text-lg">Type Rumah</label>
                    <input type="text" name="tipe" id="tipe"  class="mt-2 border-primary bg-blueMain w-full px-3 py-2 text-primary focus:outline-none focus:border-primary focus:ring-primary border-2 font-semibold placeholder-primary focus:placeholder-transparent rounded-md capitalize" value="<?php echo $data['tipe']?> " readonly> 
                </div>
                <div class="relative">
                    <label for="no_rumah" class="font-semibold text-lg">No Rumah</label>
                    <select id="no_rumah" name="no_rumah" class="mt-2 border-primary bg-blueMain w-full px-3 py-2 text-primary focus:outline-none border-2 font-semibold focus:border-primary focus:ring-primary placeholder-primary focus:placeholder-transparent rounded-md">
                    <?php 
                        $sql = "SELECT * FROM tb_norumah WHERE id_rumah =" .$_GET['rumah'];
                        $query = mysqli_query($connect, $sql);
                        while($data = mysqli_fetch_array($query)){
                    ?>
                        <option value="<?php echo $data['no_rumah']?>"><?php echo $data['no_rumah']?></option>
                    <?php
                        }
                    ?>    
                    </select>
                </div>
                <div>
                    <label for="gambar_ktp" class="font-semibold text-lg">Unggah KTP</label>
                    <input name="gambar_ktp" required="required" class="mt-2 block border-primary bg-blueMain w-full  text-primary focus:outline-none border-2 font-semibold focus:border-primary focus:ring-primary placeholder-primary focus:placeholder-transparent rounded-md" id="gambar_ktp" type="file">
                    <p class="text-xs italic text-slate-500 font-semibold mt-1">* Upload gambar dengan ekstensi jpg, jpeg, png, atau webp dengan maksimal 5 MB</p>
                </div>
                <div>
                    <label for="gambar_kk" class="font-semibold text-lg">Unggah Kartu Keluarga</label>
                    <input name="gambar_kk" required="required" class="mt-2 block border-primary bg-blueMain w-full  text-primary focus:outline-none border-2 font-semibold focus:border-primary focus:ring-primary placeholder-primary focus:placeholder-transparent rounded-md" id="gambar_kk" type="file">
                    <p class="text-xs italic text-slate-500 font-semibold mt-1">* Upload gambar dengan ekstensi jpg, jpeg, png, atau webp dengan maksimal 5 MB</p>
                </div>
                <div>
                    <label for="gambar_npwp" class="font-semibold text-lg">Unggah Surat NPWP</label>
                    <input name="gambar_npwp" required="required" class="mt-2 block border-primary bg-blueMain w-full  text-primary focus:outline-none border-2 font-semibold focus:border-primary focus:ring-primary placeholder-primary focus:placeholder-transparent rounded-md" id="gambar_npwp" type="file">
                    <p class="text-xs italic text-slate-500 font-semibold mt-1">* Upload gambar dengan ekstensi jpg, jpeg, png, atau webp dengan maksimal 5 MB</p>
                </div>
            </div>
            <div class="mt-10">
                <h4 class="text-2xl font-playfair text-primary font-bold tracking-wider mb-5">Harga Rumah</h4>
                <?php
                    if(isset($_POST['pilih']) && isset($_POST['paket_harga'])){
                        $harga = mysqli_real_escape_string($connect, $_POST['paket_harga']);
                        $sql = "SELECT * FROM tb_harga_rumah WHERE harga = '".$harga."' AND id_rumah =" .$_GET['rumah'];
                        $query = mysqli_query($connect, $sql);
                        $data = mysqli_fetch_array($query);
                    ?>
                <div class=" grid grid-cols-3 gap-5 ">
                    <div>
                        <input type="hidden" name="id_rumahdetail" value="<?php echo $data['id_rumahdetail']?>">
                        <label for="harga" class="font-semibold text-lg">Harga Rumah</label>
                        <input type="text" name="harga" id="harga" class="mt-2 border-primary bg-blueMain w-full px-3 py-2 text-primary focus:outline-none focus:border-primary focus:ring-primary border-2 font-semibold placeholder-primary focus:placeholder-transparent rounded-md" value=" <?php echo number_format($data['harga']) ?>" readonly> 
                    </div>
                    <?php if($data['harga_dp'] > 0){
                    ?>
                    <div>
                        <label for="harga_dp" class="font-semibold text-lg">Harga Dp</label>
                        <input type="text"  id="harga_dp"  class="mt-2 border-primary bg-blueMain w-full px-3 py-2 text-primary focus:outline-none focus:border-primary focus:ring-primary border-2 font-semibold placeholder-primary focus:placeholder-transparent rounded-md" value="Rp. <?php echo number_format($data['harga_dp']) ?>" readonly> 
                    </div>
                    <?php
                    }
                    ?>
                    <?php if($data['harga_bulanan'] > 0){
                    ?>
                    <div>
                        <label for="harga_bulanan" class="font-semibold text-lg">Harga Per Bulan</label>
                        <input type="text"  id="harga_bulanan"  class="mt-2 border-primary bg-blueMain w-full px-3 py-2 text-primary focus:outline-none focus:border-primary focus:ring-primary border-2 font-semibold placeholder-primary focus:placeholder-transparent rounded-md" value="Rp. <?php echo number_format($data['harga_bulanan']) ?>" readonly> 
                    </div>
                    <?php
                    }
                    ?>
                    <?php if($data['lama_bayar'] > 0){
                    ?>
                    <div>
                        <label for="lama_bayar" class="font-semibold text-lg">Lama Bayar</label>
                        <input type="text"  id="lama_bayar"  class="mt-2 border-primary bg-blueMain w-full px-3 py-2 text-primary focus:outline-none focus:border-primary focus:ring-primary border-2 font-semibold placeholder-primary focus:placeholder-transparent rounded-md" value="<?php echo $data['lama_bayar']?> bulan" readonly> 
                    </div>
                    <?php
                    }
                    ?>
                    <?php if($data['harga_pemesanan'] > 0){
                    ?>
                    <div>
                        <label for="harga_pemesanan" class="font-semibold text-lg">Harga Pemesanan</label>
                        <input type="text"  id="harga_pemesanan"  class="mt-2 border-primary bg-blueMain w-full px-3 py-2 text-primary focus:outline-none focus:border-primary focus:ring-primary border-2 font-semibold placeholder-primary focus:placeholder-transparent rounded-md" value="Rp. <?php echo number_format($data['harga_pemesanan'])?>,-" readonly> 
                    </div>
                    <?php
                    }
                    ?>
                </div>
                <?php
                }else{
                    $sql = "SELECT * FROM tb_harga_rumah WHERE id_rumah =" .$_GET['rumah']." ORDER BY harga ASC";
                    $query = mysqli_query($connect, $sql);
                    $data = mysqli_fetch_array($query);
                ?>
                <div class="mt-5 grid grid-cols-3 gap-5">
                    <div>
                        <input type="hidden" name="id_rumahdetail" value="<?php echo $data['id_rumahdetail']?>">
                        <label for="harga_rumah" class="font-semibold text-lg">Harga Rumah</label>
                        <input type="text" name="harga_rumah" id="harga_rumah"  class="mt-2 border-primary bg-blueMain w-full px-3 py-2 text-primary focus:outline-none focus:border-primary focus:ring-primary border-2 font-semibold placeholder-primary focus:placeholder-transparent rounded-md" value="Rp. <?php echo number_format($data['harga']) ?>" readonly> 
                    </div>
                    <?php if($data['harga_dp'] > 0){
                    ?>
                        <div>
                            <label for="harga_dp" class="font-semibold text-lg">Harga Dp</label>
                            <input type="text"  id="harga_dp"  class="mt-2 border-primary bg-blueMain w-full px-3 py-2 text-primary focus:outline-none focus:border-primary focus:ring-primary border-2 font-semibold placeholder-primary focus:placeholder-transparent rounded-md" value="Rp. <?php echo number_format($data['harga_dp']) ?>" readonly> 
                        </div>
                    <?php
                    }
                    ?>
                    <?php if($data['harga_bulanan'] > 0){
                        ?>
                        <div>
                        <label for="harga_bulanan" class="font-semibold text-lg">Harga Per Bulan</label>
                        <input type="text"  id="harga_bulanan"  class="mt-2 border-primary bg-blueMain w-full px-3 py-2 text-primary focus:outline-none focus:border-primary focus:ring-primary border-2 font-semibold placeholder-primary focus:placeholder-transparent rounded-md" value="Rp. <?php echo number_format($data['harga_bulanan']) ?>" readonly> 
                    </div>
                    <?php
                    }
                    ?>
                    <?php if($data['lama_bayar'] > 0){
                    ?>
                        <div>
                            <label for="lama_bayar" class="font-semibold text-lg">Lama Bayar</label>
                            <input type="text"  id="lama_bayar"  class="mt-2 border-primary bg-blueMain w-full px-3 py-2 text-primary focus:outline-none focus:border-primary focus:ring-primary border-2 font-semibold placeholder-primary focus:placeholder-transparent rounded-md" value="<?php echo $data['lama_bayar']?> bulan" readonly> 
                        </div>
                        <?php
                    }
                    ?>
                    <?php if($data['harga_pemesanan'] > 0){
                    ?>
                        <div>
                            <label for="harga_pemesanan" class="font-semibold text-lg">Harga Pemesanan</label>
                            <input type="text"  id="harga_pemesanan"  class="mt-2 border-primary bg-blueMain w-full px-3 py-2 text-primary focus:outline-none focus:border-primary focus:ring-primary border-2 font-semibold placeholder-primary focus:placeholder-transparent rounded-md" value="Rp. <?php echo number_format($data['harga_pemesanan'])?>,-" readonly> 
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <?php
                    }
                ?>
                <button type="submit" name="order" class="mt-10 flex ml-auto px-12 py-2 bg-primary text-lg rounded-tr-xl rounded-bl-xl font-semibold tracking-wider ease-in-out duration-300 hover:bg-blue-900 text-white">
                    Beli Rumah
                </button>
            </form>
        </div>
    </div>
</div>
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>