<?php
session_start();

include '../koneksi.php';

include '../templates/header.php';

include '../templates/navbar_admin.php';

if ( $_SESSION['status'] != "login" ) {
    header("location:../login.php");
}

?>



<br>
<div class="container">
    
    <!-- Link Breadcumb -->
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Admin</a></li>
        <li class="breadcrumb-item active" aria-current="page">Tambah Admin</li>
      </ol>
    </nav>

    <!-- Tambah Admin -->
    <div class="card">
        <div class="card-header"><strong>Tambah Admin</strong>
        </div>

        <div class="card-body">
            <form action="tambah_admin.php" method="POST">
                <div class="form-group row">
                    <label for="fullname" class="col-sm-2 col-form-label">Nama lengkap</label>
                    <div class="col-sm-10">
                        <input type="text" name="fullname" class="form-control form-control-lg" id="fullname" placeholder="masukan nama lengkap" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="username" class="col-sm-2 col-form-label">Nama user</label>
                    <div class="col-sm-10">
                        <input type="text" name="username" class="form-control form-control-lg" id="username" placeholder="masukan username" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" name="password" class="form-control form-control-lg" id="password" placeholder="masukan password" required>
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