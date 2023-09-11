<?php
session_start();
include 'header.php';

//tambah 
// if (isset($_POST['tambah'])) {
//     $tanggal_pembelian = $_POST['tanggal_pembelian'];
//     $nama_obat = $_POST['nama_obat'];
//     $jumlah_pembelian = $_POST['jumlah_pembelian'];
    
//     $query = "('','$tanggal_pembelian','$nama_obat','$jumlah_pembelian')";
//     tambah('data_pembelian',$query);

//     $obat = mysqli_query($conn, "SELECT * FROM data_obat WHERE nama_obat='$nama_obat");
//     $data_obat =(mysqli_fetch_assoc($obat));
//     $stock = $data_obat['stock'];
//     $newstock = $stock+$jumlah_pembelian;

//     echo "<script>console.log('{$stock}' );</script>";
//     echo "<script>console.log('{$jumlah_pembelian}' );</script>";
//     echo "<script>console.log('{$newstock}' );</script>";
//     echo "<script>console.log('{$nama_obat}' );</script>";

//     $query_obat = "stock='$newstock' WHERE nama_obat='$nama_obat'";
//     if (update('data_obat', $query_obat) == 1) {
//       echo "<script>
//               alert('data berhasil ditambah');
//               document.location.href ='datapembelian.php';
//           </script>";
//   } else {
//       echo "<script>
//               alert('data gagal ditambah');
//               document.location.href ='datapembelian.php';
//           </script>";
//   }
// }

//tambah 
if (isset($_POST['tambah'])) {
  $tanggal_pembelian = $_POST['tanggal_pembelian'];
  $nama_obat = $_POST['nama_obat'];
  $jumlah_pembelian = $_POST['jumlah_pembelian'];



  $obat = mysqli_query($conn, "SELECT stock FROM data_obat WHERE nama_obat='$nama_obat'");
  $data_obat =(mysqli_fetch_assoc($obat));
  $stock = $data_obat['stock'];
  $newstock = $stock+$jumlah_pembelian;
  
  if($newstock<=0){
    echo "<script>
            alert('stock tidak cukup');
            document.location.href ='datapembelian.php';
        </script>";
  }
  else{

    $query = "('','$tanggal_pembelian','$nama_obat','$jumlah_pembelian')";
    tambah('data_pembelian',$query);
    
    echo "<script>console.log('{$stock}' );</script>";
    echo "<script>console.log('{$jumlah_pembelian}' );</script>";
    echo "<script>console.log('{$newstock}' );</script>";
    echo "<script>console.log('{$nama_obat}' );</script>";

    $query_obat = "stock='$newstock', update_date=NOW() WHERE nama_obat='$nama_obat'";
    if (update('data_obat', $query_obat) == 1) {
      echo "<script>
              alert('data berhasil ditambah');
              document.location.href ='datapembelian.php';
          </script>";
    } 
    else {
        echo "<script>
                alert('data gagal ditambah');
                document.location.href ='datapembelian.php';
            </script>";
    }
  }

  
}


//edit
if (isset($_POST['edit'])) {
    $id = $_POST['id_pembelian'];
    $jumlah_pembelian = $_POST['jumlah_pembelian'];


    $query = "jumlah_pembelian='$jumlah_pembelian' WHERE id_pembelian='$id'";

    if (update('data_pembelian', $query) == 1) {
        echo "<script>
                alert('data berhasil di edit');
                document.location.href ='datapembelian.php';
            </script>";
    } else {
        echo "<script>
                alert('data gagal diedit');
                document.location.href ='datapembelian.php';
            </script>";
    }
}

?>
<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <?php if(isset($_SESSION['login'])):?>
  <a href="" class="btn btn-primary btn-md mb-3" onclick="tambah()" data-toggle="modal" data-target="#exampleModalCenter">Tambah Pembelian</a>
  <?php endif;?>
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h3 class="m-0 font-weight-bold text-primary">
        Data Pembelian
      </h3>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead class="thead-light">
            <tr>
              <th>No</th>
              <th>Tanggal Pembelian</th>
              <th>Nama Obat</th>
              <th>Jumlah Pembelian</th>
              <?php if(isset($_SESSION['login'])):?>
              <th>Action</th>
              <?php endif;?>

            </tr>
          </thead>
          <tbody>
            <?php $no = 1;
            $q = mysqli_query($conn, "SELECT * FROM data_pembelian ORDER BY id_pembelian DESC");
            while ($data = mysqli_fetch_assoc($q)) : ?>
              <tr >
                <td><?= $no; ?></td>
                <td><?= $data["tanggal_pembelian"]; ?></td>
                <td><?= $data["nama_obat"]; ?></td>
                <td><?= $data["jumlah_pembelian"]; ?></td>
                <?php if(isset($_SESSION['login'])):?>
                <td><a class="btn btn-warning" href="#" onclick="edit(<?= $data['id_pembelian']; ?>)" data-toggle="modal" data-target="#exampleModalCenter">edit</a>
                <a class="btn btn-danger" href="hapuspembelian.php?id=<?= $data["id_pembelian"]; ?>" onclick="return confirm('yakin ingin hapus data?')">hapus</a></td>
                <?php endif;?>
              </tr>
              <?php $no++; ?>
            <?php endwhile; ?>
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
        <h5 class="modal-title" id="exampleModalLongTitle">Data Pembelian</h5>
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

    xhr.open('GET', 'modal_editpembelian.php?id=' + id, true);
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

    xhr.open('GET', 'modal_tambahpembelian.php', true);
    xhr.send();
  }
  document.getElementById("datapembelian").className = "nav-item active";
</script>