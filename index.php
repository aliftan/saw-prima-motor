<?php
session_start();

if ( $_SESSION['status'] != "login" ) {
    header("location:login.php");
}

include 'templates/navbar_index.php';

?>

<!-- Content -->
<div class="container">
    <?php if (isset($_GET['status']) == "login") { ?>
        <br>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Login Sukses!</strong> Selamat datang kembali <?php echo $_SESSION['user_name'] ?>.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php } ?>
    
    <br>
    <div class="jumbotron">
        <h1 class="display-4">Selamat datang kembali <?php echo $_SESSION['user_name'] ?></h1>
        <p class="lead">Ini adalah aplikasi sistem pendukung keputusan berbasis algoritma SAW yang dibuat sebagai hasil penelitian skripsi.</p>
        <hr>
        <a class="btn btn-outline-primary btn-lg mr-2" href="karyawan/index.php" role="button">👨‍🔧 Lihat Data Karyawan</a>
        <a class="btn btn-outline-primary btn-lg mr-2" href="kriteria/index.php" role="button">✅ Lihat Data Kriteria</a>
        <a class="btn btn-outline-primary btn-lg mr-2" href="" role="button">📒 Lihat Data Nilai</a>
    </div>



</div>


<?php
include 'templates/footer.php';
?>