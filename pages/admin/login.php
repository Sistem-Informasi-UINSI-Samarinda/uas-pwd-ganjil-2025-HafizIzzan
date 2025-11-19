<?php 
session_start();
include '../../config/koneksi.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <?php 
    if(isset($_POST['login'])){
        $input = $_POST['username'];
        $password = $_POST['password'];

        // Cek input ke database apakah udah sesuai ata belum dengan data yang ada
        if(filter_var($input, FILTER_VALIDATE_EMAIL)){
            $query = "SELECT * FROM users WHERE email = '$input'"; 
        }else{
            $query = "SELECT * FROM ysers WHERE username = '$input'";
        }

        $results = mysqli_query($conn, $query);

        if(mysqli_num_rows($results)){
            $row = mysqli_fetch_assoc($results);

            if(password_verify($password, $row['password'])){
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['nama_lengkap'] = $row['nama_lengkap'];
                $_SESSION['username'] = $row['username'];

                header("Location: dashboard.php");
                exit();
            }
            else{
                echo "<p style='color: red'>Password salah</p>";
            }
        }
        else{
            echo "<p style='color: red'>Username atau email tidak sesuai</p>";
        }
    }
    ?>


    <form method="post" action="">
        <label>Username atau email</label> <br>
        <input type="text" name="username" placeholder="Masuukan Username Email" required> <br>

        <label>Password</label><br>
        <input type="password" name="password" placeholder="Masukkan Password" required><br>

        <button type="submit" name="login">Login</button>
    </form>
</body>
</html>