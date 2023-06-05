
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="Website Artha Home menyediakan berbagai tipe rumah yang berlokasi
                hampir di seluruh kota batam untuk memudahkan anda mempunyai hunian impian.">
        <meta name="ketwords" content="website jual rumah, batam, marketplace">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Verifikasi akun Artha Home</title>
        <link rel="icon" type="image/png" href="../assets/images/favicon.png">
         <!-- Tailwind CSS -->
        <link rel="stylesheet" href="../assets/css/style.css">
        <!-- Fontawesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <body>
    <?php
        include('./config.php');
        if(!isset($_GET['email']) or !isset($_GET['kode'])){
            $message = "Data yang diperlukan tidak tersedia";
            echo "<script type='text/javascript'>alert('$message')</script>";
        }
        else{
            $email = $_GET['email'];
            $kode = $_GET['kode'];
            $sql = mysqli_query($connect, "select * from tb_user where email = '$email'");
            $data = mysqli_fetch_array($sql);
            if($data["token"] == $kode){
                $sql_update = mysqli_query($connect, "Update tb_user set token = '1' where email = '$email'");
                ?>
                    <div class="bg-[url('../../assets/images/bg-verification.webp')] bg-cover bg-center h-screen relative">
                        <div class="absolute top-0 left-0 w-full h-full bg-white/50 backdrop-blur">
                            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[30rem] bg-blue-700 max-w-2xl mx-auto px-5 py-10 text-white rounded-xl text-center font-yantramanav">
                                <div>
                                    Pelanggan <span class="capitalize font-bold"><?php echo $data['username']?></span>, akun Artha Home anda telah aktif. <br>
                                    Silahkan melakukan login <a class="font-bold hover:underline" href="../pages/auth/login.php"> disini</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
            }
        }
    ?>
    </body>
</html>