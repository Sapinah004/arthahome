<?php
    include('./core/config.php');
?>
<div class="px-5 pt-52 pb-24 container mx-auto max-w-7xl font-yantramanav">
    <div class="lg:flex justify-between items-center">
        <h1 class="text-4xl lg:text-5xl font-playfair text-primary font-semibold">Pesanan Anda.</h1>
        <div class="mb-4 border-b text-lg border-gray-200">
            <ul class="list-none flex flex-wrap -mb-px  font-medium text-center text-gray-500 " id="tab" role="tablist">
                <li class="mr-2" role="orders">
                    <button class="inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-secondary hover:border-secondary" id="all-tab" type="button" role="tab" aria-controls="all-orders" aria-selected="false">Semua Pesanan</button>
                </li>
                <li class="mr-2" role="orders">
                    <button class="inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-secondary hover:border-secondary" id="tahap-pembayaran-tab" type="button" role="tab" aria-controls="tahap-pembayaran" aria-selected="false">Tahap Pembayaran</button>
                </li>
                <li class="mr-2" role="orders">
                    <button class="inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-secondary hover:border-secondary" id="lunas-tab" type="button" role="tab" aria-controls="lunas" aria-selected="false">Lunas</button>
                </li>
            </ul>
        </div>
    </div>
    <div class="mt-12">
        <div id="tabContentExample">
            <div class="hidden " id="all-orders" role="tabpanel" aria-labelledby="all-tab">
                <?php
                    $sql ="SELECT * FROM tb_pesanan WHERE id_user = '".$_SESSION['id_user']."'";
                    $query = mysqli_query($connect, $sql);
                    if($query == TRUE){
                        $data = mysqli_fetch_array($query);
                        // SELECT tb_pesanan.*, MIN(tb_gambar_rumah.gambar) as gambar, tb_rumah.*, tb_harga_rumah.* FROM tb_pesanan JOIN tb_rumah ON tb_pesanan.id_rumah = tb_rumah.id_rumah LEFT JOIN tb_gambar_rumah ON tb_gambar_rumah.id_rumah = tb_rumah.id_rumah JOIN tb_harga_rumah ON tb_pesanan.id_rumahdetail = tb_harga_rumah.id_rumahdetail WHERE id_user = 27;
                        // SELECT tb_pesanan.*, tb_gambar_rumah.gambar as gambar, tb_rumah.*, tb_harga_rumah.* FROM tb_pesanan JOIN tb_rumah ON tb_pesanan.id_rumah = tb_rumah.id_rumah LEFT JOIN tb_gambar_rumah ON tb_gambar_rumah.id_rumah = (SELECT id_gambar_rumah from tb_gambar_rumah WHERE tb_gambar_rumah.id_rumah = tb_rumah.id_rumah LIMIT 1) JOIN tb_harga_rumah ON tb_pesanan.id_rumahdetail = tb_harga_rumah.id_rumahdetail WHERE id_user;
                        // SELECT tb_gambar_rumah.gambar as gambar FROM `tb_gambar_rumah` JOIN tb_pesanan ON tb_gambar_rumah.id_rumah = tb_pesanan.id_rumah GROUP BY tb_gambar_rumah.id_rumah;
                        $sql = "SELECT tb_pesanan.*, tb_gambar_rumah.gambar as gambar, tb_rumah.*, tb_harga_rumah.* FROM tb_pesanan JOIN tb_rumah ON tb_pesanan.id_rumah = tb_rumah.id_rumah LEFT JOIN tb_gambar_rumah ON tb_gambar_rumah.id_rumah = tb_rumah.id_rumah JOIN tb_harga_rumah ON tb_pesanan.id_rumahdetail = tb_harga_rumah.id_rumahdetail WHERE id_user  = '".$_SESSION['id_user']."' GROUP BY tb_pesanan.id_order;";
                        $query = mysqli_query($connect, $sql);
                        if(mysqli_num_rows($query) > 0){
                            while($data = mysqli_fetch_array($query)){
                ?>
                <div class="grid grid-cols-12 lg:space-x-5 mb-10 items-center bg-gray-100 rounded-2xl p-7 shadow-lg">
                    <div class="col-span-12 lg:col-span-4">
                        <picture>
                            <img class="w-full h-full object-cover object-center" src="./../Admin/core/product/images/<?php echo $data['gambar']?>" alt="<?php echo $data['gambar']?>">
                        </picture>
                    </div>
                    <div class="col-span-12 lg:col-span-8 mt-6 lg:mt-0">
                        <div class="flex justify-end space-x-3 text-lg">
                            <span class="px-3 border-r-2 border-r-slate-300 text-lg font-semibold text-primary tracking-wider">
                                <?php echo date_format(new DateTime($data['tanggal']), "d-m-Y")?>
                            </span>
                            <?php 
                                if($data['status_pembelian'] == 0){
                                    echo '<span class="text-lg font-semibold text-secondary tracking-wider">Dalam Pembayaran</span>';
                                }else{
                                    echo '<span class="text-lg font-semibold text-secondary tracking-wider">Lunas</span>';
                                }
                            ?>
                        </div>
                        <h1 class="mt-6 lg:mt-0 text-2xl tracking-wider font-playfair text-primary font-semibold">
                            Rumah Type <?php echo $data['tipe']?>
                        </h1>
                        <div class="mt-3 md:flex justify-between items-center">
                            <div class="w-1/2">
                                <div class="flex items-center mb-1">
                                    <i class="fa-solid fa-location-dot text-secondary pb-1 basis-6"></i>
                                    <h2 class="font-semibold capitalize text-slate-500 tracking-wider">
                                        <?php echo $data['lokasi']?>
                                    </h2>
                                </div>
                                <div class="flex items-center ">
                                    <i class="fa-solid fa-house-chimney text-secondary basis-6 text-sm"></i>
                                    <h3 class=" font-semibold text-slate-500">
                                        No Rumah : <span class=" font-bold"><?php echo $data['no_rumah']?></span>
                                    </h3>
                                </div>
                            </div>
                            <div class="mt-3 lg:mt-0">
                                <h4 class="lg:mb-3 text-xl font-bold text-slate-500 text-right">Total Harga :</h4>
                                <span class="text-2xl font-bold text-primary flex justify-end lg:flex-none">Rp. <?php echo number_format($data['harga'])?></span>
                            </div>
                        </div>
                        <button class="flex ml-auto">
                            <a href="./index.php?page=order-detail&order=<?php echo $data['id_order']?>" class="flex items-center space-x-2 mt-5 px-5 py-2.5 bg-primary rounded-tr-xl rounded-bl-xl tracking-wider font-bold hover:bg-blue-900 text-white justify-end ease-in-out duration-300">
                                <span>Detail Pesanan</span>  
                                <i class="fa-solid fa-arrow-right-long mt-1"></i>
                            </a>
                        </button>
                    </div>
                </div>
                <?php
                            }
                        }else{
                            echo '<div class="font-bold text-xl">Tidak ada data pembelian, anda belum melakukan pembelian</div>';
                        }
                    }else{
                        echo '<div class="font-bold text-xl">Tidak ada data pembelian, anda belum melakukan pembelian</div>';
                    }
                ?>
            </div>
            <div class="hidden" id="tahap-pembayaran" role="tabpanel" aria-labelledby="tahap-pembayaran-tab">
                <?php
                    $sql ="SELECT * FROM tb_pesanan WHERE id_user = '".$_SESSION['id_user']."' AND status_pembelian = 0";
                    $query = mysqli_query($connect, $sql);
                    if(mysqli_num_rows($query) > 0){
                        $data = mysqli_fetch_array($query);
                        // SELECT tb_pesanan.*, tb_gambar_rumah.gambar as gambar, tb_rumah.*, tb_harga_rumah.* FROM tb_pesanan JOIN tb_rumah ON tb_pesanan.id_rumah = tb_rumah.id_rumah LEFT JOIN tb_gambar_rumah ON tb_gambar_rumah.id_rumah = tb_rumah.id_rumah JOIN tb_harga_rumah ON tb_pesanan.id_rumahdetail = tb_harga_rumah.id_rumahdetail WHERE id_user  = '".$_SESSION['id_user']."' GROUP BY tb_pesanan.id_order;
                        $sql = "SELECT tb_pesanan.*, tb_gambar_rumah.gambar as gambar, tb_rumah.*, tb_harga_rumah.* FROM tb_pesanan JOIN tb_rumah ON tb_pesanan.id_rumah = tb_rumah.id_rumah LEFT JOIN tb_gambar_rumah ON tb_gambar_rumah.id_rumah = tb_rumah.id_rumah JOIN tb_harga_rumah ON tb_pesanan.id_rumahdetail = tb_harga_rumah.id_rumahdetail WHERE id_user  = '".$_SESSION['id_user']."' AND tb_pesanan.status_pembelian = 0 GROUP BY tb_pesanan.id_order";
                        $query = mysqli_query($connect, $sql);
                        if(mysqli_num_rows($query) > 0){
                            while($data = mysqli_fetch_array($query)){
                ?>
                <div class="grid grid-cols-12 lg:space-x-5 mb-10 items-center bg-gray-100 p-7 rounded-2xl shadow-lg">
                    <div class="col-span-12 lg:col-span-4">
                        <picture>
                            <img class="w-full h-full object-cover object-center" src="./../Admin/core/product/images/<?php echo $data['gambar']?>" alt="<?php echo $data['gambar']?>">
                        </picture>
                    </div>
                    <div class="col-span-12 lg:col-span-8 mt-6 lg:mt-0">
                        <div class="flex justify-end space-x-3 text-lg">
                            <span class="px-3 border-r-2 border-r-slate-300 text-lg font-semibold text-primary tracking-wider">
                                <?php echo date_format(new DateTime($data['tanggal']), "d-m-Y")?>
                            </span>
                            <span class="text-lg font-semibold text-secondary tracking-wider">
                                <?php
                                    if($data['status_pembelian'] == 0){
                                        echo "Dalam Pembayaran";
                                    }
                                    else{
                                        echo "Lunas";
                                    }
                                ?>
                            </span>
                        </div>
                        <h1 class="mt-6 lg:mt-0 text-2xl tracking-wider font-playfair text-primary font-semibold">
                            Rumah Type <?php echo $data['tipe']?>
                        </h1>
                        <div class="mt-3 md:flex justify-between items-center">
                            <div class="w-1/2">
                                <div class="flex items-center mb-1">
                                    <i class="fa-solid fa-location-dot text-secondary pb-1 basis-6"></i>
                                    <h2 class="font-semibold capitalize text-slate-500 tracking-wider">
                                        <?php echo $data['lokasi']?>
                                    </h2>
                                </div>
                                <div class="flex items-center ">
                                    <i class="fa-solid fa-house-chimney text-secondary basis-6 text-sm"></i>
                                    <h3 class=" font-semibold text-slate-500">
                                        No Rumah : <span class=" font-bold"><?php echo $data['no_rumah']?></span>
                                    </h3>
                                </div>
                            </div>
                            <div class="mt-3 lg:mt-0">
                                <h4 class="lg:mb-3 text-xl font-bold text-slate-500 text-right">Total Harga :</h4>
                                <span class="text-2xl font-bold text-primary flex justify-end lg:flex-none">Rp. <?php echo number_format($data['harga'])?></span>
                            </div>
                        </div>
                        <button class="flex ml-auto">
                            <a href="./index.php?page=order-detail&order=<?php echo $data['id_order']?>" class="flex items-center space-x-2 mt-5 px-5 py-2.5 bg-primary rounded-tr-xl rounded-bl-xl tracking-wider font-bold hover:bg-blue-900 text-white justify-end ease-in-out duration-300">
                                <span>Detail Pesanan</span>  
                                <i class="fa-solid fa-arrow-right-long mt-1"></i>
                            </a>
                        </button>
                    </div>
                </div>
                <?php
                            }
                        }else{
                            echo '<div class="font-bold text-xl">Tidak ada data pembelian</div>';
                        }
                    }else{
                        echo '<div class="font-bold text-xl">Tidak ada data pembelian</div>';
                    }
                ?>
            </div>
            <div class="hidden" id="lunas" role="tabpanel" aria-labelledby="lunas-tab">
                <?php
                    $sql ="SELECT * FROM tb_pesanan WHERE id_user = '".$_SESSION['id_user']."' and status_pembelian = 1";
                    $query = mysqli_query($connect, $sql);
                    if(mysqli_num_rows($query) > 0){
                        $data = mysqli_fetch_array($query);
                        $sql = "SELECT tb_pesanan.*, tb_gambar_rumah.gambar as gambar, tb_rumah.*, tb_harga_rumah.* FROM tb_pesanan JOIN tb_rumah ON tb_pesanan.id_rumah = tb_rumah.id_rumah LEFT JOIN tb_gambar_rumah ON tb_gambar_rumah.id_rumah = tb_rumah.id_rumah JOIN tb_harga_rumah ON tb_pesanan.id_rumahdetail = tb_harga_rumah.id_rumahdetail WHERE id_user  = '".$_SESSION['id_user']."' AND tb_pesanan.status_pembelian = 1 GROUP BY tb_pesanan.id_order ORDER BY tb_pesanan.tanggal DESC";
                        $query = mysqli_query($connect, $sql);
                        if(mysqli_num_rows($query) > 0){
                            while($data = mysqli_fetch_array($query)){
                ?>
                <div class="grid grid-cols-12 lg:space-x-5 mb-10 items-center bg-gray-100 p-7 rounded-2xl shadow-lg">
                    <div class="col-span-12 lg:col-span-4">
                        <picture>
                            <img class="w-full h-full object-cover object-center" src="./../Admin/core/product/images/<?php echo $data['gambar']?>" alt="">
                        </picture>
                    </div>
                    <div class="col-span-12 lg:col-span-8 mt-6 lg:mt-0">
                        <div class="flex justify-end space-x-3 text-lg">
                            <span class="px-3 border-r-2 border-r-slate-300 text-lg font-semibold text-primary tracking-wider">
                                <?php echo date_format(new DateTime($data['tanggal']), "d-m-Y")?>
                            </span>
                            <span class="text-lg font-semibold text-secondary tracking-wider">Lunas</span>
                        </div>
                        <h1 class="mt-6 lg:mt-0 text-2xl tracking-wider font-playfair text-primary font-semibold">
                            Rumah Type <?php echo $data['tipe']?>
                        </h1>
                        <div class="mt-3 md:flex justify-between items-center">
                            <div class="w-1/2">
                                <div class="flex items-center mb-1">
                                    <i class="fa-solid fa-location-dot text-secondary pb-1 basis-6"></i>
                                    <h2 class="font-semibold capitalize text-slate-500 tracking-wider">
                                        <?php echo $data['lokasi']?>
                                    </h2>
                                </div>
                                <div class="flex items-center ">
                                    <i class="fa-solid fa-house-chimney text-secondary basis-6 text-sm"></i>
                                    <h3 class=" font-semibold text-slate-500">
                                        No Rumah : <span class=" font-bold"><?php echo $data['no_rumah']?></span>
                                    </h3>
                                </div>
                            </div>
                            <div class="mt-3 lg:mt-0">
                                <h4 class="lg:mb-3 text-xl font-bold text-slate-500 text-right">Total Harga :</h4>
                                <span class="text-2xl font-bold text-primary flex justify-end lg:flex-none">Rp. <?php echo number_format($data['harga'])?></span>
                            </div>
                        </div>
                        <button class="flex ml-auto">
                            <a href="./index.php?page=order-detail&order=<?php echo $data['id_order']?>" class="flex items-center space-x-2 mt-5 px-5 py-2.5 bg-primary rounded-tr-xl rounded-bl-xl tracking-wider font-bold hover:bg-blue-900 text-white justify-end ease-in-out duration-300">
                                <span>Detail Pesanan</span>  
                                <i class="fa-solid fa-arrow-right-long mt-1"></i>
                            </a>
                        </button>
                    </div>
                </div>
                 <?php
                            }
                        }else{
                            echo '<div class="font-bold text-xl">Tidak ada data</div>';
                        }
                    }else{
                        echo '<div class="font-bold text-xl">Tidak ada data</div>';
                    }
                ?>
                </div>
            </div>
         </div>
    </div>
</div>

<!-- <script src="../path/to/flowbite/dist/flowbite.js"></script> -->
<script src="https://unpkg.com/flowbite@1.5.4/dist/flowbite.js"></script> 

<script>
   // create an array of objects with the id, trigger element (eg. button), and the content element
const tabElements = [
    {
        id: 'semua-pesanan',
        triggerEl: document.querySelector('#all-tab'),
        targetEl: document.querySelector('#all-orders')
    },
    {
        id: 'pembayaran',
        triggerEl: document.querySelector('#tahap-pembayaran-tab'),
        targetEl: document.querySelector('#tahap-pembayaran')
    },
    {
        id: 'selesai',
        triggerEl: document.querySelector('#lunas-tab'),
        targetEl: document.querySelector('#lunas')
    },

];

// // options with default values
const options = {
    defaultTabId: 'settings',
    activeClasses: 'text-secondary hover:text-secondary !border-secondary',
    inactiveClasses: 'text-primary hover:text-primary-blue-900 border-gray-100 hover:border-gray-300',
   
};

// /*
// * tabElements: array of tab objects
// * options: optional
// */
const tabs = new Tabs(tabElements, options);

// // shows another tab element
tabs.show('pembayaran');

// // get the tab object based on ID
tabs.getTab('selesai')

// // get the current active tab object
tabs.getActiveTab()


</script>