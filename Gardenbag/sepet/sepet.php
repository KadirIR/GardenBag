<?php
session_start();
// Eğer oturumda email yoksa kullanıcıyı giriş ekranına yönlendir
if (!isset($_SESSION['email'])) {
    header('Location: girisekrani/giris.php');
    exit();
}

include '../db.php';

$kulid = $_SESSION['email'];


// Kullanıcının sepetindeki ürünleri ve miktarlarını veritabanından çekme sorgusu
$sorgu = "SELECT p.*, s.miktar FROM urunler p INNER JOIN sepet s ON p.id = s.urunid WHERE s.kulid = :kulid";
$stmt = $db->prepare($sorgu);
$stmt->bindParam(":kulid", $kulid);
$stmt->execute();
$sonuc = $stmt->fetchAll();

// Eğer silme işlemi yapıldıysa
if (isset($_POST['urun_sil'])) {
    $urunid = $_POST['urun_id'];

    // Sepetten ürünü sil
    $sil_sorgu = "DELETE FROM sepet WHERE kulid = :kulid AND urunid = :urunid";
    $sil_stmt = $db->prepare($sil_sorgu);
    $sil_stmt->bindParam(":kulid", $kulid);
    $sil_stmt->bindParam(":urunid", $urunid);
    $sil_stmt->execute();

    // Sepetteki ürünü göstermek için sorguyu güncelle
    $sorgu = "SELECT p.*, s.miktar FROM urunler p INNER JOIN sepet s ON p.id = s.urunid WHERE s.kulid = :kulid";
    $stmt = $db->prepare($sorgu);
    $stmt->bindParam(":kulid", $kulid);
    $stmt->execute();
    $sonuc = $stmt->fetchAll();
}

$toplam_tutar = 0; // Toplam sipariş tutarını başlat
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>GardenBag</title>
    <link rel="stylesheet" href="../style.css" />
    <link rel="stylesheet" href="sepet.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
    <section id="header">
        <a href="#"><img src="../img/logolar/gardenbagseffaf.png" class="logo" alt="" width="130px" /></a>

        <div>
            <ul id="navbar">
                <li><a href="../index.php">Ana Sayfa</a></li>
                <li><a class="active" href="../shop.php">Ürünler</a></li>
                <li><a href="../contact.php">Hakkımızda</a></li>
                <li><a href="../cikis.php">Çıkış Yap</a></li>
                <li>
                    <a href="../fav.php"><i class="fa-sharp fa-regular fa-heart like"></i></a>
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
    <section id="page-headersepet">

    </section>

    <div class="sepet">
        <div class="urun">
            <?php
            $toplam_tutar = 0; // Toplam sipariş tutarını başlat
            foreach ($sonuc as $satir) :
                $urun_tutari = $satir['miktar'] * $satir['fiyat']; // Ürün tutarını hesapla
                $toplam_tutar += $urun_tutari; // Toplam sipariş tutarını güncelle
            ?>
                <div class="urun-detay">
                    <!-- Ürün resmi -->
                    <img src="../<?= $satir['resim_url'] ?>" alt="Ürün Resmi">
                    <!-- Ürün detayları -->
                    <h4>Ad: <?= $satir['ad'] ?></h4>
                    <p>Kategori: <?= $satir['kategori'] ?></p>
                    <!-- Miktar düzenleme -->
                    <div class="miktar">
                        <button onclick="miktarAzalt(<?= $satir['fiyat'] ?>)">-</button>
                        <input type="number" id="miktar" value="<?php echo $satir['miktar']; ?>">
                        <button onclick="miktarArtir(<?= $satir['fiyat'] ?>)">+</button>
                    </div>
                    <!-- Ürün fiyatı -->
                    <div class="fiyat">
                        <p id="fiyat"><?= $urun_tutari ?>₺</p>
                    </div>
                    <!-- Ürünü sil butonu -->
                    <form method="post">
                        <input type="hidden" name="urun_id" value="<?= $satir['id'] ?>">
                        <button type="submit" name="urun_sil">Sil</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>


        <div class="sepet-ozet">
            <h2>Sipariş Özeti</h2>
            <p>Sipariş Tutarı: <span id="siparis-tutari"><?= $toplam_tutar ?>₺</span></p>
            <button>SİPARİŞİ TAMAMLA</button>
        </div>
    </div>

    <section id="product1" class="section-p1">
        <div class="pro-container">
            <section id="newsletter" class="section-p1 section-m1">

                <img width="100%" src="../img/uyeindirim.jpeg" alt="">

            </section>
            <?php
            include("footer.php")
            ?>

            <script>
                // Miktarı artıran fonksiyon
                function miktarArtir(urunFiyati) {
                    var miktarInput = document.getElementById('miktar');
                    var miktar = parseInt(miktarInput.value);
                    miktarInput.value = miktar + 1;
                    fiyatGuncelle(miktar + 1, urunFiyati);
                }

                // Miktarı azaltan fonksiyon
                function miktarAzalt(urunFiyati) {
                    var miktarInput = document.getElementById('miktar');
                    var miktar = parseInt(miktarInput.value);
                    if (miktar > 1) {
                        miktarInput.value = miktar - 1;
                        fiyatGuncelle(miktar - 1, urunFiyati);
                    }
                }

                // Fiyatı güncelleyen fonksiyon
                function fiyatGuncelle(miktar, urunFiyati) {
                    var fiyat = document.getElementById('fiyat');
                    var siparisTutari = document.getElementById('siparis-tutari');
                    var toplamFiyat = urunFiyati * miktar;
                    fiyat.textContent = toplamFiyat.toFixed(2) + '₺';
                    siparisTutari.textContent = toplamFiyat.toFixed(2) + '₺';
                }
            </script>

</body>

</html>