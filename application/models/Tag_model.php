<?php

/*
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */

class Tag_model extends CI_Model
{
    function __construct() {
        parent::__construct();
    }

    /*
     * Get tag by id
     */
    function get_tag($id) {
        return $this->db->get_where('tags', array('id' => $id))->row_array();
    }

    /**
     * @param $category_id
     * @return mixed
     */
    function get_tags_for_category($category_id) {
        $rows = $this->db->select('name')
            ->get_where('tags', array('category_id' => $category_id))
            ->result_array();

        return array_map(function($item) { return $item['name']; }, $rows);
    }

    /*
     * Get all tags
     */
    function get_all_tags() {
        $this->db->order_by('id', 'desc');
        return $this->db->get('tags')->result_array();
    }

    /*
     * function to add new tag
     */
    function add_tag($params) {
        $this->db->insert('tags', $params);
        return $this->db->insert_id();
    }

    /*
     * function to update tag
     */
    function update_tag($id, $params) {
        $this->db->where('id', $id);
        return $this->db->update('tags', $params);
    }

    /*
     * function to delete tag
     */
    function delete_tag($id) {
        return $this->db->delete('tags', array('id' => $id));
    }
}
