<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('username')) {
            redirect('login');
        }
        date_default_timezone_set("Asia/Jakarta");
    }

    public function index()
    {
        echo 'Current PHP version: ' . phpversion();
    }

    public function list_barang()
    {
        $url = base_url('api/barang/list');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $data); // untuk mengirim data
        $output = curl_exec($ch);

        $info = curl_getinfo($ch);

        curl_close($ch);

        $response = [
            'headers' => substr($output, 0, $info["header_size"]),
            'body' => substr($output, $info["header_size"]),
        ];
        $body = json_decode($response['body']);
        // print_r($body);

        if ($body->respon == 1) {
            $data = array(
                'content' => 'barang/barang_list',
                'barang' => $body->data,
            );
            $this->load->view('index', $data);
        } else {
            $this->session->set_flashdata('gagal', 'Gagal !');
            redirect('main');
        }
    }

    public function edit($id)
    {
        $url = base_url('api/barang/get_by_id');

        $datapost = array(
            'id_barang' => $id
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $datapost); // untuk mengirim data
        $output = curl_exec($ch);

        $info = curl_getinfo($ch);

        curl_close($ch);

        $response = [
            'headers' => substr($output, 0, $info["header_size"]),
            'body' => substr($output, $info["header_size"]),
        ];
        $body = json_decode($response['body']);

        if ($body->respon == 1) {
            $data = array(
                'content' => 'barang/barang_edit',
                'barang' => $body->data,
            );

            $this->load->view('index', $data);
        } else {
            $this->session->set_flashdata('gagal', 'Gagal !');
            redirect('main');
        }
    }

    public function proses_edit()
    {
        $url = base_url('api/barang/change');

        $datapost = array(
            'id_barang' => $this->input->post('id_barang'),
            'nama' => $this->input->post('nama'),
            'stok' => $this->input->post('stok'),
            'harga' => $this->input->post('harga'),
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $datapost); // untuk mengirim data
        $output = curl_exec($ch);

        $info = curl_getinfo($ch);

        curl_close($ch);

        $response = [
            'headers' => substr($output, 0, $info["header_size"]),
            'body' => substr($output, $info["header_size"]),
        ];
        $body = json_decode($response['body']);

        if ($body->respon == 1) {
            $this->session->set_flashdata('sukses', 'Berhasil di update !');
        } else {
            $this->session->set_flashdata('gagal', 'Gagal !');
        }
        redirect('barang/list_barang');
    }

    public function tambah()
    {
        $data = array('content' => 'barang/barang_tambah');
        $this->load->view('index', $data);
    }

    public function proses_tambah()
    {
        $url = base_url('api/barang/add');

        $datapost = array(
            'nama' => $this->input->post('nama'),
            'stok' => $this->input->post('stok'),
            'harga' => $this->input->post('harga'),
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $datapost); // untuk mengirim data
        $output = curl_exec($ch);

        $info = curl_getinfo($ch);

        curl_close($ch);

        $response = [
            'headers' => substr($output, 0, $info["header_size"]),
            'body' => substr($output, $info["header_size"]),
        ];
        $body = json_decode($response['body']);

        if ($body->respon == 1) {
            $this->session->set_flashdata('sukses', 'Berhasil di tambah !');
        } else {
            $this->session->set_flashdata('gagal', 'Gagal !');
        }
        redirect('barang/list_barang');
    }

    public function proses_hapus($id)
    {
        $url = base_url('api/barang/delete');

        $datapost = array(
            'id_barang' => $id,
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $datapost); // untuk mengirim data
        $output = curl_exec($ch);

        $info = curl_getinfo($ch);

        curl_close($ch);

        $response = [
            'headers' => substr($output, 0, $info["header_size"]),
            'body' => substr($output, $info["header_size"]),
        ];
        $body = json_decode($response['body']);

        if ($body->respon == 1) {
            $this->session->set_flashdata('sukses', 'Berhasil di hapus !');
        } else {
            $this->session->set_flashdata('gagal', 'Gagal !');
        }
        redirect('barang/list_barang');
    }
}
