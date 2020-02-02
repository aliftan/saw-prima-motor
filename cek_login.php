<?php
session_start();

include 'koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];

$query = mysqli_query($conn, "SELECT * FROM TBL_ADMIN where nama_user='$username' AND kata_sandi='$password'");
$result = mysqli_num_rows($query);

// Cek Login
if ($result > 0) {
    // Fetch Object
    $data = mysqli_fetch_object($query);

    // Write Session
    $_SESSION['user_id'] = $data->id;
    $_SESSION['user_name'] = $data->nama_lengkap;
    $_SESSION['status'] = "login";
    header("location:index.php?status=login");
} else {
    header("location:login.php?status=error");
}
