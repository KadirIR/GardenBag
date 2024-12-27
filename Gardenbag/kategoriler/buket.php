<?php
session_start();

if (!isset($_SESSION['email'])) {
    header('Location: ../girisekrani/giris.php');
    exit();
}
include '../db.php';

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>GardenBag</title>
    <link rel="stylesheet" href="../style.css" />
    <link
      rel="stylesheet"
      href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
    />
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
      <a href="#"><img src="../img/logolar/gardenbagseffaf.png" class="logo" alt="" width="130px"/></a>

      <div>
        <ul id="navbar">
        <li><a class="active" href="../index.php">Ana Sayfa</a></li>
          <li><a href="../shop.php">Ürünler</a></li>
          <li><a href="../about.php">Hakkımızda</a></li>
          <li><a href="../contact.php">İletişim</a></li>
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
        <a href="../sepet/sepet.php"><i class="fa-solid fa-cart-shopping"></i></a>
        <i id="bar" class="fa-solid fa-bars"></i>
      </div>

    </section>

    <section id="page-headerbuket">
      

    </section>

    <section id="product1" class="section-p1">
   
      <div class="pro-container">
    <?php
    $table = 'urunler';
    // Sadece "buket" kategorisine sahip ürünleri seç
    $sql = "SELECT * FROM $table WHERE kategori = 'Buket' ORDER BY id ASC";
    $datas = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <?php foreach($datas as $data): ?>
    <div class="pro"onclick="window.location.href='../<?=$data['link']?>'">
        <img src="../<?=$data['resim_url']?>" alt="" />
        <div class="des">
            <br /><br />
            <span><?=$data['kategori']?></span>
            <h5><?=$data['ad']?></h5>
            <div class="star">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
            <h4><?=$data['fiyat']?>₺</h4>
        </div>
        <a href="#"></a>
        <a href="#"><i class="fal fa-shopping-cart cart"></i></a>
    </div>
    <?php endforeach; ?>
</div>

       </section>

    <footer class="section-p1">
      <div class="col">
        <img class="logo" src="../img/logolar/gardenbag.png" width="130px" />
        <h4>Contact</h4>
        <p><strong>Address: </strong>Lorem ipsum dolor sit amet consectetur.</p>
        <p><strong>Phone :</strong>81278937217</p>
        <p><strong>Hours :</strong> 10:00 - 18:00 Mon - Sat</p>
        <div class="follow">
          <h4>Follow Us</h4>
          <div class="icon">
            <i class="fab fa-facebook-f"></i>
            <i class="fab fa-twitter"></i>
            <i class="fab fa-instagram"></i>
            <i class="fab fa-pinterest-p"></i>
            <i class="fab fa-youtube"></i>
          </div>
        </div>
      </div>
      <div class="col">
        <h4>About</h4>
        <a href="#">About us</a>
        <a href="#">Delivery Information</a>
        <a href="#">Privacy Policy</a>
        <a href="#">Terms & Conditions</a>
        <a href="#">Contact Us</a>
      </div>

      <div class="col">
        <h4>My Account</h4>
        <a href="#">Sign In</a>
        <a href="#">View Cart</a>
        <a href="#">My Wishlist</a>
        <a href="#">Track My Order</a>
        <a href="#">Help</a>
      </div>

      <div class="col install">
        <h4>Install App</h4>
        <p>From App Store or Google Play</p>
        <div class="row">
          <img src="../img/pay/app.jpg" alt="" />
          <img src="../img/pay/play.jpg" alt="" />
        </div>
        <p>Secured Payment Gateways</p>
        <img src="../img/pay/pay.png" alt="" />
      </div>

      <div class="copyright">
        <p>© 2023, Ahmet-Didem-Kadir - Html Css Js E-commerce Website</p>
      </div>
    </footer>

    <script src="script.js"></script>
  </body>
</html>
