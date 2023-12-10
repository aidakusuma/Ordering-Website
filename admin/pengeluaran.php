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
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="../css/admin_style.css">

    <?php include '../components/admin_header.php' ?>
   
    <style>
        table {
            width: 80%;
            margin: 0 auto;
            border-collapse: collapse;
        }
        h2 {
            text-align: center;
            padding: 12px;
            font-size: 40px;
        }
        th, td {
            text-align: center;
            padding: 12px;
            font-size: 16px;
            border: 3px solid #ddd;
        }
        .button-container {
            width: 15%;
            margin: 0 auto;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div>
    <h2>Tabel Pendapatan</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID Pengeluaran</th>
                <th>Tanggal</th>
                <th>Jumlah</th>
                <th>Aksi</th> <!-- Kolom untuk tombol Edit -->
            </tr>
        </thead>
        <tbody>
            <?php
            $select_orders = $conn->prepare("SELECT * FROM `pengeluaran`");
            $select_orders->execute();
            while ($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)):
            ?>
                <tr>
                    <td><?= $fetch_orders['id_pengeluaran']; ?></td>
                    <td><?= $fetch_orders['tgl_pengeluaran']; ?></td>
                    <td>Rp. <?= number_format($fetch_orders['jumlah'], 2, ',', '.'); ?></td>
                    <td>
                        <!-- Tombol Edit -->
                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal<?= $fetch_orders['id_pengeluaran']; ?>">
                            Edit
                        </button>

                        <!-- Modal Edit -->
                        <div class="modal fade" id="editModal<?= $fetch_orders['id_pengeluaran']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data Pengeluaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                  </div>
                  <!-- File: form-edit-pengeluaran.php -->
                  <form role="form" action="proses-edit-pengeluaran.php" method="post">
                      <?php
                      $id = $fetch_orders['id_pengeluaran']; 
                      $query_edit = $conn->prepare("SELECT * FROM pengeluaran WHERE id_pengeluaran=:id");
                      $query_edit->bindParam(':id', $id);
                      $query_edit->execute();
                      $row = $query_edit->fetch(PDO::FETCH_ASSOC);
                      ?>

                      <input type="hidden" name="id_pengeluaran" value="<?php echo $row['id_pengeluaran']; ?>">

                      <div class="form-group">
                          <label>Id</label>
                          <input type="text" name="id_pengeluaran" class="form-control" value="<?php echo $row['id_pengeluaran']; ?>" disabled>      
                      </div>

                      <div class="form-group">
                          <label>Tanggal</label>
                          <input type="date" name="tgl_pengeluaran" class="form-control" value="<?php echo $row['tgl_pengeluaran']; ?>">      
                      </div>

                      <div class="form-group">
                          <label>Jumlah</label>
                          <input type="text" name="jumlah" class="form-control" value="<?php echo $row['jumlah']; ?>">      
                      </div>

                      <div class="modal-footer">  
                          <button type="submit" class="btn btn-success">Ubah</button>
                          
                          <!-- Tombol Hapus -->
                          <a href="hapus-pengeluaran.php?id_pengeluaran=<?php echo $row['id_pengeluaran']; ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                      </div>
                  </form>
              </div>
          </div>
      </div>

                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
<div class="button-container">
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Tambah Data</button>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Pengeluaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="tambah-pengeluaran.php" method="get">
                <div class="modal-body">
                    Tanggal:
                    <input type="date" class="form-control" name="tgl_pengeluaran">
                    Jumlah:
                    <input type="number" class="form-control" name="jumlah">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Tambah Data -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <!-- ... (sama seperti sebelumnya) ... -->
</div>

<!-- Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>
