<?php

/*
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
require_once __DIR__.'/Auth_Controller.php';

class Brand extends Auth_Controller
{
    function __construct() {
        parent::__construct();
        $this->load->model('Brand_model');
    }

    /*
     * Listing of brands
     */
    function index() {
        $data['brands'] = $this->Brand_model->get_all_brands();

        $data['_view'] = 'brand/index';
        $this->load->view('layouts/main', $data);
    }

    /*
     * Adding a new brand
     */
    function add() {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('name', 'Name', 'required|is_unique[brands.name]|alpha_numeric');

        if ($this->form_validation->run()) {
            $params = array(
                'name' => $this->input->post('name'),
            );

            $brand_id = $this->Brand_model->add_brand($params);
            redirect('brand/index');
        } else {
            $data['_view'] = 'brand/add';
            $this->load->view('layouts/main', $data);
        }
    }

    /*
     * Editing a brand
     */
    function edit($id) {
        // check if the brand exists before trying to edit it
        $data['brand'] = $this->Brand_model->get_brand($id);

        if (isset($data['brand']['id'])) {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('name', 'Name', 'required|callback_check_name|alpha_numeric');

            if ($this->form_validation->run()) {
                $params = array(
                    'name' => $this->input->post('name'),
                );

                $this->Brand_model->update_brand($id, $params);
                redirect('brand/index');
            } else {
                $data['_view'] = 'brand/edit';
                $this->load->view('layouts/main', $data);
            }
        } else
            show_error('The brand you are trying to edit does not exist.');
    }

    /*
     * Deleting brand
     */
    function remove($id) {
        $brand = $this->Brand_model->get_brand($id);

        // check if the brand exists before trying to delete it
        if (isset($brand['id'])) {
            $this->Brand_model->delete_brand($id);
            redirect('brand/index');
        } else
            show_error('The brand you are trying to delete does not exist.');
    }

    /**
     * @param string $id
     * @param $name
     * @return bool
     */
    function check_name($id = '', $name) {
        $this->db->where('name', $name);
        if ($id) {
            $this->db->where_not_in('id', $id);
        }
        return count($this->db->get('brands')->num_rows()) > 0 ? true : false;
    }

}
