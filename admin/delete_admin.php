<?php

session_start();

include '../koneksi.php';

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $query = " DELETE FROM TBL_ADMIN WHERE id = $id ";
   
    // Cek aksi delete
    if (mysqli_query($conn, $query)) {
        header("location:index.php?delete=sukses");
    } else {
        echo mysqli_error($conn);
    }
}