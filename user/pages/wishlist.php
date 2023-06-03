<?php
    include("./core/wishlist.php");
    if( !isset($_SESSION['loggedin']) ){
        ?>
       <script>window.location.replace("../pages/auth/login.php");</script> 
      <?php
        die;
    }
?>
<div class="pt-32 lg:pt-52 pb-24 px-5 container mx-auto max-w-5xl text-primary">
    <h1 class="text-3xl md:text-5xl font-playfair text-primary font-bold">Properti Favorit</h1>
    <p class="font-raleway md:text-lg text-slate-500 mt-3 md:mt-6 font-semibold">Daftar rumah yang telah anda tandai favorit sebelumnya</p>
    <?php
        $sql = "select tb_wishlist.*, tb_rumah.*, tb_gambar_rumah.gambar, MIN(tb_harga_rumah.harga) as harga FROM tb_wishlist LEFT JOIN tb_rumah ON tb_wishlist.id_rumah = tb_rumah.id_rumah LEFT JOIN tb_gambar_rumah ON tb_rumah.id_rumah = tb_gambar_rumah.id_rumah LEFT JOIN tb_harga_rumah ON tb_harga_rumah.id_rumah = tb_rumah.id_rumah WHERE tb_wishlist.id_user = ".$_SESSION['id_user']." GROUP BY tb_rumah.tipe ORDER BY tb_wishlist.id_wishlist DESC";
        $query = mysqli_query($connect, $sql);
        if(mysqli_num_rows($query) > 0){
            while($data = mysqli_fetch_array($query)){
    ?>
    <div class="mt-7 md:mt-12">
        <div class="p-5 bg-gray-100 shadow-xl mb-8 rounded-md">
            <div class="grid grid-cols-12 gap-y-6 lg:gap-y-0 md:space-x-5 pb-5 items-center border-b-2 border-slate-300">
                <picture class="col-span-12 md:col-span-4 place-self-center">
                    <img class="w-full h-64 object-cover rounded-md"  src=" ./../Admin/core/product/images/<?php echo $data['gambar']?>" alt="">
                </picture>
                <div class="relative col-span-12 md:col-span-8  font-raleway overflow-hidden">
                <form>
                    <a onClick="return confirm('Anda yakin ingin menghapus rumah ini dari wishlist anda ?')" href="./core/wishlist.php?hapus_wishlist=<?php echo $data['id_rumah']?>" class="absolute text-lg top-0 right-0  text-white px-4 rounded-md py-2 bg-red-500 hover:bg-red-700 hover:text-white ease-in-out duration-300">
                        <i class="fa-solid fa-trash"></i>
                    </a>
                </form>
                <div class="text-2xl md:text-3xl mb-6 text-primary font-bold">Rp <?php echo number_format($data['harga']) ?>,-</div>
                    <h1 class="text-xl md:text-2xl font-semibold">Type <?php echo $data['tipe']?></h1>
                    <p class="deskripsi mt-1 md:mt-3 line-clamp-3"><?php echo $data['deskripsi']?></p>
                    <div class="space-x-3 mt-3 text-sm font-semibold">
                        <i class="fa-solid fa-location-dot text-secondary "></i>
                        <span class="capitalize"><?php echo $data['lokasi']?></span>
                    </div>
                    <div class="mt-5 md:mt-3 flex flex-wrap gap-5 lg:space-x-5 text-sm">
                        <div class="space-x-2  flex items-center font-semibold">
                            <picture>
                                <img class="w-5" src="../assets/images/icon/width.png" alt="">
                            </picture>
                            <span><?php echo $data['luas_bangunan']?> m <sup>2</sup></span>
                        </div>
                        <div class="space-x-2 flex items-center font-semibold">
                            <picture>
                                <img class="w-5" src="../assets/images/icon/bathroom.png" alt="">
                            </picture>
                            <span><?php echo $data['kamar_mandi']?> kamar mandi</span>
                        </div>
                        <div class="space-x-2 flex items-center font-semibold">
                            <picture>
                                <img class="w-5" src="../assets/images/icon/bedroom.png" alt="">
                            </picture>
                            <span><?php echo $data['kamar_tidur']?> kamar tidur</span>
                        </div>
                        <div class="space-x-2 flex items-center font-semibold">
                            <picture>
                                <img class="w-5" src="../assets/images/icon/floor.png" alt="">
                            </picture>
                            <span><?php echo $data['jumlah_lantai']?> lantai</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full text-right py-5">
                <button class="px-5 py-2.5 text-sm md:text-base font-bold space-x-2 ease-in-out duration-300 bg-primary text-white rounded-tr-xl rounded-bl-xl hover:bg-blue-900">
                    <i class="fa-solid fa-phone"></i>
                    <span>Chat Agen</span>
                </button>
            </div>
        </div>
    </div>
    <?php
            }
        }else{
            echo 'tidak ada wishlist';
        }
    ?>
</div>
<script>
    if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>