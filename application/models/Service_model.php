<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Service_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_all()
    {
        $this->db->order_by('display_order', 'ASC');
        return $this->db->get('service_type')->result();
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('service_type', ['id' => $id])->row();
    }
}
