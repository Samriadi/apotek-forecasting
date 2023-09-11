<?php
include 'fungsi.php';

$id = $_GET['id'];
$row = mysqli_query($conn, "SELECT * FROM data_obat WHERE id='$id'");
$data = mysqli_fetch_assoc($row);

?>
<div class="modal-body">
    <input type="text" name="id" id="id" value="<?= $id; ?>" hidden>
    <div class="form-group">
        <label for="nama_obat">Nama Obat</label>
        <input type="text" class="form-control" id="nama_obat" name="nama_obat" value="<?= $data['nama_obat']; ?>" required>
    </div>
    <div class="form-group">
        <label for="stock">Stock</label>
        <input type="number" class="form-control" id="stock" name="stock" value="<?= $data['stock']; ?>" required>
    </div>
    <div class="form-group">
        <label for="satuan">Satuan</label>
        <input type="text" class="form-control" id="satuan" name="satuan" value="<?= $data['satuan']; ?>" required>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit" name="edit" class="btn btn-success">Save</button>
</div>