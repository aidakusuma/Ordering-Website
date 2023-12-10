<?php
// include('dbconnected.php');
include '../components/connect.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

$tgl_pengeluaran = $_GET['tgl_pengeluaran'];
$jumlah = $_GET['jumlah'];

try {
    // Query insert dengan PDO
    $query = "INSERT INTO pengeluaran (tgl_pengeluaran, jumlah) VALUES (:tgl_pengeluaran, :jumlah)";
    $statement = $conn->prepare($query);

    // Binding parameter
    $statement->bindParam(':tgl_pengeluaran', $tgl_pengeluaran);
    $statement->bindParam(':jumlah', $jumlah);

    // Eksekusi query
    if ($statement->execute()) {
        // Redirect ke page index jika berhasil
        header("location:pengeluaran.php");
    } else {
        echo "ERROR, data gagal disimpan" . implode(":", $statement->errorInfo());
    }
} catch (PDOException $e) {
    // Tangani kesalahan PDO
    echo "Error: " . $e->getMessage();
}
?>
