<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('sensor_model');
    }

    public function index()
    {
        $this->load->view('welcome_message');
    }

    public function sensor_add_random()
    {
        $sensor = $this->sensor_model->insert_sensor_random();
        $sensor = json_encode($sensor);
        echo $sensor;
    }

    public function sensor_add_random_x($number)
    {
        $sensor = $this->sensor_model->insert_sensor_random_x($number);
        $sensor = json_encode($sensor);
        echo $sensor;
    }

    public function sensor_get_last()
    {
        $sensor = $this->sensor_model->get_sensor_last();
        $sensor = json_encode($sensor);
        echo $sensor;
    }

    public function sensor_get_last_three()
    {
        $sensor = $this->sensor_model->get_sensor_last_three();
        $sensor = json_encode($sensor);
        echo $sensor;
    }

    public function sensor_get_range($db, $start_date, $end_date)
    {
        $sensors = $this->sensor_model->get_sensor_range($db, $start_date, $end_date);
        $sensors = json_encode($sensors);
        echo $sensors;
    }

    public function sensor_get_today()
    {
        $sensors = $this->sensor_model->get_sensor_today();
        $sensors = json_encode($sensors);
        echo $sensors;
    }
}
