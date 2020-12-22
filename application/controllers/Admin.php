<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('judul_model');
        $this->load->model('logo_model');
        $this->load->model('sensor_model');
        $this->load->model('batas_model');
        $this->load->model('user_model');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->helper('security');
        $this->load->library('form_validation');
        $this->load->library('table');
        $this->load->library('session');
        $this->load->library('upload');

        // $this->output->set_header('Cache-Control: no-cache, must-revalidate, post-check=0, pre-check=0');
    }

    public function index()
    {
        $this->session_check();

        $data = array();
        $data['title'] = 'Judul';
        $data['judul'] = $this->judul_model->get_judul()->judul;
        $data['side_active'] = 'judul';

        $this->form_validation->set_error_delimiters('<p class="mb-0">', '</p>');
        $this->form_validation->set_rules('judul', 'Judul', 'required|min_length[8]|max_length[25]',[
          'regex_match' => 'Masukkan 8-30 karakter untuk judul'
        ]);

        if ( ! $this->form_validation->run())
        {
            $this->load->view('admin/admin_header', $data);
            $this->load->view('admin/admin_nav_begin');
            $this->load->view('admin/admin_main_title');
            $this->load->view('modal/modal_logout');
            $this->load->view('admin/admin_nav_end');
            $this->load->view('admin/admin_footer');
        }
        else
        {
            $this->judul_model->update_judul();
            $this->session->set_flashdata('info', 'Berhasil menyimpan judul');
            redirect('admin');
        }
    }

    public function logo()
    {
        $this->session_check();

        $data = array();
        $data['title'] = 'Logo';
        $data['side_active'] = 'logo';
        $data['logos'] = $this->logo_model->get_logos();

        $this->load->view('admin/admin_header', $data);
        $this->load->view('admin/admin_nav_begin');
        $this->load->view('admin/admin_main_logo');
        $this->load->view('modal/modal_logout');
        $this->load->view('admin/admin_nav_end');
        $this->load->view('admin/admin_footer');
    }

    public function logo_add()
    {
        $this->session_check();

        $this->upload->initialize(array(
            'upload_path' => 'assets/img',
            'allowed_types' => 'jpg|jpeg|png',
            'max_size' => '500000',
            'max_width' => '500',
            'max_height' => '500'
        ));

        $data = array();
        $data['title'] = 'Tambah Logo';
        $data['side_active'] = 'logo';
        $data['upload_error'] = '';

        $upload_success = $this->upload->do_upload('image_file');

        if ( ! $upload_success)
        {
            if ($this->input->post('submit'))
            {
                $data['upload_error'] = $this->upload->display_errors('<p class="mb-0">', '</p>');
            }

            $this->load->view('admin/admin_header', $data);
            $this->load->view('admin/admin_nav_begin');
            $this->load->view('admin/admin_main_logo_add');
            $this->load->view('modal/modal_logout');
            $this->load->view('admin/admin_nav_end');
            $this->load->view('admin/admin_footer');
        }
        else
        {
            $this->logo_model->insert_logo();
            $this->session->set_flashdata('info', 'Berhasil menambahkan logo');
            redirect('admin/logo');
        }
    }

    public function logo_edit($id)
    {
        $this->session_check();

        $this->upload->initialize(array(
            'upload_path' => 'assets/img',
            'allowed_types' => 'jpg|jpeg|png',
            'max_size' => '500000',
            'max_width' => '500',
            'max_height' => '500'
        ));

        $data = array();
        $data['title'] = 'Ganti Logo';
        $data['side_active'] = 'logo';
        $data['upload_error'] = '';

        $upload_success = $this->upload->do_upload('image_file');

        if ( ! $upload_success)
        {
            if ($this->input->post('submit'))
            {
                $data['upload_error'] = $this->upload->display_errors('<p class="mb-0">', '</p>');
            }

            $this->load->view('admin/admin_header', $data);
            $this->load->view('admin/admin_nav_begin');
            $this->load->view('admin/admin_main_logo_add');
            $this->load->view('modal/modal_logout');
            $this->load->view('admin/admin_nav_end');
            $this->load->view('admin/admin_footer');
        }
        else
        {
            $this->logo_model->update_logo($id);
            $this->session->set_flashdata('info', 'Berhasil mengganti logo');
            redirect('admin/logo');
        }
    }

    public function logo_delete($id)
    {
        $this->session_check();

        $this->logo_model->delete_logo($id);
        $this->session->set_flashdata('info', 'Berhasil menghapus logo');
        redirect('admin/logo');
    }

    public function batas()
    {
        $this->session_check();

        $data = array();
        $data['title'] = 'Batas';
        $data['side_active'] = 'batas';
        $data['batas'] = $this->batas_model->get_batas()->batas;

        $this->form_validation->set_error_delimiters('<p class="mb-0">', '</p>');
        $this->form_validation->set_rules('batas', 'Batas', 'required');

        if ( ! $this->form_validation->run())
        {
            $this->load->view('admin/admin_header', $data);
            $this->load->view('admin/admin_nav_begin');
            $this->load->view('admin/admin_main_batas');
            $this->load->view('modal/modal_logout');
            $this->load->view('admin/admin_nav_end');
            $this->load->view('admin/admin_footer');
        }
        else
        {
            $this->batas_model->update_batas();
            $this->session->set_flashdata('info', 'Berhasil menyimpan batas');
            redirect('admin/batas');
        }
    }

    public function login()
    {
        $username = $this->input->post('username');
        $password = do_hash($this->input->post('password'));

        $user = $this->user_model->get_user($username, $password);

        if ($user)
        {
            $this->session->set_userdata('username', $username);
            echo base_url('admin');
        }
        else
        {
            echo 0;
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('username');
        redirect('');
    }

    public function user()
    {
        $this->session_check();

        $data = array();
        $data['title'] = 'User';
        $data['side_active'] = 'user';
        $data['users'] = $this->user_model->get_users();

        $this->load->view('admin/admin_header', $data);
        $this->load->view('admin/admin_nav_begin');
        $this->load->view('admin/admin_main_user');
        $this->load->view('modal/modal_logout');
        $this->load->view('admin/admin_nav_end');
        $this->load->view('admin/admin_footer');
    }

    public function user_add()
    {
        $this->session_check();

        $data = array();
        $data['title'] = 'Tambah User';
        $data['side_active'] = 'user';

        $this->form_validation->set_error_delimiters('<p class="mb-0">', '</p>');
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[user.username]|min_length[4]|regex_match[/^(?=.*[0-9])(?=.*[a-zA-Z])([a-zA-Z0-9]+)/s]',[
          'regex_match' => 'Username harus terdiri dari huruf dan angka.'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]|regex_match[/^(?=.*[0-9])(?=.*[a-zA-Z])([a-zA-Z0-9]+)/s]',[
          'regex_match' => 'Password harus terdiri dari huruf dan angka.'
        ]);
        $this->form_validation->set_rules('pass_conf', 'Konfirmasi Password', 'required|matches[password]');
        $this->form_validation->set_message('required', '{field} harus diisi');
        $this->form_validation->set_message('is_unique', '{field} sudah digunakan');
        $this->form_validation->set_message('matches', '{field} tidak sama dengan {param}');

        if (! $this->form_validation->run())
        {
            $this->load->view('admin/admin_header', $data);
            $this->load->view('admin/admin_nav_begin');
            $this->load->view('admin/admin_main_user_add');
            $this->load->view('modal/modal_logout');
            $this->load->view('admin/admin_nav_end');
            $this->load->view('admin/admin_footer');
        }
        else
        {
            $username = $this->input->post('username');
            $password = do_hash($this->input->post('password'));
            $this->user_model->insert_user($username, $password);
            $this->session->set_flashdata('info', 'Berhasil menambah user');
            redirect('admin/user');
        }
    }

    public function user_edit($id)
    {
        $this->session_check();

        $data = array();
        $data['title'] = 'Edit User';
        $data['side_active'] = 'user';

        $this->form_validation->set_error_delimiters('<p class="mb-0">', '</p>');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]|regex_match[/^(?=.*[0-9])(?=.*[a-zA-Z])([a-zA-Z0-9]+)/s]',[
          'regex_match' => 'Password harus terdiri dari huruf dan angka.'
        ]);
        $this->form_validation->set_rules('pass_conf', 'Konfirmasi Password', 'required|matches[password]');
        $this->form_validation->set_message('required', '{field} harus diisi');
        $this->form_validation->set_message('matches', '{field} tidak sama dengan {param}');

        if ( ! $this->form_validation->run())
        {
            $this->load->view('admin/admin_header', $data);
            $this->load->view('admin/admin_nav_begin');
            $this->load->view('admin/admin_main_user_edit');
            $this->load->view('modal/modal_logout');
            $this->load->view('admin/admin_nav_end');
            $this->load->view('admin/admin_footer');
        }
        else
        {
            $password = do_hash($this->input->post('password'));
            $this->user_model->update_user($id, $password);
            $this->session->set_flashdata('info', 'Berhasil mengubah password');
            redirect('admin/user');
        }
    }

    public function user_delete($id)
    {
        $this->session_check();

        $this->user_model->delete_user($id);
        $this->session->set_flashdata('info', 'Berhasil menghapus user');
        redirect('admin/user');
    }

    public function pindah()
    {
        $this->session_check();

        $data = array();
        $data['title'] = 'Pindah Data TRX';
        $data['side_active'] = 'pindah';
        $data['tgl_awal'] = substr($this->sensor_model->get_sensor_first()->timestamp, 0, 10);
        $data['tgl_akhir'] = date('Y-m-d', strtotime('-1 day'));

        $this->form_validation->set_error_delimiters('<p class="mb-0">', '</p>');
        $this->form_validation->set_rules('tgl_awal', 'Tanggal Awal', 'required');
        $this->form_validation->set_rules('tgl_akhir', 'Tanggal Akhir', 'required');
        $this->form_validation->set_message('required', '{field} harus diisi');

        // if ($tgl_awal > $tgl_akhir){
        //   $tgl_awal = $tgl_akhir;
        // }

        if ( ! $this->form_validation->run())
        {
            $this->load->view('admin/admin_header', $data);
            $this->load->view('admin/admin_nav_begin');
            $this->load->view('admin/admin_main_pindah');
            $this->load->view('modal/modal_logout');
            $this->load->view('admin/admin_nav_end');
            $this->load->view('admin/admin_footer');
        }
        else
        {
            $tgl_awal = $this->input->post('tgl_awal');
            $tgl_akhir = $this->input->post('tgl_akhir');
            $date_now = date('Y-m-d');
            $sensors = $this->sensor_model->get_sensor_range(1, $tgl_awal, $tgl_akhir);

            if (! empty($sensors))
            {
                $this->sensor_model->insert_sensor_multi($sensors);
                $this->sensor_model->delete_sensor_multi($sensors);
            }

            $this->session->set_flashdata('info', 'Berhasil memindahkan data TRX');
            redirect('admin/pindah');
        }

    }

    public function histori()
    {
        $this->session_check();

        $data = array();
        $data['title'] = 'Histori';
        $data['side_active'] = 'histori';

        $this->load->view('admin/admin_header', $data);
        $this->load->view('admin/admin_nav_begin');
        $this->load->view('admin/admin_main_histori');
        $this->load->view('modal/modal_logout');
        $this->load->view('admin/admin_nav_end');
        $this->load->view('admin/admin_footer');
    }

    public function session_check()
    {
        if ( ! $this->session->username)
        {
            redirect('');
        }
    }
}
