<!DOCTYPE html>
<html>
<head>
	<title>Data Penjualan</title>
</head>
<body>

<?php
include 'fungsi.php';

if (isset($_GET['hal'])) {
    $bln = date($_GET['hal']);
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

	<center>
 
		<h2>DATA PENJUALAN OBAT</h2>
 
	</center>
 
	
 
	<table border="1" style="width: 100%">
		<tr>
        <th>No</th>
              <th>Tanggal Penjualan</th>
              <th>Nama Obat</th>
              <th>Jumlah Terjual</th>
		</tr>
    <?php
      $no = 1;
      while ($r = $q->fetch_assoc()) {
      ?>
        <tr >
          <td><?= $no++; ?></td>
          <td><?= $r["tanggal_penjualan"]; ?></td>
          <td><?= $r["nama_obat"]; ?></td>
          <td><?= $r["jumlah_penjualan"]; ?></td>
        </tr>
        <?php   
        }
        ?>
	</table>
	<script>
		window.print();
	</script>
 
</body>
</html>