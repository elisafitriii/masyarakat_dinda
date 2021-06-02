<?php
 require "conn/koneksi.php";

 function register($data){

    global $conn;


    $username = strtolower(stripslashes($data['username']));
    $nama_petugas = htmlspecialchars($data['nama_petugas']);
    $telp_petugas = htmlspecialchars($data['telp_petugas']);
    $level = htmlspecialchars($data['level']);
    $password = mysqli_real_escape_string($conn, $data['password']);
    $repassword = mysqli_real_escape_string($conn, $data['repassword']);


    // cek user apakah sudah ada

   $ambil = mysqli_query($conn, "SELECT username FROM petugas WHERE username = '$username'");
   
    if (!mysqli_fetch_array($ambil)){
        
        // cek apakah pas == repas
            if( $password == $repassword){

                $password = md5($password);
            //   tambah kan user ke database
            mysqli_query($conn, "INSERT INTO petugas values('', '$nama_petugas',  '$username', '$password', '$telp_petugas', 'admin')");
            
            return mysqli_affected_rows($conn);
    
            }else {
                echo "
                <script>
                alert('password tidak sesuai');
                </script>";
            }
    }

 } 

?>