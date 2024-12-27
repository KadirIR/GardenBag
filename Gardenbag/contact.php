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
      color: black;
    }

    .col h4 {
      color: black;
    }

    .copyright p {
      color: black;
    }
  </style>

  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
  <?php
  include("head.php")
  ?>

  <div class="contact row">
    <h3>İletişime Geç</h3>

    <div class="col-md-6 mb-4">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d95272.5734334137!2d27.0702305106856!3d41.73631365902301!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40a7536dd7f878bd%3A0x2c4e9cd3b6d583a6!2zS8SxcmtsYXJlbGksIEvEsXJrbGFyZWxpIE1lcmtlei9LxLFya2xhcmVsaQ!5e0!3m2!1str!2str!4v1705417644872!5m2!1str!2str" width="100%" height="530px" style="border: 0" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    <div class="col-md-6 forms">
      <div class="alert alert-warning mt-3" role="alert">
        Lütfen formu doldurunuz.
      </div>

      <div class="row">
        <div class="col-6">
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label text-white">Email adresi:</label>
            <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="@gmail.com" />
          </div>
        </div>
        <div class="col-6">
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label text-white">Ad:</label>
            <input type="name" class="form-control" id="exampleFormControlInput1" placeholder="name" />
          </div>
        </div>
        <div class="col-12">
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label text-white">Telefon:</label>
            <input type="phone" class="form-control" id="exampleFormControlInput1" placeholder="phone" />
          </div>
        </div>
        <div class="col-12">
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label text-white">Konu:</label>
            <input type="subject" class="form-control" id="exampleFormControlInput1" placeholder="subject" />
          </div>
        </div>
        <div class="col-12 mb-3">
          <label for="exampleFormControlTextarea1" class="form-label text-white">Metininizi Giriniz:</label>
          <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
        <div class="col-12 mb-3">
          <button type="button" class="btn btn-outline-warning col-12">
            Mesaj Gönder
          </button>
        </div>
      </div>
    </div>
  </div>


  <?php
  include("footer.php")
  ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>