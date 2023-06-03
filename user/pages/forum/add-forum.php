<?php
    include('./core/forum.php');
?>
<div class="pt-32 lg:pt-52 pb-24 px-5 container mx-auto max-w-4xl font-yantramanav">
    <a class="text-secondary font-semibold text-xl" href="./index.php?page=list-forum">
        <i class="fa-solid fa-arrow-left-long mr-2"></i>
        <span class="hover:underline underline-offset-4 ">Kembali ke forum</span>
    </a>
    <h1 class="text-3xl md:text-5xl font-playfair font-bold mb-3 mt-7 md:mt-12">
        Buat Forum Anda
    </h1>
    <p class="text-slate-500 text-lg">
        Buat pertanyaan atau topik yang ingin anda tanyakan / diskusikan
    </p>
    <div class="mt-5 text-primary bg-gray-100 p-4 md:p-7 rounded-xl">
        <form method="post">
            <div>
                <label for="judul" class="font-semibold after:content-['*'] after:ml-1 after:text-secondary ">Judul Topik</label>
                <input id="judul" required="required" autocomplete="off" name="judul" class="text-lg w-full px-3 py-2 bg-gray-200 rounded-md mt-2 border-0 mb-8 focus:border-0 focus:outline-0 focus:outline-none focus:border-primary focus:ring-primary block focus:ring-2" type="text" placeholder="Masukkan judul topik anda">
            </div>
            <div>
                <label for="topik" class="font-semibold after:content-['*'] after:ml-1 after:text-secondary">Topik / Pertanyaan</label>
                <textarea id="topik" required="required" name="topik" class="text-lg w-full px-3 py-2 bg-gray-200 border-0 rounded-md mt-2 focus:border-0 focus:outline-0 focus:outline-none focus:border-primary focus:ring-primary block focus:ring-2" name="topik" id="" cols="30" rows="7" placeholder="Masukkan topik atau pertanyaan yang ingin didiskusikan"></textarea>
            </div>
            <button type="submit" name="unggahTopik" class="px-5 items-center py-2.5 flex ml-auto mt-8 rounded-tr-xl rounded-bl-xl ease-in-out duration-300 bg-primary hover:bg-blue-900 text-white">
                <span class="font-bold">Unggah Topik</span>
                <i class="fa-solid fa-paper-plane text-sm ml-2"></i>
            </button>
        </form>
    </div>
</div>
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>