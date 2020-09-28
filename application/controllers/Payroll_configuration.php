<?php


class Payroll_configuration extends CI_Controller
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
		$this->load->model('payroll_configurations');
		$this->load->model('employees');
		$this->load->model('hr_configurations');
		$this->load->model('logs');

	}

	public function tax_rate(){

		$username = $this->session->userdata('user_username');

		if(isset($username)):
			$user_type = $this->users->get_user($username)->user_type;

			$tenant_id = $this->users->get_user($username)->tenant_id;
			if($user_type == 1 || $user_type == 3 || $user_type == 4):

			$permission = $this->users->check_permission($username);
			$data['employee_management'] = $permission->employee_management;
			$data['notifications'] = $this->employees->get_notifications(0, $tenant_id);
			$data['payroll_management'] = $permission->payroll_management;
			$data['biometrics'] = $permission->biometrics;
			$data['user_management'] = $permission->user_management;
			$data['configuration'] = $permission->configuration;
			$data['payroll_configuration'] = $permission->payroll_configuration;
			$data['hr_configuration'] = $permission->hr_configuration;

			if($permission->payroll_configuration == 1):

				$data['user_data'] = $this->users->get_user($username);

				$data['tax_rates'] = $this->payroll_configurations->view_tax_rates($tenant_id);
				$data['csrf_name'] = $this->security->get_csrf_token_name();
				$data['csrf_hash'] = $this->security->get_csrf_hash();



				$this->load->view('payroll_config/tax_rate', $data);

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

	public function add_tax_rate(){
		$username = $this->session->userdata('user_username');

		if(isset($username)):
			$method = $this->input->server('REQUEST_METHOD');

		if($method == 'POST' || $method == 'Post' || $method == 'post'):

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

			if($permission->payroll_configuration == 1):

				$data['user_data'] = $this->users->get_user($username);
				$tax_rate_band = $this->input->post('tax_rate_band');
				$tax_rate_rate = $this->input->post('tax_rate_rate');
				$tax_rate_array = array(
					'tax_rate_band' => $tax_rate_band,
					'tax_rate_rate'=>$tax_rate_rate
				);
				$tax_rate_array = $this->security->xss_clean($tax_rate_array);
				$query = $this->payroll_configurations->add_tax_rate($tax_rate_array, $tenant_id);

				if($query == true):
					$log_array = array( 'tenant_id' => $tenant_id,
						'log_user_id' => $this->users->get_user($username)->user_id,
						'log_description' => "Added New Tax Rate"
					);

					$this->logs->add_log($log_array);

					$msg = array(
						'msg'=> 'Tax Rate Added Successfully',
						'location' => site_url('tax_rates'),
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

	public function update_tax_rate(){
		$username = $this->session->userdata('user_username');

		if(isset($username)):

			$method = $this->input->server('REQUEST_METHOD');

			if($method == 'POST' || $method == 'Post' || $method == 'post'):

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

			if($permission->payroll_configuration == 1):

				$data['user_data'] = $this->users->get_user($username);

				$tax_rate_id = $this->input->post('tax_rate_id');
				$tax_rate_band = $this->input->post('tax_rate_band');
				$tax_rate_rate = $this->input->post('tax_rate_rate');
				$tax_rate_array = array(
					'tax_rate_band' => $tax_rate_band,
					'tax_rate_rate'=>$tax_rate_rate
				);
				$tax_rate_array = $this->security->xss_clean($tax_rate_array);
				$tax_rate_array = $this->security->xss_clean($tax_rate_array);
				$query = $this->payroll_configurations->update_tax_rate($tax_rate_id, $tax_rate_array, $tenant_id);

				if($query == true):
					$log_array = array( 'tenant_id' => $tenant_id,
						'log_user_id' => $this->users->get_user($username)->user_id,
						'log_description' => "Updated Tax Rate"
					);

					$this->logs->add_log($log_array);
					$msg = array(
						'msg'=> 'Tax Rate Updated Successfully',
						'location' => site_url('tax_rates'),
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
				redirect('error_4040');

		endif;
		else:
			redirect('/login');
		endif;

	}


	public function payment_definition(){

		$username = $this->session->userdata('user_username');

		if(isset($username)):
			$user_type = $this->users->get_user($username)->user_type;

			$tenant_id = $this->users->get_user($username)->tenant_id;
			if($user_type == 1 || $user_type == 3 || $user_type == 4):

			$permission = $this->users->check_permission($username);
			$data['employee_management'] = $permission->employee_management;
			$data['notifications'] = $this->employees->get_notifications(0, $tenant_id);
			$data['payroll_management'] = $permission->payroll_management;
			$data['biometrics'] = $permission->biometrics;
			$data['user_management'] = $permission->user_management;
			$data['configuration'] = $permission->configuration;
			$data['payroll_configuration'] = $permission->payroll_configuration;
			$data['hr_configuration'] = $permission->hr_configuration;

			if($permission->payroll_configuration == 1):


				$data['user_data'] = $this->users->get_user($username);

				$data['tax_rates'] = $this->payroll_configurations->view_tax_rates($tenant_id);

				$data['payment_definitions'] = $this->payroll_configurations->view_payment_definitions($tenant_id);
				$data['csrf_name'] = $this->security->get_csrf_token_name();
				$data['csrf_hash'] = $this->security->get_csrf_hash();





				$this->load->view('payroll_config/payment_definition', $data);

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

	public function new_payment_definition(){

		$username = $this->session->userdata('user_username');

		if(isset($username)):
			$user_type = $this->users->get_user($username)->user_type;

			$tenant_id = $this->users->get_user($username)->tenant_id;
			if($user_type == 1 || $user_type == 3 || $user_type == 4):
			$permission = $this->users->check_permission($username);
			$data['employee_management'] = $permission->employee_management;
			$data['notifications'] = $this->employees->get_notifications(0, $tenant_id);
			$data['payroll_management'] = $permission->payroll_management;
			$data['biometrics'] = $permission->biometrics;
			$data['user_management'] = $permission->user_management;
			$data['configuration'] = $permission->configuration;
			$data['payroll_configuration'] = $permission->payroll_configuration;
			$data['hr_configuration'] = $permission->hr_configuration;

			if($permission->payroll_configuration == 1):

				$data['user_data'] = $this->users->get_user($username);

				//$data['tax_rates'] = $this->payroll_configurations->view_tax_rates();

				$data['tie_numbers'] = $this->payroll_configurations->view_tie_number_fields();
				$data['csrf_name'] = $this->security->get_csrf_token_name();
				$data['csrf_hash'] = $this->security->get_csrf_hash();





				$this->load->view('payroll_config/new_payment_definition', $data);


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

	public function add_payment_definition(){
		$username = $this->session->userdata('user_username');

		if(isset($username)):
			$method = $this->input->server('REQUEST_METHOD');

			if($method == 'POST' || $method == 'Post' || $method == 'post'):

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

			if($permission->payroll_configuration == 1):

				$data['user_data'] = $this->users->get_user($username);
					$payment_definition_code = $this->input->post('payment_definition_code');
					$payment_definition_name = $this->input->post('payment_definition_name');
					$payment_definition_variant = $this->input->post('payment_definition_variant');
					$payment_definition_type = $this->input->post('payment_definition_type');



					if ($payment_definition_type == 0):
						$payment_definition_taxable = 0;
						$payment_definition_desc = $this->input->post('payment_definition_desc');
						$payment_definition_tie_number = $this->input->post('payment_definition_tie_number');
						$payment_definition_basic = 0;

					endif;

					if($payment_definition_type == 1):
						$payment_definition_taxable = $this->input->post('payment_definition_taxable');
						$payment_definition_basic = $this->input->post('payment_definition_basic');
						$payment_definition_desc = 0;
						$payment_definition_tie_number = 0;

				endif;


				$payment_definition_array = array(

					'payment_definition_payment_code'=> $payment_definition_code,
					'payment_definition_payment_name' => $payment_definition_name,
					'payment_definition_type' => $payment_definition_type,
					'payment_definition_variant' => $payment_definition_variant,
					'payment_definition_taxable' => $payment_definition_taxable,
					'payment_definition_desc' => $payment_definition_desc,
					'payment_definition_tie_number' => $payment_definition_tie_number,
					'payment_definition_basic' => $payment_definition_basic,
					'tenant_id' => $tenant_id
				);
				$payment_definition_array = $this->security->xss_clean($payment_definition_array);

				//print_r($payment_definition_array);

				$query = $this->payroll_configurations->add_payment_definition($payment_definition_array);

				if($query == true):
					$log_array = array( 'tenant_id' => $tenant_id,
						'log_user_id' => $this->users->get_user($username)->user_id,
						'log_description' => "Added New Payment Definition"
					);

					$this->logs->add_log($log_array);
					$msg = array(
						'msg'=> 'Payment Definition Added Successfully',
						'location' => site_url('payment_definition'),
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

	public function edit_payment_definition(){

		$payment_definition_id = $this->uri->segment(2);


		$username = $this->session->userdata('user_username');

		if(isset($username)):
			$user_type = $this->users->get_user($username)->user_type;

			$tenant_id = $this->users->get_user($username)->tenant_id;
			if($user_type == 1 || $user_type == 3 || $user_type == 4):
			$permission = $this->users->check_permission($username);
			$data['employee_management'] = $permission->employee_management;
			$data['notifications'] = $this->employees->get_notifications(0, $tenant_id);
			$data['payroll_management'] = $permission->payroll_management;
			$data['biometrics'] = $permission->biometrics;
			$data['user_management'] = $permission->user_management;
			$data['configuration'] = $permission->configuration;
			$data['payroll_configuration'] = $permission->payroll_configuration;
			$data['hr_configuration'] = $permission->hr_configuration;

			if($permission->payroll_configuration == 1):

				$data['user_data'] = $this->users->get_user($username);

				$data['payment_definition'] = $this->payroll_configurations->view_payment_definition($payment_definition_id, $tenant_id);

				if(empty($data['payment_definition'])):

					redirect('error_404');

				else:



				$data['tie_numbers'] = $this->payroll_configurations->view_tie_number_fields();
				$data['csrf_name'] = $this->security->get_csrf_token_name();
				$data['csrf_hash'] = $this->security->get_csrf_hash();






				$this->load->view('payroll_config/edit_payment_definition', $data);

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

	public function update_payment_definition(){
		$username = $this->session->userdata('user_username');

		if(isset($username)):
			$method = $this->input->server('REQUEST_METHOD');

			if($method == 'POST' || $method == 'Post' || $method == 'post'):

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

			if($permission->payroll_configuration == 1):

				$data['user_data'] = $this->users->get_user($username);
				$payment_definition_code = $this->input->post('payment_definition_code');
				$payment_definition_name = $this->input->post('payment_definition_name');
				$payment_definition_variant = $this->input->post('payment_definition_variant');
				$payment_definition_type = $this->input->post('payment_definition_type');

				$payment_definition_id = $this->input->post('payment_definition_id');

				if ($payment_definition_type == 0):
					$payment_definition_taxable = 0;
					$payment_definition_desc = $this->input->post('payment_definition_desc');
					$payment_definition_tie_number = $this->input->post('payment_definition_tie_number');
					$payment_definition_basic = 0;

				endif;

				if($payment_definition_type == 1):
					$payment_definition_taxable = $this->input->post('payment_definition_taxable');
					$payment_definition_basic = $this->input->post('payment_definition_basic');
					$payment_definition_desc = 0;
					$payment_definition_tie_number = 0;

				endif;


				$payment_definition_array = array(

					'payment_definition_payment_code'=> $payment_definition_code,
					'payment_definition_payment_name' => $payment_definition_name,
					'payment_definition_type' => $payment_definition_type,
					'payment_definition_variant' => $payment_definition_variant,
					'payment_definition_taxable' => $payment_definition_taxable,
					'payment_definition_desc' => $payment_definition_desc,
					'payment_definition_tie_number' => $payment_definition_tie_number,
					'payment_definition_basic' => $payment_definition_basic,
				);
				$payment_definition_array = $this->security->xss_clean($payment_definition_array);


				$query = $this->payroll_configurations->update_payment_definition($payment_definition_id, $payment_definition_array);

				if($query == true):
					$log_array = array( 'tenant_id' => $tenant_id,
						'log_user_id' => $this->users->get_user($username)->user_id,
						'log_description' => "Updated Payment Definition"
					);

					$this->logs->add_log($log_array);
					$msg = array(
						'msg'=> 'Payment Definition Updated Successfully',
						'location' => site_url('payment_definition'),
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


	public function salary_structure(){

		$username = $this->session->userdata('user_username');

		if(isset($username)):
			$user_type = $this->users->get_user($username)->user_type;

			$tenant_id = $this->users->get_user($username)->tenant_id;
			if($user_type == 1 || $user_type == 3 || $user_type == 4):
			$permission = $this->users->check_permission($username);
			$data['employee_management'] = $permission->employee_management;
			$data['notifications'] = $this->employees->get_notifications(0, $tenant_id);
			$data['payroll_management'] = $permission->payroll_management;
			$data['biometrics'] = $permission->biometrics;
			$data['user_management'] = $permission->user_management;
			$data['configuration'] = $permission->configuration;
			$data['payroll_configuration'] = $permission->payroll_configuration;
			$data['hr_configuration'] = $permission->hr_configuration;

			if($permission->payroll_configuration == 1):

				$data['user_data'] = $this->users->get_user($username);

				$data['csrf_name'] = $this->security->get_csrf_token_name();
				$data['csrf_hash'] = $this->security->get_csrf_hash();

				$data['salary_structures'] = $this->payroll_configurations->view_salary_structures($tenant_id);

				$this->load->view('payroll_config/salary_structure', $data);
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

	public function add_salary_structure(){
		$username = $this->session->userdata('user_username');

		if(isset($username)):
			$method = $this->input->server('REQUEST_METHOD');

			if($method == 'POST' || $method == 'Post' || $method == 'post'):

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

			if($permission->payroll_configuration == 1):

				$data['user_data'] = $this->users->get_user($username);
				$salary_structure_name = $this->input->post('salary_structure_name');

				$salary_structure_array = array(
					'salary_structure_category_name' => $salary_structure_name,
					'tenant_id' => $tenant_id

				);
				$salary_structure_array = $this->security->xss_clean($salary_structure_array);
				$query = $this->payroll_configurations->add_salary_structure($salary_structure_array);

				if($query == true):
					$log_array = array( 'tenant_id' => $tenant_id,
						'log_user_id' => $this->users->get_user($username)->user_id,
						'log_description' => "Added New Salary Structure"
					);

					$this->logs->add_log($log_array);
					$msg = array(
						'msg'=> 'Salary Structure Added Successfully',
						'location' => site_url('salary_structure'),
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

	public function update_salary_structure(){
		$username = $this->session->userdata('user_username');

		if(isset($username)):
			$method = $this->input->server('REQUEST_METHOD');

			if($method == 'POST' || $method == 'Post' || $method == 'post'):

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

			if($permission->payroll_configuration == 1):

				$data['user_data'] = $this->users->get_user($username);

				$salary_structure_name = $this->input->post('salary_structure_name');
				$salary_structure_id = $this->input->post('salary_structure_id');

				$salary_structure_array = array(
					'salary_structure_category_name' => $salary_structure_name,

				);
				$salary_structure_array = $this->security->xss_clean($salary_structure_array);

				$query = $this->payroll_configurations->update_salary_structure($salary_structure_id, $salary_structure_array);

				if($query == true):
					$log_array = array( 'tenant_id' => $tenant_id,
						'log_user_id' => $this->users->get_user($username)->user_id,
						'log_description' => "Updated Salary Structure"
					);

					$this->logs->add_log($log_array);
					$msg = array(
						'msg'=> 'Salary Structure Updated Successfully',
						'location' => site_url('salary_structure'),
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

	public function view_salary_structure(){

		$username = $this->session->userdata('user_username');
		$allowance_id = $this->uri->segment(2);

		if(isset($username)):
			$user_type = $this->users->get_user($username)->user_type;

			$tenant_id = $this->users->get_user($username)->tenant_id;
			if($user_type == 1 || $user_type == 3 || $user_type == 4):
			$permission = $this->users->check_permission($username);
			$data['employee_management'] = $permission->employee_management;
			$data['notifications'] = $this->employees->get_notifications(0, $tenant_id);
			$data['payroll_management'] = $permission->payroll_management;
			$data['biometrics'] = $permission->biometrics;
			$data['user_management'] = $permission->user_management;
			$data['configuration'] = $permission->configuration;
			$data['payroll_configuration'] = $permission->payroll_configuration;
			$data['hr_configuration'] = $permission->hr_configuration;

			if($permission->payroll_configuration == 1):

				$data['user_data'] = $this->users->get_user($username);

				$data['csrf_name'] = $this->security->get_csrf_token_name();
				$data['csrf_hash'] = $this->security->get_csrf_hash();

				$data['salary_structure_category'] = $this->payroll_configurations->view_salary_structure($allowance_id, $tenant_id);

				if(empty($data['salary_structure_category'])):
					redirect('/error_404');
				else:

				$salary_structure_category_id = $data['salary_structure_category']->salary_structure_id;

				$data['allowances'] = $this->payroll_configurations->view_salary_structure_allowances($salary_structure_category_id, $tenant_id);
				//print_r($data['salary_structure_category']);

				;

				//print_r($data['allowances']);


				$this->load->view('payroll_config/view_salary_structure', $data);
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



	public function allowance(){
		$username = $this->session->userdata('user_username');

		if(isset($username)):
			$user_type = $this->users->get_user($username)->user_type;

			$tenant_id = $this->users->get_user($username)->tenant_id;
			if($user_type == 1 || $user_type == 3 || $user_type == 4):
			$permission = $this->users->check_permission($username);
			$data['employee_management'] = $permission->employee_management;
			$data['notifications'] = $this->employees->get_notifications(0, $tenant_id);
			$data['payroll_management'] = $permission->payroll_management;
			$data['biometrics'] = $permission->biometrics;
			$data['user_management'] = $permission->user_management;
			$data['configuration'] = $permission->configuration;
			$data['payroll_configuration'] = $permission->payroll_configuration;
			$data['hr_configuration'] = $permission->hr_configuration;

			if($permission->payroll_configuration == 1):

				$data['user_data'] = $this->users->get_user($username);

				$data['csrf_name'] = $this->security->get_csrf_token_name();
				$data['csrf_hash'] = $this->security->get_csrf_hash();
				$data['allowances'] = $this->payroll_configurations->view_allowances($tenant_id);

				$data['salary_structures'] = $this->payroll_configurations->view_salary_structures($tenant_id);

				$this->load->view('payroll_config/allowance', $data);

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

	public function new_salary_allowance(){
		$username = $this->session->userdata('user_username');

		if(isset($username)):
			$user_type = $this->users->get_user($username)->user_type;

			$tenant_id = $this->users->get_user($username)->tenant_id;
			if($user_type == 1 || $user_type == 3 || $user_type == 4):
			$permission = $this->users->check_permission($username);
			$data['employee_management'] = $permission->employee_management;
$data['notifications'] = $this->employees->get_notifications(0, $tenant_id);
			$data['payroll_management'] = $permission->payroll_management;
			$data['biometrics'] = $permission->biometrics;
			$data['user_management'] = $permission->user_management;
			$data['configuration'] = $permission->configuration;
			$data['payroll_configuration'] = $permission->payroll_configuration;
			$data['hr_configuration'] = $permission->hr_configuration;

			if($permission->payroll_configuration == 1):

				$data['user_data'] = $this->users->get_user($username);

				$data['csrf_name'] = $this->security->get_csrf_token_name();
				$data['csrf_hash'] = $this->security->get_csrf_hash();

				$data['salary_structures'] = $this->payroll_configurations->view_salary_structures($tenant_id);
				$data['payment_definitions'] = $this->payroll_configurations->view_standard_payment_definition($tenant_id);

				$this->load->view('payroll_config/new_salary_allowance', $data);
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

	public function add_salary_allowance(){
		$username = $this->session->userdata('user_username');

		if(isset($username)):
			$method = $this->input->server('REQUEST_METHOD');

			if($method == 'POST' || $method == 'Post' || $method == 'post'):

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

			if($permission->payroll_configuration == 1):

				$data['user_data'] = $this->users->get_user($username);
				$salary_structure_category = $this->input->post('salary_structure_category');


				$payment_definition = $this->input->post('payment_definition');
				$allowance_amount = $this->input->post('allowance_amount');


				$i = 0;

				while($i < count($payment_definition)):
					$allowance_array = array(

					'salary_structure_category_id'=> $salary_structure_category,
					'payment_definition_id' => $payment_definition[$i],
					'salary_structure_allowance_amount' => $allowance_amount[$i],
						'tenant_id' => $tenant_id

				);
				$allowance_array = $this->security->xss_clean($allowance_array);

				$query = $this->payroll_configurations->add_allowance($allowance_array);

				$i++;
				endwhile;


				if($query == true):
					$log_array = array( 'tenant_id' => $tenant_id,
						'log_user_id' => $this->users->get_user($username)->user_id,
						'log_description' => "Added New Allowance"
					);

					$this->logs->add_log($log_array);
					$msg = array(
						'msg'=> 'Allowance Added Successfully',
						'location' => site_url('allowance'),
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

	public function edit_salary_allowance(){
		$username = $this->session->userdata('user_username');
		$allowance_id = $this->uri->segment(2);

		if(isset($username)):
			$user_type = $this->users->get_user($username)->user_type;

			$tenant_id = $this->users->get_user($username)->tenant_id;
			if($user_type == 1 || $user_type == 3 || $user_type == 4):
			$permission = $this->users->check_permission($username);
			$data['employee_management'] = $permission->employee_management;
				$data['notifications'] = $this->employees->get_notifications(0, $tenant_id);
			$data['payroll_management'] = $permission->payroll_management;
			$data['biometrics'] = $permission->biometrics;
			$data['user_management'] = $permission->user_management;
			$data['configuration'] = $permission->configuration;
			$data['payroll_configuration'] = $permission->payroll_configuration;
			$data['hr_configuration'] = $permission->hr_configuration;

			if($permission->payroll_configuration == 1):

				$data['user_data'] = $this->users->get_user($username);

				$data['csrf_name'] = $this->security->get_csrf_token_name();
				$data['csrf_hash'] = $this->security->get_csrf_hash();
				$data['allowance'] = $this->payroll_configurations->view_allowance($allowance_id,$tenant_id);

				if(empty($data['allowance'])):
					redirect('/error_404');
				else:


				$data['salary_structures'] = $this->payroll_configurations->view_salary_structures($tenant_id);
				$data['payment_definitions'] = $this->payroll_configurations->view_payment_definitions($tenant_id);

				$this->load->view('payroll_config/edit_salary_allowance', $data);
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

	public function update_salary_allowance(){
		$username = $this->session->userdata('user_username');

		if(isset($username)):
			$method = $this->input->server('REQUEST_METHOD');

			if($method == 'POST' || $method == 'Post' || $method == 'post'):

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

			if($permission->payroll_configuration == 1):

				$data['user_data'] = $this->users->get_user($username);
				$salary_structure_category = $this->input->post('salary_structure_category');
				$payment_definition = $this->input->post('payment_definition');
				$allowance_amount = $this->input->post('allowance_amount');
				$allowance_id = $this->input->post('salary_structure_allowance_id');


				$allowance_array = array(

					'salary_structure_category_id'=> $salary_structure_category,
					'payment_definition_id' => $payment_definition,
					'salary_structure_allowance_amount' => $allowance_amount,

				);
				$allowance_array = $this->security->xss_clean($allowance_array);

				$query = $this->payroll_configurations->update_allowance($allowance_id, $allowance_array);

				if($query == true):
					$log_array = array( 'tenant_id' => $tenant_id,
						'log_user_id' => $this->users->get_user($username)->user_id,
						'log_description' => "Updated Salary Allowance"
					);

					$this->logs->add_log($log_array);
					$msg = array(
						'msg'=> 'Allowance Updated Successfully',
						'location' => site_url('allowance'),
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



	public function setup_salary_structure(){

		$username = $this->session->userdata('user_username');
		$employee_id = $this->uri->segment(2);

		if(isset($username)):
			$user_type = $this->users->get_user($username)->user_type;

			$tenant_id = $this->users->get_user($username)->tenant_id;
			if($user_type == 1 || $user_type == 3 || $user_type == 4):
			$permission = $this->users->check_permission($username);
			$data['employee_management'] = $permission->employee_management;
			$data['notifications'] = $this->employees->get_notifications(0, $tenant_id);
			$data['payroll_management'] = $permission->payroll_management;
			$data['biometrics'] = $permission->biometrics;
			$data['user_management'] = $permission->user_management;
			$data['configuration'] = $permission->configuration;
			$data['payroll_configuration'] = $permission->payroll_configuration;
			$data['hr_configuration'] = $permission->hr_configuration;

			if($permission->payroll_configuration == 1):


				$data['employee'] = $this->employees->get_employee($employee_id, $tenant_id);

				if(empty($data['employee'])):

					redirect('/error_404');
					else:
						if($data['employee']->employee_salary_structure_setup == 1 ):

							$msg = array(
								'msg'=> 'Salary Structure Set Up Already',
								'location' => site_url('employee_salary_structure'),
								'type' => 'warning'

							);
							$this->load->view('swal', $msg);


						else:

							$data['user_data'] = $this->users->get_user($username);
							$data['salary_structures'] =  $this->payroll_configurations->view_salary_structures($tenant_id);
							$data['payment_definitions'] = $this->payroll_configurations->view_payment_definitions($tenant_id);
							$data['csrf_name'] = $this->security->get_csrf_token_name();
							$data['csrf_hash'] = $this->security->get_csrf_hash();
							//print_r($data['employees']);
							$this->load->view('payroll_config/setup_salary_structure', $data);

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




	public function payroll_month_year(){

		$username = $this->session->userdata('user_username');
		//$employee_id = $this->uri->segment(2);

		if(isset($username)):
			$user_type = $this->users->get_user($username)->user_type;

			$tenant_id = $this->users->get_user($username)->tenant_id;
			if($user_type == 1 || $user_type == 3 || $user_type == 4):
			$permission = $this->users->check_permission($username);
			$data['employee_management'] = $permission->employee_management;
			$data['notifications'] = $this->employees->get_notifications(0, $tenant_id);
			$data['payroll_management'] = $permission->payroll_management;
			$data['biometrics'] = $permission->biometrics;
			$data['user_management'] = $permission->user_management;
			$data['configuration'] = $permission->configuration;
			$data['payroll_configuration'] = $permission->payroll_configuration;
			$data['hr_configuration'] = $permission->hr_configuration;

			if($permission->payroll_configuration == 1):


				$data['user_data'] = $this->users->get_user($username);
				$data['csrf_name'] = $this->security->get_csrf_token_name();
				$data['csrf_hash'] = $this->security->get_csrf_hash();
				$data['payroll_years'] = $this->payroll_configurations->view_payroll_month_year($tenant_id);
			$this->load->view('payroll_config/payroll_month_year', $data);
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


	public function add_payroll_month_year(){

		$username = $this->session->userdata('user_username');
		//$employee_id = $this->uri->segment(2);

		if(isset($username)):
			$method = $this->input->server('REQUEST_METHOD');

			if($method == 'POST' || $method == 'Post' || $method == 'post'):

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

			if($permission->payroll_configuration == 1):

				$data['user_data'] = $this->users->get_user($username);
				$year = $this->input->post('payroll_month_year_year');
				$month = $this->input->post('payroll_month_year_month');

				if(empty($year) || empty($month)):
					redirect('/error_404');

					else:

				$payroll_data = array(
					'payroll_month_year_year' => $year,
					'payroll_month_year_month'=> $month,
					'tenant_id' => $tenant_id

				);

				$payroll_data = $this->security->xss_clean($payroll_data);

				$query = $this->payroll_configurations->insert_payroll_month_year($payroll_data);

				if($query == true):
					$log_array = array( 'tenant_id' => $tenant_id,
						'log_user_id' => $this->users->get_user($username)->user_id,
						'log_description' => "Added Payroll Year and Month"
					);

					$this->logs->add_log($log_array);
					$msg = array(
						'msg'=> 'Action Successful',
						'location' => site_url('payroll_month_year'),
						'type' => 'success'

					);
					$this->load->view('swal', $msg);

				else:
					echo "an error occurred";

				endif;

				endif;



				//$this->load->view('payroll_config/payroll_month_year', $data);

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


	public function update_payroll_month_year(){

		$username = $this->session->userdata('user_username');
		//$employee_id = $this->uri->segment(2);

		if(isset($username)):
			$method = $this->input->server('REQUEST_METHOD');

			if($method == 'POST' || $method == 'Post' || $method == 'post'):

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

			if($permission->payroll_configuration == 1):

				$data['user_data'] = $this->users->get_user($username);
				$year = $this->input->post('payroll_month_year_year');
				$month = $this->input->post('payroll_month_year_month');
				$id = $this->input->post('payroll_month_year_id');

				if(empty($year) || empty($month)):
					redirect('/error_404');

				else:

					$payroll_data = array(
						'payroll_month_year_year' => $year,
						'payroll_month_year_month'=> $month

					);

					$payroll_data = $this->security->xss_clean($payroll_data);

					$query = $this->payroll_configurations->update_payroll_month_year($id, $payroll_data);

					if($query == true):

						$log_array = array( 'tenant_id' => $tenant_id,
							'log_user_id' => $this->users->get_user($username)->user_id,
							'log_description' => "Updated Payroll Year and Month"
						);

						$this->logs->add_log($log_array);
						$msg = array(
							'msg'=> 'Action Successful',
							'location' => site_url('payroll_month_year'),
							'type' => 'success'

						);
						$this->load->view('swal', $msg);

					else:
						echo "an error occurred";

					endif;

				endif;



			//$this->load->view('payroll_config/payroll_month_year', $data);

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

	public function min_tax_rate(){
		$username = $this->session->userdata('user_username');
		//$employee_id = $this->uri->segment(2);

		if(isset($username)):
			$user_type = $this->users->get_user($username)->user_type;

			$tenant_id = $this->users->get_user($username)->tenant_id;
			if($user_type == 1 || $user_type == 3 || $user_type == 4):
			$permission = $this->users->check_permission($username);
			$data['employee_management'] = $permission->employee_management;
			$data['notifications'] = $this->employees->get_notifications(0, $tenant_id);
			$data['payroll_management'] = $permission->payroll_management;
			$data['biometrics'] = $permission->biometrics;
			$data['user_management'] = $permission->user_management;
			$data['configuration'] = $permission->configuration;
			$data['payroll_configuration'] = $permission->payroll_configuration;
			$data['hr_configuration'] = $permission->hr_configuration;

			if($permission->payroll_configuration == 1):



				$data['user_data'] = $this->users->get_user($username);
				$data['csrf_name'] = $this->security->get_csrf_token_name();
				$data['csrf_hash'] = $this->security->get_csrf_hash();
				$data['minimum_tax_rates'] = $this->payroll_configurations->view_minimum_tax_rate($tenant_id);
				$this->load->view('payroll_config/minimum_tax_rate', $data);

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


	public function add_min_tax_rate(){

		$username = $this->session->userdata('user_username');
		//$employee_id = $this->uri->segment(2);

		if(isset($username)):
			$method = $this->input->server('REQUEST_METHOD');

			if($method == 'POST' || $method == 'Post' || $method == 'post'):

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

			if($permission->payroll_configuration == 1):

				$data['user_data'] = $this->users->get_user($username);
				$minimum_tax_rate = $this->input->post('minimum_tax_rate');


				if(empty($minimum_tax_rate)):
					redirect('/error_404');

				else:

					$tax_data = array(
						'minimum_tax_rate' => $minimum_tax_rate,
						'tenant_id' => $tenant_id


					);

					$tax_data = $this->security->xss_clean($tax_data);

					$query = $this->payroll_configurations->insert_minimum_tax_rate($tax_data);

					if($query == true):
						$log_array = array( 'tenant_id' => $tenant_id,
							'log_user_id' => $this->users->get_user($username)->user_id,
							'log_description' => "Added New Minimum Tax Rate"
						);

						$this->logs->add_log($log_array);
						$msg = array(
							'msg'=> 'Action Successful',
							'location' => site_url('min_tax_rate'),
							'type' => 'success'

						);
						$this->load->view('swal', $msg);

					else:
						echo "an error occurred";

					endif;

				endif;



			//$this->load->view('payroll_config/payroll_month_year', $data);

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

	public function update_min_tax_rate(){

		$username = $this->session->userdata('user_username');
		//$employee_id = $this->uri->segment(2);

		if(isset($username)):
			$method = $this->input->server('REQUEST_METHOD');

			if($method == 'POST' || $method == 'Post' || $method == 'post'):

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

			if($permission->payroll_configuration == 1):

				$data['user_data'] = $this->users->get_user($username);


				$id = $this->input->post('minimum_tax_rate_id');
				$minimum_tax_rate = $this->input->post('minimum_tax_rate');


				if(empty($minimum_tax_rate)):
					redirect('/error_404');

				else:

					$tax_data = array(
						'minimum_tax_rate' => $minimum_tax_rate,


					);

					$tax_data = $this->security->xss_clean($tax_data);

					$query = $this->payroll_configurations->update_minimum_tax_rate($id, $tax_data);

					if($query == true):

						$log_array = array( 'tenant_id' => $tenant_id,
							'log_user_id' => $this->users->get_user($username)->user_id,
							'log_description' => "Updated Minimum Tax Rate"
						);

						$this->logs->add_log($log_array);
						$msg = array(
							'msg'=> 'Action Successful',
							'location' => site_url('min_tax_rate'),
							'type' => 'success'

						);
						$this->load->view('swal', $msg);

					else:
						echo "an error occurred";

					endif;

				endif;



			//$this->load->view('payroll_config/payroll_month_year', $data);

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

	public function pension_rate(){
		$username = $this->session->userdata('user_username');
		//$employee_id = $this->uri->segment(2);

		if(isset($username)):
			$user_type = $this->users->get_user($username)->user_type;

			$tenant_id = $this->users->get_user($username)->tenant_id;
			if($user_type == 1 || $user_type == 3 || $user_type == 4):
			$permission = $this->users->check_permission($username);
			$data['employee_management'] = $permission->employee_management;
			$data['notifications'] = $this->employees->get_notifications(0, $tenant_id);
			$data['payroll_management'] = $permission->payroll_management;
			$data['biometrics'] = $permission->biometrics;
			$data['user_management'] = $permission->user_management;
			$data['configuration'] = $permission->configuration;
			$data['payroll_configuration'] = $permission->payroll_configuration;
			$data['hr_configuration'] = $permission->hr_configuration;

			if($permission->payroll_configuration == 1):


				$data['user_data'] = $this->users->get_user($username);
				$data['csrf_name'] = $this->security->get_csrf_token_name();
				$data['csrf_hash'] = $this->security->get_csrf_hash();
				$data['pension_rates'] = $this->payroll_configurations->view_pension_rate($tenant_id);
				$this->load->view('payroll_config/pension_rate', $data);

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

	public function add_pension_rate(){

		$username = $this->session->userdata('user_username');
		//$employee_id = $this->uri->segment(2);

		if(isset($username)):
			$method = $this->input->server('REQUEST_METHOD');

			if($method == 'POST' || $method == 'Post' || $method == 'post'):

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

			if($permission->payroll_configuration == 1):

				$data['user_data'] = $this->users->get_user($username);
				$pension_rate = $this->input->post('pension_rate');


				if(empty($pension_rate)):
					redirect('/error_404');

				else:

					$pension_data = array(
						'pension_rate' => $pension_rate,
						'tenant_id' => $tenant_id


					);

					$pension_data = $this->security->xss_clean($pension_data);

					$query = $this->payroll_configurations->insert_pension_rate($pension_data);

					if($query == true):
						$log_array = array( 'tenant_id' => $tenant_id,
							'log_user_id' => $this->users->get_user($username)->user_id,
							'log_description' => "Added New Pension Rate"
						);

						$this->logs->add_log($log_array);
						$msg = array(
							'msg'=> 'Action Successful',
							'location' => site_url('pension_rate'),
							'type' => 'success'

						);
						$this->load->view('swal', $msg);

					else:
						echo "an error occurred";

					endif;

				endif;



			//$this->load->view('payroll_config/payroll_month_year', $data);

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

	public function update_pension_rate(){

		$username = $this->session->userdata('user_username');
		//$employee_id = $this->uri->segment(2);

		if(isset($username)):
			$method = $this->input->server('REQUEST_METHOD');

			if($method == 'POST' || $method == 'Post' || $method == 'post'):

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

			if($permission->payroll_configuration == 1):

				$data['user_data'] = $this->users->get_user($username);


				$id = $this->input->post('pension_rate_id');
				$pension_rate = $this->input->post('pension_rate');


				if(empty($pension_rate)):
					redirect('/error_404');

				else:

					$pension_data = array(
						'pension_rate' => $pension_rate,


					);

					$pension_data = $this->security->xss_clean($pension_data);

					$query = $this->payroll_configurations->update_pension_rate($id, $pension_data);

					if($query == true):

						$log_array = array( 'tenant_id' => $tenant_id,
							'log_user_id' => $this->users->get_user($username)->user_id,
							'log_description' => "Updated Pension Rate"
						);

						$this->logs->add_log($log_array);
						$msg = array(
							'msg'=> 'Action Successful',
							'location' => site_url('pension_rate'),
							'type' => 'success'

						);
						$this->load->view('swal', $msg);

					else:
						echo "an error occurred";

					endif;

				endif;



			//$this->load->view('payroll_config/payroll_month_year', $data);

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



}
