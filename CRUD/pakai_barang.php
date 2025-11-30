<?php
include 'konek.php';
$id = $_GET['id'];
$query = $db->query("SELECT * FROM tb_inventory WHERE id_barang = '$id'");
$data = $query->fetch_assoc();

$error = "";
if (isset($_POST['pakai'])) {
    $jumlah_pakai = intval($_POST['jumlah_pakai']);
    $stok = $data['jumlah_barang'];

    if ($jumlah_pakai > $stok) {
        $error = "❌ Gagal: Jumlah pemakaian melebihi stok!";
    } else {
        $sisa = $stok - $jumlah_pakai;
        $status_baru = ($sisa == 0) ? 0 : 1;

        $db->query("UPDATE tb_inventory SET jumlah_barang = '$sisa', status_barang = '$status_baru' WHERE id_barang = '$id'");
        header("Location: tabel_barang.php");
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pakai Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
    <h2 class="mb-4">Pakai Barang</h2>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-3">Barang: <strong><?= $data['nama_barang']; ?></strong></h5>

            <?php if (!empty($error)) : ?>
                <div class="alert alert-danger"><?= $error; ?></div>
            <?php endif; ?>

            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Jumlah Pakai</label>
                    <input type="number" name="jumlah_pakai" class="form-control" required>
                </div>
                <button type="submit" name="pakai" class="btn btn-danger">Pakai</button>
                <a href="tabel_barang.php" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</body>
</html>