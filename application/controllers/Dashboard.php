<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('auth_check');
        $this->auth_check->require_login();
        $this->load->model('job_model');
    }

    public function index()
    {
        $customer_id = $this->auth_check->customer_id();

        $data = [
            'customer_name'   => $this->auth_check->customer_name(),
            'active_bookings' => $this->job_model->get_active_by_customer($customer_id),
            'recent_bookings' => $this->job_model->get_by_customer($customer_id),
            'page_title'      => 'Dashboard',
            'active_nav'      => 'home',
        ];

        $this->load->view('layouts/header', $data);
        $this->load->view('dashboard/index', $data);
        $this->load->view('layouts/footer', $data);
    }
}
