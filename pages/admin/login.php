<?php
session_start();
include '../../config/koneksi.php';

$error = "";

if (isset($_POST['login'])) {

    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $query = mysqli_query(
        $conn,
        "SELECT * FROM users 
         WHERE username='$username' OR email='$username' 
         LIMIT 1"
    );

    if ($query && mysqli_num_rows($query) == 1) {

        $user = mysqli_fetch_assoc($query);

        if (password_verify($password, $user['password'])) {

            $_SESSION['admin'] = $user['username'];
            $_SESSION['nama']  = $user['nama_lengkap'];

            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Username atau email tidak ditemukan!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>

    <link rel="stylesheet" href="../../assets/css/adminStyles/adminStyles.css">
</head>

<body class="admin-login">

    <div class="login-box">
        <h2>Login Admin</h2>

        <?php if ($error != ""): ?>
            <div class="error"><?= $error; ?></div>
        <?php endif; ?>

        <form method="post">
            <input type="text" name="username" placeholder="Username atau Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login">Login</button>
        </form>
    </div>

</body>

</html>