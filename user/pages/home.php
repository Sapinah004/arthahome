<?php
    include("../core/config.php");
?>
<section>
    <div id="home" class="relative font-yantramanav bg-[url('../../assets/images/home/banner.jpg')] lg:bg-none bg-cover bg-center h-[45rem] lg:h-[65rem] flex items-center">
        <div class="absolute w-full h-full bg-slate-600/70 lg:hidden"></div>    
        <div class="px-5 py-12 lg:p-0 z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 z-50 h-full">
                <div class="relative hidden lg:block">
                    <picture>
                        <img class="h-[65rem] object-cover object-center w-full" src="../assets/images/home/banner.jpg" alt="gambar banner">
                    </picture>
                    <div class="absolute top-0 w-full h-full bg-black/10"></div>
                    <picture class="absolute top-1/2 -translate-y-1/2 -right-12">
                        <img class="w-[60rem]" src="../assets/images/home/home-picture.jpg" alt="gambar banner">
                    </picture>
                </div>
                <div class="lg:px-24 text-white lg:text-primary place-self-center text-center lg:text-left">
                    <h1 class="font-playfair text-4xl lg:text-5xl font-bold tracking-wider">Artha Home Developer Property</h1>
                    <p class=" mt-8 text-lg lg:text-xl">
                    Artha Home hadir untuk membantu Anda menemukan rumah impian yang sesuai dengan kebutuhan dan keinginan Anda. Dengan berbagai pilihan rumah berkualitas dan harga yang terjangkau, kami yakin dapat membantu mewujudkan impian Anda untuk memiliki rumah sendiri.
                    </p>
                    <button >
                        <a href="../pages/index.php?page=list-rumah" class="mx-auto lg:mx-0 flex space-x-2 items-center mt-8 px-7 tracking-wider font-semibold py-2.5 bg-secondary  lg:bg-primary rounded-tr-xl rounded-bl-xl hover:bg-yellow-600 lg:hover:bg-blue-900  text-white  ease-in-out duration-300">
                        <span>Lihat Rumah</span> 
                        <i class="fa-solid fa-arrow-right-long"></i>
                        </a>
                    </button>
                </div>
            </div>
        </div> 
    </div>
</section>
<!-- About Us -->
<section class="relative">
    <picture>
        <img class="relative ml-auto top-0 h-80 lg:h-[30rem] w-full lg:w-4/5 object-cover object-center" src="../assets/images/home/home-aboutus.jpg" alt="gambar perumahan">
    </picture>
    <div id="tentang-kami" class="container mx-auto px-5 font-yantramanav">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 text-primary">
            <div class="py-24 place-self-center">
                <h1 class="font-playfair text-xl tracking-widest font-bold mb-2 text-secondary">Tentang Kami</h1>
                <h2 class="text-4xl font-playfair font-semibold ">Temukan Rumah Impian Anda</h2>
                <p class="mt-5  text-lg lg:text-xl">
                    Artha Home bergerak dalam bidang Pengembang Properti di Batam - Indonesia. Proyek proyek  kami berada di lokasi yang strategis di Batam. Kami mengutamakan kualitas bangunan dan selalu mengikuti tren terkini.
                </p>
                <button class="flex items-center space-x-3 mt-5 px-5 py-2.5 rounded-tr-xl rounded-bl-xl bg-primary text-white  font-semibold ease-in-out duration-300 hover:bg-blue-900">
                    <i class="fa-solid fa-phone"></i>    
                    <span>Hubungi Kami</span> 
                </button>
            </div>
            <div class="relative bg-primary ml-auto w-11/12 h-[40rem] hidden lg:block">
                <picture class="absolute top-1/2 -translate-y-1/2 -left-14 pr-16 ">
                    <img src="../assets/images/home/about-company.jpg" alt="tentang perusahaan">
                </picture>
            </div>
        </div>
    </div>
</section>
<!-- Shop -->
<section  class="mt-8 lg:mt-48 bg-primary relative font-yantramanav">
    <div id="beli-rumah" class="container mx-auto  lg:px-5">
        <div class="grid grid-cols-1 lg:grid-cols-2 lg:gap-12">
            <picture class="lg:ml-auto -mt-16 lg:-mt-48">
                <img class="w-full  h-full " src="../assets/images/home/picture.png" alt="gambar rumah">
            </picture>
            <div class="flex flex-wrap gap-6 py-20 px-5 lg:px-0 text-left">
                <h1 class="text-2xl font-playfair text-white">Kami menawarkan berbagai tipe rumah di berbagai lokasi di kota Batam</h1>
                <button>
                    <a href="" class="px-4 md:px-5 py-2.5 text-sm md:text-base tracking-wider flex space-x-3 font-semibold items-center text-white bg-secondary hover:bg-yellow-500 rounded-tr-xl rounded-bl-xl ease-in-out duration-300">
                    <span>Lihat Rumah</span> 
                    <i class="fa-solid fa-arrow-right-long "></i>
                    </a>
                </button>
            </div>
        </div>
    </div>
</section>
<!-- Fasilitas -->
<section id="fasilitas">
    <div  class="px-5 py-24 container mx-auto overflow-hidden font-yantramanav">
        <h1 class="text-4xl lg:text-5xl font-playfair font-bold text-primary text-center">Fasilitas Kami</h1>
        <p class="mt-5 text-raleway text-center text-lg">Kami selalu memberikan fasilitas terbaik pada setiap perumahan untuk meningkatkan kenyamanan anda</p>
        <div class="swiperFacilities w-full h-full swiper mySwiper  mt-12 pb-12">
            <div class="swiper-wrapper">
                <div class="relative group !w-80 md:!w-[28rem] !h-80 swiper-slide">
                    <picture>
                        <img class="block w-full h-full object-cover" src="../assets/images/home/facilities/security.webp" alt="security">
                    </picture>
                    <div class="absolute w-full h-full flex justify-center opacity-0 ease-in-out duration-700 group-hover:opacity-100 text-4xl tracking-widest font-playfair font-bold items-center bg-black/80 top-0 left-0 text-white">
                        Security
                    </div>
                </div>
                <div class="relative group !w-80 md:!w-[28rem] !h-80 swiper-slide">
                    <picture>
                        <img class="block w-full h-full object-cover" src="../assets/images/home/facilities/cctv.webp" alt="cctv">
                    </picture>
                    <div class="absolute w-full h-full flex justify-center opacity-0 ease-in-out duration-700 group-hover:opacity-100 text-4xl tracking-widest font-playfair font-bold items-center bg-black/80 top-0 left-0 text-white">
                        CCTV
                    </div>
                </div>
                <div class="relative group !w-80 md:!w-[28rem] !h-80 swiper-slide">
                    <picture>
                        <img class="block w-full h-full object-cover" src="../assets/images/home/facilities/gate-access.webp" alt="gerbang satu akses">
                    </picture>
                    <div class="absolute w-full h-full flex justify-center opacity-0 ease-in-out duration-700 group-hover:opacity-100 text-4xl tracking-widest font-playfair font-bold items-center bg-black/80 top-0 left-0 text-white">
                        Akses Satu Gerbang
                    </div>
                </div>
                <div class="relative group !w-80 md:!w-[28rem] !h-80 swiper-slide">
                    <picture>
                        <img class="block w-full h-full object-cover" src="../assets/images/home/facilities/playground.webp" alt="taman bermain">
                    </picture>
                    <div class="absolute w-full h-full flex justify-center opacity-0 ease-in-out duration-700 group-hover:opacity-100 text-4xl tracking-widest font-playfair font-bold items-center bg-black/80 top-0 left-0 text-white">
                        Taman Bermain
                    </div>
                </div>
                <div class="relative group !w-80 md:!w-[28rem] !h-80 swiper-slide">
                    <picture>
                        <img class="block w-full h-full object-cover" src="../assets/images/home/facilities/drainage-system.jpg" alt="drainase yang bagus">
                    </picture>
                    <div class="absolute w-full h-full flex justify-center opacity-0 ease-in-out duration-700 group-hover:opacity-100 text-4xl tracking-widest font-playfair font-bold items-center bg-black/80 top-0 left-0 text-white">
                        Drainase Yang Bagus
                    </div>
                </div>
                <div class="relative group !w-80 md:!w-[28rem] !h-80 swiper-slide">
                    <picture>
                        <img class="block w-full h-full object-cover" src="../assets/images/home/facilities/garden.webp" alt="taman">
                    </picture>
                    <div class="absolute w-full h-full flex justify-center opacity-0 ease-in-out duration-700 group-hover:opacity-100 text-4xl tracking-widest font-playfair font-bold items-center bg-black/80 top-0 left-0 text-white">
                        Taman
                    </div>
                </div>
                <div class="relative group !w-80 md:!w-[28rem] !h-80 swiper-slide">
                    <picture>
                        <img class="block w-full h-full object-cover" src="../assets/images/home/facilities/garden-cleaner.webp" alt="petugas kebersihan">
                    </picture>
                    <div class="absolute w-full h-full flex justify-center opacity-0 ease-in-out duration-700 group-hover:opacity-100 text-4xl tracking-widest font-playfair font-bold items-center bg-black/80 top-0 left-0 text-white">
                        Petugas Kebersihan
                    </div>
                </div>
                <div class="relative group !w-80 md:!w-[28rem] !h-80 swiper-slide">
                    <picture>
                        <img class="block w-full h-full object-cover" src="../assets/images/home/facilities/underground.webp" alt="sistem bawah tanah">
                    </picture>
                    <div class="absolute w-full h-full flex justify-center opacity-0 ease-in-out duration-700 group-hover:opacity-100 text-4xl tracking-widest font-playfair font-bold items-center bg-black/80 top-0 left-0 text-white">
                        Sistem Bawah Tanah
                    </div>
                </div>
            </div>
            <div class="swiper-button-next bg-primary/75 !h-12 !w-12 rounded-full"></div>
            <div class="swiper-button-prev bg-primary/75 !h-12 !w-12 rounded-full"></div>
            <div class="swiper-scrollbar"></div>
        </div>
    </div>
</section>
<section id="galeri" class="relative">
    <div class="lightBox fixed top-0 left-0 bg-black/60 w-full h-full z-[100] hidden">
        <div class="relative">
            <div class="lightBox_content fixed max-w-4xl w-full h-[600px] top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 rounded-md">
                <div class="relative ease-in-out duration-300">
                    <div class="showImg h-full w-full">
                        <div class="image max-w-4xl w-full h-full max-h-[600px] ">
                            <img class="w-full h-full object-contain" src="" alt="">
                        </div>
                    </div>
                    <button class="absolute top-5 right-5 bg-primary hover:bg-blue-900 pt-1 w-10 h-10 rounded-md">
                        <i class="fas fa-times close text-2xl text-white cursor-pointer absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="image-gallery w-full">
        <div class="w-full h-full swiper swiperGallery mySwiper">
            <div id="gallery" class="swiper-wrapper">
                <div class="image !w-96 !h-96 swiper-slide">
                    <div id="gallery" class="overflow-hidden w-full h-full">
                        <img class="gImg cursor-pointer hover:scale-105 ease-in-out duration-300 w-full h-full object-cover object-center" src="../assets/images/home/gallery/house-area-2.jpg" alt="galleri 1">
                    </div>
                </div>
                <div class="image !w-96 !h-96 swiper-slide">
                    <div id="gallery" class="overflow-hidden  w-full h-full">
                        <img class="gImg cursor-pointer hover:scale-105 ease-in-out duration-300 w-full h-full object-cover object-center" src="../assets/images/home/gallery/kitchen-3.webp" alt="galleri 2">
                    </div>
                </div>
                <div class="image !w-96 !h-96 swiper-slide">
                    <div id="gallery" class="overflow-hidden w-full h-full">
                        <img class="gImg cursor-pointer hover:scale-105 ease-in-out duration-300 w-full h-full object-cover object-center" src="../assets/images/home/gallery/bedroom-2.webp" alt="galleri 3">
                    </div>
                </div>
                <div class="image !w-96 !h-96 swiper-slide">
                    <div id="gallery" class="overflow-hidden w-full h-full">
                        <img class="gImg cursor-pointer w-full h-full hover:scale-105 ease-in-out duration-300 object-cover object-center" src="../assets/images/home/gallery/bathroom.webp" alt="galleri 4">
                    </div>
                </div>
                <div class="image !w-96 !h-96 swiper-slide">
                    <div id="gallery" class="overflow-hidden w-full h-full">
                        <img class="gImg cursor-pointer w-full h-full hover:scale-105 ease-in-out duration-300 object-cover object-center" src="../assets/images/home/gallery/bedroom.webp" alt="galleri 5">
                    </div>
                </div>
                <div class="image !w-96 !h-96 swiper-slide">
                    <div id="gallery" class="overflow-hidden w-full h-full">
                        <img class="gImg cursor-pointer w-full h-full hover:scale-105 ease-in-out duration-300 object-cover object-center" src="../assets/images/home/gallery/house-area-3.jpg" alt="galleri 6">
                    </div>
                </div>
                <div class="image !w-96 !h-96 swiper-slide">
                    <div id="gallery" class="overflow-hidden w-full h-full">
                        <img class="gImg cursor-pointer w-full h-full hover:scale-105 ease-in-out duration-300 object-cover object-center" src="../assets/images/home/gallery/living-room-3.webp" alt="galleri 7">
                    </div>
                </div>
                <div class="image !w-96 !h-96 swiper-slide">
                    <div id="gallery" class="overflow-hidden w-full h-full">
                        <img class="gImg cursor-pointer w-full h-full hover:scale-105 ease-in-out duration-300 object-cover object-center" src="../assets/images/home/gallery/kitchen-2.webp" alt="galleri 8">
                    </div>
                </div>
                <div class="image !w-96 !h-96 swiper-slide">
                    <div id="gallery" class="overflow-hidden w-full h-full">
                        <img class="gImg cursor-pointer w-full h-full hover:scale-105 ease-in-out duration-300 object-cover object-center" src="../assets/images/home/gallery/living-room-2.webp" alt="galleri 9">
                    </div>
                </div>
                <div class="image !w-96 !h-96 swiper-slide">
                    <div id="gallery" class="overflow-hidden w-full h-full">
                        <img class="gImg cursor-pointer w-full h-full hover:scale-105 ease-in-out duration-300 object-cover object-center" src="../assets/images/home/gallery/house-area.webp" alt="galleri 10">
                    </div>
                </div>
                <div class="image !w-96 !h-96 swiper-slide">
                    <div id="gallery" class="overflow-hidden w-full h-full">
                        <img class="gImg cursor-pointer w-full h-full hover:scale-105 ease-in-out duration-300 object-cover object-center" src="../assets/images/home/gallery/living-room.webp" alt="galleri 11">
                    </div>
                </div>
                <div class="image !w-96 !h-96 swiper-slide">
                    <div id="gallery" class="overflow-hidden w-full h-full">
                        <img class="gImg cursor-pointer w-full h-full hover:scale-105 ease-in-out duration-300 object-cover object-center" src="../assets/images/home/gallery/kitchen.webp" alt="galleri 12">
                    </div>
                </div>
                <div class="image !w-96 !h-96 swiper-slide">
                    <div id="gallery" class="overflow-hidden w-full h-full">
                        <img class="gImg cursor-pointer w-full h-full hover:scale-105 ease-in-out duration-300 object-cover object-center" src="../assets/images/home/gallery/wardrobe.webp" alt="galleri 13">
                    </div>
                </div>
                <div class="image !w-96 !h-96 swiper-slide">
                    <div id="gallery" class="overflow-hidden w-full h-full">
                        <img class="gImg cursor-pointer w-full h-full hover:scale-105 ease-in-out duration-300 object-cover object-center" src="../assets/images/home/gallery/jogging-area.jpg" alt="galleri 14">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="blog">
    <div class="px-5 py-24 container mx-auto font-yantramanav">
        <h1 class="text-center font-playfair mb-12 font-bold text-5xl text-primary">Artikel & Blog</h1>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 gap-y-12">
            <?php
                $sql = "SELECT * FROM tb_artikel GROUP BY tanggal DESC LIMIT 3";
                $query = mysqli_query($connect, $sql);
                if(mysqli_num_rows($query) > 0){
                    while($data = mysqli_fetch_array($query)){
            ?>
                <div>
                    <div class="relative">
                        <picture>
                            <img class="rounded-sm w-full h-72 object-cover object-center " src="../../Admin/assets/images/article/<?php echo $data["gambar"]?>" alt="<?php echo $data["judul"]?>">
                        </picture>
                        <div class="bg-secondary tracking-widest py-2 px-5 w-fit absolute bottom-0 translate-y-1/2 right-8 text-white rounded-md">
                            <?php echo date_format(new DateTime($data['tanggal']), "d-m-Y")?>
                        </div>
                    </div>
                    <div class="shadow-xl pb-7 px-5 rounded-xl">
                        <h1 class="text-xl font-playfair mt-10 font-bold line-clamp-2"><?php echo $data["judul"]?></h1>
                        <button >
                            <a href="../pages/index.php?page=artikel-detail&id=<?php echo $data['id_artikel']?>"  class="px-5 py-2.5 mt-6 flex space-x-3 rounded-tr-xl rounded-bl-xl tracking-wider items-center  rounded-sm bg-secondary hover:bg-yellow-500 text-white  ease-in-out duration-300">
                                <span>Selengkapnya</span>
                                <i class="fa-solid fa-angle-right"> </i> 
                            </a>
                        </button>
                    </div>
                </div>
            <?php
                    }
                }else{
                    echo '<div class="font-bold text-xl text-center font-playfair">Tidak ada artikel</div>';
                }
            ?>
        </div> 
        <div class="group mt-12 flex w-fit ml-auto overflow-hidden relative items-center space-x-3 hover:text-secondary ease-in-out duration-500 text-2xl font-semibold">
            <a  href="../pages/index.php?page=artikel" >Semua Artikel</a>
            <i class="fa-solid fa-arrow-right-long text-lg"></i>
            <span class="absolute bottom-0 left-0 !ml-0 w-48 h-0.5 bg-secondary -translate-x-full ease-in-out duration-500 group-hover:translate-x-0"></span>
        </div>
    </div>
</section>
<!-- Announcement -->
 <section>
    <div class="container mx-auto px-5 pb-24 font-yantramanav">
        <h1 class="text-center font-playfair text-5xl font-bold text-primary">Pengumuman</h1>
        <p class="mt-3 font-semibold  text-lg lg:text-xl text-center">
            Dapatkan informasi terbaru mengenai rumah impian anda
        </p>
        <div class="columns-1 md:columns-2 lg:columns-3 space-x-5 space-y-5 mt-12 cursor-pointer">
            <?php
                include('../core/config.php');
                $i = 0;
                $sql = "SELECT * FROM tb_pengumuman";
                $query = mysqli_query($connect, $sql);
                if(mysqli_num_rows($query) > 0){
                    while($data = mysqli_fetch_array($query)){
                        $x = $i++;
            ?>
            <div class="break-inside-void" data-modal-toggle="medium-modal<?php echo $x?>">
                <img src=" ../../Admin/core/announcement/images/<?php echo $data['gambar']?>" alt="<?php echo $data['gambar']?>" />
            </div>
            <div id="medium-modal<?php echo $x?>" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 p-4 w-full md:inset-0 h-modal md:h-full">
                <div class="relative w-full max-w-xl max-h-[33rem] overflow-y-auto">
                    <div class="relative  bg-white shadow">
                        <div class="absolute top-0 right-0 p-3 ">
                            <button type="button" class="text-white bg-primary hover:bg-blue-900 rounded-lg text-sm p-2 ml-auto inline-flex items-center" data-modal-toggle="medium-modal<?php echo $x?>">
                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                <span class="sr-only">Close modal</span> 
                            </button>
                        </div>
                        <picture>
                            <img src=" ../../Admin/core/announcement/images/<?php echo $data['gambar']?>" alt="<?php echo $data['gambar']?>" />
                        </picture>
                    </div>
                </div>
            </div>
            <?php
                    }
                }else{
                    echo '<div>Tidak ada pengumuman</div>';
                }
            ?>
        </div>
    </div>
 </section>

            
 <!-- Contact Us -->
 <section>
    <div class="bg-blueMain h-36 w-full mt-36 font-yantramanav">
        <div class="container mx-auto  relative bg-primary px=5 lg:px-7 py-20 lg:py-24 -top-28">
            <div class="grid grid-cols-1 gap-y-6 lg:gap-y-0 md:grid-cols-2 lg:grid-cols-4 lg:divide-x text-white">
                <div class="px-3">
                    <h1 class="font-playfair text-xl tracking-wider">Hubungi Kami</h1>
                    <p class="mt-1 text-sm tracking-wider">Kunjungi kantor kami, atau hubungi kami kapan saja untuk mendiskusikan rumah impian anda</p>
                </div>
                <div class="flex items-center space-x-5 pr-3">
                    <div class="w-16">
                        <img class="w-16" src="../assets/images/icon/maps.png" alt="ikon peta">
                    </div>
                    <div class="text-sm">
                        Nicco Residence Blok A3A no.9, Bengkong, Batam
                    </div>
                </div>
                <div class="flex items-center space-x-5 px-3">
                    <div class="w-14">
                        <img class="w-12" src="../assets/images/icon/email.png" alt="ikon email">
                    </div>
                    <div class="text-sm">
                        csarthahome@gmail.com
                    </div>
                </div>
                <div class="flex items-center space-x-5 px-3">
                    <div class="w-14">
                        <img class="w-14" src="../assets/images/icon/phone.png" alt="ikon telephone">
                    </div>
                    <div class="text-sm">
                        (+62) 8523 9232 059
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>




