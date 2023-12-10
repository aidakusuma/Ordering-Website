<?php
include '../components/connect.php';

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

// Struktur data untuk Chart.js
$result = [
    "pendapatan" => $totalPendapatan,
    "pengeluaran" => $totalPengeluaran,
    "detailPendapatan" => $dataPendapatan,  // Detail untuk grafik line
    "detailPengeluaran" => $dataPengeluaran  // Detail untuk grafik pie
];

header('Content-Type: application/json');
echo json_encode($result);
?>
