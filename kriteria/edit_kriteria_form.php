<?php
session_start();

include '../koneksi.php';

include '../templates/header.php';

include '../templates/navbar_kriteria.php';

if ( $_SESSION['status'] != "login" ) {
    header("location:../login.php");
}

// Get id kriteria
$id = $_GET['id'];

// Get detail kriteria
$query = " SELECT * FROM TBL_KRITERIA where id = $id ";
$result = mysqli_query($conn, $query);

$row = mysqli_fetch_object($result);


?>

<br>
<div class="container">
    
    <!-- Link Breadcumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Kriteria</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Kriteria</li>
        </ol>
    </nav>
    
    <!-- Tambah Kriteria -->
    <div class="card">
        <div class="card-header"><strong>Tambah Kriteria</strong>
        </div>
        <div class="card-body">
            <form action="update_kriteria.php" method="POST">
                <input type="hidden" name="id" value="<?php	echo $id;?>"/>
                <div class="form-group row">
                    <label for="kode" class="col-sm-2 col-form-label">Kode Kriteria</label>
                    <div class="col-sm-10">
                        <input type="text" name="kode" value="<?php	echo $row->kd_kriteria;?>" class="form-control form-control-lg" placeholder="masukan kode kriteria" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">Nama Kriteria</label>
                    <div class="col-sm-10">
                        <input type="text" name="nama" value="<?php	echo $row->nama_kriteria;?>" class="form-control form-control-lg" placeholder="masukan nama kriteria" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="bobot" class="col-sm-2 col-form-label">Nilai Bobot</label>
                    <div class="col-sm-10">
                        <input type="number" name="bobot" value="<?php echo $row->bobot;?>" class="form-control form-control-lg" placeholder="masukan nilai bobot (tidak boleh dari 100)" step=".01" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="jenis" class="col-sm-2 col-form-label">Jenis Atribut</label>
                    <div class="col-sm-10">
                        <select name="jenis" class="form-control form-control-lg" id="jenis" required>
                            <option value="1" <?php if($row->jenis_atribut == 1) echo"selected"; ?> >Benefit</option>
                            <option value="2" <?php if($row->jenis_atribut == 2) echo"selected"; ?> >Cost</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                    <div class="col-sm-10">
                        <textarea name="keterangan" class="form-control form-control-lg" id="keterangan" rows="3" placeholder="masukan keterangan" required><?php echo $row->keterangan;?></textarea>
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