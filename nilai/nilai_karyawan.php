<?php
session_start();

include '../koneksi.php';

include '../templates/header.php';

include '../templates/navbar_hitung_nilai.php';

if ( $_SESSION['status'] != "login" ) {
    header("location:../login.php");
}

// Get Daftar Nilai Karyawan
$karyawan_list = mysqli_query($conn, " SELECT DISTINCT a.id_karyawan, b.nama_karyawan
  FROM tbl_nilai_karyawan AS a
  JOIN tbl_karyawan AS b ON a.id_karyawan = b.id ");


// Get Daftar Kriteria
$kriteria_list = mysqli_query($conn, " SELECT kd_kriteria, nama_kriteria FROM tbl_kriteria ");


// Kosongkan table rating
mysqli_query( $conn, " DELETE FROM tbl_ranking ");

?>

<br>
<div class="container" style="max-width:1700px; width:100%; ">

    <!-- Daftar Karyawan -->
    <table class="table table-hover table-bordered">
        <thead class="thead-dark">
          <tr>
            <th>Nama Karyawan</th>

            <?php while ( $kriteria = mysqli_fetch_array($kriteria_list) ) { ?>

              <th><?php echo $kriteria[1];?> (<?php echo $kriteria[0];?>)</th>

            <?php } mysqli_data_seek($kriteria_list, 0); ?>



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

            </tr>


          <?php } mysqli_data_seek($karyawan_list, 0); ?>

        </tbody>

    </table>


    <!-- Start Proses -->
    <a href="nilai_karyawan.php?mode=hitung" class="btn btn-primary btn-lg mb-3">
      <i class="fas fa-rocket"></i> <strong>Hitung Nilai Rating</strong>
    </a>


    <!-- Proses -->
    <?php

    if (isset ($_GET['mode']) == "hitung" ) {

    ?>


    <br><br><br>

    <!-- Rating Kecocokan -->
    <h4>Rating Kecocokan</h4>
    <table class="table table-hover table-bordered">
        <thead class="thead-dark">
          <tr>
            <th>Nama Karyawan</th>

            <?php while ( $kriteria = mysqli_fetch_array($kriteria_list) ) { ?>

              <th><?php echo $kriteria[1];?> (<?php echo $kriteria[0];?>)</th>

            <?php } mysqli_data_seek($kriteria_list, 0); ?>

          </tr>
        </thead>

        <tbody>

          <?php while ($karyawan = mysqli_fetch_array($karyawan_list) ) { ?>
            <tr>
                <td><?php echo $karyawan[1];?></td>

                <?php

                $id_karyawan = $karyawan[0];

                // Get Daftar nilai
                $daftar_nilai = mysqli_query($conn, "SELECT b.nilai FROM tbl_nilai_karyawan AS a
                                JOIN tbl_sub_kriteria AS b ON a.id_sub_kriteria = b.id WHERE id_karyawan = $id_karyawan ");
                                ?>

                <?php while ( $nilai = mysqli_fetch_array($daftar_nilai) ) { ?>

                  <td><?php echo $nilai[0];?></td>

                <?php } mysqli_data_seek($daftar_nilai, 0); ?>

            </tr>


          <?php } mysqli_data_seek($karyawan_list, 0); ?>

        </tbody>

    </table>

    <br><br>

    <!-- Hasil Perhitungan Normalisasi 1 -->
    <h4>Hasil Perhitungan Normalisasi 1</h4>
    <table class="table table-hover table-bordered">
        <thead class="thead-dark">
          <tr>
            <th>Nama Karyawan</th>

            <?php while ( $kriteria = mysqli_fetch_array($kriteria_list) ) { ?>

              <th><?php echo $kriteria[1];?> (<?php echo $kriteria[0];?>)</th>

            <?php } mysqli_data_seek($kriteria_list, 0); ?>

          </tr>
        </thead>

        <tbody>

          <?php while ($karyawan = mysqli_fetch_array($karyawan_list) ) { ?>
            <tr>
                <td><?php echo $karyawan[1];?></td>

                <?php

                $id_karyawan = $karyawan[0];

                // Get Daftar nilai
                $daftar_nilai_karyawan = mysqli_query($conn, "SELECT b.nilai, c.jenis_atribut, c.kd_kriteria
                  FROM tbl_nilai_karyawan AS a
                  JOIN tbl_sub_kriteria AS b
                  ON a.id_sub_kriteria = b.id
                  JOIN tbl_kriteria as c
                  ON b.id_kriteria = c.id
                  WHERE id_karyawan = $id_karyawan ");

                ?>

                <?php while ( $nilai_karyawan = mysqli_fetch_array($daftar_nilai_karyawan) ) { ?>

                  <td>

                    <?php

                    $nilai_k = $nilai_karyawan[0];
                    $jenis_atribut = $nilai_karyawan[1];
                    $kriteria = $nilai_karyawan[2];

                    // Benefit
                    if ($jenis_atribut == 1)
                    {

                      // Cari Nilai Max
                      $cari_nilai_max = mysqli_query( $conn, "SELECT MAX(b.nilai) FROM tbl_nilai_karyawan AS a
                                                              JOIN tbl_sub_kriteria AS b ON a.id_sub_kriteria = b.id
                                                              JOIN tbl_kriteria as c ON b.id_kriteria = c.id
                                                              WHERE c.kd_kriteria = '$kriteria' ");

                      while ( $max = mysqli_fetch_array($cari_nilai_max) )
                      {

                      $nilai_max = $max[0];

                      echo round($nilai_k / $nilai_max, 2);

                      } mysqli_data_seek($cari_nilai_max, 0);

                    }

                    // Cost
                    elseif ($jenis_atribut == 2)
                    {

                      // Cari Nilai Min
                      $cari_nilai_min = mysqli_query( $conn, "SELECT MIN(b.nilai) FROM tbl_nilai_karyawan AS a
                                                              JOIN tbl_sub_kriteria AS b ON a.id_sub_kriteria = b.id
                                                              JOIN tbl_kriteria as c ON b.id_kriteria = c.id
                                                              WHERE c.kd_kriteria = '$kriteria' ");

                      while ( $min = mysqli_fetch_array($cari_nilai_min) )
                      {

                      $nilai_min = $min[0];

                      echo round($nilai_min / $nilai_k, 2);

                      } mysqli_data_seek($cari_nilai_min, 0);

                    }

                    ?>

                  </td>

                <?php } mysqli_data_seek($daftar_nilai, 0); ?>

            </tr>

          <?php } mysqli_data_seek($karyawan_list, 0); ?>

        </tbody>

    </table>

    <br><br>

    <!-- Hasil Perhitungan Normalisasi dengan bobot -->
    <h4>Hasil Perhitungan Normalisasi Bobot Kriteria</h4>
    <table class="table table-hover table-bordered">
        <thead class="thead-dark">
          <tr>
            <th>Nama Karyawan</th>

            <?php while ( $kriteria = mysqli_fetch_array($kriteria_list) ) { ?>

              <th><?php echo $kriteria[1];?> (<?php echo $kriteria[0];?>)</th>

            <?php } mysqli_data_seek($kriteria_list, 0); ?>



          </tr>
        </thead>

        <tbody>

          <?php while ($karyawan = mysqli_fetch_array($karyawan_list) ) { ?>
            <tr>
                <td><?php echo $karyawan[1];?></td>

                <?php

                $id_karyawan = $karyawan[0];

                // Get Daftar nilai
                $daftar_nilai_karyawan = mysqli_query($conn, "SELECT b.nilai, c.jenis_atribut, c.kd_kriteria
                  FROM tbl_nilai_karyawan AS a
                  JOIN tbl_sub_kriteria AS b
                  ON a.id_sub_kriteria = b.id
                  JOIN tbl_kriteria as c
                  ON b.id_kriteria = c.id
                  WHERE id_karyawan = $id_karyawan ");

                ?>

                <?php while ( $nilai_karyawan = mysqli_fetch_array($daftar_nilai_karyawan) ) { ?>

                  <td>

                    <?php


                    $nilai_k = $nilai_karyawan[0];
                    $jenis_atribut = $nilai_karyawan[1];
                    $kriteria = $nilai_karyawan[2];


                    // Cari Nilai Bobot
                    $cari_bobot_kriteria = mysqli_query( $conn, "SELECT bobot FROM tbl_kriteria WHERE kd_kriteria = '$kriteria' ");
                    $result = mysqli_fetch_object($cari_bobot_kriteria);
                    $nilai_bobot_kriteria = $result->bobot;


                    // Benefit
                    if ($jenis_atribut == 1)
                    {

                      // Cari Nilai Max
                      $cari_nilai_max = mysqli_query( $conn, "SELECT MAX(b.nilai) FROM tbl_nilai_karyawan AS a
                                                              JOIN tbl_sub_kriteria AS b ON a.id_sub_kriteria = b.id
                                                              JOIN tbl_kriteria as c ON b.id_kriteria = c.id
                                                              WHERE c.kd_kriteria = '$kriteria' ");

                      while ( $max = mysqli_fetch_array($cari_nilai_max) )
                      {

                        $nilai_max = $max[0];
                        $hasil_nilai_max = $nilai_k / $nilai_max;
                        $hasil_nilai_bobot_benefit = $hasil_nilai_max * $nilai_bobot_kriteria;


                        // Input Data
                        $insert_data_ranking_1 = " INSERT INTO tbl_ranking (id_karyawan, kd_kriteria, nilai) VALUES ($id_karyawan, '$kriteria', $hasil_nilai_bobot_benefit) ";
                        mysqli_query($conn, $insert_data_ranking_1);




                        echo round($hasil_nilai_bobot_benefit, 2);


                      } mysqli_data_seek($cari_nilai_max, 0);

                    }


                    // Cost
                    elseif ($jenis_atribut == 2)
                    {

                      // Cari Nilai Min
                      $cari_nilai_min = mysqli_query( $conn, "SELECT MIN(b.nilai) FROM tbl_nilai_karyawan AS a
                                                              JOIN tbl_sub_kriteria AS b ON a.id_sub_kriteria = b.id
                                                              JOIN tbl_kriteria as c ON b.id_kriteria = c.id
                                                              WHERE c.kd_kriteria = '$kriteria' ");

                      while ( $min = mysqli_fetch_array($cari_nilai_min) )
                      {

                      $nilai_min = $min[0];
                      $hasil_nilai_min = $nilai_min / $nilai_k;
                      $hasil_nilai_bobot_cost = $hasil_nilai_min * $nilai_bobot_kriteria;

                      // Input Data
                      $insert_data_ranking_2 = " INSERT INTO tbl_ranking (id_karyawan, kd_kriteria, nilai)
                                                VALUES ($id_karyawan, '$kriteria', $hasil_nilai_bobot_cost) ";
                      mysqli_query($conn, $insert_data_ranking_2);

                      echo round($hasil_nilai_bobot_cost, 2);


                      } mysqli_data_seek($cari_nilai_min, 0);

                    }



                    ?>


                  </td>

                <?php } mysqli_data_seek($daftar_nilai, 0); ?>

            </tr>


          <?php } mysqli_data_seek($karyawan_list, 0); ?>

        </tbody>

    </table>

    <br><br>

    <!-- Daftar Ranking Karyawan -->
    <h4>Hasil Rating Karyawan</h4>
    <table class="table table-hover table-bordered">
        <thead class="thead-dark">
          <tr>
            <th>Nama Karyawan</th>
            <th>Total Nilai</th>
          </tr>
        </thead>

        <tbody>

        <?php

          // Get Daftar nilai
          $daftar_nilai_akhir = mysqli_query($conn, " SELECT distinct b.id, b.nama_karyawan, SUM(a.nilai) AS total_nilai
                                FROM tbl_ranking a JOIN tbl_karyawan b
                                ON a.id_karyawan = b.id GROUP BY a.id_karyawan
                                ORDER BY total_nilai DESC ");

        ?>


          <?php
          $x = 0;
          while ($hasil_ranking = mysqli_fetch_array($daftar_nilai_akhir) ) { ?>
            <tr>
                <td><?php echo $hasil_ranking[1];?></td>
                <td>
                  <?php echo round($hasil_ranking[2], 2);?>
                  <?php echo "<h5>"; ?>
                  <?php echo ($x == 0 ? '<span class="badge badge-success">👍Terbaik</span>' : ' '); ?>
                  <?php echo "</h5>"; ?>
                </td>
            </tr>



          <?php
            $x++;
            } mysqli_data_seek($daftar_nilai_akhir, 0);
          ?>

        </tbody>

    </table>


    <!-- End Isset -->
    <?php } ?>


    <br><br><br>


</div>

<br><br>

<?php
include '../templates/footer.php';
?>
