<?php

/*
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
require_once __DIR__.'/Auth_Controller.php';

class Condition extends Auth_Controller
{
    function __construct() {
        parent::__construct();
        $this->load->model('Condition_model');
    }

    /*
     * Listing of conditions
     */
    function index() {
        $data['conditions'] = $this->Condition_model->get_all_conditions();

        $data['_view'] = 'condition/index';
        $this->load->view('layouts/main', $data);
    }

    /*
     * Adding a new condition
     */
    function add() {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('name', 'Name', 'is_unique[conditions.name]|max_length[45]');

        if ($this->form_validation->run()) {
            $params = array(
                'name' => $this->input->post('name'),
            );

            $condition_id = $this->Condition_model->add_condition($params);
            redirect('condition/index');
        } else {
            $data['_view'] = 'condition/add';
            $this->load->view('layouts/main', $data);
        }
    }

    /*
     * Editing a condition
     */
    function edit($id) {
        // check if the condition exists before trying to edit it
        $data['condition'] = $this->Condition_model->get_condition($id);

        if (isset($data['condition']['id'])) {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('name', 'Name', 'is_unique[name]|max_length[45]');

            if ($this->form_validation->run()) {
                $params = array(
                    'name' => $this->input->post('name'),
                );

                $this->Condition_model->update_condition($id, $params);
                redirect('condition/index');
            } else {
                $data['_view'] = 'condition/edit';
                $this->load->view('layouts/main', $data);
            }
        } else
            show_error('The condition you are trying to edit does not exist.');
    }

    /*
     * Deleting condition
     */
    function remove($id) {
        $condition = $this->Condition_model->get_condition($id);

        // check if the condition exists before trying to delete it
        if (isset($condition['id'])) {
            $this->Condition_model->delete_condition($id);
            redirect('condition/index');
        } else
            show_error('The condition you are trying to delete does not exist.');
    }

}
