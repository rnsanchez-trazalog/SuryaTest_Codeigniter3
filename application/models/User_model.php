<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_count() {
        return $this->db->count_all('usuarios');
    }

    public function get_users($limit, $start) {
        $this->db->limit($limit, $start);
        $query = $this->db->get('usuarios');
        return $query->result();
    }

    public function get_all_users() {
        $query = $this->db->get('usuarios');
        return $query->result();
    }

    public function insert_user($data) {
        return $this->db->insert('usuarios', $data);
    }

    public function get_user_by_id($id) {
        $query = $this->db->get_where('usuarios', array('ID' => $id));
        return $query->row();
    }

    public function update_user($id, $data) {
        $this->db->where('ID', $id);
        return $this->db->update('usuarios', $data);
    }

    public function delete_user($id) {
        $this->db->where('ID', $id);
        return $this->db->delete('usuarios');
    }
}