<?php
session_start();

include '../koneksi.php';

include '../templates/header.php';

include '../templates/navbar_nilai.php';

if ( $_SESSION['status'] != "login" ) {
    header("location:../login.php");
}

// Get Daftar Nilai Karyawan
$karyawan_list = mysqli_query($conn, " SELECT DISTINCT a.id_karyawan, b.nama_karyawan
                              FROM tbl_nilai_karyawan AS a
                              JOIN tbl_karyawan AS b ON a.id_karyawan = b.id ");


// Get Daftar Kriteria
$kriteria_list = mysqli_query($conn, " SELECT kd_kriteria, nama_kriteria FROM tbl_kriteria ");

?>

<br>
<div class="container" style="max-width:1700px; width:100%; ">

    <!-- Message jika nilai karyawan -->
    <?php if (isset($_GET['tambah_nilai']) == "sukses") { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Berhasil menambah nilai!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

    <!-- Message jika delete nilai karyawan -->
  <?php } elseif (isset($_GET['delete_nilai']) == "sukses") { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Berhasil menghapus nilai!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

    <?php } ?>


    <a href="input_nilai_karyawan_form.php" class="btn btn-primary btn-lg mb-3">
        <i class="fas fa-plus"></i> <strong>Input Nilai Karyawan</strong>
    </a>


    <table class="table table-hover table-bordered">
        <thead class="thead-dark">

          <tr>

            <th>Nama Karyawan</th>

            <?php while ( $kriteria = mysqli_fetch_array($kriteria_list) ) { ?>

              <th><?php echo $kriteria[1];?> (<?php echo $kriteria[0];?>)</th>

            <?php } mysqli_data_seek($kriteria_list, 0); ?>

            <th>Aksi</th>

          </tr>

        </thead>

        <tbody>

          <?php while ($karyawan = mysqli_fetch_array($karyawan_list) ) { ?>

            <tr>

                <td><?php echo $karyawan[1];?></td>

                <?php

                $id_karyawan = $karyawan[0];

                // Get Daftar nilai
                $daftar_nilai = mysqli_query($conn, "SELECT b.nama_sub_kriteria FROM tbl_nilai_karyawan AS a
                                JOIN tbl_sub_kriteria AS b ON a.id_sub_kriteria = b.id WHERE id_karyawan = $id_karyawan ");
                                ?>

                <?php while ( $nilai = mysqli_fetch_array($daftar_nilai) ) { ?>

                  <td><?php echo $nilai[0];?></td>

                <?php } mysqli_data_seek($daftar_nilai, 0); ?>

                <td>
                  <a href="delete_nilai.php?id=<?php echo $karyawan[0];?>" onClick="return warning();" class="btn btn-danger btn-sm">
                    <i class="fas fa-trash"></i> <strong>Hapus</strong>
                  </a>
                </td>

            </tr>


          <?php } mysqli_data_seek($karyawan_list, 0); ?>

        </tbody>

    </table>



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
