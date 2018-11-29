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

    function sticker($product_id) {
        $sql = sprintf('SELECT 
            p.title, p.price, p.comparable_price, 
            p.feature1, p.feature2, p.feature3, 
            p.height1, p.width1, p.depth1,
            p.height2, p.width2, p.depth2,
            p.tracking_no,
            c1.name AS condition1, c1.description AS condition_desc1,
            c2.name AS condition2, c2.description AS condition_desc2
            FROM products p
            INNER JOIN conditions c1 ON p.condition_id1 = c1.id
            LEFT JOIN conditions c2 ON p.condition_id2 = c2.id
            WHERE p.id = %d', $product_id);

        $query = $this->db->query($sql);
        if($query->num_rows() > 0) {
            $product = $query->row_array();
            $data = $product;
            $this->load->view('sticker/print', $data);
        }
    }

    /*
     * Adding a new product
     */
    function add() {
        $this->load->library('form_validation');

        if (isset($_POST) && count($_POST) > 0) {

            $this->form_validation->set_rules('source', 'Source', 'required');

            if(strlen($this->input->post('title')) == 0) {
                $title = $this->Product_model->get_product_title($this->input->post());
            } else {
                $title = $this->input->post('title');
            }

            $category_id1 = $this->input->post('category_id1');
            $category_id1 = $category_id1[count($category_id1) - 1];

            $category_id2 = $this->input->post('category_id2');
            $category_id2 = $category_id2[count($category_id2) - 1];

            $params = array(
                'tracking_no' => $this->input->post('tracking_no'),
                'source1' => $this->input->post('source1'),
                'model_no1' => $this->input->post('model_no1'),
                'serial_no1' => $this->input->post('serial_no1'),
                'source2' => $this->input->post('source2'),
                'model_no2' => $this->input->post('model_no2'),
                'serial_no2' => $this->input->post('serial_no2'),
                'category_id1' => $category_id1,
                'category_id2' => $category_id2,
                'brand_id1' => $this->input->post('brand_id1'),
                'brand_id2' => $this->input->post('brand_id2'),
                'color_id1' => $this->input->post('color_id1'),
                'color_id2' => $this->input->post('color_id2'),
                'condition_id1' => $this->input->post('condition_id1'),
                'condition_id2' => $this->input->post('condition_id2'),
                'warranty_date1' => $this->input->post('condition_date_1'),
                'warranty_date2' => $this->input->post('condition_date_2'),
                'cubic_feet' => $this->input->post('cubic_feet1'),
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
                'title' => $title,
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
