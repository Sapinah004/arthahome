<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Artha Home | Admin</title>
        <link rel="icon" type="image/png" href="../assets/images/favicon.png"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
        <script src="https://code.iconify.design/iconify-icon/1.0.1/iconify-icon.min.js"></script>
        <link rel="stylesheet" href="../assets/css/style.css" />
        <link rel="stylesheet" href="../assets/css/input.css" />
        <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    </head>
    <body>
        <?php
            header("Cache-Control: no cache");
            date_default_timezone_set('Asia/Jakarta');  
            session_start();
            include('../core/config.php');
                if($_SESSION['loggedin']!= true){
                    header("location: ../index.php?pesan=belum_login");
                }
        ?>
        <div class="min-h-screen h-screen p-3 pl-0 bg-blueMain grid grid-cols-12 font-yantramanav print:p-0">
            <section class="col-span-3 xl:col-span-2 print:hidden">
                <?php include('./sidebar.php');?>
            </section>
            <section class="h-full overflow-y-auto bg-white shadow-lg rounded-xl col-span-9 xl:col-span-10 print:shadow-none print:col-span-12">
                <div>
                    <?php
                        if(isset($_GET['page'])){
                            $page = $_GET['page'];
                            switch($page){
                                case 'orders':
                                    include "../pages/order/list_order.php";
                                break;
                                case 'order_detail';
                                    include "../pages/order/detail_order.php";
                                break;
                                case 'product';
                                    include "../pages/products/product.php";
                                break;
                                case 'update_rumah';
                                    include "../pages/products/update_rumah.php";
                                break;
                                case 'update_norumah';
                                    include "../pages/products/update_norumah.php";
                                break;
                                case 'update_harga';
                                    include "../pages/products/update_harga.php";
                                break;
                                case 'update_gambar';
                                    include "../pages/products/update_gambar.php";
                                break;
                                case 'product_list';
                                    include "../pages/products/list_product.php";
                                break;
                                case 'add_product';
                                    include "../pages/products/add_product.php";
                                break;
                                case 'update_product';
                                    include "../pages/products/update_product.php";
                                break;
                                case 'announcement';
                                    include "../pages/announcement.php";
                                break;
                                case 'artikel-list';
                                    include "../pages/artikel/artikel_list.php";
                                break;
                                case 'artikel';
                                    include "../pages/artikel/artikel.php";
                                break;
                                case 'update-artikel';
                                    include "../pages/artikel/update_artikel.php";
                                break;
                                case 'add-artikel';
                                    include "../pages/artikel/add_artikel.php";
                                break;
                                case 'report';
                                    include "../pages/report.php";
                                break;
                                case 'report-month';
                                    include "../pages/report-month.php";
                                break;
                                case 'report-year';
                                include "../pages/report-year.php";
                            break;
                                case 'notification';
                                    include "../pages/notifikasi_detail.php";
                                break;
                            }
                        }
                    ?>
                </div>
            </section>
        </div>
    </body>
</html>
<script type="text/javascript" src="../assets/js/index.js"></script>
<script src="https://unpkg.com/flowbite@1.5.4/dist/flowbite.js"></script>
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
