<?php
    include("../core/artikel.php");
?>
<div class="pt-2 pb-5 px-5">
    <div class="w-full bg-white py-3 flex items-center justify-between sticky top-0">
        <h1 class="font-playfair text-3xl tracking-widest font-bold">Blog & Artikel</h1>
        <div>
            <?php include("../pages/notifikasi.php");?>
        </div>
    </div>
    <div class="mt-5 w-full h-full  block overflow-auto whitespace-nowrap">
        <button class=" items-center font-bold bg-blue-500 hover:bg-blue-700 ease-in-out duration-300 flex space-x-3 text-white rounded-md ">
            <a href="./dashboard.php?page=add-artikel" class="px-5 py-2">
                <i class="fa-solid fa-square-plus mr-3"></i>
                Buat Artikel
            </a>
        </button>
        <table class="table-auto text-left mt-5 w-full">
            <thead class="bg-slate-200 border-b border-slate-400">
                <tr class="w-full">
                    <th class="px-2 py-4 w-[5%]">No</th>
                    <th class="px-2 py-4 w-[15%]">Tanggal</th>
                    <th class="px-2 py-4 w-[55%]">Judul</th>
                    <th class="px-2 py-4 w-[25%]">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                $sql_getArtikel = mysqli_query($connect, "SELECT * FROM tb_artikel ORDER BY tanggal DESC");
                if(mysqli_num_rows($sql_getArtikel) > 0){
                    while($data = mysqli_fetch_array($sql_getArtikel)){
                        $date = date_format(new DateTime($data['tanggal']), "Y/m/d");
                ?>
                <tr class="odd:bg-slate-50 even:bg-slate-100 mt-5">
                    <td class="px-2 py-4"><?php echo ++$i?></td>
                    <td class="px-2 py-4">
                        <div>
                            <?php echo getHari($date)?>, <?php echo date_format(new DateTime($data['tanggal']), "d/m/Y")?>
                        </div>
                    </td>
                    <td class="px-2 py-4"><?php echo $data['judul']?></td>
                    <td>
                        <div class="flex space-x-3 text-sm">
                            <button>
                                <a href="../pages/dashboard.php?page=artikel&id=<?php echo $data['id_artikel']?>" class="flex items-center space-x-2 px-5 py-1.5 bg-green-500 hover:bg-green-600 text-white rounded-md ease-in-out duration-300">
                                    <i class="fa-regular fa-eye"></i>
                                    <span>Lihat</span> 
                                </a>
                            </button>
                            <a onClick="return confirm('Anda yakin ingin menghapus artikel ini?')" href="../core/artikel.php?id_artikel=<?php echo $data['id_artikel']?>" class="px-5 py-1.5 bg-red-500 rounded-md text-white hover:bg-red-700 ease-in-out duration-300">
                                <i class="fa-regular fa-trash-can"></i>
                                Hapus
                            </a>
                        </div>
                    </td>
                </tr>
                <?php
                    }
                }else{
                    echo '<div class="mt-5 font-bold text-slate-500 italic">Tidak ada artikel</div>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>