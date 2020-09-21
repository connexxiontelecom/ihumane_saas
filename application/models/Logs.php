<?php


class Logs extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('form_validation');
		$this->load->library('session');

	}
	public function add_log($log_data){

		$this->db->insert('logs', $log_data);
		return true;
	}

	public function view_logs($tenant_id){

		$this->db->select('*');
		$this->db->from('logs');
		$this->db->join('user', 'user.user_id = logs.log_user_id');
		$this->db->where('logs.tenant_id', $tenant_id);
		$this->db->order_by('log_date', 'desc');
		return  $this->db->get()->result();
	}
}
