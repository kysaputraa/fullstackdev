<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_barang');
        date_default_timezone_set("Asia/Jakarta");
    }

    public function list()
    {
        header("content-type:application/json");
        $databarang = $this->model_barang->get_all();
        if ($databarang) {
            $data = array(
                'respon' => 1,
                'pesan' => 'Berhasil !',
                'data' => $databarang->result_array(),
            );
            echo json_encode($data);
        } else {
            $data = array(
                'respon' => 0,
                'pesan' => 'Gagal !',
            );
            echo json_encode($data);
        }
    }

    public function get_by_id()
    {
        header("content-type:application/json");
        if (
            $this->input->post('id_barang') == null
        ) {
            $data = array(
                'respon' => 0,
                'pesan' => 'Gagal !',
            );
            echo json_encode($data);
        } else {
            $data = $this->model_barang->get_by_id_barang($this->input->post('id_barang'));
            if ($data->num_rows() > 0) {
                $data = array(
                    'respon' => 1,
                    'pesan' => 'Berhasil !',
                    'data' => $data->result_array(),
                );
                echo json_encode($data);
            } else if ($data->num_rows() == 0) {
                $data = array(
                    'respon' => 0,
                    'pesan' => 'Data Kosong !',
                );
                echo json_encode($data);
            } else {
                $data = array(
                    'respon' => 0,
                    'pesan' => 'Gagal !',
                );
                echo json_encode($data);
            }
        }
    }

    public function add()
    {
        header("content-type:application/json");
        if (
            $this->input->post('nama') == null ||
            $this->input->post('harga') == null ||
            $this->input->post('stok') == null
        ) {
            $data = array(
                'respon' => 0,
                'pesan' => 'Gagal !',
            );
            echo json_encode($data);
        } else {
            $data = array(
                'nama' => $this->input->post('nama'),
                'harga' => $this->input->post('harga'),
                'stok' => $this->input->post('stok'),
            );
            if ($this->model_barang->proses_tambah($data)) {
                $data = array(
                    'respon' => 1,
                    'pesan' => 'Berhasil di Tambahkan !',
                );
                echo json_encode($data);
            } else {
                $data = array(
                    'respon' => 0,
                    'pesan' => 'Gagal !',
                );
                echo json_encode($data);
            }
        }
    }

    public function change()
    {
        header("content-type:application/json");
        if (
            $this->input->post('nama') == null ||
            $this->input->post('harga') == null ||
            $this->input->post('stok') == null
        ) {
            $data = array(
                'respon' => 0,
                'pesan' => 'Gagal !',
            );
            echo json_encode($data);
        } else {
            $data = array(
                'nama' => $this->input->post('nama'),
                'harga' => $this->input->post('harga'),
                'stok' => $this->input->post('stok'),
            );
            $prosubah = $this->model_barang->proses_ubah_data($this->input->post('id_barang'), $data);
            if ($prosubah > 0) {
                $data = array(
                    'respon' => 1,
                    'pesan' => 'Berhasil di Ubah !',
                );
                echo json_encode($data);
            } else {
                $data = array(
                    'respon' => 0,
                    'pesan' => 'Gagal !',
                );
                echo json_encode($data);
            }
        }
    }

    public function delete()
    {
        header("content-type:application/json");
        if (
            $this->input->post('id_barang') == null
        ) {
            $data = array(
                'respon' => 0,
                'pesan' => 'Gagal !',
            );
            echo json_encode($data);
        } else {
            if ($this->model_barang->proses_hapus($this->input->post('id_barang')) > 0) {
                $data = array(
                    'respon' => 1,
                    'pesan' => 'Berhasil di hapus !',
                );
                echo json_encode($data);
            } else {
                $data = array(
                    'respon' => 0,
                    'pesan' => 'Gagal !',
                );
                echo json_encode($data);
            }
        }
    }
}
