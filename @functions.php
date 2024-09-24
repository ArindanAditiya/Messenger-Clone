<?php
// ? mysqli_real_escape_string

// library
require "@kirim_email_pendaftaran.php";
// Api
require "Api/whatsapp/wa_login_system.php";

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
    $kata_sandi = htmlspecialchars($data["kata_sandi"]);
    $tanggal = htmlspecialchars($data["tanggal"]);
    $bulan = htmlspecialchars($data["bulan"]);
    $tahun = htmlspecialchars($data["tahun"]);
    $kelamin = htmlspecialchars($data["kelamin"]);
    
    // ------ start validasi ------
    $array_vall = array("", "", ""); // Inisialisasi array default

    // cek apakah nomor_wa ada yang sama
    $nomor_wa = mysqli_real_escape_string($conn, $nomor_wa); 
    $cek_wa = mysqli_query($conn, "SELECT nomor_wa FROM pengguna WHERE nomor_wa = '$nomor_wa'");
    if( mysqli_fetch_assoc($cek_wa) ){
        $array_vall[0] = "Nomor Wahtsapp sudah terdaftar, silahkan gunakan yang lain";
    }

    // cek apakah email ada yang sama
    $email = mysqli_real_escape_string($conn, $email);
    $cek_email = mysqli_query($conn, "SELECT email FROM pengguna WHERE email = '$email'");
    if( mysqli_fetch_assoc($cek_email) ){
        $array_vall[1] = "Email sudah terdaftar, silahkan gunakan email yang lain";
    }

    // cek apakah sudah cukup usia
    if( $tahun > "2011" ){
        $array_vall[2] = "Maaf anda belum cukup usia";
    }

    // ------ end validasi ------
    
    // tangkap nilai validasi
    $pesan_kesalahan_wa = $array_vall[0];
    $pesan_kesalahan_email = $array_vall[1];
    $pesan_kesalahan_usia = $array_vall[2];
    $perubahan = mysqli_affected_rows($conn);

    //------ pengiriman email dan wa kalau berhasil daftar ------
    $penerima = $email;
    $subjek = "Pendaftaran Akun";
    $username = "$nama_depan $nama_belakang";
    $whatsapp = $nomor_wa;
    $password = $kata_sandi;
  
    //------ Masukkan informasi pendaftaran ke Database ------
    $kata_sandi = password_hash($kata_sandi, PASSWORD_DEFAULT);
    $nama = "$nama_depan $nama_belakang";
    $tanggal_lahir = "$tanggal $bulan $tahun";
    $query = "INSERT INTO pengguna VALUE (
            '', 
            '$nama', 
            '$nomor_wa',
            '$email',
            '$kata_sandi',
            '$tanggal_lahir',
            '$kelamin',
            '',
            'imageUploaded/profile.jpg'
            )";

    // Logika validasi, cek apakah semua kesalahan kosong
    if( empty($pesan_kesalahan_wa) && empty($pesan_kesalahan_email) && empty($pesan_kesalahan_usia) ){
        mysqli_query($conn, $query);
        kirim_email_pendaftaran($penerima, $subjek, $username, $whatsapp, $email, $password);
        kirim_wa_pendaftaran($username, $whatsapp, $email, $password);
        return array( true , $pesan_kesalahan_wa , $pesan_kesalahan_email, $pesan_kesalahan_usia, $perubahan);
    } else {
        return array( false , $pesan_kesalahan_wa , $pesan_kesalahan_email, $pesan_kesalahan_usia, $perubahan);
    }
}
?>
