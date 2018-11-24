<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{

    public function __construct() {
        parent::__construct();
        $this->load->model('permission_map_model');
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

    function login($params) {
        $result = $this->db->where('email', $params['email'])
            ->where('password', 'sha1("'.$params['password'].'")', false)
            ->limit(1)
            ->get('users');

        if($result->num_rows() > 0) {
            $user = $result->result_array()[0];
            return $user;
        } else {
            return false;
        }
    }

    function get_permissions($permission_group_id) {
        $this->load->model('Permission_map_model');
        $permissions = $this->permission_map_model->get_all_permission_map($permission_group_id);
        return $permissions;
    }

}