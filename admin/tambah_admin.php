<?php
session_start();

include '../koneksi.php';

$fullname = $_POST['fullname'];
$username = $_POST['username'];
$password = $_POST['password'];

$query = "INSERT INTO TBL_ADMIN (nama_user, nama_lengkap, kata_sandi) VALUES ('$username', '$fullname', '$password')";

// Cek aksi tambah data
if (mysqli_query($conn, $query)) {
    header("location:index.php?tambah=sukses");
} else {
    echo mysqli_error($conn);
}