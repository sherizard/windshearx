<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Generatorx extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('sensor_model');
        $this->load->helper('url');
    }

    public function index()
    {
        $this->load->view('generator/index');
    }
}
