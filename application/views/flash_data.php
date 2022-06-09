<?php
if ($this->session->flashdata('sukses')) { ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Sukses!</strong> <?= $this->session->flashdata('sukses') ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php
} else if ($this->session->flashdata('gagal')) { ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Gagal !</strong> <?= $this->session->flashdata('gagal') ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php } ?>