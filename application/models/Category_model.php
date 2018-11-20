<?php

/*
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */

class Category_model extends CI_Model
{
    function __construct() {
        parent::__construct();
    }

    /*
     * Get category by id
     */
    function get_category($id) {
        return $this->db->get_where('categories', array('id' => $id))->row_array();
    }

    /*
     * Get all categories
     */
    function get_all_categories() {
        $this->db->order_by('id', 'desc');
        return $this->db->get('categories')->result_array();
    }

    /**
     * @param null $parent_id
     * @return mixed
     */
    function get_categories($parent_id = null) {
        $categories =  $this->db->where('parent_id', $parent_id)
            ->get('categories')
            ->result_array();

        return $categories;
    }

    /**
     * @return string
     */
    function get_categories_dropdown_html($parent_id = null) {

        $categories = $this->get_categories($parent_id);

        $html = '';
        foreach($categories as $c1) {
            $html .= sprintf('<option value="%d">%s</option>', $c1['id'], $c1['name']);
        }

        return $html;
    }

    /*
     * function to add new category
     */
    function add_category($params) {
        $this->db->insert('categories', $params);
        return $this->db->insert_id();
    }

    /*
     * function to update category
     */
    function update_category($id, $params) {
        $this->db->where('id', $id);
        return $this->db->update('categories', $params);
    }

    /*
     * function to delete category
     */
    function delete_category($id) {
        return $this->db->delete('categories', array('id' => $id));
    }
}
