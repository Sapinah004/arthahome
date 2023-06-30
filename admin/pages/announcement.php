<?php
    include('../core/announcement/announcement.php');
?>
<div class="sticky top-0 px-5 py-6 bg-white flex justify-between space-x-5">
    <h1 class="font-playfair text-3xl tracking-widest font-bold text-primary">Poster Pengumuman</h1>
    <div>
        <?php include("../pages/notifikasi.php")?>
    </div>
</div>
<div class="overflow-auto px-5 mt-1 text-primary font-raleway">
    <h2 class="text-2xl font-bold font-playfair">Upload Poster</h2>
    <form method="post" enctype="multipart/form-data">
        <div class="lg:flex space-y-2 lg:space-y-0 lg:space-x-2 items-center mt-5">
            <div class="lg:w-1/2">
                <input id="gambar" type="file" name="gambar[]" required="required" multiple class="w-full block rounded-sm bg-slate-200 px-2 text-sm text-slate-500
                    file:mr-4 file:py-1 file:px-4 file:rounded-sm file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-primary hover:file:bg-violet-100" />
            </div>
            <button type="submit" name="addAnnouncement" class="flex-none px-5 py-2 rounded-md bg-primary hover:bg-blue-900 ease-in-out duration-200 text-white">
                <i class="fa-solid fa-upload mr-2"></i>
                Upload
            </button>
        </div>
        <i class="font-semibold text-sm">Mohon upload gambar dengan format png, jpg, jpeg, atau webp dengan ukuran maksimal 5MB</i>
    </form>
    <h3 class="mt-10 font-playfair text-2xl font-bold mb-6 tracking-wider">Poster</h3>
    <div class="columns-1 md:columns-2 lg:columns-3 gap-5 space-y-5">
        <?php
            $sql_getAnnouncement = mysqli_query($connect, "SELECT * FROM tb_pengumuman") ;
            if(mysqli_num_rows($sql_getAnnouncement) > 0){
                while($data = mysqli_fetch_assoc($sql_getAnnouncement)){
                    $id = $data['id_announcement'];
                    $gambar = $data['gambar']
        ?>
        <div class="break-inside-avoid p-3 bg-slate-200 rounded-md shadow-lg">
            <picture>
                <img src="../core/announcement/images/<?php echo $gambar?>" alt="<?php echo $gambar?>">
            </picture>
            <div class="flex justify-between items-center mt-3">
                <span class="font-bold"><?php echo $data['gambar']?></span>
                <a onClick="return confirm('Anda yakin ingin menghapus pengumuman ini?')" href="../core/announcement/announcement.php?delete_image=<?php echo $id?>" class="px-3 py-2 bg-red-600 hover:bg-red-700 text-white rounded-md ease-in-out duration-200">
                    <i class="fa-regular fa-trash-can"></i>
                </a>
            </div>
        </div>
        <?php
                }
            }
            else{
                echo '<div class="font-bold italic text-slate-500">Tidak ada poster</div';
            }
        ?>
    </div>
</div>
