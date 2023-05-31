<?php
    include('../core/config.php');
    include('../core/forum.php');
?>
<div class="pt-32 lg:pt-52 pb-24 px-5 container mx-auto font-yantramanav max-w-6xl">
    <?php
        $sql ="SELECT f.id_forum, f.judul, f.topik, f.tanggal, v.total_view, f.update_at, u.username, COUNT(k.komentar) AS komentar FROM tb_forum AS f LEFT JOIN tb_komentar AS k ON f.id_forum = k.id_forum JOIN tb_user u ON u.id_user = f.id_user LEFT JOIN tb_view_forum AS v ON v.id_forum = f.id_forum WHERE  f.id_forum = " .$_GET['id'];
        $query = mysqli_query($connect, $sql);
        $data = mysqli_fetch_array($query);
    ?>
    <div class="flex space-x-3 text-lg mb-8 md:mb-12">
        <span class="text-primary font-semibold hover:underline">
            <a href="../pages/index.php?page=forum-saya">Diskusi</a>
        </span>
        <span class="text-slate-500"> / </span>
        <span class="text-slate-500"><?php echo $data['judul']?></span>
    </div>
    <div>
        <div class="pb-12 border-b-2 border-slate-500">
            <div class="flex flex-wrap gap-x-7 justify-between items-start">
                <h1 class="text-2xl md:text-3xl font-bold font-playfair text-primary mb-5 md:mb-8">
                    <?php echo $data['judul']?>
                </h1>
                <div class=" flex space-x-4 mb-6 text-sm md:text-base">
                    <a href="../pages/index.php?page=update-forum&id=<?php echo $data['id_forum']?>" class="px-5 pt-2 pb-[6px] space-x-2 items-center bg-green-500 hover:bg-green-700 rounded-tr-xl rounded-bl-xl text-white ease-in-out duration-300">
                        <i class="fa-solid fa-pen-to-square"></i>
                        <span class="tracking-wider">Edit</span> 
                    </a>
                    <a onClick="return confirm('Anda yakin ingin menghapus forum ini ?')" href="../core/forum.php?hapus_forum=<?php echo $data['id_forum']?>" class="px-5 pt-2 pb-[6px] space-x-2 bg-red-600 hover:bg-red-700 rounded-tr-xl rounded-bl-xl ease-in-out duration-300 text-white">
                        <i class="fa-solid fa-trash-can"></i>   
                        <span>Hapus</span> 
                    </a>
                </div>
            </div>
            <div class="md:flex justify-between items-end mb-8">
                <div class="flex space-x-4 items-center">
                    <div class="flex-none p-2 w-12 h-12 rounded-full bg-primary border-2 border-white">
                        <img src="../assets/images/user-picture.png" alt="foto pengguna">
                    </div>
                    <div>
                        <h2 class="text-secondary font-bold text-lg"><?php echo $data['username']?></h2>
                        <div class="text-slate-500 ">
                            Diunggah pada <?php echo date_format(new DateTime($data['tanggal']), "d/m/Y")?> <span>Pukul <?php echo date_format(new DateTime($data['tanggal']), "H:i") ?></span>
                        </div>
                    </div>
                </div>
                <div class="mt-5 flex justify-end md:justify-start space-x-5 text-primary">
                    <div class="space-x-2">
                        <i class="fa-solid fa-eye"></i>
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
            <div class="text-slate-500 text-right mt-12 italic">
                Diperbarui pada <?php echo date_format(new DateTime($data['update_at']), "d/m/Y")?> <span>Pukul <?php echo date_format(new DateTime($data['update_at']), "H:i") ?></span>
            </div>
        </div>
        <div>
            <?php
                $sql = "SELECT tb_komentar.id_komentar, tb_komentar.id_forum, tb_komentar.tanggal, tb_komentar.komentar, tb_komentar.id_user, tb_user.username FROM tb_komentar JOIN tb_user ON tb_komentar.id_user = tb_user.id_user WHERE id_forum =" .$_GET['id']. " ORDER BY tanggal DESC";
                $query = mysqli_query($connect, $sql);
                if(mysqli_num_rows($query) > 0){
                    while($data = mysqli_fetch_array($query)){
            ?>
            <div class="mt-6 p-3 bg-gray-100 rounded-md mb-3 shadow">
                <div class="flex space-x-6 items-center mb-3">
                    <div class="p-2 flex-none w-10 h-10 rounded-full bg-primary border-2 border-white">
                        <img src="../assets/images/user-picture.png" alt="">
                    </div>
                    <div>
                        <h2 class="text-secondary font-bold"><?php echo $data['username']?></h2>
                        <div class="text-slate-500 ">
                            Diunggah pada <?php echo date_format(new DateTime($data['tanggal']), "d/m/Y")?> <span>Pukul <?php echo date_format(new DateTime($data['tanggal']), "H:i") ?></span>
                        </div>
                    </div>
                </div>
                <div>
                    <?php echo $data['komentar']?>
                </div>
            </div>
            <?php
                    }
                }
                else{
                    echo '<div class="font-bold py-6 text-slate-500 italic">Tidak ada komentar</div>';
                }
            ?>
            <form  method="post">
                <div class="w-full mt-10 text-primary">
                    <label for="komentar" class="mt-12">
                        <i class="fa-solid fa-comment text-primary mr-3"></i>
                        <span class="font-semibold">Tulis Komentar</span>
                    </label>
                    <textarea id="komentar" name="komentar" class="mt-3 w-full border-2 rounded-md focus:border-0 focus:outline-0 focus:outline-none focus:border-primary focus:ring-primary block focus:ring-2 border-primary" name="komentar" id="" cols="30" rows="5" placeholder="Masukkan komentar anda disini"></textarea>
                    <button type="submit" name="unggahKomentar" class="px-5 py-2.5 items-center bg-primary tracking-wider text-white mt-5 rounded-tr-xl rounded-bl-xl ml-auto flex hover:bg-blue-900 ease-in-out duration-300">
                        <span class="font-bold">Unggah</span> 
                        <i class="fa-solid fa-paper-plane ml-3 text-sm "></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>