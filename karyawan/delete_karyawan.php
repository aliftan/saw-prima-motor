<?php

session_start();

include '../koneksi.php';

if (isset($_GET['id'])) {

    // Get ID Karyawan
    $id = $_GET['id'];
    
    // Query Delete karyawan
    $q_delete_karyawan = mysqli_query($conn, " DELETE FROM TBL_KARYAWAN WHERE id = $id ");

    // Check karyawan if exist in nilai_karyawan table
    $q_search_karyawan = mysqli_query($conn, "SELECT * FROM tbl_nilai_karyawan WHERE id_karyawan = $id");
    $exist_result = mysqli_num_rows($q_search_karyawan);

    // Cek aksi delete
    if (q_delete_karyawan) {
        if ($exist_result > 0) {
            $q_delete_karyawan_nilai = mysqli_query($conn, " DELETE * FROM TABLE tbl_nilai_karyawan where id = $id");
        }
        header("location:index.php?delete=sukses");
    } else {
        echo mysqli_error($conn);
    }
}