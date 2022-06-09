<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit Barang</h6>
    </div>
    <div class="card-body">
        <form action="<?= base_url('barang/proses_edit') ?>" method="post" enctype="multipart/form-data">
            <div>
                <label>Nama Barang</label>
                <input type="text" class="form-control" name="nama" value="<?= $barang[0]->nama ?>">
                <input type="hidden" name="id_barang" value="<?= $barang[0]->id_barang ?>">
            </div>
            <div>
                <label>Stok</label>
                <input type="number" class="form-control" name="stok" value="<?= $barang[0]->stok ?>">
            </div>
            <div>
                <label>Harga</label>
                <input type="number" class="form-control" name="harga" value="<?= $barang[0]->harga ?>">
            </div>
            <div>
                <button class="mt-3 btn btn-primary col-md-12">Update Data</button>
            </div>
        </form>
    </div>
</div>