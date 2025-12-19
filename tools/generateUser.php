<?php
include '../config/koneksi.php';

$username = "admin";
$email    = "admin@admin.com";
$password = password_hash("123456", PASSWORD_DEFAULT);
$nama     = "Administrator";

// Cek admin apakah sudah ada atau belum
$cek = mysqli_query(
    $conn,
    "SELECT id FROM users WHERE username='$username' OR email='$email'"
);

if (mysqli_num_rows($cek) > 0) {
    echo "❌ Akun admin sudah ada, tidak perlu generate ulang";
    exit;
}
$query = "
    INSERT INTO users (username, email, password, nama_lengkap)
    VALUES ('$username', '$email', '$password', '$nama')
";

if (mysqli_query($conn, $query)) {
    echo "✅ Akun admin BERHASIL dibuat<br>";
} else {
    echo "❌ Gagal membuat akun: " . mysqli_error($conn);
}