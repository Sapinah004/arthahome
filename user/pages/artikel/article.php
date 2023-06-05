<?php
    include("./core/config.php");
?>
<div class="container mx-auto px-5 pt-52 pb-24 font-yantramanav">
    <h1 class="text-center text-5xl font-playfair text-primary font-bold">Blog & Artikel</h1>
    <p class="mt-3 text-center text-xl font-semibold">Kumpulan artikel, berita, tips & trick khusus untuk anda</p>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 gap-y-12 mt-16">
        <?php
            $sql = mysqli_query($connect, "SELECT * FROM tb_artikel GROUP BY tanggal DESC");
            if(mysqli_num_rows($sql) > 0){
                while($data = mysqli_fetch_array($sql)){
        ?>
        <div>
            <div class="relative">
                <picture>
                    <img class="rounded-sm w-full h-72 object-cover object-center " src="./../Admin/assets/images/article/<?php echo $data["gambar"]?>" alt="<?php echo $data["judul"]?>">
                </picture>
                <div class="bg-secondary py-2 px-5 tracking-widest w-fit absolute bottom-0 translate-y-1/2 right-8 text-white rounded-md">
                    <?php echo date_format(new DateTime($data['tanggal']), "d-m-Y")?>
                </div>
            </div>
            <div class="shadow-xl pb-7 px-5 rounded-xl">
                <h1 class="text-xl font-playfair mt-10 font-bold line-clamp-2"><?php echo $data["judul"]?></h1>
                <button>
                    <a href="./index.php?page=artikel-detail&id=<?php echo $data['id_artikel']?>"  class="px-5 py-2.5 mt-6 flex space-x-3 rounded-tr-xl rounded-bl-xl tracking-wider items-center rounded-sm bg-secondary hover:bg-yellow-500 text-white ease-in-out duration-300">
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
</div>