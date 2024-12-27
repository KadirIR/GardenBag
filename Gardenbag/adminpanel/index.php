<?php
session_start();

if (!isset($_SESSION['email'])) {
    header('Location: ../girisekrani/admingiris.php');
    exit();
}
include '../db.php';

// PDO ile veritabanı bağlantısı
try {
    $dsn = 'mysql:host=localhost;dbname=gardenbag';
    $username = 'root';
    $password = '';
    $options = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,// Hata modunu ayarla
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    );

    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    echo 'Bağlantı hatası: ' . $e->getMessage();
    exit();
}

// Ürün ekleme
if (isset($_POST['add'])) {
    $kategori = $_POST['kategori'];
    $ad = $_POST['ad'];
    $fiyat = $_POST['fiyat'];
    $detay = $_POST['detay'];
    $resim_url = $_POST['resim_url'];
    $link = $_POST['link'];

    $sql = "INSERT INTO urunler (kategori, ad, fiyat, detay, resim_url, link) VALUES (:kategori, :ad, :fiyat, :detay, :resim_url, :link)";
    $stmt = $pdo->prepare($sql);

    try {
        $stmt->execute(['kategori' => $kategori, 'ad' => $ad, 'fiyat' => $fiyat, 'detay' => $detay, 'resim_url' => $resim_url, 'link' => $link]);
        echo "Yeni kayıt başarıyla oluşturuldu!";
    } catch (PDOException $e) {
        echo "Hata: " . $e->getMessage();
    }
}

// Ürün güncelleme
if (isset($_POST['save'])) {
    $id = $_POST['id'];
    $kategori = $_POST['kategori'];
    $ad = $_POST['ad'];
    $fiyat = $_POST['fiyat'];
    $detay = $_POST['detay'];
    $resim_url = $_POST['resim_url'];
    $link = $_POST['link'];

    $sql = "UPDATE urunler SET kategori = :kategori, ad = :ad, fiyat = :fiyat, detay = :detay, resim_url = :resim_url, link = :link WHERE id = :id";
    $stmt = $pdo->prepare($sql);

    try {
        $stmt->execute(['kategori' => $kategori, 'ad' => $ad, 'fiyat' => $fiyat, 'detay' => $detay, 'resim_url' => $resim_url, 'link' => $link, 'id' => $id]);
        echo "Kayıt başarıyla güncellendi!";
    } catch (PDOException $e) {
        echo "Hata: " . $e->getMessage();
    }
}

// Ürün silme
if (isset($_POST['delete'])) {
    $id = $_POST['id'];

    $sql = "DELETE FROM urunler WHERE id = :id";
    $stmt = $pdo->prepare($sql);

    try {
        $stmt->execute(['id' => $id]);
        echo "Kayıt başarıyla silindi!";
    } catch (PDOException $e) {
        echo "Hata: " . $e->getMessage();
    }
}

// Ürünleri listeleme
$sql = "SELECT * FROM urunler";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Paneli</title>
    <link rel="stylesheet" href="adminpaneli.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" />
</head>
<body>
    <div class="container">
        <h1 style="text-align: center; color: rgb(5, 113, 200); max-width: 100%; font-size: 50px;">
            Admin Paneli
        </h1> <div style="text-align: right; margin-bottom: 10px; margin-right:25px;">
    <a href="admincikis.php" class="btn btn-primary">Çıkış Yap</a>
</div>
    </div>
   
    <div class="d-flex justify-content-center">
        <form class="w-50" action="index.php" method="post">
            <input type="text" name="kategori" id="kategori" class="form-control" placeholder="Ürün Kategorisi" autocomplete="off" />
            <input type="text" name="ad" id="ad" class="form-control" placeholder="Ürün Adı" autocomplete="off" />
            <div class="col">
                <input type="text" name="resim_url" id="resim_url" class="form-control" placeholder="Resim URL" autocomplete="off" />
            </div>
            <div class="row">
                <div class="col">
                    <input type="text" name="fiyat" id="fiyat" class="form-control" placeholder="Ürün Fiyatı" autocomplete="off" />
                </div>
            </div>
            <input type="text" name="detay" id="detay" class="form-control" placeholder="Ürün Detayı" autocomplete="off" />
            <input type="text" name="link" id="link" class="form-control" placeholder="Ürün Linki" autocomplete="off" />
            <div class="d-flex justify-content-center">
                <button type="submit" name="add" style="background-color: rgb(0, 0, 255); color: aliceblue">Kaydet</button>
                <button type="reset" name="temizle" style="background-color: rgb(203, 41, 41); color: aliceblue">Temizle</button>
            </div>
        </form>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Kategori</th>
                <th scope="col">Ürün Adı</th>
                <th scope="col">Fiyat</th>
                <th scope="col">Detay</th>
                <th scope="col">Resim URL</th>
                <th scope="col">Link</th>
                <th scope="col">Düzenle</th>
                <th scope="col">Sil</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($result as $row): ?>
            <tr>
                <th scope="row"><?php echo $row['id']; ?></th>
                <td><?php echo $row['kategori']; ?></td>
                <td><?php echo $row['ad']; ?></td>
                <td><?php echo $row['fiyat']; ?></td>
                <td><?php echo $row['detay']; ?></td>
                <td><?php echo $row['resim_url']; ?></td>
                <td><?php echo $row['link']; ?></td>
                <td>
                    <!-- Düzenleme formu burada -->
                    <form action="index.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <input type="text" name="kategori" value="<?php echo $row['kategori']; ?>">
                        <input type="text" name="ad" value="<?php echo $row['ad']; ?>">
                        <input type="text" name="fiyat" value="<?php echo $row['fiyat']; ?>">
                        <input type="text" name="detay" value="<?php echo $row['detay']; ?>">
                        <input type="text" name="resim_url" value="<?php echo $row['resim_url']; ?>">
                        <input type="text" name="link" value="<?php echo $row['link']; ?>">
                        <button type="submit" name="save" class="btn btn-warning">Güncelle</button>
                    </form>
                </td>
                <td>
                    <form action="index.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <button type="submit" name="delete" class="btn btn-danger">Sil</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
