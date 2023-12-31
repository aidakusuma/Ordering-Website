<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data_Pemasukan.xls");
?>
<h3>Data Pemasukan</h3>
<table border="1" cellpadding="5">
  <tr>
    <th>ID Pemasukan</th>
    <th>Tgl Pemasukan</th>
    <th>Jumlah</th>
  </tr>
  <?php
  // Load file koneksi.php
  include "koneksi.php";

  // Buat query untuk menampilkan semua data pemasukan
  $query = $conn->prepare("SELECT * FROM pemasukan");
  $query->execute();
  $result = $query->fetchAll(PDO::FETCH_ASSOC);

  // Untuk penomoran tabel, di awal set dengan 1
  foreach ($result as $data) {
    // Ambil semua data dari hasil eksekusi $sql
    echo "<tr>";
    echo "<td>" . $data['id_pemasukan'] . "</td>";
    echo "<td>" . $data['tgl_pemasukan'] . "</td>";
    echo "<td>" . $data['jumlah'] . "</td>";
    echo "</tr>";
  }
  ?>
</table>
