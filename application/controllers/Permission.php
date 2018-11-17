<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Permission extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Permission_model');
    } 

    /*
     * Listing of permissions
     */
    function index()
    {
        $data['permissions'] = $this->Permission_model->get_all_permissions();
        
        $data['_view'] = 'permission/index';
        $this->load->view('layouts/main',$data);
    }

    /*
     * Adding a new permission
     */
    function add()
    {   
        if(isset($_POST) && count($_POST) > 0)     
        {   
            $params = array(
				'permission' => $this->input->post('permission'),
				'key' => $this->input->post('key'),
				'category' => $this->input->post('category'),
            );
            
            $permission_id = $this->Permission_model->add_permission($params);
            redirect('permission/index');
        }
        else
        {            
            $data['_view'] = 'permission/add';
            $this->load->view('layouts/main',$data);
        }
    }  

    /*
     * Editing a permission
     */
    function edit($permissionID)
    {   
        // check if the permission exists before trying to edit it
        $data['permission'] = $this->Permission_model->get_permission($permissionID);
        
        if(isset($data['permission']['permissionID']))
        {
            if(isset($_POST) && count($_POST) > 0)     
            {   
                $params = array(
					'permission' => $this->input->post('permission'),
					'key' => $this->input->post('key'),
					'category' => $this->input->post('category'),
                );

                $this->Permission_model->update_permission($permissionID,$params);            
                redirect('permission/index');
            }
            else
            {
                $data['_view'] = 'permission/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The permission you are trying to edit does not exist.');
    } 

    /*
     * Deleting permission
     */
    function remove($permissionID)
    {
        $permission = $this->Permission_model->get_permission($permissionID);

        // check if the permission exists before trying to delete it
        if(isset($permission['permissionID']))
        {
            $this->Permission_model->delete_permission($permissionID);
            redirect('permission/index');
        }
        else
            show_error('The permission you are trying to delete does not exist.');
    }
    
}