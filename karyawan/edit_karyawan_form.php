<?php
session_start();

include '../koneksi.php';

include '../templates/header.php';

include '../templates/navbar_karyawan.php';

if ( $_SESSION['status'] != "login" ) {
    header("location:../login.php");
}

// Get id 
$id = $_GET['id'];

// Get detail admin
$result = mysqli_query($conn, " SELECT * FROM TBL_KARYAWAN where id = $id ");

$row = mysqli_fetch_object($result);


?>

<!-- Tambah Admin -->
<br>
<div class="container">

    <!-- Link Breadcumb -->
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Admin</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Admin</li>
      </ol>
    </nav>

    <div class="card">
        <div class="card-header"><strong>Edit Admin</strong></div>

        <div class="card-body">
            <form action="update_karyawan.php" method="POST">
                <input type="hidden" name="id" value="<?php	echo $id;?>"/>
                <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">Nama Karyawan</label>
                    <div class="col-sm-10">
                        <input type="text" name="nama" value="<?php	echo $row->nama_karyawan;?>" class="form-control form-control-lg" placeholder="masukan nama karyawan" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="jenis" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-10">
                        <select name="gender" class="form-control form-control-lg" id="jenis" required>
                            <option value="Laki-Laki" <?php if($row->jenis_kelamin == "Laki-Laki") echo"selected"; ?>>Laki-Laki</option>
                            <option value="Perempuan" <?php if($row->jenis_kelamin == "Perempuan") echo"selected"; ?>>Perempuan</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="jenis" class="col-sm-2 col-form-label">Agama</label>
                    <div class="col-sm-10">
                        <select name="agama" class="form-control form-control-lg" id="jenis" required>
                            <option value="Islam" <?php if($row->agama == "Islam") echo"selected"; ?> >Islam</option>
                            <option value="Kristen Protestan" <?php if($row->agama == "Kristen Protestan") echo"selected"; ?> >Kristen Protestan</option>
                            <option value="Katolik" <?php if($row->agama == "Katolik") echo"selected"; ?> >Katolik</option>
                            <option value="Hindu" <?php if($row->agama == "Hindu") echo"selected"; ?> >Hindu</option>
                            <option value="Buddha" <?php if($row->agama == "Buddha") echo"selected"; ?> >Buddha</option>
                            <option value="Kong Hu Cu" <?php if($row->agama == "Kong Hu Cu") echo"selected"; ?> >Kong Hu Cu</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="jenis" class="col-sm-2 col-form-label">Jabatan</label>
                    <div class="col-sm-10">
                        <select name="jabatan" class="form-control form-control-lg" id="jenis" required>
                            <option value="Admin" <?php if($row->jabatan == "Admin") echo"selected"; ?> >Admin</option>
                            <option value="Admin CRM" <?php if($row->jabatan == "Admin CRM") echo"selected"; ?> >Admin CRM</option>
                            <option value="Admin STNK & BPKB" <?php if($row->jabatan == "Admin STNK & BPKB") echo"selected"; ?> >Admin STNK & BPKB</option>
                            <option value="Deliveryman" <?php if($row->jabatan == "Deliveryman") echo"selected"; ?> >Deliveryman</option>
                            <option value="Foreign Direct Investment (FDI)" <?php if($row->jabatan == "Foreign Direct Investment (FDI)") echo"selected"; ?> >Foreign Direct Investment (FDI]</option>
                            <option value="Frontdesk" <?php if($row->jabatan == "Frontdesk") echo"selected"; ?> >Frontdesk</option>
                            <option value="Kasir" <?php if($row->jabatan == "Kasir") echo"selected"; ?> >Kasir</option>
                            <option value="Kepala Bengkel" <?php if($row->jabatan == "Kepala Bengkel") echo"selected"; ?> >Kepala Bengkel</option>
                            <option value="Kepala Gudang Unit" <?php if($row->jabatan == "Kepala Gudang Unit") echo"selected"; ?> >Kepala Gudang Unit</option>
                            <option value="Kepala Mekanik" <?php if($row->jabatan == "Kepala Mekanik") echo"selected"; ?> >Kepala Mekanik</option>
                            <option value="Mekanik" <?php if($row->jabatan == "Mekanik") echo"selected"; ?> >Mekanik</option>
                            <option value="PIC Part" <?php if($row->jabatan == "PIC Part") echo"selected"; ?> >PIC Part</option>
                            <option value="Sales" <?php if($row->jabatan == "Sales") echo"selected"; ?> >Sales</option>
                            <option value="Service Advisor" <?php if($row->jabatan == "Service Advisor") echo"selected"; ?> >Service Advisor</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                        <textarea name="alamat" class="form-control form-control-lg" id="alamat" rows="3" placeholder="masukan keterangan" required><?php echo $row->alamat;?></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="tahun" class="col-sm-2 col-form-label">Tanggal Masuk</label>
                    <div class="col-sm-10">
                        <input type="tahun" name="tahun" value="<?php echo $row->tahun_kerja;?>" data-toggle="datepicker" autocomplete="off" class="form-control form-control-lg" placeholder="dd/mm/yyyy" required>
                    </div>
                </div>
                <hr>
                <div class="form-group row">
                    <label for="submit" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <input type="submit" value="Simpan" id="submit" class="btn btn-lg btn-primary mr-2">
                        <a href="index.php" class="btn btn-lg btn-outline-secondary">Kembali</a>
                    </div>
                </div>
            </form>
        </div> 
    </div>
</div>


<!-- Datepicker -->
<script>
    $('[data-toggle="datepicker"]').datepicker({
        format: 'yyyy-mm-dd',
    });
</script>


<?php
include '../templates/footer.php';
?>