<?php
session_start();

include 'header.php';

//tambah 
if (isset($_POST['tambah'])) {
    $tanggal_penjualan = $_POST['tanggal_penjualan'];
    $nama_obat = $_POST['nama_obat'];
    $jumlah_penjualan = $_POST['jumlah_penjualan'];



    $obat = mysqli_query($conn, "SELECT * FROM data_obat WHERE nama_obat='$nama_obat'");
    $data_obat =(mysqli_fetch_assoc($obat));
    $stock = $data_obat['stock'];
    $newstock = $stock-$jumlah_penjualan;
    
    if($newstock<=0){
      echo "<script>
              alert('stock tidak cukup');
              document.location.href ='datapenjualan.php';
          </script>";
    }
    else{

      $query = "('','$tanggal_penjualan','$nama_obat','$jumlah_penjualan')";
      tambah('data_penjualan',$query);
      
      echo "<script>console.log('{$stock}' );</script>";
      echo "<script>console.log('{$jumlah_penjualan}' );</script>";
      echo "<script>console.log('{$newstock}' );</script>";
      echo "<script>console.log('{$nama_obat}' );</script>";
  
      $query_obat = "stock='$newstock' , update_date=NOW() WHERE nama_obat='$nama_obat'";
      if (update('data_obat', $query_obat) == 1) {
        echo "<script>
                alert('data berhasil ditambah');
                document.location.href ='datapenjualan.php';
            </script>";
      } 
      else {
          echo "<script>
                  alert('data gagal ditambah');
                  document.location.href ='datapenjualan.php';
              </script>";
      }
    }

    
}

//edit
if (isset($_POST['edit'])) {
    $id = $_POST['id_penjualan'];
    $jumlah_penjualan = $_POST['jumlah_penjualan'];

    echo "<script>console.log('{$jumlah_penjualan}' );</script>";
    echo "<script>console.log('{$nama_obat}' );</script>";
    echo "<script>console.log('{$tanggal_penjualan}' );</script>";

   

    $query = "jumlah_penjualan='$jumlah_penjualan' WHERE id_penjualan='$id'";

    if (update('data_penjualan', $query) == 1) {
        echo "<script>
                alert('data berhasil di edit');
                document.location.href ='datapenjualan.php';
            </script>";
    } else {
        echo "<script>
                alert('data gagal diedit');
                document.location.href ='datapenjualan.php';
            </script>";
    }
}
function tanggal_indo($tanggal)
{
	$bulan = array (1 =>   
        'Januari',
				'Februari',
				'Maret',
				'April',
				'Mei',
				'Juni',
				'Juli',
				'Agustus',
				'September',
				'Oktober',
				'November',
				'Desember'
			);
	$split = explode('-', $tanggal);
	return $bulan[ (int)$split[1] ] . ' ' . $split[0];
}

if (isset($_POST['search'])) {
  $bln = date($_POST['bulan']);
  if (!empty($bln)) {
   // perintah tampil data berdasarkan periode bulan
   $q = mysqli_query($conn, "SELECT * FROM data_penjualan WHERE MONTH(tanggal_penjualan) = '$bln'");
  } else {
   // perintah tampil semua data
   $q = mysqli_query($conn, "SELECT * FROM data_penjualan ORDER BY id_penjualan DESC");
  }
 } 
 else {
  // perintah tampil semua data
  $q = mysqli_query($conn, "SELECT * FROM data_penjualan ORDER BY id_penjualan DESC");
 }
?>

<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <?php if(isset($_SESSION['login'])||isset($_SESSION['kasir'])):?>
  <a href="" class="btn btn-primary btn-md mb-3" onclick="tambah()" data-toggle="modal" data-target="#exampleModalCenter">Tambah Penjualan</a>
  <?php endif;?>
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h3 class="m-0 font-weight-bold text-primary">
        Data Penjualan
      </h3>
    </div>
    <div class="card-body">
    <div class="row">
    <div class="form-group col-2">
    <form method="POST" action="" class="form-inline">
    
    <select class="form-control" id="bulan" name="bulan" required>
            <option value="" selected disabled hidden>Pilih Bulan</option>
            <option value="1">Januari</option>
            <option value="2">Februari</option>
            <option value="3">Maret</option>
            <option value="4">April</option>
            <option value="5">Mei</option>
            <option value="6">Juni</option>
            <option value="7">Juli</option>
            <option value="8">Agustus</option>
            <option value="9">September</option>
            <option value="10">Oktober</option>
            <option value="11">November</option>
            <option value="12">Desember</option>
        </select>
    </div>
    <div class="form-group col-1">
    <button type="submit" name="search" class="btn btn-success">Tampilkan </button>
  </form>
    </div>
    </div>
    <div class="form-group col-2">
     <a href="cetak.php?hal=<?= $bln;?>"><input type="button" class="btn btn-secondary" value="Cetak"></a>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead class="thead-light">
            <tr>
              <th>No</th>
              <th>Tanggal Penjualan</th>
              <th>Nama Obat</th>
              <th>Jumlah Terjual</th>
              <?php if(isset($_SESSION['login'])||isset($_SESSION['kasir'])):?>
              <th>Action</th>
              <?php endif;?>

            </tr>
          </thead>
          <tbody>
          <?php
      
            $no = 1;
            while ($r = $q->fetch_assoc()) {
            ?>
              <tr >
                <td><?= $no++; ?></td>
                <td><?= $r["tanggal_penjualan"]; ?></td>
                <td><?= $r["nama_obat"]; ?></td>
                <td><?= $r["jumlah_penjualan"]; ?></td>
                <?php if(isset($_SESSION['login'])||isset($_SESSION['kasir'])):?>
                <td><a class="btn btn-warning" href="#" onclick="edit(<?= $r['id_penjualan']; ?>)" data-toggle="modal" data-target="#exampleModalCenter">edit</a>
                <a class="btn btn-danger" href="hapuspenjualan.php?id=<?= $r["id_penjualan"]; ?>" onclick="return confirm('yakin ingin hapus data?')">hapus</a></td>
                <?php endif;?>
              </tr>
              <?php   
              }
              
              ?>
   

          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!--modal-->
<div class="modal fade" id="exampleModalCenter">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Data Penjualan</h5>
        <button type="button" class="close" data-dismiss="modal">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="POST">
        <div id="form">
          <div class="modal-body">
            

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="edit">tambah</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<!--Endmodal-->
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->

<?php include 'footer.php'; ?>
<script>
  function edit(a) {
    var id = a;
    var form = document.getElementById('form');
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {

      if (xhr.readyState == 4 && xhr.status == 200) {
        form.innerHTML = xhr.responseText;
      }
    }

    xhr.open('GET', 'modal_editpenjualan.php?id=' + id, true);
    xhr.send();
  }

  function tambah() {
    var form = document.getElementById('form');
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {

      if (xhr.readyState == 4 && xhr.status == 200) {
        form.innerHTML = xhr.responseText;
      }
    }

    xhr.open('GET', 'modal_tambahpenjualan.php', true);
    xhr.send();
  }
  document.getElementById("datapenjualan").className = "nav-item active";
</script>