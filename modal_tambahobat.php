<div class="modal-body">
    <div class="form-group">
        <label for="nama_obat">Nama Obat</label>
        <input type="text" class="form-control" id="nama_obat" name="nama_obat" required>
    </div>
    <div class="form-group">
        <label for="stock">Stok</label>
        <input type="number" class="form-control" id="stock" name="stock" required>
    </div>
    <div class="form-group">
        <label for="satuan">Satuan</label>
        <select class="form-control" id="satuan" name="satuan" required>
            <option value="" selected disabled hidden>Choose here</option>
            <option value="Strip">Strip</option>
            <option value="Box">Box</option>
        </select>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit" name="tambah" class="btn btn-success">Tambah</button>
</div>