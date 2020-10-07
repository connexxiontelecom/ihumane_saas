<?php


class Backoffice extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('form_validation');
		$this->load->library('user_agent');
		$this->load->library('session');
		$this->load->helper('security');
		$this->load->helper('string');
		$this->load->helper('array');
		$this->load->model('backoffices');
		$this->load->model('employees');
		$this->load->model('hr_configurations');
		$this->load->model('biometric');
		$this->load->model('logs');
		$this->load->model('backoffices');
	}


	public function index(){

		$username = $this->session->userdata('username');

		if(isset($username)):

				//$permission = $this->backoffices->check_permission($username);
//				$data['employee_management'] = $permission->employee_management;
				$data['notifications'] = $this->employees->get_notifications(0, 0);
//				$data['payroll_management'] = $permission->payroll_management;
//				$data['biometrics'] = $permission->biometrics;
//				$data['user_management'] = $permission->user_management;
//				$data['configuration'] = $permission->configuration;
//				$data['payroll_configuration'] = $permission->payroll_configuration;
//				$data['hr_configuration'] = $permission->hr_configuration;
//				$data['configuration'] = $permission->configuration;
				$data['user_data'] = $this->backoffices->get_user($username);

				//$data['employees'] = $this->employees->view_employees();
				//$data['backoffices'] = $this->backoffices->view_backoffices();
				//$data['departments'] = $this->hr_configurations->view_departments();
				//$data['leaves'] = $this->employees->get_employees_leaves();

				$date = date('Y-m-d', time());
				//$data['present_employees'] = $this->biometric->check_today_attendance($date);
				//$online_backoffices = $this->backoffices->view_online_backoffices();

				//$data['online_backoffices'] = $online_backoffices;
				$this->load->view('backoffice/index', $data);

		//echo $username;




		else:
			redirect('backoffice_login');
		endif;

	}

	public function logout(){

		$username = $this->session->userdata('username');

		if(isset($username)):

//			$log_array = array(
//				'log_user_id' => $this->backoffices->get_user($user_username)->user_id,
//				'log_description' => "Logged Out"
//			);
//
//			$query = $this->logs->add_log($log_array);



				$user_token_data = array(
					'backoffice_user_token' => null,
				);
				$user_token_data = $this->security->xss_clean($user_token_data);
				$this->backoffices->update_token($username, $user_token_data);
				$this->session->unset_userdata('username');
				$this->session->unset_userdata('login_time');
				$this->session->sess_destroy();
				redirect('backoffice_login');


		else:
			redirect('/access_denied');

		endif;


	}

	public function auth_login(){

		$username = $this->session->userdata('username');



		if(isset($username)):
			redirect('backoffice');
		else:

			$username = $this->input->post('username');
			$password = $this->input->post('password');

			if(empty($username) || empty($password)):
				$errormsg = ' ';
				$error_msg = array('error' => $errormsg);
				$data['error'] = $errormsg;

				$data['csrf_name'] = $this->security->get_csrf_token_name();
				$data['csrf_hash'] = $this->security->get_csrf_hash();

				$this->load->view('backoffice/login', $data);
			else:
				$data = array(
					'username' => $username,
					'password' => $password
				);
				$data = $this->security->xss_clean($data);

				$query = $this->backoffices->login($data);
				$time = time();
				if($query == true):
					if($this->backoffices->get_user($username)->user_status > 0):

						$check_user_login = $this->backoffices->check_user_login($username);
						$user_token = $check_user_login->backoffice_user_token;

						if(empty($user_token)):
							$user_token_data = array(
								'backoffice_user_token' => $time
							);
							$user_token_data = $this->security->xss_clean($user_token_data);
							$query = $this->backoffices->update_token($username, $user_token_data);

							if($query == true):
								$log_array = array(
									'log_user_id' => $this->backoffices->get_user($username)->user_id,
									'log_description' => "Logged In"
								);

								//$this->logs->add_log($log_array);

								redirect('backoffice');

							endif;
						else:
							$diff = $time - $user_token;

							if($diff < 1800):
								$this->session->unset_userdata('user_username');
								$this->session->sess_destroy();
								$errormsg = 'You are Already Logged in';
								$error_msg = array(
									'error' => $errormsg
								);

								$data['error'] = $errormsg;

								$data['csrf_name'] = $this->security->get_csrf_token_name();
								$data['csrf_hash'] = $this->security->get_csrf_hash();

								$this->load->view('backoffice/login', $data);
							elseif ($diff >=1800):
								$user_token_data = array(
									'backoffice_user_token' => $time
								);
								$user_token_data = $this->security->xss_clean($user_token_data);
								$query = $this->backoffices->update_token($username, $user_token_data);
								if($query == true):


									$log_array = array(
										'log_user_id' => $this->backoffices->get_user($username)->user_id,
										'log_description' => "Logged In"
									);

									//$this->logs->add_log($log_array);
									redirect('backoffice');
										endif;
							endif;

						endif;
					else:
						$errormsg = 'Account Deactivated';
						$error_msg = array(
							'error' => $errormsg
						);
						$data['error'] = $errormsg;

						$data['csrf_name'] = $this->security->get_csrf_token_name();
						$data['csrf_hash'] = $this->security->get_csrf_hash();

						$this->load->view('backoffice/login', $data);

					endif;
				else:
					$errormsg = 'Invalid Username or Password     ';
					$error_msg = array(
						'error' => $errormsg
					);
					$data['error'] = $errormsg;

					$data['csrf_name'] = $this->security->get_csrf_token_name();
					$data['csrf_hash'] = $this->security->get_csrf_hash();

					$this->load->view('backoffice/login', $data);


				endif;
			endif;
		endif;

	}


	public function error_404(){

		$username = $this->session->userdata('username');

		if(isset($username)):

			$this->load->view('backoffice/error_404');


		else:
			redirect('/login');

		endif;


	}

	public function plans(){

		$username = $this->session->userdata('username');

		if(isset($username)):


			$data['notifications'] = $this->employees->get_notifications(0, 0);

			$data['plans'] = $this->backoffices->get_plans();

			$data['user_data'] = $this->backoffices->get_user($username);
			$data['csrf_name'] = $this->security->get_csrf_token_name();
			$data['csrf_hash'] = $this->security->get_csrf_hash();
			$date = date('Y-m-d', time());

			$this->load->view('backoffice/plans', $data);

		//echo $username;




		else:
			redirect('backoffice_login');
		endif;

	}

	public function new_plan(){

		$username = $this->session->userdata('username');

		if(isset($username)):


			$data['notifications'] = $this->employees->get_notifications(0, 0);

			$data['user_data'] = $this->backoffices->get_user($username);
			$data['csrf_name'] = $this->security->get_csrf_token_name();
			$data['csrf_hash'] = $this->security->get_csrf_hash();
			$date = date('Y-m-d', time());

			$this->load->view('backoffice/new_plan', $data);

		//echo $username;




		else:
			redirect('backoffice_login');
		endif;

	}

	public function add_plan(){
		$username = $this->session->userdata('username');

		if(isset($username)):
			$method = $this->input->server('REQUEST_METHOD');
			if($method == 'POST' || $method == 'Post' || $method == 'post'):

				extract($_POST);
				$plan_price = str_replace( ',', '', $plan_price);
				$plan_array = array(
					'plan_name' => $plan_name,
					'plan_price' => $plan_price,
					'plan_description' => $plan_description,
					'plan_duration' => $plan_duration
				);

				$plan_array = $this->security->xss_clean($plan_array);

				$query = $this->backoffices->add_plan($plan_array);

				if($query == true):

					$msg = array(
						'msg'=> 'Plan Added Successfully',
						'location' => site_url('plans'),
						'type' => 'success'

					);
					$this->load->view('swal', $msg);

				else:
						$msg = array(
							'msg'=> 'An Error Occurred',
							'location' => site_url('plans'),
							'type' => 'error'

						);
						$this->load->view('swal', $msg);

				endif;

			else:

				redirect('backoffice_404');


			endif;



		//$this->load->view('backoffice/new_plan', $data);

		//echo $username;




		else:
			redirect('backoffice_login');
		endif;


	}

	public function update_plan(){
		$username = $this->session->userdata('username');

		if(isset($username)):
			$method = $this->input->server('REQUEST_METHOD');
			if($method == 'POST' || $method == 'Post' || $method == 'post'):

				extract($_POST);
				$plan_price = str_replace( ',', '', $plan_price);
				$plan_array = array(
					'plan_name' => $plan_name,
					'plan_price' => $plan_price,
					'plan_description' => $plan_description,
					'plan_duration' => $plan_duration
				);

				$plan_array = $this->security->xss_clean($plan_array);

				$query = $this->backoffices->update_plan($plan_id, $plan_array);

				if($query == true):

					$msg = array(
						'msg'=> 'Plan Updated Successfully',
						'location' => site_url('plans'),
						'type' => 'success'

					);
					$this->load->view('swal', $msg);

				else:
					$msg = array(
						'msg'=> 'An Error Occurred',
						'location' => site_url('plans'),
						'type' => 'error'

					);
					$this->load->view('swal', $msg);

				endif;

			else:

				redirect('backoffice_404');


			endif;



		//$this->load->view('backoffice/new_plan', $data);

		//echo $username;




		else:
			redirect('backoffice_login');
		endif;


	}

	public function get_plan(){
		$plan_id = $this->input->post('plan_id');
		echo json_encode($this->backoffices->get_plan($plan_id));

	}

	public function active_subscriptions(){
		$username = $this->session->userdata('username');

		if(isset($username)):


			$data['notifications'] = $this->employees->get_notifications(0, 0);
			$data['active_subscriptions'] = $this->backoffices->view_active_subscriptions();

			$data['user_data'] = $this->backoffices->get_user($username);
			$data['csrf_name'] = $this->security->get_csrf_token_name();
			$data['csrf_hash'] = $this->security->get_csrf_hash();
			//$date = date('Y-m-d', time());

			$this->load->view('backoffice/active_subscriptions', $data);

		//echo $username;




		else:
			redirect('backoffice_login');
		endif;

	}

	public function update_subscription(){
		$username = $this->session->userdata('username');

		if(isset($username)):
			$method = $this->input->server('REQUEST_METHOD');
			if($method == 'POST' || $method == 'Post' || $method == 'post'):

				extract($_POST);

				$subscription_detail = $this->backoffices->get_subscription($subscription_id);

				if($subscription_end_date < $subscription_detail->subscription_end_date || $subscription_end_date < $subscription_detail->subscription_start_date):

					$msg = array(
						'msg'=> 'Please enter a date greater than End Date and Start Date',
						'location' => site_url('active_subscriptions'),
						'type' => 'warning'

					);
					$this->load->view('swal', $msg);

					else:

					$subscription_array = array(

					'subscription_end_date' => $subscription_end_date
				);

				$subscription_array = $this->security->xss_clean($subscription_array);

				$query = $this->backoffices->update_subscription($subscription_array, $subscription_id);

				if($query == true):

					$msg = array(
						'msg'=> 'Subscription Extended Successfully',
						'location' => site_url('active_subscriptions'),
						'type' => 'success'

					);
					$this->load->view('swal', $msg);

				else:
					$msg = array(
						'msg'=> 'An Error Occurred',
						'location' => site_url('active_subscriptions'),
						'type' => 'error'

					);
					$this->load->view('swal', $msg);

				endif;

				endif;

			else:

				redirect('backoffice_404');


			endif;



		//$this->load->view('backoffice/new_plan', $data);

		//echo $username;




		else:
			redirect('backoffice_login');
		endif;


	}

	public function expiring_subscriptions(){
		$username = $this->session->userdata('username');

		if(isset($username)):


			$data['notifications'] = $this->employees->get_notifications(0, 0);
			$data['subscriptions'] = $this->backoffices->view_subscriptions();

			$data['user_data'] = $this->backoffices->get_user($username);
			$data['csrf_name'] = $this->security->get_csrf_token_name();
			$data['csrf_hash'] = $this->security->get_csrf_hash();
			//$date = date('Y-m-d', time());

			$this->load->view('backoffice/expiring_subscriptions', $data);

		//echo $username;




		else:
			redirect('backoffice_login');
		endif;

	}

	public function tenants(){
		$username = $this->session->userdata('username');

		if(isset($username)):


			$data['notifications'] = $this->employees->get_notifications(0, 0);
			$data['tenants'] = $this->backoffices->get_tenants();

			$data['user_data'] = $this->backoffices->get_user($username);
			$data['csrf_name'] = $this->security->get_csrf_token_name();
			$data['csrf_hash'] = $this->security->get_csrf_hash();
			//$date = date('Y-m-d', time());

			$this->load->view('backoffice/tenants', $data);

		//echo $username;




		else:
			redirect('backoffice_login');
		endif;


	}

	public function tenant_subscriptions(){


		$username = $this->session->userdata('username');

		if(isset($username)):

			$tenant_id = $this->uri->segment(2);

			$check_tenant = $this->backoffices->get_tenant($tenant_id);

			if(empty($check_tenant)):

				$this->load->view('backoffice/error_404');

				else:

			$data['notifications'] = $this->employees->get_notifications(0, 0);
			$data['tenants'] = $this->backoffices->get_tenants();
			$data['subscriptions'] = $this->backoffices->view_subscriptions_tenant($tenant_id);
			$data['tenant_details'] = $check_tenant;
			$data['user_data'] = $this->backoffices->get_user($username);
			$data['csrf_name'] = $this->security->get_csrf_token_name();
			$data['csrf_hash'] = $this->security->get_csrf_hash();
			//$date = date('Y-m-d', time());

			$this->load->view('backoffice/tenant_subscriptions', $data);

			endif;

		//echo $username;




		else:
			redirect('backoffice_login');
		endif;



	}


}
