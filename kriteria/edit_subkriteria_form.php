<?php
session_start();

include '../koneksi.php';

include '../templates/header.php';

include '../templates/navbar_kriteria.php';

if ( $_SESSION['status'] != "login" ) {
    header("location:../login.php");
}

// Get id sub
$id = $_GET['id'];

// Get detail sub kriteria
$query = " SELECT * FROM TBL_SUB_KRITERIA where id = $id ";
$result = mysqli_query($conn, $query);

$row = mysqli_fetch_object($result);

?>

<br>
<div class="container">

    <!-- Link Breadcumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Kriteria</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Sub-Kriteria</li>
        </ol>
    </nav>

    <!-- Tambah Kriteria -->
    <div class="card">
        <div class="card-header"><strong>Edit Sub-Kriteria</strong>
        </div>
        <div class="card-body">
            <form action="update_subkriteria.php" method="POST">
                <input type="hidden" name="id" value="<?php	echo $id;?>"/>
                <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">Nama Sub-Kriteria</label>
                    <div class="col-sm-10">
                        <input type="text" name="nama" value="<?php	echo $row->nama_sub_kriteria;?>" class="form-control form-control-lg" placeholder="masukan nama sub-kriteria" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="bobot" class="col-sm-2 col-form-label">Nilai Bobot</label>
                    <div class="col-sm-10">
                        <input type="number" name="nilai" value="<?php	echo $row->nilai;?>" class="form-control form-control-lg" placeholder="masukan nilai bobot (tidak boleh dari 1)" step=".01" required>
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
