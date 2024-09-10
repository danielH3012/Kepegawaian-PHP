<div class="sidebar">
 <div class="user-info">
    <!-- Menggunakan path relatif untuk foto pengguna -->
    <img style="height: 50px; width: 50px;" src=<?php echo $user['foto_user']?> alt="User Photo">
        <p><?php echo htmlspecialchars($user['username']); ?></p>
 </div>
 <h4>Menu</h4>
 <ul class="nav flex-column">
    <li class="nav-item">
        <a class="nav-link active" href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="perusahaan.php"><i class="fas fa-briefcase"></i> Nama Perusahaan</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="departemen.php"><i class="fas fa-building"></i> Departemen</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="jabatan.php"><i class="fas fa-user-tie"></i> Jabatan</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="pegawai.php"><i class="fas fa-users"></i> Kepegawaian</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="peringatan.php"><i class="fas fa-exclamation-triangle"></i> Peringatan</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="penghargaan.php"><i class="fas fa-trophy"></i> Penghargaan</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="izin.php"><i class="fas fa-calendar-alt"></i> Izin</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="cuti.php"><i class="fas fa-plane-departure"></i> Cuti</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="laporan.php" data-toggle="collapse" data-target="#laporanSubMenu">
            <i class="fas fa-file-alt"></i> Laporan
        </a>
        <ul id="laporanSubMenu" class="submenu collapse">
            <li><a class="nav-link" href="#">Cetak Pegawai</a></li>
            <li><a class="nav-link" href="#">Cetak Penghargaan</a></li>
            <li><a class="nav-link" href="#">Cetak Peringatan</a></li>
            <li><a class="nav-link" href="#">Cetak Izin</a></li>
            <li><a class="nav-link" href="#">Cetak Cuti</a></li>
        </ul>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#"><i class="fas fa-user-cog"></i> Pengaturan User</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="logout.php" onclick="return confirm('Apakah Anda yakin ingin logout?');">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>
    </li>
 </ul>
</div>