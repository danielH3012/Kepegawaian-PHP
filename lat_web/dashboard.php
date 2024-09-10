<?php
include('header.php');
include('sidebar.php');
require 'config.php';

$query = "SELECT * FROM user";
$result = mysqli_query($conn, $query);
$pegawai = mysqli_num_rows($result);

$query = "SELECT * FROM penghargaan";
$result = mysqli_query($conn, $query);
$penghargaan = mysqli_num_rows($result);

$query = "SELECT * FROM peringatan";
$result = mysqli_query($conn, $query);
$peringatan = mysqli_num_rows($result);

$query = "SELECT * FROM cuti";
$result = mysqli_query($conn, $query);
$cuti = mysqli_num_rows($result);
?>
<!-- Content -->
<div class="content-wrapper">
     <!-- Informasi penting HRD -->
    <div class="row">
        <div class="col-md-3">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-users"></i> Total Pegawai</h5>
                    <p class="card-text"><?php echo $pegawai;?> Pegawai</p>
                    
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-trophy"></i> Penghargaan Bulan Ini</h5>
                    <p class="card-text"><?php echo $penghargaan;?> Penghargaan</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-exclamation-triangle"></i> Peringatan Aktif</h5>
                    <p class="card-text"><?php echo $peringatan;?> Peringatan</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-danger">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-plane-departure"></i> Cuti yang Berjalan</h5>
                    <p class="card-text"><?php echo $cuti;?> Pegawai</p>
                </div>
            </div>
        </div>
 </div>

<div class="additional-content">
    <img src="foto/bg.jpg" alt="Welcome Image" class="img-fluid w-100" style="height: auto; objectfit: cover;">
</div>
</div>
<?php
include('footer.php');