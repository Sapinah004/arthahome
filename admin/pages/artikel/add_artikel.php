<?php
    include("../core/artikel.php")
?>
<div class="pt-2 pb-5 px-5">
    <div class="w-full bg-white py-3 flex items-center justify-between sticky top-0">
        <div class="flex space-x-5 items-center">
            <button title="kembali ke produk" onclick="history.back()" class="px-4 py-2 bg-slate-300 hover:bg-slate-400 ease-in-out duration-300 rounded-md">
                <i class="fa-solid fa-chevron-left text-lg"></i>
            </button>
            <h1 class="font-playfair text-3xl tracking-widest font-bold">Buat Artikel</h1>
        </div>
        <div>
            <?php include("../pages/notifikasi.php");?>
        </div>
    </div>
    <div class="mt-5 w-full h-full  block overflow-auto whitespace-nowrap">
        <form method="post" enctype="multipart/form-data">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-5 lg:gap-10">
                <div>
                    <div class="p-0.5">
                        <label for="judul" name="judul" class="block font-bold">Judul</label>
                        <input id="judul" name="judul" autocomplete="off" type="text" required="required"
                            class="mt-1 w-full bg-slate-200 border-0 rounded-sm p-2 placeholder:text-sm text-black focus:outline-none focus:border focus:border-primary focus:ring-primary block focus:ring-1">                
                    </div>
                    <div class="p-0.5 mt-6">
                        <label for="gambar" name="gambar" class="block font-bold">Gambar</label>
                        <input id="gambar" name="gambar" accept="image/*" onchange="preview_image(event)" autocomplete="off" type="file" required="required"
                            class="mt-1 mb-5 w-full  bg-slate-200 border rounded-sm px-2 placeholder:text-sm text-black focus:outline-none focus:border-primary focus:ring-primary block focus:ring-1">          
                            <img id="output_image" alt="">
                    </div>
                </div>
                <div>
                    <div class="p-0.5" id="artikel">
                        <label for="artikel" class="block font-bold mb-1">Artikel</label>
                        <input type="hidden" name="artikel" required="required">
                        <div id="editor" class="min-h-[10rem] w-full bg-slate-200 border rounded-sm p-2 placeholder:text-sm text-black focus:outline-none focus:border-primary focus:ring-primary block focus:ring-1"></div>
                    </div>
                    <button type="submit" name="buat_artikel" class="flex ml-auto space-x-3 items-center px-5 py-2 mt-10 text-white bg-primary hover:bg-blue-900 ease-in-out duration-300 rounded-md">
                        <i class="fa-regular fa-floppy-disk "></i>
                        <span>Simpan</span> 
                    </button>
                </div>
            </div>
        </form>
    </div>
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