<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Permission_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get permission by permissionID
     */
    function get_permission($permissionID)
    {
        return $this->db->get_where('permissions',array('permissionID'=>$permissionID))->row_array();
    }
        
    /*
     * Get all permissions
     */
    function get_all_permissions()
    {
        $this->db->order_by('permissionID', 'desc');
        return $this->db->get('permissions')->result_array();
    }
        
    /*
     * function to add new permission
     */
    function add_permission($params)
    {
        $this->db->insert('permissions',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update permission
     */
    function update_permission($permissionID,$params)
    {
        $this->db->where('permissionID',$permissionID);
        return $this->db->update('permissions',$params);
    }
    
    /*
     * function to delete permission
     */
    function delete_permission($permissionID)
    {
        return $this->db->delete('permissions',array('permissionID'=>$permissionID));
    }
}