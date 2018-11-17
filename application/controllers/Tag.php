<?php

/*
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */

class Tag extends CI_Controller
{
    function __construct() {
        parent::__construct();
        $this->load->model('Tag_model');
    }

    /*
     * Listing of tags
     */
    function index() {
        $data['tags'] = $this->Tag_model->get_all_tags();

        $data['_view'] = 'tag/index';
        $this->load->view('layouts/main', $data);
    }

    /*
     * Adding a new tag
     */
    function add() {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('name', 'Name', 'required|max_length[50]');

        if ($this->form_validation->run()) {
            $params = array(
                'category_id' => $this->input->post('category_id'),
                'name' => $this->input->post('name'),
            );

            $tag_id = $this->Tag_model->add_tag($params);
            redirect('tag/index');
        } else {
            $this->load->model('Category_model');
            $data['all_categories'] = $this->Category_model->get_categories_dropdown_html();

            $data['_view'] = 'tag/add';
            $this->load->view('layouts/main', $data);
        }
    }

    /*
     * Editing a tag
     */
    function edit($id) {
        // check if the tag exists before trying to edit it
        $data['tag'] = $this->Tag_model->get_tag($id);

        if (isset($data['tag']['id'])) {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('name', 'Name', 'required|max_length[50]');

            if ($this->form_validation->run()) {
                $params = array(
                    'category_id' => $this->input->post('category_id'),
                    'name' => $this->input->post('name'),
                );

                $this->Tag_model->update_tag($id, $params);
                redirect('tag/index');
            } else {
                $this->load->model('Category_model');
                $data['all_categories'] = $this->Category_model->get_all_categories();

                $data['_view'] = 'tag/edit';
                $this->load->view('layouts/main', $data);
            }
        } else
            show_error('The tag you are trying to edit does not exist.');
    }

    /*
     * Deleting tag
     */
    function remove($id) {
        $tag = $this->Tag_model->get_tag($id);

        // check if the tag exists before trying to delete it
        if (isset($tag['id'])) {
            $this->Tag_model->delete_tag($id);
            redirect('tag/index');
        } else
            show_error('The tag you are trying to delete does not exist.');
    }

}
