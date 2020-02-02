<?php
session_start();

include '../koneksi.php';

$id_kriteria = $_POST['id'];
$nama = $_POST['nama'];
$nilai = $_POST['nilai'];
$jenis = $_POST['jenis'];
$keterangan = $_POST['keterangan'];

$query = "INSERT INTO TBL_SUB_KRITERIA (id_kriteria, nama_sub_kriteria, keterangan, nilai) VALUES ($id_kriteria, '$nama', '$keterangan', $nilai)";

$query_truncate = " TRUNCATE TABLE tbl_nilai_karyawan ";

// Cek aksi tambah data
if (mysqli_query($conn, $query) && mysqli_query($conn, $query_truncate) ) {
    header("location:index.php?tambah_sub_kriteria=sukses");
} else {
    echo mysqli_error($conn);
}
