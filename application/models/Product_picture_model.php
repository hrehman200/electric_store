<?php

/*
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */

class Product_picture_model extends CI_Model
{
    const PICTURE_TYPES = [
        'profile_pic' => 1,
        'open_pic' => 2,

        'display_pic_1' => 3,
        'measurement_tracking_pic_1' => 4,
        'power_src_pic_1' => 5,
        'damage_pic_1' => 6,
        'missing_pieces_pic_1' => 7,
        'descriptive_pic_1' => 8,
        'model_serial_no_pic_1' => 9,

        'display_pic_2' => 10,
        'measurement_tracking_pic_2' => 11,
        'power_src_pic_2' => 12,
        'damage_pic_2' => 13,
        'missing_pieces_pic_2' => 14,
        'descriptive_pic_2' => 15,
        'model_serial_no_pic_2' => 16,
    ];

    const PUBLICLY_VIEWABLE_PIC_TYPES = [1, 2, 3, 10];

    function __construct() {
        parent::__construct();
    }

    /*
     * Get product_picture by id
     */
    function get_product_picture($id) {
        return $this->db->get_where('product_pictures', array('id' => $id))->row_array();
    }

    /**
     * @param $product_id
     * @param null|int|string $type
     * @return mixed
     */
    function get_all_product_pictures($product_id, $type = null) {
        $this->db->where('product_id', $product_id);
        if($type != null) {
            if(!is_int($type)) {
                $type = self::PICTURE_TYPES[$type];
            }
            $this ->db->where('type', $type);
        }
        $this->db->order_by('sort_order', 'asc');
        $pictures = $this->db->get('product_pictures')->result_array();

        $result = [];
        foreach($pictures as $pic) {
            $key = array_search ($pic['type'], self::PICTURE_TYPES);
            $result[$key][] = $pic;
        }

        return $result;
    }

    /**
     * @param $product_id
     * @return mixed
     */
    function get_public_picture_urls($product_id) {
        $pictures = $this->db->select(sprintf('CONCAT("%suploads/", name) AS url', base_url()), false)
            ->where('product_id', $product_id)
            ->where_in('type', self::PUBLICLY_VIEWABLE_PIC_TYPES)
            ->order_by('sort_order', 'asc')
            ->get('product_pictures')
            ->result_array();

        return $pictures;
    }

    /**
     * @param $product
     * @param $type_key_name
     * @return string
     */
    function get_picture_html_from_product_data($product, $type_key_name) {
        $html = '';
        foreach($product['pictures'][$type_key_name] as $pic) {
            $img = base_url().'uploads/'.$pic['name'];
            $html .= sprintf('<div class="product-pic">
                <a href="%s" data-toggle="lightbox"><img src="%s" width="250"></a>
                <div class="edit" data-id="%d"><a href="javascript:;"><i class="fa fa-times fa-lg fa-2x"></i></a></div>
            </div>', $img, $img, $pic['id']);
        }
        return $html;
    }

    /**
     * @param $product
     * @param $type_key_name
     * @return string
     */
    function get_pictures_for_hover($product, $type_key_name) {
        $html = '';
        foreach($product['pictures'][$type_key_name] as $pic) {
            $img = base_url().'uploads/'.$pic['name'];
            $html .= sprintf('<a href="%s" data-toggle="lightbox" data-lightbox="%s"><i class="fa fa-picture-o"></i></a>', $img, $type_key_name);
        }
        return $html;
    }

    /**
     * @param $product
     * @param $type_key_name
     * @return string
     */
    function get_pictures_for_sort($product, $type_key_name) {
        $html = sprintf('<ul class="sortable" id="ul_%s">', time());
        foreach($product['pictures'][$type_key_name] as $pic) {
            $img = base_url().'uploads/'.$pic['name'];
            $html .= sprintf('<li class="ui-state-default" data-pic-id="%d"><img src="%s" width="300" /></li>', $pic['id'], $img);
        }
        $html .= '</ul>';
        return $html;
    }

    /*
     * function to add new product_picture
     */
    function add_product_picture($params) {
        $this->db->insert('product_pictures', $params);
        return $this->db->insert_id();
    }

    /*
     * function to update product_picture
     */
    function update_product_picture($id, $params) {
        $this->db->where('id', $id);
        return $this->db->update('product_pictures', $params);
    }

    /*
     * function to delete product_picture
     */
    function delete_product_picture($id) {
        return $this->db->delete('product_pictures', array('id' => $id));
    }

    /**
     * @param $product_id
     * @return mixed
     */
    function delete_product_pictures($product_id) {
        $pictures = $this->get_all_product_pictures($product_id);
        foreach($pictures as $type => $pics) {
            foreach($pics as $pic_row) {
                unlink('uploads/' . $pic_row['name']);
            }
        }
        return $this->db->delete('product_pictures', array('product_id' => $product_id));
    }

    /**
     * @param $product_id
     * @param $arr_pics
     */
    function save_pictures($product_id, $arr_pics) {
        foreach($arr_pics as $type => $file_names) {
            $count = 0;
            foreach($file_names as $name) {
                $count++;
                $this->db->insert('product_pictures', [
                    'product_id' => $product_id,
                    'type' => $type,
                    'name' => $name,
                    'sort_order' => ($type == self::PICTURE_TYPES['display_pic_1']) ? $count : 0
                ]);
            }
        }
    }
}
