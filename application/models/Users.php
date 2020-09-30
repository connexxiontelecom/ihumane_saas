<?php


class Users extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('form_validation');
		$this->load->library('session');

	}

	public function new_subscription($subscription_data){

		$this->db->insert('subscription', $subscription_data);
		return true;

	}

	public function get_sub_status($tenant_id){
		$this->db->select('*');
		$this->db->from('subscription');
		$this->db->where('subscription_tenant_id', $tenant_id);
		$this->db->where('subscription_status', 1);

		$query = $this->db->get();
		return $query->result();

	}

	public function get_sub_true_status($tenant_id){
		$this->db->select('*');
		$this->db->from('subscription');
		$this->db->where('subscription_tenant_id', $tenant_id);
		$this->db->where('subscription_status >', 0);

		return $this->db->get()->result();
	}

	public function get_sub($tenant_id){
		$this->db->select('*');
		$this->db->from('subscription');
		$this->db->where('subscription_tenant_id', $tenant_id);
		$this->db->join('plan', 'plan.plan_id = subscription.subscription_plan_id');
		$this->db->order_by('subscription_id', 'desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function update_subscription($subscription_id, $subscription_data){
		$this->db->where('subscription.subscription_id', $subscription_id);
		$this->db->update('subscription', $subscription_data);
		return true;
	}

	public function get_sub_details($sub_id){
		$this->db->select('*');
		$this->db->from('subscription');
		$this->db->where('subscription_id', $sub_id);
		return $this->db->get()->row();
	}



	public function get_tenant($tenant_id){
		$this->db->select('*');
		$this->db->from('tenant');
		$this->db->where('tenant_id', $tenant_id);
		$query = $this->db->get();
		return $query->row();


	}

	public function add($user_data, $permission_data){

		 $this->db->insert('user', $user_data);
		 $this->db->insert('permission', $permission_data);
		 return true;

	}

	public function add_new_tenant($tenant_data){
		$this->db->insert('tenant', $tenant_data);
		return $this->db->insert_id();
	}

	public function get_tenant_username($username){
		$this->db->select('*');
		$this->db->from('tenant');
		$this->db->where('tenant_username', $username);
		$query = $this->db->get();
		return $query->row();
	}

	public function get_tenant_email($email){
		$this->db->select('*');
		$this->db->from('tenant');
		$this->db->where('tenant_contact_email', $email);
		$query = $this->db->get();
		return $query->row();
	}

	public function view_users($tenant_id){
		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('permission', 'permission.username = user.user_username');
		$this->db->where('user_status <', 5);
		$this->db->where('user.tenant_id', $tenant_id);
		return $this->db->get()->result();

	}

	public function view_online_users(){
	  $this->db->select('*');
    $this->db->from('user');
		return $this->db->get()->result();
  }

	public function get_user($username){
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('user_username', $username);
		$query = $this->db->get();
		return $query->row();
	}

	public function get_user_id($user_id, $tenant_id){
		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('permission', 'permission.username = user.user_username');
		$this->db->where('user_id', $user_id);
		$this->db->where('user.tenant_id', $tenant_id);
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
