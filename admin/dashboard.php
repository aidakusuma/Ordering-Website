<?php

include '../components/connect.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>dashboard</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

      <!-- Referensi Chart.js -->
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<?php include '../components/admin_header.php' ?>

<!-- admin dashboard section starts  -->

<section class="dashboard">

   <h1 class="heading">beranda</h1>

   <div class="box-container">
   
   <div class="box">
      <h3>Selamat Datang!</h3>
      <p><?= $fetch_profile['name']; ?></p>
      <a href="update_profile.php" class="btn">perbarui profil</a>
   </div>

   <div class="box">
      <?php
         $total_completes = 0;
         $select_completes = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
         $select_completes->execute(['selesai']);
         while($fetch_completes = $select_completes->fetch(PDO::FETCH_ASSOC)){
            $total_completes += $fetch_completes['total_price'];
         }
      ?>
      <h3><span>Rp</span><?= $total_completes; ?><span>/-</span></h3>
      <p>...</p>
      <a href="pendapatan.php" class="btn">lihat pendapatan</a>
   </div>

   <div class="box">
      <?php
         $total_pengeluaran = 0;
         $select_pengeluaran = $conn->prepare("SELECT * FROM `pengeluaran`");
         $select_pengeluaran->execute();
         while($fetch_pengeluaran = $select_pengeluaran->fetch(PDO::FETCH_ASSOC)){
            $total_pengeluaran += $fetch_pengeluaran['jumlah'];
         }
      ?>
      <h3><span>Rp</span><?= $total_pengeluaran; ?><span>/-</span></h3>
      <p>total pengeluaran</p>
      <a href="pengeluaran.php" class="btn">lihat pengeluaran</a>
   </div>

   <div class="box">
    <?php
    // Ambil data pendapatan dari database
    $queryPendapatan = $conn->prepare("SELECT * FROM orders");
    $queryPendapatan->execute();
    $dataPendapatan = $queryPendapatan->fetchAll(PDO::FETCH_ASSOC);

    // Ambil data pengeluaran dari database
    $queryPengeluaran = $conn->prepare("SELECT * FROM pengeluaran");
    $queryPengeluaran->execute();
    $dataPengeluaran = $queryPengeluaran->fetchAll(PDO::FETCH_ASSOC);

    // Hitung total pendapatan dan pengeluaran
    $totalPendapatan = array_sum(array_column($dataPendapatan, 'total_price'));
    $totalPengeluaran = array_sum(array_column($dataPengeluaran, 'jumlah'));

    // Hitung keuntungan bersih
    $keuntunganBersih = $totalPendapatan - $totalPengeluaran;
    ?>
    <h3><span>Rp</span><?= $keuntunganBersih; ?><span>/-</span></h3>
    <p>keuntungan bersih</p>
    <a href="export-semua.php" class="btn">lihat laporan keuangan</a>
   </div>


   <div class="box">
      <?php
         $total_pendings = 0;
         $select_pendings = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
         $select_pendings->execute(['diproses']);
         while($fetch_pendings = $select_pendings->fetch(PDO::FETCH_ASSOC)){
            $total_pendings += $fetch_pendings['total_price'];
         }
      ?>
      <h3><span>Rp</span><?= $total_pendings; ?><span>/-</span></h3>
      <p>dalam proses</p>
      <a href="placed_orders.php" class="btn">pesanan diproses</a>
   </div>   

   <div class="box">
      <?php
         $total_completes = 0;
         $select_completes = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
         $select_completes->execute(['selesai']);
         while($fetch_completes = $select_completes->fetch(PDO::FETCH_ASSOC)){
            $total_completes += $fetch_completes['total_price'];
         }
      ?>
      <h3><span>Rp</span><?= $total_completes; ?><span>/-</span></h3>
      <p>pesanan selesai</p>
      <a href="placed_orders.php" class="btn">pesanan selesai</a>
   </div>

   <div class="box">
      <?php
         $select_orders = $conn->prepare("SELECT * FROM `orders`");
         $select_orders->execute();
         $numbers_of_orders = $select_orders->rowCount();
      ?>
      <h3><?= $numbers_of_orders; ?></h3>
      <p>total_price pesanan</p>
      <a href="placed_orders.php" class="btn">lihat pesanan</a>
   </div>

   <div class="box">
      <?php
         $select_products = $conn->prepare("SELECT * FROM `products`");
         $select_products->execute();
         $numbers_of_products = $select_products->rowCount();
      ?>
      <h3><?= $numbers_of_products; ?></h3>
      <p>produk ditambahkan</p>
      <a href="products.php" class="btn">lihat produk</a>
   </div>

   <div class="box">
      <?php
         $select_users = $conn->prepare("SELECT * FROM `users`");
         $select_users->execute();
         $numbers_of_users = $select_users->rowCount();
      ?>
      <h3><?= $numbers_of_users; ?></h3>
      <p>akun pengguna</p>
      <a href="users_accounts.php" class="btn">lihat akun</a>
   </div>

   <div class="box">
      <?php
         $select_admins = $conn->prepare("SELECT * FROM `admin`");
         $select_admins->execute();
         $numbers_of_admins = $select_admins->rowCount();
      ?>
      <h3><?= $numbers_of_admins; ?></h3>
      <p>pengelola</p>
      <a href="admin_accounts.php" class="btn">lihat pengelola</a>
   </div>

   <div class="box">
      <?php
         $select_messages = $conn->prepare("SELECT * FROM `messages`");
         $select_messages->execute();
         $numbers_of_messages = $select_messages->rowCount();
      ?>
      <h3><?= $numbers_of_messages; ?></h3>
      <p>pesan baru</p>
      <a href="messages.php" class="btn">lihat pesan</a>
   </div>

   <div class="box">
        <canvas id="perbandinganChart" width="400" height="200"></canvas>
        <p>Perbandingan Pendapatan dan Pengeluaran</p>
    </div>

    <div class="box">
      <p>reset data</p>
      <a href="reset_data.php" class="btn">reset</a>
   </div>   

   </div>

</section>

<!-- admin dashboard section ends -->


<script>
document.addEventListener('DOMContentLoaded', function() {
    // Ambil data perbandingan pendapatan dan pengeluaran dari database
    fetch('data_pendapatan_pengeluaran.php')
        .then(response => response.json())
        .then(data => {
            // Data Perbandingan Pendapatan dan Pengeluaran (Pie Chart)
            var pieChartData = {
                labels: ['Pendapatan', 'Pengeluaran'],
                datasets: [{
                    data: [data.pendapatan, data.pengeluaran],
                    backgroundColor: ['rgba(75, 192, 192, 0.8)', 'rgba(255, 99, 132, 0.8)'],
                    borderColor: ['rgba(75, 192, 192, 1)', 'rgba(255, 99, 132, 1)'],
                    borderWidth: 1,
                }]
            };

            // Konfigurasi Pie Chart
            var pieChartConfig = {
                type: 'pie',
                data: pieChartData,
            };

            // Mendapatkan elemen canvas dan menggambar grafik
            var pieChartCanvas = document.getElementById('perbandinganChart').getContext('2d');
            new Chart(pieChartCanvas, pieChartConfig);
        })
        .catch(error => console.error('Error:', error));
});
</script>

<!-- Referensi Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>