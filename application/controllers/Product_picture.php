<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
require_once __DIR__.'/Auth_Controller.php';

class Product_picture extends Auth_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('Product_picture_model');
    } 

    /*
     * Listing of product_pictures
     */
    function index()
    {
        $data['product_pictures'] = $this->Product_picture_model->get_all_product_pictures();
        
        $data['_view'] = 'product_picture/index';
        $this->load->view('layouts/main',$data);
    }

    /*
     * Adding a new product_picture
     */
    function add()
    {   
        $this->load->library('form_validation');

		$this->form_validation->set_rules('name','Name','max_length[255]');
		
		if($this->form_validation->run())     
        {   
            $params = array(
				'product_id' => $this->input->post('product_id'),
				'type' => $this->input->post('type'),
				'name' => $this->input->post('name'),
				'description' => $this->input->post('description'),
            );
            
            $product_picture_id = $this->Product_picture_model->add_product_picture($params);
            redirect('product_picture/index');
        }
        else
        {
			$this->load->model('Product_model');
			$data['all_products'] = $this->Product_model->get_all_products();
            
            $data['_view'] = 'product_picture/add';
            $this->load->view('layouts/main',$data);
        }
    }  

    /*
     * Editing a product_picture
     */
    function edit($id)
    {   
        // check if the product_picture exists before trying to edit it
        $data['product_picture'] = $this->Product_picture_model->get_product_picture($id);
        
        if(isset($data['product_picture']['id']))
        {
            $this->load->library('form_validation');

			$this->form_validation->set_rules('name','Name','max_length[255]');
		
			if($this->form_validation->run())     
            {   
                $params = array(
					'product_id' => $this->input->post('product_id'),
					'type' => $this->input->post('type'),
					'name' => $this->input->post('name'),
					'description' => $this->input->post('description'),
                );

                $this->Product_picture_model->update_product_picture($id,$params);            
                redirect('product_picture/index');
            }
            else
            {
				$this->load->model('Product_model');
				$data['all_products'] = $this->Product_model->get_all_products();

                $data['_view'] = 'product_picture/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The product_picture you are trying to edit does not exist.');
    } 

    /*
     * Deleting product_picture
     */
    function remove($id)
    {
        $product_picture = $this->Product_picture_model->get_product_picture($id);

        // check if the product_picture exists before trying to delete it
        if(isset($product_picture['id']))
        {
            $this->Product_picture_model->delete_product_picture($id);
            redirect('product_picture/index');
        }
        else
            show_error('The product_picture you are trying to delete does not exist.');
    }
    
}
