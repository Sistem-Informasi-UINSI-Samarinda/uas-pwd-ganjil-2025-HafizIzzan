<?php
include '../../config/koneksi.php';
include 'auth.php';

if (!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit;
}

$order_id = (int) $_GET['id'];

mysqli_query(
    $conn,
    "DELETE FROM orders WHERE id='$order_id'"
);

header("Location: dashboard.php");
exit;