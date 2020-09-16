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

		$this->db->insert('backoffice_user', $user_data);
		//$this->db->insert('permission', $permission_data);
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
		$this->db->from('backoffice_user');
		$this->db->where('backoffice_user_status >', 0);
		$this->db->where('backoffice_username', $userdata['username']);
		$query = $this->db->get();
		if($query->num_rows() == 1):
			$user = $query->row();
			if(password_verify($userdata['password'], $user->backoffice_user_password)):
				$dat = array(
					'username'=> $user->backoffice_username,
					'login_time' => time()
				);
				$this->session->set_userdata($dat);
				return true;
			endif;
		endif;

	}

	public function check_user_login($username){
		$this->db->select('*');
		$this->db->from('backoffice_user');
		$this->db->where('backoffice_user.backoffice_username', $username);

		$query = 	$this->db->get();
		return $query->row();


	}

	public function update_token($username, $user_token_data){
		$this->db->where('backoffice_user.backoffice_username', $username);
		$this->db->update('backoffice_user', $user_token_data);
		return true;
	}



	public function check_existing_user_email($email){

		$this->db->select('*');
		$this->db->from('backoffice_user');
		$this->db->where('backoffice_user.backoffice_user_email', $email);
		$query = $this->db->get();
		return $query->num_rows();

	}

	public function check_existing_user_username($username){

		$this->db->select('*');
		$this->db->from('backoffice_user');
		$this->db->where('backoffice_user.backoffice_username', $username);
		$query = $this->db->get();
		return $query->num_rows();

	}

	public function update_user($user_id, $user_data){

		$this->db->where('backoffice_user.backoffice_user_id', $user_id);
		$this->db->update('backoffice_user', $user_data);
		return true;


	}


	//plan setup
	public function add_plan($plan_data){

		$this->db->insert('plan', $plan_data);
		return true;

	}

	public function get_plans(){
		$this->db->select('*');
		$this->db->from('plan');
		return $this->db->get()->result();
	}

	public function update_plan($plan_id, $plan_data){

		$this->db->where('plan.plan_id', $plan_id);
		$this->db->update('plan', $plan_data);
		return true;


	}




}
