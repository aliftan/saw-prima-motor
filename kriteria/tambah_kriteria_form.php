<?php
session_start();

include '../koneksi.php';

include '../templates/header.php';

include '../templates/navbar_kriteria.php';

if ( $_SESSION['status'] != "login" ) {
    header("location:../login.php");
}

?>

<br>
<div class="container">
    
    <!-- Link Breadcumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Kriteria</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Kriteria</li>
        </ol>
    </nav>
    
    <!-- Tambah Kriteria -->
    <div class="card">
        <div class="card-header"><strong>Tambah Kriteria</strong>
        </div>
        <div class="card-body">
            <form action="tambah_kriteria.php" method="POST">
                <div class="form-group row">
                    <label for="kode" class="col-sm-2 col-form-label">Kode Kriteria</label>
                    <div class="col-sm-10">
                        <input type="text" name="kode" class="form-control form-control-lg" placeholder="masukan kode kriteria" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">Nama Kriteria</label>
                    <div class="col-sm-10">
                        <input type="text" name="nama" class="form-control form-control-lg" placeholder="masukan nama kriteria" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="bobot" class="col-sm-2 col-form-label">Nilai Bobot</label>
                    <div class="col-sm-10">
                        <input type="number" name="bobot" class="form-control form-control-lg" placeholder="masukan nilai bobot (tidak boleh dari 100)" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="jenis" class="col-sm-2 col-form-label">Jenis Atribut</label>
                    <div class="col-sm-10">
                        <select name="jenis" class="form-control form-control-lg" id="jenis" required>
                            <option value="1">Benefit</option>
                            <option value="2">Cost</option>
                        </select>
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