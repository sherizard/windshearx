<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Judul_model extends CI_Model {

    public $judul;

    public function __construct()
    {
        $this->load->database();
        $this->load->helper('security');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function get_judul()
    {
        $query = $this->db->get_where('judul', array('id' => 1));
        return $query->row();
    }

    public function update_judul()
    {
        $this->judul = $this->input->post('judul');

        $this->db->update(
            'judul',
            array('judul' => $this->judul),
            array('id' => 1)
        );
    }
}
