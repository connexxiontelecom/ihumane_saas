<?php


class Hr_configuration extends CI_Controller
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
		$this->load->model('hr_configurations');
		$this->load->model('logs');
		$this->load->model('employees');
		//$data['notifications'] = $this->employees->get_notifications(0);

	}

	public function bank(){

		$username = $this->session->userdata('user_username');

		if(isset($username)):
			$user_type = $this->users->get_user($username)->user_type;

			if($user_type == 1 || $user_type == 3 || $user_type == 4):

				$tenant_id = $this->users->get_user($username)->tenant_id;
				$sub_status = $this->users->get_sub_status($tenant_id);

			if(!empty($sub_status)):
			$permission = $this->users->check_permission($username);
			$data['employee_management'] = $permission->employee_management;
			$data['notifications'] = $this->employees->get_notifications(0);
			$data['payroll_management'] = $permission->payroll_management;
			$data['biometrics'] = $permission->biometrics;
			$data['user_management'] = $permission->user_management;
			$data['configuration'] = $permission->configuration;
			$data['payroll_configuration'] = $permission->payroll_configuration;
			$data['hr_configuration'] = $permission->hr_configuration;

			if($permission->hr_configuration == 1):

				$data['user_data'] = $this->users->get_user($username);

				$data['banks'] = $this->hr_configurations->view_banks($tenant_id);
				$data['csrf_name'] = $this->security->get_csrf_token_name();
				$data['csrf_hash'] = $this->security->get_csrf_hash();



				$this->load->view('hr_config/bank', $data);
				else:
					redirect('/access_denied');

				endif;

				else:
					redirect('/subscription_status');
				endif;

			else:

				redirect('/access_denied');

			endif;
		else:
			redirect('/login');
		endif;

	}

	public function add_bank(){
		$username = $this->session->userdata('user_username');

		if(isset($username)):
			$tenant_id = $this->users->get_user($username)->tenant_id;
			$method = $this->input->server('REQUEST_METHOD');
			if($method == 'POST' || $method == 'Post' || $method == 'post'):

			$permission = $this->users->check_permission($username);
			$data['employee_management'] = $permission->employee_management;
			$data['notifications'] = $this->employees->get_notifications(0);
			$data['payroll_management'] = $permission->payroll_management;
			$data['biometrics'] = $permission->biometrics;
			$data['user_management'] = $permission->user_management;
			$data['configuration'] = $permission->configuration;
			$data['payroll_configuration'] = $permission->payroll_configuration;
			$data['hr_configuration'] = $permission->hr_configuration;

			if($permission->hr_configuration == 1):

				$data['user_data'] = $this->users->get_user($username);
				$bank_name = $this->input->post('bank_name');
				$bank_code = $this->input->post('bank_code');
				$bank_array = array(
					'bank_name'=>$bank_name,
					'bank_code' => $bank_code,
					'tenant_id' => $tenant_id
				);
				$bank_array = $this->security->xss_clean($bank_array);
				$query = $this->hr_configurations->add_bank($bank_array);

				if($query == true):
				$log_array = array( 'tenant_id' => $tenant_id,
						'log_user_id' => $this->users->get_user($username)->user_id,
						'log_description' => "Added A New Bank"
						
					);

					$this->logs->add_log($log_array);
					$msg = array(
						'msg'=> 'Bank Added Successfully',
						'location' => site_url('bank'),
						'type' => 'success'

					);
					$this->load->view('swal', $msg);

				else:
					echo "An Error Occurred";
				endif;

			else:

				redirect('/access_denied');

			endif;

			else:
				redirect('error_404');
				endif;
		else:
			redirect('/login');
		endif;

	}

	public function update_bank(){
		$username = $this->session->userdata('user_username');

		if(isset($username)):

			$method = $this->input->server('REQUEST_METHOD');
			if($method == 'POST' || $method == 'Post' || $method == 'post'):

				$tenant_id = $this->users->get_user($username)->tenant_id;
			$permission = $this->users->check_permission($username);
			$data['employee_management'] = $permission->employee_management;
			$data['notifications'] = $this->employees->get_notifications(0);
			$data['payroll_management'] = $permission->payroll_management;
			$data['biometrics'] = $permission->biometrics;
			$data['user_management'] = $permission->user_management;
			$data['configuration'] = $permission->configuration;
			$data['payroll_configuration'] = $permission->payroll_configuration;
			$data['hr_configuration'] = $permission->hr_configuration;

			if($permission->hr_configuration == 1):

				$data['user_data'] = $this->users->get_user($username);
				$bank_name = $this->input->post('bank_name');
				$bank_id = $this->input->post('bank_id');
				$bank_name = $this->input->post('bank_name');
				$bank_code = $this->input->post('bank_code');
				$bank_array = array(
					'bank_name'=>$bank_name,
					'bank_code' => $bank_code
				);
				$bank_array = $this->security->xss_clean($bank_array);
				$query = $this->hr_configurations->update_bank($bank_id, $bank_array);

				if($query == true):
				$log_array = array( 'tenant_id' => $tenant_id,
						'log_user_id' => $this->users->get_user($username)->user_id,
						'log_description' => "Updated Bank Details"
					);

					$this->logs->add_log($log_array);
					$msg = array(
						'msg'=> 'Bank Updated Successfully',
						'location' => site_url('bank'),
						'type' => 'success'

					);
					$this->load->view('swal', $msg);

				else:
					echo "An Error Occurred";
				endif;

			else:

				redirect('/access_denied');

			endif;

			else:

				redirect('error_404');
				endif;
		else:
			redirect('/login');
		endif;

	}

	public function location(){

		$username = $this->session->userdata('user_username');

		if(isset($username)):
			$user_type = $this->users->get_user($username)->user_type;

			if($user_type == 1 || $user_type == 3 || $user_type == 4):

				$tenant_id = $this->users->get_user($username)->tenant_id;
				$sub_status = $this->users->get_sub_status($tenant_id);

				if(!empty($sub_status)):
			$permission = $this->users->check_permission($username);
			$data['employee_management'] = $permission->employee_management;
$data['notifications'] = $this->employees->get_notifications(0);
			$data['payroll_management'] = $permission->payroll_management;
			$data['biometrics'] = $permission->biometrics;
			$data['user_management'] = $permission->user_management;
			$data['configuration'] = $permission->configuration;
			$data['payroll_configuration'] = $permission->payroll_configuration;
			$data['hr_configuration'] = $permission->hr_configuration;

			if($permission->hr_configuration == 1):

				$data['user_data'] = $this->users->get_user($username);

				$data['locations'] = $this->hr_configurations->view_locations($tenant_id);
				$data['csrf_name'] = $this->security->get_csrf_token_name();
				$data['csrf_hash'] = $this->security->get_csrf_hash();



				$this->load->view('hr_config/location', $data);

				else:
					redirect('/access_denied');
				 endif;

				 else:
					 redirect('subscription_status');

					 endif;

			else:

				redirect('/access_denied');

			endif;
		else:
			redirect('/login');
		endif;

	}

	public function add_location(){
		$username = $this->session->userdata('user_username');

		if(isset($username)):
			$method = $this->input->server('REQUEST_METHOD');
			if($method == 'POST' || $method == 'Post' || $method == 'post'):
				$tenant_id = $this->users->get_user($username)->tenant_id;
			$permission = $this->users->check_permission($username);
			$data['employee_management'] = $permission->employee_management;
			$data['notifications'] = $this->employees->get_notifications(0);
			$data['payroll_management'] = $permission->payroll_management;
			$data['biometrics'] = $permission->biometrics;
			$data['user_management'] = $permission->user_management;
			$data['configuration'] = $permission->configuration;
			$data['payroll_configuration'] = $permission->payroll_configuration;
			$data['hr_configuration'] = $permission->hr_configuration;

			if($permission->hr_configuration == 1):

				$data['user_data'] = $this->users->get_user($username);
				$location_name = $this->input->post('location_name');
				$location_array = array(
					'location_name'=>$location_name,
					'tenant_id' => $tenant_id
				);
				$location_array = $this->security->xss_clean($location_array);
				$query = $this->hr_configurations->add_location($location_array);

				if($query == true):
				$log_array = array( 'tenant_id' => $tenant_id,
						'log_user_id' => $this->users->get_user($username)->user_id,
						'log_description' => "Added A New Branch"
					);

					$this->logs->add_log($log_array);

					$msg = array(
						'msg'=> 'Location Added Successfully',
						'location' => site_url('location'),
						'type' => 'success'

					);
					$this->load->view('swal', $msg);

				else:
					echo "An Error Occurred";
				endif;

			else:

				redirect('/access_denied');

			endif;

			else:
				redirect('error_404');
				endif;
		else:
			redirect('/login');
		endif;

	}

	public function update_location(){
		$username = $this->session->userdata('user_username');

		if(isset($username)):
			$tenant_id = $this->users->get_user($username)->tenant_id;
			$method = $this->input->server('REQUEST_METHOD');
			if($method == 'POST' || $method == 'Post' || $method == 'post'):
			$permission = $this->users->check_permission($username);
			$data['employee_management'] = $permission->employee_management;
			$data['notifications'] = $this->employees->get_notifications(0);
			$data['payroll_management'] = $permission->payroll_management;
			$data['biometrics'] = $permission->biometrics;
			$data['user_management'] = $permission->user_management;
			$data['configuration'] = $permission->configuration;
			$data['payroll_configuration'] = $permission->payroll_configuration;
			$data['hr_configuration'] = $permission->hr_configuration;

			if($permission->hr_configuration == 1):

				$data['user_data'] = $this->users->get_user($username);
				$location_name = $this->input->post('location_name');
				$location_id = $this->input->post('location_id');
				$location_array = array(
					'location_name'=>$location_name
				);
				$location_array = $this->security->xss_clean($location_array);
				$query = $this->hr_configurations->update_location($location_id, $location_array);

				if($query == true):

				$log_array = array( 'tenant_id' => $tenant_id,
						'log_user_id' => $this->users->get_user($username)->user_id,
						'log_description' => "Updated A Branch"
					);

					$this->logs->add_log($log_array);

					$msg = array(
						'msg'=> 'Location Updated Successfully',
						'location' => site_url('location'),
						'type' => 'success'

					);
					$this->load->view('swal', $msg);

				else:
					echo "An Error Occurred";
				endif;

			else:

				redirect('/access_denied');

			endif;

			else:

				redirect('error_404');
				endif;
		else:
			redirect('/login');
		endif;

	}


	public function subsidiary(){

		$username = $this->session->userdata('user_username');

		if(isset($username)):
			$tenant_id = $this->users->get_user($username)->tenant_id;
			$user_type = $this->users->get_user($username)->user_type;

			if($user_type == 1 || $user_type == 3 || $user_type == 4):
			$permission = $this->users->check_permission($username);
			$data['employee_management'] = $permission->employee_management;
			$data['notifications'] = $this->employees->get_notifications(0);
			$data['payroll_management'] = $permission->payroll_management;
			$data['biometrics'] = $permission->biometrics;
			$data['user_management'] = $permission->user_management;
			$data['configuration'] = $permission->configuration;
			$data['payroll_configuration'] = $permission->payroll_configuration;
			$data['hr_configuration'] = $permission->hr_configuration;

			if($permission->hr_configuration == 1):


				$data['user_data'] = $this->users->get_user($username);

				$data['subsidiarys'] = $this->hr_configurations->view_subsidiarys($tenant_id);
				$data['csrf_name'] = $this->security->get_csrf_token_name();
				$data['csrf_hash'] = $this->security->get_csrf_hash();



				$this->load->view('hr_config/subsidiary', $data);
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

	public function add_subsidiary(){
		$username = $this->session->userdata('user_username');

		if(isset($username)):

			$method = $this->input->server('REQUEST_METHOD');
			if($method == 'POST' || $method == 'Post' || $method == 'post'):
				$tenant_id = $this->users->get_user($username)->tenant_id;
			$permission = $this->users->check_permission($username);
			$data['employee_management'] = $permission->employee_management;
			$data['notifications'] = $this->employees->get_notifications(0);
			$data['payroll_management'] = $permission->payroll_management;
			$data['biometrics'] = $permission->biometrics;
			$data['user_management'] = $permission->user_management;
			$data['configuration'] = $permission->configuration;
			$data['payroll_configuration'] = $permission->payroll_configuration;
			$data['hr_configuration'] = $permission->hr_configuration;

			if($permission->hr_configuration == 1):

				$data['user_data'] = $this->users->get_user($username);
				$subsidiary_name = $this->input->post('subsidiary_name');
				$subsidiary_array = array(
					'subsidiary_name'=>$subsidiary_name,
					'tenant_id' => $tenant_id
				);
				$subsidiary_array = $this->security->xss_clean($subsidiary_array);
				$query = $this->hr_configurations->add_subsidiary($subsidiary_array);

				if($query == true):
				$log_array = array( 'tenant_id' => $tenant_id,
						'log_user_id' => $this->users->get_user($username)->user_id,
						'log_description' => "Added A New Subsidiary"
					);

					$this->logs->add_log($log_array);

					$msg = array(
						'msg'=> 'Subsidiary Added Successfully',
						'location' => site_url('subsidiary'),
						'type' => 'success'

					);
					$this->load->view('swal', $msg);

				else:
					echo "An Error Occurred";
				endif;

			else:

				redirect('/access_denied');

			endif;

			else:

				redirect('error_404');

			endif;
		else:
			redirect('/login');
		endif;
	}

	public function update_subsidiary(){
		$username = $this->session->userdata('user_username');

		if(isset($username)):

			$method = $this->input->server('REQUEST_METHOD');
			if($method == 'POST' || $method == 'Post' || $method == 'post'):
				$tenant_id = $this->users->get_user($username)->tenant_id;
			$permission = $this->users->check_permission($username);
			$data['employee_management'] = $permission->employee_management;
			$data['notifications'] = $this->employees->get_notifications(0);
			$data['payroll_management'] = $permission->payroll_management;
			$data['biometrics'] = $permission->biometrics;
			$data['user_management'] = $permission->user_management;
			$data['configuration'] = $permission->configuration;
			$data['payroll_configuration'] = $permission->payroll_configuration;
			$data['hr_configuration'] = $permission->hr_configuration;

			if($permission->hr_configuration == 1):

				$data['user_data'] = $this->users->get_user($username);

				$subsidiary_id = $this->input->post('subsidiary_id');
				$subsidiary_name = $this->input->post('subsidiary_name');
				$subsidiary_array = array(
					'subsidiary_name'=>$subsidiary_name
				);
				$subsidiary_array = $this->security->xss_clean($subsidiary_array);
				$query = $this->hr_configurations->update_subsidiary($subsidiary_id, $subsidiary_array);

				if($query == true):

				$log_array = array( 'tenant_id' => $tenant_id,
						'log_user_id' => $this->users->get_user($username)->user_id,
						'log_description' => "Updated A Subsidiary"
					);

					$this->logs->add_log($log_array);

					$msg = array(
						'msg'=> 'Subsidiary Updated Successfully',
						'location' => site_url('subsidiary'),
						'type' => 'success'

					);
					$this->load->view('swal', $msg);

				else:
					echo "An Error Occurred";
				endif;

			else:

				redirect('/access_denied');

			endif;

			else:
				redirect('error_404');
				endif;
		else:
			redirect('/login');
		endif;

	}



	public function leave(){

		$username = $this->session->userdata('user_username');

		if(isset($username)):
			$user_type = $this->users->get_user($username)->user_type;
			$tenant_id = $this->users->get_user($username)->tenant_id;
			if($user_type == 1 || $user_type == 3 || $user_type == 4):
			$permission = $this->users->check_permission($username);
			$data['employee_management'] = $permission->employee_management;
			$data['notifications'] = $this->employees->get_notifications(0);
			$data['payroll_management'] = $permission->payroll_management;
			$data['biometrics'] = $permission->biometrics;
			$data['user_management'] = $permission->user_management;
			$data['configuration'] = $permission->configuration;
			$data['payroll_configuration'] = $permission->payroll_configuration;
			$data['hr_configuration'] = $permission->hr_configuration;

			if($permission->hr_configuration == 1):

				$data['user_data'] = $this->users->get_user($username);

				$data['leaves'] = $this->hr_configurations->view_leaves($tenant_id);
				$data['csrf_name'] = $this->security->get_csrf_token_name();
				$data['csrf_hash'] = $this->security->get_csrf_hash();



				$this->load->view('hr_config/leave', $data);
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

	public function add_leave(){
		$username = $this->session->userdata('user_username');

		if(isset($username)):
			$method = $this->input->server('REQUEST_METHOD');
			if($method == 'POST' || $method == 'Post' || $method == 'post'):
				$tenant_id = $this->users->get_user($username)->tenant_id;
			$permission = $this->users->check_permission($username);
			$data['employee_management'] = $permission->employee_management;
			$data['notifications'] = $this->employees->get_notifications(0);
			$data['payroll_management'] = $permission->payroll_management;
			$data['biometrics'] = $permission->biometrics;
			$data['user_management'] = $permission->user_management;
			$data['configuration'] = $permission->configuration;
			$data['payroll_configuration'] = $permission->payroll_configuration;
			$data['hr_configuration'] = $permission->hr_configuration;

			if($permission->hr_configuration == 1):

				$data['user_data'] = $this->users->get_user($username);
				$leave_name = $this->input->post('leave_name');
				$leave_duration = $this->input->post('leave_duration');
				$leave_array = array(
					'leave_name'=>$leave_name,
					'leave_duration' => $leave_duration,
					'tenant_id' => $tenant_id
				);
				$leave_array = $this->security->xss_clean($leave_array);
				$query = $this->hr_configurations->add_leave($leave_array);

				if($query == true):
				$log_array = array( 'tenant_id' => $tenant_id,
						'log_user_id' => $this->users->get_user($username)->user_id,
						'log_description' => "Added A New Leave Type"
					);

					$this->logs->add_log($log_array);

					$msg = array(
						'msg'=> 'Leave Added Successfully',
						'location' => site_url('leave'),
						'type' => 'success'

					);
					$this->load->view('swal', $msg);

				else:
					echo "An Error Occurred";
				endif;

			else:

				redirect('/access_denied');

			endif;

			else:

				redirect('error_404');
				endif;
		else:
			redirect('/login');
		endif;
	}

	public function update_leave(){
		$username = $this->session->userdata('user_username');

		if(isset($username)):
			$method = $this->input->server('REQUEST_METHOD');
			if($method == 'POST' || $method == 'Post' || $method == 'post'):
				$tenant_id = $this->users->get_user($username)->tenant_id;
			$permission = $this->users->check_permission($username);
			$data['employee_management'] = $permission->employee_management;
			$data['notifications'] = $this->employees->get_notifications(0);
			$data['payroll_management'] = $permission->payroll_management;
			$data['biometrics'] = $permission->biometrics;
			$data['user_management'] = $permission->user_management;
			$data['configuration'] = $permission->configuration;
			$data['payroll_configuration'] = $permission->payroll_configuration;
			$data['hr_configuration'] = $permission->hr_configuration;

			if($permission->hr_configuration == 1):

				$data['user_data'] = $this->users->get_user($username);

				$leave_id = $this->input->post('leave_id');
				$leave_name = $this->input->post('leave_name');
				$leave_duration = $this->input->post('leave_duration');
				$leave_array = array(
					'leave_name'=>$leave_name,
					'leave_duration' => $leave_duration
				);
				$leave_array = $this->security->xss_clean($leave_array);
				$query = $this->hr_configurations->update_leave($leave_id, $leave_array);

				if($query == true):

				$log_array = array( 'tenant_id' => $tenant_id,
						'log_user_id' => $this->users->get_user($username)->user_id,
						'log_description' => "Updated A Leave Type"
					);

					$this->logs->add_log($log_array);

					$msg = array(
						'msg'=> 'Leave Updated Successfully',
						'location' => site_url('leave'),
						'type' => 'success'

					);
					$this->load->view('swal', $msg);

				else:
					echo "An Error Occurred";
				endif;

			else:

				redirect('/access_denied');

			endif;

			else:
				redirect('error_404');

				endif;
		else:
			redirect('/login');
		endif;

	}


	public function grade(){

		$username = $this->session->userdata('user_username');

		if(isset($username)):
			$user_type = $this->users->get_user($username)->user_type;
			$tenant_id = $this->users->get_user($username)->tenant_id;
			if($user_type == 1 || $user_type == 3 || $user_type == 4):
			$permission = $this->users->check_permission($username);
			$data['employee_management'] = $permission->employee_management;
			$data['notifications'] = $this->employees->get_notifications(0);
			$data['payroll_management'] = $permission->payroll_management;
			$data['biometrics'] = $permission->biometrics;
			$data['user_management'] = $permission->user_management;
			$data['configuration'] = $permission->configuration;
			$data['payroll_configuration'] = $permission->payroll_configuration;
			$data['hr_configuration'] = $permission->hr_configuration;
			if($permission->hr_configuration == 1):

				$data['user_data'] = $this->users->get_user($username);
				$data['grades'] = $this->hr_configurations->view_grades($tenant_id);
				$data['csrf_name'] = $this->security->get_csrf_token_name();
				$data['csrf_hash'] = $this->security->get_csrf_hash();


				$this->load->view('hr_config/grade', $data);

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

	public function add_grade(){
		$username = $this->session->userdata('user_username');

		if(isset($username)):
			$method = $this->input->server('REQUEST_METHOD');
			if($method == 'POST' || $method == 'Post' || $method == 'post'):
				$tenant_id = $this->users->get_user($username)->tenant_id;
			$permission = $this->users->check_permission($username);
			$data['employee_management'] = $permission->employee_management;
			$data['notifications'] = $this->employees->get_notifications(0);
			$data['payroll_management'] = $permission->payroll_management;
			$data['biometrics'] = $permission->biometrics;
			$data['user_management'] = $permission->user_management;
			$data['configuration'] = $permission->configuration;
			$data['payroll_configuration'] = $permission->payroll_configuration;
			$data['hr_configuration'] = $permission->hr_configuration;
			if($permission->hr_configuration == 1):
				$data['user_data'] = $this->users->get_user($username);

				$grade_name = $this->input->post('grade_name');
				$grade_array = array(
					'grade_name'=>$grade_name,
					'tenant_id' => $tenant_id,
				);
				$grade_array = $this->security->xss_clean($grade_array);
				$query = $this->hr_configurations->add_grade($grade_array);

				if($query == true):

				$log_array = array( 'tenant_id' => $tenant_id,
						'log_user_id' => $this->users->get_user($username)->user_id,
						'log_description' => "Added A New Grade"
					);

					$this->logs->add_log($log_array);

					$msg = array(
						'msg'=> 'Grade Added Successfully',
						'location' => site_url('grade'),
						'type' => 'success'

					);
					$this->load->view('swal', $msg);

				else:
					echo "An Error Occurred";
				endif;

			else:

				redirect('/access_denied');

			endif;

			else:

				redirect('error_404');

				endif;
		else:
			redirect('/login');
		endif;

	}

	public function update_grade(){
		$username = $this->session->userdata('user_username');

		if(isset($username)):
			$method = $this->input->server('REQUEST_METHOD');
			if($method == 'POST' || $method == 'Post' || $method == 'post'):
				$tenant_id = $this->users->get_user($username)->tenant_id;
			$permission = $this->users->check_permission($username);
			$data['employee_management'] = $permission->employee_management;
			$data['notifications'] = $this->employees->get_notifications(0);
			$data['payroll_management'] = $permission->payroll_management;
			$data['biometrics'] = $permission->biometrics;
			$data['user_management'] = $permission->user_management;
			$data['configuration'] = $permission->configuration;
			$data['payroll_configuration'] = $permission->payroll_configuration;
			$data['hr_configuration'] = $permission->hr_configuration;

			if($permission->hr_configuration == 1):

				$data['user_data'] = $this->users->get_user($username);
				$grade_name = $this->input->post('grade_name');
				$grade_id = $this->input->post('grade_id');
				$grade_array = array(
					'grade_name'=>$grade_name
				);
				$grade_array = $this->security->xss_clean($grade_array);
				$query = $this->hr_configurations->update_grade($grade_id, $grade_array);

				if($query == true):
				$log_array = array( 'tenant_id' => $tenant_id,
						'log_user_id' => $this->users->get_user($username)->user_id,
						'log_description' => "Updated A Grade"
					);

					$this->logs->add_log($log_array);
					$msg = array(
						'msg'=> 'Grade Updated Successfully',
						'location' => site_url('grade'),
						'type' => 'success'

					);
					$this->load->view('swal', $msg);


				else:
					echo "An Error Occurred";
				endif;

			else:

				redirect('/access_denied');

			endif;

			else:

				redirect('error_404');
				endif;
		else:
			redirect('/login');
		endif;

	}


	public function qualification(){

		$username = $this->session->userdata('user_username');

		if(isset($username)):
			$user_type = $this->users->get_user($username)->user_type;

			if($user_type == 1 || $user_type == 3 || $user_type == 4):
				$tenant_id = $this->users->get_user($username)->tenant_id;
			$permission = $this->users->check_permission($username);
			$data['employee_management'] = $permission->employee_management;
			$data['notifications'] = $this->employees->get_notifications(0);
			$data['payroll_management'] = $permission->payroll_management;
			$data['biometrics'] = $permission->biometrics;
			$data['user_management'] = $permission->user_management;
			$data['configuration'] = $permission->configuration;
			$data['payroll_configuration'] = $permission->payroll_configuration;
			$data['hr_configuration'] = $permission->hr_configuration;

			if($permission->hr_configuration == 1):

				$data['user_data'] = $this->users->get_user($username);
				$data['qualifications'] = $this->hr_configurations->view_qualifications($tenant_id);
				$data['csrf_name'] = $this->security->get_csrf_token_name();
				$data['csrf_hash'] = $this->security->get_csrf_hash();



				$this->load->view('hr_config/qualification', $data);
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

	public function add_qualification(){
		$username = $this->session->userdata('user_username');

		if(isset($username)):

			$method = $this->input->server('REQUEST_METHOD');
			if($method == 'POST' || $method == 'Post' || $method == 'post'):
				$tenant_id = $this->users->get_user($username)->tenant_id;
			$permission = $this->users->check_permission($username);
			$data['employee_management'] = $permission->employee_management;
			$data['notifications'] = $this->employees->get_notifications(0);
			$data['payroll_management'] = $permission->payroll_management;
			$data['biometrics'] = $permission->biometrics;
			$data['user_management'] = $permission->user_management;
			$data['configuration'] = $permission->configuration;
			$data['payroll_configuration'] = $permission->payroll_configuration;
			$data['hr_configuration'] = $permission->hr_configuration;
			if($permission->hr_configuration == 1):

				$data['user_data'] = $this->users->get_user($username);
				$qualification_name = $this->input->post('qualification_name');
				$qualification_array = array(
					'qualification_name'=>$qualification_name,
					'tenant_id' => $tenant_id
				);
				$qualification_array = $this->security->xss_clean($qualification_array);
				$query = $this->hr_configurations->add_qualification($qualification_array);

				if($query == true):
				$log_array = array( 'tenant_id' => $tenant_id,
						'log_user_id' => $this->users->get_user($username)->user_id,
						'log_description' => "Added A New Qualification"
					);

					$this->logs->add_log($log_array);
					$msg = array(
						'msg'=> 'qualification Added Successfully',
						'location' => site_url('qualification'),
						'type' => 'success'

					);
					$this->load->view('swal', $msg);

				else:
					echo "An Error Occurred";
				endif;

			else:

				redirect('/access_denied');

			endif;

			else:
				redirect('error_404');
				endif;
		else:
			redirect('/login');
		endif;

	}

	public function update_qualification(){
		$username = $this->session->userdata('user_username');

		if(isset($username)):

			$method = $this->input->server('REQUEST_METHOD');
			if($method == 'POST' || $method == 'Post' || $method == 'post'):
				$tenant_id = $this->users->get_user($username)->tenant_id;
			$permission = $this->users->check_permission($username);
			$data['employee_management'] = $permission->employee_management;
			$data['notifications'] = $this->employees->get_notifications(0);
			$data['payroll_management'] = $permission->payroll_management;
			$data['biometrics'] = $permission->biometrics;
			$data['user_management'] = $permission->user_management;
			$data['configuration'] = $permission->configuration;
			$data['payroll_configuration'] = $permission->payroll_configuration;
			$data['hr_configuration'] = $permission->hr_configuration;

			if($permission->hr_configuration == 1):

				$data['user_data'] = $this->users->get_user($username);
				$qualification_name = $this->input->post('qualification_name');
				$qualification_id = $this->input->post('qualification_id');
				$qualification_array = array(
					'qualification_name'=>$qualification_name
				);
				$qualification_array = $this->security->xss_clean($qualification_array);
				$query = $this->hr_configurations->update_qualification($qualification_id, $qualification_array);

				if($query == true):
				$log_array = array( 'tenant_id' => $tenant_id,
						'log_user_id' => $this->users->get_user($username)->user_id,
						'log_description' => "Updated Qualification"
					);

					$this->logs->add_log($log_array);
					$msg = array(
						'msg'=> 'qualification Updated Successfully',
						'location' => site_url('qualification'),
						'type' => 'success'

					);
					$this->load->view('swal', $msg);


				else:
					echo "An Error Occurred";
				endif;

			else:

				redirect('/access_denied');

			endif;

			else:
				redirect('error_404');
				endif;
		else:
			redirect('/login');
		endif;

	}


	public function department(){

		$username = $this->session->userdata('user_username');

		if(isset($username)):
			$user_type = $this->users->get_user($username)->user_type;

			if($user_type == 1 || $user_type == 3 || $user_type == 4):
				$tenant_id = $this->users->get_user($username)->tenant_id;
			$permission = $this->users->check_permission($username);
			$data['employee_management'] = $permission->employee_management;
			$data['notifications'] = $this->employees->get_notifications(0);
			$data['payroll_management'] = $permission->payroll_management;
			$data['biometrics'] = $permission->biometrics;
			$data['user_management'] = $permission->user_management;
			$data['configuration'] = $permission->configuration;
			$data['payroll_configuration'] = $permission->payroll_configuration;
			$data['hr_configuration'] = $permission->hr_configuration;

			if($permission->hr_configuration == 1):

				$data['user_data'] = $this->users->get_user($username);
				$data['departments'] = $this->hr_configurations->view_departments($tenant_id);
				$data['csrf_name'] = $this->security->get_csrf_token_name();
				$data['csrf_hash'] = $this->security->get_csrf_hash();



				$this->load->view('hr_config/department', $data);
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

	public function add_department(){
		$username = $this->session->userdata('user_username');

		if(isset($username)):

			$method = $this->input->server('REQUEST_METHOD');
			if($method == 'POST' || $method == 'Post' || $method == 'post'):
				$tenant_id = $this->users->get_user($username)->tenant_id;
			$permission = $this->users->check_permission($username);
			$data['employee_management'] = $permission->employee_management;
			$data['notifications'] = $this->employees->get_notifications(0);
			$data['payroll_management'] = $permission->payroll_management;
			$data['biometrics'] = $permission->biometrics;
			$data['user_management'] = $permission->user_management;
			$data['configuration'] = $permission->configuration;
			$data['payroll_configuration'] = $permission->payroll_configuration;
			$data['hr_configuration'] = $permission->hr_configuration;

			if($permission->hr_configuration == 1):

				$data['user_data'] = $this->users->get_user($username);
				$department_name = $this->input->post('department_name');
				$department_array = array(
					'department_name'=>$department_name,
					'tenant_id' => $tenant_id
				);
				$department_array = $this->security->xss_clean($department_array);
				$query = $this->hr_configurations->add_department($department_array);

				if($query == true):
				$log_array = array( 'tenant_id' => $tenant_id,
						'log_user_id' => $this->users->get_user($username)->user_id,
						'log_description' => "Added New Department"
					);

					$this->logs->add_log($log_array);
					$msg = array(
						'msg'=> 'Department Added Successfully',
						'location' => site_url('department'),
						'type' => 'success'

					);
					$this->load->view('swal', $msg);

				else:
					echo "An Error Occurred";
				endif;

			else:

				redirect('/access_denied');

			endif;

			else:

				redirect('error_404');
				endif;
		else:
			redirect('/login');
		endif;

	}

	public function update_department(){
		$username = $this->session->userdata('user_username');

		if(isset($username)):
			$method = $this->input->server('REQUEST_METHOD');
			if($method == 'POST' || $method == 'Post' || $method == 'post'):
				$tenant_id = $this->users->get_user($username)->tenant_id;
			$permission = $this->users->check_permission($username);
			$data['employee_management'] = $permission->employee_management;
			$data['notifications'] = $this->employees->get_notifications(0);
			$data['payroll_management'] = $permission->payroll_management;
			$data['biometrics'] = $permission->biometrics;
			$data['user_management'] = $permission->user_management;
			$data['configuration'] = $permission->configuration;
			$data['payroll_configuration'] = $permission->payroll_configuration;
			$data['hr_configuration'] = $permission->hr_configuration;

			if($permission->hr_configuration == 1):

				$data['user_data'] = $this->users->get_user($username);
				$department_name = $this->input->post('department_name');
				$department_id = $this->input->post('department_id');
				$department_array = array(
					'department_name'=>$department_name
				);
				$department_array = $this->security->xss_clean($department_array);
				$query = $this->hr_configurations->update_department($department_id, $department_array);

				if($query == true):
				$log_array = array( 'tenant_id' => $tenant_id,
						'log_user_id' => $this->users->get_user($username)->user_id,
						'log_description' => "Updated Department"
					);

					$this->logs->add_log($log_array);
					$msg = array(
						'msg'=> 'department Updated Successfully',
						'location' => site_url('department'),
						'type' => 'success'

					);
					$this->load->view('swal', $msg);


				else:
					echo "An Error Occurred";
				endif;

			else:

				redirect('/access_denied');

			endif;

			else:

				redirect('error_404');
			endif;
		else:
			redirect('/login');
		endif;

	}


	public function job_role(){

		$username = $this->session->userdata('user_username');

		if(isset($username)):
			$user_type = $this->users->get_user($username)->user_type;
			$tenant_id = $this->users->get_user($username)->tenant_id;
			if($user_type == 1 || $user_type == 3 || $user_type == 4):
			$permission = $this->users->check_permission($username);
			$data['employee_management'] = $permission->employee_management;
			$data['notifications'] = $this->employees->get_notifications(0);
			$data['payroll_management'] = $permission->payroll_management;
			$data['biometrics'] = $permission->biometrics;
			$data['user_management'] = $permission->user_management;
			$data['configuration'] = $permission->configuration;
			$data['payroll_configuration'] = $permission->payroll_configuration;
			$data['hr_configuration'] = $permission->hr_configuration;

			if($permission->hr_configuration == 1):

				$data['user_data'] = $this->users->get_user($username);
				$data['departments'] = $this->hr_configurations->view_departments($tenant_id);
				$data['job_roles'] = $this->hr_configurations->view_job_roles($tenant_id);
				$data['csrf_name'] = $this->security->get_csrf_token_name();
				$data['csrf_hash'] = $this->security->get_csrf_hash();



				$this->load->view('hr_config/job_role', $data);

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

	public function add_job_role(){
		$username = $this->session->userdata('user_username');

		if(isset($username)):

			$method = $this->input->server('REQUEST_METHOD');
			if($method == 'POST' || $method == 'Post' || $method == 'post'):
				$tenant_id = $this->users->get_user($username)->tenant_id;
			$permission = $this->users->check_permission($username);
			$data['employee_management'] = $permission->employee_management;
			$data['notifications'] = $this->employees->get_notifications(0);
			$data['payroll_management'] = $permission->payroll_management;
			$data['biometrics'] = $permission->biometrics;
			$data['user_management'] = $permission->user_management;
			$data['configuration'] = $permission->configuration;
			$data['payroll_configuration'] = $permission->payroll_configuration;
			$data['hr_configuration'] = $permission->hr_configuration;

			if($permission->hr_configuration == 1):
				$data['user_data'] = $this->users->get_user($username);

				$job_role_name = $this->input->post('job_role_name');
				$department_id = $this->input->post('department_id');
				$job_description = $this->input->post('job_description');
				$job_role_array = array(
					'job_name'=>$job_role_name,
					'job_description' => $job_description,
					'department_id' => $department_id,
					'tenant_id' => $tenant_id
				);
				$job_role_array = $this->security->xss_clean($job_role_array);
				$query = $this->hr_configurations->add_job_role($job_role_array);

				if($query == true):
				$log_array = array( 'tenant_id' => $tenant_id,
						'log_user_id' => $this->users->get_user($username)->user_id,
						'log_description' => "Added A New Job Role"
					);

					$this->logs->add_log($log_array);

					$msg = array(
						'msg'=> 'job role Added Successfully',
						'location' => site_url('job_role'),
						'type' => 'success'

					);
					$this->load->view('swal', $msg);

				else:
					echo "An Error Occurred";
				endif;

			else:

				redirect('/access_denied');

			endif;

			else:
				redirect('error_404');

				endif;
		else:
			redirect('/login');
		endif;



	}

	public function update_job_role(){
		$username = $this->session->userdata('user_username');

		if(isset($username)):

			$method = $this->input->server('REQUEST_METHOD');
			if($method == 'POST' || $method == 'Post' || $method == 'post'):
				$tenant_id = $this->users->get_user($username)->tenant_id;
			$permission = $this->users->check_permission($username);
			$data['employee_management'] = $permission->employee_management;
			$data['notifications'] = $this->employees->get_notifications(0);
			$data['payroll_management'] = $permission->payroll_management;
			$data['biometrics'] = $permission->biometrics;
			$data['user_management'] = $permission->user_management;
			$data['configuration'] = $permission->configuration;
			$data['payroll_configuration'] = $permission->payroll_configuration;
			$data['hr_configuration'] = $permission->hr_configuration;

			if($permission->hr_configuration == 1):


				$data['user_data'] = $this->users->get_user($username);
				$job_role_id = $this->input->post('job_role_id');
				$job_role_name = $this->input->post('job_role_name');
				$department_id = $this->input->post('department_id');
				$job_description = $this->input->post('job_description');
				$job_role_array = array(
					'job_name'=>$job_role_name,
					'job_description' => $job_description,
					'department_id' => $department_id
				);
				$job_role_array = $this->security->xss_clean($job_role_array);

				$query = $this->hr_configurations->update_job_role($job_role_id, $job_role_array);

				if($query == true):

				$log_array = array( 'tenant_id' => $tenant_id,
						'log_user_id' => $this->users->get_user($username)->user_id,
						'log_description' => "Update A Job Role"
					);

					$this->logs->add_log($log_array);

					$msg = array(
						'msg'=> 'job_role Updated Successfully',
						'location' => site_url('job_role'),
						'type' => 'success'

					);
					$this->load->view('swal', $msg);


				else:
					echo "An Error Occurred";
				endif;

			else:

				redirect('/access_denied');

			endif;

			else:

				redirect('error_404');
				endif;
		else:
			redirect('/login');
		endif;

	}

	public function pension(){

		$username = $this->session->userdata('user_username');

		if(isset($username)):
			$user_type = $this->users->get_user($username)->user_type;

			if($user_type == 1 || $user_type == 3 || $user_type == 4):
				$tenant_id = $this->users->get_user($username)->tenant_id;
			$permission = $this->users->check_permission($username);
			$data['employee_management'] = $permission->employee_management;
			$data['notifications'] = $this->employees->get_notifications(0);
			$data['payroll_management'] = $permission->payroll_management;
			$data['biometrics'] = $permission->biometrics;
			$data['user_management'] = $permission->user_management;
			$data['configuration'] = $permission->configuration;
			$data['payroll_configuration'] = $permission->payroll_configuration;
			$data['hr_configuration'] = $permission->hr_configuration;

			if($permission->hr_configuration == 1):

				$data['user_data'] = $this->users->get_user($username);
				$data['departments'] = $this->hr_configurations->view_departments($tenant_id);
				$data['pensions'] = $this->hr_configurations->view_pensions($tenant_id);
				$data['csrf_name'] = $this->security->get_csrf_token_name();
				$data['csrf_hash'] = $this->security->get_csrf_hash();



				$this->load->view('hr_config/pension', $data);

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

	public function add_pension(){
		$username = $this->session->userdata('user_username');

		if(isset($username)):
			$method = $this->input->server('REQUEST_METHOD');
			if($method == 'POST' || $method == 'Post' || $method == 'post'):
				$tenant_id = $this->users->get_user($username)->tenant_id;
			$permission = $this->users->check_permission($username);
			$data['employee_management'] = $permission->employee_management;
			$data['notifications'] = $this->employees->get_notifications(0);
			$data['payroll_management'] = $permission->payroll_management;
			$data['biometrics'] = $permission->biometrics;
			$data['user_management'] = $permission->user_management;
			$data['configuration'] = $permission->configuration;
			$data['payroll_configuration'] = $permission->payroll_configuration;
			$data['hr_configuration'] = $permission->hr_configuration;

			if($permission->hr_configuration == 1):
				$data['user_data'] = $this->users->get_user($username);


				$pension_provider = $this->input->post('pension_provider');

				$pension_array = array(
					'pension_provider'=>$pension_provider,
					'tenant_id' => $tenant_id
				);
				$pension_array = $this->security->xss_clean($pension_array);

				$query = $this->hr_configurations->add_pension($pension_array);

				if($query == true):
				$log_array = array( 'tenant_id' => $tenant_id,
						'log_user_id' => $this->users->get_user($username)->user_id,
						'log_description' => "Added A New Pension"
					);

					$this->logs->add_log($log_array);
					$msg = array(
						'msg'=> 'Pension Provider Added Successfully',
						'location' => site_url('pension'),
						'type' => 'success'

					);
					$this->load->view('swal', $msg);

				else:
					echo "An Error Occurred";
				endif;

			else:

				redirect('/access_denied');

			endif;

			else:
				redirect('error_404');
				endif;
		else:
			redirect('/login');
		endif;

	}

	public function update_pension(){
		$username = $this->session->userdata('user_username');

		if(isset($username)):
			$method = $this->input->server('REQUEST_METHOD');
			if($method == 'POST' || $method == 'Post' || $method == 'post'):
				$tenant_id = $this->users->get_user($username)->tenant_id;
			$permission = $this->users->check_permission($username);
			$data['employee_management'] = $permission->employee_management;
			$data['notifications'] = $this->employees->get_notifications(0);
			$data['payroll_management'] = $permission->payroll_management;
			$data['biometrics'] = $permission->biometrics;
			$data['user_management'] = $permission->user_management;
			$data['configuration'] = $permission->configuration;
			$data['payroll_configuration'] = $permission->payroll_configuration;
			$data['hr_configuration'] = $permission->hr_configuration;

			if($permission->hr_configuration == 1):


				$data['user_data'] = $this->users->get_user($username);
				$pension_id = $this->input->post('pension_id');
				$pension_provider = $this->input->post('pension_provider');

				$pension_array = array(
					'pension_provider'=>$pension_provider,
					'tenant_id' => $tenant_id
				);
				$pension_array = $this->security->xss_clean($pension_array);

				$query = $this->hr_configurations->update_pension($pension_id, $pension_array);

				if($query == true):

				$log_array = array( 'tenant_id' => $tenant_id,
						'log_user_id' => $this->users->get_user($username)->user_id,
						'log_description' => "Updated Pension"
					);

					$this->logs->add_log($log_array);

					$msg = array(
						'msg'=> 'Pension Updated Successfully',
						'location' => site_url('pension'),
						'type' => 'success'

					);
					$this->load->view('swal', $msg);


				else:
					echo "An Error Occurred";
				endif;

			else:

				redirect('/access_denied');

			endif;

			else:
				redirect('error_404');

				endif;
		else:
			redirect('/login');
		endif;

	}


	public function health_insurance(){

		$username = $this->session->userdata('user_username');

		if(isset($username)):
			$user_type = $this->users->get_user($username)->user_type;

			if($user_type == 1 || $user_type == 3 || $user_type == 4):
				$tenant_id = $this->users->get_user($username)->tenant_id;
			$permission = $this->users->check_permission($username);
			$data['employee_management'] = $permission->employee_management;
			$data['notifications'] = $this->employees->get_notifications(0);
			$data['payroll_management'] = $permission->payroll_management;
			$data['biometrics'] = $permission->biometrics;
			$data['user_management'] = $permission->user_management;
			$data['configuration'] = $permission->configuration;
			$data['payroll_configuration'] = $permission->payroll_configuration;
			$data['hr_configuration'] = $permission->hr_configuration;

			if($permission->hr_configuration == 1):

				$data['user_data'] = $this->users->get_user($username);

				$data['health_insurances'] = $this->hr_configurations->view_health_insurances($tenant_id);
				$data['csrf_name'] = $this->security->get_csrf_token_name();
				$data['csrf_hash'] = $this->security->get_csrf_hash();



				$this->load->view('hr_config/health_insurance', $data);

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

	public function add_health_insurance(){
		$username = $this->session->userdata('user_username');

		if(isset($username)):
			$method = $this->input->server('REQUEST_METHOD');
			if($method == 'POST' || $method == 'Post' || $method == 'post'):
				$tenant_id = $this->users->get_user($username)->tenant_id;
			$permission = $this->users->check_permission($username);
			$data['employee_management'] = $permission->employee_management;
			$data['notifications'] = $this->employees->get_notifications(0);
			$data['payroll_management'] = $permission->payroll_management;
			$data['biometrics'] = $permission->biometrics;
			$data['user_management'] = $permission->user_management;
			$data['configuration'] = $permission->configuration;
			$data['payroll_configuration'] = $permission->payroll_configuration;
			$data['hr_configuration'] = $permission->hr_configuration;

			if($permission->hr_configuration == 1):
				$data['user_data'] = $this->users->get_user($username);


				$health_insurance_hmo = $this->input->post('health_insurance_hmo');

				$health_insurance_array = array(
					'health_insurance_hmo'=>$health_insurance_hmo,
					'tenant_id'=> $tenant_id
				);
				$health_insurance_array = $this->security->xss_clean($health_insurance_array);

				$query = $this->hr_configurations->add_health_insurance($health_insurance_array);

				if($query == true):

				$log_array = array( 'tenant_id' => $tenant_id,
						'log_user_id' => $this->users->get_user($username)->user_id,
						'log_description' => "Added A New HMO"
					);

					$this->logs->add_log($log_array);

					$msg = array(
						'msg'=> 'HMO Added Successfully',
						'location' => site_url('health_insurance'),
						'type' => 'success'

					);
					$this->load->view('swal', $msg);

				else:
					echo "An Error Occurred";
				endif;

			else:

				redirect('/access_denied');

			endif;

			else:
				redirect('error_404');

				endif;
		else:
			redirect('/login');
		endif;

	}

	public function update_health_insurance(){
		$username = $this->session->userdata('user_username');

		if(isset($username)):

			$method = $this->input->server('REQUEST_METHOD');
			if($method == 'POST' || $method == 'Post' || $method == 'post'):
				$tenant_id = $this->users->get_user($username)->tenant_id;
			$permission = $this->users->check_permission($username);
			$data['employee_management'] = $permission->employee_management;
			$data['notifications'] = $this->employees->get_notifications(0);
			$data['payroll_management'] = $permission->payroll_management;
			$data['biometrics'] = $permission->biometrics;
			$data['user_management'] = $permission->user_management;
			$data['configuration'] = $permission->configuration;
			$data['payroll_configuration'] = $permission->payroll_configuration;
			$data['hr_configuration'] = $permission->hr_configuration;

			if($permission->hr_configuration == 1):


				$data['user_data'] = $this->users->get_user($username);
				$health_insurance_id = $this->input->post('health_insurance_id');
				$health_insurance_hmo = $this->input->post('health_insurance_hmo');

				$health_insurance_array = array(
					'health_insurance_hmo'=>$health_insurance_hmo,
				);
				$health_insurance_array = $this->security->xss_clean($health_insurance_array);

				$query = $this->hr_configurations->update_health_insurance($health_insurance_id, $health_insurance_array);

				if($query == true):

				$log_array = array( 'tenant_id' => $tenant_id,
						'log_user_id' => $this->users->get_user($username)->user_id,
						'log_description' => "Update a HMO"
					);

					$this->logs->add_log($log_array);

					$msg = array(
						'msg'=> 'HMO Updated Successfully',
						'location' => site_url('health_insurance'),
						'type' => 'success'

					);
					$this->load->view('swal', $msg);


				else:
					echo "An Error Occurred";
				endif;

			else:

				redirect('/access_denied');

			endif;

			else:

				redirect('error_404');
				endif;
		else:
			redirect('/login');
		endif;

	}


	public function appraisal_setup (){
		$username = $this->session->userdata('user_username');

		if(isset($username)):
			$user_type = $this->users->get_user($username)->user_type;
			$tenant_id = $this->users->get_user($username)->tenant_id;
			if($user_type == 1 || $user_type == 3 || $user_type == 4):
			$permission = $this->users->check_permission($username);
			$data['employee_management'] = $permission->employee_management;
			$data['notifications'] = $this->employees->get_notifications(0);
			$data['payroll_management'] = $permission->payroll_management;
			$data['biometrics'] = $permission->biometrics;
			$data['user_management'] = $permission->user_management;
			$data['configuration'] = $permission->configuration;
			$data['payroll_configuration'] = $permission->payroll_configuration;
			$data['hr_configuration'] = $permission->hr_configuration;

			if($permission->hr_configuration == 1):


				$data['user_data'] = $this->users->get_user($username);
				//$data['employees'] = $this->employees->get_employee_by_salary_setup();


				$this->load->view('hr_config/appraisal_setup', $data);

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

	public function self_assessment(){

		$username = $this->session->userdata('user_username');

		if(isset($username)):
			$user_type = $this->users->get_user($username)->user_type;

			if($user_type == 1 || $user_type == 3 || $user_type == 4):
				$tenant_id = $this->users->get_user($username)->tenant_id;
			$permission = $this->users->check_permission($username);
			$data['employee_management'] = $permission->employee_management;
			$data['notifications'] = $this->employees->get_notifications(0);
			$data['payroll_management'] = $permission->payroll_management;
			$data['biometrics'] = $permission->biometrics;
			$data['user_management'] = $permission->user_management;
			$data['configuration'] = $permission->configuration;
			$data['payroll_configuration'] = $permission->payroll_configuration;
			$data['hr_configuration'] = $permission->hr_configuration;

			if($permission->hr_configuration == 1):



				$data['user_data'] = $this->users->get_user($username);
				//$data['employees'] = $this->employees->get_employee_by_salary_setup();

				$data['questions'] = $this->hr_configurations->view_self_assessments($tenant_id);
				$data['csrf_name'] = $this->security->get_csrf_token_name();
				$data['csrf_hash'] = $this->security->get_csrf_hash();

				$this->load->view('hr_config/self_assessment', $data);
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


	public function add_self_assessment(){
		$username = $this->session->userdata('user_username');

		if(isset($username)):
			$method = $this->input->server('REQUEST_METHOD');
			if($method == 'POST' || $method == 'Post' || $method == 'post'):
				$tenant_id = $this->users->get_user($username)->tenant_id;
			$permission = $this->users->check_permission($username);
			$data['employee_management'] = $permission->employee_management;
			$data['notifications'] = $this->employees->get_notifications(0);
			$data['payroll_management'] = $permission->payroll_management;
			$data['biometrics'] = $permission->biometrics;
			$data['user_management'] = $permission->user_management;
			$data['configuration'] = $permission->configuration;
			$data['payroll_configuration'] = $permission->payroll_configuration;
			$data['hr_configuration'] = $permission->hr_configuration;

			if($permission->hr_configuration == 1):
				$data['user_data'] = $this->users->get_user($username);


				$question = $this->input->post('question');

				$question_array = array(
					'self_appraisee_question'=>$question,
					'tenant_id' => $tenant_id
				);
				$question_array = $this->security->xss_clean($question_array);

				$query = $this->hr_configurations->add_self_assessment($question_array);

				if($query == true):

				$log_array = array( 'tenant_id' => $tenant_id,
						'log_user_id' => $this->users->get_user($username)->user_id,
						'log_description' => "Added A New Self Assessment Question"
					);

					$this->logs->add_log($log_array);

					$msg = array(
						'msg'=> 'Question Added Successfully',
						'location' => site_url('self_assessment'),
						'type' => 'success'

					);
					$this->load->view('swal', $msg);

				else:
					echo "An Error Occurred";
				endif;

			else:

				redirect('/access_denied');

			endif;

			else:

				redirect('error_404');

				endif;
		else:
			redirect('/login');
		endif;

	}

	public function update_self_assessment(){
		$username = $this->session->userdata('user_username');

		if(isset($username)):
			$tenant_id = $this->users->get_user($username)->tenant_id;
			$method = $this->input->server('REQUEST_METHOD');
			if($method == 'POST' || $method == 'Post' || $method == 'post'):
			$permission = $this->users->check_permission($username);
			$data['employee_management'] = $permission->employee_management;
			$data['notifications'] = $this->employees->get_notifications(0);
			$data['payroll_management'] = $permission->payroll_management;
			$data['biometrics'] = $permission->biometrics;
			$data['user_management'] = $permission->user_management;
			$data['configuration'] = $permission->configuration;
			$data['payroll_configuration'] = $permission->payroll_configuration;
			$data['hr_configuration'] = $permission->hr_configuration;

			if($permission->hr_configuration == 1):


				$data['user_data'] = $this->users->get_user($username);
				$question_id = $this->input->post('question_id');
				$question = $this->input->post('question');

				$question_array = array(
					'self_appraisee_question'=>$question,
				);
				$question_array = $this->security->xss_clean($question_array);

				$query = $this->hr_configurations->update_self_assessment($question_id, $question_array);

				if($query == true):

				$log_array = array( 'tenant_id' => $tenant_id,
						'log_user_id' => $this->users->get_user($username)->user_id,
						'log_description' => "Update a Self Assessment Question"
					);

					$this->logs->add_log($log_array);

					$msg = array(
						'msg'=> 'Question Updated Successfully',
						'location' => site_url('self_assessment'),
						'type' => 'success'

					);
					$this->load->view('swal', $msg);


				else:
					echo "An Error Occurred";
				endif;

			else:

				redirect('/access_denied');

			endif;

			else:
				redirect('error_404');
				endif;
		else:
			redirect('/login');
		endif;

	}


	public function quantitative_assessment(){
		$username = $this->session->userdata('user_username');

		if(isset($username)):
			$user_type = $this->users->get_user($username)->user_type;
			$tenant_id = $this->users->get_user($username)->tenant_id;
			if($user_type == 1 || $user_type == 3 || $user_type == 4):
			$permission = $this->users->check_permission($username);
			$data['employee_management'] = $permission->employee_management;
			$data['notifications'] = $this->employees->get_notifications(0);
			$data['payroll_management'] = $permission->payroll_management;
			$data['biometrics'] = $permission->biometrics;
			$data['user_management'] = $permission->user_management;
			$data['configuration'] = $permission->configuration;
			$data['payroll_configuration'] = $permission->payroll_configuration;
			$data['hr_configuration'] = $permission->hr_configuration;

			if($permission->hr_configuration == 1):


				$data['user_data'] = $this->users->get_user($username);
				//$data['employees'] = $this->employees->get_employee_by_salary_setup();
				$data['job_roles'] = $this->hr_configurations->view_job_roles($tenant_id);
				$data['csrf_name'] = $this->security->get_csrf_token_name();
				$data['csrf_hash'] = $this->security->get_csrf_hash();

				$this->load->view('hr_config/quantitative_assessment', $data);

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
	public function view_quantitative_assessment(){

		$job_role_id = $this->uri->segment(2);

		$username = $this->session->userdata('user_username');

		if(isset($username)):
			$user_type = $this->users->get_user($username)->user_type;
			$tenant_id = $this->users->get_user($username)->tenant_id;
			if($user_type == 1 || $user_type == 3 || $user_type == 4):
			$permission = $this->users->check_permission($username);
			$data['employee_management'] = $permission->employee_management;
			$data['notifications'] = $this->employees->get_notifications(0);
			$data['payroll_management'] = $permission->payroll_management;
			$data['biometrics'] = $permission->biometrics;
			$data['user_management'] = $permission->user_management;
			$data['configuration'] = $permission->configuration;
			$data['payroll_configuration'] = $permission->payroll_configuration;
			$data['hr_configuration'] = $permission->hr_configuration;

			if($permission->hr_configuration == 1):

				if(empty($job_role_id)):

					redirect('error_404');

					else:

					$check_existing_job_role = $this->hr_configurations-> view_job_role($job_role_id, $tenant_id);

					if(empty($check_existing_job_role)):

						redirect('error_404');

						else:

							$data['user_data'] = $this->users->get_user($username);
							//$data['employees'] = $this->employees->get_employee_by_salary_setup();
							$data['job_role'] = $check_existing_job_role;
							$data['questions'] = $this->hr_configurations->view_quantitative_assessments($job_role_id , $tenant_id);
							$data['csrf_name'] = $this->security->get_csrf_token_name();
							$data['csrf_hash'] = $this->security->get_csrf_hash();
							$this->load->view('hr_config/view_quantitative_assessment', $data);
						endif;

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

	public function add_quantitative_assessment(){
		$username = $this->session->userdata('user_username');

		if(isset($username)):
			$method = $this->input->server('REQUEST_METHOD');
			if($method == 'POST' || $method == 'Post' || $method == 'post'):
				$tenant_id = $this->users->get_user($username)->tenant_id;
			$permission = $this->users->check_permission($username);
			$data['employee_management'] = $permission->employee_management;
			$data['notifications'] = $this->employees->get_notifications(0);
			$data['payroll_management'] = $permission->payroll_management;
			$data['biometrics'] = $permission->biometrics;
			$data['user_management'] = $permission->user_management;
			$data['configuration'] = $permission->configuration;
			$data['payroll_configuration'] = $permission->payroll_configuration;
			$data['hr_configuration'] = $permission->hr_configuration;

			if($permission->hr_configuration == 1):
				$data['user_data'] = $this->users->get_user($username);


				$question = $this->input->post('question');
				$job_role_id = $this->input->post('job_role_id');

				$question_array = array(
					'quantitative_question'=>$question,
					'quantitative_job_role_id' => $job_role_id,
					'tenant_id'=> $tenant_id
				);
				$question_array = $this->security->xss_clean($question_array);

				$query = $this->hr_configurations->add_quantitative_assessment($question_array);

				if($query == true):

				$log_array = array( 'tenant_id' => $tenant_id,
						'log_user_id' => $this->users->get_user($username)->user_id,
						'log_description' => "Added A New Quantitative Assessment Question"
					);

					$this->logs->add_log($log_array);
					$url = site_url('view_quantitative_assessment')."/".$job_role_id;
					$msg = array(
						'msg'=> 'Question Added Successfully',
						'location' => $url,
						'type' => 'success'

					);
					$this->load->view('swal', $msg);

				else:
					echo "An Error Occurred";
				endif;

			else:

				redirect('/access_denied');

			endif;

			else:
				redirect('error_404');
				endif;
		else:
			redirect('/login');
		endif;

	}

	public function update_quantitative_assessment(){
		$username = $this->session->userdata('user_username');

		if(isset($username)):
			$method = $this->input->server('REQUEST_METHOD');
			if($method == 'POST' || $method == 'Post' || $method == 'post'):
				$tenant_id = $this->users->get_user($username)->tenant_id;
			$permission = $this->users->check_permission($username);
			$data['employee_management'] = $permission->employee_management;
			$data['notifications'] = $this->employees->get_notifications(0);
			$data['payroll_management'] = $permission->payroll_management;
			$data['biometrics'] = $permission->biometrics;
			$data['user_management'] = $permission->user_management;
			$data['configuration'] = $permission->configuration;
			$data['payroll_configuration'] = $permission->payroll_configuration;
			$data['hr_configuration'] = $permission->hr_configuration;

			if($permission->hr_configuration == 1):


				$data['user_data'] = $this->users->get_user($username);
				$question_id = $this->input->post('question_id');
				$question = $this->input->post('question');
				$job_role_id = $this->input->post('job_role_id');

				$question_array = array(
					'quantitative_question'=>$question,
				);
				$question_array = $this->security->xss_clean($question_array);

				$query = $this->hr_configurations->update_quantitative_assessment($question_id, $question_array);

				if($query == true):

				$log_array = array( 'tenant_id' => $tenant_id,
						'log_user_id' => $this->users->get_user($username)->user_id,
						'log_description' => "Update a Quantitative Assessment Question"
					);

					$this->logs->add_log($log_array);
					$url = site_url('view_quantitative_assessment')."/".$job_role_id;
					$msg = array(
						'msg'=> 'Question Updated Successfully',
						'location' => $url,
						'type' => 'success'

					);
					$this->load->view('swal', $msg);


				else:
					echo "An Error Occurred";
				endif;

			else:

				redirect('/access_denied');

			endif;

			else:
				redirect('error_404');

				endif;
		else:
			redirect('/login');
		endif;

	}

	public function qualitative_assessment(){
		$username = $this->session->userdata('user_username');

		if(isset($username)):
			$user_type = $this->users->get_user($username)->user_type;

			if($user_type == 1 || $user_type == 3 || $user_type == 4):
				$tenant_id = $this->users->get_user($username)->tenant_id;

			$permission = $this->users->check_permission($username);
			$data['employee_management'] = $permission->employee_management;
			$data['notifications'] = $this->employees->get_notifications(0);
			$data['payroll_management'] = $permission->payroll_management;
			$data['biometrics'] = $permission->biometrics;
			$data['user_management'] = $permission->user_management;
			$data['configuration'] = $permission->configuration;
			$data['payroll_configuration'] = $permission->payroll_configuration;
			$data['hr_configuration'] = $permission->hr_configuration;

			if($permission->hr_configuration == 1):

				$data['user_data'] = $this->users->get_user($username);
				//$data['employees'] = $this->employees->get_employee_by_salary_setup();

				$data['questions'] = $this->hr_configurations->view_qualitative_assessments($tenant_id);
				$data['csrf_name'] = $this->security->get_csrf_token_name();
				$data['csrf_hash'] = $this->security->get_csrf_hash();
				$this->load->view('hr_config/qualitative_assessment', $data);

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

	public function add_qualitative_assessment(){
		$username = $this->session->userdata('user_username');

		if(isset($username)):
			$method = $this->input->server('REQUEST_METHOD');
			if($method == 'POST' || $method == 'Post' || $method == 'post'):
				$tenant_id = $this->users->get_user($username)->tenant_id;
			$permission = $this->users->check_permission($username);
			$data['employee_management'] = $permission->employee_management;
			$data['notifications'] = $this->employees->get_notifications(0);
			$data['payroll_management'] = $permission->payroll_management;
			$data['biometrics'] = $permission->biometrics;
			$data['user_management'] = $permission->user_management;
			$data['configuration'] = $permission->configuration;
			$data['payroll_configuration'] = $permission->payroll_configuration;
			$data['hr_configuration'] = $permission->hr_configuration;

			if($permission->hr_configuration == 1):
				$data['user_data'] = $this->users->get_user($username);


				$question = $this->input->post('question');

				$question_array = array(
					'qualitative_question'=>$question,
					'tenant_id' => $tenant_id
				);
				$question_array = $this->security->xss_clean($question_array);

				$query = $this->hr_configurations->add_qualitative_assessment($question_array);

				if($query == true):

				$log_array = array( 'tenant_id' => $tenant_id,
						'log_user_id' => $this->users->get_user($username)->user_id,
						'log_description' => "Added A New Qualitative Assessment Question"
					);

					$this->logs->add_log($log_array);

					$msg = array(
						'msg'=> 'Question Added Successfully',
						'location' => site_url('qualitative_assessment'),
						'type' => 'success'

					);
					$this->load->view('swal', $msg);

				else:
					echo "An Error Occurred";
				endif;

			else:

				redirect('/access_denied');

			endif;

			else:
				redirect('error_404');
				endif;
		else:
			redirect('/login');
		endif;

	}

	public function update_qualitative_assessment(){
		$username = $this->session->userdata('user_username');

		if(isset($username)):
			$method = $this->input->server('REQUEST_METHOD');
			if($method == 'POST' || $method == 'Post' || $method == 'post'):
				$tenant_id = $this->users->get_user($username)->tenant_id;
			$permission = $this->users->check_permission($username);
			$data['employee_management'] = $permission->employee_management;
			$data['notifications'] = $this->employees->get_notifications(0);
			$data['payroll_management'] = $permission->payroll_management;
			$data['biometrics'] = $permission->biometrics;
			$data['user_management'] = $permission->user_management;
			$data['configuration'] = $permission->configuration;
			$data['payroll_configuration'] = $permission->payroll_configuration;
			$data['hr_configuration'] = $permission->hr_configuration;

			if($permission->hr_configuration == 1):


				$data['user_data'] = $this->users->get_user($username);
				$question_id = $this->input->post('question_id');
				$question = $this->input->post('question');

				$question_array = array(
					'qualitative_question'=>$question,
				);
				$question_array = $this->security->xss_clean($question_array);

				$query = $this->hr_configurations->update_qualitative_assessment($question_id, $question_array);

				if($query == true):

				$log_array = array( 'tenant_id' => $tenant_id,
						'log_user_id' => $this->users->get_user($username)->user_id,
						'log_description' => "Update a Qualitative Assessment Question"
					);

					$this->logs->add_log($log_array);

					$msg = array(
						'msg'=> 'Question Updated Successfully',
						'location' => site_url('qualitative_assessment'),
						'type' => 'success'

					);
					$this->load->view('swal', $msg);


				else:
					echo "An Error Occurred";
				endif;

			else:

				redirect('/access_denied');

			endif;

			else:
				redirect('error_404');
				endif;
		else:
			redirect('/login');
		endif;

	}

	public function supervisor_assessment(){

		$username = $this->session->userdata('user_username');

		if(isset($username)):
			$user_type = $this->users->get_user($username)->user_type;

			if($user_type == 1 || $user_type == 3 || $user_type == 4):
				$tenant_id = $this->users->get_user($username)->tenant_id;
			$permission = $this->users->check_permission($username);
			$data['employee_management'] = $permission->employee_management;
			$data['notifications'] = $this->employees->get_notifications(0);
			$data['payroll_management'] = $permission->payroll_management;
			$data['biometrics'] = $permission->biometrics;
			$data['user_management'] = $permission->user_management;
			$data['configuration'] = $permission->configuration;
			$data['payroll_configuration'] = $permission->payroll_configuration;
			$data['hr_configuration'] = $permission->hr_configuration;

			if($permission->hr_configuration == 1):

				$data['user_data'] = $this->users->get_user($username);
				//$data['employees'] = $this->employees->get_employee_by_salary_setup();
				$data['questions'] = $this->hr_configurations->view_supervisor_assessments($tenant_id);
				$data['csrf_name'] = $this->security->get_csrf_token_name();
				$data['csrf_hash'] = $this->security->get_csrf_hash();

				$this->load->view('hr_config/supervisor_assessment', $data);

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

	public function add_supervisor_assessment(){
		$username = $this->session->userdata('user_username');

		if(isset($username)):
			$method = $this->input->server('REQUEST_METHOD');
			if($method == 'POST' || $method == 'Post' || $method == 'post'):
				$tenant_id = $this->users->get_user($username)->tenant_id;
			$permission = $this->users->check_permission($username);
			$data['employee_management'] = $permission->employee_management;
			$data['notifications'] = $this->employees->get_notifications(0);
			$data['payroll_management'] = $permission->payroll_management;
			$data['biometrics'] = $permission->biometrics;
			$data['user_management'] = $permission->user_management;
			$data['configuration'] = $permission->configuration;
			$data['payroll_configuration'] = $permission->payroll_configuration;
			$data['hr_configuration'] = $permission->hr_configuration;

			if($permission->hr_configuration == 1):
				$data['user_data'] = $this->users->get_user($username);


				$question = $this->input->post('question');

				$question_array = array(
					'supervisor_appraisee_question'=>$question,
				);
				$question_array = $this->security->xss_clean($question_array);

				$query = $this->hr_configurations->add_supervisor_assessment($question_array);

				if($query == true):

				$log_array = array( 'tenant_id' => $tenant_id,
						'log_user_id' => $this->users->get_user($username)->user_id,
						'log_description' => "Added A New Supervisor Assessment Question"
					);

					$this->logs->add_log($log_array);

					$msg = array(
						'msg'=> 'Question Added Successfully',
						'location' => site_url('supervisor_assessment'),
						'type' => 'success'

					);
					$this->load->view('swal', $msg);

				else:
					echo "An Error Occurred";
				endif;

			else:

				redirect('/access_denied');

			endif;

			else:

				redirect('error_404');
				endif;
		else:
			redirect('/login');
		endif;

	}

	public function update_supervisor_assessment(){
		$username = $this->session->userdata('user_username');

		if(isset($username)):
			$method = $this->input->server('REQUEST_METHOD');
			if($method == 'POST' || $method == 'Post' || $method == 'post'):
				$tenant_id = $this->users->get_user($username)->tenant_id;
			$permission = $this->users->check_permission($username);
			$data['employee_management'] = $permission->employee_management;
			$data['notifications'] = $this->employees->get_notifications(0);
			$data['payroll_management'] = $permission->payroll_management;
			$data['biometrics'] = $permission->biometrics;
			$data['user_management'] = $permission->user_management;
			$data['configuration'] = $permission->configuration;
			$data['payroll_configuration'] = $permission->payroll_configuration;
			$data['hr_configuration'] = $permission->hr_configuration;

			if($permission->hr_configuration == 1):


				$data['user_data'] = $this->users->get_user($username);
				$question_id = $this->input->post('question_id');
				$question = $this->input->post('question');

				$question_array = array(
					'supervisor_appraisee_question'=>$question,
				);
				$question_array = $this->security->xss_clean($question_array);

				$query = $this->hr_configurations->update_supervisor_assessment($question_id, $question_array);

				if($query == true):

				$log_array = array( 'tenant_id' => $tenant_id,
						'log_user_id' => $this->users->get_user($username)->user_id,
						'log_description' => "Updated a Supervisor Assessment Question"
					);

					$this->logs->add_log($log_array);

					$msg = array(
						'msg'=> 'Question Updated Successfully',
						'location' => site_url('supervisor_assessment'),
						'type' => 'success'

					);
					$this->load->view('swal', $msg);


				else:
					echo "An Error Occurred";
				endif;

			else:

				redirect('/access_denied');

			endif;

			else:

				redirect('error_404');

				endif;
		else:
			redirect('/login');
		endif;

	}


	public function trainings(){
		$username = $this->session->userdata('user_username');

		if(isset($username)):
			$user_type = $this->users->get_user($username)->user_type;

			if($user_type == 1 || $user_type == 3 || $user_type == 4):
				$tenant_id = $this->users->get_user($username)->tenant_id;
				$permission = $this->users->check_permission($username);
				$data['employee_management'] = $permission->employee_management;
				$data['notifications'] = $this->employees->get_notifications(0);
				$data['payroll_management'] = $permission->payroll_management;
				$data['biometrics'] = $permission->biometrics;
				$data['user_management'] = $permission->user_management;
				$data['configuration'] = $permission->configuration;
				$data['payroll_configuration'] = $permission->payroll_configuration;
				$data['hr_configuration'] = $permission->hr_configuration;

				if($permission->hr_configuration == 1):


					$data['user_data'] = $this->users->get_user($username);
					//$data['employees'] = $this->employees->get_employee_by_salary_setup();
					$data['trainings'] = $this->hr_configurations->view_trainings($tenant_id);
					$data['csrf_name'] = $this->security->get_csrf_token_name();
					$data['csrf_hash'] = $this->security->get_csrf_hash();

					$this->load->view('hr_config/trainings', $data);

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

	public function new_training(){
		$username = $this->session->userdata('user_username');

		if(isset($username)):
			$user_type = $this->users->get_user($username)->user_type;

			if($user_type == 1 || $user_type == 3 || $user_type == 4):
				$permission = $this->users->check_permission($username);
				$data['employee_management'] = $permission->employee_management;
				$data['notifications'] = $this->employees->get_notifications(0);
				$data['payroll_management'] = $permission->payroll_management;
				$data['biometrics'] = $permission->biometrics;
				$data['user_management'] = $permission->user_management;
				$data['configuration'] = $permission->configuration;
				$data['payroll_configuration'] = $permission->payroll_configuration;
				$data['hr_configuration'] = $permission->hr_configuration;

				if($permission->hr_configuration == 1):


					$data['user_data'] = $this->users->get_user($username);
					//$data['employees'] = $this->employees->get_employee_by_salary_setup();

					$data['csrf_name'] = $this->security->get_csrf_token_name();
					$data['csrf_hash'] = $this->security->get_csrf_hash();

					$this->load->view('hr_config/new_training', $data);

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


	public function upload_training_materials()
	{

		$config['upload_path'] = 'uploads/trainings';
		$config['allowed_types'] = 'gif|jpg|jpeg|png|pdf|mov|mp4|mp3';
		$config['max_size'] = '8000000';
		$config['max_width'] = '102452';
		$config['max_height'] = '768555';
		$config['encrypt_name'] = TRUE;
		//$config['overwrite'] = TRUE;

		$this->load->library('upload', $config);
		$this->upload->do_upload('file');


		$file_data = $this->upload->data();
		echo $file_data['file_name'];

	}

	public function add_training(){

		error_reporting(0);
		$username = $this->session->userdata('user_username');

		if (isset($username)):
			$method = $this->input->server('REQUEST_METHOD');
			if($method == 'POST' || $method == 'Post' || $method == 'post'):
				$tenant_id = $this->users->get_user($username)->tenant_id;
			$permission = $this->users->check_permission($username);
			$data['employee_management'] = $permission->employee_management;
			$data['notifications'] = $this->employees->get_notifications(0);
			$data['payroll_management'] = $permission->payroll_management;
			$data['biometrics'] = $permission->biometrics;
			$data['user_management'] = $permission->user_management;
			$data['configuration'] = $permission->configuration;
			$data['payroll_configuration'] = $permission->payroll_configuration;
			$data['hr_configuration'] = $permission->hr_configuration;

			if ($permission->employee_management == 1):

				extract($_POST);

				$training_data = array(
					'training_name' => $training_name,
					'training_about' => $training_about,
					'training_duration_exam' => $training_exam_duration,
					'tenant_id' => $tenant_id
				);


				$training_data = $this->security->xss_clean($training_data);


				$training_id = $this->hr_configurations->add_training($training_data);
				$k = 0;

				while ($k < count($training_materials)):
					$training_material = $training_materials[$k];

					$material_array = array(
						'training_material_training_id' => $training_id,
						'training_material_link' => $training_material,
						'tenant_id' => $tenant_id
					);

					$this->hr_configurations->add_training_materials($material_array);
					$k++;
				endwhile;



				if (isset($training_id)):
				$log_array = array( 'tenant_id' => $tenant_id,
						'log_user_id' => $this->users->get_user($username)->user_id,
						'log_description' => "Added New Training"
					);

					$this->logs->add_log($log_array);


					$msg = array(
						'msg' => 'New Training Added Successfully',
						'location' => site_url('trainings'),
						'type' => 'success'

					);
					$this->load->view('swal', $msg);
				else:
					$msg = array(
						'msg' => 'An Error Occurred',
						'location' => site_url('new_training'),
						'type' => 'error'

					);
					$this->load->view('swal', $msg);

				endif;
			else:

				redirect('/access_denied');

			endif;

			else:

				redirect('error_404');
				endif;
		else:
			redirect('/login');
		endif;



	}

	public function edit_training(){

		$training_id = $this->uri->segment(2);

		$username = $this->session->userdata('user_username');

		if(isset($username)):
			$user_type = $this->users->get_user($username)->user_type;
			$tenant_id = $this->users->get_user($username)->tenant_id;
			if($user_type == 1 || $user_type == 3 || $user_type == 4):
				$permission = $this->users->check_permission($username);
				$data['employee_management'] = $permission->employee_management;
				$data['notifications'] = $this->employees->get_notifications(0);
				$data['payroll_management'] = $permission->payroll_management;
				$data['biometrics'] = $permission->biometrics;
				$data['user_management'] = $permission->user_management;
				$data['configuration'] = $permission->configuration;
				$data['payroll_configuration'] = $permission->payroll_configuration;
				$data['hr_configuration'] = $permission->hr_configuration;

				if($permission->hr_configuration == 1):

					if(empty($training_id)):

						redirect('error_404');

					else:

						$check_existing_training = $this->hr_configurations-> view_training($training_id , $tenant_id);

						if(empty($check_existing_training)):

							redirect('error_404');

						else:

							$data['user_data'] = $this->users->get_user($username);
							//$data['employees'] = $this->employees->get_employee_by_salary_setup();
							$data['training'] = $check_existing_training;
							$data['training_materials'] = $this->hr_configurations->view_training_materials($training_id, $tenant_id);
							$data['csrf_name'] = $this->security->get_csrf_token_name();
							$data['csrf_hash'] = $this->security->get_csrf_hash();
							$this->load->view('hr_config/edit_training', $data);
						endif;

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

	public function update_training(){

		error_reporting(0);
		$username = $this->session->userdata('user_username');

		if (isset($username)):

			$method = $this->input->server('REQUEST_METHOD');
			if($method == 'POST' || $method == 'Post' || $method == 'post'):
				$tenant_id = $this->users->get_user($username)->tenant_id;

			$permission = $this->users->check_permission($username);
			$data['employee_management'] = $permission->employee_management;
			$data['notifications'] = $this->employees->get_notifications(0);
			$data['payroll_management'] = $permission->payroll_management;
			$data['biometrics'] = $permission->biometrics;
			$data['user_management'] = $permission->user_management;
			$data['configuration'] = $permission->configuration;
			$data['payroll_configuration'] = $permission->payroll_configuration;
			$data['hr_configuration'] = $permission->hr_configuration;

			if ($permission->employee_management == 1):

				extract($_POST);

				$training_data = array(
					'training_name' => $training_name,
					'training_about' => $training_about,
					'training_duration_exam' => $training_exam_duration,
				);


				$training_data = $this->security->xss_clean($training_data);


				 $this->hr_configurations->update_training($training_id, $training_data);
				$k = 0;

				while ($k < count($training_materials)):
					$training_material = $training_materials[$k];

					$material_array = array(
						'training_material_training_id' => $training_id,
						'training_material_link' => $training_material
					);

					$this->hr_configurations->add_training_materials($material_array);
					$k++;
				endwhile;



				if (isset($training_id)):
				$log_array = array( 'tenant_id' => $tenant_id,
						'log_user_id' => $this->users->get_user($username)->user_id,
						'log_description' => "Updated Training"
					);

					$this->logs->add_log($log_array);


					$msg = array(
						'msg' => 'Training Updated Successfully',
						'location' => site_url('trainings'),
						'type' => 'success'

					);
					$this->load->view('swal', $msg);
				else:
					$msg = array(
						'msg' => 'An Error Occurred',
						'location' => site_url('trainings'),
						'type' => 'error'

					);
					$this->load->view('swal', $msg);

				endif;
			else:

				redirect('/access_denied');

			endif;

			else:

				redirect('error_404');

				endif;
		else:
			redirect('/login');
		endif;



	}

	public function remove_material(){

			$material_id = $_GET['material_id'];
			$this->hr_configurations->remove_material($material_id);

	}

	public function training_questions(){

		$training_id = $this->uri->segment(2);

		$username = $this->session->userdata('user_username');

		if(isset($username)):
			$user_type = $this->users->get_user($username)->user_type;
			$tenant_id = $this->users->get_user($username)->tenant_id;
			if($user_type == 1 || $user_type == 3 || $user_type == 4):
				$permission = $this->users->check_permission($username);
				$data['employee_management'] = $permission->employee_management;
$data['notifications'] = $this->employees->get_notifications(0);
				$data['payroll_management'] = $permission->payroll_management;
				$data['biometrics'] = $permission->biometrics;
				$data['user_management'] = $permission->user_management;
				$data['configuration'] = $permission->configuration;
				$data['payroll_configuration'] = $permission->payroll_configuration;
				$data['hr_configuration'] = $permission->hr_configuration;

				if($permission->hr_configuration == 1):

					if(empty($training_id)):

						redirect('error_404');

					else:

						$check_existing_training = $this->hr_configurations-> view_training($training_id, $tenant_id);

						if(empty($check_existing_training)):

							redirect('error_404');

						else:

							$data['user_data'] = $this->users->get_user($username);
							//$data['employees'] = $this->employees->get_employee_by_salary_setup();
							$data['training'] = $check_existing_training;
							$data['training_questions'] = $this->hr_configurations->view_training_questions($training_id, $tenant_id);
							$data['csrf_name'] = $this->security->get_csrf_token_name();
							$data['csrf_hash'] = $this->security->get_csrf_hash();
							$this->load->view('hr_config/training_questions', $data);
						endif;

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

	public function add_question(){



		$username = $this->session->userdata('user_username');

		if(isset($username)):

			$method = $this->input->server('REQUEST_METHOD');
			if($method == 'POST' || $method == 'Post' || $method == 'post'):
			$user_type = $this->users->get_user($username)->user_type;
				$tenant_id = $this->users->get_user($username)->tenant_id;

			if($user_type == 1 || $user_type == 3 || $user_type == 4):
				$permission = $this->users->check_permission($username);
				$data['employee_management'] = $permission->employee_management;
				$data['notifications'] = $this->employees->get_notifications(0);
				$data['payroll_management'] = $permission->payroll_management;
				$data['biometrics'] = $permission->biometrics;
				$data['user_management'] = $permission->user_management;
				$data['configuration'] = $permission->configuration;
				$data['payroll_configuration'] = $permission->payroll_configuration;
				$data['hr_configuration'] = $permission->hr_configuration;

				if($permission->hr_configuration == 1):

					extract($_POST);

				$question_array = array(
					'training_question_training_id' => $training_id,
					'training_question_question' => $training_question,
					'training_question_option_a' => $option_a,
					'training_question_option_b' => $option_b,
					'training_question_option_c' => $option_c,
					'training_question_option_d' => $option_d,
					'training_question_correct' => strtoupper($correct),
					'tenant_id' => $tenant_id

				);

					$question_array = $this->security->xss_clean($question_array);

					$response = $this->hr_configurations->add_question($question_array);

					if (isset($response)):
					$log_array = array( 'tenant_id' => $tenant_id,
							'log_user_id' => $this->users->get_user($username)->user_id,
							'log_description' => "Added New Question to Training"
						);

						$this->logs->add_log($log_array);


						$msg = array(
							'msg' => 'New Question Added Successfully',
							'location' => site_url('training_questions')."/".$training_id,
							'type' => 'success'

						);
						$this->load->view('swal', $msg);
					else:
						$msg = array(
							'msg' => 'An Error Occurred',
							'location' => site_url('training_questions')."/".$training_id,
							'type' => 'error'

						);
						$this->load->view('swal', $msg);

					endif;

				else:

					redirect('/access_denied');

				endif;

			else:

				redirect('/access_denied');

			endif;

			else:
				redirect('error_404');

				endif;
		else:
			redirect('/login');
		endif;


	}


	public function update_question(){

		$username = $this->session->userdata('user_username');

		if(isset($username)):

			$method = $this->input->server('REQUEST_METHOD');
			if($method == 'POST' || $method == 'Post' || $method == 'post'):

			$user_type = $this->users->get_user($username)->user_type;
				$tenant_id = $this->users->get_user($username)->tenant_id;
			if($user_type == 1 || $user_type == 3 || $user_type == 4):
				$permission = $this->users->check_permission($username);
				$data['employee_management'] = $permission->employee_management;
				$data['notifications'] = $this->employees->get_notifications(0);
				$data['payroll_management'] = $permission->payroll_management;
				$data['biometrics'] = $permission->biometrics;
				$data['user_management'] = $permission->user_management;
				$data['configuration'] = $permission->configuration;
				$data['payroll_configuration'] = $permission->payroll_configuration;
				$data['hr_configuration'] = $permission->hr_configuration;

				if($permission->hr_configuration == 1):

					extract($_POST);

					$question_array = array(
						'training_question_training_id' => $training_id,
						'training_question_question' => $training_question,
						'training_question_option_a' => $option_a,
						'training_question_option_b' => $option_b,
						'training_question_option_c' => $option_c,
						'training_question_option_d' => $option_d,
						'training_question_correct' => strtoupper($correct)

					);

					$question_array = $this->security->xss_clean($question_array);

					$response = $this->hr_configurations->update_question($question_id, $question_array);

					if ($response == true):
					$log_array = array( 'tenant_id' => $tenant_id,
							'log_user_id' => $this->users->get_user($username)->user_id,
							'log_description' => "Updated Training "
						);

						$this->logs->add_log($log_array);


						$msg = array(
							'msg' => 'Question Updated Successfully',
							'location' => site_url('training_questions')."/".$training_id,
							'type' => 'success'

						);
						$this->load->view('swal', $msg);
					else:
						$msg = array(
							'msg' => 'An Error Occurred',
							'location' => site_url('training_questions')."/".$training_id,
							'type' => 'error'

						);
						$this->load->view('swal', $msg);

					endif;

				else:

					redirect('/access_denied');

				endif;

			else:

				redirect('/access_denied');

			endif;

			else:
				redirect('error_404');
				endif;
		else:
			redirect('/login');
		endif;


	}


	public function view_training(){

		$training_id = $this->uri->segment(2);

		$username = $this->session->userdata('user_username');

		if(isset($username)):
			$user_type = $this->users->get_user($username)->user_type;

			if($user_type == 1 || $user_type == 3 || $user_type == 4):
				$tenant_id = $this->users->get_user($username)->tenant_id;
				$permission = $this->users->check_permission($username);
				$data['employee_management'] = $permission->employee_management;
				$data['notifications'] = $this->employees->get_notifications(0);
				$data['payroll_management'] = $permission->payroll_management;
				$data['biometrics'] = $permission->biometrics;
				$data['user_management'] = $permission->user_management;
				$data['configuration'] = $permission->configuration;
				$data['payroll_configuration'] = $permission->payroll_configuration;
				$data['hr_configuration'] = $permission->hr_configuration;

				if($permission->hr_configuration == 1):

					if(empty($training_id)):

						redirect('error_404');

					else:

						$check_existing_training = $this->hr_configurations-> view_training($training_id, $tenant_id);

						if(empty($check_existing_training)):

							redirect('error_404');

						else:

							$data['user_data'] = $this->users->get_user($username);
							//$data['employees'] = $this->employees->get_employee_by_salary_setup();
							$data['training'] = $check_existing_training;
							$data['training_materials'] = $this->hr_configurations->view_training_materials($training_id, $tenant_id);

							$data['training_questions'] = $this->hr_configurations->view_training_questions($training_id, $tenant_id);
							$data['csrf_name'] = $this->security->get_csrf_token_name();
							$data['csrf_hash'] = $this->security->get_csrf_hash();
							$this->load->view('hr_config/view_training', $data);
						endif;

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

	public function hr_documents(){

		$username = $this->session->userdata('user_username');

		if(isset($username)):
			$user_type = $this->users->get_user($username)->user_type;
			$tenant_id = $this->users->get_user($username)->tenant_id;
			if($user_type == 1 || $user_type == 3 || $user_type == 4):
				$permission = $this->users->check_permission($username);
				$data['employee_management'] = $permission->employee_management;
$data['notifications'] = $this->employees->get_notifications(0);
				$data['payroll_management'] = $permission->payroll_management;
				$data['biometrics'] = $permission->biometrics;
				$data['user_management'] = $permission->user_management;
				$data['configuration'] = $permission->configuration;
				$data['payroll_configuration'] = $permission->payroll_configuration;
				$data['hr_configuration'] = $permission->hr_configuration;

				if($permission->hr_configuration == 1):

					$data['user_data'] = $this->users->get_user($username);
					$data['documents'] = $this->hr_configurations->view_hr_documents($tenant_id);

					$data['csrf_name'] = $this->security->get_csrf_token_name();
					$data['csrf_hash'] = $this->security->get_csrf_hash();



					$this->load->view('hr_config/hr_document', $data);

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


	public function add_hr_document(){


		$username = $this->session->userdata('user_username');

		if(isset($username)):
			$method = $this->input->server('REQUEST_METHOD');
			if($method == 'POST' || $method == 'Post' || $method == 'post'):
			$user_type = $this->users->get_user($username)->user_type;
				$tenant_id = $this->users->get_user($username)->tenant_id;
			if($user_type == 1 || $user_type == 3 || $user_type == 4):
				$permission = $this->users->check_permission($username);
				$data['employee_management'] = $permission->employee_management;
$data['notifications'] = $this->employees->get_notifications(0);
				$data['payroll_management'] = $permission->payroll_management;
				$data['biometrics'] = $permission->biometrics;
				$data['user_management'] = $permission->user_management;
				$data['configuration'] = $permission->configuration;
				$data['payroll_configuration'] = $permission->payroll_configuration;
				$data['hr_configuration'] = $permission->hr_configuration;

				if($permission->hr_configuration == 1):

					$config['upload_path'] = 'uploads/documents';
					$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx';
					$config['max_size'] = '8000000';
					$config['max_width'] = '102452';
					$config['max_height'] = '768555';
					//$config['overwrite'] = TRUE;
					$config['encrypt_name'] = TRUE;

					$this->load->library('upload', $config);
					$upload = $this->upload->do_upload('hr_document');

					if (!$upload):

						$msg = array(
							'msg' => $this->upload->display_errors(),
							'location' => site_url('hr_documents'),
							'type' => 'error'

						);
						$this->load->view('swal', $msg);


					else:
						$file_data = $this->upload->data();
						$document_link = $file_data['file_name'];
						extract($_POST);

						$document_array = array(
							'hr_document_name' => $document_name,
							'hr_document_description' => $document_description,
							'hr_document_link' => $document_link,
							'tenant_id' => $tenant_id


						);

						$document_array = $this->security->xss_clean($document_array);

						$response = $this->hr_configurations->add_hr_document($document_array);

						if (isset($response)):
						$log_array = array( 'tenant_id' => $tenant_id,
								'log_user_id' => $this->users->get_user($username)->user_id,
								'log_description' => "Added New  Document"
							);

							$this->logs->add_log($log_array);


							$msg = array(
								'msg' => 'New Document Added Successfully',
								'location' => site_url('hr_documents'),
								'type' => 'success'

							);
							$this->load->view('swal', $msg);
						else:
							$msg = array(
								'msg' => 'An Error Occurred',
								'location' => site_url('hr_documents'),
								'type' => 'error'

							);
							$this->load->view('swal', $msg);

						endif;

					endif;

				else:

					redirect('/access_denied');

				endif;

			else:

				redirect('/access_denied');

			endif;

			else:
				redirect('error_404');
				endif;
		else:
			redirect('/login');
		endif;

	}


	public function view_hr_document(){

		$document_id = $this->uri->segment(2);

		$username = $this->session->userdata('user_username');

		if(isset($username)):
			$user_type = $this->users->get_user($username)->user_type;

			if($user_type == 1 || $user_type == 3 || $user_type == 4):
				$permission = $this->users->check_permission($username);
				$data['employee_management'] = $permission->employee_management;
$data['notifications'] = $this->employees->get_notifications(0);
				$data['payroll_management'] = $permission->payroll_management;
				$data['biometrics'] = $permission->biometrics;
				$data['user_management'] = $permission->user_management;
				$data['configuration'] = $permission->configuration;
				$data['payroll_configuration'] = $permission->payroll_configuration;
				$data['hr_configuration'] = $permission->hr_configuration;

				if($permission->hr_configuration == 1):

					if(empty($document_id)):

						redirect('error_404');

					else:

						$check_existing_document = $this->hr_configurations-> view_hr_document($document_id, $tenant_id);

						if(empty($check_existing_document)):

							redirect('error_404');

						else:

							$data['user_data'] = $this->users->get_user($username);

							$data['document'] = $check_existing_document;

							$data['csrf_name'] = $this->security->get_csrf_token_name();
							$data['csrf_hash'] = $this->security->get_csrf_hash();
							$this->load->view('hr_config/view_document', $data);
						endif;

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

	public function delete_hr_document(){

		$document_id = $this->uri->segment(2);

		$username = $this->session->userdata('user_username');

		if(isset($username)):
			$user_type = $this->users->get_user($username)->user_type;

			if($user_type == 1 || $user_type == 3 || $user_type == 4):
				$permission = $this->users->check_permission($username);
				$data['employee_management'] = $permission->employee_management;
$data['notifications'] = $this->employees->get_notifications(0);
				$data['payroll_management'] = $permission->payroll_management;
				$data['biometrics'] = $permission->biometrics;
				$data['user_management'] = $permission->user_management;
				$data['configuration'] = $permission->configuration;
				$data['payroll_configuration'] = $permission->payroll_configuration;
				$data['hr_configuration'] = $permission->hr_configuration;

				if($permission->hr_configuration == 1):

					if(empty($document_id)):

						redirect('error_404');

					else:

						$check_existing_document = $this->hr_configurations-> view_hr_document($document_id);

						if(empty($check_existing_document)):

							redirect('error_404');

						else:

							$response = $this->hr_configurations->remove_hr_document($document_id);

							if ($response == true):
							$log_array = array( 'tenant_id' => $tenant_id,
									'log_user_id' => $this->users->get_user($username)->user_id,
									'log_description' => "Deleted A Document"
								);

								$this->logs->add_log($log_array);


								$msg = array(
									'msg' => 'Document Deleted Successfully',
									'location' => site_url('hr_documents'),
									'type' => 'success'

								);
								$this->load->view('swal', $msg);
							else:
								$msg = array(
									'msg' => 'An Error Occurred',
									'location' => site_url('hr_documents'),
									'type' => 'error'

								);
								$this->load->view('swal', $msg);

							endif;


						endif;

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


	public function test(){

		$msg = array(
			'msg'=> 'Subsidiary Updated Successfully',
			'location' => site_url('test'),
			'type' => 'success'

		);
		$this->load->view('swal', $msg);

	}

	public function count_hr_documents() {
	  echo $this->hr_configurations-> count_documents();
  }
}
