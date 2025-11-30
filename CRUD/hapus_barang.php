<?php
include 'konek.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = $db->query("DELETE FROM tb_inventory WHERE id_barang = '$id'");

    if ($query) {
        echo "<script>
            alert('Barang berhasil dihapus.');
            window.location.href = 'tabel_barang.php';
        </script>";
    } else {
        echo "<script>
            alert('Gagal menghapus barang.');
            window.location.href = 'tabel_barang.php';
        </script>";
    }
} else {
    header("Location: tabel_barang.php");
}
?>
