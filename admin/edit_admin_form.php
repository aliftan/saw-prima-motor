<?php
session_start();

include '../koneksi.php';

include '../templates/header.php';

include '../templates/navbar_admin.php';

if ( $_SESSION['status'] != "login" ) {
    header("location:../login.php");
}

// Get id admin
$id = $_GET['id'];

// Get detail admin
$query = " SELECT * FROM TBL_ADMIN where id = $id ";
$result = mysqli_query($conn, $query);

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
            <form action="update_admin.php" method="POST">
            <input type="hidden" name="id" value="<?php	echo $row->id;?>"/>
                <div class="form-group row">
                    <label for="fullname" class="col-sm-2 col-form-label">Nama lengkap</label>
                    <div class="col-sm-10">
                        <input type="text" name="fullname" value="<?php	echo $row->nama_lengkap;?>" class="form-control form-control-lg" id="fullname" placeholder="masukan nama lengkap" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="username" class="col-sm-2 col-form-label">Nama user</label>
                    <div class="col-sm-10">
                        <input type="text" name="username" value="<?php	echo $row->nama_user;?>" class="form-control form-control-lg" id="username" placeholder="masukan username" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" id="password" name="password" value="<?php	echo $row->kata_sandi;?>" class="form-control form-control-lg" id="password" placeholder="masukan password" required> 
                    </div>
                </div>
                <div class="form-group row align-right">
                    <label for="submit" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                    <input type="checkbox" class="form-check-input" id="showHide" onclick="showPassword()">
                    <label class="form-check-label" for="showHide">Tampilkan Password</label>
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

<!-- Show / hide password -->
<script>
function showPassword() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>

<?php
include '../templates/footer.php';
?>