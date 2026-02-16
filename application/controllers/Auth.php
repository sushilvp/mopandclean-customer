<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('customer_model');
    }

    public function login()
    {
        // Redirect if already logged in
        if ($this->session->userdata('customer_id')) {
            redirect('dashboard');
        }

        $data = ['error' => ''];

        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('email_or_phone', 'Email or Phone', 'required|trim');
            $this->form_validation->set_rules('password', 'Password', 'required');

            if ($this->form_validation->run()) {
                $email_or_phone = $this->input->post('email_or_phone', true);
                $password = $this->input->post('password');

                $customer = $this->customer_model->login($email_or_phone, $password);

                if ($customer) {
                    $this->session->set_userdata([
                        'customer_id'   => $customer->id,
                        'customer_name' => $customer->full_name,
                        'customer_email'=> $customer->email,
                    ]);
                    redirect('dashboard');
                } else {
                    $data['error'] = 'Invalid email/phone or password.';
                }
            }
        }

        $this->load->view('layouts/auth_header');
        $this->load->view('auth/login', $data);
        $this->load->view('layouts/auth_footer');
    }

    public function register()
    {
        if ($this->session->userdata('customer_id')) {
            redirect('dashboard');
        }

        $data = ['error' => ''];

        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('full_name', 'Full Name', 'required|trim|min_length[2]');
            $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
            $this->form_validation->set_rules('phone', 'Phone', 'required|trim|min_length[7]');
            $this->form_validation->set_rules('address', 'Address', 'required|trim');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');

            if ($this->form_validation->run()) {
                $email = $this->input->post('email', true);
                $phone = $this->input->post('phone', true);

                if ($this->customer_model->email_exists($email)) {
                    $data['error'] = 'Email already registered.';
                } elseif ($this->customer_model->phone_exists($phone)) {
                    $data['error'] = 'Phone number already registered.';
                } else {
                    $customer_data = [
                        'full_name' => $this->input->post('full_name', true),
                        'email'     => $email,
                        'phone'     => $phone,
                        'address'   => $this->input->post('address', true),
                        'password'  => $this->input->post('password'),
                    ];

                    $customer_id = $this->customer_model->register($customer_data);

                    if ($customer_id) {
                        $this->session->set_userdata([
                            'customer_id'   => $customer_id,
                            'customer_name' => $customer_data['full_name'],
                            'customer_email'=> $customer_data['email'],
                        ]);
                        redirect('dashboard');
                    } else {
                        $data['error'] = 'Registration failed. Please try again.';
                    }
                }
            }
        }

        $this->load->view('layouts/auth_header');
        $this->load->view('auth/register', $data);
        $this->load->view('layouts/auth_footer');
    }

    public function forgot_password()
    {
        if ($this->session->userdata('customer_id')) {
            redirect('dashboard');
        }

        $data = ['error' => '', 'success' => ''];

        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
            $this->form_validation->set_rules('new_password', 'New Password', 'required|min_length[6]');
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[new_password]');

            if ($this->form_validation->run()) {
                $email = $this->input->post('email', true);
                $customer = $this->customer_model->get_by_email($email);

                if ($customer) {
                    $new_password = $this->input->post('new_password');
                    $this->customer_model->reset_password($email, $new_password);
                    $data['success'] = 'Password reset successfully! You can now login.';
                } else {
                    $data['error'] = 'No account found with this email address.';
                }
            }
        }

        $this->load->view('layouts/auth_header');
        $this->load->view('auth/forgot_password', $data);
        $this->load->view('layouts/auth_footer');
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }
}
