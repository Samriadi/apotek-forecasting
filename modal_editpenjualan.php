<?php
include 'fungsi.php';

$id = $_GET['id'];
$row = mysqli_query($conn, "SELECT * from data_penjualan WHERE id_penjualan='$id'");
$data = mysqli_fetch_assoc($row);

?>
<div class="modal-body">
<input type="text" name="id_penjualan" id="id_penjualan" value="<?= $id; ?>" hidden>
<div class="form-group">
    <label for="tanggal_penjualan">Tanggal Penjualan</label>
    <input type="date" class="form-control" id="tanggal_penjualan" name="tanggal_penjualan" value="<?= $data['tanggal_penjualan']; ?>" disabled>
</div>

<?php 
$row2=tampil('data_obat');
?>

<div class="form-group">
    <label for="nama_obat">Nama Obat</label>
    <select class="form-control" id="nama_obat" name="nama_obat" disabled>
        <option value="<?= $data['nama_obat'];?>"><?= $data['nama_obat'];?></option>
        <?php while($data2= mysqli_fetch_assoc($row2)): ?>
        <option value="<?= $data2['nama_obat'];?>"><?= $data2['nama_obat'];?></option>
        <?php endwhile; ?>
    </select>
</div>

<div class="form-group">
    <label for="jumlah_penjualan">Jumlah Penjualan</label>
    <input type="number" class="form-control" id="jumlah_penjualan" name="jumlah_penjualan" value="<?= $data['jumlah_penjualan']; ?>" required>
</div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit" name="edit" class="btn btn-success">Save</button>
</div>