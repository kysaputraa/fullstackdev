<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
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
        $data = array(
            'content' => 'menu/main'
        );
        $this->load->view('index', $data);
    }
}
