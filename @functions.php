<?php
// ? mysqli_real_escape_string

// CONECTION
$hostname = "localhost";
$username = "root";
$pw = "";
$db = "messenger_clone";

$conn = mysqli_connect( $hostname, $username, $pw, $db);

// ---------------------- LOGIN SYSTEM ----------------------
// SIGN UP

function sign_up($data){
    global $conn;

    $nama_depan = htmlspecialchars($data["nama_depan"]);
    $nama_belakang = htmlspecialchars($data["nama_belakang"]);
    $nomor_wa = htmlspecialchars($data["nomor_wa"]);
    $email = htmlspecialchars($data["email"]);
    $kata_sandi = mysqli_real_escape_string($conn, $data["kata_sandi"]);
    $tanggal = htmlspecialchars($data["tanggal"]);
    $bulan = htmlspecialchars($data["bulan"]);
    $tahun = htmlspecialchars($data["tahun"]);
    $kelamin = htmlspecialchars($data["kelamin"]);
    
    // ------ start validasi ------
    // cek apakah nomor_wa ada yang sama
    $nomor_wa = mysqli_real_escape_string($conn, $nomor_wa); // Tambahkan ini untuk mencegah SQL injection
    $cek_wa = mysqli_query($conn, "SELECT nomor_wa FROM pengguna WHERE nomor_wa = '$nomor_wa'");
    if( mysqli_fetch_assoc($cek_wa) ){
        $val_wa = "Nomor Wahtsapp sudah terdaftar, sihakan gunakan yang lain";
        $array_vall[0] = $val_wa;
    }   
    else{
        $val_wa = "";
        $array_vall[0] = $val_wa;
    }
    // cek apakah email ada yang sama
    $email = mysqli_real_escape_string($conn, $email); // Tambahkan ini untuk mencegah SQL injection
    $email = mysqli_query($conn, "SELECT email FROM pengguna WHERE email = '$email'");
    if( mysqli_fetch_assoc($email) ){
        $val_email = "Email sudah terdaftar, silahkan gunakan email yang lain";
        $array_vall[1] = $val_email ;
    } else {
        $val_email = "";
        $array_vall[1] = $val_email ;
    }
    // cek apakah sudah cukup usia
    if( $tahun > "2011" ){
        $val_usia = "Maaf anda belum cukup usia";
        $array_vall[2] = $val_usia ;
    } else {
        $val_usia = "";
        $array_vall[2] = $val_usia ;
    }
    // ------ end validasi ------
    
    // enskripsi password
    $kata_sandi = password_hash($kata_sandi, PASSWORD_DEFAULT);

    // gabungkan string
    $nama = "$nama_depan $nama_belakang";
    echo $nama;

    // masukkan ke database
    

    // mengembalikan 4 nilai 
    $pesan_kesalahan_wa = $array_vall[0] ;
    $pesan_kesalahan_email = $array_vall[1] ;
    $pesan_kesalahan_usia = $array_vall[2] ;
    $perubahan = mysqli_affected_rows($conn);
    return array(false, $pesan_kesalahan_wa , $pesan_kesalahan_email, $pesan_kesalahan_usia, $perubahan);
}
?>