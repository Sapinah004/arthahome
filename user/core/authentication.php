<?php
    include('../../core/config.php');
    session_start();
    global $connect;
    if(isset($_POST['registrasi'])){
        $username = mysqli_real_escape_string($connect, $_POST['username']);
        $email = mysqli_real_escape_string($connect, $_POST['email']);
        $password = mysqli_real_escape_string($connect, $_POST['password']);
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);
        $cpassword = mysqli_real_escape_string($connect, $_POST['confirmPassword']);
        $hashPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql_checkEmail = mysqli_query($connect, "SELECT * FROM tb_user WHERE email = '$email'");
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $message = "Email yang anda masukkan tidak valid";
            echo "<script type='text/javascript'>alert('$message')</script>";
        }elseif(!$uppercase || !$lowercase || !$number || !$specialChars ){
            $message = "Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.";
            echo "<script type='text/javascript'>alert('$message')</script>";
        }
        //  elseif(empty(preg_match("/@gmail.com$/" , $email) || preg_match("/@yahoo.com$/" , $email))){
        //     $message = "Cek kembali email anda, email yang diperbolehkan hanya yang berdomain gmail";
        //     echo "<script type='text/javascript'>alert('$message')</script>";
        // }
        elseif(strlen($password) < 6){
            $message = "Harap masukkan password minimal 6 karakter";
            echo "<script type='text/javascript'>alert('$message')</script>";
        }elseif(mysqli_num_rows($sql_checkEmail) == 1){
            $message = "Email yang anda gunakan telah terdaftar, silahkan login atau gunakan email lain";
            echo "<script type='text/javascript'>alert('$message')</script>";
        }elseif($password != $cpassword){
            $message = "Password dan konfirmasi password tidak sesuai";
            echo "<script type='text/javascript'>alert('$message')</script>";
        }
        else{
            $token = md5(rand(0,1000));
            $judul_email = "Verifikasi Akun Artha Home";
            $isi_email = "Pelanggan yang terhormat, akun arthahome anda dengan email: <b>$email</b> telah siap digunakan.<br/>";
            $isi_email .= "Sebelumnya, silahkan verifikasi email anda melalui link dibawah ini. <br/>";
            $isi_email .="http://localhost/Arthahome/User/core/verifikasi.php?email=$email&kode=$token";
            kirim_email($email, $username, $judul_email, $isi_email);

            $sql_insertData = mysqli_query($connect, "INSERT INTO tb_user (username, email, password, token) VALUES
                    ('".$username."', '".$email."', '".$hashPassword."','".$token."')");
            if($sql_insertData == false){
                $message = "Tidak dapat melakukan registrasi, harap coba beberapa saat lagi";
                echo "<script type='text/javascript'>alert('$message')</script>";
            }
            // if($sql_insertData == true){
            //     // $url = '../auth/login.php';
            //     // echo '<script> window.location.replace("'. $url .'");</script>';
            // }
            // else{
            //     $message = "Tidak dapat melakukan registrasi, harap coba beberapa saat lagi";
            //     echo "<script type='text/javascript'>alert('$message')</script>";
            // }
        }
    }
    if(isset($_POST['login'])){
        $email    = mysqli_real_escape_string($connect, $_POST['email']);
        $password = mysqli_real_escape_string($connect, $_POST['password']); 
        $getUserData  = mysqli_query($connect, "SELECT id_user, username, email,  password FROM tb_user WHERE email = '$email'");
        // $result = mysqli_query($connect, $query);
        if(mysqli_num_rows($getUserData) == 1){
        while ($row = mysqli_fetch_array($getUserData)) {
            if (password_verify($password, $row['password'])) {
                $_SESSION['id_user'] = $row['id_user'];
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $row['username'];
                $_SESSION['email'] = $row['email'];
                header("location: ../../index.php");

            }else{
                header('Location: ./auth/login.php?pesan=gagal');
            }    
        }
        }else{
            $message = "Email anda belum terdaftar, silahkan registrasi terlebih dahulu";
            echo "<script type='text/javascript'>alert('$message')</script>";
        } 
    }

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    function kirim_email($email_penerima, $nama_penerima, $judul_email, $isi_email){
        $email_pengirim = "sapinahsapinah149@gmail.com";
        $nama_pengirim = "Artha Home";

        //Load Composer's autoloader
        require '../../vendor/autoload.php';

        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = 0;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = $email_pengirim;                     //SMTP username
            $mail->Password   = 'qmvipngewzkypjtt';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom( $email_pengirim , $nama_pengirim);
            $mail->addAddress($email_penerima, $nama_penerima);     //Add a recipient

        
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $judul_email;
            $mail->Body    = $isi_email;

            $mail->send();
            $message = "Kami telah mengirim verifikasi registrasi akun, harap cek email anda";
            echo "<script type='text/javascript'>alert('$message')</script>";
        } catch (Exception $e) {
             $message = "Email verifikasi gagal dikirim, harap coba kembali";
            echo "<script type='text/javascript'>alert('$message')</script>";
        }
    }
    ?>