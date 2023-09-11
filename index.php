<?php
session_start();
include 'header.php';
?>

<!-- Begin Page Content -->
<div class="container-fluid">
  <div class="row">
    <!-- card data user -->
    <?php if(isset($_SESSION['login'])):?>
    <div class="col-lg-3 md-4 sl-6">
      <div class="card text-white  mb-3" style="max-width: 18rem; background-color: darkblue;">
        <div class="card-header bg-transparent border-primary">Data Admin
        </div>
        <div class="card-body ">
          <div class="row">
            <div class="col-4">
              <i class="fa-3x fas fa-users"></i>
            </div>
            <div class="col text-center">
              <?php
              $data = mysqli_query($conn, "SELECT COUNT(*) FROM admin ");
              $admin = mysqli_fetch_array($data)
              ?>
              <h6 class="card-text"><?= $admin[0]; ?></h6>
              <h6 class="card-text">Admin
              </h6>
            </div>
          </div>
        </div>
        <div class="card-footer border-dark text-dark" style="background-color: white;"><a href="dataadmin.php">View Details</a></div>
      </div>
    </div>
    <div class="col-lg-3 md-4 sl-6">
      <div class="card text-white  mb-3" style="max-width: 18rem; background-color: green;">
        <div class="card-header bg-transparent border-primary">Data Kasir</div>
        <div class="card-body ">
          <div class="row">
            <div class="col-4">
              <i class="fa-3x fas fa-address-card"></i>
            </div>
            <div class="col text-center">
              <?php
              $data = mysqli_query($conn, "SELECT COUNT(*) FROM kasir ");
              $kasir = mysqli_fetch_array($data)
              ?>
              <h6 class="card-text"><?= $kasir[0]; ?></h6>
              <h6 class="card-text">KASIR</h6>
            </div>
          </div>
        </div>
        <div class="card-footer border-dark text-dark" style="background-color: white;"><a href="datakasir.php">View Details</a></div>
      </div>
    </div>
            <?php endif;?>
    <!-- end card user -->
    <!-- card data anggota -->
   
    <!-- end card anggota -->   
    <!-- card data penjualan -->
    <div class="col-lg-3 md-4 sl-6">
      <div class="card text-white  mb-3" style="max-width: 18rem; background-color: purple;">
        <div class="card-header bg-transparent border-primary">Data Penjualan</div>
        <div class="card-body ">
          <div class="row">
            <div class="col-4">
              <i class="fa-3x fas fa-user-tie"></i>
            </div>
            <div class="col text-center">
              <?php
              $data = mysqli_query($conn, "SELECT COUNT(*) FROM data_penjualan ");
              $penjualan = mysqli_fetch_array($data)
              ?>
              <h6 class="card-text"><?= $penjualan[0]; ?></h6>
              <h6 class="card-text">PENJUALAN</h6>
            </div>
          </div>
        </div>
        <div class="card-footer border-dark text-dark" style="background-color: white;"><a href="datapenjualan.php">View Details</a></div>
      </div>
    </div>
    
    <div class="col-lg-3 md-4 sl-6">
      <div class="card text-white  mb-3" style="max-width: 18rem; background-color: teal;">
        <div class="card-header bg-transparent border-primary">Data Pembelian</div>
        <div class="card-body ">
          <div class="row">
            <div class="col-4">
              <i class="fa-3x fas fa-building"></i>
            </div>
            <div class="col text-center">
              <?php
              $data = mysqli_query($conn, "SELECT COUNT(*) FROM data_pembelian ");
              $pembelian = mysqli_fetch_array($data)
              ?>
              <h6 class="card-text"><?= $pembelian[0]; ?></h6>
              <h6 class="card-text">PEMBELIAN</h6>
            </div>
          </div>
        </div>
        <div class="card-footer border-dark text-dark" style="background-color: white;"><a href="datapembelian.php">View Details</a></div>
      </div>
    </div>
    <div class="col-lg-3 md-4 sl-6">
      <div class="card text-white  mb-3" style="max-width: 18rem; background-color: crimson;">
        <div class="card-header bg-transparent border-primary">Data Obat</div>
        <div class="card-body ">
          <div class="row">
            <div class="col-4">
              <i class="fa-3x fas fa-book"></i>
            </div>
            <div class="col text-center">
              <?php
              $data = mysqli_query($conn, "SELECT COUNT(*) FROM data_obat ");
              $obat = mysqli_fetch_array($data)
              ?>
              <h6 class="card-text"><?= $obat[0]; ?></h6>
              <h6 class="card-text">DATA OBAT</h6>
            </div>
          </div>
        </div>
        <div class="card-footer border-dark text-dark" style="background-color: white;"><a href="dataobat.php">View Details</a></div>
      </div>
    </div>
    <div class="col-lg-3 md-4 sl-6">
      <div class="card text-white  mb-3" style="max-width: 18rem; background-color: crimson;">
        <div class="card-header bg-transparent border-primary">Data Prediksi</div>
        <div class="card-body ">
          <div class="row">
            <div class="col-4">
              <i class="fa-3x fas fa-book"></i>
            </div>
            <div class="col text-center">
              <?php
              $data = mysqli_query($conn, "SELECT COUNT(*) FROM data_prediksi ");
              $prediksi = mysqli_fetch_array($data)
              ?>
              <h6 class="card-text"><?= $prediksi[0]; ?></h6>
              <h6 class="card-text">DATA PREDIKSI</h6>
            </div>
          </div>
        </div>
        <div class="card-footer border-dark text-dark" style="background-color: white;"><a href="dataprediksi.php">View Details</a></div>
      </div>
    </div>
</div>
</div>
<!-- /.container-fluid -->

<!-- End of Main Content -->
<?php include 'footer.php' ?>
<script>
  document.getElementById("dashboard").className = "nav-item active";
</script>