<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
    }

    public function index()
    {
        $this->load->view('menu/login');
    }

    public function list()
    {
        $data = array(
            'users' => 'asdas',
            'content' => 'user/user_list'
        );
        $this->load->view('index', $data);
    }

    public function proses_login()
    {
        // header('Content-Type: application/json');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $url = 'http://localhost/fullstackdev/api/user/login';

        $data = array(
            'username' => $username,
            'password' => $password,
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        // curl_setopt($ch, CURLOPT_USERPWD, "sipado:sipado");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data); // untuk mengirim data
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
            $this->session->set_userdata('nama', $body->nama);
            $this->session->set_userdata('email', $body->email);
            $this->session->set_userdata('jk', $body->jk);
            $this->session->set_userdata('role', $body->role);
            $this->session->set_userdata('username', $body->username);
            redirect('main');
        } else {
            $this->session->set_flashdata('info', 'Username atau Password Salah');
            redirect('login');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('nama');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('jk');
        $this->session->unset_userdata('role');
        $this->session->unset_userdata('username');
        redirect('login');
    }
}
