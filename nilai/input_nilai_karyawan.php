<?php
session_start();

include '../koneksi.php';

$data_input = array_values($_POST);

$jumlah_data = count($_POST) - 1;

$id_karyawan = $data_input[0];

$x = 1;

while($x <= $jumlah_data) {
  $id_sub_kriteria = $data_input[$x];

  // Insert Data
  $query = " INSERT INTO tbl_nilai_karyawan (id_karyawan, id_sub_kriteria) VALUES ($id_karyawan, $id_sub_kriteria) ";
  mysqli_query($conn, $query);

  $x++;
}

header("location:index.php?tambah_nilai=sukses");



// if ( mysqli_query($conn, $query) ) {

// } else {
//     echo mysqli_error($conn);
// }
