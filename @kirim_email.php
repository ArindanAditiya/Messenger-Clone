<?php

use \PHPMailer\PHPMailer\PHPMailer;
use \PHPMailer\PHPMailer\Exception;

// Include PHPMailer files
require 'library/s/src/Exception.php';
require 'library/PHPMailer/src/PHPMailer.php';
require 'library/PHPMailer/src/SMTP.php';

function kirim_email_pendaftaran($penerima, $subjek) {
    $mail = new PHPMailer(true);

    try {
        // Konfigurasi SMTP
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';  // Ganti dengan SMTP server yang kau pakai
        $mail->SMTPAuth   = true;
        $mail->Username   = 'indangaming003@gmail.com'; // Emailmu
        $mail->Password   = 'apa kau:('; // Password Aplikasi Gmail
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Pengirim dan Penerima
        $mail->setFrom('indangaming003@gmail.com', 'intel parjamban');
        $mail->addAddress($penerima);

        // Konten Email
        $mail->isHTML(true);
        $mail->Subject = $subjek;
        $mail->Body    = file_get_contents('library/PHPMailer/ui_email_pendaftaran.html'); // Isi email dalam format HTML
        $mail->AltBody = strip_tags(file_get_contents('email_template.html')); // Isi email dalam format teks


        // Kirim Email
        $mail->send();
        echo 'Pesan berhasil dikirim';
    } catch (Exception $e) {
        echo "Pesan tidak dapat dikirim. Mailer Error: {$mail->ErrorInfo}";
    }

    $penerima = "indangaming003@gmail.com";
    $subjek = "belajar kirim email";
    kirim_email_pendaftaran($penerima, $subjek);
}
