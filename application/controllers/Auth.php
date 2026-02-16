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

            if ($this->form_validation->run()) {
                $email = $this->input->post('email', true);
                $customer = $this->customer_model->get_by_email($email);

                if ($customer) {
                    // Generate reset token
                    $token = $this->customer_model->create_reset_token($email);
                    $reset_link = base_url('reset-password/' . $token);

                    // Send email
                    $this->load->library('email');
                    $this->load->config('email');

                    $this->email->from($this->config->item('smtp_user'), 'MopAndClean');
                    $this->email->to($email);
                    $this->email->subject('Reset Your Password - MopAndClean');
                    $this->email->message(
                        '<div style="font-family:Arial,sans-serif;max-width:480px;margin:0 auto;padding:20px;">'
                        . '<div style="text-align:center;padding:20px 0;">'
                        . '<div style="width:50px;height:50px;background:linear-gradient(135deg,#1956A0,#8DC63F);border-radius:12px;display:inline-flex;align-items:center;justify-content:center;color:#fff;font-size:24px;">&#8962;</div>'
                        . '</div>'
                        . '<h2 style="color:#1956A0;text-align:center;margin-bottom:10px;">Reset Your Password</h2>'
                        . '<p style="color:#666;text-align:center;">Hi ' . htmlspecialchars($customer->full_name) . ',</p>'
                        . '<p style="color:#666;text-align:center;">You requested a password reset. Click the button below to set a new password.</p>'
                        . '<div style="text-align:center;margin:30px 0;">'
                        . '<a href="' . $reset_link . '" style="background:#1956A0;color:#fff;padding:14px 32px;border-radius:12px;text-decoration:none;font-weight:600;font-size:16px;display:inline-block;">Reset Password</a>'
                        . '</div>'
                        . '<p style="color:#999;font-size:13px;text-align:center;">This link will expire in 1 hour.</p>'
                        . '<p style="color:#999;font-size:13px;text-align:center;">If you did not request this, please ignore this email.</p>'
                        . '<hr style="border:none;border-top:1px solid #eee;margin:20px 0;">'
                        . '<p style="color:#aaa;font-size:12px;text-align:center;">MopAndClean - Professional Cleaning Services</p>'
                        . '</div>'
                    );

                    if ($this->email->send()) {
                        $data['success'] = 'A password reset link has been sent to your email address. Please check your inbox.';
                    } else {
                        $data['error'] = 'Failed to send email. Please try again later.';
                    }
                } else {
                    // Show success anyway to prevent email enumeration
                    $data['success'] = 'If an account exists with this email, you will receive a password reset link.';
                }
            }
        }

        $this->load->view('layouts/auth_header');
        $this->load->view('auth/forgot_password', $data);
        $this->load->view('layouts/auth_footer');
    }

    public function reset_password($token = null)
    {
        if ($this->session->userdata('customer_id')) {
            redirect('dashboard');
        }

        if (!$token) {
            redirect('login');
        }

        // Verify token
        $reset = $this->customer_model->verify_reset_token($token);
        if (!$reset) {
            $this->session->set_flashdata('error', 'Invalid or expired reset link. Please request a new one.');
            redirect('forgot-password');
        }

        $data = ['error' => '', 'success' => '', 'token' => $token];

        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('new_password', 'New Password', 'required|min_length[6]');
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[new_password]');

            if ($this->form_validation->run()) {
                $new_password = $this->input->post('new_password');
                $this->customer_model->reset_password($reset->email, $new_password);
                $this->customer_model->delete_reset_token($token);

                $this->session->set_flashdata('success', 'Password reset successfully! You can now login with your new password.');
                redirect('login');
            }
        }

        $this->load->view('layouts/auth_header');
        $this->load->view('auth/reset_password', $data);
        $this->load->view('layouts/auth_footer');
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }
}
