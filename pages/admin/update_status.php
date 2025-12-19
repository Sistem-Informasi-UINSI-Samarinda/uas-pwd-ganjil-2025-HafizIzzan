<?php
include '../../config/koneksi.php';
include 'auth.php';

if (!isset($_GET['id']) || !isset($_GET['status'])) {
    header("Location: dashboard.php");
    exit;
}

$order_id = (int) $_GET['id'];
$status   = $_GET['status'];

$allowed = ['pending', 'diproses', 'selesai', 'batal'];

if (!in_array($status, $allowed)) {
    header("Location: dashoard.php");
    exit;
}

mysqli_query(
    $conn,
    "UPDATE orders SET status='$status' WHERE id='$order_id'"
);

header("Location: dashboard.php");
exit;