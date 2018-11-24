<?php

/*
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */

require_once __DIR__.'/Auth_Controller.php';

class Product extends Auth_Controller
{
    function __construct() {
        parent::__construct();
        $this->load->model('Product_model');
        $this->load->model('Category_model');
    }

    /*
     * Listing of products
     */
    function index() {
        $data['products'] = $this->Product_model->get_all_products();

        $data['_view'] = 'product/index';
        $this->load->view('layouts/main', $data);
    }

    /*
     * Adding a new product
     */
    function add() {
        $this->load->library('form_validation');

        if (isset($_POST) && count($_POST) > 0) {

            $this->form_validation->set_rules('source', 'Source', 'required');

            $title = $this->Product_model->get_product_title($this->input->post());

            $category_id1 = $this->input->post('category_id1');
            $category_id1 = $category_id1[count($category_id1) - 1];

            $category_id2 = $this->input->post('category_id2');
            $category_id2 = $category_id2[count($category_id2) - 1];

            $params = array(
                'source' => $this->input->post('source'),
                'tracking_no' => $this->input->post('tracking_no'),
                'model_no' => $this->input->post('model_no'),
                'serial_no' => $this->input->post('serial_no'),
                'category_id1' => $category_id1,
                'category_id2' => $category_id2,
                'brand_id' => $this->input->post('brand_id'),
                'color_id' => $this->input->post('color_id'),
                'condition_id1' => $this->input->post('condition_id1'),
                'condition_id2' => $this->input->post('condition_id2'),
                'warranty_date1' => $this->input->post('condition_date_1'),
                'warranty_date2' => $this->input->post('condition_date_2'),
                'cubic_feet' => $this->input->post('cubic_feet'),
                'feature1' => $this->input->post('feature1'),
                'feature2' => $this->input->post('feature2'),
                'feature3' => $this->input->post('feature3'),
                'price' => $this->input->post('price'),
                'comparable_price' => $this->input->post('comparable_price'),
                'height1' => $this->input->post('height1'),
                'width1' => $this->input->post('width1'),
                'depth1' => $this->input->post('depth1'),
                'height2' => $this->input->post('height2'),
                'width2' => $this->input->post('width2'),
                'depth2' => $this->input->post('depth2'),
                'title' => $this->input->post('title'),
                'description' => $this->input->post('description'),
                'tags' => $this->input->post('tags'),
                'accessories' => $this->input->post('accessories'),
                'created' => $this->input->post('created'),
                'updated' => $this->input->post('updated'),
            );

            $product_id = $this->Product_model->add_product($params);
            if($product_id > 0) {
               $this->Product_model->add_options($product_id, $params);
               redirect('product/index');
            }
        } else {
            $this->load->model('Category_model');
            $data['all_categories'] = $this->Category_model->get_categories_dropdown_html();

            $this->load->model('Brand_model');
            $data['all_brands'] = $this->Brand_model->get_all_brands();

            $this->load->model('Color_model');
            $data['all_colors'] = $this->Color_model->get_all_colors();

            $this->load->model('Condition_model');
            $data['all_conditions'] = $this->Condition_model->get_all_conditions();

            $this->load->model('Option_model');
            $data['all_options'] = $this->Option_model->get_all_options();

            $data['_view'] = 'product/add';
            $this->load->view('layouts/main', $data);
        }
    }

    /*
     * Editing a product
     */
    function edit($id) {
        // check if the product exists before trying to edit it
        $data['product'] = $this->Product_model->get_product($id);

        if (isset($data['product']['id'])) {
            if (isset($_POST) && count($_POST) > 0) {
                $params = array(
                    'category_id' => $this->input->post('category_id'),
                    'brand_id' => $this->input->post('brand_id'),
                    'color_id' => $this->input->post('color_id'),
                    'condition_id' => $this->input->post('condition_id'),
                    'option_id' => $this->input->post('option_id'),
                    'source' => $this->input->post('source'),
                    'tracking_no' => $this->input->post('tracking_no'),
                    'cubic_feet' => $this->input->post('cubic_feet'),
                    'model_no' => $this->input->post('model_no'),
                    'serial_no' => $this->input->post('serial_no'),
                    'feature1' => $this->input->post('feature1'),
                    'feature2' => $this->input->post('feature2'),
                    'feature3' => $this->input->post('feature3'),
                    'price' => $this->input->post('price'),
                    'comparable_price' => $this->input->post('comparable_price'),
                    'height' => $this->input->post('height'),
                    'width' => $this->input->post('width'),
                    'depth' => $this->input->post('depth'),
                    'title' => $this->input->post('title'),
                    'created' => $this->input->post('created'),
                    'updated' => $this->input->post('updated'),
                    'description' => $this->input->post('description'),
                    'tags' => $this->input->post('tags'),
                    'accessories' => $this->input->post('accessories'),
                );

                $this->Product_model->update_product($id, $params);
                redirect('product/index');
            } else {
                $this->load->model('Category_model');
                $data['all_categories'] = $this->Category_model->get_all_categories();

                $this->load->model('Brand_model');
                $data['all_brands'] = $this->Brand_model->get_all_brands();

                $this->load->model('Color_model');
                $data['all_colors'] = $this->Color_model->get_all_colors();

                $this->load->model('Condition_model');
                $data['all_conditions'] = $this->Condition_model->get_all_conditions();

                $this->load->model('Option_model');
                $data['all_options'] = $this->Option_model->get_all_options();

                $data['_view'] = 'product/edit';
                $this->load->view('layouts/main', $data);
            }
        } else
            show_error('The product you are trying to edit does not exist.');
    }

    /*
     * Deleting product
     */
    function remove($id) {
        $product = $this->Product_model->get_product($id);

        // check if the product exists before trying to delete it
        if (isset($product['id'])) {
            $this->Product_model->delete_product($id);
            redirect('product/index');
        } else
            show_error('The product you are trying to delete does not exist.');
    }

}
