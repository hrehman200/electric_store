<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 24/11/2018
 * Time: 12:05 PM
 */
class Auth_Controller extends CI_Controller
{

    function __construct() {
        parent::__construct();
        if (!$this->session->userdata('user_id')) {
            redirect('login');
        }
    }
}