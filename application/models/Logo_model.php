<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logo_model extends CI_Model {

    public $file;

    public function __construct()
    {
        $this->load->database();
    }

    public function get_logo($id)
    {
        $query = $this->db->get_where('logo', array('id' => $id));
        return $query->row();
    }

    public function get_logos()
    {
        $query = $this->db->get('logo');
        return $query->result();
    }

    public function insert_logo()
    {
        $this->file = $this->upload->data('file_name');

        return $this->db->insert(
            'logo', array('file' => $this->file)
        );
    }

    public function update_logo($id)
    {
        if ($this->upload->data('file_name'))
        {
            $this->file = $this->upload->data('file_name');

            $this->db->update(
                'logo',
                array('file' => $this->file),
                array('id' => $id)
            );
        }
    }

    public function delete_logo($id)
    {
        $filename = $this->get_logo($id)->file;
        unlink(getcwd() . '/assets/img/' . $filename);
        $this->db->delete('logo', array('id' => $id));
    }
}
