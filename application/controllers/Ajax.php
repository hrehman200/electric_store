<?php

class Ajax extends CI_Controller
{
    function __construct() {
        parent::__construct();
        $this->load->model('Option_model');
    }

    function get_options($category_id) {
        $options = $this->Option_model->get_options_of_category($category_id);
        echo json_encode($options);
    }

}
