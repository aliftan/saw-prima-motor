<?php
session_start();

include '../koneksi.php';

include '../templates/header.php';

include '../templates/navbar_karyawan.php';

if ( $_SESSION['status'] != "login" ) {
    header("location:../login.php");
}

// Get Daftar Kriteria
$query = mysqli_query($conn, " SELECT * FROM TBL_KARYAWAN ");

// Get Jumlah Karyawan
$jumlah_sub = mysqli_num_rows($query);

?>

<br>
<div class="container" style="max-width:1700px; width:100%; ">

    <!-- Message jika tambah kriteria -->
    <?php if (isset($_GET['tambah']) == "sukses") { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Berhasil menambah karyawan!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

    <!-- Message jika edit kriteria -->
    <?php } elseif (isset($_GET['edit']) == "sukses") { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Berhasil memperbaharui karyawan!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

    <!-- Message jika delete sub kriteria -->
    <?php } elseif (isset($_GET['delete']) == "sukses") { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Berhasil menghapus karyawan!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

    <?php } ?>

    <!-- Daftar Kriteria -->
    <div class="card">
        <div class="card-header"><strong>Daftar Karyawan</strong>
        </div>

        <div class="card-body">
            <a href="tambah_karyawan_form.php" class="btn btn-primary btn-lg mb-3">
                <i class="fas fa-plus"></i> <strong>Tambah Karyawan</strong>
            </a>
            <table class="table table-hover table-bordered">
              <thead class="thead-dark">
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">NAMA KARYAWAN</th>
                        <th scope="col">JENIS KELAMIN</th>
                        <th scope="col">AGAMA</th>
                        <th scope="col">JABATAN</th>
                        <th scope="col">ALAMAT</th>
                        <th scope="col">TAHUN MASUK</th>
                        <th scope="col">AKSI</th>
                    </tr>
                </thead>
                <tbody>

                <?php
                $no = 1;
                while ($row = mysqli_fetch_object($query)) {

                ?>
                    <tr>
                        <th scope="row"><?php echo $no;?></th>
                        <td><?php echo $row->nama_karyawan;?></td>
                        <td><?php echo $row->jenis_kelamin;?></td>
                        <td><?php echo $row->agama;?></td>
                        <td><?php echo $row->jabatan;?></td>
                        <td><?php echo $row->alamat;?></td>
                        <td><?php echo $row->tahun_kerja;?></td>
                        <td>
                            <a href="edit_karyawan_form.php?id=<?php echo $row->id;?>" class="btn btn-success btn-sm mr-2">
                                <i class="fas fa-edit"></i> <strong>Edit</strong>
                            </a>
                            <a href="delete_karyawan.php?id=<?php echo $row->id;?>" onClick="return warning();" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i> <strong>Hapus</strong>
                            </a>
                        </td>
                    </tr>
                <?php
                $no++;
                }
                ?>

                </tbody>
            </table>
        </div>
    </div>
    <br>


    </div>

</div>

<!-- Show Delete Confirmation -->
<script>
function warning() {
	return confirm("Are you sure to delete this data?");
}
</script>

<?php
include '../templates/footer.php';
?>
