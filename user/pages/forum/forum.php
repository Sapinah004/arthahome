<?php
    include('./core/forum.php');
?>
<div class="pt-32 lg:pt-52 pb-24 px-5 container mx-auto  font-yantramanav">
    <?php
        $sql ="SELECT f.id_forum, f.update_at, f.judul, f.topik, f.tanggal , u.username, COUNT(k.komentar) AS komentar, v.total_view FROM tb_forum AS f LEFT JOIN tb_komentar AS k ON f.id_forum = k.id_forum JOIN tb_user u ON u.id_user = f.id_user LEFT JOIN tb_view_forum v ON v.id_forum = f.id_forum WHERE f.id_forum = " .$_GET['id'];
        $query = mysqli_query($connect, $sql);
        $data = mysqli_fetch_array($query);
    ?>
    <div class="flex space-x-3 text-lg mb-6 md:mb-12">
        <span class="text-primary font-semibold hover:underline">
            <a href="./index.php?page=list-forum">Diskusi</a>
        </span>
        <span class="text-slate-500"> / </span>
        <span class="text-slate-500"><?php echo $data['judul']?></span>
    </div>
    <div class="grid grid-cols-12 gap-y-16 lg:gap-y-0 lg:gap-12 xl:gap-16">
        <div class="col-span-12 lg:col-span-8">
            <div class="pb-12 border-b-2 border-slate-500">
                <h1 class="text-2xl md:text-3xl font-bold font-playfair text-primary mb-4 md:mb-8">
                    <?php echo $data['judul']?>
                </h1>
                <div class="md:flex justify-between items-end mb-8">
                    <div class="flex flex-none space-x-4 items-center">
                        <div class="p-2 w-12 h-12 rounded-full bg-primary border-2 border-white">
                            <img src="../assets/images/user-picture.png" alt="">
                        </div>
                        <div>
                            <h2 class="text-secondary font-bold text-lg"><?php echo $data['username']?></h2>
                            <div class="text-slate-500 ">Diunggah pada <?php echo date_format(new DateTime($data['tanggal']), "d/m/Y")?> <span>Pukul <?php echo date_format(new DateTime($data['tanggal']), "H:i") ?></span></div>
                        </div>
                    </div>
                    <div class="mt-5 flex justify-end md:justify-start space-x-5 text-primary">
                        <div>
                            <i class="fa-solid fa-eye mr-2"></i>
                            <?php
                                if($data['total_view'] > 0){
                                    echo $data['total_view'];
                                }else{
                                    echo '0';
                                }
                            ?>
                        </div>
                        <div class="space-x-2">
                            <i class="fa-solid fa-comment"></i>
                            <span><?php echo $data["komentar"]?></span>
                        </div>
                    </div>
                </div>
                <div class="text-lg">
                    <?php echo $data['topik']?>
                </div>
                <div class="mt-6 text-slate-500 italic text-right">
                    Terakhir diedit pada <?php echo date_format(new DateTime($data['update_at']), "d/m/Y")?> <span>Pukul <?php echo date_format(new DateTime($data['update_at']), "H:i") ?></span> 
                </div>
            </div>
            <div>
                <?php
                    $sql = "SELECT tb_komentar.id_komentar, tb_komentar.id_forum, tb_komentar.tanggal, tb_komentar.komentar, tb_komentar.id_user, tb_user.username FROM tb_komentar JOIN tb_user ON tb_komentar.id_user = tb_user.id_user WHERE id_forum =" .$_GET['id']. " ORDER BY tanggal DESC";
                    $query = mysqli_query($connect, $sql);
                    if(mysqli_num_rows($query) > 0){
                        while($data = mysqli_fetch_array($query)){
                ?>
                <div class="mt-6 p-3 bg-gray-100 rounded-md mb-5 shadow">
                    <div class="flex space-x-6 items-center mb-3">
                        <div class="flex-none p-2 w-10 h-10 rounded-full bg-primary border-2 border-white">
                            <img src="./assets/images/user-picture.png" alt="">
                        </div>
                        <div>
                            <h2 class="text-secondary font-bold"><?php echo $data['username']?></h2>
                            <div class="text-slate-500 ">
                                Diunggah pada <?php echo date_format(new DateTime($data['tanggal']), "d/m/Y")?> <span>Pukul <?php echo date_format(new DateTime($data['tanggal']), "H:i") ?></span>
                            </div>
                        </div>
                    </div>
                    <div>
                        <p>
                            <?php echo $data['komentar']?>
                        </p>
                    </div>
                </div>
                <?php
                        }
                    }
                    else{
                        echo '<div class="font-bold mt-8 italic text-slate-500 tracking-wider">Belum ada komentar</div>';
                    }
                ?>
                <form method="POST">
                    <div class="w-full mt-10">
                        <label for="komentar" class="text-primary">
                            <i class="fa-solid fa-comment mr-1"></i>
                            <span class="font-medium">Tulis Komentar</span>
                        </label>
                        <textarea id="komentar" name="komentar" required="required" class="mt-3 w-full border rounded-md focus:border-0 focus:outline-0 focus:outline-none focus:border-primary focus:ring-primary block focus:ring-2" name="komentar" id="" cols="30" rows="5" placeholder="Masukkan komentar anda disini"></textarea>
                        <button type="submit" name="unggahKomentar" class="px-5 tracking-wider space-x-3 items-center py-2.5 bg-primary mt-3 text-white rounded-tr-xl rounded-bl-xl ml-auto flex hover:bg-blue-900 ease-in-out duration-300">
                            <span class="font-bold">Unggah</span> 
                            <i class="fa-solid fa-paper-plane text-sm"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-span-12 lg:col-span-4">
            <div class="sticky top-36 p-5 md:p-8 bg-primary rounded-xl md:mb-8">
                <h3 class="text-2xl md:text-3xl mb-16 md:mb-24 font-playfair text-white font-semibold tracking-widest">
                    Ada pertanyaan yang ingin didiskusikan?
                </h3>
                <button class="px-6 py-2.5 flex items-center bg-white hover:bg-secondary ease-in-out duration-300 rounded-tr-xl rounded-bl-xl text-primary font-semibold">
                    <i class="fa-solid fa-square-plus mr-2 mb-1"></i>
                    <a href="./index.php?page=buat-forum">Buka Forum</a>
                </button>
            </div>
        </div>
    </div>
</div>
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>