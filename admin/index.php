<?php
session_start();

include '../koneksi.php';

include '../templates/header.php';

include '../templates/navbar_admin.php';

if ( $_SESSION['status'] != "login" ) {
    header("location:../login.php");
}

// Get Daftar Admin
$query = mysqli_query($conn, " SELECT * FROM TBL_ADMIN");
$result = mysqli_num_rows($query);

?>



<br>
<div class="container">

    <!-- Message jika tambah -->
    <?php if (isset($_GET['tambah']) == "sukses") { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Berhasil menambah admin!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

    <!-- Message jika edit -->
    <?php } elseif (isset($_GET['edit']) == "sukses") { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Berhasil memperbaharui admin!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

    <!-- Message jika delete -->
    <?php } elseif (isset($_GET['delete']) == "sukses") { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Berhasil menghapus admin!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php } ?>
    
    <!-- Daftar Admin -->
    <div class="card">
        <div class="card-header"><strong>Daftar Admin</strong>
        </div>
        
        <div class="card-body">
            <a href="tambah_admin_form.php" class="btn btn-primary btn-lg mb-3">
                <i class="fas fa-plus"></i> <strong>Tambah Admin</strong>
            </a>
            <table class="table table-hover table-bordered">
              <thead class="thead-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">NAMA USER</th>
                        <th scope="col">NAMA LENGKAP</th>
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
                        <td><?php echo $row->nama_user;?></td>
                        <td><?php echo $row->nama_lengkap;?></td>
                        <td>
                            <a href="edit_admin_form.php?id=<?php echo $row->id;?>" class="btn btn-success btn-sm mr-2">
                                <i class="fas fa-edit"></i> <strong>Edit</strong>
                            </a>
                            <?php if ($_SESSION['user_id'] != $row->id) { ?>
                            <a href="delete_admin.php?id=<?php echo $row->id;?>" onClick="return warning();" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i> <strong>Hapus</strong>
                            </a>
                            <?php }?>
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