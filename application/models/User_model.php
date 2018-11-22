<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{

    public function __construct() {
        parent::__construct();
        // Your own constructor code
    }

    public function get_all_users() {
        $sql = "SELECT u.id, u.email, u.address, pg.name as 'role', u.name 
                FROM users u
                LEFT JOIN permission_groups pg ON u.permission_group = pg.id";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function get_user($user_id) {
        $sql = sprintf("SELECT u.id, u.email, u.address, u.permission_group, pg.name as 'role', u.name
                FROM users u
                LEFT JOIN permission_groups pg ON u.permission_group = pg.id
                WHERE u.id = %d", $user_id);
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array()[0];
        } else {
            return array();
        }
    }

    public function update_user($id, $params) {
        $this->db->where('id', $id);
        return $this->db->update('users', $params);
    }

    function add_user($params) {
        $this->db->insert('users', $params);
        return $this->db->insert_id();
    }

    function delete_user($id) {
        return $this->db->delete('users', array('id' => $id));
    }

}