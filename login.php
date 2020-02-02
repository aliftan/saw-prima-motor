<?php
include 'templates/header.php';
?>

<div class="container" style="width: 700px">
    <br>
    <br>
    <h1 class="text-center">Sistem SPK Prima Motor</h1>
    <br>

    <!-- If Password/Username Wrong -->
    <?php if (isset($_GET['status']) == "error") { ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Login Gagal!</strong> Username dan password salah, coba lagi.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php } ?>
    
    <div class="card col-6-center">
        <div class="card-header">Login</div>
        <div class="card-body">
            <form action="cek_login.php" method="POST">
                <div class="form-group">
                    <label for="username">Nama User</label>
                    <input type="text" name="username" class="form-control" placeholder="masukan nama user" required>
                </div>
                <div class="form-group">
                    <label for="password">Kata Sandi</label>
                    <input type="password" name="password" class="form-control" placeholder="masukan kata sandi" required>
                </div>
                <input type="submit" value="Masuk" class="btn btn-primary">
            </form>
        </div>
    </div>
</div>

<?php
include 'templates/footer.php';
?>