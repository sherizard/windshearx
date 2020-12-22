<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Batas_model extends CI_Model {

    public $batas;

    public function __construct()
    {
        $this->load->database();
        $this->load->helper('security');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function get_batas()
    {
        $query = $this->db->get_where('batas', array('id' => 1));
        return $query->row();
    }

    public function update_batas()
    {
        $this->batas = $this->input->post('batas');

        $this->db->update(
            'batas',
            array('batas' => $this->batas),
            array('id' => 1)
        );
    }
}
