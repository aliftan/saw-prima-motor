<?php
session_start();

include '../koneksi.php';

$id = $_POST['id'];
$kode = strtoupper($_POST['kode']);
$nama = $_POST['nama'];
$bobot = $_POST['bobot'];
$jenis = $_POST['jenis'];
$keterangan = $_POST['keterangan'];

$query = "UPDATE TBL_KRITERIA SET kd_kriteria = '$kode', nama_kriteria = '$nama', jenis_atribut = $jenis, keterangan = '$keterangan', bobot = $bobot WHERE id = $id";

// Cek aksi update data
if (mysqli_query($conn, $query)) {
    header("location:index.php?edit_kriteria=sukses");
} else {
    echo mysqli_error($conn);
}