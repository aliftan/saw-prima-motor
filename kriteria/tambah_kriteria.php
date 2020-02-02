<?php
session_start();

include '../koneksi.php';

$kode = strtoupper($_POST['kode']);
$nama = $_POST['nama'];
$bobot = $_POST['bobot'];
$jenis = $_POST['jenis'];
$keterangan = $_POST['keterangan'];

$query = "INSERT INTO TBL_KRITERIA (kd_kriteria, nama_kriteria, jenis_atribut, keterangan, bobot)
          VALUES ('$kode', '$nama', $jenis, '$keterangan', $bobot)";

$query_truncate = " TRUNCATE TABLE tbl_nilai_karyawan ";

// Cek aksi tambah data
if ( mysqli_query($conn, $query)  && mysqli_query($conn, $query_truncate) ) {
    header("location:index.php?tambah_kriteria=sukses");
} else {
    echo mysqli_error($conn);
}
