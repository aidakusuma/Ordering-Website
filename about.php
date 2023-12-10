<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>tentang</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<!-- header section starts  -->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->

<div class="heading">
   <h3>tentang kami</h3>
   <p><a href="home.php">halaman utama</a> <span> / tentang</span></p>
</div>

<!-- about section starts  -->

<section class="about">

   <div class="row">

      <div class="image">
         <img src="images/about-img.svg" alt="">
      </div>

      <div class="content">
         <h3>mengapa memilih kita?</h3>
         <a href="menu.html" class="btn">menu kami</a>
      </div>

   </div>

</section>

<!-- about section ends -->

<!-- steps section starts  -->

<section class="steps">

   <h1 class="title">langkah-langkah sederhana</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/step-1.png" alt="">
         <h3>pilih pesanan</h3>
         <p>pilih menu yang kamu inginkan, ganti jumlah makanan yang kamu inginkan, lalu klik keranjang yang ada pada menu!</p>
      </div>

      <div class="box">
         <img src="images/step-2.png" alt="">
         <h3>Lakukan pembayaran</h3>
         <p>Klik gambar keranjang yang ada di kanan atas laman, lalu lanjutkan pembayaran, pilih metode pembayaran dan submit!</p>
      </div>

      <div class="box">
         <img src="images/step-3.png" alt="">
         <h3>nikmati pesanananmu</h3>
         <p>Tunggu makanan disiapkan dan nikmati pesananmu!</p>
      </div>

   </div>

</section>

<!-- steps section ends -->

<!-- reviews section starts  -->


<!-- reviews section ends -->



















<!-- footer section starts  -->
<?php include 'components/footer.php'; ?>
<!-- footer section ends -->=






<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>


</body>
</html>