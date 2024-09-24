<?php
  session_start();
 require "@functions.php";

 if( isset($_POST["login"]) ){
  // -------------------- LOGIN --------------------
 $user_inp = $_POST["user"];
 $password_inp = $_POST["password"];

 $result = mysqli_query($conn, "SELECT * FROM pengguna WHERE email = '$user_inp' ");
 // cek username
 // gunakan function "mysqli_num_rows()" untuk mengembalikan jumlah row hasil result
 if( mysqli_num_rows($result) === 1 ){
    // cek password
    $row = mysqli_fetch_assoc($result);
    if( password_verify($password_inp, $row["kata_sandi"]) ){
       $_SESSION["login"] = true;
       if( isset($_SESSION["login"]) ){
         setcookie("key", hash("sha256", $row["id_pengguna"]), time()+60 );
         header("Location: otp_login.php");
       }
       
       exit;
    }
 }
 $error = true;
 }
?>
<html lang="en">
  <head>

    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Log In Facebook</title>
    <link rel="icon" type="image/x-icon" href="assets/image/icon.png">
    <link rel="stylesheet" href="assets/css/login.css" />
  </head>
  <body>
    <div class="conteiner">
      <div class="left">
        <h1><b>facebook</b></h1>
        <p>Facebook membantu anda menemukan jodoh yang sayang dengan anda, anak, dan orang tua</p>
      </div>
      <div class="right">
        <form action="" method="post">
          <input name="user" type="text" id="input1" placeholder="Email address or phone number" />
          <input name="password" type="text" id="input2" placeholder="password" />
          <span style="color: red;"><?php if(isset($error)){echo "antum gagal login";}?></span>
          <button name="login" class="LoginBtn" type="submit" >Log in</button>
          <a  class="forget">forgetten password?</a>
          <div class="sign-Up">
            <a type="button" href="signup.php" class="signupBtn">create New Account</a>
          </div>
        </form>
        <p><b>Create a page </b> for a celebrity.band or business</p>
      </div>
    </div>
    <script></script>
  </body>
</html>
