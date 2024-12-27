<?php
session_start();
// Eğer oturumda email yoksa kullanıcıyı giriş ekranına yönlendir
if (!isset($_SESSION['email'])) {
    header('Location: girisekrani/giris.php');
    exit();
}

include 'db.php';

// Favorilerden silme işlemi
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['urun_id'])) {
    $kullanici_id = $_SESSION['email'];// Oturumdaki kullanıcı emailini değişkene atama
    $urun_id = $_POST['urun_id'];

    try {
        $sorgu = "DELETE FROM favoriler WHERE kullanici_id = ? AND urun_id = ?";
        $stmt = $db->prepare($sorgu);
        $stmt->bindParam(1, $kullanici_id, PDO::PARAM_INT);// Kullanıcı ID'sini bağlama
        $stmt->bindParam(2, $urun_id, PDO::PARAM_INT);
        $stmt->execute();// Sorguyu çalıştırma

        if ($stmt->rowCount() > 0) {
            // Ürün favorilerden başarıyla silindi, kullanıcıyı favoriler sayfasına yönlendir
            header('Location: fav.php');
            exit();
        } else {
            echo "Ürün favorilerden silinemedi.";
        }
    } catch (PDOException $e) {
        echo "Hata: " . $e->getMessage();
    }
}

// Favorileri getirme işlemi
$kullanici_id = $_SESSION['email'];
$sorgu = "SELECT p.* FROM urunler p INNER JOIN favoriler f ON p.id = f.urun_id WHERE f.kullanici_id = ?";
$stmt = $db->prepare($sorgu);
$stmt->execute([$kullanici_id]);
$sonuc = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>GardenBag</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <?php
    include("head.php")
    ?>

    <section id="page-headerfav">
        <!-- Boş bırakıldı, istenirse buraya başlık eklenebilir -->
    </section>

    <section id="product1" class="section-p1">
        <div class="pro-container">
            <?php
            foreach ($sonuc as $satir) {
                echo '<div class="pro">';
                echo '<img src="' . $satir['resim_url'] . '" alt="" />';
                echo '<div class="des">';
                echo '<span>' . $satir['kategori'] . '</span>';
                echo '<h5>' . $satir['ad'] . '</h5>';
                echo '<div class="star">';
                echo '<i class="fas fa-star"></i>';
                echo '<i class="fas fa-star"></i>';
                echo '<i class="fas fa-star"></i>';
                echo '<i class="fas fa-star"></i>';
                echo '<i class="fas fa-star"></i>';
                echo '</div>';
                echo '<h4>' . $satir['fiyat'] . '₺</h4>';
                echo '</div>';
                echo '<a href="#"><i class="fal fa-shopping-cart cart"></i></a>';
                // Favorilerden silme formu
                echo '<form method="post" action="fav.php" style="display:inline-block; margin-top:10px;">';
                echo '<input type="hidden" name="urun_id" value="' . $satir['id'] . '">';
                echo '<button type="submit" name="favorilerden_sil" class="normal">Favorilerden Sil</button>';
                echo '</form>';
                echo '</div>';
            }
            ?>
        </div>
    </section>

    <section id="newsletter" class="section-p1 section-m1">
        <img width="100%" src="img/uyeindirim.jpeg" alt="">
    </section>

    <?php
    include("footer.php")
    ?>

    <script src="script.js"></script>
</body