<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function index() {
        $data["error"] = '';
        if ($this->input->post()) {
            $this->session->set_userdata("loginattempts", 0);
            $postData = $this->input->post();
            $user = $this->User_model->login($postData);
            if ($user) {
                $this->session->set_userdata('user_id', $user['id']);

                $user = $this->User_model->get_user($user['id']);
                $this->session->set_userdata('permission_group_id', $user['permission_group']);
                $this->session->set_userdata('role', $user['role']);
                $this->session->set_userdata('name', $user['name']);
                redirect(base_url('product'));
            } else {
                $data['error'] = 'Invalid login';
                $this->load->view('login', $data);
            }
        } else {
            $this->load->view('login', $data);
        }
    }
}
