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
    <title>Data Table</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="../css/admin_style.css">

    <?php include '../components/admin_header.php' ?>
   
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        h2 {
            text-align: center;
            padding: 12px; /* Menambah padding untuk memberikan ruang yang lebih besar */
            font-size: 40px; /* Menambah ukuran font */
        }
        th, td {
            text-align: center;
            padding: 12px; /* Menambah padding untuk memberikan ruang yang lebih besar */
            font-size: 16px; /* Menambah ukuran font */
            border: 3px solid #ddd;
        }
    </style>
</head>
<body>
<div>
    <h2>Tabel Pendapatan</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID Pemasukan</th>
                <th>Nama user</th>
                <th>Tanggal</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $select_orders = $conn->prepare("SELECT * FROM `orders`");
            $select_orders->execute();
            while ($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)):
            ?>
                <tr>
                    <td><?= $fetch_orders['id']; ?></td>
                    <td><?= $fetch_orders['name']; ?></td>
                    <td><?= $fetch_orders['placed_on']; ?></td>
                    <td>Rp. <?= number_format($fetch_orders['total_price'], 2, ',', '.'); ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

</body>
</html>
