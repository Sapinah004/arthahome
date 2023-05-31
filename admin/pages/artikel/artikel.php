<?php
    include("../core/artikel.php");
?>
<div class="pt-2 pb-5 px-5">
    <div class="w-full bg-white py-3 flex items-center justify-between sticky top-0">
    <div class="flex space-x-5 items-center">
            <button>
                <a title="list artikel" href="../pages/dashboard.php?page=artikel-list" class=" px-4 py-3.5 bg-slate-300 hover:bg-slate-400 ease-in-out duration-300 rounded-md">
                    <i class="fa-solid fa-chevron-left text-lg"></i>
                </a>
            </button>
            <h1 class="font-playfair text-3xl tracking-wider font-bold text-primary">Blog & Artikel</h1>
        </div>
        <div>
            <?php include("../pages/notifikasi.php");?>
        </div>
    </div>
    <?php
        $sql_addArtikel = mysqli_query($connect, "SELECT * FROM tb_artikel WHERE id_artikel=".$_GET['id']);
        $data = mysqli_fetch_array($sql_addArtikel);
    ?>
    <a href="../pages/dashboard.php?page=update-artikel&id=<?php echo $data['id_artikel']?>">
        <button class="mt-5 px-5 py-2 rounded-md bg-green-500 hover:bg-green-700 ease-in-out duration-200 text-white">
            <i class="fa-regular fa-pen-to-square mr-2"></i>
            Edit Data
        </button>
    </a>
    <div class="mt-5 max-w-3xl mx-auto">
        <div class="mx-auto">
            <picture>
                <img src="../assets/images/article/<?php echo $data['gambar']?>" alt="<?php echo $data['judul']?>">
            </picture>
        </div>
        <div>
            <h2 class="text-2xl font-bold font-playfair capitalize mt-5">
                <?php echo $data['judul']?>
            </h2>
        </div>
        <div class="mt-5">
            <?php echo $data['artikel']?>
        </div>
    </div>
</div>
