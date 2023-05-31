<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="Website Artha Home menyediakan berbagai tipe rumah yang berlokasi
                hampir di seluruh kota batam untuk memudahkan anda mempunyai hunian impian.">
        <meta name="ketwords" content="website jual rumah, batam, marketplace">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/png" href="../../assets/images/favicon.png">
        <title>Login Artha Home</title>
         <!-- Tailwind CSS -->
        <link rel="stylesheet" href="../../assets/css/style.css">
        <!-- Fontawesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <body>
        <?php
            include('../../core/authentication.php');
            if(isset($_GET['pesan'])){
                if($_GET['pesan'] == "gagal"){
                    $message = "Username atau password salah";
                    echo "<script type='text/javascript'>alert('$message')</script>";
                }else if($_GET['pesan']=="logout"){
                    $message = "Anda berhasil logout";
                    echo "<script type='text/javascript'>alert('$message')</script>";
                }else if($_GET['pesan'] == "belum_login"){
                    $message = "Anda harus login terlebih dahulu";
                    echo "<script type='text/javascript'>alert('$message')</script>";
                }
            }
        ?>
        <section class="bg-[#FDFDFD] font-raleway text-primary">
            <div class="min-h-screen grid grid-cols-12">
                <div class="col-span-6 hidden lg:block relative">
                    <picture>
                        <img class="h-full object-cover object-center " src="../../assets/images/bg-auth.webp" alt="background">
                    </picture>
                    <div class="absolute top-10 left-10 font-bold hover:underline">
                        <a href="../index.php">
                            <i class="fa-solid fa-house mr-2"></i>
                            Kembali ke halaman utama
                        </a>
                    </div>
                </div>
                <div class="col-span-12 lg:col-span-5 md:max-w-xl md:mx-auto lg:mx-0 bg-[#FDFDFD]">
                    <div class="p-5 lg:px-12 overflow-y-auto relative top-1/2 -translate-y-1/2">
                        <div class=" font-bold hover:underline mb-24 lg:hidden">
                            <a href="../index.php">
                            <i class="fa-solid fa-house mr-2"></i>
                            Kembali ke halaman utama</a>
                        </div>
                        <h1 class="text-center text-2xl tracking-wider font-playfair font-bold">LOGIN</h1>
                        <p class="text-center mt-1 font-raleway font-semibold">Silahkan masukkan data dan temui rumah impian anda</p>
                        <form class="mt-5" method="POST">
                            <div>
                                <label for="email" class="tracking-wider font-semibold ">Email</label>
                                <input id="email" name="email" type="email" reqiured="required" class="mt-1 mb-4 border-primary bg-white w-full px-3 py-2 text-primary focus:outline-none border-2 font-semibold placeholder-primary focus:placeholder-transparent rounded-sm" placeholder="Masukkan email anda">
                            </div>
                            <div>
                                <label for="password" class="tracking-wider font-semibold ">Password</label>
                                <input id="password" name="password" type="password" autocomplete="off" required="required" class="mt-1 mb-4 border-primary bg-white w-full px-3 py-2 text-primary focus:outline-none border-2 font-semibold placeholder-primary focus:placeholder-transparent rounded-sm" placeholder="Masukkan password anda">
                            </div>
                            <button type="submit" name="login" class="font-playfair w-full bg-primary hover:bg-blue-900 ease-in-out duration-300 p-3 mt-10 font-bold tracking-wider rounded-tr-xl rounded-bl-xl text-white">
                                Login
                            </button>
                        </form>
                        <p class="mt-4 text-center font-medium">Belum memiliki akun? <a class="text-primary font-bold hover:underline" href="../auth/register.php">Register</a></p>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>