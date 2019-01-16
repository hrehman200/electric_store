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
        $this->load->model('Product_picture_model');
    }

    /*
     * Listing of products
     */
    function index() {
        $products = $this->Product_model->get_all_products();
        foreach($products as &$p) {
            $p['action_needed'] = $this->Product_model->is_action_needed_for_product($this->session->userdata('role'), $p['id']);
        }

        $data['products'] = $products;
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
    function add($old_product_id = null) {
        $this->load->library('form_validation');

        $editing = $old_product_id > 0;
        if($editing) {
            $data['product'] = $this->Product_model->get_product($old_product_id);
        }

        if (isset($_POST) && count($_POST) > 0) {

            $this->form_validation->set_rules('source', 'Source', 'required');

            $category_id1 = $this->input->post('category_id1');
            $category_id1 = $category_id1[count($category_id1) - 1];

            $category_id2 = $this->input->post('category_id2');
            $category_id2 = $category_id2[count($category_id2) - 1];

            if($category_id1 == MISCELLANIOUS) {
                $title = $this->input->post('title');
            } else {
                $title = $this->Product_model->get_product_title($this->input->post());
            }

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
                'warranty_date1' => $this->input->post('warranty_date1'),
                'warranty_date2' => $this->input->post('warranty_date2'),
                'cubic_feet1' => $this->input->post('cubic_feet1'),
                'cubic_feet2' => $this->input->post('cubic_feet2'),
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
                'description' => ucwords($this->input->post('description')),
                'features' => ucwords($this->input->post('features')),
                'options' => ucwords($this->input->post('options')),
                'cycles' => ucwords($this->input->post('cycles')),
                'features2' => ucwords($this->input->post('features2')),
                'options2' => ucwords($this->input->post('options2')),
                'cycles2' => ucwords($this->input->post('cycles2')),
                'current_model1' => $this->input->post('current_model1'),
                'current_model2' => $this->input->post('current_model2'),
                'created' => $this->input->post('created'),
                'updated' => $this->input->post('updated'),
            );

            $params = $this->Product_model->sanitize_input($this->session->userdata('role'), $params);

            if($editing) {
                $this->Product_model->update_product($old_product_id, $params);
                $this->Product_model->delete_options($old_product_id);
                $this->Product_model->add_options($old_product_id, $this->input->post('option_id1'));
                $this->Product_model->add_options($old_product_id, $this->input->post('option_id2'));

                $arr_pics = $this->_upload_pics($_FILES);
                $this->Product_picture_model->save_pictures($old_product_id, $arr_pics);

            } else {
                $product_id = $this->Product_model->add_product($params);
                if ($product_id > 0) {
                    $this->Product_model->add_options($product_id, $this->input->post('option_id1'));
                    $this->Product_model->add_options($product_id, $this->input->post('option_id2'));

                    $arr_pics = $this->_upload_pics($_FILES);
                    $this->Product_picture_model->save_pictures($product_id, $arr_pics);
                }
            }

            redirect('product/index');
        } else {
            $this->load->model('Category_model');
            $data['all_categories'] = $this->Category_model->get_categories_dropdown_html();

            $this->load->model('Brand_model');
            $data['all_brands'] = $this->Brand_model->get_all_brands();

            $this->load->model('Color_model');
            $data['all_colors'] = $this->Color_model->get_all_colors();

            $this->load->model('Condition_model');
            $data['all_conditions'] = $this->Condition_model->get_all_conditions();

            $data['_view'] = 'product/add';
            $data['editing'] = $editing;
            $this->load->view('layouts/main', $data);
        }
    }

    /*
     * Deleting product
     */
    function remove($id) {

        if (!$this->permission->has_permission('delete_product')) {
            show_error("You don't have permission");
        }

        $product = $this->Product_model->get_product($id);

        // check if the product exists before trying to delete it
        if (isset($product['id'])) {
            $this->Product_model->delete_product($id);
            echo json_encode(['success'=> 1]);
        } else
            show_error('The product you are trying to delete does not exist.');
    }

    /**
     * @param $id
     */
    function shopify_csv($id) {

        if (!$this->permission->has_permission('shopify_csv')) {
            show_error("You don't have permission");
        }

        $csv_header = ['Handle','Title','Body (HTML)','Vendor','Type','Tags','Published','Option1 Name','Option1 Value','Option2 Name','Option2 Value','Option3 Name','Option3 Value','Variant SKU','Variant Grams','Variant Inventory Tracker','Variant Inventory Qty','Variant Inventory Policy','Variant Fulfillment Service','Variant Price','Variant Compare At Price','Variant Requires Shipping','Variant Taxable','Variant Barcode','Image Src','Image Position','Image Alt Text','Gift Card','SEO Title','SEO Description','Google Shopping / Google Product Category','Google Shopping / Gender','Google Shopping / Age Group','Google Shopping / MPN','Google Shopping / AdWords Grouping','Google Shopping / AdWords Labels','Google Shopping / Condition','Google Shopping / Custom Product','Google Shopping / Custom Label 0','Google Shopping / Custom Label 1','Google Shopping / Custom Label 2','Google Shopping / Custom Label 3','Google Shopping / Custom Label 4','Variant Image','Variant Weight Unit','Variant Tax Code','Cost per item'];
        
        // output headers so that the file is downloaded rather than displayed
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=product_'.$id.'.csv');

        $output = fopen('php://output', 'w');
        fputcsv($output, $csv_header);

        $rows = $this->Product_model->get_rows_for_shopify_csv($id);
        foreach($rows as $row) {
            fputcsv($output, $row);
        }
    }

    /**
     * @param $params
     * @return array
     */
    private function _upload_pics($params) {
        $arr_pic_names = [];
        foreach($params as $key=>$value) {
            if(strpos($key, '_pic') !== false) {

                if(is_array($params[$key]['name']) && strlen($params[$key]['name'][0]) > 0) {
                    $image_names = $this->_do_multi_upload($key);
                    if ($image_names != false) {
                        $arr_pic_names[Product_picture_model::PICTURE_TYPES[$key]] = array_merge([], $image_names);
                    } else {
                        show_error('Some error occurred while uploading picture');
                    }

                } else if(strlen($params[$key]['name']) > 0) {
                    $image_name = $this->_do_upload($key);
                    if ($image_name != false) {
                        $arr_pic_names[Product_picture_model::PICTURE_TYPES[$key]][] = $image_name;
                    } else {
                        show_error('Some error occurred while uploading picture');
                    }
                }
            }
        }
        return $arr_pic_names;
    }

    /**
     * @param $param_name
     * @return bool|string
     */
    private function _do_upload($param_name) {
        $upload_path = './uploads/';
        $config = array(
            'upload_path' => $upload_path,
            'allowed_types' => "gif|jpg|png|jpeg",
            'overwrite' => TRUE,
            'encrypt_name' => TRUE,
        );
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload($param_name)) {
            $data['imageError'] = $this->upload->display_errors();
            return false;

        } else {
            $file_data = $this->upload->data();
            return $file_data['file_name'];
        }
    }

    private function _do_multi_upload($param_name) {
        $upload_path = './uploads/';
        $config = array(
            'upload_path' => $upload_path,
            'allowed_types' => "gif|jpg|png|jpeg",
            'overwrite' => TRUE,
            'encrypt_name' => TRUE,
        );
        $this->load->library('upload', $config);

        $filenames = [];

        for($i=0; $i<count($_FILES[$param_name]['name']); $i++) {
            $_FILES[$param_name.'[]']['name']= $_FILES[$param_name]['name'][$i];
            $_FILES[$param_name.'[]']['type']= $_FILES[$param_name]['type'][$i];
            $_FILES[$param_name.'[]']['tmp_name']= $_FILES[$param_name]['tmp_name'][$i];
            $_FILES[$param_name.'[]']['error']= $_FILES[$param_name]['error'][$i];
            $_FILES[$param_name.'[]']['size']= $_FILES[$param_name]['size'][$i];

            if ($this->upload->do_upload($param_name.'[]')) {
                $file_data = $this->upload->data();
                $filenames[] = $file_data['file_name'];
            } else {
                return false;
            }
        }

        return $filenames;
    }
}
