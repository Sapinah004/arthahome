<?php
    include("../core/config.php");
    include("../core/artikel.php")
?>
<div class="pt-2 pb-5 px-5">
    <div class="w-full bg-white py-3 flex items-center justify-between sticky top-0">
        <div class="flex space-x-5 items-center">
            <button>
                <a title="list artikel" href="../pages/dashboard.php?page=artikel&id=<?php echo $_GET['id']?>" class=" px-4 py-3.5 bg-slate-300 hover:bg-slate-400 ease-in-out duration-300 rounded-md">
                    <i class="fa-solid fa-chevron-left text-lg"></i>
                 </a>
            </button>
            <h1 class="font-playfair text-3xl tracking-wider font-bold text-primary">Update Artikel</h1>
        </div>
        <div>
            <?php include("../pages/notifikasi.php");?>
        </div>
    </div>
    <?php
        $sql = "SELECT * FROM tb_artikel WHERE id_artikel=".$_GET['id'];
        $query = mysqli_query($connect, $sql);
        $data = mysqli_fetch_array($query);
    ?>
    <form action="" method="post" enctype="multipart/form-data" class="mt-6">
        <input type="hidden" name="id_artikel" value=<?php echo $data['id_artikel']?>>
        <div class="flex flex-wrap gap-8">
            <div class="w-full xl:w-[calc(50%-1rem)]">
                <div class="p-0.5">
                    <label for="judul" name="judul" class="block font-bold">Judul</label>
                    <input id="judul" name="judul" autocomplete="off" type="text" required="required" value="<?php echo $data['judul']?>"
                        class="mt-1 w-full bg-slate-200 border rounded-sm p-2 placeholder:text-sm text-black focus:outline-none focus:border-primary focus:ring-primary block focus:ring-1">                
                </div>
                <div class="p-0.5 mt-8">
                    <label for="gambar" name="gambar" class="block font-bold mb-1">Gambar</label>
                    <picture>
                        <img src="../assets/images/article/<?php echo $data['gambar']?>" alt="">
                    </picture>
                    <input id="gambar" name="gambar" accept="image/*" onchange="preview_image(event)" autocomplete="off" type="file"
                        class="mt-5 w-full bg-slate-200 border rounded-sm px-2 placeholder:text-sm text-black focus:outline-none focus:border-primary focus:ring-primary block focus:ring-1">          
                    <img id="output_image" alt="" class="mt-5">
                </div>
            </div>
            <div class="w-full xl:w-[calc(50%-1rem)]">
                <div class="p-0.5" id="artikel">
                    <label for="artikel" class="block font-bold mb-1">Artikel</label>
                    <input type="hidden" name="artikel" value="<?php echo $data['artikel']?>">
                    <div id="editor" class="min-h-[10rem] w-full bg-slate-200 border rounded-sm p-2 placeholder:text-sm text-black focus:outline-none focus:border-primary focus:ring-primary block focus:ring-1"><?php echo $data['artikel']?></div>
                </div>
            </div>
        </div>
        <button type="submit" name="update_artikel" class="flex ml-auto space-x-3 items-center px-5 py-2 mt-10 text-white bg-primary hover:bg-blue-900 ease-in-out duration-300 rounded-md">
            <i class="fa-regular fa-floppy-disk"></i>
            <span>Simpan</span> 
        </button>
    </form>
</div>
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>
    var quill = new Quill('#editor', {
        theme: 'snow',
        modules: {
            toolbar: [
                ["bold", "italic" ,"underline", "strike"],
                ["blockquote"],
                [{ list: "ordered" }, { list: "bullet" }],
                [{ script: "sub" }, { script: "super" }],
            ]
        },
    });
    quill.on('text-change', function(delta, oldDelta, source) {
        document.querySelector("input[name='artikel']").value = quill.root.innerHTML;
    });
</script>