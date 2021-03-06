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


    /**
     * Return a category-id array with parents as first item and child as second item
     *
     * @param $category_id
     * @param $arr
     * @return mixed
     */
    function get_category_id_tree($category_id, &$arr) {
        $row = $this->db->query(sprintf('SELECT parent_id FROM categories WHERE id = %d', $category_id))->row_array();
        if($row['parent_id']) {
            array_unshift($arr, $row['parent_id']);
            $this->get_category_id_tree($row['parent_id'], $arr);
        }
        return $arr;
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
        $count = 0;
        foreach($categories as $c1) {
            $html .= sprintf('<option value="%d" %s>%s</option>', $c1['id'], $count==0?'selected':'', $c1['name']);
            $count++;
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

    /**
     * @param $category_id
     * @return mixed
     */
    function get_title_format_of_category($category_id) {
        $category = $this->get_category($category_id);
        return $category['product_title_format'];
    }
}
