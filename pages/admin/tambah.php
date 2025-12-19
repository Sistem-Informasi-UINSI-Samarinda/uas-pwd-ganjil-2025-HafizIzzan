<?php
include '../../config/koneksi.php';
include '../../includes/meta.php';
include 'auth.php';
?>

<link rel="stylesheet" href="../../assets/css/adminStyles/adminStyles.css">

<?php include '../../includes/header.php'; ?>

<div class="admin-page">
    <h1>Tambah Data Menu</h1>

    <form action="" method="POST" class="admin-form">

        <label>Nama Menu</label>
        <input type="text" name="nama_menu" placeholder="Masukkan nama menu" required>

        <label>Deskripsi</label>
        <textarea name="deskripsi" rows="4" placeholder="Masukkan deskripsi menu" required></textarea>

        <label>Harga</label>
        <input type="number" name="harga" placeholder="Masukkan harga" required>

        <div class="btn-group">
            <button type="submit" name="simpan" class="org-btn">Simpan</button>
            <a href="dashboard.php" class="btn-cancel">Batal</a>
        </div>

    </form>
</div>

<?php
if (isset($_POST['simpan'])) {
    $nama_menu = $_POST['nama_menu'];
    $deskripsi = $_POST['deskripsi'];
    $harga     = $_POST['harga'];

    $query = "INSERT INTO menu (nama_menu, deskripsi, harga)
              VALUES ('$nama_menu', '$deskripsi', '$harga')";

    if (mysqli_query($conn, $query)) {
        echo "<script>
                alert('Data berhasil ditambahkan');
                window.location='dashboard.php';
              </script>";
    } else {
        echo "Gagal menambahkan data";
    }
}
?>

<?php include '../../includes/footer.php'; ?>