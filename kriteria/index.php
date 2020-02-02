<?php
session_start();

include '../koneksi.php';

include '../templates/header.php';

include '../templates/navbar_kriteria.php';

if ( $_SESSION['status'] != "login" ) {
    header("location:../login.php");
}

// Get Daftar Kriteria
$query = mysqli_query($conn, " SELECT * FROM TBL_KRITERIA ");

// Hitung Jumlah Kriteria
$query2 = mysqli_query($conn, " SELECT SUM(bobot) as 'jumlah_bobot' FROM TBL_KRITERIA");
$result2 = mysqli_fetch_object($query2);

?>

<br>
<div class="container" style="max-width:1700px; width:100%; ">

    <!-- Message jika tambah kriteria -->
    <?php if (isset($_GET['tambah_kriteria']) == "sukses") { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Berhasil menambah kriteria!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

    <!-- Message jika tambah sub kriteria -->
    <?php } elseif (isset($_GET['tambah_subkriteria']) == "sukses") { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Berhasil menambah sub-kriteria!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

    <!-- Message jika edit kriteria -->
    <?php } elseif (isset($_GET['edit_kriteria']) == "sukses") { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Berhasil memperbaharui kriteria!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

    <!-- Message jika edit sub kriteria -->
    <?php } elseif (isset($_GET['edit_sub_kriteria']) == "sukses") { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Berhasil memperbaharui sub-kriteria!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

    <!-- Message jika delete kriteria -->
    <?php } elseif (isset($_GET['delete_kriteria']) == "sukses") { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Berhasil menghapus kriteria!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

    <!-- Message jika delete sub kriteria -->
    <?php } elseif (isset($_GET['delete_sub_kriteria']) == "sukses") { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Berhasil menghapus sub-kriteria!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

    <?php } ?>

    <!-- Informasi Bobot -->
    <div class="alert alert-<?php echo ($result2->jumlah_bobot > 100 ? 'danger' : 'primary');?>" role="alert">
        <h4 class="alert-heading">INFORMASI PENTING!</h4>
        <p>Jumlah nilai bobot kriteria tidak boleh melebihi dari 100 (seratus).</p>
        <hr>
        <p class="mb-0">Total jumlah bobot kriteria sekarang = <?php echo $result2->jumlah_bobot; ?>.</p>
    </div>

    <!-- Daftar Kriteria -->
    <div class="card">
        <div class="card-header"><strong>Daftar Kriteria</strong>
        </div>

        <div class="card-body">
            <a href="tambah_kriteria_form.php" class="btn btn-primary btn-lg mb-3">
                <i class="fas fa-plus"></i> <strong>Tambah Kriteria</strong>
            </a>
            <table class="table table-hover table-bordered">
              <thead class="thead-dark">
                    <tr>
                        <th scope="col">KODE</th>
                        <th scope="col">KRITERIA</th>
                        <th scope="col">JENIS</th>
                        <th scope="col">BOBOT</th>
                        <th scope="col">KETERANGAN</th>
                        <th scope="col">AKSI</th>
                    </tr>
                </thead>
                <tbody>

                <?php while ($row = mysqli_fetch_array($query)) { ?>
                    <tr>
                        <th scope="row"><?php echo $row[1];?></th>
                        <td><?php echo $row[2];?></td>
                        <td><?php echo ($row[3] == 1 ? '<span class="badge badge-primary">Benefit</span>' : '<span class="badge badge-danger">Cost</span>');?></td>
                        <td>
                            <?php if($row[5] > 100) { ?>
                                <span class="badge badge-danger"><?php echo $row[5];?></span>
                            <?php } else { echo $row[5]; } ?>
                        </td>
                        <td><?php echo $row[4];?></td>
                        <td>
                            <a href="edit_kriteria_form.php?id=<?php echo $row[0];?>" class="btn btn-success btn-sm mr-2">
                                <i class="fas fa-edit"></i> <strong>Edit</strong>
                            </a>
                            <a href="delete_kriteria.php?id=<?php echo $row[0];?>" onClick="return warning();" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i> <strong>Hapus</strong>
                            </a>
                        </td>
                    </tr>
                <?php }
                    // reset pointer to 0
                    mysqli_data_seek($query, 0);
                ?>

                </tbody>
            </table>
        </div>
    </div>
    <br>


    <!-- Daftar Sub-Kriteria -->
    <div class="row">

        <?php while ($row2 = mysqli_fetch_array($query)) { ?>

        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <strong>SUB-KRITERIA - <?php echo $row2[1];?> - <?php echo $row2[2];?> </strong>
                </div>
                <div class="card-body">
                    <a href="tambah_subkriteria_form.php?id=<?php echo $row2[0];?>&kd=<?php echo $row2[1];?>" class="btn btn-primary btn-lg mb-3">
                        <i class="fas fa-plus"></i> <strong>Tambah Sub-Kriteria</strong>
                    </a>

                    <?php

                    // Hitung jumlah data sub kriteria
                    $data_sub = mysqli_query($conn, " SELECT * FROM TBL_SUB_KRITERIA WHERE id_kriteria = $row2[0] ");
                    $jumlah_sub = mysqli_num_rows($data_sub);

                    if ($jumlah_sub > 0) {

                    ?>

                    <table class="table table-hover table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">RANGE</th>
                                <th scope="col">NILAI</th>
                                <th scope="col">KETERANGAN</th>
                                <th scope="col">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            // Get Daftar Sub-Kriteria
                            $query2 = mysqli_query($conn, " SELECT * FROM TBL_SUB_KRITERIA WHERE id_kriteria = $row2[0] ");

                            while ($result_sub = mysqli_fetch_array($query2)) {

                            ?>

                            <tr>
                                <td><?php echo $result_sub[2];?></td>
                                <td>
                                    <?php if($result_sub[3] > 1) { ?>
                                        <span class="badge badge-danger"><?php echo $result_sub[3];?></span>
                                    <?php } else { echo $result_sub[3]; } ?>
                                </td>
                                <td><?php echo $result_sub[4];?></td>
                                <td>
                                    <a href="edit_subkriteria_form.php?id=<?php echo $result_sub[0];?>" class="btn btn-success btn-sm mr-2">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="delete_subkriteria.php?id=<?php echo $result_sub[0];?>" onClick="return warning();" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>

                            <?php } ?>

                        </tbody>
                    </table>

                    <?php } else { ?>
                        <div class="alert alert-danger" role="alert">Tidak ada data, tambahkan!</div>
                    <?php } ?>

                </div>
            </div>
            <br>
        </div>

        <?php } ?>


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
