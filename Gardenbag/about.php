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
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <title>GardenBag</title>
  <style>
    .col a {
      color: #fff;
    }

    .col p {
      color: #fff;
    }

    .col strong {
      color: #fff;
    }

    .col h4 {
      color: #fff;
    }

    .copyright p {
      color: #fff;
    }
  </style>

  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <?php
  include("head.php")
  ?>

  <nav style="margin-top: 50px; margin-left: 50px;">
    <strong>Hakkımızda</strong>
    <br>
    <br>
    <p></p>
    Merhaba! Biz Kadir, Didem ve Ahmet. Çiçeklere olan tutkumuzu birleştirerek, sizlere en özel anlarınızı taçlandırmak adına bir araya geldik. Her birimiz, çiçeklerin sadece güzellikleriyle değil, aynı zamanda taşıdığı anlamlarla da hayatımızı zenginleştiren değerli objeler olduğuna inanıyoruz.
    <br><br>
    Kadir, doğanın bize sunduğu en güzel armağanlardan biri olan çiçeklerin, duyguları ifade etmede ne kadar etkili olduğuna her gün şahit. Onun için çiçekler sadece bir hobi değil, aynı zamanda bir yaşam biçimi.
    <br><br>
    Didem, çiçeklerin her renk ve formuyla birer sanat eseri olduğuna inanıyor. Onun gözünden bakıldığında bir buket, sadece bir aranjman değil, aynı zamanda bir sanat eseridir.
    <br><br>
    Ahmet ise çiçeklerin insanların duygularını, sevgisini ve saygısını ifade etmede kullanılan en eski ve en samimi yollardan biri olduğunu düşünüyor. Ona göre bir çiçek, binlerce kelimeye bedeldir.
    <br><br>
    Birlikte, online çiçek e-ticaret platformumuzu oluştururken, sizlere en taze, en özel ve anlamlı çiçekleri sunmayı amaçlıyoruz. Bizimle birlikte, sevdiklerinize veya kendinize duygusal ve estetik bir deneyim yaşatmak için bizi tercih ettiğiniz için teşekkür ederiz.

    Sevgiyle,
    Kadir, Didem ve Ahmet.</p>

  </nav>

  <?php
  include("footer1.php")
  ?>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>