<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('auth_check');
        $this->auth_check->require_login();
        $this->load->model('job_model');
        $this->load->model('service_model');
    }

    public function create()
    {
        $data = [
            'services'   => $this->service_model->get_all(),
            'page_title' => 'Book a Service',
            'active_nav' => 'book',
            'success'    => '',
            'error'      => '',
        ];

        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('service_id', 'Service Type', 'required|integer');
            $this->form_validation->set_rules('assigned_date', 'Date', 'required');
            $this->form_validation->set_rules('comment', 'Comment', 'trim');

            if ($this->form_validation->run()) {
                $job_data = [
                    'customer_id'   => $this->auth_check->customer_id(),
                    'service_id'    => intval($this->input->post('service_id')),
                    'assigned_date' => $this->input->post('assigned_date'),
                    'comment'       => $this->input->post('comment', true),
                    'status_id'     => 1, // Pending
                ];

                $job_id = $this->job_model->create($job_data);

                if ($job_id) {
                    $this->session->set_flashdata('success', 'Booking created successfully! Your booking ID is #' . $job_id);
                    redirect('book');
                } else {
                    $data['error'] = 'Failed to create booking. Please try again.';
                }
            }
        }

        $data['success'] = $this->session->flashdata('success');

        $this->load->view('layouts/header', $data);
        $this->load->view('booking/create', $data);
        $this->load->view('layouts/footer', $data);
    }

    public function history()
    {
        $customer_id = $this->auth_check->customer_id();

        $data = [
            'bookings'   => $this->job_model->get_by_customer($customer_id),
            'page_title' => 'Booking History',
            'active_nav' => 'history',
        ];

        $this->load->view('layouts/header', $data);
        $this->load->view('booking/history', $data);
        $this->load->view('layouts/footer', $data);
    }

    public function detail($id)
    {
        $customer_id = $this->auth_check->customer_id();
        $booking = $this->job_model->get_by_id($id, $customer_id);

        if (!$booking) {
            show_404();
        }

        $data = [
            'booking'    => $booking,
            'page_title' => 'Booking #' . $id,
            'active_nav' => '',
        ];

        $this->load->view('layouts/header', $data);
        $this->load->view('booking/detail', $data);
        $this->load->view('layouts/footer', $data);
    }
}
