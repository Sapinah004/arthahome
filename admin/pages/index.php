<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Artha Home</title>
            <link rel="icon" type="image/png" href="../assets/images/favicon.png">
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&family=Yantramanav:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
            <link rel="stylesheet" href="../assets/css/style.css"/>
        </head>
        <body>
        <?php
            // header("Cache-Control: no cache");
            include("../core/login.php");
            if(isset($_GET['pesan'])){
                if($_GET['pesan'] == "gagal"){
                    $message = "Username atau password salah";
                    echo "<script type='text/javascript'>alert('$message')</script>";
                }else if($_GET['pesan'] == "belum_login"){
                    $message = "Anda harus login terlebih dahulu";
                    echo "<script type='text/javascript'>alert('$message')</script>";
                }
            }
        ?>
        <section>
            <div class="h-screen grid grid-cols-2 font-yantramanav">
                <div class="bg-[#F0F0EE] px-5  relative">
                    <div class="w-[30rem] px-5 absolute top-1/2 left-1/2 -translate-y-1/2 -translate-x-1/2">
                        <h1 class="font-playfair font-bold text-4xl mb-3">SELAMAT DATANG ADMIN</h1>
                        <h2 class="text-lg font-medium mb-6">Harap masukkan username dan password untuk masuk ke website</h2>
                        <form class="grid" method="post">
                            <div class="grid">
                                <label for="username" class="font-semibold mb-2">Username</label>
                                <input id="username" type="text" autocomplete="off" name="username" class="p-2 bg-slate-200 mb-5 focus:ring-1 focus:ring-primary focus:border-primary">
                            </div>
                            <div class="grid">
                                <label for="password" class="font-semibold mb-2">Password</label>
                                <input id="password" type="password" autocomplete="off" name="password" class="p-2 bg-slate-200 focus:ring-1 focus:ring-primary focus:border-primary">
                            </div>
                            <button type="submit" name="login" class="mt-6 px-5 py-2 font-playfair tracking-widest rounded-md bg-primary w-auto text-white font-semibold hover:bg-blue-900 ease-in-out duration-300">
                                Login
                            </button>
                        </form>
                    </div>
                </div>
                <div>
                    <img class="h-full object-cover object-center" src="../assets/images/bg-auth.webp" alt="background login">
                </div>
            </div>
        </section>
    </body>
</html>
