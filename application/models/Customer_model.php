<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function login($email_or_phone, $password)
    {
        $this->db->where('email', $email_or_phone);
        $this->db->or_where('phone', $email_or_phone);
        $query = $this->db->get('customers');

        if ($query->num_rows() === 1) {
            $customer = $query->row();
            if (password_verify($password, $customer->password)) {
                return $customer;
            }
        }
        return false;
    }

    public function register($data)
    {
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        $this->db->insert('customers', $data);
        return $this->db->insert_id();
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('customers', ['id' => $id])->row();
    }

    public function email_exists($email)
    {
        return $this->db->get_where('customers', ['email' => $email])->num_rows() > 0;
    }

    public function phone_exists($phone)
    {
        return $this->db->get_where('customers', ['phone' => $phone])->num_rows() > 0;
    }
}
