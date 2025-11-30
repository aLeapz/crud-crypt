<?php
include 'konek.php';
$id = $_GET['id'];
$query = $db->query("SELECT * FROM tb_inventory WHERE id_barang = '$id'");
$data = $query->fetch_assoc();

if (isset($_POST['tambah'])) {
    $jumlah_tambah = intval($_POST['jumlah_tambah']);
    $jumlah_baru = $data['jumlah_barang'] + $jumlah_tambah;
    $status_baru = ($data['jumlah_barang'] == 0 && $data['status_barang'] == 0) ? 1 : $data['status_barang'];

    $db->query("UPDATE tb_inventory SET jumlah_barang = '$jumlah_baru', status_barang = '$status_baru' WHERE id_barang = '$id'");
    header("Location: tabel_barang.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Stok Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
    <h2 class="mb-4">Tambah Stok Barang</h2>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-3">Barang: <strong><?= $data['nama_barang']; ?></strong></h5>
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Jumlah Tambah</label>
                    <input type="number" name="jumlah_tambah" class="form-control" required>
                </div>
                <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
                <a href="tabel_barang.php" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</body>
</html>
