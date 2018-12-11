<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
require_once __DIR__ . '/Auth_Controller.php';

class Accessory extends Auth_Controller
{
    function __construct() {
        parent::__construct();
        $this->load->model('Accessory_model');
        $this->load->model('Option_model');
    }

    /*
     * Listing of accessories
     */
    function index() {
        $data['accessories'] = $this->Accessory_model->get_all_accessories();

        $data['_view'] = 'accessory/index';
        $this->load->view('layouts/main', $data);
    }

    /*
     * Adding a new accessory
     */
    function add() {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('name', 'Name', 'alpha_dash');

        if ($this->form_validation->run()) {

            $options = $this->input->post('option_id');

            if(count($options) > 0) {
                foreach($options as $option_id) {
                    $params = array(
                        'option_id' => $option_id,
                        'name' => $this->input->post('name'),
                    );
                    $accessory_id = $this->Accessory_model->add_accessory($params);
                }
            } else {
                $params = array(
                    'category_id' => $this->input->post('category_id'),
                    'name' => $this->input->post('name'),
                );
                $accessory_id = $this->Accessory_model->add_accessory($params);
            }
            redirect('accessory/index');

        } else {
            $this->load->model('Category_model');
            $data['all_categories'] = $this->Category_model->get_all_categories();
            $data['options'] = $this->Option_model->get_all_options();

            $data['_view'] = 'accessory/add';
            $this->load->view('layouts/main', $data);
        }
    }

    /*
     * Deleting accessory
     */
    function remove($id) {
        $accessory = $this->Accessory_model->get_accessory($id);

        // check if the accessory exists before trying to delete it
        if (isset($accessory['id'])) {
            $this->Accessory_model->delete_accessory($id);
            redirect('accessory/index');
        } else
            show_error('The accessory you are trying to delete does not exist.');
    }

}
