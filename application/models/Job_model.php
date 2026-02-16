<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Job_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function create($data)
    {
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        $this->db->insert('jobs', $data);
        return $this->db->insert_id();
    }

    public function get_by_customer($customer_id)
    {
        $this->db->select('jobs.*, service_type.name as service_name, status_type.name as status_name');
        $this->db->from('jobs');
        $this->db->join('service_type', 'service_type.id = jobs.service_id', 'left');
        $this->db->join('status_type', 'status_type.id = jobs.status_id', 'left');
        $this->db->where('jobs.customer_id', $customer_id);
        $this->db->order_by('jobs.created_at', 'DESC');
        return $this->db->get()->result();
    }

    public function get_active_by_customer($customer_id)
    {
        $this->db->select('jobs.*, service_type.name as service_name, status_type.name as status_name');
        $this->db->from('jobs');
        $this->db->join('service_type', 'service_type.id = jobs.service_id', 'left');
        $this->db->join('status_type', 'status_type.id = jobs.status_id', 'left');
        $this->db->where('jobs.customer_id', $customer_id);
        $this->db->where_in('jobs.status_id', [1, 2, 3]); // Pending, Confirmed, In Progress
        $this->db->order_by('jobs.created_at', 'DESC');
        return $this->db->get()->result();
    }

    public function get_past_by_customer($customer_id)
    {
        $this->db->select('jobs.*, service_type.name as service_name, status_type.name as status_name');
        $this->db->from('jobs');
        $this->db->join('service_type', 'service_type.id = jobs.service_id', 'left');
        $this->db->join('status_type', 'status_type.id = jobs.status_id', 'left');
        $this->db->where('jobs.customer_id', $customer_id);
        $this->db->where_in('jobs.status_id', [4, 5]); // Completed, Cancelled
        $this->db->order_by('jobs.created_at', 'DESC');
        return $this->db->get()->result();
    }

    public function get_by_id($id, $customer_id)
    {
        $this->db->select('jobs.*, service_type.name as service_name, status_type.name as status_name');
        $this->db->from('jobs');
        $this->db->join('service_type', 'service_type.id = jobs.service_id', 'left');
        $this->db->join('status_type', 'status_type.id = jobs.status_id', 'left');
        $this->db->where('jobs.id', $id);
        $this->db->where('jobs.customer_id', $customer_id);
        return $this->db->get()->row();
    }
}
