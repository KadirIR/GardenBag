<?php
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

if (isset($_POST["kaydet"])) {
  $name = $_POST["ad"];
  $surname = $_POST["soyad"];
  $email = $_POST["email"];
  $password = password_hash($_POST["sifre"], PASSWORD_DEFAULT);

  $ekle = "INSERT INTO kullanicilar (ad, soyad, email, parola) VALUES ('$name', '$surname', '$email', '$password')";
  $calistirekle = mysqli_query($conn, $ekle);

  if ($calistirekle) {
    // Başarılı bir şekilde eklendiğinde giriş sayfasına yönlendir
    header("Location: ../girisekrani/giris.php");
    exit();
  } else {
    echo "Kayıt başarısız: " . mysqli_error($conn);
  }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GardenBag</title>
  <link rel="stylesheet" href="uyeolma.css">
  <link rel="stylesheet" href="../style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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

</head>

<body>
<section id="header">
    <a href="#"><img src="gardenbagseffaf.png" class="logo" alt="" width="130px"></a>
    <div>
        <ul id="navbar">
            <li><a class="active" href="../index.php">Ana Sayfa</a></li>
            <li><a href="../shop.php">Ürünler</a></li>
            <li><a href="../about.php">Hakkımızda</a></li>
            <li><a href="../contact.php">İletişim</a></li>
            <li><a href="../girisekrani/giris.php">Giris Yap</a></li>
            <li id="lg-bag">
                <a href="#"><i class="fa-brands fa-whatsapp"></i></a>
            </li>
            <a href="#" id="close"><i class="far fa-times"></i></a>
        </ul>
    </div>
    <div id="mobile">
        <a href="#"><i class="fa-brands fa-whatsapp"></i></a>
        <i id="bar" class="fas fa-outdent"></i>
    </div>
</section>

  <div class="logo">
    <img src="logo.png" alt="" width="400px">
  </div>
  <div class="container">
    <div class="logo">
      <span class="baslik">Hızlı Üyelik</span>
    </div>

    <form action="kayit.php" method="post">

      <input type="text" id="ad" name="ad" placeholder="Adınız" required>

      <input type="text" id="soyad" name="soyad" placeholder="Soyadınız" required>

      <input type="email" id="email" name="email" placeholder="E-posta" required>

      <input type="password" id="sifre" name="sifre" placeholder="Şifre" required>

      <button type="submit" name="kaydet" style="color: white; text-decoration: none; list-style-type: none;">Üye Ol</button>

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
</body>

</html>