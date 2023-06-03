<?php
    include ("./core/config.php");
?>
<div class="container mx-auto max-w-5xl pt-32 lg:pt-52 pb-24 px-5 text-primary font-yantramanav">
    <h1 class="text-3xl md:text-4xl font-playfair font-semibold">Forum Diskusi Saya</h1>
    <p class="mt-3 font-semibold text-lg text-slate-500 mb-5">List forum yang anda buat</p>
    <div class="">
        <?php
            $sql = "SELECT f.id_forum, f.judul, v.total_view, f.topik, f.tanggal , u.username, COUNT(k.komentar) AS komentar, v.total_view FROM tb_forum AS f LEFT JOIN tb_komentar AS k ON f.id_forum = k.id_forum JOIN tb_user u ON u.id_user = f.id_user LEFT JOIN tb_view_forum v ON v.id_forum = f.id_forum WHERE f.id_user = ".$_SESSION['id_user']." GROUP BY f.id_forum ORDER by f.tanggal DESC";
            $query = mysqli_query($connect, $sql);
            if(mysqli_num_rows($query) > 0){
                while($data = mysqli_fetch_array($query)){
        ?>
        <div class="px-4 md:px-7 py-5 md:py-10 bg-gray-100 rounded-2xl shadow-lg mb-8">
                <div class="md:flex md:space-x-5 justify-between">
                    <div>
                        <h1 class="text-2xl md:text-3xl font-playfair font-bold text-primary">
                            <?php echo $data['judul']?>
                        </h1>
                        <div class="mt-2 font-yantramanav font-medium tracking-wider">Diunggah pada <span class="text-secondary"><?php echo date_format(new DateTime($data['tanggal']), "d-m-Y")?></span> </div>
                    </div>
                    <div class="mt-2 lg:mt-0 flex space-x-8 text-primary">
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
                            <span><?php echo $data['komentar']?></span>
                        </div>
                    </div>
                </div>
                <p class="mt-3 md:mt-5 text-xl"> <?php echo $data['topik']?> </p>
                <form method="post" class="flex justify-end mt-3">
                    <input type="hidden" name="id_forum" value="<?php echo $data['id_forum']?>">
                    <a href="./index.php?page=forum-detail&id=<?php echo $data['id_forum']?>" class="text-sm md:text-base bg-primary px-3 lg:px-5 py-2.5 flex text-white rounded-tr-xl rounded-bl-xl hover:bg-blue-900  items-center space-x-2 ease-in-out duration-300"> 
                        <span class="font-bold">Lihat Forum</span> 
                        <i class="fa-solid fa-arrow-right-long"></i>
                    </a>
                </form>
            </div>
        <?php
                }
            }
            else{
                echo '<div class="font-bold">Tidak ada Forum</div>';
            }
        ?>
    </div>
</div>