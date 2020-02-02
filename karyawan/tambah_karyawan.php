<?php
session_start();

include '../koneksi.php';

$nama = $_POST['nama'];
$gender = $_POST['gender'];
$agama = $_POST['agama'];
$jabatan = $_POST['jabatan'];
$alamat = $_POST['alamat'];
$tahun = $_POST['tahun'];

$q_tambah_karyawan = mysqli_query($conn, " INSERT INTO TBL_KARYAWAN (nama_karyawan, jenis_kelamin, agama, jabatan, alamat, tahun_kerja)
        VALUES ( '$nama', '$gender', '$agama', '$jabatan', '$alamat', '$tahun') ");

// Cek aksi tambah data
if ( $q_tambah_karyawan ) {
  header("location:index.php?tambah=sukses");
} else {
    echo mysqli_error($conn);
}
