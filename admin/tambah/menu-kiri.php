<?php
// Get the current script name
$current_page = basename($_SERVER['PHP_SELF']);
?>

<nav id="sidebarMenu" class="sidebar d-lg-block bg-gray-800 text-white collapse" data-simplebar>
  <div class="sidebar-inner px-4 pt-3">
    <ul class="nav flex-column pt-3 pt-md-0">
      <li class="nav-item">
        <a href="../index.php" class="nav-link d-flex align-items-center <?php echo ($current_page == 'index.php') ? 'active' : ''; ?>">
          <span class="sidebar-icon">
            <img src="../../assets/img/brand/light.svg" height="20" width="20" alt="Volt Logo">
          </span>
          <span class="mt-1 ms-1 sidebar-text">Beranda Admin</span>
        </a>
      </li>
      <li class="nav-item <?php echo ($current_page == 'index.php') ? 'active' : ''; ?>">
        <a href="../index.php" class="nav-link">
          <span class="sidebar-icon">
            <i class="bi-speedometer"></i>
          </span> 
          <span class="sidebar-text">Beranda</span>
        </a>
      </li>
      <li class="nav-item <?php echo ($current_page == 'data-aktivitas.php') ? 'active' : ''; ?>">
        <a href="../data/data-aktivitas.php" class="nav-link d-flex justify-content-between">
          <span>
            <span class="sidebar-icon">
              <i class="bi bi-activity"></i>
            </span>
            <span class="sidebar-text">Data Aktivitas</span>
          </span>
          <span>
            <span class="badge badge-sm bg-secondary ms-1 py-2 text-gray-800">
              <?php
              $sql = "SELECT COUNT(*) AS jumlah FROM aktivitas";
              $result = mysqli_query($koneksi, $sql);
              $row = mysqli_fetch_assoc($result);
              echo htmlspecialchars($row['jumlah']);
              ?>
            </span>
          </span>
        </a>
      </li>
      <li class="nav-item <?php echo ($current_page == 'data-destinasi.php') ? 'active' : ''; ?>">
        <a href="../data/data-destinasi.php" class="nav-link d-flex justify-content-between">
          <span>
            <span class="sidebar-icon">
              <i class="bi bi-airplane-engines"></i>
            </span>
            <span class="sidebar-text">Data Destinasi</span>
          </span>
          <span>
            <span class="badge badge-sm bg-secondary ms-1 py-2 text-gray-800">
              <?php
              $sql = "SELECT COUNT(*) AS jumlah FROM destinasi";
              $result = mysqli_query($koneksi, $sql);
              $row = mysqli_fetch_assoc($result);
              echo htmlspecialchars($row['jumlah']);
              ?>
            </span>
          </span>
        </a>
      </li>
      <li class="nav-item <?php echo ($current_page == 'data-pemandu.php') ? 'active' : ''; ?>">
        <a href="../data/data-pemandu.php" class="nav-link d-flex justify-content-between">
          <span>
            <span class="sidebar-icon">
              <i class="bi bi-person-workspace"></i>
            </span>
            <span class="sidebar-text">Data Pemandu</span>
          </span>
          <span>
            <span class="badge badge-sm bg-secondary ms-1 py-2 text-gray-800">
              <?php
              $sql = "SELECT COUNT(*) AS jumlah FROM pemandu";
              $result = mysqli_query($koneksi, $sql);
              $row = mysqli_fetch_assoc($result);
              echo htmlspecialchars($row['jumlah']);
              ?>
            </span>
          </span>
        </a>
      </li>
      <li class="nav-item <?php echo ($current_page == 'data-paket.php') ? 'active' : ''; ?>">
        <a href="../data/data-paket.php" class="nav-link d-flex justify-content-between">
          <span>
            <span class="sidebar-icon">
              <i class="bi bi-box2-heart"></i>
            </span>
            <span class="sidebar-text">Data Paket</span>
          </span>
          <span>
            <span class="badge badge-sm bg-secondary ms-1 py-2 text-gray-800">
              <?php
              $sql = "SELECT COUNT(*) AS jumlah FROM paket";
              $result = mysqli_query($koneksi, $sql);
              $row = mysqli_fetch_assoc($result);
              echo htmlspecialchars($row['jumlah']);
              ?>
            </span>
          </span>
        </a>
      </li>     
      <!-- Repeat for other menu items -->
      <li role="separator" class="dropdown-divider mt-4 mb-3 border-gray-700"></li>
      <li class="nav-item <?php echo ($current_page == 'data-pelanggan.php') ? 'active' : ''; ?>">
        <a href="../data/data-pelanggan.php" class="nav-link d-flex justify-content-between">
          <span>
            <span class="sidebar-icon">
              <i class="bi bi-file-earmark-person"></i>
            </span>
            <span class="sidebar-text">Data Pelanggan</span>
          </span>
          <span>
            <span class="badge badge-sm bg-secondary ms-1 py-2 text-gray-800">
              <?php
              $sql = "SELECT COUNT(*) AS jumlah FROM pelanggan";
              $result = mysqli_query($koneksi, $sql);
              $row = mysqli_fetch_assoc($result);
              echo htmlspecialchars($row['jumlah']);
              ?>
            </span>
          </span>
        </a>
      </li>
      <li class="nav-item <?php echo ($current_page == 'data-transaksi.php') ? 'active' : ''; ?>">
        <a href="../data/data-transaksi.php" class="nav-link d-flex justify-content-between">
          <span>
            <span class="sidebar-icon">
              <i class="bi bi-credit-card"></i>
            </span>
            <span class="sidebar-text">Data Transaksi</span>
          </span>
          <span>
            <span class="badge badge-sm bg-secondary ms-1 py-2 text-gray-800">
              <?php
              $sql = "SELECT COUNT(*) AS jumlah FROM transaksi";
              $result = mysqli_query($koneksi, $sql);
              $row = mysqli_fetch_assoc($result);
              echo htmlspecialchars($row['jumlah']);
              ?>
            </span>
          </span>
        </a>
      </li>
      <li class="nav-item <?php echo ($current_page == 'data-pengguna.php') ? 'active' : ''; ?>">
        <a href="../data/data-pengguna.php" class="nav-link d-flex justify-content-between">
          <span>
            <span class="sidebar-icon">
              <i class="bi bi-person-video2"></i>
            </span>
            <span class="sidebar-text">Data Pengguna</span>
          </span>
          <span>
            <span class="badge badge-sm bg-secondary ms-1 py-2 text-gray-800">
              <?php
              $sql = "SELECT COUNT(*) AS jumlah FROM pengguna";
              $result = mysqli_query($koneksi, $sql);
              $row = mysqli_fetch_assoc($result);
              echo htmlspecialchars($row['jumlah']);
              ?>
            </span>
          </span>
        </a>
      </li>
    </ul>
  </div>
</nav>
