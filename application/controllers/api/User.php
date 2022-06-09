<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_user');
        date_default_timezone_set("Asia/Jakarta");
    }

    public function list()
    {
        header("content-type:application/json");
        $datauser = $this->model_user->get_all();
        if ($datauser) {
            $data = array(
                'respon' => 1,
                'pesan' => 'Berhasil !',
                'data' => $datauser->result_array(),
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

    public function login()
    {
        header("content-type:application/json");
        if ($this->input->post('username') == null) {
            $data = array(
                'respon' => 0,
                'pesan' => 'Harap Masukkan Username',
            );
            echo json_encode($data);
        } else if ($this->input->post('password') == null) {
            $data = array(
                'respon' => 0,
                'pesan' => 'Harap Masukkan Password',
            );
            echo json_encode($data);
        } else {
            $username = $this->input->post('username');
            $password = md5($this->input->post('password'));
            $proseslogin = $this->model_user->proses_login($username, $password)->row();
            if ($proseslogin) {
                $data = array(
                    'respon' => 1,
                    'username' => $proseslogin->username,
                    'role' => $proseslogin->role,
                    'nama' => $proseslogin->nama,
                    'email' => $proseslogin->email,
                    'jk' => $proseslogin->jk,
                    'pesan' => 'Login Berhasil !',
                );
                echo json_encode($data);
            } else {
                $data = array(
                    'respon' => 0,
                    'pesan' => 'username atau password salah',
                );
                echo json_encode($data);
            }
        }
    }

    public function register()
    {
        header("content-type:application/json");

        if (
            $this->input->post('username') == null ||
            $this->input->post('nama') == null ||
            $this->input->post('email') == null ||
            $this->input->post('jk') == null ||
            $this->input->post('password') == null
        ) {
            $data = array(
                'respon' => 0,
                'pesan' => 'Gagal !',
            );
            echo json_encode($data);
        } else {
            $data = array(
                'username' => $this->input->post('username'),
                'password' => md5($this->input->post('password')),
                'nama' => $this->input->post('nama'),
                'email' => $this->input->post('email'),
                'jk' => $this->input->post('email'),
                'role' => 'user',
            );
            $cekusername = $this->model_user->get_by_username($this->input->post('username'))->row();
            if ($cekusername) {
                $data = array(
                    'respon' => 0,
                    'pesan' => 'Username sudah terdaftar !',
                );
                echo json_encode($data);
            } else {
                if ($this->model_user->proses_register($data)) {
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
    }

    public function change()
    {
        header("content-type:application/json");
        if (
            $this->input->post('username') == null ||
            $this->input->post('nama') == null ||
            $this->input->post('email') == null ||
            $this->input->post('jk') == null
        ) {
            $data = array(
                'respon' => 0,
                'pesan' => 'Gagal !',
            );
            echo json_encode($data);
        } else {
            $data = array(
                'nama' => $this->input->post('nama'),
                'email' => $this->input->post('email'),
                'jk' => $this->input->post('jk'),
            );
            if ($this->model_user->proses_ubah_data($this->input->post('username'), $data)) {
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
            $this->input->post('username') == null
        ) {
            $data = array(
                'respon' => 0,
                'pesan' => 'Gagal !',
            );
            echo json_encode($data);
        } else {
            if ($this->model_user->proses_hapus($this->input->post('username')) > 0) {
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
