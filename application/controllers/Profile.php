<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('auth_check');
        $this->auth_check->require_login();
        $this->load->model('customer_model');
    }

    public function index()
    {
        $customer_id = $this->auth_check->customer_id();
        $customer = $this->customer_model->get_by_id($customer_id);

        $data = [
            'customer'   => $customer,
            'page_title' => 'Profile',
            'active_nav' => 'profile',
            'success'    => $this->session->flashdata('success'),
            'error'      => '',
        ];

        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('full_name', 'Full Name', 'required|trim|min_length[2]');
            $this->form_validation->set_rules('phone', 'Phone', 'required|trim|min_length[7]');
            $this->form_validation->set_rules('address', 'Address', 'required|trim');

            if ($this->form_validation->run()) {
                $update_data = [
                    'full_name' => $this->input->post('full_name', true),
                    'phone'     => $this->input->post('phone', true),
                    'address'   => $this->input->post('address', true),
                ];

                if ($this->customer_model->update_profile($customer_id, $update_data)) {
                    $this->session->set_userdata('customer_name', $update_data['full_name']);
                    $this->session->set_flashdata('success', 'Profile updated successfully!');
                    redirect('profile');
                } else {
                    $data['error'] = 'Failed to update profile.';
                }
            }

            $customer->full_name = $this->input->post('full_name', true);
            $customer->phone = $this->input->post('phone', true);
            $customer->address = $this->input->post('address', true);
            $data['customer'] = $customer;
        }

        $this->load->view('layouts/header', $data);
        $this->load->view('profile/index', $data);
        $this->load->view('layouts/footer', $data);
    }

    public function change_password()
    {
        $customer_id = $this->auth_check->customer_id();
        $customer = $this->customer_model->get_by_id($customer_id);

        $data = [
            'page_title' => 'Change Password',
            'active_nav' => 'profile',
            'success'    => '',
            'error'      => '',
        ];

        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('current_password', 'Current Password', 'required');
            $this->form_validation->set_rules('new_password', 'New Password', 'required|min_length[6]');
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[new_password]');

            if ($this->form_validation->run()) {
                $current_password = $this->input->post('current_password');

                if (password_verify($current_password, $customer->password)) {
                    $new_password = $this->input->post('new_password');
                    $this->customer_model->change_password($customer_id, $new_password);
                    $this->session->set_flashdata('success', 'Password changed successfully!');
                    redirect('change-password');
                } else {
                    $data['error'] = 'Current password is incorrect.';
                }
            }
        }

        $data['success'] = $this->session->flashdata('success');

        $this->load->view('layouts/header', $data);
        $this->load->view('profile/change_password', $data);
        $this->load->view('layouts/footer', $data);
    }
}
