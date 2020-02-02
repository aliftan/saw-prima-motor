<?php
session_start();

include '../koneksi.php';

include '../templates/header.php';

include '../templates/navbar_kriteria.php';

if ( $_SESSION['status'] != "login" ) {
    header("location:../login.php");
}

// Get id dan kode kriteria
$id = $_GET['id'];
$kd = $_GET['kd'];

?>

<br>
<div class="container">
    
    <!-- Link Breadcumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Kriteria</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Sub-Kriteria</li>
        </ol>
    </nav>
    
    <!-- Tambah Kriteria -->
    <div class="card">
        <div class="card-header"><strong>Tambah Sub-Kriteria</strong>
        </div>
        <div class="card-body">
            <form action="tambah_subkriteria.php" method="POST">
                <input type="hidden" name="id" value="<?php	echo $id;?>"/>
                <div class="form-group row">
                    <label for="kode" class="col-sm-2 col-form-label">Kode Kriteria</label>
                    <div class="col-sm-10">
                        <input type="text" name="kode" value="<?php	echo $kd;?>" class="form-control form-control-lg" disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">Range</label>
                    <div class="col-sm-10">
                        <input type="text" name="nama" class="form-control form-control-lg" placeholder="masukan nama sub-kriteria" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="bobot" class="col-sm-2 col-form-label">Nilai Bobot</label>
                    <div class="col-sm-10">
                        <input type="number" name="nilai" class="form-control form-control-lg" placeholder="masukan nilai bobot (tidak boleh dari 1)" step=".01" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                    <div class="col-sm-10">
                        <textarea name="keterangan" class="form-control form-control-lg" id="keterangan" rows="3" placeholder="masukan keterangan" required></textarea>
                    </div>
                </div>
                <hr>
                <div class="form-group row">
                    <label for="submit" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <input type="submit" value="Submit" id="submit" class="btn btn-lg btn-primary mr-2">
                        <a href="index.php" class="btn btn-lg btn-outline-secondary">Kembali</a>
                    </div>
                </div>
            </form>
        </div> 
    </div>
</div>


<?php
include '../templates/footer.php';
?>