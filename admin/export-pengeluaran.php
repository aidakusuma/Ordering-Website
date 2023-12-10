<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data_Pengeluaran.xls");
?>
<h3>Data Pengeluaran</h3>
<table border="1" cellpadding="5">
  <tr>
    <th>ID Pengeluaran</th>
    <th>Tgl Pengeluaran</th>
    <th>Jumlah</th>
  </tr>
  <?php
  // Load file koneksi.php
  include "koneksi.php";

  // Buat query untuk menampilkan semua data pengeluaran
  $query = $conn->prepare("SELECT * FROM pengeluaran");
  $query->execute();
  $result = $query->fetchAll(PDO::FETCH_ASSOC);

  // Untuk penomoran tabel, di awal set dengan 1
  foreach ($result as $data) {
    // Ambil semua data dari hasil eksekusi $sql
    echo "<tr>";
    echo "<td>" . $data['id_pengeluaran'] . "</td>";
    echo "<td>" . $data['tgl_pengeluaran'] . "</td>";
    echo "<td>" . $data['jumlah'] . "</td>";
    echo "</tr>";
  }
  ?>
</table>
