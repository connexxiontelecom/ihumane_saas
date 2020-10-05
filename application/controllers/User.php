<?php


class User extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('security');
		$this->load->helper('array');
		$this->load->model('users');
		$this->load->model('logs');
		$this->load->model('employees');
	}

	public function user (){
		$data['active_plan'] = 1;
		$username = $this->session->userdata('user_username');

		if(isset($username)):
			$tenant_id = $this->users->get_user($username)->tenant_id;

			$permission = $this->users->check_permission($username);
			$data['employee_management'] = $permission->employee_management;
			$data['notifications'] = $this->employees->get_notifications(0, $tenant_id);
			$data['payroll_management'] = $permission->payroll_management;
			$data['biometrics'] = $permission->biometrics;
			$data['user_management'] = $permission->user_management;
			$data['configuration'] = $permission->configuration;
			$data['payroll_configuration'] = $permission->payroll_configuration;
			$data['hr_configuration'] = $permission->hr_configuration;


			if($permission->user_management == 1):

				$user_type = $this->users->get_user($username)->user_type;

				if($user_type == 1 || $user_type == 3 || $user_type == 4):

				$data['users'] = $this->users->view_users($tenant_id);
				$data['user_type'] = $user_type;
				$data['notifications'] = $this->employees->get_notifications(0, $tenant_id);
				$data['user_data'] = $this->users->get_user($username);
				$data['csrf_name'] = $this->security->get_csrf_token_name();
				$data['csrf_hash'] = $this->security->get_csrf_hash();

				$this->load->view('user/user', $data);

				else:
					redirect('/access_denied');
				endif;

			else:

				redirect('/access_denied');

			endif;
		else:
			redirect('/login');
		endif;

	}

	public function new_user(){

		$username = $this->session->userdata('user_username');

		if(isset($username)):
			$tenant_id = $this->users->get_user($username)->tenant_id;
			$permission = $this->users->check_permission($username);
			$data['employee_management'] = $permission->employee_management;
			$data['notifications'] = $this->employees->get_notifications(0, $tenant_id);
			$data['payroll_management'] = $permission->payroll_management;
			$data['biometrics'] = $permission->biometrics;
			$data['user_management'] = $permission->user_management;
			$data['configuration'] = $permission->configuration;
			$data['payroll_configuration'] = $permission->payroll_configuration;
			$data['hr_configuration'] = $permission->hr_configuration;

			if($permission->user_management == 1):
				$user_type = $this->users->get_user($username)->user_type;



				if($user_type == 1 || $user_type == 3 || $user_type == 4):

				//$data['users'] = $this->users->view_users();
				$data['user_data'] = $this->users->get_user($username);
				$data['csrf_name'] = $this->security->get_csrf_token_name();
				$data['csrf_hash'] = $this->security->get_csrf_hash();

				$errormsg = ' ';
				$error_msg = array(
					'error' => $errormsg
				);
				$data['error'] = $errormsg;
				$this->load->view('user/new_user', $data);

				else:
					redirect('/access_denied');
				endif;

			else:
				redirect('/access_denied');
			endif;
		else:
			redirect('/login');
		endif;

	}

	public function add_user (){

		$username = $this->session->userdata('user_username');

		if(isset($username)):
			$tenant_id = $this->users->get_user($username)->tenant_id;


			$permission = $this->users->check_permission($username);
			$data['employee_management'] = $permission->employee_management;
			$data['notifications'] = $this->employees->get_notifications(0, $tenant_id);
			$data['payroll_management'] = $permission->payroll_management;
			$data['biometrics'] = $permission->biometrics;
			$data['user_management'] = $permission->user_management;
			$data['payroll_configuration'] = $permission->payroll_configuration;
			$data['hr_configuration'] = $permission->hr_configuration;
			$data['configuration'] = $permission->configuration;
			$data['csrf_name'] = $this->security->get_csrf_token_name();
			$data['csrf_hash'] = $this->security->get_csrf_hash();

			if($permission->user_management == 1):

				$user_username = $this->input->post('username');
				$user_email = $this->input->post('email');
				$user_name = $this->input->post('name');
				$user_password = $this->input->post('password');
				$user_status = $this->input->post('status');

				$employee_management = $this->input->post('employee_management');
				$payroll_management = $this->input->post('payroll_management');
				$biometrics = $this->input->post('biometrics');
				$user_management = $this->input->post('user_management');
				$hr_configuration = $this->input->post('hr_configuration');
				$configuration = $this->input->post('configuration');
				$payroll_configuration = $this->input->post('payroll_configuration');

				if((!isset($user_username)) || (!isset($user_email)) || (!isset($user_password))|| (!isset($user_status))):

					$errormsg = 'Please Fill in All Necessary Fields';
					$error_msg = array(
						'error' => $errormsg
					);
					$data['error'] = $errormsg;

					$this->load->view('user/new_user', $data);


				elseif(($this->users->check_existing_user_email($user_email) > 0 ) || ($this->users->check_existing_user_username($user_username) > 0 ) ):

					$errormsg = 'Username or Email Already Taken';
					$error_msg = array(
						'error' => $errormsg
					);
					$data['error'] = $errormsg;

					$this->load->view('user/new_user', $data);

				elseif((empty($employee_management)) && (empty($payroll_management)) && (empty($biometrics)) && (empty($user_management))):

					$errormsg = 'Please Select At Least One Permission';
					$error_msg = array(
						'error' => $errormsg
					);
					$data['error'] = $errormsg;

					$this->load->view('user/new_user', $data);

				else:

					$user_array = array(
						'user_username'=> $user_username,
						'user_email'=> $user_email,
						'user_password'=> password_hash($user_password, PASSWORD_BCRYPT),
						'user_name'=> $user_name,
						'user_status'=>$user_status,
						'tenant_id' => $tenant_id
					);

					$permission_array = array(
						'username'=> $user_username,
						'employee_management'=> $employee_management,
						'payroll_management'=> $payroll_management,
						'biometrics' => $biometrics,
						'user_management'=> $user_management,
						'configuration' => $configuration,
						'hr_configuration' => $hr_configuration,
						'payroll_configuration' => $payroll_configuration,
						'tenant_id' => $tenant_id
					);

					$user_array = $this->security->xss_clean($user_array);
					$permission_array = $this->security->xss_clean($permission_array);

					$query = $this->users->add($user_array, $permission_array);

					if($query == true):

						$log_array = array(
							'log_user_id' => $this->users->get_user($username)->user_id,
							'log_description' => "Added New User",
							'tenant_id' => $tenant_id
						);

						$this->logs->add_log($log_array);
						$msg = array(
							'msg'=> 'User Created Successfully',
							'location' => site_url('user'),
							'type' => 'success'

						);
						$this->load->view('swal', $msg);

					else:
						echo "An Error Occurred";
					endif;
				endif;

			else:

				redirect('/access_denied');

			endif;
		else:
			redirect('/login');
		endif;




	}

	public function manage_user(){

		error_reporting(0);

		$user_id = $this->uri->segment(2);
		$username = $this->session->userdata('user_username');

		if(isset($username)):
			$tenant_id = $this->users->get_user($username)->tenant_id;
			$permission = $this->users->check_permission($username);

			$permission = $this->users->check_permission($username);
			$data['employee_management'] = $permission->employee_management;
			$data['notifications'] = $this->employees->get_notifications(0, $tenant_id);
			$data['payroll_management'] = $permission->payroll_management;
			$data['biometrics'] = $permission->biometrics;
			$data['user_management'] = $permission->user_management;
			$data['configuration'] = $permission->configuration;
			$data['payroll_configuration'] = $permission->payroll_configuration;
			$data['hr_configuration'] = $permission->hr_configuration;
			$data['csrf_name'] = $this->security->get_csrf_token_name();
			$data['csrf_hash'] = $this->security->get_csrf_hash();


			if($permission->user_management == 1):
				$user_type = $this->users->get_user($username)->user_type;

			if($user_type == 1 || $user_type == 3 || $user_type == 4):

				$data['user_data'] = $this->users->get_user($username);
				$user_datum = $this->users->get_user_id($user_id, $tenant_id);

				if(empty($user_datum)):

					redirect('/access_denied');

				else:
						$data['user_datum'] = $user_datum;
						$errormsg = ' ';
						$error_msg = array(
							'error' => $errormsg
						);
						$data['error'] = $errormsg;

						$check =  $this->employees->get_employee_by_unique($user_datum->user_username, $tenant_id);

						if(empty($check)):

							$check = 0;
							$data['usertype'] = $user_datum->user_type;
						else:
							$check = 1;
						endif;

							$data['check'] = $check;

						$this->load->view('user/manage_user', $data);
					endif;

					else:
						redirect('/access_denied');
					endif;

			else:

				redirect('/access_denied');

			endif;
		else:
			redirect('/login');
		endif;



	}

	public function edit_user (){

		$username = $this->session->userdata('user_username');

		if(isset($username)):

			$tenant_id = $this->users->get_user($username)->tenant_id;
			$permission = $this->users->check_permission($username);
			$data['employee_management'] = $permission->employee_management;
			$data['notifications'] = $this->employees->get_notifications(0, $tenant_id);
			$data['payroll_management'] = $permission->payroll_management;
			$data['biometrics'] = $permission->biometrics;
			$data['user_management'] = $permission->user_management;
			$data['configuration'] = $permission->configuration;
			$data['payroll_configuration'] = $permission->payroll_configuration;
			$data['hr_configuration'] = $permission->hr_configuration;
			$data['csrf_name'] = $this->security->get_csrf_token_name();
			$data['csrf_hash'] = $this->security->get_csrf_hash();



			if($permission->user_management == 1):
				$user_type = $this->users->get_user($username)->user_type;

				if($user_type == 1 || $user_type == 3 || $user_type == 4):

				$user_username = $this->input->post('username');
				$user_email = $this->input->post('email');
				$user_name = $this->input->post('name');
				$user_password = $this->input->post('password');
				$user_id = $this->input->post('user_user_id');

				$user_datum = $this->users->get_user_id($user_id, $tenant_id);

				$user_status = $this->input->post('status');
				$user_type = $this->input->post('user_type');

				$employee_management = $this->input->post('employee_management');
				$payroll_management = $this->input->post('payroll_management');
				$biometrics = $this->input->post('biometrics');
				$user_management = $this->input->post('user_management');
				$hr_configuration = $this->input->post('hr_configuration');
				$configuration = $this->input->post('configuration');
				$payroll_configuration = $this->input->post('payroll_configuration');


				if(empty($user_password)):

					if((!isset($user_username)) || (!isset($user_email))):

						if(empty($user_datum)):

							redirect('/access_denied');

						else:
							$data['user_datum'] = $user_datum;
							$errormsg = 'Email and Username must be Filled';
							$error_msg = array(
								'error' => $errormsg
							);
							$data['error'] = $errormsg;

							$this->load->view('user/manage_user', $data);

						endif;


					elseif((empty($employee_management)) && (empty($payroll_management)) && (empty($biometrics)) && (empty($user_management))):


						if(empty($user_datum)):

							redirect('/access_denied');

						else:
							$data['user_datum'] = $user_datum;
							$errormsg = 'Please Select At Least One Permission';
							$error_msg = array(
								'error' => $errormsg
							);
							$data['error'] = $errormsg;

							$this->load->view('user/manage_user', $data);

						endif;

					else:

						$user_array = array(
							'user_username'=> $user_username,
							'user_email'=> $user_email,
							'user_name'=> $user_name,
							'user_status'=>$user_status,
							'user_type' => $user_type
						);

						$permission_array = array(
							'employee_management'=> $employee_management,
							'payroll_management'=> $payroll_management,
							'biometrics' => $biometrics,
							'user_management'=> $user_management,
							'configuration' => $configuration,
							'hr_configuration' => $hr_configuration,
							'payroll_configuration' => $payroll_configuration
						);

						$user_array = $this->security->xss_clean($user_array);
						$permission_array = $this->security->xss_clean($permission_array);

						$query_user = $this->users->update_user($user_id, $user_array);
						$query_permission = $this->users->update_user_permission($user_username, $permission_array);

						if(($query_user == true) && ($query_permission == true)):
							$log_array = array(
								'log_user_id' => $this->users->get_user($username)->user_id,
								'log_description' => "Updated User"
							);

							$this->logs->add_log($log_array);
							$msg = array(
								'msg'=> 'User Updated Successfully',
								'location' => site_url('user'),
								'type' => 'success'

							);
							$this->load->view('swal', $msg);

						else:
							echo "An Error Occurred";
						endif;


					endif;
			else:

				if((!isset($user_username)) || (!isset($user_email))):

					if(empty($user_datum)):

						redirect('/access_denied');

					else:
						$data['user_datum'] = $user_datum;
						$errormsg = 'Email and Username must be Filled';
						$error_msg = array(
							'error' => $errormsg
						);
						$data['error'] = $errormsg;

						$this->load->view('user/manage_user', $data);

					endif;

				elseif((empty($employee_management)) && (empty($payroll_management)) && (empty($biometrics)) && (empty($user_management))):

					if(empty($user_datum)):

						redirect('/access_denied');

					else:
						$data['user_datum'] = $user_datum;
						$errormsg = 'Please Select At Least One Permission';
						$error_msg = array(
							'error' => $errormsg
						);
						$data['error'] = $errormsg;

						$this->load->view('user/manage_user', $data);

					endif;



				else:

					$user_array = array(
						'user_username'=> $user_username,
						'user_password'=> password_hash($user_password, PASSWORD_BCRYPT),
						'user_email'=> $user_email,
						'user_name'=> $user_name,
						'user_status'=>$user_status,
						'user_type' => $user_type
					);

					$permission_array = array(
						'employee_management'=> $employee_management,
						'payroll_management'=> $payroll_management,
						'biometrics' => $biometrics,
						'user_management'=> $user_management,
						'configuration' => $configuration,
						'hr_configuration' => $hr_configuration,
						'payroll_configuration' => $payroll_configuration
					);

					$user_array = $this->security->xss_clean($user_array);
					$permission_array = $this->security->xss_clean($permission_array);

					$query_user = $this->users->update_user($user_id, $user_array);
					$query_permission = $this->users->update_user_permission($user_username, $permission_array);

						if(($query_user == true) && ($query_permission == true)):
							$log_array = array(
								'log_user_id' => $this->users->get_user($username)->user_id,
								'log_description' => "Updated User (Password)"
							);

							$this->logs->add_log($log_array);
							$msg = array(
								'msg'=> 'User Updated Successfully (Password Inclusive)',
								'location' => site_url('user'),
								'type' => 'success'

							);
							$this->load->view('swal', $msg);

						else:
							echo "An Error Occurred";
						endif;
				endif;

			endif;
		else:

			//echo "got here";
			redirect('/access_denied');
		endif;

			else:

				redirect('/access_denied');

			endif;
		else:
			redirect('/login');
		endif;




	}
}
