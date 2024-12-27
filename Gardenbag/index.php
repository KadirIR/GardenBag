<?php
session_start();

if (!isset($_SESSION['email'])) {
  header('Location: girisekrani/giris.php');
  exit();
}
include 'db.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>GardenBag</title>
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
    .search-container {
      position: relative;

    }

    .search-icon {
      position: absolute;
      right: 10px;
      top: 50%;
      transform: translateY(-50%);
      color: black;
      cursor: pointer;
    }

    .search-input {
      padding-right: 30px;
    }

    input[type="text"] {
      background-color: #e3e6f3;
      color: black;
    }

    /* style.css */

    .pro-container {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      justify-content: center;
      margin-top: 20px;
      /* Ürünler arasında boşluk */
    }

    .pro {
      background: #fff;
      border: 1px solid #ddd;
      border-radius: 5px;
      overflow: hidden;
      transition: transform 0.3s;
      width: 200px;
      /* Ürün genişliği */
      margin: 10px;
      /* Ürünler arasında boşluk */
    }

    .pro img {
      width: 100%;
      height: auto;
    }

    .des {
      padding: 15px;
      text-align: center;
    }

    .des h5 {
      margin: 10px 0;
      font-size: 18px;
    }

    .star {
      color: #f5a623;
    }

    .pro:hover {
      transform: scale(1.05);
    }
  </style>
  </style>
</head>

<body>

  <?php
  include("head.php")
  ?>
  <section id="hero">
    <h4>RENKLİ DÜNYALAR</h4>
    <h2>KAPINIZA GELSİN</h2>
    <button><a href="shop.html" style="text-decoration: none; color: #088178;">Shop Now</a></button>
  </section>
  <div id="carouselExample" class="carousel slide mt-5">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <a href="kategoriler/buket.php"><img src="img/reklam/1.png" class="d-block w-100" alt="..." /></a>

      </div>
      <div class="carousel-item">
        <a href="kategoriler/buket.php"><img src="img/reklam/2.png" class="d-block w-100" alt="..." /></a>

      </div>
      <div class="carousel-item">
        <a href="kategoriler/orkide.php"> <img src="img/reklam/3.png" class="d-block w-100" alt="..." /></a>

      </div>
      <div class="carousel-item">
        <a href="kategoriler/saksidacicek.php"><img src="img/reklam/4.png" class="d-block w-100" alt="..." /></a>

      </div>
      <div class="carousel-item">
        <a href="kategoriler/saksidacicek.php"><img src="img/reklam/5.png" class="d-block w-100" alt="..." /></a>

      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
  <section id="product1" class="section-p1">
    <h2>Kampanyalar</h2>

    <div class="pro-container">
      <?php
      $table = 'urunler';
      $datas = $db->query("SELECT * FROM $table ORDER BY id asc")->fetchAll(PDO::FETCH_ASSOC);
      ?>
      <?php foreach ($datas as $data) : ?>
        <div class="pro" onclick="window.location.href='<?= $data['link'] ?>'">
          <img src="<?= $data['resim_url'] ?>" alt="" />
          <div class="des">
            <br /><br />
            <span><?= $data['kategori'] ?></span>
            <h5><?= $data['ad'] ?></h5>
            <div class="star">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
            </div>
            <h4><?= $data['fiyat'] ?>₺</h4>
          </div>
          <a href=""></a>
          <a href="#"><i class="fal fa-shopping-cart cart"></i></a>
        </div>
      <?php endforeach; ?>
    </div>
  </section>
  <section id="newsletter" class="section-p1 section-m1" style="margin: auto;">
    <img width="100%" src="img/uyeindirim.jpeg" alt="">
  </section>

  <?php
  include("footer.php")
  ?>



  <script src="script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>