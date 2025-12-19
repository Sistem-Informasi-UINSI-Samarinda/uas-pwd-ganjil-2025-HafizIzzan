<?php
include '../../config/koneksi.php';
include '../../includes/meta.php';
include 'auth.php';
?>

<link rel="stylesheet" href="../../assets/css/adminStyles/adminStyles.css">

<?php include '../../includes/header.php'; ?>

<?php
if (!isset($_GET['id'])) {
    echo "ID tidak ditemukan";
    exit;
}

$id = $_GET['id'];

$query = mysqli_query($conn, "SELECT * FROM menu WHERE id = '$id'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "Data tidak ditemukan";
    exit;
}
?>

<div class="admin-page">
    <h1>Edit Data Menu</h1>

    <form action="" method="POST" class="admin-form">

        <label>Nama Menu</label>
        <input type="text" name="nama_menu" value="<?= $data['nama_menu']; ?>" required>

        <label>Deskripsi</label>
        <textarea name="deskripsi" rows="4" required><?= $data['deskripsi']; ?></textarea>

        <label>Harga</label>
        <input type="number" name="harga" value="<?= $data['harga']; ?>" required>

        <div class="btn-group">
            <button type="submit" name="update" class="org-btn">Update</button>
            <a href="dashboard.php" class="btn-cancel">Batal</a>
        </div>

    </form>
</div>

<?php
if (isset($_POST['update'])) {
    $nama_menu = $_POST['nama_menu'];
    $deskripsi = $_POST['deskripsi'];
    $harga     = $_POST['harga'];

    $update = "UPDATE menu SET
                nama_menu = '$nama_menu',
                deskripsi = '$deskripsi',
                harga = '$harga'
               WHERE id = '$id'";

    if (mysqli_query($conn, $update)) {
        echo "<script>
                alert('Data berhasil diupdate');
                window.location='dashboard.php';
              </script>";
    } else {
        echo "Gagal update data";
    }
}
?>

<?php include '../../includes/footer.php'; ?>