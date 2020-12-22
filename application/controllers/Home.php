<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('judul_model');
        $this->load->model('logo_model');
        $this->load->model('batas_model');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('session');

        // $this->output->set_header('Cache-Control: no-cache, must-revalidate, post-check=0, pre-check=0');
    }

    public function index()
    {
        $data = array();
        $data['title'] = $this->judul_model->get_judul()->judul;
        $data['logos'] = $this->logo_model->get_logos();
        $data['batas'] = $this->batas_model->get_batas()->batas;

        $this->load->view('home/home_header', $data);
        $this->load->view('home/home_nav');
        $this->load->view('home/home_main');
        $this->load->view('modal/modal_login');
        $this->load->view('modal/modal_logout');
        $this->load->view('modal/modal_sensor');
        $this->load->view('modal/modal_grafik');
        $this->load->view('home/home_footer');
    }
}
