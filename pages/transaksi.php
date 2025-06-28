<?php
session_start();
include('../config/koneksi.php');
if (!isset($_SESSION['login'])) {
    header("Location: ../auth/login.php");
    exit;
}

// Tambah transaksi
if (isset($_POST['tambah'])) {
    $pelanggan_id = $_POST['pelanggan_id'];
    $tanggal = $_POST['tanggal'];
    $produk = $_POST['produk'];
    $total = $_POST['total'];
    
    // Masukkan ke database
    mysqli_query($koneksi, "INSERT INTO transaksi (pelanggan_id, tanggal, produk, total) 
                            VALUES ('$pelanggan_id', '$tanggal', '$produk', '$total')");

    header("Location: transaksi.php");
    exit;
}


// Ambil data transaksi & pelanggan
$data = mysqli_query($koneksi, "SELECT transaksi.*, pelanggan.nama 
                                FROM transaksi 
                                JOIN pelanggan ON transaksi.pelanggan_id = pelanggan.id 
                                ORDER BY transaksi.id DESC");

$pelanggan = mysqli_query($koneksi, "SELECT * FROM pelanggan");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Transaksi | CRM</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { display: flex; }
    #content { padding: 30px; flex-grow: 1; }
  </style>
</head>
<body>

<?php include('sidebar.php'); ?>

<div id="content">
  <h2>Transaksi Pelanggan</h2>

  <form method="POST" class="mb-4">
    <div class="row g-2">
      <div class="col-md-3">
        <select name="pelanggan_id" class="form-control" required>
          <option value="">Pilih Pelanggan</option>
          <?php while($p = mysqli_fetch_assoc($pelanggan)): ?>
            <option value="<?= $p['id'] ?>"><?= $p['nama'] ?></option>
          <?php endwhile; ?>
        </select>
      </div>
      <div class="col-md-2">
        <input type="date" name="tanggal" class="form-control" required>
      </div>
      <div class="col-md-3">
        <input type="text" name="produk" class="form-control" placeholder="Nama Produk" required>
      </div>
      <div class="col-md-2">
        <input type="number" name="total" class="form-control" placeholder="Total (Rp)" required>
      </div>
      <div class="col-md-2">
        <button name="tambah" class="btn btn-success w-100">Tambah</button>
      </div>
    </div>
  </form>

  <table class="table table-bordered table-striped">
    <thead class="table-dark">
      <tr>
        <th>No</th>
        <th>Pelanggan</th>
        <th>Tanggal</th>
        <th>Produk</th>
        <th>Total</th>
      </tr>
    </thead>
    <tbody>
      <?php $no=1; while($row = mysqli_fetch_assoc($data)): ?>
      <tr>
        <td><?= $no++ ?></td>
        <td><?= htmlspecialchars($row['nama']) ?></td>
        <td><?= $row['tanggal'] ?></td>
        <td><?= htmlspecialchars($row['produk']) ?></td>
        <td>Rp <?= number_format($row['total']) ?></td>
      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>

</body>
</html>
