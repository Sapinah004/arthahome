<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
        <title>Artha Home</title>
        <link rel="stylesheet" href="../assets/css/style.css"/>
        <link rel="stylesheet" href="../assets/css/input.css"/>
        <!-- Font -->
        <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Yantramanav:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
        <!-- Swiper -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
    </head>
    <body>
        <div>
            <?php
                header("Cache-Control: no cache");
                include('./navigasi.php');
            ?>
        </div>
        <div>
            <div>
                <?php
                    if(isset($_GET['page'])){
                        $page = $_GET['page'];
                        switch($page){
                            case 'artikel';
                            include "../pages/artikel/article.php";
                            break;
                            case 'artikel-detail';
                            include "../pages/artikel/article-detail.php";
                            break;
                            case 'forum';
                            include "../pages/forum/forum.php";
                            break;
                            case 'list-forum';
                            include "../pages/forum/forum-list.php";
                            break;
                            case 'buat-forum';
                            include "../pages/forum/add-forum.php";
                            break;
                            case 'forum-saya';
                            include "../pages/forum/my-forum/forum.php";
                            break;
                            case 'forum-detail';
                            include "../pages/forum/my-forum/forum-detail.php";
                            break;
                            case 'update-forum';
                            include "../pages/forum/my-forum/update-forum.php";
                            break;
                            case 'wishlist';
                            include "../pages/wishlist.php";
                            break;
                            case 'list-rumah';
                            include "../pages/produk/list-produk.php";
                            break;
                            case 'produk';
                            include "../pages/produk/produk.php";
                            break;
                            case 'order';
                            include "../pages/order/order.php";
                            break;
                            case 'order-detail';
                            include "../pages/order/order-detail.php";
                            break;
                            case 'checkout';
                            include "../pages/checkout.php";
                            break;
                            // case 'thank-you';
                            // include "../pages/thankyou.php";
                            // break;
                        }
                    }else{
                        include '../pages/home.php';
                    }
                ?>
            </div>
        <div>
            <?php include('./footer.php')?>
        </div>
        
        <!-- Script Swiper -->
        <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
        <!-- <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script> -->
        <script type="text/javascript" src="../assets/js/index.js"></script>
        <!-- <script src="../path/to/flowbite/dist/flowbite.js"></script> -->
        <script src="https://unpkg.com/flowbite@1.5.4/dist/flowbite.js"></script>
    </body>
</html>

