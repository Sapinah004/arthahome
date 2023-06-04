<?php
  session_start();
  include('./core/function.php');
    include('./core/config.php');
?>
<nav class="nav fixed z-30 w-full bg-blueMain lg:bg-transparent py-5 font-yantramanav lg:py-20 px-5">
    <div class="padding-navbar container mx-auto  flex flex-wrap items-center justify-between">
        <a href="./index.php">
            <img class="w-48" src="./assets/images/logo-vertical.png" alt="">
        </a>
        <div class="page-header hidden lg:block">
            <ul class="list-none flex gap-16 tracking-wider text-primary font-bold text-lg ">
                <li class="group relative overflow-hidden">
                    <a href="./index.php">Home</a>
                    <span class="absolute bottom-0 left-0 w-36 h-0.5 bg-primary -translate-x-full group-hover:-translate-x-0  ease-out duration-500"></span>
                </li>
                <li class="group relative overflow-hidden">
                    <a href="./index.php?page=artikel">Artikel</a>
                    <span class="absolute bottom-0 left-0 w-36 h-0.5 bg-primary -translate-x-full group-hover:-translate-x-0  ease-out duration-500"></span>
                </li>
                <li class="group relative overflow-hidden">
                    <a href="./index.php?page=list-rumah">Beli Rumah</a>
                    <span class="absolute bottom-0 left-0 w-36 h-0.5 bg-primary -translate-x-full group-hover:-translate-x-0  ease-out duration-500"></span>
                </li>
                <li class="group relative overflow-hidden">
                    <a href="./index.php?page=list-forum">Forum</a>
                    <span class="absolute bottom-0 left-0 w-36 h-0.5 bg-primary -translate-x-full group-hover:-translate-x-0  ease-out duration-500"></span>
                </li>
                <li class="group relative overflow-hidden">
                    <a href="./index.php?page=wishlist">Wishlist</a>
                    <span class="absolute bottom-0 left-0 w-36 h-0.5 bg-primary -translate-x-full group-hover:-translate-x-0  ease-out duration-500"></span>
                </li>
            </ul>
        </div>
        <div class="flex items-center space-x-3 lg:space-x-5">
            <?php
                if(isset($_SESSION['loggedin']) == true){
            ?>
             <?php
                $sql = "SELECT tb_user.*, tb_pesanan.*, tb_notifikasi.*, (SELECT lokasi FROM tb_rumah JOIN tb_pesanan ON tb_rumah.id_rumah = tb_pesanan.id_rumah WHERE tb_pesanan.id_order = tb_notifikasi.id_order) as lokasi FROM tb_notifikasi JOIN tb_pesanan ON tb_notifikasi.id_order = tb_pesanan.id_order JOIN tb_user ON tb_pesanan.id_user = tb_user.id_user WHERE tb_notifikasi.status = 0 AND tb_notifikasi.tipe_notifikasi NOT IN (0,1,2) AND tb_user.id_user = ".$_SESSION['id_user']." ORDER BY tb_notifikasi.tanggal DESC;";
                $query = mysqli_query($connect, $sql);
                $count = mysqli_num_rows($query);
            ?>
            <button id="dropdownAvatarNameButton" data-dropdown-toggle="dropdownNotification" class="relative px-3 py-1.5 rounded-md hover:bg-primary/10 focus:bg-primary/10 ease-in-out duration-200" type="button">
                <i class="fa-solid fa-bell text-2xl text-primary"></i>
                <?php
                if($count > 0){
            ?>
            <span class="absolute -top-1 -right-2 w-4 h-4 text-white bg-red-600 rounded-full text-xs ">
                <?php echo $count?>
            </span>
            <?php
                }
            ?>
            </button>
                <div id="dropdownNotification" class="hidden divide-y-2 p-3 z-10 w-80 max-h-96 shadow-lg bg-gray-50 border rounded-md">
                    <div class="text-2xl tracking-wide text-primary font-bold pb-1">
                        Notifikasi
                    </div>
                    <div class="py-2 overflow-y-scroll max-h-72">
                    <?php 
                if(mysqli_num_rows($query) > 0){
                    while($data = mysqli_fetch_array($query)){
                        if($data['tipe_notifikasi'] == 3){
            ?>
                <div class="text-sm p-2 hover:bg-slate-100 rounded-md ease-in-out duration-300">
                    <a href="./core/notifikasi.php?notifikasi=<?php echo $data['id_notifikasi']?>" class="">
                        <div>
                           Artha Home telah menerima bukti pembayaran yang telah anda unggah untuk rumah tipe <?php echo $data['tipe']?> lokasi <?php echo $data['lokasi']?>
                        </div>
                        <time class="text-sm text-slate-300">
                            <?php echo date_format(new DateTime($data['tanggal']), "d-m-Y, H:i") ?>
                        </time>
                    </a>
                </div>
            <?php
                        }
                        elseif($data['tipe_notifikasi']== 4){
                            ?>
                             <div class="text-sm p-2 hover:bg-slate-100 rounded-md ease-in-out duration-300">
                    <a href="./core/notifikasi.php?notifikasi=<?php echo $data['id_notifikasi']?>" class="">
                        <div>
                           Artha Home menolak bukti pembayaran yang telah anda unggah untuk rumah tipe <?php echo $data['tipe']?> lokasi <?php echo $data['lokasi']?>. Harap cek kembali bukti pembayaran anda
                        </div>
                        <time class="text-sm text-slate-300">
                            <?php echo date_format(new DateTime($data['tanggal']), "d-m-Y, H:i")?>
                        </time>
                    </a>
                </div>
                            <?php
                        }
                    }
                    
                }     else{
                    echo "Tidak ada notifikasi";
                }  
            ?>
                    </div>
                    <div class="pt-3">
                        <button>
                            <a href="./index.php?page=notifikasi" class="px-3 py-1.5 text-sm rounded-md bg-primary hover:bg-blue-900 ease-in-out duration-300 text-white">
                                Lihat Semua
                            </a>    
                        </button>
                    </div>
                </div>
                <?php
                }
                ?>
            <?php
                if(isset($_SESSION['loggedin']) == true){
            ?>
            <div class="hidden lg:block">
                <button id="dropdownAvatarNameButton" data-dropdown-toggle="dropdownAvatarName" class="flex items-center text-sm font-medium text-gray-900 rounded-full hover:text-blue-600 dark:hover:text-blue-500 md:mr-0 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:text-white" type="button">
                    <span class="sr-only">Open user menu</span>
                    <div class="w-12 h-12 p-2 rounded-full bg-primary border-2 border-white cursor-pointer">
                        <img src="./assets/images/user-picture.png" alt="">
                    </div>
                </button>
                <div id="dropdownAvatarName" class="hidden p-3 z-10 w-60 shadow-lg bg-white border rounded-md  dark:bg-gray-700 dark:divide-gray-600">
                    <div class="p-2 border-b border-primary flex space-x-3 items-center">
                        <div class=" w-10 h-10 flex justify-center items-center  rounded-full bg-primary">   
                            <img class="p-2" src="./assets/images/user-picture.png" alt="">
                        </div>
                        <div class="text-lg font-semibold capitalize truncate">
                            <?php
                                echo $_SESSION['username'];
                            ?>
                        </div>
                    </div>    
                    <ul class="list-none mt-2 text-sm text-gray-700 rounded dark:text-gray-200" aria-labelledby="dropdownInformdropdownAvatarNameButtonationButton">
                        <li class="p-2 hover:bg-slate-200 hover:rounded-md">
                            <a href="./index.php?page=order">
                                <div class="flex items-center space-x-4">
                                    <div class="w-10 h-10 flex justify-center items-center  rounded-full bg-slate-300">   
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1.5rem" height="1.5rem" preserveAspectRatio="xMidYMid meet" viewBox="0 0 256 256"><path fill="#032b4d" d="m223.9 65.4l-12.2 66.9a24 24 0 0 1-23.6 19.7h-116l4.4 24H184a24 24 0 1 1-24 24a23.6 23.6 0 0 1 1.4-8h-58.8a23.6 23.6 0 0 1 1.4 8a24 24 0 1 1-42.2-15.6L34.1 32H16a8 8 0 0 1 0-16h18.1a16 16 0 0 1 15.7 13.1L54.7 56H216a7.9 7.9 0 0 1 6.1 2.9a7.7 7.7 0 0 1 1.8 6.5Z"/></svg>
                                    </div>
                                    <span class="text-lg tracking-wider font-bold">Order</span>
                                </div>
                            </a>
                        </li>
                        <li class="p-2 hover:bg-slate-200 hover:rounded-md">
                            <a href="./index.php?page=forum-saya"> 
                                <div class="flex items-center space-x-4">
                                    <div class="w-10 h-10 flex justify-center items-center  rounded-full bg-slate-300">   
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1.5rem" height="1.5rem" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="#032b4d" d="M2 15.8V3q0-.425.288-.713Q2.575 2 3 2h13q.425 0 .712.287Q17 2.575 17 3v9q0 .425-.288.712Q16.425 13 16 13H6l-3.15 3.15q-.225.225-.538.112Q2 16.15 2 15.8ZM7 18q-.425 0-.713-.288Q6 17.425 6 17v-2h13V6h2q.425 0 .712.287Q22 6.575 22 7v13.8q0 .35-.312.462q-.313.113-.538-.112L18 18Z"/></svg>
                                    </div>
                                    <span class="text-lg tracking-wider font-bold">Forum Saya</span>
                                </div>
                            </a>
                        </li>
                        <li class="p-2 hover:bg-slate-200 hover:rounded-md">
                            <a href="./core/out.php"> 
                                <div class="flex items-center space-x-4">
                                    <div class="w-10 h-10 flex justify-center items-center  rounded-full bg-slate-300">   
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1.5rem" height="1.5rem" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="#032b4d" d="M5 22a1 1 0 0 1-1-1V3a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v18a1 1 0 0 1-1 1H5zm10-6l5-4l-5-4v3H9v2h6v3z"/></svg>
                                    </div>
                                    <span class=" tracking-wider text-lg font-bold">Logout</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <?php
                }
            ?>
            <?php
                if(isset($_SESSION['loggedin']) !== true ){
            ?>
            <button class="px-7 py-2 tracking-wider rounded-tr-xl rounded-bl-xl font-semibold bg-primary text-white ease-in-out duration-300   hidden lg:block hover:bg-blue-900">
                <a href="./pages/auth/login.php" class="flex items-center space-x-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="1.25rem" height="1.25rem" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="currentColor" d="M10 17v-3H3v-4h7V7l5 5l-5 5m0-15h9a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2h-9a2 2 0 0 1-2-2v-2h2v2h9V4h-9v2H8V4a2 2 0 0 1 2-2Z"/></svg>
                    <span>Sign In</span> 
                </a>
            </button>
            <?php
                }
            ?>
            <button id="toggleMenu" class="px-3 py-2 border-2 border-primary rounded-sm lg:hidden">
                <i class="fa-solid fa-bars text-primary text-2xl"></i>
            </button>
        </div>
    </div>
    <div id="androidMenu" class="py-7 bg-blueMain hidden lg:hidden tracking-widest">
        <ul class="list-none text-primary font-semibold space-y-5 mb-5 text-lg ">
            <a href="./index.php">
                <li class="py-2">Home</li>
            </a>
            <a href="./index.php?page=list-rumah">
                <li class="py-2">Beli Rumah</li>
            </a>
            <a href="./index.php?page=list-forum">
                <li class="py-2">Forum</li>
            </a>
            <?php
                if(isset($_SESSION['loggedin']) == true ){
            ?>
            <a href="./index.php?page=forum-saya"> 
                <li class="py-2">Forum Saya</li>
            </a>
            <a href="./index.php?page=order">
                <li class="py-2">Order</li>
            </a>
            <?php
                }
            ?>
            <a href="./index.php?page=wishlist">
                <li class="py-2">Wishlist</li>
            </a>
        </ul>
        <?php
            if(isset($_SESSION['loggedin']) == true ){
        ?>
        <button class="w-full border-2 bg-primary font-semibold rounded-md p-3 text-white text-lg">
            <a href="./core/out.php" class="flex space-x-3 items-center justify-center"> 
                <svg xmlns="http://www.w3.org/2000/svg" width="1.25rem" height="1.25rem" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="currentColor" d="M16 17v-3H9v-4h7V7l5 5l-5 5M14 2a2 2 0 0 1 2 2v2h-2V4H5v16h9v-2h2v2a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9Z"/></svg>
                <span>Logout</span> 
            </a>
        </button>
        <?php
            }
        ?>
        <?php
            if(isset($_SESSION['loggedin']) !== true ){
        ?>
        <button class="w-full border-2 tracking-widest bg-primary rounded-md font-semibold p-3 text-white text-lg">
            <a class="flex justify-center items-center space-x-3" href="./pages/auth/login.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="1.25rem" height="1.25rem" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="currentColor" d="M10 17v-3H3v-4h7V7l5 5l-5 5m0-15h9a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2h-9a2 2 0 0 1-2-2v-2h2v2h9V4h-9v2H8V4a2 2 0 0 1 2-2Z"/></svg>
                <span>Sign In</span> 
            </a>
        </button>
        <?php
            }
        ?>
    </div>
</nav>