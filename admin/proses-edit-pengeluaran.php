<!-- File: proses-edit-pengeluaran.php -->
<?php
// include('dbconnected.php');
include '../components/connect.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:admin_login.php');
}

$id = $_POST['id_pengeluaran'];
$tgl = $_POST['tgl_pengeluaran'];
$jumlah = $_POST['jumlah'];

try {
    // Query update dengan PDO
    $query = "UPDATE pengeluaran SET tgl_pengeluaran=:tgl, jumlah=:jumlah WHERE id_pengeluaran=:id";
    $statement = $conn->prepare($query);

    // Binding parameter
    $statement->bindParam(':tgl', $tgl);
    $statement->bindParam(':jumlah', $jumlah);
    $statement->bindParam(':id', $id);

    // Eksekusi query
    if ($statement->execute()) {
        // Redirect ke page index jika berhasil
        header("location:pengeluaran.php");
    } else {
        echo "ERROR, data gagal diupdate" . implode(":", $statement->errorInfo());
    }
} catch (PDOException $e) {
    // Tangani kesalahan PDO
    echo "Error: " . $e->getMessage();
}
?>
