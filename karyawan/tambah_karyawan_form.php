<?php
session_start();

include '../koneksi.php';

include '../templates/header.php';

include '../templates/navbar_karyawan.php';

if ( $_SESSION['status'] != "login" ) {
    header("location:../login.php");
}

?>

<br>
<div class="container">
    
    <!-- Link Breadcumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Karyawan</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Karyawan</li>
        </ol>
    </nav>
    
    <!-- Tambah Kriteria -->
    <div class="card">
        <div class="card-header"><strong>Tambah Kriteria</strong>
        </div>
        <div class="card-body">
            <form action="tambah_karyawan.php" method="POST">
                <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">Nama Karyawan</label>
                    <div class="col-sm-10">
                        <input type="text" name="nama" class="form-control form-control-lg" placeholder="masukan nama karyawan" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="jenis" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-10">
                        <select name="gender" class="form-control form-control-lg" id="jenis" required>
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="jenis" class="col-sm-2 col-form-label">Agama</label>
                    <div class="col-sm-10">
                        <select name="agama" class="form-control form-control-lg" id="jenis" required>
                            <option value="Islam">Islam</option>
                            <option value="Kristen Protestan">Kristen Protestan</option>
                            <option value="Katolik">Katolik</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Buddha">Buddha</option>
                            <option value="Kong Hu Cu">Kong Hu Cu</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="jenis" class="col-sm-2 col-form-label">Jabatan</label>
                    <div class="col-sm-10">
                        <select name="jabatan" class="form-control form-control-lg" id="jenis" required>
                            <option value="Admin">Admin</option>
                            <option value="Admin CRM">Admin CRM</option>
                            <option value="Admin STNK & BPKB">Admin STNK & BPKB</option>
                            <option value="Deliveryman">Deliveryman</option>
                            <option value="Foreign Direct Investment (FDI)">Foreign Direct Investment (FDI]</option>
                            <option value="Frontdesk">Frontdesk</option>
                            <option value="Kasir">Kasir</option>
                            <option value="Kepala Bengkel">Kepala Bengkel</option>
                            <option value="Kepala Gudang Unit">Kepala Gudang Unit</option>
                            <option value="Kepala Mekanik">Kepala Mekanik</option>
                            <option value="Mekanik">Mekanik</option>
                            <option value="PIC Part">PIC Part</option>
                            <option value="Sales">Sales</option>
                            <option value="Service Advisor">Service Advisor</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                        <textarea name="alamat" class="form-control form-control-lg" id="alamat" rows="3" placeholder="masukan keterangan" required></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="tahun" class="col-sm-2 col-form-label">Tanggal Masuk</label>
                    <div class="col-sm-10">
                        <input type="tahun" name="tahun" data-toggle="datepicker" autocomplete="off" class="form-control form-control-lg" placeholder="dd/mm/yyyy" required>
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

<!-- Datepicker -->
<script>
    $('[data-toggle="datepicker"]').datepicker({
        format: 'yyyy-mm-dd',
    });
</script>

<?php
include '../templates/footer.php';
?>