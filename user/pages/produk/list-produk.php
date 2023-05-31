<?php
    
    include("../core/config.php");
?>
<section>
    <div id="home" class="relative h-full bg-white w-full before:content-[''] before:z-10 before:absolute before:top-0 before:right-0 before:h-full before:w-1/2  before:bg-blueMain">
        <div class="grid grid-cols-1 lg:grid-cols-2 text-primary">
            <div class="px-5 pt-36 lg:pt-52 lg:pb-24 lg:pl-36 lg:pr-12 z-20 w-full place-self-center">
                <h1 class="text-5xl font-playfair font-bold text-center lg:text-left tracking-wider">Temukan Rumah Impian Anda</h1>
                <p class="mt-8 font-yantramanav font-semibold text-center lg:text-left text-slate-500">Artha Home terdapat dibeberapa wilayah dikota batam sehingga mempermudah anda untuk mendapatkan hunian yang anda impikan</p>
                <button class=" space-x-3 items-center mt-12 px-5 py-2.5 flex mx-auto lg:mx-0 rounded-tr-xl rounded-bl-xl bg-primary hover:bg-blue-900 font-semibold text-white  ease-in-out duration-300">
                    <i class="fa-solid fa-phone"></i>    
                    <span>Hubungi Kami</span> 
                </button>
            </div>
            <div class="lg:pt-44 z-20">
                <picture class="z-20">
                    <img class="w-full h-full bg-cover brightness-110" src="../assets/images/bg-shop.webp" alt="banner shop">
                </picture>
            </div>
        </div>
    </div>
</section>
<!-- Filter -->
<section>
    <div class="px-5 pb-24 font-yantramanav container mx-auto w-full -mt-9 relative z-20">
        <div class="p-12 font-yantramanav lg:mx-24 bg-gray-100 rounded-2xl shadow-xl border border-primary/40">
            <form action="" method="post"  enctype="multipart/form-data" autocomplete="off">
                <div class="flex items-end space-x-5 w-full">
                    <select  name="filter" id="underline_select" class=" border-primary font-medium block py-2.5 px-2 w-1/3  text-gray-500 bg-transparent border-0 border-b-2  appearance-none  focus:outline-none focus:ring-0 focus:border-primary/50 peer">
                        <option value="lokasi">Lokasi</option>
                        <option value="tipe">Tipe Rumah</option>
                        <option value="jumlah_lantai">Jumlah Lantai</option>
                    </select>
                    <div class="w-full pl-5 border-l-2 border-primary/50">
                        <input type="text" name="data" placeholder="cari lokasi atau tipe rumah impian anda" class="w-full border-b-2 bg-transparent border-transparent border-b-primary text-lg focus:border-0 focus:outline-0 focus:outline-none focus:border-b-primary focus:rounded-md focus:ring-primary block focus:ring-2">
                    </div>
                    <button type="submit" name="submit" class=" py-2 px-5 flex space-x-3  font-bold ease-in-out duration-300 items-center justify-center  bg-primary hover:bg-blue-900 rounded-tr-xl rounded-bl-xl text-white">
                        <i class="fa-solid fa-magnifying-glass text-lg"></i> 
                        <span class="tracking-widest">Cari</span>   
                    </button>
                </div>
            </form>
        </div>
            <?php
                if(isset($_POST['submit'])){
                    $data = mysqli_real_escape_string($connect, $_POST['data']); 
                    $filter = mysqli_real_escape_string($connect, $_POST['filter']);
                
                    if($filter == "" || ($filter != "lokasi" && $filter != "tipe" && $filter != "jumlah_lantai"))
                    $filter = "lokasi";
            ?>
            <div class="grid grid-cols-3 gap-6 mt-12">
                
                <?php
                    $sql = "SELECT tb_rumah.* , tb_gambar_rumah.*, MIN(tb_harga_rumah.harga) as harga FROM tb_rumah LEFT JOIN tb_gambar_rumah ON tb_rumah.id_rumah = tb_gambar_rumah.id_rumah LEFT JOIN tb_harga_rumah ON tb_harga_rumah.id_rumah = tb_rumah.id_rumah WHERE $filter LIKE '%$data%' GROUP BY tb_rumah.id_rumah";
                    $query = mysqli_query($connect, $sql);
                    if(mysqli_num_rows($query) > 0){
                        while($data = mysqli_fetch_array($query)){
                ?>
                <div class="hover:scale-[1.01] transition-all duration-300">
                <a href="../pages/index.php?page=produk&id=<?php echo $data['id_rumah']?>" >
                            <picture>
                                <img class="shadow-xl w-full h-56 object-cover object-center" src=" ../../Admin/core/product/images/<?php echo $data['gambar']?>"  alt="tipe <?php echo $tipe?>">
                            </picture>
                            <div class="rounded-md py-3 px-5  text-primary">
                                <h1 class="font-playfair text-xl font-bold tracking-wider">Type <?php echo $data['tipe']?></h1>
                                <div class="flex space-x-2 text-secondary mt-2 items-center text-sm">
                                    <i class="fa-solid fa-location-dot"></i>
                                    <span class="font-semibold capitalize"><?php echo $data['lokasi']?></span>
                                </div>
                                <div class="mt-3 flex">
                                    <div class="basis-1/2 flex space-x-2 items-center">
                                        <picture>
                                            <img class="w-5" src="../assets/images/icon/width.png" alt="">
                                        </picture>
                                        <span><?php echo $data['luas_tanah']?> m <sup>2</sup></span>
                                    </div>
                                    <div class="basis-1/2 flex space-x-2 items-center">
                                        <picture>
                                            <img class="w-5" src="../assets/images/icon/bathroom.png" alt="">
                                        </picture>
                                        <div>
                                            <?php echo $data['kamar_mandi']?> kamar mandi
                                        </div>
                                    </div>
                                </div>
                                <div class="flex mt-2 items-center">
                                    <div class="basis-1/2 flex space-x-2 items-center">
                                        <picture>
                                            <img class="w-5" src="../assets/images/icon/bedroom.png" alt="">
                                        </picture>
                                        <div>
                                        <?php echo $data['kamar_tidur']?> kamar tidur
                                        </div>
                                    </div>
                                    <div class="basis-1/2 flex space-x-2 items-center">
                                        <picture>
                                            <img class="w-5" src="../assets/images/icon/floor.png" alt="">
                                        </picture>
                                        <div>
                                        <?php echo $data['jumlah_lantai']?> lantai
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3 pt-3 border-t border-primary text-2xl font-bold">
                                    Rp. <?php echo number_format($data['harga'])?>
                                </div>
                            </div>
                            </a>
                            
                        </div>
                <?php
                        }
                    }else{
                        ?>
                        <div class="col-span-3">
                            <picture>
                                <img class="w-1/2 mx-auto" src="../assets/images/no-data.jpg" alt="">
                            </picture>
                            <div class="font-bold tracking-wider font-playfair text-xl text-secondary text-center">
                                Maaf, Data yang anda cari tidak ditemukan
                            </div>
                        </div>
                        <?php
                    }
                ?>
            </div>
            <?php
                } else{
            ?>
            <section>
                <div id="rumah" class="container mx-auto px-5 py-24">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12 ">
                        <?php
                            $sql = "SELECT tb_rumah.* , tb_gambar_rumah.*, MIN(tb_harga_rumah.harga) as harga FROM tb_rumah LEFT JOIN tb_gambar_rumah ON tb_rumah.id_rumah = tb_gambar_rumah.id_rumah LEFT JOIN tb_harga_rumah ON tb_harga_rumah.id_rumah = tb_rumah.id_rumah GROUP BY tb_rumah.id_rumah";
                            $query = mysqli_query($connect, $sql);
                            if(mysqli_num_rows($query) > 0){
                                while($data = mysqli_fetch_array($query)){
                                    $id = $data['id_rumah'];
                                    $tipe = $data['tipe'];
                                    $lokasi = $data['lokasi'];
                                    $luas_tanah = $data['luas_tanah'];
                                    $kamar_tidur = $data['kamar_tidur'];
                                    $kamar_mandi = $data['kamar_mandi'];
                                    $jumlah_lantai = $data['jumlah_lantai'];
                                    $deskripsi = $data['deskripsi'];
                                    $harga = $data['harga'];
                                    $gambar = $data['gambar'];
                        ?>
                        <!-- <div>
                            <a href="../pages/index.php?page=produk&id=<?php echo $id?>">
                                <div class="drop-shadow-[10px_7px_5px_#00000033] group cursor-pointer hover:scale-[1.01] transition-all duration-300">
                                    <picture>
                                        <img class="rounded-tr-[3rem] w-full h-60 2xl:h-72 object-cover object-center" src=" ../../Admin/core/product/images/<?php echo $gambar?>" alt="">
                                    </picture>
                                    <div class="bg-white p-5 rounded-bl-[3rem]">
                                        <h1 class="font-playfair text-2xl text-primary font-bold group-hover:underline">Tipe <?php echo $tipe?></h1>
                                        <p class="mt-3 font-yantramanav truncate"><?php echo $deskripsi?></p>
                                        <div class="grid grid-cols-2 mt-3 mb-1">
                                            <div class="py-2  flex items-center space-x-2">
                                                <i class="fa-regular fa-square-full"></i>
                                                <span><?php echo $luas_tanah?> m <sup>2</sup></span>
                                            </div>
                                            <div class="py-2  flex items-center space-x-2">
                                                <i class="fa-solid fa-bed"></i>
                                                <span><?php echo $kamar_tidur?> ruang</span>
                                            </div>
                                            <div class="py-2  flex items-center space-x-2">
                                                <i class="fa-solid fa-bath"></i>
                                                <span><?php echo $kamar_mandi?> ruang</span>
                                            </div>
                                            <div class="py-2 flex items-center space-x-2">
                                                <i class="fa-solid fa-building"></i>
                                                <span><?php echo $jumlah_lantai?> tingkat</span>
                                            </div>
                                        </div>
                                        <div class="pt-3  border-t-2 border-primary">
                                            <span class="font-playfair text-2xl font-bold">Rp. <?php echo number_format($harga)?></span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div> -->
                        <div class="hover:scale-[1.01] transition-all duration-300">
                            <a href="../pages/index.php?page=produk&id=<?php echo $id?>" >
                            <picture>
                                <img class="shadow-xl w-full h-56 object-cover object-center" src=" ../../Admin/core/product/images/<?php echo $gambar?>"  alt="tipe <?php echo $tipe?>">
                            </picture>
                            <div class="rounded-md py-3 px-5  text-primary">
                                <h1 class="font-playfair text-xl font-bold tracking-wider">Type <?php echo $tipe?></h1>
                                <div class="flex space-x-2 text-secondary mt-2 items-center text-sm">
                                    <i class="fa-solid fa-location-dot"></i>
                                    <span class="font-semibold capitalize"><?php echo $lokasi?></span>
                                </div>
                                <div class="mt-3 flex">
                                    <div class="basis-1/2 flex space-x-2 items-center">
                                        <picture>
                                            <img class="w-5" src="../assets/images/icon/width.png" alt="">
                                        </picture>
                                        <span><?php echo $luas_tanah?> m <sup>2</sup></span>
                                    </div>
                                    <div class="basis-1/2 flex space-x-2 items-center">
                                        <picture>
                                            <img class="w-5" src="../assets/images/icon/bathroom.png" alt="">
                                        </picture>
                                        <div>
                                            <?php echo $kamar_mandi?> kamar mandi
                                        </div>
                                    </div>
                                </div>
                                <div class="flex mt-2 items-center">
                                    <div class="basis-1/2 flex space-x-2 items-center">
                                        <picture>
                                            <img class="w-5" src="../assets/images/icon/bedroom.png" alt="">
                                        </picture>
                                        <div>
                                        <?php echo $kamar_tidur?> kamar tidur
                                        </div>
                                    </div>
                                    <div class="basis-1/2 flex space-x-2 items-center">
                                        <picture>
                                            <img class="w-5" src="../assets/images/icon/floor.png" alt="">
                                        </picture>
                                        <div>
                                        <?php echo $jumlah_lantai?> lantai
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3 pt-3 border-t border-primary text-2xl font-bold">
                                    Rp. <?php echo number_format($harga)?>
                                </div>
                            </div>
                            </a>
                            
                        </div>
                        <?php
                                }
                            }else{
                                echo '<div class="font-bold">Tidak Ada</div>';
                            }
                        ?>
                    </div>
                </div>
            </section>
        <?php
            }
        ?>
    </div>
</section>
<!-- Kontak Agen -->
<section id="agen" class="relative bg-fixed bg-cover bg-center bg-no-repeat bg-[url('../../assets/images/bg-kontak-agen.webp')]">
    <div class="absolute w-full h-full bg-primary/70"></div>
    <div class="px-5 py-24 container mx-auto font-playfair text-center text-white relative z-10">
        <span class="text-lg tracking-wider">Jangan ragu untuk menghubungi kami</span>
        <h1 class="mt-5 text-5xl font-bold">Buat Janji Temu Sekarang</h1>
        <h2 class="mt-8 text-3xl tracking-wider">(+62) 85829480594</h2>
        <button class="mt-12 px-5 font-yantramanav font-bold py-2.5 rounded-tr-xl text-white rounded-bl-xl bg-secondary hover:bg-yellow-500 tracking-widest  ease-in-out duration-300">
            <i class="fa-solid fa-phone"></i>
            Hubungi Kami
        </button>
    </div>
</section>
<!-- Forum -->
<section>
    <div id="forum" class="container mx-auto px-5 py-24 text-primary">
        <div class="grid grid-cols-12 gap-6">
            <div class="col-span-12 lg:col-span-5 place-self-center">
                <h1 class="font-playfair font-bold  text-5xl">Forum Diskusi</h1>
                <p class="mt-8 font-yantramanav text-lg font-semibold">Masih bingung? diskusi atau tanyakan pertanyaan anda pada forum diskusi</p>
                <button class="mt-8 px-5 font-bold py-2.5 bg-primary hover:bg-blue-900 ease-in-out duration-300 text-white rounded-tr-xl rounded-bl-xl">
                    <a class="flex items-center space-x-3" href="../pages/index.php?page=list-forum">
                        <span>Lihat Forum</span> 
                        <i class="fa-solid fa-arrow-right-long mt-1"></i>
                    </a>  
                </button>
            </div>
            <div class="col-span-12 lg:col-span-7">
                <img class="w-full" src="../assets/images/home/forum.jpg" alt="">
            </div>
        </div>
    </div>
</section>
