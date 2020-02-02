<?php
session_start();

include '../koneksi.php';

include '../templates/header.php';

include '../templates/navbar_nilai.php';

if ( $_SESSION['status'] != "login" ) {
    header("location:../login.php");
}

// Get Daftar Karyawan
$karyawan_list = mysqli_query($conn, " SELECT * FROM tbl_karyawan
                  WHERE id NOT IN (SELECT id_karyawan FROM tbl_nilai_karyawan) ");

// Get Daftar Kriteria
$kriteria_list = mysqli_query($conn, " SELECT * FROM tbl_kriteria ");

?>

<br>
<div class="container">

    <!-- Link Breadcumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Nilai Karyawan</a></li>
            <li class="breadcrumb-item active" aria-current="page">Input Nilai Karyawan</li>
        </ol>
    </nav>

    <!-- Tambah Kriteria -->
    <div class="card">
        <div class="card-header"><strong>Input Nilai Karyawan</strong>
        </div>
        <div class="card-body">
            <form action="input_nilai_karyawan.php" method="POST">

                <!-- Search Karyawan -->
                <div class="form-group row">
                    <label for="id_karyawan" class="col-sm-2 col-form-label">Pilih Karyawan</label>
                    <div class="col-sm-10">
                        <select name="id_karyawan" class="form-control form-control-lg" id="id_karyawan" required>
                          <?php while ($row = mysqli_fetch_array($karyawan_list)) { ?>
                            <option value="<?php echo $row[0];?>">
                              <?php echo $row[1];?>
                            </option>
                          <?php }
                              mysqli_data_seek($karyawan_list, 0);
                          ?>
                        </select>
                    </div>
                </div>

                <!-- Loop kriteria with sub criteria as options -->
                <?php while ($row2 = mysqli_fetch_array($kriteria_list)) { ?>
                <div class="form-group row">
                    <label for="id_kriteria" class="col-sm-2 col-form-label"><?php echo $row2[2];?></label>

                    <?php
                    $id_kriteria = $row2[0];

                    // Get Daftar sub kriteria
                    $query_sub_kriteria = "SELECT * FROM tbl_sub_kriteria WHERE id_kriteria = $id_kriteria ";
                    $subkriteria_list = mysqli_query($conn, $query_sub_kriteria);

                    ?>

                    <div class="col-sm-10">
                        <select name="id_sub_kriteria_<?php echo $row2[1];?>" class="form-control form-control-lg" id="id_sub_kriteria" >
                          <?php
                          while ($row3 = mysqli_fetch_array($subkriteria_list)) { ?>
                            <option value="<?php echo $row3[0];?>">
                              <?php echo $row3[2];?>
                            </option>
                          <?php }
                              mysqli_data_seek($subkriteria_list, 0);
                          ?>
                        </select>
                    </div>
                </div>
                <?php }
                    mysqli_data_seek($kriteria_list, 0);
                ?>

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
