<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "uaspw"; // ganti sesuai database Anda

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Koneksi Gagal: " . mysqli_connect_error());
}

?>