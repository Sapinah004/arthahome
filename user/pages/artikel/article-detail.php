<?php
    include("../core/config.php");
?>
<div class="container mx-auto max-w-6xl px-5 pt-52 pb-24 font-yantramanav">
    <?php
        $sql = "SELECT * FROM tb_artikel WHERE id_artikel=".$_GET['id'];
        $query = mysqli_query($connect, $sql);
        $data = mysqli_fetch_array($query);
    ?>
    <div class="mb-12 font-semibold text-lg tracking-wider">
        <ul class="list-none flex space-x-1">
            <li>
                <a href="../pages/index.php?page=artikel" class="hover:underline" title="list artikel">Artikel</a> 
            </li>
            <li>/</li>
            <li class="text-secondary">
                <?php echo $data['judul']?>
            </li>
        </ul>
    </div>
    <div  class="max-w-4xl mx-auto">
        <h1 class="text-3xl lg:text-5xl font-bold mb-5 text-center font-playfair">
            <?php echo $data['judul']?>
        </h1>
        <h2 class="text-xl text-center">Di unggah pada  <time ><?php echo date_format(new DateTime($data['tanggal']), "d-m-Y")?></time></h2>
        <picture>
            <img class="mt-10  mx-auto" src="../../Admin/assets/images/article/<?php echo $data['gambar']?>" alt="">
        </picture>
        <article class="text-xl mt-10">
            <?php echo $data['artikel']?>
        </article>
    </div>
</div>