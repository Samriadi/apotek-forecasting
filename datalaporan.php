<?php
session_start();

include 'header.php';

//tambah 
if (isset($_POST['tambah'])) {
  $nama_obat = $_POST['nama_obat'];
  $stock = $_POST['stock'];
  $satuan = $_POST['satuan'];
  $query = "('','$nama_obat','$stock', '$satuan')";
  if (tambah("data_obat", $query) == 1) {
    echo "<script>
            alert('data berhasil ditambahkan');
            document.location.href ='dataobat.php?status=success';
        </script>";
  } else {
    echo "<script>
            alert('data gagal ditambahkan');
            document.location.href ='dataobat.php';
        </script>";
  }
}

//edit 
if (isset($_POST['edit'])) {
  $id = $_POST['id'];
  $nama_obat = $_POST['nama_obat'];
  $stock = $_POST['stock'];
  $satuan = $_POST['satuan'];
  $query = "nama_obat='$nama_obat', stock= '$stock' ,satuan='$satuan' WHERE id='$id'";
  if (update('data_obat', $query) == 1) {
    echo "<script>
                alert('data berhasil diedit');
                document.location.href ='dataobat.php';
            </script>";
  } else {
    echo "<script>
                alert('data gagal diedit');
                document.location.href ='dataobat.php';
            </script>";
  }
}

?>
<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
 
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h3 class="m-0 font-weight-bold text-primary">
        Laporan Stok Obat
      </h3>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead class="thead-light">
            <tr>
              <th>No</th>
              <th>Nama Obat</th>
              <th>Stock</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1;
            $row = mysqli_query($conn, "SELECT * from data_obat where stock < 30 order by update_date DESC ");
            while ($data = mysqli_fetch_assoc($row)) : ?>
              <tr >
                <td><?= $no; ?></td>
                <td><?= $data["nama_obat"]; ?></td>
                <td><?= $data["stock"]; ?></td>
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
        <h5 class="modal-title" id="exampleModalLongTitle">Data Obat</h5>
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

    xhr.open('GET', 'modal_editobat.php?id=' + id, true);
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

    xhr.open('GET', 'modal_tambahobat.php', true);
    xhr.send();
  }
  document.getElementById("datalaporan").className = "nav-item active";
</script>