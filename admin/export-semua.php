<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Laporan_Keuangan.xls");
?>

<h3>Data Pemasukan</h3>
<table border="1" cellpadding="5">
  <tr>
    <th>ID</th>
    <th>nama pemesan</th>
    <th>tanggal</th>
    <th>Jumlah</th>
  </tr>
  <?php
  include '../components/connect.php';
  session_start();

  $admin_id = $_SESSION['admin_id'];

  if (!isset($admin_id)) {
    header('location:admin_login.php');
  }

  $queryPemasukan = $conn->prepare("SELECT * FROM orders");
  $queryPemasukan->execute();
  $resultPemasukan = $queryPemasukan->fetchAll(PDO::FETCH_ASSOC);

  $totalPendapatan = 0; // Inisialisasi total pendapatan

  foreach ($resultPemasukan as $dataPemasukan) {
    echo "<tr>";
    echo "<td>" . $dataPemasukan['id'] . "</td>";
    echo "<td>" . $dataPemasukan['name'] . "</td>";
    echo "<td>" . $dataPemasukan['placed_on'] . "</td>";
    echo "<td>" . $dataPemasukan['total_price'] . "</td>";
    echo "</tr>";

    // Menambahkan jumlah pendapatan ke totalPendapatan
    $totalPendapatan += $dataPemasukan['total_price'];
  }
  ?>
  <tr>
    <td colspan="3">Total Pendapatan</td>
    <td>Rp<?= $totalPendapatan; ?></td>
  </tr>
</table>

<br>
<br>

<h3>Data Pengeluaran</h3>
<table border="1" cellpadding="5">
  <tr>
    <th>ID Pengeluaran</th>
    <th>Tgl Pengeluaran</th>
    <th>Jumlah</th>
  </tr>
  <?php
  $queryPengeluaran = $conn->prepare("SELECT * FROM pengeluaran");
  $queryPengeluaran->execute();
  $resultPengeluaran = $queryPengeluaran->fetchAll(PDO::FETCH_ASSOC);

  $totalPengeluaran = 0; // Inisialisasi total pengeluaran

  foreach ($resultPengeluaran as $dataPengeluaran) {
    echo "<tr>";
    echo "<td>" . $dataPengeluaran['id_pengeluaran'] . "</td>";
    echo "<td>" . $dataPengeluaran['tgl_pengeluaran'] . "</td>";
    echo "<td>" . $dataPengeluaran['jumlah'] . "</td>";
    echo "</tr>";

    // Menambahkan jumlah pengeluaran ke totalPengeluaran
    $totalPengeluaran += $dataPengeluaran['jumlah'];
  }
  ?>
  <tr>
    <td colspan="2">Total Pengeluaran</td>
    <td>Rp<?= $totalPengeluaran; ?></td>
  </tr>
</table>

<br>
<br>

<?php
// Hitung keuntungan bersih
$keuntunganBersih = $totalPendapatan - $totalPengeluaran;
?>

<h3>Keuntungan Bersih</h3>
<p>Rp<?= $keuntunganBersih; ?></p>
