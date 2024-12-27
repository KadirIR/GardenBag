<?php
session_start();

// Veritabanı bağlantısını yap
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gardenbag";

// Veritabanı bağlantısı oluştur
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantıyı kontrol et
if ($conn->connect_error) {
  die("Bağlantı hatası: " . $conn->connect_error);
}

if (isset($_POST["giris"])) {
  $email = $_POST["email"];
  $password = $_POST["sifre"];
}

if (isset($email) && isset($password)) {
  $secim = "SELECT * FROM kullanicilar WHERE email='$email'";
  $calistir = mysqli_query($conn, $secim);
  $kayitsayisi = mysqli_num_rows($calistir);

  if ($kayitsayisi > 0) {
    $ilgilikayit = mysqli_fetch_assoc($calistir);
    $hashlisifre = $ilgilikayit["parola"];
    if (password_verify($password, $hashlisifre)) {
      $_SESSION["email"] = $ilgilikayit["email"];
      header("Location: ../adminpanel/index.php");
      exit();
    } else {
      echo "Şifre hatalı";
    }
  } else {
    echo "Email yanlış";
  }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="tr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer">
  <link rel="stylesheet" href="girisekrani.css">
  <title>GardenBag</title>
  <style>
    .col a {
      color: #fff;
    }

    .col h4 {
      color: #fff;
    }

    .copyright p {
      color: #fff;
    }
  </style>
  <link rel="stylesheet" href="../style.css">
</head>

<body>
  <?php
  include("head.php")
  ?>

  <header>
    <img src="logo.png" alt="" width="400px">
  </header>
  <div class="container">
    <div class="grse" style="display: flex; margin: auto">
      <div class="logo logo-1" style="padding-left: 85px">
        <a href="giris.php" style="text-decoration: none; color: gray"><span class="baslik">Üye Girişi</span></a>
      </div>
      <div class="logo logo-2">
        <a href="../girisekrani/admingiriş.php" style="text-decoration: none"><span class="baslik" style="padding-left: 150px; color: black">Admin Girişi</span></a>
      </div>
    </div>

    <form action="admingiriş.php" method="post">
      <input type="email" id="email" name="email" placeholder="E-posta" required>
      <input type="password" id="sifre" name="sifre" placeholder="Şifre" required>
      <button type="submit" name="giris" style="color: white; text-decoration: none; list-style-type: none">Giriş Yap</button>
    </form>
  </div>

  <footer class="section-p1" style="background-color: black">
      <div class="col">
        <img
          class="logo"
          a src="gardenbag.png"
          width="100px"
        >
     
        <h4>İLETİŞİM</h4>
        <p style="color: white">
          <strong>Adres: </strong>KIRKLARELI/MERKEZ
        </p>
        <p style="color: white"><strong>Telefon :</strong>05442772642</p>
        <p style="color: white">
          <strong>Çalışma Saatleri:</strong> 10:00 - 18:00
        </p>
        <div class="follow">
          <h4>Takip Et</h4>
          <div class="icon">
            <i style="color: #fff" class="fab fa-facebook-f"></i>
            <i
              style="color: #fff"
              style="color: #fff"
              class="fab fa-twitter"
            ></i>
            <i style="color: #fff" class="fab fa-instagram"></i>
            <i style="color: #fff" class="fab fa-pinterest-p"></i>
            <i style="color: #fff" class="fab fa-youtube"></i>
          </div>
        </div>
      </div>
      <div class="col">
        <h4>HAKKINDA</h4>
      <a href="../about.php">Hakkımızda</a>
      <a href="#">Teslimat Bilgisi</a>
      <a href="#">Gizlilik politikası</a>
      <a href="../contact.php">Iletişim</a>
    </div>
     
    <div class="col">
      <h4>HESABIM</h4>
      <a href="../uyeolma/kayit.php">Uye Ol</a>
      <a href="https://www.yurticikargo.com/">Sipariş Takibi</a>
      <a href="#">Yardım</a>
    </div>
     
      <div class="col install">
        <h4 style="color: white;">UYGULAMAYI YÜKLE</h4>
        <p style="color: white">App Store VEYA Google Play</p>
        <div class="row">
          <a href="https://www.apple.com/tr/app-store/">
          <img src="../img/pay/app.jpg" alt="" /></a>
          <a href="https://play.google.com/store/apps?hl=tr&gl=US&pli=1">
          <img src="../img/pay/play.jpg" alt="" /></a>
        </div>
        <p style="color: white">Güvenli Ödeme</p>
        <img src="../img/pay/pay.png" alt="" />
      </div>
    </footer>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
      crossorigin="anonymous"
    ></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>