<?php

/*
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */

class Product_model extends CI_Model
{
    const ALLOWED_FIELDS = [
        WARRANTY_INFO => ['condition_id1', 'warranty_date1', 'condition_id2', 'warranty_date2'],
        QC_MANAGER => ['*'],
        QC => ['*'],
    ];

    function __construct() {
        parent::__construct();
        $this->load->model('Color_model');
        $this->load->model('Brand_model');
        $this->load->model('Option_model');
        $this->load->model('Category_model');
        $this->load->model('Product_picture_model');
        $this->load->model('Tag_model');
        $this->load->model('Accessory_model');
        $this->load->model('Condition_model');
    }

    /*
     * Get product by id
     */
    function get_product($product_id) {
        $sql = sprintf('SELECT p.id, p.tracking_no, p.category_id1, p.category_id2,
            p.source1, p.model_no1, p.serial_no1, p.source2, p.model_no2, p.serial_no2,
            p.brand_id1, p.color_id1, p.brand_id2, p.color_id2,
            p.cubic_feet1, p.cubic_feet2,
            p.condition_id1, p.condition_id2,
            p.warranty_date1, p.warranty_date2,
            p.width1, p.width2, p.height1, p.height2, p.depth1, p.depth2,
            p.feature1, p.feature2, p.feature3,
            p.price, p.comparable_price,
            p.description,
            p.title
            FROM products p
            WHERE p.id = %d', $product_id);

        $row = $this->db->query($sql)->row_array();

        $category_id1_arr = [$row['category_id1']];
        $category_id2_arr = [$row['category_id2']];

        $row['category_id1_arr'] = $this->Category_model->get_category_id_tree($row['category_id1'], $category_id1_arr);
        $row['category_id2_arr'] = $this->Category_model->get_category_id_tree($row['category_id2'], $category_id2_arr);

        $row['option_id_arr'] = $this->get_product_option_ids($product_id);

        $row['pictures'] = $this->Product_picture_model->get_all_product_pictures($product_id);

        $category_id = $row['category_id1_arr'][0];
        $row['category'] = $this->Category_model->get_category($category_id)[0]['name'];

        return $row;
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
     * @param $options_ids
     */
    function add_options($product_id, $options_ids) {
        foreach($options_ids as $option_id) {
            $this->db->insert('product_options', [
                'product_id' => $product_id,
                'option_id' => $option_id
            ]);
        }
    }

    /**
     * @param $product_id
     */
    function delete_options($product_id) {
        $this->db->delete('product_options', ['product_id' => $product_id]);
    }

    /**
     * @param $category_id
     * @param $product_id
     * @return mixed
     */
    function get_product_option_ids($product_id, $category_id = null) {
        $sql = sprintf('SELECT o.id FROM product_options po
          INNER JOIN options o ON po.option_id = o.id
          WHERE po.product_id = %d', $product_id);

        if($category_id != null) {
            $sql .= sprintf(' AND o.category_id = %d', $category_id);
        }

        $arr = $this->db->query($sql)->result_array();
        return array_map(function($item) { return $item['id']; }, $arr);
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

        $color1 = $this->Color_model->get_color($params['color_id1'])['name'];
        $brand1 = $this->Brand_model->get_brand($params['brand_id1'])['name'];
        $color2 = $this->Color_model->get_color($params['color_id2'])['name'];
        $brand2 = $this->Brand_model->get_brand($params['brand_id2'])['name'];
        $subcategory1 = $this->Category_model->get_category($params['category_id1'][1])['name'];
        $subcategory2 = $this->Category_model->get_category($params['category_id2'][0])['name'];
        $user_selected_options1 = $this->get_options($params['option_id1']);
        $user_selected_options2 = $this->get_options($params['option_id2']);

        if(($params['category_id1'][0] == WASHER_DRYER_SET && $params['cubic_feet1'] >= 3.8 && $params['cubic_feet2'] >= 7.0)
            ||
            ($params['category_id1'][0] == WASHER && $params['cubic_feet1'] >= 3.8)
            ||
            ($params['category_id1'][0] == DRYER && $params['cubic_feet1'] >= 7.0)
        ) {
            $title = 'HUGE '.$title;
        }

        if($params['category_id1'][0] == WASHER_DRYER_SET) {

            $subcategory1 = $this->Category_model->get_category($params['category_id1'][2])['name'];

            if($params['brand_id1'] == $params['brand_id2']) {
                $title = str_replace('Brand', $brand1, $title);
            } else {
                $title = str_replace('Brand', '', $title);
            }

            $title = $this->_str_replace_first('CuFt', $params['cubic_feet1'].' Cu Ft.', $title);
            $title = $this->_str_replace_first('CuFt', $params['cubic_feet2'].' Cu Ft.', $title);

            $title = $this->_str_replace_first('Sub Category', $subcategory1.' Washer', $title);
            $title = $this->_str_replace_first('Sub Category', $subcategory2.' Dryer', $title);

            $allowed_options_in_title = ['Steam'];
            foreach($allowed_options_in_title as $allowed) {
                if(!in_array($allowed, $user_selected_options1)) {
                    $title = $this->_str_replace_first($allowed, '', $title);
                }

                if(!in_array($allowed, $user_selected_options2)) {
                    $title = $this->_str_replace_first($allowed, '', $title);
                }
            }

        } else {
            $title = str_replace('Brand', $brand1, $title);
            $title = str_replace('Color', $color1, $title);
            $title = str_replace('CuFt', $params['cubic_feet1'].' Cu Ft.', $title);
            $title = str_replace('Sub Category', $subcategory1, $title);

            $allowed_options_in_title = ['Energy Star', 'Counter Depth', 'Convection', '5 Burners', 'Double Oven', 'Glasstop', 'Steam'];
            foreach($allowed_options_in_title as $allowed) {
                if(!in_array($allowed, $user_selected_options1)) {
                    $title = str_replace($allowed, '', $title);
                }
            }
        }

        $title = str_replace('(', '', $title);
        $title = str_replace(')', '', $title);

        // replace double whitespace with single whitespace
        $title = preg_replace('/\s+/', ' ', $title);

        return $title;
    }

    private function _str_replace_first($from, $to, $content) {
        $from = '/' . preg_quote($from, '/') . '/';
        return preg_replace($from, $to, $content, 1);
    }

    /**
     * @param $permission_group
     * @param $product_id
     * @return bool
     */
    public function is_action_needed_for_product($permission_group, $product_id) {
        if($permission_group == WARRANTY_INFO) {
            $sql = sprintf('SELECT id FROM products
              WHERE condition_id1 IS NULL AND id = %d', $product_id);

            return count($this->db->query($sql)->result_array()) > 0;
        }

        return false;
    }

    /**
     * @param $permission_group
     * @param $field_name
     * @return bool
     */
    public function get_disabled($permission_group, $field_name) {
        $arr_allowed_fields = self::ALLOWED_FIELDS[$permission_group];
        if($arr_allowed_fields[0] = '*') {
            return false;
        }
        return in_array($field_name, $arr_allowed_fields) ? false : 'disabled="disabled"';
    }

    /**
     * @param $permission_group
     * @param $params
     * @return mixed
     */
    public function sanitize_input($permission_group, $params) {
        $arr_allowed_fields = self::ALLOWED_FIELDS[$permission_group];

        if($arr_allowed_fields[0] = '*') {
            return $params;
        }

        foreach($params as $key => $value) {
            if(!in_array($key, $arr_allowed_fields)) {
                unset($params[$key]);
            }
        }

        return $params;
    }

    /**
     * @param $product_id
     * @return array
     */
    public function get_rows_for_shopify_csv($product_id) {
        $rows = [];
        $row = [];

        $product = $this->get_product($product_id);

        $category = $this->Category_model->get_category($product['category_id1_arr'][0])['name'];
        $sku = $product['source1'].'-'.$product['tracking_no'];

        // url handle
        $row[0] = sprintf('%s-%s-%s', strtolower($category), strtolower(str_replace(' ', '-', $product['title'])), $sku);
        // title
        $row[1] = $product['title'];
        // body html
        $row[2] = $this->_get_html_description_for_csv($product);
        // vendor
        $row[3] = 'Neu Appliances';
        // tags
        $tags = $this->get_tags_for_product($product);
        $row[5] = implode(',', $tags);
        // published
        $row[6] = 'FALSE';
        // option 1 name and value
        $row[7] = 'Title';
        $row[8] = 'Default Title';
        // variant grams
        $row[14] = 0;
        // variant related fields
        $row[15] = 'shopify';
        $row[16] = 1;
        $row[17] = 'deny';
        $row[18] = 'manual';
        $row[19] = $product['price'];
        $row[20] = $product['comparable_price'];
        $row[21] = 'TRUE';
        $row[22] = 'TRUE';
        // gift card
        $row[27] = 'FALSE';
        $row[44] = 'lb';
        $row[46] = '';   // last column

        // image source, each image should be on new line
        $pictures = $this->Product_picture_model->get_public_picture_urls($product_id);
        if(count($pictures) > 0) {
            foreach ($pictures as $index => $pic) {
                $row[24] = $pic['url'];
                $row[25] = $index + 1;

                if (count($rows) == 0) {
                    $this->_clean_array($row);
                    $rows[] = $row;
                    $row = [];
                } else {
                    $this->_clean_array($row);
                    $rows[] = $row;
                }
            }
        } else {
            $this->_clean_array($row);
            $rows[] = $row;
        }

        return $rows;
    }

    /**
     * @param $array
     */
    private function _clean_array(&$array) {
        end($array);
        $max = 46; //Get the final key as max!
        for ($i = 0; $i <= $max; $i++) {
            if (!isset($array[$i])) {
                $array[$i] = '';
            }
        }
        ksort($array);
    }

    /**
     * @param $product
     * @return array
     */
    public function get_tags_for_product($product) {

        $tags = [];

        $category_tags = $this->_get_category_tags($product);
        $tags = array_merge($tags, $category_tags);

        $conditional_tags = $this->_get_conditional_tags($product);
        $tags = array_merge($tags, $conditional_tags);

        $color_tags = $this->_get_color_tags($product);
        $tags = array_merge($tags, $color_tags);

        $brand_tags = $this->_get_brand_tags($product);
        $tags = array_merge($tags, $brand_tags);

        $condition_tags = $this->_get_condition_tags($product);
        $tags = array_merge($tags, $condition_tags);

        $option_tags = $this->_get_option_tags($product);
        $tags = array_merge($tags, $option_tags);

        $accessory_tags = $this->_get_accessories_tags($product);
        $tags = array_merge($tags, $accessory_tags);

        $current_model_tags = $this->_get_current_model_tags($product);
        $tags = array_merge($tags, $current_model_tags);

        $cubic_feet_tags = $this->_get_cubic_feet_tags($product);
        $tags = array_merge($tags, $cubic_feet_tags);

        return $tags;
    }

    /**
     * @param $product
     * @return array
     */
    private function _get_category_tags(&$product) {
        $category_id1_arr = $product['category_id1_arr'];
        $tags = [];
        $postfix = '';
        for($i=0; $i<count($category_id1_arr); $i++) {
            $prefix = $i==0 ? 'Category_' : 'SubCategory_';
            $category = $this->Category_model->get_category($category_id1_arr[$i])['name'];
            $category = str_replace(' ', '', $category);
            if($i == 0) {
                $postfix = '_'.$category;
                $tags[] = sprintf('%s%s', $prefix, $category);
            } else {
                $tags[] = sprintf('%s%s%s', $prefix, $category, $postfix);
            }
        }

        return $tags;
    }

    /**
     * @param $product
     * @return mixed
     */
    private function _get_conditional_tags(&$product) {
        $category_id1_arr = $product['category_id1_arr'];
        $tags = $this->Tag_model->get_tags_for_category($category_id1_arr[0]);
        return $tags;
    }

    /**
     * @param $product
     * @return string
     */
    private function _get_color_tags(&$product) {

        $tags = [];

        switch($product['category']) {
            case 'Washer Dryer Set':
                if($product['color_id1'] == $product['color_id2']) {
                    $color = $this->Color_model->get_color($product['color_id1']);
                    $tags[] = ['Washer_Dryer_Color_'.str_replace(' ', '', $color['name'])];
                    $tags[] = 'Color_WDMatch';
                } else {
                    $color = $this->Color_model->get_color($product['color_id1']);
                    $tags[] = ['Washer_Color_'.str_replace(' ', '', $color['name'])];
                    $color = $this->Color_model->get_color($product['color_id2']);
                    $tags[] = ['Dryer_Color_'.str_replace(' ', '', $color['name'])];
                    $tags[] = 'Color_WDNoMatch';
                }
                break;
            default:
                $color = $this->Color_model->get_color($product['color_id1']);
                $tags[] = ['Color_'.str_replace(' ', '', $color['name'])];
        }

        return $tags;
    }

    /**
     * @param $product
     * @return string
     */
    private function _get_brand_tags(&$product) {
        $brand = $this->Brand_model->get_brand($product['brand_id1']);
        $tags = ['Brand_'.str_replace(' ', '', $brand['name'])];

        switch($product['category']) {
            case 'Washer Dryer Set':
                if($product['brand_id1'] == $product['brand_id2']) {
                    $tags[] = 'Brand_WDMatch';
                } else {
                    $tags[] = 'Brand_WDNoMatch';
                }
                break;
        }

        return $tags;
    }

    /**
     * @param $product
     * @return string
     */
    private function _get_condition_tags(&$product) {
        $condition = $this->Condition_model->get_condition($product['condition_id1']);
        $tags = ['Condition_'.$condition['value']];

        switch($product['category']) {
            case 'Washer Dryer Set':
                if($product['brand_id1'] == $product['brand_id2']) {
                    $tags[] = 'Condition_WDMatch';
                } else {
                    $tags[] = 'Condition_WDNoMatch';
                }
                break;
        }

        return $tags;
    }

    /**
     * @param $product
     * @return array
     */
    private function _get_option_tags(&$product) {
        $options = $this->get_options($product['option_id_arr']);

        $formatted_options = array_map(function($item) {
            return 'Options_'.str_replace(' ', '', $item);
        }, $options);

        switch($product['category']) {
            case 'Washing Machine':
                if($product['cubic_feet1'] >=  3.8) {
                    $formatted_options[] = 'Options_KingSizeComforterWasher';
                }
                break;
            case 'Dryer':
                if($product['cubic_feet1'] >=  7) {
                    $formatted_options[] = 'Options_KingSizeComforterDryer';
                }
                break;
            case 'Washer Dryer Set':
                // Washer Dryer Sets if Washer has Tag: Options_KingSizeComforterWasher, and dryer has tag: Options_KingSizeComforterDryer Then give tag: Options_KingSizeComforterWDSet
                if($product['cubic_feet1'] >= 3.8 && $product['cubic_feet2'] >= 7) {
                    $formatted_options[] = 'Options_KingSizeComforterWDSet';
                } else {
                    if($product['cubic_feet1'] >= 3.8) {
                        $formatted_options[] = 'Options_KingSizeComforterWasher';
                    }
                    if($product['cubic_feet2'] >= 7) {
                        $formatted_options[] = 'Options_KingSizeComforterDryer';
                    }
                }
                break;
        }

        return $formatted_options;
    }

    /**
     * Some accessories tags should be applied when certain options are selected,
     * other accessories tags are applied when certain categories are selected.
     *
     * @param $product
     * @return array
     */
    private function _get_accessories_tags(&$product) {
        $accessory_tags = [];

        switch($product['category']) {

            case 'Refrigerator':
                $accessory_tags = $this->Accessory_model->get_accessories_by_options($product['option_id_arr']);
                if(count($accessory_tags) == 0) {
                    $accessory_tags = ['Accessory_None'];
                }
                break;

            case 'Washing Machine':
                $accessory_tags = $this->Accessory_model->get_accessories_by_category($category_id);
                break;

            case 'Dryer':
                $accessory_tags1 = $this->Accessory_model->get_accessories_by_category($product['category_id1_arr']);
                $accessory_tags2 = $this->Accessory_model->get_accessories_by_options($product['option_id_arr']);
                $accessory_tags = array_merge($accessory_tags1, $accessory_tags2);
                break;

            case 'Microwave':
                $accessory_tags = ['Accessory_None'];
                break;

            case 'Dishwasher':
                $accessory_tags = ['Accessories_DishwasherWaterLine'];
                break;

            case 'Freezer':
                $accessory_tags = $this->Accessory_model->get_accessories_by_options($product['option_id_arr']);
                if(count($accessory_tags) == 0) {
                    $accessory_tags = ['Accessory_None'];
                }
                break;

            case 'Cooktop':
            case 'Walloven':
                $accessory_tags = $this->Accessory_model->get_accessories_by_category($product['category_id1_arr']);
                if(count($accessory_tags) == 0) {
                    $accessory_tags = ['Accessory_None'];
                }
                break;

            case 'Washer Dryer Set':
                break;
        }

        return $accessory_tags;
    }

    /**
     * @param $product
     * @return array
     */
    private function _get_current_model_tags(&$product) {
        switch($product['category']) {
            case 'Washer Dryer Set':
                if($product['current_model1'] == $product['current_model2']) {
                    $tags[] = 'CurrentModel_Yes';
                    $tags[] = 'CurrentModel_WDMatch';
                } else {
                    $tags[] = 'CurrentModel_No';
                    $tags[] = 'CurrentModel_WDNoMatch';
                }
                break;
            default:
                $postfix = $product['current_model1'] ? 'Yes' : 'No';
                $tags = ['CurrentModel_'.$postfix];
        }

        return $tags;
    }

    /**
     * @param $product
     * @return array
     */
    private function _get_cubic_feet_tags(&$product) {

        if($product['cubic_feet1'] > 0) {
            return ['CubicFeet_'.$product['cubic_feet1']];
        } else {
            return ['CubicFeet_None'];
        }
    }

    private function _get_html_description_for_csv(&$product) {

        // TODO: we splitted description for certain categories

        return $product['description'];
    }
}
