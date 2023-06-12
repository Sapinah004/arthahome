<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
        <link rel="icon" type="image/png" href="../assets/images/favicon.png"/>
        <link rel="stylesheet" href="../assets/css/style.css"/>
            <link rel="stylesheet" href="../assets/css/input.css"/>
        <title>Thank You</title>
    </head>
    <body>
        <div class="bg-cover bg-center h-screen relative font-yantramanav" style="background-image: linear-gradient(to right bottom, rgba(3, 43, 77, 0.3), rgba(3, 43, 77,0.3)), url('../assets/images/bg-thankyou.webp');">
            <div class="absolute top-1/2 -translate-x-1/2 left-1/2 -translate-y-1/2 bg-white p-5 rounded-md">
                <div class="rounded-full mx-auto border-2 relative border-primary w-14 h-14 text-primary">
                    <i class="fa-solid fa-check absolute top-1/2 -translate-x-1/2 left-1/2 -translate-y-1/2 text-2xl"></i>
                </div>
                <div class="text-center mt-5 text-lg font-medium">
                    Terimakasih telah mempercayai kami <br> Kami akan segera mengirimkan informasi mengenai pembayaran ke anda
                    <!-- <br>Harap periksa email anda secara berkala -->
                </div>
                <div class="flex justify-center space-x-5 mt-5">
                    <a href="../index.php?page=list-rumah" class="px-5 py-3 w-48 font-medium rounded-md border-2 border-primary hover:bg-primary hover:text-white ease-in-out duration-300">
                            Kembali Berbelanja
                    </a> 
                    <a href="../index.php?page=order" class="px-5 py-3 flex justify-center w-48 text-white border-2 border-transparent hover:border-primary hover:text-primary bg-primary hover:bg-transparent rounded-md ease-in-out duration-300 font-medium">
                            Pesanan Saya
                    </a> 
                </div>
            </div>
        </div>
    </body>
</html>