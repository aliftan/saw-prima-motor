<?php

session_start();

include '../koneksi.php';

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    echo $id;

    $delete_nilai = " DELETE FROM tbl_nilai_karyawan WHERE id_karyawan = $id ";

    if ( mysqli_query($conn, $delete_nilai) ) {
        header("location:index.php?delete_nilai=sukses");
    } else {
        echo mysqli_error($conn);
    }
}
