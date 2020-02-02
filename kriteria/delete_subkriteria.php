<?php

session_start();

include '../koneksi.php';

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $query = " DELETE FROM TBL_SUB_KRITERIA WHERE id = $id ";

    $query_truncate = " TRUNCATE TABLE tbl_nilai_karyawan ";

    // Cek aksi delete
    if (mysqli_query($conn, $query)  && mysqli_query($conn, $query_truncate) ) {
        header("location:index.php?delete_sub_kriteria=sukses");
    } else {
        echo mysqli_error($conn);
    }
}
