<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public $username;
    public $password;
    public $role;

    public function __construct()
    {
        $this->load->database();
        $this->load->helper('security');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function get_users()
    {
        $query = $this->db->get('user');
        return $query->result();
    }

    public function get_user($username, $password)
    {
        $query = $this->db->get_where('user', array(
            'username' => $username,
            'password' => $password
        ));
        return $query->row();
    }

    public function insert_user($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
        $this->role = 0;

        return $this->db->insert(
            'user', array(
                'username' => $this->username,
                'password' => $this->password,
                'role' => $this->role
            )
        );
    }

    public function update_user($id, $password)
    {    
        $this->db->update(
            'user',
            array('password' => $password),
            array('id' => $id)
        );
    }

    public function delete_user($id)
    {
        $this->db->delete('user', array('id' => $id));
    }
}
