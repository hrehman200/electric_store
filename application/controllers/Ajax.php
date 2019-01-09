<?php

require_once __DIR__.'/Auth_Controller.php';

class Ajax extends Auth_Controller
{
    function __construct() {
        parent::__construct();
        $this->load->model('Option_model');
        $this->load->model('Category_model');
        $this->load->model('Product_model');
        $this->load->model('Product_picture_model');
        $this->load->model('Color_category_map_model');
    }

    function get_options($category_id) {
        $options = $this->Option_model->get_options_of_category($category_id);
        echo json_encode($options);
    }

    function get_categories($parent_id) {
        $categories = $this->Category_model->get_categories($parent_id);
        echo json_encode($categories);
    }

    /**
     * @param $product_picture_id
     */
    function delete_product_picture($product_picture_id) {
        $product_picture = $this->Product_picture_model->get_product_picture($product_picture_id);
        unlink('./uploads/'.$product_picture['name']);
        $this->Product_picture_model->delete_product_picture($product_picture_id);
        echo json_encode(['success'=>1]);
    }

    function get_colors($category_id) {
        $colors = $this->Color_category_map_model->get_all_color_category_map($category_id);
        echo json_encode($colors);
    }

    function update_picture_sort_order() {
        $pics = $_POST['pictures'];
        foreach ($pics as $pic) {
            $this->Product_picture_model->update_product_picture($pic['id'], ['sort_order' => $pic['sort_order']]);
        }

        $product = $this->Product_model->get_product($_POST['product_id']);
        $pictures_html = $this->Product_picture_model->get_picture_html_from_product_data($product, $_POST['pic_key']);
        $pictures_sort_html = $this->Product_picture_model->get_pictures_for_sort($product, $_POST['pic_key']);

        echo json_encode(['success' => 1, 'data'=>[
            'pictures_html' => $pictures_html,
            'pictures_sort_html' => $pictures_sort_html,
        ]]);
    }

    function get_products() {
        $products = $this->Product_model->get_all_products();
        $response = [];
        foreach($products as &$p) {
            $arr['tracking_no'] = $p['tracking_no'];
            $arr['model_no1'] = $p['model_no1'];
            $arr['serial_no1'] = $p['serial_no1'];
            $arr['title'] = $p['title'];

            // only warranty user can see the tick/cross sign based on whether warranty is set or not
            if($this->session->userdata('role') == WARRANTY_INFO) {
                $action_needed = $this->Product_model->is_action_needed_for_product($this->session->userdata('role'), $p['id']);
                $arr['action_needed'] = sprintf('<span class="fa fa-2x %s"></span>', $action_needed ? 'fa-times text-danger' : 'fa-check text-success');
            } else {
                $arr['action_needed'] = '';
            }

            $buttons = '';
            if ($this->permission->has_permission('sticker')) {
                $buttons .= '<a href="'.site_url('product/sticker/' . $p['id']).'" class="btn btn-warning btn-xs" target="_blank"><span class="fa fa-certificate"></span> Sticker</a>';
            }

            if ($this->permission->has_permission('view_product') || $this->permission->has_permission('edit_product') || $this->permission->has_permission('update_warranty')) {
                $buttons .= '<a href="'.site_url('product/add/' . $p['id']).'" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a>';
            }

            if ($this->permission->has_permission('shopify_csv')) {
                $buttons .= '<a href="'.site_url('product/shopify_csv/' . $p['id']).'" class="btn btn-info btn-xs"><span class="fa fa-save"></span> CSV</a>';
            }

            if ($this->permission->has_permission('delete_product')) {
                $buttons .= '<a href="javascript:;" data-id="'.$p['id'].'" class="btn btn-danger btn-xs btn-delete-product"><span class="fa fa-trash"></span> Delete</a>';
            }

            $arr['buttons'] = $buttons;
            $response[] = $arr;
        }

        echo json_encode(['data' => $response]);
    }

    function executeQuery() {
        $this->db->query('
        UPDATE options
        SET name = REPLACE(name, "(Always)", "")
        WHERE name LIKE "%(Always)%"
        ');

        echo $this->db->affected_rows();
    }
}
