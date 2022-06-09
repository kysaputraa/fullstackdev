<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit Barang</h6>
    </div>
    <div class="card-body">
        <form action="<?= base_url('barang/proses_tambah') ?>" method="post" enctype="multipart/form-data">
            <div>
                <label>Nama Barang</label>
                <input type="text" class="form-control" name="nama">
            </div>
            <div>
                <label>Stok</label>
                <input type="number" class="form-control" name="stok">
            </div>
            <div>
                <label>Harga</label>
                <input type="number" class="form-control" name="harga">
            </div>
            <div>
                <button class="mt-3 btn btn-primary col-md-12">Tambah</button>
            </div>
        </form>
    </div>
</div>