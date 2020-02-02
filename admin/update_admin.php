<?php
session_start();

include '../koneksi.php';

$id = $_POST['id'];
$fullname = $_POST['fullname'];
$username = $_POST['username'];
$password = $_POST['password'];

$query = "UPDATE TBL_ADMIN SET nama_user = '$username', nama_lengkap = '$fullname', kata_sandi = '$password' WHERE id = $id";

// Cek aksi update data
if (mysqli_query($conn, $query)) {
    header("location:index.php?edit=sukses");
} else {
    echo mysqli_error($conn);
}