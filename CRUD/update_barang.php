<?php
include 'konek.php';

if (isset($_POST['submit'])) {
    $kode_barang   = $_POST['kode_barang'];
    $nama_barang   = $_POST['nama_barang'];
    $jumlah_barang = intval($_POST['jumlah_barang']);
    $satuan_barang = $_POST['satuan_barang'];
    
    // Ambil data harga raw, lalu ENKRIPSI
    $harga_beli_raw = $_POST['harga_beli']; 
    $harga_beli_enc = encryptData($harga_beli_raw); 

    $status_barang = ($jumlah_barang > 0) ? 1 : 0;

    // Query Insert
    $stmt = $db->prepare("INSERT INTO tb_inventory (kode_barang, nama_barang, jumlah_barang, satuan_barang, harga_beli, status_barang) VALUES (?, ?, ?, ?, ?, ?)");
    
    // Variable $harga_beli_enc dimasukkan menggantikan harga asli
    $stmt->bind_param("ssisss", $kode_barang, $nama_barang, $jumlah_barang, $satuan_barang, $harga_beli_enc, $status_barang);

    if ($stmt->execute()) {
        echo "<div class='alert alert-success'>Barang berhasil ditambahkan (Harga Terenkripsi).</div>";
    } else {
        echo "<div class='alert alert-danger'>Gagal menambahkan barang: " . $stmt->error . "</div>";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Barang Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
    <h2 class="mb-4">Tambah Barang Baru</h2>
    <form method="POST" action="">
        <div class="mb-3">
            <label class="form-label">Kode Barang</label>
            <input type="text" name="kode_barang" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Nama Barang</label>
            <input type="text" name="nama_barang" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Jumlah Barang</label>
            <input type="number" name="jumlah_barang" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Satuan Barang</label>
            <select name="satuan_barang" class="form-select" required>
                <option value="">-- Pilih Satuan --</option>
                <option value="kg">kg</option>
                <option value="pcs">pcs</option>
                <option value="liter">liter</option>
                <option value="sachet">sachet</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Harga Beli</label>
            <input type="number" name="harga_beli" class="form-control" required>
        </div>

        <button type="submit" name="submit" class="btn btn-primary">Simpan Barang</button>
        <a href="tabel_barang.php" class="btn btn-secondary">Kembali</a>
    </form>
</body>
</html>
