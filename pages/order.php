<?php
include '../config/koneksi.php';

$menus = mysqli_query($conn, "SELECT * FROM menu ORDER BY nama_menu ASC");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nama      = mysqli_real_escape_string($conn, $_POST['nama']);
    $jam_ambil = $_POST['jam_ambil'];
    $catatan   = mysqli_real_escape_string($conn, $_POST['catatan']);

    // SIMPAN KE TABEL ORDERS
    $insertOrder = mysqli_query(
        $conn,
        "INSERT INTO orders (nama, jam_ambil, catatan)
         VALUES ('$nama', '$jam_ambil', '$catatan')"
    );

    if ($insertOrder) {

        $order_id = mysqli_insert_id($conn);

        // SIMPAN KE ORDER_ITEMS
        if (isset($_POST['menu'])) {
            foreach ($_POST['menu'] as $menu_id => $data) {

                if (isset($data['pilih'])) {

                    $jumlah = (int) $data['jumlah'];

                    if ($jumlah > 0) {
                        mysqli_query(
                            $conn,
                            "INSERT INTO order_items (order_id, menu_id, jumlah)
                             VALUES ('$order_id', '$menu_id', '$jumlah')"
                        );
                    }
                }
            }
        }

        $success = true;
    } else {
        $error = "Pesanan gagal disimpan";
    }
}
?>

<?php include '../includes/meta.php'; ?>
<?php include '../includes/header.php'; ?>

<div class="order-page">

    <div class="order-header">
        <h1>Order Now</h1>
        <p>Pesan makanan dan minuman favorit Anda</p>
    </div>

    <div class="order-wrapper">

        <?php if (isset($success)): ?>
            <div class="success-msg">✅ Pesanan berhasil dikirim</div>
        <?php endif; ?>

        <?php if (isset($error)): ?>
            <div class="error-msg"><?= $error; ?></div>
        <?php endif; ?>

        <form method="post" class="order-form">

            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="nama" required>
            </div>

            <div class="form-group">
                <label>Jam Ambil</label>
                <input type="time" name="jam_ambil" required>
            </div>

            <div class="form-group">
                <label>Pilih Menu</label>

                <?php while ($row = mysqli_fetch_assoc($menus)): ?>
                    <div class="menu-item">
                        <input type="checkbox"
                            name="menu[<?= $row['id']; ?>][pilih]">

                        <strong><?= htmlspecialchars($row['nama_menu']); ?></strong>
                        (Rp<?= number_format($row['harga'], 0, ',', '.'); ?>)

                        <input type="number"
                            name="menu[<?= $row['id']; ?>][jumlah]"
                            min="1"
                            value="1"
                            style="width:70px; margin-left:10px;">
                    </div>
                <?php endwhile; ?>

            </div>

            <div class="form-group">
                <label>Catatan (Opsional)</label>
                <textarea name="catatan"></textarea>
            </div>

            <button type="submit" class="org-btn">Kirim Pesanan</button>

        </form>
    </div>
</div>

<?php include '../includes/footer.php'; ?>