<?php
    include('./core/forum.php');
    if( !isset($_SESSION['loggedin']) ){
        ?>
            <script>window.location.replace("./pages/auth/login.php");</script> 
        <?php
    die;
    }
?>
<div class="container mx-auto max-w-6xl px-5 pt-32 lg:pt-52 pb-24 font-yantramanav text-primary">
    <div class="lg:flex lg:justify-between items-start">
        <div>
            <h1 class="text-3xl lg:text-5xl font-semibold font-playfair">Forum Diskusi</h1>
            <p class="mt-2 lg:mt-5 tracking-wider text-lg lg:text-xl text-slate-500">Buat forum untuk memulai diskusi atau bertanya</p>
        </div>
        <button class="text-sm md:text-base flex mt-6 items-center lg:flex-none lg:mt-0 px-5 py-2.5 tracking-wider rounded-tr-xl rounded-bl-xl font-semibold text-white bg-primary hover:bg-blue-900 ease-in-out duration-300">
            <a href="./index.php?page=buat-forum"> 
                <i class="fa-solid fa-square-plus mr-2 mb-[3px]"></i>
                Mulai Diskusi
            </a> 
        </button>
    </div>
    <div class="max-w-7xl mx-auto mt-7">
        <div class="space-y-10">
            <?php
                $sql = mysqli_query($connect, "SELECT f.id_forum, f.judul, f.topik, f.tanggal , u.username, COUNT(k.komentar) AS komentar, v.id_view, v.total_view FROM tb_forum AS f LEFT JOIN tb_komentar AS k ON f.id_forum = k.id_forum JOIN tb_user u ON u.id_user = f.id_user LEFT JOIN tb_view_forum v ON f.id_forum = v.id_forum GROUP BY f.id_forum ORDER by f.tanggal DESC");
                if(mysqli_num_rows($sql) > 0){
                    while($data = mysqli_fetch_array($sql)){
            ?>
            <div class="px-4 md:px-7 py-5 md:py-10 bg-gray-100 rounded-2xl shadow-lg">
                <div class="md:flex md:space-x-5 justify-between">
                    <div>
                        <h1 class="text-2xl md:text-3xl font-playfair font-bold text-primary">
                            <?php echo $data['judul']?>
                        </h1>
                        <div class="mt-2 font-yantramanav font-medium">Diunggah pada <span><?php echo date_format(new DateTime($data['tanggal']), "d-m-Y")?></span> oleh <span class="text-secondary font-bold"><?php echo $data['username']?></span></div>
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
                    <button type="submit" name="count" class="text-sm md:text-base bg-primary px-3 lg:px-5 py-2.5 flex text-white rounded-tr-xl rounded-bl-xl hover:bg-blue-900 items-center space-x-2 ease-in-out duration-300"> 
                        <span class="font-bold">Lihat Forum</span> 
                        <i class="fa-solid fa-arrow-right-long"></i>
                    </button>
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
</div>