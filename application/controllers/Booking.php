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
            $this->form_validation->set_rules('sqft', 'Square Feet', 'trim');
            $this->form_validation->set_rules('sqft_cost', 'Sqft Cost', 'trim');
            $this->form_validation->set_rules('sofa', 'Sofa', 'trim');
            $this->form_validation->set_rules('sofa_cost', 'Sofa Cost', 'trim');
            $this->form_validation->set_rules('others', 'Others', 'trim');
            $this->form_validation->set_rules('others_cost', 'Others Cost', 'trim');
            $this->form_validation->set_rules('comment', 'Comment', 'trim');

            if ($this->form_validation->run()) {
                $sqft = floatval($this->input->post('sqft'));
                $sqft_cost = floatval($this->input->post('sqft_cost'));
                $sub_total = $sqft * $sqft_cost;

                $sofa = floatval($this->input->post('sofa'));
                $sofa_cost = floatval($this->input->post('sofa_cost'));
                $sub_total1 = $sofa * $sofa_cost;

                $others = floatval($this->input->post('others'));
                $others_cost = floatval($this->input->post('others_cost'));
                $sub_total2 = $others * $others_cost;

                $total_cost = $sub_total + $sub_total1 + $sub_total2;

                $job_data = [
                    'customer_id'   => $this->auth_check->customer_id(),
                    'service_id'    => intval($this->input->post('service_id')),
                    'assigned_date' => $this->input->post('assigned_date'),
                    'sqft'          => strval($sqft),
                    'sqft_cost'     => strval($sqft_cost),
                    'sub_total'     => strval($sub_total),
                    'sofa'          => strval($sofa),
                    'sofa_cost'     => strval($sofa_cost),
                    'sub_total1'    => strval($sub_total1),
                    'others'        => strval($others),
                    'others_cost'   => strval($others_cost),
                    'sub_total2'    => strval($sub_total2),
                    'total_cost'    => strval($total_cost),
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
