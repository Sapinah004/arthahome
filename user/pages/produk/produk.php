<?php
    include('../core/config.php');
    include("../core/wishlist.php");
?>
<div class=" w-full bg-cover bg-bottom" style="background-image: linear-gradient(to right bottom, rgba(3, 43, 77, 0.3), rgba(3, 43, 77,0.3)), url('../assets/images/banner-produk.webp');" >
    <div class="pt-36 lg:pt-72 pb-24 px-5 flex space-x-5 justify-center font-semibold text-white text-3xl items-center font-playfair container mx-auto text-center">
        <a href="../pages/index.php?page=list-rumah" class="hover:underline">Produk List</a>
        <span>.</span>
        <span>Produk</span>
    </div>
</div>
<div class="py-24 px-5 container mx-auto house-picture font-yantramanav">
    <div class="product max-w-4xl mx-auto">
        <div class="swiper mySwiper2" >
            <div class="swiper-wrapper">
                <?php
                    $sql = "SELECT * FROM tb_gambar_rumah WHERE id_rumah = '".$_GET['id']."'";
                    $query = mysqli_query($connect, $sql);
                    if(mysqli_num_rows($query) > 0){
                        while($data = mysqli_fetch_array($query)){
                ?>
                    <div class="swiper-slide">
                        <img class="h-72 mx-auto w-full !object-contain object-center" src=" ../../Admin/core/product/images/<?php echo $data['gambar']?>" />
                    </div>
                <?php
                        }
                    }else{
                        echo "Tidak Ada Gambar";
                    }
                ?>
            </div>
            <div class="swiper-button-next bg-primary/75 !h-12 !w-12 rounded-full"></div>
            <div class="swiper-button-prev bg-primary/75 !h-12 !w-12 rounded-full"></div>
        </div>
        <div thumbsSlider="" class="swiper mySwiper">
            <div class="swiper-wrapper">
                <?php
                    $sql = "SELECT * FROM tb_gambar_rumah WHERE id_rumah =" .$_GET['id'];
                    $query = mysqli_query($connect, $sql);
                    if(mysqli_num_rows($query) > 0){
                        while($data = mysqli_fetch_array($query)){
                ?>
                    <div class="swiper-slide">
                        <img class="!h-36 object-cover object-center" src=" ../../Admin/core/product/images/<?php echo $data['gambar']?>" />
                    </div>
                <?php
                        }
                    }
                ?>
            </div>
        </div>
    </div>
    <?php
        $sql = "SELECT tb_rumah.*, MIN(tb_harga_rumah.harga) as harga, tb_harga_rumah.harga_pemesanan FROM tb_rumah JOIN tb_harga_rumah ON tb_rumah.id_rumah = tb_harga_rumah.id_rumah WHERE tb_rumah.id_rumah =" .$_GET['id']." GROUP BY tb_rumah.tipe;";
        $query = mysqli_query($connect, $sql);
        if(mysqli_num_rows($query) > 0){
            $data = mysqli_fetch_array($query);
            $id = $data['id_rumah'];
        }
    ?>
    <div class=" text-primary lg:flex space-x-10 w-full">
        <div class="w-4/6">
            <div class="py-6 border-b-2 border-slate-200">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="font-playfair text-3xl font-bold tracking-widest mb-4">
                            Type <?php echo $data['tipe']?>
                        </h1>
                        <div class="text-secondary capitalize flex items-center space-x-2 tracking-wider font-semibold mb-3">
                            <i class="fa-solid fa-location-dot"></i>
                            <span><?php echo $data['lokasi']?></span>
                        </div>
                        <div class="font-yantramanav text-2xl font-bold">
                            <span>Rp. <?php echo number_format($data['harga'])?></span>
                        </div>
                        <div class="font-yantramanav text-xl font-bold mt-2">
                           Harga Pemesanan : <span>Rp. <?php echo number_format($data['harga_pemesanan'])?></span>
                        </div>
                    </div>
                    <?php
                        if( isset($_SESSION['loggedin']) == true ){
                    ?>
                    <div>
                        <form method="post">
                            <input type="hidden" name="id_rumah" value="<?php echo $id?>">
                            <?php
                                $sql = "SELECT * FROM tb_wishlist WHERE id_rumah = $id AND id_user =".$_SESSION['id_user'];
                                $query = mysqli_query($connect, $sql);
                                if(mysqli_num_rows($query) == 1){
                                    $data = mysqli_fetch_array($query);
                            ?>
                            <a title="favorit" href="../core/wishlist.php?delete_wishlist=<?php echo $id?>"><i class="fa-solid fa-star text-xl"></i></a>
                            <?php
                                }else{
                                    echo '<button title="favorit" type="submit" name="addWishlist" class="text-primary"><i class="fa-regular fa-star text-xl"></i></button>';
                                }
                            ?>
                        </form>
                    </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
            <div class="py-6 border-b-2 border-slate-200">
                <h2 class="font-playfair text-3xl font-bold tracking-widest mb-4">
                    Spesifikasi
                </h2>
                <div class="font-medium">
                    <?php
                        $sql = "SELECT tb_rumah.*, MIN(tb_harga_rumah.harga) as harga FROM tb_rumah JOIN tb_harga_rumah ON tb_rumah.id_rumah = tb_harga_rumah.id_rumah WHERE tb_rumah.id_rumah =" .$_GET['id']." GROUP BY tb_rumah.tipe;";
                        $query = mysqli_query($connect, $sql);
                        $data = mysqli_fetch_array($query);
                    ?>
                    <div class="flex justify-between mb-2">
                        <span>Type Rumah</span>
                        <span>Rumah <?php echo $data['tipe']?></span>
                    </div>
                    <div class="flex justify-between mb-2">
                        <span>Kamar Mandi</span>
                        <span><?php echo $data['kamar_mandi']?> ruang</span>
                    </div>
                    <div class="flex justify-between mb-2">
                        <span>Kamar Tidur</span>
                        <span><?php echo $data['kamar_tidur']?> ruang</span>
                    </div>
                    <div class="flex justify-between mb-2">
                        <span>Luas Tanah</span>
                        <span><?php echo $data['luas_tanah']?> m <sup>2</sup></span>
                    </div>
                    <div class="flex justify-between mb-2">
                        <span>Luas Bangunan</span>
                        <span><?php echo $data['luas_bangunan']?> m <sup>2</sup></span>
                    </div>
                    <div class="flex justify-between mb-2">
                        <span>Jumlah Lantai</span>
                        <span><?php echo $data['jumlah_lantai']?> Lantai</span>
                    </div>
                    <div class="flex justify-between mb-2">
                        <span>Daya Listrik</span>
                        <span><?php echo $data['daya_listrik']?> Watt</span>
                    </div>
                </div>
            </div>
            <div class="py-6 border-b-2 border-slate-200">
                <h2 class="font-playfair font-bold text-3xl tracking-widest mb-4">
                    Fasilitas
                </h2>
                <div class="font-yantramanav columns-3 font-semibold">
                    <div class="mb-2">
                        <i class="fa-solid fa-square-check mr-3"></i>
                        <span>AC</span>
                    </div>
                    <div class="mb-2">
                        <i class="fa-solid fa-square-check mr-3"></i>
                        <span>Dapur Modern</span>
                    </div>
                    <div class="mb-2">
                        <i class="fa-solid fa-square-check mr-3"></i>
                        <span>Ventilasi yang baik</span>
                    </div>
                    <div class="mb-2">
                        <i class="fa-solid fa-square-check mr-3"></i>
                        <span>Tempat Parkir</span>
                    </div>
                    <div class="mb-2">
                        <i class="fa-solid fa-square-check mr-3"></i>
                        <span>Jalur Telepon</span>
                    </div>
                </div>
            </div>
            <div class="py-6 border-b-2 border-slate-200">
                <h3 class="font-playfair font-bold text-3xl tracking-widest mb-4">
                    Paket Harga
                </h3>
                <div class="grid grid-cols-3 gap-5">
                    <?php
                        $sql ="SELECT * FROM tb_harga_rumah  WHERE id_rumah = " .$_GET['id']. " AND harga_dp != 0 ORDER BY harga ASC";
                        $query = mysqli_query($connect, $sql);
                        if(mysqli_num_rows($query) > 0){
                            while($data = mysqli_fetch_array($query)){
                    ?>
                    <div class=" bg-white border hover:shadow-lg rounded-md shadow-black/10 p-3">
                        <div class="w-full">
                            <table class="w-full">
                                <tr>
                                    <td class="font-bold">Harga</td>
                                    <td>Rp <?php echo number_format($data['harga'])?></td>
                                </tr>
                                <tr>
                                    <td class="font-bold">Harga Dp</td>
                                    <td>Rp <?php echo number_format($data['harga_dp'])?></td>
                                </tr>
                                <tr>
                                    <td class="font-bold">Harga Bulanan</td>
                                    <td>Rp <?php echo number_format($data['harga_bulanan'])?></td>
                                </tr>
                                <tr>
                                    <td class="font-bold">Lama Bayar</td>
                                    <td><?php echo $data['lama_bayar']?> Bulan</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <?php
                            }
                        }else{
                            echo "<div>Rumah hanya dapat dibeli secara cash</div>";
                        }
                    ?>
                </div>
            </div>
            <div class="py-6 border-b-2 border-slate-200">
                <h4 class="font-playfair font-bold text-3xl tracking-widest mb-4">
                    Deskripsi
                </h4>
                <div class="font-yantramanav">
                    <?php
                        $sql = mysqli_query($connect, "SELECT * FROM tb_rumah WHERE id_rumah =" .$_GET['id']);
                        $data = mysqli_fetch_array($sql);
                    ?>
                    <p><?php echo $data['deskripsi']?></p>
                </div>
            </div>
            <div class="py-6 border-b-2 border-slate-200">
                <h5 class="font-playfair font-bold text-3xl tracking-widest mb-4">
                    Lokasi
                </h5>
                <?php
                    if($data['lokasi'] == 'batam centre'){
                       echo '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31912.4743888871!2d104.04318980413257!3d1.1176223053382806!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d988dc34cd0ecb%3A0xe373ee32cae6412!2sKec.%20Batam%20Kota%2C%20Kota%20Batam%2C%20Kepulauan%20Riau!5e0!3m2!1sid!2sid!4v1664441193144!5m2!1sid!2sid" width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>';
                    }elseif($data['lokasi'] == 'sekupang'){
                        echo '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63825.31892346204!2d103.92481998634379!3d1.1004580606991172!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d98c806c3b97a1%3A0x8e11d7cc1bdf7a81!2sKec.%20Sekupang%2C%20Kota%20Batam%2C%20Kepulauan%20Riau!5e0!3m2!1sid!2sid!4v1664440910107!5m2!1sid!2sid" width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>';
                    }elseif($data['lokasi'] == 'batu aji'){
                        echo '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63826.11948039463!2d103.90788358637174!3d1.0623870188814988!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d98d1e877d5647%3A0xd02518d7973d63c7!2sKec.%20Batu%20Aji%2C%20Kota%20Batam%2C%20Kepulauan%20Riau!5e0!3m2!1sid!2sid!4v1664440745828!5m2!1sid!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>';
                    }elseif($data['lokasi'] == 'sadai'){
                        echo '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15956.064932205596!2d104.03486023595373!3d1.1488918900330853!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d989afde4a507d%3A0x1d42119eb0cf6685!2sSadai%2C%20Kec.%20Bengkong%2C%20Kota%20Batam%2C%20Kepulauan%20Riau!5e0!3m2!1sid!2sid!4v1664440841328!5m2!1sid!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>';
                    }elseif($data['lokasi'] == 'nongsa'){
                        echo '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d127651.03284509064!2d104.02239797841911!3d1.0911892705704256!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d985dcce261ca7%3A0xfb4e44587d08a42!2sKecamatan%20Nongsa%2C%20Kota%20Batam%2C%20Kepulauan%20Riau!5e0!3m2!1sid!2sid!4v1664440969658!5m2!1sid!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>';
                    }elseif($data['lokasi'] == 'tanjung uma'){
                        echo '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15956.142084661098!2d103.98642578595432!3d1.134993440298933!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d98bcdf122c8cf%3A0xdf2887c23b1c0bc!2sTj.%20Uma%2C%20Kec.%20Lubuk%20Baja%2C%20Kota%20Batam%2C%20Kepulauan%20Riau!5e0!3m2!1sid!2sid!4v1664441039980!5m2!1sid!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>';
                    }elseif($data['lokasi'] == 'tembesi'){
                        echo '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63827.11194950742!2d103.97542453640816!3d1.0132056293961895!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d991f42a17d44b%3A0x7ffeba608961d22a!2sTembesi%2C%20Kec.%20Sagulung%2C%20Kota%20Batam%2C%20Kepulauan%20Riau!5e0!3m2!1sid!2sid!4v1664442410161!5m2!1sid!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>';
                    }
                ?>
            </div>
        </div>
        <div class="lg:sticky lg:top-28 h-fit max-w-sm w-2/6">
            <div class="mt-6 p-6 bg-gray-100 rounded-md">
                <h4 class="font-playfair text-3xl tracking-widest mb-2">
                    Kontak Agen
                </h4>
                <div class="flex space-x-3 items-center">
                    <i class="fa-solid fa-user-tie"></i>
                    <span class="text-lg font-yantramanav font-semibold text-primary">Andi Saputra</span>
                </div>
                <button class="px-3 mt-4 w-full flex-none py-2 font-yantramanav bg-green-600 hover:bg-green-800 ease-in-out duration-500 text-white rounded-lg">
                    <i class="fa-brands fa-whatsapp mr-2"></i>    
                    Whatsapp
                </button>
            </div>
            <a href="../pages/index.php?page=checkout&rumah=<?php echo $data['id_rumah']?>">
                <button class="px-5 py-3 w-full bg-primary hover:bg-blue-900 text-white text-lg font-semibold font-yantramanav rounded-tr-xl rounded-bl-xl mt-6 ease-in-out duration-300">
                    Beli Sekarang
                </button>
            </a>
        </div>
    </div>
</div>
<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>

<!-- Initialize Swiper -->
<script>
    var swiper = new Swiper(".mySwiper", {
        spaceBetween: 10,
        slidesPerView: 4,
        freeMode: true,
        watchSlidesProgress: true,
    });
    var swiper2 = new Swiper(".mySwiper2", {
        spaceBetween: 10,
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
        thumbs: {
          swiper: swiper,
        },
    });
</script>
    