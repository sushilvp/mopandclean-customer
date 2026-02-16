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

    public function update_profile($id, $data)
    {
        $data['updated_at'] = date('Y-m-d H:i:s');
        $this->db->where('id', $id);
        return $this->db->update('customers', $data);
    }

    public function change_password($id, $new_password)
    {
        $this->db->where('id', $id);
        return $this->db->update('customers', [
            'password'   => password_hash($new_password, PASSWORD_DEFAULT),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }

    public function get_by_email($email)
    {
        return $this->db->get_where('customers', ['email' => $email])->row();
    }

    public function reset_password($email, $new_password)
    {
        $this->db->where('email', $email);
        return $this->db->update('customers', [
            'password'   => password_hash($new_password, PASSWORD_DEFAULT),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }

    public function create_reset_token($email)
    {
        // Delete any existing tokens for this email
        $this->db->where('email', $email);
        $this->db->delete('password_resets');

        // Create new token
        $token = bin2hex(random_bytes(32));
        $this->db->insert('password_resets', [
            'email'      => $email,
            'token'      => $token,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        return $token;
    }

    public function verify_reset_token($token)
    {
        // Token valid for 1 hour
        $this->db->where('token', $token);
        $this->db->where('created_at >', date('Y-m-d H:i:s', strtotime('-1 hour')));
        $result = $this->db->get('password_resets')->row();
        return $result;
    }

    public function delete_reset_token($token)
    {
        $this->db->where('token', $token);
        $this->db->delete('password_resets');
    }
}
