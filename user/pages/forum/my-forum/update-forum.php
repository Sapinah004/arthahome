<?php
    include('../core/forum.php');
    $sql = "SELECT * FROM tb_forum WHERE id_forum =" .$_GET['id'];
    $query = mysqli_query($connect, $sql);
    $data = mysqli_fetch_array($query);
?>
<div class="pt-32 lg:pt-52 pb-24 px-5 text-primary container font-yantramanav mx-auto max-w-4xl">
    <a class=" text-secondary font-semibold text-xl" href="../pages/index.php?page=forum-detail&id=<?php echo $data['id_forum']?>">
        <i class="fa-solid fa-arrow-left-long mr-2"></i>
        <span class="hover:underline underline-offset-4 "> Kembali ke forum</span>
    </a>
    <h1 class="text-xl md:text-4xl font-playfair font-bold mt-6 md:mt-12">
        Update Forum Anda
    </h1>
    <div class="mt-3 md:mt-7 bg-gray-100 p-4 md:p-7 rounded-xl">
        <form method="post">
            <div>
                <input type="hidden" name="id_forum" value="<?php echo $data['id_forum']?>">
                <label for="judul" class="font-raleway font-semibold after:content-['*'] after:text-3xl after:text-secondary ">Judul Topik</label>
                <input id="judul" autocomplete="off" name="judul" class="text-lg w-full px-3 py-2 bg-gray-200 border-0 rounded-md mt-2 mb-8 focus:border-0 focus:outline-0 focus:outline-none focus:border-primary focus:ring-primary block focus:ring-2 focus:shadow-md" type="text" value="<?php echo $data['judul']?>">
            </div>
            <div>
                <label for="topik" class="font-raleway font-semibold after:content-['*'] after:text-3xl after:text-secondary">Topik / Pertanyaan</label>
                <textarea id="topik" name="topik" class="text-lg w-full px-3 py-2 bg-gray-200 border-0 rounded-md mt-2 focus:border-0 focus:outline-0 focus:outline-none focus:border-primary focus:ring-primary block focus:ring-2 focus:shadow-md" name="topik" id="" cols="30" rows="7"><?php echo $data['topik']?></textarea>
            </div>
            <button type="submit" name="updateForum" class="tracking-wider px-5 py-2 items-center space-x-2 flex ml-auto mt-8 rounded-tr-xl rounded-bl-xl ease-in-out duration-300 bg-primary hover:bg-blue-900 text-white">
                <i class="fa-solid fa-floppy-disk"></i>
                <span class="font-bold mt-1">Simpan</span> 
            </button>
        </form>
    </div>
</div>