<?php
session_start();

if (!isset($_SESSION['email'])) {
    header('Location: girisekrani/giris.php');
    exit();
}

include '../db.php';


if (isset($_POST['sepete_ekle'])) {
  // Kullanıcı oturumunu başlat
  $kulid = $_SESSION['email'];

  // Ürün eklemeyi sağla
  $urunid = $_POST['urun_id']; // Formdan gelen ürün ID'sini al
  $miktar = 1; // Varsayılan miktar

  $sorgu = "INSERT INTO sepet (kulid, urunid, miktar) VALUES (?, ?, ?)";
  $stmt = $db->prepare($sorgu);
  $stmt->bindParam(1, $kulid, PDO::PARAM_INT);
  $stmt->bindParam(2, $urunid, PDO::PARAM_INT);
  $stmt->bindParam(3, $miktar, PDO::PARAM_INT);
  $stmt->execute();

  if ($stmt->rowCount() > 0) {
      // Ürün sepete başarıyla eklendi, kullanıcıyı sepeti görüntüleme sayfasına yönlendir
      header('Location: ../sepet/sepet.php');
      exit();
  } else {
      echo "Ürün sepete eklenemedi.";
  }
}
// Favorilere ekleme işlemi
if (isset($_POST['favorilere_ekle'])) {
  $kulid = $_SESSION['email'];
  $urunid = $_POST['urun_id'];

  try {
      $sorgu = "INSERT INTO favoriler (kullanici_id, urun_id) VALUES (?, ?)";
      $stmt = $db->prepare($sorgu);
      $stmt->bindParam(1, $kulid, PDO::PARAM_STR); 
      $stmt->bindParam(2, $urunid, PDO::PARAM_INT);
      $stmt->execute();

      if ($stmt->rowCount() > 0) {
          header('Location: ../fav.php');
          exit();
      } else {
          echo "Ürün favorilere eklenemedi.";
      }
  } catch (PDOException $e) {
      echo "Hata: " . $e->getMessage();
  }
}
?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>GardenBag</title>
    <link rel="stylesheet" href="../style.css" />
    <link rel="stylesheet" href="../contents.css" />
 
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
      integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
  </head>
  <body>
    <section id="header">
      <a href="#"
        ><img
          src="../img/logolar/gardenbagseffaf.png"
          class="logo"
          alt=""
          width="130px"
      /></a>
 
      <div>
        <ul id="navbar">
          <li><a class="active" href="../index.php">Ana Sayfa</a></li>
          <li><a href="../shop.php">Ürünler</a></li>
 
          <li><a href="../contact.php">Hakkımızda</a></li>
          <li><a href="../cikis.php">Çıkış Yap</a></li>
 
          <li>
            <a href="../fav.php"
              ><i class="fa-sharp fa-regular fa-heart like"></i
            ></a>
          </li>
          <li id="lg-bag">
            <a href="../sepet/sepet.php"><i class="fa-solid fa-cart-shopping"></i></a>
          </li>
          <a href="#" id="close"><i class="fa-solid fa-bars"></i></a>
        </ul>
      </div>
      
      <div id="mobile">
        <a href="../sepet/sepet.html"><i class="fa-solid fa-cart-shopping"></i></a>
        <i id="bar" class="fa-solid fa-bars"></i>
      </div>

    </section>
 
    <section id="prodetalis" class="section-p1">
      <?php
    $table = 'urunler';
    $sql = "SELECT * FROM $table WHERE id = '5'";
    $datas = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <?php foreach($datas as $data): ?>
      <div class="single-pro-image">
      
        <img
          src="../<?=$data['resim_url']?>"
          width="100%"
          id="MainImg"
          alt=""
          style="border: 5px solid gray"
        />
      </div>
 
      <div class="single-pro-details">
        <div style="display: flex">
          <a
            href="../index.php"
            style="text-decoration: none; color: black; padding-right: 5px"
            >Anasayfa</a
          >
          <a href="#" style="text-decoration: none; color: black">/ <?=$data['kategori']?> </a>
        </div>
        <h4><?=$data['ad']?></h4>
        <h2><?=$data['fiyat']?>₺</h2>
        <div style="display: flex; align-items: center; gap: 10px">
          <form method="post" action="flower5.php">
              <input type="hidden" name="urun_id" value="5">
              <!-- Yukarıdaki satırda "urun_id" adında gizli bir input ile sepete eklenen ürünün ID'sini gönderiyoruz -->
              <button type="submit" name="sepete_ekle" class="normal">Sepete Ekle</button>
          </form>

 
          <form method="post" action="flower5.php">
                    <input type="hidden" name="urun_id" value="<?=$data['id']?>">
                    <button type="submit" name="favorilere_ekle" class="normal">Favorilere Ekle</button>
                </form>
        </div>
        <h4>Detaylı içerik</h4>
        <p>
        <?=$data['detay']?>
        </p>
      </div>
      <?php endforeach; ?>

    </section>
 
    <section id="newsletter" class="section-p1 section-m1" style="margin: auto">
      <img width="100%" src="../img/uyeindirim.jpeg" alt="" />
    </section>
 
    <footer class="section-p1">
      <div class="col">
        <img class="logo" src="../img/logolar/gardenbag.png" width="130px" />
        <h4>İLETİŞİM</h4>
        <p><strong>Adres: </strong>KIRKLARELI/MERKEZ.</p>
        <p><strong>Telefon:</strong>05343132002</p>
        <p><strong>Çalışma Saatleri:</strong> 10:00 - 18:00</p>
        <div class="follow">
          <h4>TAKIP ET</h4>
          <div class ="icon">
            <i class="fab fa-facebook-f"></i>
            <i class="fab fa-twitter"></i>
            <i class="fab fa-instagram"></i>
            <i class="fab fa-pinterest-p"></i>
            <i class="fab fa-youtube"></i>
          </div>
        </div>
      </div>
      <div class="col">
        <h4>HAKKINDA</h4>
        <a href="../about.html">Hakkımızda</a>
        <a href="#">Teslimat Bilgisi</a>
        <a href="#">Gizlilik politikası</a>
        <a href="../contact.html">Iletişim</a>
      </div>
 
      <div class="col">
        <h4>HESABIM</h4>
        <a href="../uyeolma/uyeolma.html">Uye Ol</a>
        <a href="https://www.yurticikargo.com/">Sipariş Takibi</a>
        <a href="#">Yardım</a>
      </div>
 
      <div class="col install">
        <h4>UYGULAMAYI YÜKLE</h4>
        <p> App Store veya Google Play</p>
        <div class="row">
          <a href="https://www.apple.com/tr/app-store/">
          <img src="../img/pay/app.jpg" alt="" /></a>
          <a href="https://play.google.com/store/apps?hl=tr&gl=US&pli=1">
          <img src="../img/pay/play.jpg" alt="" /></a>
        </div>
        <p>GÜVENLİ ÖDEME</p>
        <img src="../img/pay/pay.png" alt="" />
      </div>
 
      <div class="copyright">
        <p>© 2024, Ahmet-Didem-Kadir - Html Css Js E-commerce Website</p>
      </div>
    </footer>
 
    <script src="../script.js"></script>
  </body>
</html>