<!-- File: hapus-pengeluaran.php -->
<?php
// include('dbconnected.php');
include '../components/connect.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:admin_login.php');
}

$id = $_GET['id_pengeluaran'];

try {
    // Ambil koneksi dari file koneksi.php
    global $conn;

    // Query hapus data
    $query = "DELETE FROM `pengeluaran` WHERE id_pengeluaran = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        // Redirect ke halaman pengeluaran.php jika berhasil
        header("location:pengeluaran.php");
    } else {
        echo "Error: Data gagal dihapus.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
