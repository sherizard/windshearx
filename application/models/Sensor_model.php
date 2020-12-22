<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sensor_model extends CI_Model {

    public $timestamp;
    public $arah_1;
    public $kecepatan_1;
    // public $arah_2;
    // public $kecepatan_2;
    // public $arah_3;
    // public $kecepatan_3;

    //atau
    // public $timestamp;
    // public $arah;
    // public $kecepatan;

    public function __construct()
    {
        $this->load->database();
        $this->db2 = $this->load->database('windshear_2', TRUE);
        date_default_timezone_set('Asia/Jakarta');
    }

    // public function insert_sensor_random()
    // {
    //     $this->arah_1 = rand(0, 359);
    //     $this->kecepatan_1 = rand(1, 45);
    //     $this->arah_2 = rand(0, 359);
    //     $this->kecepatan_2 = rand(1, 45);
    //     $this->arah_3 = rand(0, 359);
    //     $this->kecepatan_3 = rand(1, 45);
    //
    //
    //   return $this->db->insert(
    //       'sensor',
    //       array(
    //         'arah_1' => $this->arah_1,
    //         'kecepatan_1' => $this->kecepatan_1,
    //         'arah_2' => $this->arah_2,
    //         'kecepatan_2' => $this->kecepatan_2,
    //         'arah_3' => $this->arah_3,
    //         'kecepatan_3' => $this->kecepatan_3
    //       )
    //     );
    // }

    public function insert_sensor_random_x($number)
    {
        $this->arah_1 = rand(0, 359);
        $this->kecepatan_1 = rand(1, 45);

        $sensor = array(
            'sensor' => $number,
            'arah' => $this->arah_1,
            'kecepatan' => $this->kecepatan_1,
        );

        $this->db->insert(
            'sensorr',
            $sensor
        );

        return $sensor;
    }

    public function insert_sensor_multi($sensors)
    {
        // $this->db2->insert_batch('sensor', $sensors);
        $this->db2->insert_batch('sensorr', $sensors);
    }

    public function delete_sensor_multi($sensors)
    {
        $timestamps = array();
        foreach ($sensors as $sensor) {
            array_push($timestamps, $sensor->timestamp);
        }

        $this->db->where_in('timestamp', $timestamps);
        // $this->db->delete('sensor');
        $this->db->delete('sensorr');
    }
//tambah 2 lagi
    public function get_sensor_first()
    {
        // $query = $this->db->get('sensor');
        $query = $this->db->get('sensorr');
        $row = $query->first_row();
        return $row;
    }
//tambah 2 lagi
    public function get_sensor_last()
    {
        $query = $this->db->get('sensorr');
        $row = $query->last_row();
        return $row;
    }

    public function get_sensor_last_three()
    {
        $this->db->order_by('index', 'desc');
        $this->db->limit(3);
        $query = $this->db->get('sensorr');

        return $query->result();
    }

    public function get_sensor_range($db, $start_date, $end_date)
    {
        $end_date_plus = date('Y-m-d', strtotime('+1 day', strtotime($end_date)));

        if ($db == 1)
        {
            // $query = $this->db->get_where('sensor', array(
            $query = $this->db->get_where('sensorr', array(
                'timestamp >=' => $start_date,
                'timestamp <=' => $end_date_plus
            ));
            return $query->result();
        }
        else if ($db == 2)
        {
            // $query = $this->db2->get_where('sensor', array(
            $query = $this->db2->get_where('sensorr', array(
                'timestamp >=' => $start_date,
                'timestamp <=' => $end_date_plus
            ));
            return $query->result();
        }
    }
//tambah 2 lagi
    // public function get_sensor_today()
    // {
    //     // $query = $this->db->get_where('sensor', array(
    //     $query = $this->db->get_where('sensorr', array(
    //         'left(timestamp, 10) =' => date('Y-m-d')
    //     ));
    //     return $query->result();
    // }
    //
    // public function get_data_displayed()
    // {
    //   $query = $this->db->query('SELECT * FROM sensorr');
    //   return $query->num_rows;
    // }
}
