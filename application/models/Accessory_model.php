<?php

/*
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */

class Accessory_model extends CI_Model
{
    function __construct() {
        parent::__construct();
    }

    /*
     * Get accessory by id
     */
    function get_accessory($id) {
        return $this->db->get_where('accessories', array('id' => $id))->row_array();
    }

    /*
     * Get all accessories
     */
    function get_all_accessories() {
        return $this->db->select('accessories.id, categories.name AS category, options.name AS option, accessories.name')
            ->join('categories', 'accessories.category_id = categories.id', 'LEFT')
            ->join('options', 'accessories.option_id = options.id', 'LEFT')
            ->get('accessories')->result_array();
    }

    /*
     * function to add new accessory
     */
    function add_accessory($params) {
        $this->db->insert('accessories', $params);
        return $this->db->insert_id();
    }

    /*
     * function to update accessory
     */
    function update_accessory($id, $params) {
        $this->db->where('id', $id);
        return $this->db->update('accessories', $params);
    }

    /*
     * function to delete accessory
     */
    function delete_accessory($id) {
        return $this->db->delete('accessories', array('id' => $id));
    }

    /**
     * @param $category_id
     * @return array
     */
    function get_accessories_by_category($category_id) {

        if(is_array($category_id)) {
            $this->db->where_in('category_id', $category_id);
        } else {
            $this->db->where('category_id', $category_id);
        }

        $rows = $this->db->get('accessories')->result_array();
        return array_map(function($item) {
            return $item['name'];
        }, $rows);
    }

    /**
     * @param array $option_ids
     * @return array
     */
    function get_accessories_by_options(array $option_ids) {
        $rows = $this->db->where_in('option_id', $option_ids)
            ->group_by('name')
            ->get('accessories')->result_array();

        return array_map(function($item) {
            return $item['name'];
        }, $rows);
    }
}
