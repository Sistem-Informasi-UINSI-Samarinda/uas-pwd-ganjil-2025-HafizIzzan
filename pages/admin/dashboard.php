<?php
include '../../config/koneksi.php';
include '../../includes/meta.php';
include 'auth.php';
?>

<link rel="stylesheet" href="../../assets/css/adminStyles/adminStyles.css">

<?php include '../../includes/header.php'; ?>

<?php
$menuQuery = mysqli_query($conn, "SELECT * FROM menu ORDER BY id DESC");

$orderQuery = mysqli_query(
    $conn,
    "SELECT 
        orders.id AS order_id,
        orders.nama,
        orders.jam_ambil,
        orders.catatan,
        orders.status,
        orders.created_at,
        menu.nama_menu,
        menu.harga,
        order_items.jumlah
     FROM orders
     JOIN order_items ON orders.id = order_items.order_id
     JOIN menu ON order_items.menu_id = menu.id
     ORDER BY orders.created_at DESC"
);

$orders = [];

if ($orderQuery) {
    while ($row = mysqli_fetch_assoc($orderQuery)) {

        $id = $row['order_id'];

        if (!isset($orders[$id])) {
            $orders[$id] = [
                'nama'      => $row['nama'],
                'jam_ambil' => $row['jam_ambil'],
                'catatan'   => $row['catatan'],
                'status'    => $row['status'],
                'tanggal'   => $row['created_at'],
                'items'     => [],
                'total'     => 0
            ];
        }

        $subtotal = $row['harga'] * $row['jumlah'];
        $orders[$id]['total'] += $subtotal;

        $orders[$id]['items'][] = [
            'menu'   => $row['nama_menu'],
            'jumlah' => $row['jumlah'],
            'harga'  => $row['harga']
        ];
    }
}
?>

<div class="admin-page">

    <div class="admin-header">
        <h1>Dashboard Admin</h1>
    </div>

    <div class="admin-top">
        <span>Halo, <?= htmlspecialchars($_SESSION['admin']); ?></span>
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>

    <hr style="margin: 30px 0;">

    <h2>Data Pesanan Masuk</h2>

    <table class="admin-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pemesan</th>
                <th>Pesanan</th>
                <th>Total</th>
                <th>Jam Ambil</th>
                <th>Status</th>
                <th>Catatan</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            <?php if (!empty($orders)): ?>
                <?php $no = 1; ?>
                <?php foreach ($orders as $order_id => $order): ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= htmlspecialchars($order['nama']); ?></td>

                        <td>
                            <ul style="padding-left:18px;">
                                <?php foreach ($order['items'] as $item): ?>
                                    <li>
                                        <?= htmlspecialchars($item['menu']); ?>
                                        (<?= $item['jumlah']; ?> x
                                        Rp<?= number_format($item['harga'], 0, ',', '.'); ?>)
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </td>

                        <td>
                            <strong>
                                Rp<?= number_format($order['total'], 0, ',', '.'); ?>
                            </strong>
                        </td>

                        <td><?= htmlspecialchars($order['jam_ambil']); ?></td>

                        <td>
                            <span class="status <?= $order['status']; ?>">
                                <?= ucfirst($order['status']); ?>
                            </span>
                        </td>

                        <td><?= htmlspecialchars($order['catatan'] ?: '-'); ?></td>

                        <td>
                            <?= date('d-m-Y H:i', strtotime($order['tanggal'])); ?>
                        </td>

                        <td class="aksi">
                            <a href="update_status.php?id=<?= $order_id; ?>&status=diproses"
                                class="btn-edit">Proses</a>

                            <a href="update_status.php?id=<?= $order_id; ?>&status=selesai"
                                class="btn-edit">Selesai</a>

                            <a href="hapus_order.php?id=<?= $order_id; ?>"
                                onclick="return confirm('Yakin ingin menghapus pesanan ini?')"
                                class="btn-delete">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="9" style="text-align:center;">
                        Belum ada pesanan
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <hr style="margin: 40px 0;">

    <div class="admin-header">
        <h2>Data Menu</h2>
        <a href="tambah.php" class="org-btn">+ Tambah Menu</a>
    </div>

    <table class="admin-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Menu</th>
                <th>Deskripsi</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            <?php if ($menuQuery && mysqli_num_rows($menuQuery) > 0): ?>
                <?php $no = 1; ?>
                <?php while ($row = mysqli_fetch_assoc($menuQuery)): ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= htmlspecialchars($row['nama_menu']); ?></td>
                        <td><?= htmlspecialchars($row['deskripsi']); ?></td>
                        <td>
                            Rp<?= number_format($row['harga'], 0, ',', '.'); ?>
                        </td>
                        <td class="aksi">
                            <a href="edit.php?id=<?= $row['id']; ?>"
                                class="btn-edit">Edit</a>
                            <a href="hapus.php?id=<?= $row['id']; ?>"
                                onclick="return confirm('Yakin ingin menghapus menu ini?')"
                                class="btn-delete">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" style="text-align:center;">
                        Data menu kosong
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</div>

<?php include '../../includes/footer.php'; ?>