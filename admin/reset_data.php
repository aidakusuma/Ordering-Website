<?php
include '../components/connect.php';

// Fungsi untuk menghapus data pada tabel orders
function resetOrders($conn) {
    $deleteOrders = $conn->prepare("DELETE FROM orders");
    $deleteOrders->execute();
}

// Fungsi untuk menghapus data pada tabel pengeluaran
function resetPengeluaran($conn) {
    $deletePengeluaran = $conn->prepare("DELETE FROM pengeluaran");
    $deletePengeluaran->execute();
}

// Fungsi untuk menghapus data pada tabel messages
function resetMessages($conn) {
    $deleteMessages = $conn->prepare("DELETE FROM messages");
    $deleteMessages->execute();
}

// Jalankan fungsi reset
resetOrders($conn);
resetPengeluaran($conn);
resetMessages($conn);

// Redirect kembali ke halaman admin setelah reset
header('Location: dashboard.php');
exit();
?>
