<?php


class Backoffices extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('form_validation');
		$this->load->library('session');

	}

	public function add($user_data, $permission_data){

		$this->db->insert('user', $user_data);
		$this->db->insert('permission', $permission_data);
		return true;

	}

	public function view_users(){
		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('permission', 'permission.username = user.user_username');
		$this->db->where('user_status <', 5);
		return $this->db->get()->result();

	}

	public function view_online_users(){
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('user_token !=', ' ');
		$this->db->or_where('user_token !=', null);
		return $this->db->get()->result();
	}

	public function get_user($username){
		$this->db->select('*');
		$this->db->from('user');
		//$this->db->where('user_status >', 0);
		$this->db->where('user_username', $username);
		$query = $this->db->get();
		return $query->row();
	}

	public function get_user_id($user_id){
		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('permission', 'permission.username = user.user_username');
		$this->db->where('user_id', $user_id);
		$query = $this->db->get();
		return $query->row();
	}

	public function login($userdata){
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('user_status >', 0);
		$this->db->where('user_username', $userdata['user_username']);
		$query = $this->db->get();
		if($query->num_rows() == 1):
			$user = $query->row();
			if(password_verify($userdata['password'], $user->user_password)):
				$dat = array(
					'user_username'=> $user->user_username,
					'login_time' => time()
				);
				$this->session->set_userdata($dat);
				return true;
			endif;
		endif;

	}

	public function check_user_login($username){
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('user.user_username', $username);

		$query = 	$this->db->get();
		return $query->row();


	}

	public function update_token($username, $user_token_data){
		$this->db->where('user.user_username', $username);
		$this->db->update('user', $user_token_data);
		return true;
	}

	public function check_permission($username){
		$this->db->select('*');
		$this->db->from('permission');
		$this->db->where('permission.username', $username);
		$query = $this->db->get();
		return $query->row();
	}

	public function check_existing_user_email($email){

		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('user.user_email', $email);
		$query = $this->db->get();
		return $query->num_rows();

	}

	public function check_existing_user_username($username){

		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('user.user_username', $username);
		$query = $this->db->get();
		return $query->num_rows();

	}

	public function update_user($user_id, $user_data){

		$this->db->where('user.user_id', $user_id);
		$this->db->update('user', $user_data);
		return true;


	}

	public function update_user_permission($username, $permission_data){

		$this->db->where('permission.username', $username);
		$this->db->update('permission', $permission_data);
		return true;
	}







}
