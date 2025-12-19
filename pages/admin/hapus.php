<?php
include '../../config/koneksi.php';
include 'auth.php';

if (!isset($_GET['id'])) {
    echo "ID tidak ditemukan";
    exit;
}

$id = $_GET['id'];

$query = "DELETE FROM menu WHERE id = '$id'";

if (mysqli_query($conn, $query)) {
    echo "<script>
            alert('Data berhasil dihapus');
            window.location='dashboard.php';
          </script>";
} else {
    echo "Gagal menghapus data";
}