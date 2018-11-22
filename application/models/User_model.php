<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{

    public function __construct() {
        parent::__construct();
        // Your own constructor code
    }

    protected function generateSalt() {
        $salt = "xiORG17N6ayoEn6X3";
        return $salt;
    }

    protected function generateVerificationKey() {
        $length = 10;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function updateGroups($postData = null, $action = null) {
        if ($action == "add") {
            $error = 0;
            if (!isset($postData["name"]) || empty($postData["name"])) {
                $error = 2;
            } else {
                $name = $this->db->escape(strip_tags($postData["name"]));
            }
            if ($error == 2) {
                return $error;
            }
            $sql = "SELECT * FROM permission_groups WHERE name = " . $name;
            $query = $this->db->query($sql);
            if ($query->num_rows() > 0) {
                return 3;
            } else {
                $sql2 = "INSERT INTO permission_groups (name) VALUES (" . $name . ")";
                $this->db->query($sql2);
                return TRUE;
            }
        }
        if ($action == "edit") {
            $error = 0;
            if (!isset($postData["name"]) || empty($postData["name"])) {
                $error = 2;
            } else {
                $name = $this->db->escape(strip_tags($postData["name"]));
            }
            if (!isset($postData["id"]) || empty($postData["id"])) {
                $error = 3;
            } else {
                $id = $this->db->escape(strip_tags($postData["id"]));
            }
            if ($error == 2) {
                return $error;
            }
            $sql = "SELECT * FROM permission_groups WHERE name = " . $name;
            $query = $this->db->query($sql);
            if ($query->num_rows() > 0) {
                return 4;
            } else {
                $sql2 = "UPDATE permission_groups SET name = " . $name . " WHERE id = " . $id;
                $this->db->query($sql2);
                return TRUE;
            }
        }
        if ($action == "delete") {
            $admin_group = $this->db->escape(strip_tags((int)$postData["id"]));
            $sql = "SELECT * FROM users WHERE admin_group = " . $admin_group;
            $query = $this->db->query($sql);
            if ($query->num_rows() > 0) {
                return FALSE;
            } else {
                $sql2 = "DELETE FROM permission_groups WHERE id = " . $admin_group;
                $this->db->query($sql2);
                return TRUE;
            }
        }
    }

    public function getAdminGroups($additional = "") {
        if ($additional !== "") {
            $additional = "WHERE id = " . $this->db->escape($additional);
        }
        $sql = "SELECT * FROM permission_groups " . $additional;
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function getAdminInfo($adminid = null) {
        $sql = "SELECT * FROM users WHERE id = " . $this->db->escape(strip_tags((int)$adminid));
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return array();
        }
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

    public function adminLogin($postData) {
        if (!isset($postData["username"])) {
            return 2;
        }
        if (!isset($postData["password"])) {
            return 2;
        }
        $salt = $this->generateSalt();
        $username = $this->db->escape(strip_tags($postData["username"]));
        $password = $this->db->escape(strip_tags(md5($salt . $postData["password"])));
        $sql = "SELECT * FROM users WHERE username = " . $username . " AND password = " . $password;
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $q = $query->row();
            $this->session->set_userdata("username", $q->username);
            $this->session->set_userdata("verification_key", $q->verification_key);
            $this->session->set_userdata("admin_id", $q->id);
            $this->session->set_userdata("loggedin", 1);
            $ip = $this->getUserIP();
            $sql2 = "UPDATE users SET last_signin = NOW(), ip = " . $this->db->escape($ip) . " WHERE id = " . $q->id;
            $this->db->query($sql2);
            return TRUE;
        } else {
            return 2;
        }
    }

    public function verifyUser() {
        if ($this->session->userdata("username") && $this->session->userdata("verification_key") && $this->session->userdata("admin_id") && $this->session->userdata("loggedin")) {
            $sql = "SELECT * FROM users WHERE id = " . $this->db->escape(strip_tags((int)$this->session->userdata("admin_id"))) . " AND verification_key = " . $this->db->escape(strip_tags($this->session->userdata("verification_key"))) . " AND username = " . $this->db->escape(strip_tags($this->session->userdata("username")));
            $query = $this->db->query($sql);
            if ($query->num_rows() > 0) {
                return TRUE;
            } else {
                $this->logout();
                redirect(base_url() . "login", 'auto');
            }
        } else {
            $this->logout();
            redirect(base_url() . "login", 'auto');
        }
    }

    public function logout() {
        $this->session->unset_userdata("username");
        $this->session->unset_userdata("verification_key");
        $this->session->unset_userdata("admin_id");
        $this->session->unset_userdata("loggedin");
        return TRUE;
    }

}