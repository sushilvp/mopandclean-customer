<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_check {

    protected $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
    }

    public function require_login()
    {
        if (!$this->CI->session->userdata('customer_id')) {
            redirect('login');
        }
    }

    public function is_logged_in()
    {
        return (bool) $this->CI->session->userdata('customer_id');
    }

    public function customer_id()
    {
        return $this->CI->session->userdata('customer_id');
    }

    public function customer_name()
    {
        return $this->CI->session->userdata('customer_name');
    }
}
