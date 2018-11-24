<?php

/*
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */

class Product_model extends CI_Model
{
    function __construct() {
        parent::__construct();
        $this->load->model('Color_model');
        $this->load->model('Brand_model');
        $this->load->model('Option_model');
        $this->load->model('Category_model');
    }

    /*
     * Get product by id
     */
    function get_product($id) {
        return $this->db->get_where('products', array('id' => $id))->row_array();
    }

    /*
     * Get all products
     */
    function get_all_products() {
        $this->db->order_by('id', 'desc');
        return $this->db->get('products')->result_array();
    }

    /*
     * function to add new product
     */
    function add_product($params) {
        $this->db->insert('products', $params);
        return $this->db->insert_id();
    }

    /*
     * function to update product
     */
    function update_product($id, $params) {
        $this->db->where('id', $id);
        return $this->db->update('products', $params);
    }

    /*
     * function to delete product
     */
    function delete_product($id) {
        return $this->db->delete('products', array('id' => $id));
    }

    /**
     * @param $product_id
     * @param $params
     */
    function add_options($product_id, $params) {
        foreach($params['option_id1'] as $option_id) {
            $this->db->insert('product_options', [
                'product_id' => $product_id,
                'option_id' => $option_id
            ]);
        }
    }

    /**
     * @param $product_id
     * @return mixed
     */
    function get_product_options($product_id) {
        $sql = sprintf('SELECT o.name FROM product_options po
          INNER JOIN options o ON po.option_id = o.id
          WHERE po.product_id = %d', $product_id);

        return $this->db->query($sql)->result_array();
    }

    /**
     * @param $option_ids
     * @return array
     */
    function get_options($option_ids) {
        $arr = [];
        if(count($option_ids) > 0) {
            $options = $this->db->where_in('id', $option_ids)
                ->get('options')
                ->result_array();

            $arr = array_map(function($item) {
                return trim($item['name']);
            }, $options);
        }

        return $arr;
    }

    /**
     * Various conditions for title:-
     *  If Dryer  = or greater than 7.0 cu ft add "HUGE" to beginning
        If Washer cu ft over 3.8  then add "HUGE" to beginning
        If Washer Dryer Set and washer is greater or equal to 3.8 cu ft and dryer is greater or equal to 7.0 cu ft then add "HUGE" to beginning
        If Steam  then add"Steam" Before Appliance Sub Category  examples:(Top Load Washer) (Frontload Washer) (Electric Dryer) (Gas Dryer)
        If single item add brand
        If Washer Dryer set and both brands match then add brand. Do not add if brand does not match
     *
     * Sample title format: (Color) (5 Burner) (Convection) (Double Oven) (Glasstop) (Energy Star) (Brand) (Sub Category)
     *
     * @param $params
     * @return mixed|string
     */
    function get_product_title($params) {
        $format = $this->Category_model->get_title_format_of_category($params['category_id1'][0]);
        $title = $format;

        $color = $this->Color_model->get_color($params['color_id'])['name'];
        $brand = $this->Brand_model->get_brand($params['brand_id'])['name'];
        $subcategory = $this->Category_model->get_category($params['category_id1'][1])['name'];
        $user_selected_options1 = $this->get_options($params['option_id1']);

        $title = str_replace('Color', $color, $title);
        $title = str_replace('Brand', $brand, $title);
        $title = str_replace('Cu Ft', $params['cubic_feet1'].' cu Ft.', $title);
        $title = str_replace('Sub Category', $subcategory, $title);

        $allowed_options_in_title = ['Energy Star', 'Counter Depth'];
        foreach($allowed_options_in_title as $allowed) {
            if(!in_array($allowed, $user_selected_options1)) {
                $title = str_replace($allowed, '', $title);
            }
        }

        $title = str_replace('(', '', $title);
        $title = str_replace(')', '', $title);

        return $title;
    }
}
