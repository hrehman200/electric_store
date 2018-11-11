<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

	public function index()
	{ 
		if ($this->User_model->verifyUser()) {
			redirect(base_url(), 'auto');
		} 
	}

	public function users($page=null, $user_id=0) {
		if ($this->User_model->verifyUser()) {
			if ($this->input->post()){
				$postData = $this->input->post();
				$this->User_model->updateUsers($postData, $postData["action"]);
			}

			if ($page == "add" || $page == "edit") {
				$data["admin_groups"] = $this->User_model->getAdminGroups();
				if($user_id > 0) {
                    $data["result"] = $this->User_model->getAdminInfo($user_id);
                }
				$this->load->view('header');
				$this->load->view('settings/users_edit', $data);
				$this->load->view('footer');
			} else {
				$data["users"] = $this->User_model->getUsers();
				$this->load->view('header');
				$this->load->view('settings/users', $data);
				$this->load->view('footer');
			} 	
		}
	}

	public function permission_groups($page=null, $groupid=0) {
		if ($this->User_model->verifyUser()) {
			if ($this->input->post()){
				$postData = $this->input->post();
				$this->User_model->updateGroups($postData, $postData["action"]);
			}

			if ($page == 'add' || $page == "edit") {
			    if($groupid > 0) {
                    $data["result"] = $this->User_model->getAdminGroups($groupid);
                }
				$this->load->view('header');
				$this->load->view('settings/permission_groups_edit', $data);
				$this->load->view('footer');
			} else {
				$data["groups"] = $this->User_model->getAdminGroups();
				$this->load->view('header');
				$this->load->view('settings/permission_groups', $data);
				$this->load->view('footer');
			} 
		}
	}
}
