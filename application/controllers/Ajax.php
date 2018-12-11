<?php

require_once __DIR__.'/Auth_Controller.php';

class Ajax extends Auth_Controller
{
    function __construct() {
        parent::__construct();
        $this->load->model('Option_model');
        $this->load->model('Category_model');
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

    function executeQuery() {
        $this->db->query('
        UPDATE options
        SET name = REPLACE(name, "(Always)", "")
        WHERE name LIKE "%(Always)%"
        ');

        echo $this->db->affected_rows();
    }
}
