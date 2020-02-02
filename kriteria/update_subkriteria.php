<?php
session_start();

include '../koneksi.php';

$id = $_POST['id'];
$nama = $_POST['nama'];
$nilai = $_POST['nilai'];
$keterangan = $_POST['keterangan'];

$query = " UPDATE TBL_SUB_KRITERIA SET nama_sub_kriteria = '$nama', keterangan = '$keterangan', nilai = $nilai WHERE id = $id ";

// Cek aksi update data
if (mysqli_query($conn, $query)) {
    header("location:index.php?edit_sub_kriteria=sukses");
} else {
    echo mysqli_error($conn);
}