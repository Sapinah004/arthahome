
<?php
 require_once($_SERVER['DOCUMENT_ROOT'] . '/Tugas_Akhir/User/core/config.php');
 session_start();
 if(isset($_POST['login'])){
    $email    = mysqli_real_escape_string($connect, $_POST['email']);
      $password = mysqli_real_escape_string($connect, $_POST['password']); 
        $query  = "SELECT id_user, username, email,  password FROM tb_user WHERE email = '$email'";
        $result = mysqli_query($connect, $query);
        if(mysqli_num_rows($result) == 1){
          while ($row = mysqli_fetch_array($result)) {
            if (password_verify($password, $row['password'])) {
              $_SESSION['id_user'] = $row['id_user'];
              $_SESSION['loggedin'] = true;
              $_SESSION['username'] = $row['username'];
              $_SESSION['email'] = $row['email'];
              
              
              // echo $_SESSION['username'];
              header("location: ../index.php");
            }else{
              header('Location: ../auth/login.php?pesan=gagal');
            }    
          }
        }else{
          echo  "No user found on this email";
        } 
   
    // $email = stripslashes($_POST['email']);
    // //cara sederhana mengamankan dari sql injection
    // $email = mysqli_real_escape_string($connect, $email);
    //  // menghilangkan backshlases
    // $password = stripslashes($_POST['password']);
    //  //cara sederhana mengamankan dari sql injection
    // $password = mysqli_real_escape_string($connect, $password);
    
    // //cek apakah nilai yang diinputkan pada form ada yang kosong atau tidak
    // if(!empty(trim($email)) && !empty(trim($password))){
    //     //select data berdasarkan username dari database
    //     $query      = "SELECT * FROM tb_user WHERE email = '$email'";
    //     $result     = mysqli_query($connect, $query);
    //     $rows       = mysqli_num_rows($result);
    //     if ($rows != 0) {
    //         $hash   = mysqli_fetch_assoc($result)['password'];
    //         if(password_verify($password, $hash)){
    //             $_SESSION['username'] = $username;
            
    //             header('Location: ../pages/index.php');
    //         }
                         
    //     //jika gagal maka akan menampilkan pesan error
    //     } else {
    //         $error =  'Register User Gagal !!';
    //     }
         
    // }else {
    //     $error =  'Data tidak boleh kosong !!';
    // }
//     $email = addslashes(trim($_POST['email']));
// $password = addslashes(trim($_POST['password']));
// if(!empty($email) || !empty($password)){
//    $seq=mysqli_query($connect,"select * from tb_user where email='$email' ");
//    $data=mysqli_fetch_array($seq);
//    $jml=mysqli_num_rows($seq);
//    if($jml>0){
//      if(password_verify($password, $data['password'])) {
//         $_SESSION['full_name']=$data['full_name'];
//         $_SESSION['user_autentification']="valid";
//         header("location:index.php");
//      }else{
//         echo "<script>alert('Password salah!'); window.location.href='login.php';</script>";
//      }
//    }else{
//      echo "<script>alert('Email salah!'); window.location.href='login.php';</script>";
//    }   
// }
    // $query = mysqli_query($connect, $sql);
    // $data = mysqli_num_rows($query);
    // if($data === 1){
    //     $row = mysqli_fetch_array($query);
    //         if(password_verify($password, $hashPassword)){
    //             $url = '../index.php';
    //             echo '<script> window.location.replace("'. $url .'");</script>';
    //             $_SESSION['id_user'] = $row['id_user'];
    //             $_SESSION['username'] = $row['username'];
    //             $_SESSION['loggedin'] = true;
    //         }
    //         else{
    //             header("Location : ../pages/auth/login.php?pesan=gagal");
    //         }
    //     echo "$hashPassword";
    // }
}
?>