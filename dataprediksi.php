<?php
session_start();

include 'header.php';

//tambah 
if (isset($_POST['tambah'])) {
  $nama_obat = $_POST['nama_obat'];
  $bulan_awal = $_POST['bulan_awal'];
  $bulan_akhir = $_POST['bulan_akhir'];

  $sql=mysqli_query($conn, "select nama_obat, sum(jumlah_penjualan) as jumlah, month(tanggal_penjualan) as bulan from data_penjualan where nama_obat='$nama_obat' and tanggal_penjualan between '$bulan_awal' and '$bulan_akhir' GROUP BY month(tanggal_penjualan), year(tanggal_penjualan) ORDER BY tanggal_penjualan;");

  $sql2=mysqli_query($conn, "select nama_obat, sum(jumlah_penjualan) as jumlah, month(tanggal_penjualan) as bulan from data_penjualan where nama_obat='$nama_obat' and tanggal_penjualan between '$bulan_awal' and '$bulan_akhir' GROUP BY month(tanggal_penjualan), year(tanggal_penjualan) ORDER BY tanggal_penjualan;");
  $date1 = date_create($bulan_awal); 
  $date2 = date_create($bulan_akhir); 
   
  $interval = date_diff($date1, $date2);
  $row = $interval->m+1;

  //least square
  $x=0;
  $xp2=0;
  $xy=0;
  $ty=0;
  $n=0;
  $convert=0;

  if($row%2==0){
    $convert=2;
    if($row==2){
      $x=-1;
    }
    if($row==4){
      $x=-3;
    }
    if($row==6){
      $x=-5;
    }
    if($row==8){
      $x=-7;
    }
    if($row==10){
      $x=-9;
    }
    if($row==12){
      $x=-11;
    }
  }
  else{
    $convert=1;
    if($row==3){
      $x=-1;
    }
    if($row==5){
      $x=-2;
    }
    if($row==7){
      $x=-3;
    }
    if($row==9){
      $x=-4;
    }
    if($row==11){
      $x=-5;
    }
  }

  $m = 0;
  $dateString = $bulan_awal; // Replace with your date
  $timestamp = strtotime($dateString);
  $month1 = (int) date("n", $timestamp);

  $monthArr = array();

  while($m < $row){
    if($month1<=12){
      $monthArr[$m]=$month1;
    }
    else{
      $month1=1;
      $monthArr[$m]=$month1;
    }
    $month1++;
    $m++;
    
  }
  // var_dump($monthArr);

 
  $mm=array();

  while($data = mysqli_fetch_assoc($sql)){
    $mm[]= (int) $data['bulan'];
  }
  // var_dump($mm);


  $i = 0;
  while ($i < $row) {
    echo "<script>console.log('{$i}' );</script>";
    echo "<script>console.log('x = {$x}' );</script>";


    
    // var_dump($mm[$i]);
    // var_dump($monthArr[$i]);

    if($mm[$i]==$monthArr[$i]){

      $data2 = mysqli_fetch_assoc($sql2);
      $y=$data2['jumlah'];
    }
    else{
      $y=0;
    }
    echo "<script>console.log('y = {$y}' );</script>";

    $ty=$ty+$y;
    $xp2=$x*$x;
    $txp2=$txp2+$xp2;
    $xy=$x*$y;
 
    $n++;
    $x=$x+$convert;
    $txy=$txy+$xy;
 
    echo "<script>console.log('Jumlah data = {$row}' );</script>";
    echo "<script>console.log('Total y = {$ty}' );</script>";
    echo "<script>console.log('Jumlah n = {$n}' );</script>";
    echo "<script>console.log('Total xy = {$txy}' );</script>";
    echo "<script>console.log('Total x2 = {$txp2}' );</script>";
    $i++;
  }
 
  $a=$ty/$n;
  $b=$txy/$txp2;
  $prediksi = $a+($b*$x);

  if($prediksi<0){
    $prediksi=0;
  }

  echo "<script>console.log('a = {$a}' );</script>";
  echo "<script>console.log('b = {$b}' );</script>";
  echo "<script>console.log('x = {$x}' );</script>";
  echo "<script>console.log('Hasil prediksi = {$prediksi}' );</script>";

  //end least square

  $query = "('','$nama_obat','$bulan_awal', '$bulan_akhir', '$prediksi')";
  if (tambah("data_prediksi", $query) == 1) {
    echo "<script>
            alert('data berhasil ditambahkan');
            document.location.href ='dataprediksi.php';
        </script>";
  } else {
    echo "<script>
            alert('data gagal ditambahkan');
            document.location.href ='dataprediksi.php';
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
?>
<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <?php if(isset($_SESSION['login'])):?>
  <a href="" class="btn btn-primary btn-md mb-3" onclick="tambah()" data-toggle="modal" data-target="#exampleModalCenter">Tambah Prediksi</a>
  <?php endif;?>
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h3 class="m-0 font-weight-bold text-primary">
        Data Prediksi Obat
      </h3>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead class="thead-light">
            <tr>
              <th>No</th>
              <th>Nama Obat</th>
              <th>Bulan Awal</th>
              <th>Bulan Akhir</th>
              <th>Prediksi Bulan Berikutnya</th>
              <?php if(isset($_SESSION['login'])):?>
              <th>Action</th>
              <?php endif;?>

            </tr>
          </thead>
          <tbody>
            <?php $no = 1;
            $row = mysqli_query($conn, "SELECT * FROM data_prediksi ORDER BY id_prediksi DESC" );
            while ($data = mysqli_fetch_assoc($row)) :
              $obat = $data["nama_obat"];

            ?>
              <tr >
                <td><?= $no; ?></td>
                <td><?= $data["nama_obat"]; ?></td>
                <td><?= tanggal_indo($data["bulan_awal"]);?></td>
                <td><?= tanggal_indo($data["bulan_akhir"]);?></td>
                <td><?= $data["hasil_prediksi"]; ?> - Penjualan</td>
                <?php if(isset($_SESSION['login'])):?>
                <td>
                <a class="btn btn-danger" href="hapusprediksi.php?id=<?= $data["id_prediksi"]; ?>" onclick="return confirm('yakin ingin hapus data?')">hapus</a></td>
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
        <h5 class="modal-title" id="exampleModalLongTitle">Prediksi</h5>
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

    xhr.open('GET', 'modal_tambahprediksi.php', true);
    xhr.send();
  }
  document.getElementById("dataprediksi").className = "nav-item active";
</script>