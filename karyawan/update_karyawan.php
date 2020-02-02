<?php
session_start();

include '../koneksi.php';

$id = $_POST['id'];
$nama = $_POST['nama'];
$gender = $_POST['gender'];
$agama = $_POST['agama'];
$jabatan = $_POST['jabatan'];
$alamat = $_POST['alamat'];
$tahun = $_POST['tahun'];

$query = "UPDATE TBL_KARYAWAN SET nama_karyawan = '$nama', jenis_kelamin = '$gender', agama = '$agama', jabatan = '$jabatan', alamat = '$alamat', tahun_kerja = '$tahun' WHERE id = $id";

// Cek aksi update data
if (mysqli_query($conn, $query)) {
    header("location:index.php?edit=sukses");
} else {
    echo mysqli_error($conn);
}