<div class="modal-body">
    <div class="form-group">
        <label for="tanggal_penjualan">Tanggal Penjualan</label>
        <input type="date" class="form-control" id="tanggal_penjualan" name="tanggal_penjualan" required>
    </div>

<?php 
include 'fungsi.php';
$row=tampil('data_obat');
?>
    <div class="form-group">
        <label for="nama_obat">Nama Obat</label>
        <select class="form-control" id="nama_obat" name="nama_obat" required>
            <option value="" selected disabled hidden>Choose here</option>
            <?php while($data= mysqli_fetch_assoc($row)): ?>
            <option value="<?= $data['nama_obat'];?>"><?= $data['nama_obat'];?></option>
            <?php endwhile; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="jumlah_penjualan">Jumlah Penjualan</label>
        <input type="number" class="form-control" id="jumlah_penjualan" name="jumlah_penjualan" required>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit" name="tambah" class="btn btn-success">Tambah</button>
</div>