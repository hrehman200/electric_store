<?php

require_once __DIR__.'/Auth_Controller.php';

class Ajax extends Auth_Controller
{
    function __construct() {
        parent::__construct();
        $this->load->model('Option_model');
        $this->load->model('Category_model');
    }

    function get_options($category_id) {
        $options = $this->Option_model->get_options_of_category($category_id);
        echo json_encode($options);
    }

    function get_categories($parent_id) {
        $categories = $this->Category_model->get_categories($parent_id);
        echo json_encode($categories);
    }

}
