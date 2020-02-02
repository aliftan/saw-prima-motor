<?php

session_start();

include '../koneksi.php';

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $delete_kriteria = " DELETE FROM TBL_KRITERIA WHERE id = $id ";

    // Delete sub kriteria
    $delete_sub_kriteria = " DELETE FROM TBL_SUB_KRITERIA WHERE id_kriteria = $id ";

    $query_truncate = " TRUNCATE TABLE tbl_nilai_karyawan ";

    // Cek aksi delete
    if ( mysqli_query($conn, $delete_kriteria) && mysqli_query($conn, $delete_sub_kriteria) && mysqli_query($conn, $query_truncate) ) {
        header("location:index.php?delete_kriteria=sukses");
    } else {
        echo mysqli_error($conn);
    }
}
