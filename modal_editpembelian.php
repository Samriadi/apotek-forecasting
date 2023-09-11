<?php
include 'fungsi.php';

$id = $_GET['id'];
$row = mysqli_query($conn, "SELECT * from data_pembelian WHERE id_pembelian='$id'");
$data = mysqli_fetch_assoc($row);

?>
<div class="modal-body">
<input type="text" name="id_pembelian" id="id_pembelian" value="<?= $id; ?>" hidden>
<div class="form-group">
    <label for="tanggal_pembelian">Tanggal Penjualan</label>
    <input type="date" class="form-control" id="tanggal_pembelian" name="tanggal_pembelian" value="<?= $data['tanggal_pembelian']; ?>" disabled>
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
    <label for="jumlah_pembelian">Jumlah Penjualan</label>
    <input type="number" class="form-control" id="jumlah_pembelian" name="jumlah_pembelian" value="<?= $data['jumlah_pembelian']; ?>" required>
</div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit" name="edit" class="btn btn-success">Save</button>
</div>