<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('pagination');
    }

    public function index() {
        $config = array();
        $config['base_url'] = site_url('user/index');
        $config['total_rows'] = $this->User_model->get_count();
        $config['per_page'] = 5;
        $config['uri_segment'] = 3;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['users'] = $this->User_model->get_users($config['per_page'], $page);
        $data['links'] = $this->pagination->create_links();

        $this->load->view('testEnvironment', $data);
    }
}