<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">List Barang <a href="<?= base_url('barang/tambah') ?>"><button class="btn btn-primary">Tambah</button></a></h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Stok</th>
                        <th>Harga</th>
                        <th style="width: 150px;">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($barang as $row) {
                        echo "<tr>";
                        echo "<td>" . $row->nama . "</td>";
                        echo "<td>" . $row->stok . "</td>";
                        echo "<td>" . $row->harga . "</td>";
                        echo "<td>";
                        echo "<a href='" . base_url('barang/edit/') . "$row->id_barang'><button type='button' class='btn btn-warning'>Edit</button></a> ";
                        echo "<a href='" . base_url('barang/proses_hapus/') . "$row->id_barang'><button type='button' class='btn btn-danger'>Hapus</button></a> ";
                        echo "</td>";
                        echo "</tr>";
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>