<?php


class Payroll extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('user_agent');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('security');
		$this->load->helper('array');
		$this->load->model('users');
		$this->load->model('payroll_configurations');
		$this->load->model('employees');
		$this->load->model('hr_configurations');
		$this->load->model('logs');
		$this->load->model('salaries');
		$this->load->model('loans');

	}


	public function employee_salary_structure(){

		$username = $this->session->userdata('user_username');

		if(isset($username)):
			$user_type = $this->users->get_user($username)->user_type;

			$tenant_id = $this->users->get_user($username)->tenant_id;

			$active_plans = $this->users->get_sub_true_status($tenant_id);

			if(!empty($active_plans)):

				$data['active_plan'] = 1;
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

			if($permission->payroll_management == 1):



				$data['user_data'] = $this->users->get_user($username);
				$data['employees'] = $this->employees->get_employee_by_salary_setup($tenant_id);

				//print_r($data['employees']);
				$this->load->view('payroll_config/employee_salary_structure', $data);

				else:
					redirect('/access_denied');
				endif;

			else:

				redirect('/access_denied');

			endif;

			else:

				redirect('subscription_expired');
				endif;
		else:
			redirect('/login');
		endif;


	}

	public function add_employee_salary_structure(){

		$username = $this->session->userdata('user_username');
		//$employee_id = $this->uri->segment(2);

		if(isset($username)):
			$method = $this->input->server('REQUEST_METHOD');
$data['active_plan'] = 1; 
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

			if($permission->payroll_management == 1):

				$employee_id = $this->input->post('employee_id');
				$salary_structure_type = $this->input->post('salary_structure_type');



				if((empty($employee_id)) || ($salary_structure_type == 2)):

					redirect('/error_404');
				else:

					if($salary_structure_type == 0):

						$payment_definition = $this->input->post('payment_definition');
						$allowance_amount = $this->input->post('allowance_amount');


						$i = 0;

						while($i < count($payment_definition)):
							$personalized_array = array(

								'personalized_employee_id'=> $employee_id,
								'personalized_payment_definition' => $payment_definition[$i],
								'personalized_amount' => $allowance_amount[$i],
								'tenant_id' => $tenant_id

							);
							$personalized_array = $this->security->xss_clean($personalized_array);

							$query_p = $this->payroll_configurations->insert_personalized($personalized_array);

							$i++;
						endwhile;


						$employee_array = array(

							'employee_salary_structure_setup' => 1,
							'employee_salary_structure_category' => 0,

						);

						$employee_array = $this->security->xss_clean($employee_array);

						$query = $this->employees->update_employee($employee_id, $employee_array);


						if(($query == true) && ($query_p == true)):

							$log_array = array( 'tenant_id' => $tenant_id,
								'log_user_id' => $this->users->get_user($username)->user_id,
								'log_description' => "Add Employee Salary Structure"
							);

							$this->logs->add_log($log_array);
							$msg = array(
								'msg'=> 'Allowance Added Successfully',
								'location' => site_url('employee_salary_structure'),
								'type' => 'success'

							);
							$this->load->view('swal', $msg);

						else:
							echo "An Error Occurred";
						endif;


					endif;

					if($salary_structure_type == 1):

						$salary_structure_category = $this->input->post('salary_structure_category');

						$employee_array = array(

							'employee_salary_structure_setup' => 1,
							'employee_salary_structure_category' => $salary_structure_category,

						);

						$employee_array = $this->security->xss_clean($employee_array);

						$query = $this->employees->update_employee($employee_id, $employee_array);

						if($query == true):
							$log_array = array( 'tenant_id' => $tenant_id,
								'log_user_id' => $this->users->get_user($username)->user_id,
								'log_description' => "Added Employee Salary Structure"
							);

							$this->logs->add_log($log_array);
							$msg = array(
								'msg'=> 'Salary Structure Added Successfully',
								'location' => site_url('employee_salary_structure'),
								'type' => 'success'

							);
							$this->load->view('swal', $msg);

						else:
							echo "An Error Occurred";
						endif;

					endif;

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

	public function view_employee_salary_structure(){
		$username = $this->session->userdata('user_username');
		$employee_id = $this->uri->segment(2);

		if(isset($username)):
			$user_type = $this->users->get_user($username)->user_type;

			$tenant_id = $this->users->get_user($username)->tenant_id;
			$active_plans = $this->users->get_sub_true_status($tenant_id);

			if(!empty($active_plans)):

				$data['active_plan'] = 1;

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

			if($permission->payroll_management == 1):


				if((empty($employee_id))):

					redirect('/error_404');
				else:

					$data['employee'] = $this->employees->get_employee($employee_id, $tenant_id);

					if(empty($data['employee'])):

						redirect('/error_404');
					else:
						if($data['employee']->employee_salary_structure_setup == 1 ):

							if($data['employee']->employee_salary_structure_category == 0):


								$data['user_data'] = $this->users->get_user($username);
								$data['salary_structures'] =  $this->payroll_configurations->view_salary_structures($tenant_id);

								$data['payment_definitions'] = $this->payroll_configurations->view_employee_personalized($employee_id, $tenant_id);

								$data['csrf_name'] = $this->security->get_csrf_token_name();
								$data['csrf_hash'] = $this->security->get_csrf_hash();
								$data['personalized_allowances'] = $this->payroll_configurations->view_employee_personalized($employee_id, $tenant_id);

								$this->load->view('payroll_config/view_employee_salary_structure', $data);

							endif;


							if($data['employee']->employee_salary_structure_category > 0):


								$data['user_data'] = $this->users->get_user($username);
								$data['salary_structures'] =  $this->payroll_configurations->view_salary_structures($tenant_id);

								$data['payment_definitions'] = $this->payroll_configurations->view_employee_personalized($employee_id, $tenant_id);

								$data['csrf_name'] = $this->security->get_csrf_token_name();
								$data['csrf_hash'] = $this->security->get_csrf_hash();

								$data['allowances'] = $this->payroll_configurations->view_salary_structure_allowances($data['employee']->employee_salary_structure_category, $tenant_id);


								//print_r($data['allowances']);
								$this->load->view('payroll_config/view_employee_salary_structure', $data);

							endif;





						else:

							$msg = array(
								'msg'=> 'Salary Structure Not Set Up Yet',
								'location' => site_url('employee_salary_structure'),
								'type' => 'success'

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

				redirect('subscription_expired');
				endif;
		else:
			redirect('/login');
		endif;


	}

	public function edit_employee_salary_structure(){
		$username = $this->session->userdata('user_username');
		$employee_id = $this->uri->segment(2);

		if(isset($username)):
			$user_type = $this->users->get_user($username)->user_type;

			$tenant_id = $this->users->get_user($username)->tenant_id;
			$active_plans = $this->users->get_sub_true_status($tenant_id);

			if(!empty($active_plans)):

				$data['active_plan'] = 1;

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

			if($permission->payroll_management == 1):

				if((empty($employee_id))):

					redirect('/error_404');
				else:

					$data['employee'] = $this->employees->get_employee($employee_id, $tenant_id);

					if(empty($data['employee'])):

						redirect('/error_404');
					else:
						if($data['employee']->employee_salary_structure_setup == 1 ):

							if($data['employee']->employee_salary_structure_category == 0):


								$data['user_data'] = $this->users->get_user($username);
								$data['salary_structures'] =  $this->payroll_configurations->view_salary_structures($tenant_id);


								$data['payment_definitions'] = $this->payroll_configurations->view_payment_definitions($tenant_id);


								//$data['payment_definitions'] = $this->payroll_configurations->view_employee_personalized($employee_id);

								$data['csrf_name'] = $this->security->get_csrf_token_name();
								$data['csrf_hash'] = $this->security->get_csrf_hash();
								$data['personalized_allowances'] = $this->payroll_configurations->view_employee_personalized($employee_id, $tenant_id);



							endif;


							if($data['employee']->employee_salary_structure_category > 0):


								$data['user_data'] = $this->users->get_user($username);
								$data['salary_structures'] =  $this->payroll_configurations->view_salary_structures($tenant_id);

								$data['payment_definitions'] = $this->payroll_configurations->view_employee_personalized($employee_id, $tenant_id);
								$data['payment_definitionss'] = $this->payroll_configurations->view_payment_definitions($tenant_id);


								$data['csrf_name'] = $this->security->get_csrf_token_name();
								$data['csrf_hash'] = $this->security->get_csrf_hash();

								//$data['allowances'] = $this->payroll_configurations->view_salary_structure_allowances($data['employee']->employee_salary_structure_category);


								//print_r($data['allowances']);


							endif;

							$this->load->view('payroll_config/edit_employee_salary_structure', $data);





						else:

							$msg = array(
								'msg'=> 'Salary Structure Not Set Up Yet',
								'location' => site_url('employee_salary_structure'),
								'type' => 'success'

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

				redirect('subscription_expired');
				endif;
		else:
			redirect('/login');
		endif;


	}

	public function update_employee_salary_structure(){

		$username = $this->session->userdata('user_username');
		//$employee_id = $this->uri->segment(2);

		if(isset($username)):
			$method = $this->input->server('REQUEST_METHOD');
$data['active_plan'] = 1; 

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

			if($permission->payroll_management == 1):


				$employee_id = $this->input->post('employee_id');
				$salary_structure_type = $this->input->post('salary_structure_type');
				$data['employee'] = $this->employees->get_employee($employee_id, $tenant_id);



				if((empty($employee_id)) || ($salary_structure_type == 2)):

					redirect('/error_404');
				else:

					if($salary_structure_type == 0):



						if($data['employee']->employee_salary_structure_category == 0):

							$this->payroll_configurations->remove_from_personalized($employee_id);

						endif;

						if($data['employee']->employee_salary_structure_category > 0):

							$employee_array = array(


								'employee_salary_structure_category' => 0,

							);

							$employee_array = $this->security->xss_clean($employee_array);

							$query = $this->employees->update_employee($employee_id, $employee_array);

						endif;




						$payment_definition = $this->input->post('payment_definition');
						$allowance_amount = $this->input->post('allowance_amount');

						if(!empty($payment_definition)):


						$i = 0;

						while($i < count($payment_definition)):
							$personalized_array = array(

								'personalized_employee_id'=> $employee_id,
								'personalized_payment_definition' => $payment_definition[$i],
								'personalized_amount' => $allowance_amount[$i],
								'tenant_id' => $tenant_id

							);
							$personalized_array = $this->security->xss_clean($personalized_array);

//							print_r($personalized_array);

							$query_p = $this->payroll_configurations->insert_personalized($personalized_array);

							$i++;
						endwhile;


						$employee_array = array(

							'employee_salary_structure_setup' => 1,
							'employee_salary_structure_category' => 0,

						);

						$employee_array = $this->security->xss_clean($employee_array);

						$query = $this->employees->update_employee($employee_id, $employee_array);


						if(($query == true) && ($query_p == true)):
							$log_array = array( 'tenant_id' => $tenant_id,
								'log_user_id' => $this->users->get_user($username)->user_id,
								'log_description' => "Updated Employee Salary"
							);

							$this->logs->add_log($log_array);

							$msg = array(
								'msg'=> 'Employee Structure Updated Successfully',
								'location' => site_url('employee_salary_structure'),
								'type' => 'success'

							);
							$this->load->view('swal', $msg);

						else:
							echo "An Error Occurred";
						endif;

						else:

							$msg = array(
								'msg'=> 'Payment Definitions empty',
								'location' => site_url('employee_salary_structure'),
								'type' => 'error'

							);
							$this->load->view('swal', $msg);

						endif;

					endif;



					if($salary_structure_type == 1):

						$salary_structure_category = $this->input->post('salary_structure_category');


						if($data['employee']->employee_salary_structure_category == 0):

							$this->payroll_configurations->remove_from_personalized($employee_id);


						endif;

						$employee_array = array(

							'employee_salary_structure_setup' => 1,
							'employee_salary_structure_category' => $salary_structure_category,

						);

						$employee_array = $this->security->xss_clean($employee_array);

						$query = $this->employees->update_employee($employee_id, $employee_array);

						if($query == true):
							$msg = array(
								'msg'=> 'Salary Structure Updated Successfully',
								'location' => site_url('employee_salary_structure'),
								'type' => 'success'

							);
							$this->load->view('swal', $msg);

						else:
							echo "An Error Occurred";
						endif;


					endif;

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

	public function variational_payment(){

		$username = $this->session->userdata('user_username');
		//$employee_id = $this->uri->segment(2);

		if(isset($username)):
			$user_type = $this->users->get_user($username)->user_type;

			$tenant_id = $this->users->get_user($username)->tenant_id;
			$active_plans = $this->users->get_sub_true_status($tenant_id);

			if(!empty($active_plans)):

				$data['active_plan'] = 1;
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

			if($permission->payroll_management == 1):


				$data['user_data'] = $this->users->get_user($username);
				$data['variational_payments'] = $this->payroll_configurations->view_variational_payments($tenant_id);


				$this->load->view('payroll_config/variational_payment', $data);
				else:
					redirect('/access_denied');
				endif;
			else:

				redirect('/access_denied');

			endif;

			else:
				redirect('subscription_expired');
				endif;
		else:
			redirect('/login');
		endif;
	}

	public function new_variational_payment(){
		$username = $this->session->userdata('user_username');
		//$employee_id = $this->uri->segment(2);

		if(isset($username)):
			$user_type = $this->users->get_user($username)->user_type;

			$tenant_id = $this->users->get_user($username)->tenant_id;

			$active_plans = $this->users->get_sub_true_status($tenant_id);

			if(!empty($active_plans)):

				$data['active_plan'] = 1;
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

			if($permission->payroll_management == 1):



				$data['user_data'] = $this->users->get_user($username);
				$data['payment_definitions'] = $this->payroll_configurations->view_payment_definitions($tenant_id);
				$data['departments'] = $this->hr_configurations->view_departments($tenant_id);
				$data['employees'] = $this->employees->view_employees($tenant_id);
				$data['payroll'] = $this->payroll_configurations->get_payroll_month_year($tenant_id);
				$data['csrf_name'] = $this->security->get_csrf_token_name();
				$data['csrf_hash'] = $this->security->get_csrf_hash();

				$this->load->view('payroll_config/new_variational_payment', $data);

				else:
					redirect('/access_denied');
				endif;

			else:

				redirect('/access_denied');

			endif;

			else:

				redirect('subscription_expired');
				endif;
		else:
			redirect('/login');
		endif;

	}

	public function add_variational_payment(){
		$username = $this->session->userdata('user_username');
		//$employee_id = $this->uri->segment(2);

		if(isset($username)):
			$method = $this->input->server('REQUEST_METHOD');
$data['active_plan'] = 1; 

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

			if($permission->payroll_management == 1):

				$data['user_data'] = $this->users->get_user($username);
				$data['payment_definitions'] = $this->payroll_configurations->view_payment_definitions($tenant_id);
				$data['departments'] = $this->hr_configurations->view_departments($tenant_id);
				$data['employees'] = $this->employees->view_employees($tenant_id);
				$data['csrf_name'] = $this->security->get_csrf_token_name();
				$data['csrf_hash'] = $this->security->get_csrf_hash();

				$month = $this->payroll_configurations->get_payroll_month_year($tenant_id)->payroll_month_year_month;
				$year =  $this->payroll_configurations->get_payroll_month_year($tenant_id)->payroll_month_year_year;


				$department_id = $this->input->post('department_id');
				$payment_definition = $this->input->post('payment_definition_id');
				$amount = $this->input->post('payment_amount');
				$category = $this->input->post('category');

				if(($payment_definition == 'null') or ($category == 'null')):
					redirect('/error_404');

				else:
					$payroll_month = $this->payroll_configurations->get_payroll_month_year($tenant_id)->payroll_month_year_month;
					$payroll_year = $this->payroll_configurations->get_payroll_month_year($tenant_id)->payroll_month_year_year;
					$salaries = $this->salaries->view_salaries($tenant_id);

					$check_salary = 0;
					foreach ($salaries as $salary):

						if(($salary->salary_pay_month == $payroll_month) && ($salary->salary_pay_year == $payroll_year)):

							$check_salary ++;

						endif;

					endforeach;

					if($check_salary > 0):

						$msg = array(
							'msg'=> 'Undo PayRoll Routine First',
							'location' => site_url('payroll_routine'),
							'type' => 'error'

						);
						$this->load->view('swal', $msg);


					else:

					if($category == 1):

						$employees = $this->employees->get_employees_by_department($department_id, $tenant_id);
						foreach ($employees as $employee):
							$variational_payment = array(
								'variational_employee_id' => $employee->employee_id,
								'variational_payment_definition_id' => $payment_definition,
								'variational_amount' => $amount,
								'variational_payroll_month' => $month,
								'variational_payroll_year' => $year,
								'variational_confirm' => 0

							);

							$variational_payment = $this->security->xss_clean($variational_payment);
							//print_r($variational_payment);
							$query = $this->payroll_configurations->insert_variational_payment($variational_payment, $tenant_id);
						endforeach;
					else:

						$employees = $this->input->post('employee_ids');
						foreach ($employees as $employee):
							$variational_payment = array(
								'variational_employee_id' => $employee,
								'variational_payment_definition_id' => $payment_definition,
								'variational_amount' => $amount,
								'variational_payroll_month' => $month,
								'variational_payroll_year' => $year,
								'variational_confirm' => 0

							);
							$variational_payment = $this->security->xss_clean($variational_payment);

							//print_r($variational_payment);
							$query = $this->payroll_configurations->insert_variational_payment($variational_payment, $tenant_id);
						endforeach;
					endif;

					if($query == true):
						$log_array = array( 'tenant_id' => $tenant_id,
							'log_user_id' => $this->users->get_user($username)->user_id,
							'log_description' => "Added A New Variational Payment"
						);

						$this->logs->add_log($log_array);

						$msg = array(
							'msg'=> 'Action Successful',
							'location' => site_url('variational_payment'),
							'type' => 'success'

						);
						$this->load->view('swal', $msg);

					else:
						echo "an error occurred";

					endif;

					endif;

				endif;



			//echo $employees;

//			foreach ($employees as $employee):
//
//				echo $employee;
//
//
//			endforeach;




//				$this->load->view('payroll_config/new_variational_payment', $data);

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

	public function approve_variational_payment(){
		$username = $this->session->userdata('user_username');
		//$employee_id = $this->uri->segment(2);

		if(isset($username)):
			$user_type = $this->users->get_user($username)->user_type;

			$tenant_id = $this->users->get_user($username)->tenant_id;

			$active_plans = $this->users->get_sub_true_status($tenant_id);

			if(!empty($active_plans)):

				$data['active_plan'] = 1;

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

			if($permission->payroll_management == 1):


				$data['user_data'] = $this->users->get_user($username);
				$data['csrf_name'] = $this->security->get_csrf_token_name();
				$data['csrf_hash'] = $this->security->get_csrf_hash();
				$data['variational_payments'] = $this->payroll_configurations->view_variational_payments($tenant_id);


				$this->load->view('payroll_config/approve_variational_payment', $data);

				else:
					redirect('/access_denied');
				endif;

			else:

				redirect('/access_denied');

			endif;

			else:

				redirect('subscription_expired');
				endif;
		else:
			redirect('/login');
		endif;


	}

	public function approve_variational_payments(){
		$username = $this->session->userdata('user_username');
		//$employee_id = $this->uri->segment(2);

		if(isset($username)):
			$method = $this->input->server('REQUEST_METHOD');
$data['active_plan'] = 1; 

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

			if($permission->payroll_management == 1):

				$payroll_month = $this->payroll_configurations->get_payroll_month_year($tenant_id)->payroll_month_year_month;
				$payroll_year = $this->payroll_configurations->get_payroll_month_year($tenant_id)->payroll_month_year_year;
				$salaries = $this->salaries->view_salaries($tenant_id);

				$check_salary = 0;
				foreach ($salaries as $salary):

					if(($salary->salary_pay_month == $payroll_month) && ($salary->salary_pay_year == $payroll_year)):

						$check_salary ++;

					endif;

				endforeach;

				if($check_salary > 0):

					$msg = array(
						'msg'=> 'Undo PayRoll Routine First',
						'location' => site_url('payroll_routine'),
						'type' => 'error'

					);
					$this->load->view('swal', $msg);


				else:



					$approves = $this->input->post('approve');

					if(empty($approves)):
				$msg = array(
					'msg'=> 'No Payment Selected',
					'location' => site_url('approve_variational_payment'),
					'type' => 'warning'
				);
				$this->load->view('swal', $msg);
				else:

			foreach ($approves as $approve):
						$variational_payment = array(
							'variational_confirm' => 1
						);

				$variational_payment = $this->security->xss_clean($variational_payment);

				$query = $this->payroll_configurations->update_variational_payments($approve, $variational_payment, $tenant_id);

				endforeach;

					if($query == true):
						$log_array = array( 'tenant_id' => $tenant_id,
							'log_user_id' => $this->users->get_user($username)->user_id,
							'log_description' => "Approved Variational Payment"
						);

						$this->logs->add_log($log_array);
						$msg = array(
							'msg'=> 'Action Successful',
							'location' => site_url('approve_variational_payment'),
							'type' => 'success'

						);
						$this->load->view('swal', $msg);

					else:
						echo "an error occurred";

					endif;
				endif;

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

	public function recall_month(){

		$username = $this->session->userdata('user_username');
		//$employee_id = $this->uri->segment(2);

		if(isset($username)):
			$user_type = $this->users->get_user($username)->user_type;

			$tenant_id = $this->users->get_user($username)->tenant_id;

			$active_plans = $this->users->get_sub_true_status($tenant_id);

			if(!empty($active_plans)):

				$data['active_plan'] = 1;

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

			if($permission->payroll_management == 1):


				$data['user_data'] = $this->users->get_user($username);
				$data['payment_definitions'] = $this->payroll_configurations->view_payment_definitions($tenant_id);
				$data['departments'] = $this->hr_configurations->view_departments($tenant_id);
				$data['employees'] = $this->employees->view_employees($tenant_id);
				$data['payroll'] = $this->payroll_configurations->get_payroll_month_year($tenant_id);
				$data['csrf_name'] = $this->security->get_csrf_token_name();
				$data['csrf_hash'] = $this->security->get_csrf_hash();

				$year =  $this->payroll_configurations->get_payroll_month_year($tenant_id)->payroll_month_year_year;

				$month = $this->payroll_configurations->get_payroll_month_year($tenant_id)->payroll_month_year_month;

				if($month == 1):
					$previous_month = 12;
					$previous_year = $year - 1;
				else:
					$previous_month = $this->payroll_configurations->get_payroll_month_year($tenant_id)->payroll_month_year_month - 1;
					$previous_year = $year;

				endif;

				$data['variational_payments'] = $this->payroll_configurations->view_variational_payments_previous_month($previous_month, $previous_year, $tenant_id);

				//print_r($data['variational_payments']);
				$this->load->view('payroll_config/recall_payment', $data);
			else:
				redirect('/access_denied');

			endif;
			else:

				redirect('/access_denied');

			endif;

			else:

				redirect('subscription_expired');
				endif;
		else:
			redirect('/login');
		endif;
	}

	public function payroll_routine(){

		$username = $this->session->userdata('user_username');
		//$employee_id = $this->uri->segment(2);

		if(isset($username)):
			$user_type = $this->users->get_user($username)->user_type;

			$tenant_id = $this->users->get_user($username)->tenant_id;

			$active_plans = $this->users->get_sub_true_status($tenant_id);

			if(!empty($active_plans)):

				$data['active_plan'] = 1;
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

			if($permission->payroll_management == 1):



				$data['user_data'] = $this->users->get_user($username);
				$data['payment_definitions'] = $this->payroll_configurations->view_payment_definitions($tenant_id);
				$data['departments'] = $this->hr_configurations->view_departments($tenant_id);
				$data['employees'] = $this->employees->view_employees($tenant_id);
				$data['payroll'] = $this->payroll_configurations->get_payroll_month_year($tenant_id);
				$data['csrf_name'] = $this->security->get_csrf_token_name();
				$data['csrf_hash'] = $this->security->get_csrf_hash();

				$data['payroll_year'] = $this->payroll_configurations->get_payroll_month_year($tenant_id);

//				$year =  $this->payroll_configurations->get_payroll_month_year()->payroll_month_year_year;
//
//				$month = $this->payroll_configurations->get_payroll_month_year()->payroll_month_year_month;

//				if($month == 1):
//					$previous_month = 12;
//					$previous_year = $year - 1;
//				else:
//					$previous_month = $this->payroll_configurations->get_payroll_month_year()->payroll_month_year_month - 1;
//					$previous_year = $year;
//
//				endif;
//
//				$data['variational_payments'] = $this->payroll_configurations->view_variational_payments_previous_month($previous_month, $previous_year);

				//print_r($data['variational_payments']);
				$this->load->view('payroll/payroll_routine', $data);
				else:
					redirect('/access_denied');

				endif;
			else:

				redirect('/access_denied');

			endif;

			else:
				redirect('subscription_expired');

				endif;
		else:
			redirect('/login');
		endif;


	}

	public function run_payroll_routine(){


		$username = $this->session->userdata('user_username');
		//$employee_id = $this->uri->segment(2);

		if(isset($username)):
			$user_type = $this->users->get_user($username)->user_type;

			$tenant_id = $this->users->get_user($username)->tenant_id;
		if($this->agent->referrer() !== site_url('payroll_routine')):

			redirect('error_404');

			else:


			$permission = $this->users->check_permission($username);
			$data['employee_management'] = $permission->employee_management;
			$data['notifications'] = $this->employees->get_notifications(0, $tenant_id);
			$data['payroll_management'] = $permission->payroll_management;
			$data['biometrics'] = $permission->biometrics;
			$data['user_management'] = $permission->user_management;
			$data['configuration'] = $permission->configuration;
			$data['payroll_configuration'] = $permission->payroll_configuration;
			$data['hr_configuration'] = $permission->hr_configuration;

			if($permission->payroll_management == 1):

				$data['user_data'] = $this->users->get_user($username);
				$data['payment_definitions'] = $this->payroll_configurations->view_payment_definitions($tenant_id);
				$data['departments'] = $this->hr_configurations->view_departments($tenant_id);
				$data['employees'] = $this->employees->view_employees($tenant_id);
				$data['payroll'] = $this->payroll_configurations->get_payroll_month_year($tenant_id);
				$data['csrf_name'] = $this->security->get_csrf_token_name();
				$data['csrf_hash'] = $this->security->get_csrf_hash();

				$payroll_month = $this->payroll_configurations->get_payroll_month_year($tenant_id)->payroll_month_year_month;
				$payroll_year = $this->payroll_configurations->get_payroll_month_year($tenant_id)->payroll_month_year_year;

				$minimum_tax_rate = $this->payroll_configurations->get_minimum_tax_rate($tenant_id);
				$pension_rate = $this->payroll_configurations->get_pension_rate($tenant_id);

				// 1 == loan, 2 == tax, 3 ==  pension 4 == hmo
				$loan_payment_definition = $this->payroll_configurations->get_fixed_id(1, $tenant_id);
				$tax_payment_definition = $this->payroll_configurations->get_fixed_id(2, $tenant_id);
				$pension_payment_definition = $this->payroll_configurations->get_fixed_id(3, $tenant_id);




				$salaries = $this->salaries->view_salaries($tenant_id);

				$check_salary = 0;
				foreach ($salaries as $salary):

					if(($salary->salary_pay_month == $payroll_month) && ($salary->salary_pay_year == $payroll_year)):

						$check_salary ++;

						endif;

				endforeach;

			if($check_salary > 0):

				$msg = array(
					'msg'=> 'Payroll Routine Already Run',
					'location' => site_url('payroll_routine'),
					'type' => 'error'

				);
				$this->load->view('swal', $msg);


			else:

				$employees = $this->employees->view_employees($tenant_id);

			foreach ($employees as $employee):

			if($employee->employee_status == 3 || $employee->employee_status == 0):


			else:
				if($employee->employee_salary_structure_category == 0):

					// personalized salary structure

					$employee_personalized_incomes = $this->salaries->get_personalized_income($employee->employee_id, $tenant_id);

					foreach ($employee_personalized_incomes as $employee_personalized_income):

						if($employee_personalized_income->payment_definition_basic == 1):

							//compute pension
							if($employee->employee_pensionable == 1):

								$pension_amount = ($pension_rate->pension_rate/100) * $employee_personalized_income->personalized_amount;

								$salary_array = array(

									'salary_employee_id' => $employee->employee_id,
									'salary_payment_definition_id' => $pension_payment_definition->payment_definition_id,
									'salary_pay_month' => $payroll_month,
									'salary_pay_year' => $payroll_year,
									'salary_amount' => $pension_amount,
									'salary_confirmed' => 0
								);

								$salary_array = $this->security->xss_clean($salary_array);
								$query = $this->salaries->add_salary($salary_array, 'salary_'.$tenant_id);

							endif;
							//end compute pension

						endif;


							$salary_array = array(

								'salary_employee_id' => $employee->employee_id,
								'salary_payment_definition_id' => $employee_personalized_income->personalized_payment_definition,
								'salary_pay_month' => $payroll_month,
								'salary_pay_year' => $payroll_year,
								'salary_amount' => $employee_personalized_income->personalized_amount,
								'salary_confirmed' => 0

							);

						$salary_array = $this->security->xss_clean($salary_array);
						$query = $this->salaries->add_salary($salary_array, 'salary_'.$tenant_id);

					endforeach;



				//personalized salary structure

			else:

				$employee_categorised_incomes = $this->salaries->get_categorized_income($employee->employee_salary_structure_category, $tenant_id);

			// categorised salary structure
			foreach ($employee_categorised_incomes as $employee_categorised_income):

					if($employee_categorised_income->payment_definition_basic == 1):

						//compute pension
						if($employee->employee_pensionable == 1):

							$pension_amount = ($pension_rate->pension_rate/100) * $employee_categorised_income->salary_structure_allowance_amount;

							$salary_array = array(

								'salary_employee_id' => $employee->employee_id,
								'salary_payment_definition_id' => $pension_payment_definition->payment_definition_id,
								'salary_pay_month' => $payroll_month,
								'salary_pay_year' => $payroll_year,
								'salary_amount' => $pension_amount,
								'salary_confirmed' => 0
							);

							$salary_array = $this->security->xss_clean($salary_array);
							$query = $this->salaries->add_salary($salary_array, 'salary_'.$tenant_id);

						endif;
						//end compute pension

					endif;


						$salary_array = array(

							'salary_employee_id' => $employee->employee_id,
							'salary_payment_definition_id' => $employee_categorised_income->payment_definition_id,
							'salary_pay_month' => $payroll_month,
							'salary_pay_year' => $payroll_year,
							'salary_amount' => $employee_categorised_income->salary_structure_allowance_amount,
							'salary_confirmed' => 0
						);



				$salary_array = $this->security->xss_clean($salary_array);
				$query = $this->salaries->add_salary($salary_array, 'salary_'.$tenant_id);




				endforeach;
			// categorised salary structure



			endif;


			//loan repayment if any

				$employee_loans = $this->loans->view_loan_employee($employee->employee_id, $tenant_id);

				if(!empty($employee_loans)):

				foreach ($employee_loans as $employee_loan):

					if(($employee_loan->loan_status == 0) && ($employee_loan->loan_balance != 0)):

						$check_skip = $this->loans->view_loan_log($employee_loan->loan_id, $payroll_month, $payroll_year, $tenant_id);

						if(empty($check_skip)):
							$salary_array = array(

								'salary_employee_id' => $employee->employee_id,
								'salary_payment_definition_id' => $employee_loan->loan_payment_definition_id,
								'salary_pay_month' => $payroll_month,
								'salary_pay_year' => $payroll_year,
								'salary_amount' => $employee_loan->loan_monthly_repayment,
								'salary_confirmed' => 0
							);

							$salary_array = $this->security->xss_clean($salary_array);
							$query = $this->salaries->add_salary($salary_array, 'salary_'.$tenant_id);


							$repayment_array = array(
								'loan_repayment_loan_id' => $employee_loan->loan_id,
								'loan_repayment_amount' => $employee_loan->loan_monthly_repayment,
								'loan_repayment_type' => 1,
								'loan_repayment_payroll_year' => $payroll_year,
								'loan_repayment_payroll_month' => $payroll_month,

							);

							$repayment_array = $this->security->xss_clean($repayment_array);
							$query = $this->loans->insert_loan_repayment($repayment_array, $tenant_id);


							$loan_payments = $this->loans->compute_loan_payment($employee_loan->loan_id, $tenant_id)->loan_repayment_amount;

							$loan_balance = $employee_loan->loan_amount - $loan_payments;


							if(($loan_payments == $employee_loan->loan_amount) || ($loan_balance == 0)):

								$loan_array = array(
								'loan_balance' => $loan_balance,
								'loan_status' => 1
								);

							else:

								$loan_array = array(
									'loan_balance' => $loan_balance,
								);

							endif;

							$loan_array = $this->security->xss_clean($loan_array);
							$this->loans->update_loan($employee_loan->loan_id, $loan_array, $tenant_id);

							endif;

						endif;

				endforeach;

				endif;

			//loan repayment






			//variational payment

				$employee_variational_payments = $this->salaries->get_variational_payment($employee->employee_id, $tenant_id);

				foreach ($employee_variational_payments as $employee_variational_payment):

					if($employee_variational_payment->variational_confirm == 1 && $employee_variational_payment->variational_payroll_month == $payroll_month && $employee_variational_payment->variational_payroll_year == $payroll_year):

						$salary_array = array(

							'salary_employee_id' => $employee->employee_id,
							'salary_payment_definition_id' => $employee_variational_payment->variational_payment_definition_id,
							'salary_pay_month' => $payroll_month,
							'salary_pay_year' => $payroll_year,
							'salary_amount' => $employee_variational_payment->variational_amount,
							'salary_confirmed' => 0

						);


						$salary_array = $this->security->xss_clean($salary_array);
						$query = $this->salaries->add_salary($salary_array, 'salary_'.$tenant_id);




					endif;

					endforeach;

				//variational payment



				//tax computation


				$taxable_incomes = $this->salaries->get_taxable_incomes($employee->employee_id, $payroll_year, $payroll_month, $tenant_id);

				$sum_taxable_income = 0;

				foreach ($taxable_incomes as $taxable_income):

					if($taxable_income->payment_definition_taxable == 1):

						$sum_taxable_income = $sum_taxable_income + $taxable_income->salary_amount;

					endif;

				endforeach;

				if($sum_taxable_income > 0):

				$tax_relief = ((20/100) * $sum_taxable_income) + (200000/12);

				$minimum_tax = ($minimum_tax_rate->minimum_tax_rate/100) * ($sum_taxable_income - $tax_relief);

				//if($tax_relief <= 0 or $tax_relief <= $minimum_tax):

					//$tax_amount = $minimum_tax;

				//else:

					$total_tax_amount = 0;
					$temp_tax_amount = $sum_taxable_income - $tax_relief;
					$tax_rates = $this->payroll_configurations->view_tax_rates_asc($tenant_id);

				foreach ($tax_rates as $tax_rate):
					if($sum_taxable_income > 0):

						if($temp_tax_amount >= $tax_rate->tax_rate_band/12):
							$c_tax =  ($tax_rate->tax_rate_rate/100) * ($tax_rate->tax_rate_band/12);
						else:
							$c_tax = ($tax_rate->tax_rate_rate/100) * ($temp_tax_amount);
							$total_tax_amount = $c_tax + $total_tax_amount;
							break;
						endif;

						$temp_tax_amount = $temp_tax_amount - ($tax_rate->tax_rate_band/12);
					else:

						$c_tax = ($minimum_tax_rate->minimum_tax_rate/100) * ($sum_taxable_income - $tax_relief);


					endif;

					$total_tax_amount = $c_tax + $total_tax_amount;

				endforeach;

				//endif;


				if($total_tax_amount <= $minimum_tax):

					$total_tax_amount = $minimum_tax;

				endif;

				$salary_array = array(

					'salary_employee_id' => $employee->employee_id,
					'salary_payment_definition_id' => $tax_payment_definition->payment_definition_id,
					'salary_pay_month' => $payroll_month,
					'salary_pay_year' => $payroll_year,
					'salary_amount' => $total_tax_amount,
					'salary_confirmed' => 0

				);

				$salary_array = $this->security->xss_clean($salary_array);
				$query = $this->salaries->add_salary($salary_array, 'salary_'.$tenant_id);

				endif;

				//tax computation




			endif;

			endforeach;

			if($query == true):

				$log_array = array( 'tenant_id' => $tenant_id,
					'log_user_id' => $this->users->get_user($username)->user_id,
					'log_description' => "Ran Payroll Routine"
				);

				$this->logs->add_log($log_array);

				$data['employees'] = $employees;
				$data['payroll_month'] = $payroll_month;
				$data['payroll_year'] = $payroll_year;
				$data['tenant_id'] = $tenant_id;
				$this->load->view('payroll/payroll_routine_summary', $data);
			else:

				echo "An Error Occurred";

			endif;

			endif;

			else:

				redirect('/access_denied');

			endif;


		endif;

		else:
			redirect('/login');
		endif;


	}

	public function approve_payroll_routine(){
		$username = $this->session->userdata('user_username');
		//$employee_id = $this->uri->segment(2);

		if(isset($username)):
			$user_type = $this->users->get_user($username)->user_type;

			$tenant_id = $this->users->get_user($username)->tenant_id;
			$active_plans = $this->users->get_sub_true_status($tenant_id);

			if(!empty($active_plans)):

				$data['active_plan'] = 1;
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

			if($permission->payroll_management == 1):

				$data['user_data'] = $this->users->get_user($username);
				$data['payment_definitions'] = $this->payroll_configurations->view_payment_definitions($tenant_id);
				$data['departments'] = $this->hr_configurations->view_departments($tenant_id);
				$data['employees'] = $this->employees->view_employees($tenant_id);
				$data['payroll'] = $this->payroll_configurations->get_payroll_month_year($tenant_id);
				$data['csrf_name'] = $this->security->get_csrf_token_name();
				$data['csrf_hash'] = $this->security->get_csrf_hash();
				$data['employees'] = $this->employees->view_employees($tenant_id);
				$data['payroll_month'] = $this->payroll_configurations->get_payroll_month_year($tenant_id)->payroll_month_year_month;
				$data['payroll_year'] = $this->payroll_configurations->get_payroll_month_year($tenant_id)->payroll_month_year_year;

				$salaries = $this->salaries->view_salaries($tenant_id);

				$check_salary = 0;
				foreach ($salaries as $salary):

					if(($salary->salary_pay_month == $this->payroll_configurations->get_payroll_month_year($tenant_id)->payroll_month_year_month) && ($salary->salary_pay_year == $this->payroll_configurations->get_payroll_month_year($tenant_id)->payroll_month_year_year) && ($salary->salary_confirmed == 0)):

						$check_salary ++;

					endif;

				endforeach;



				$data['check_salary'] = $check_salary;
				$data['tenant_id'] = $tenant_id;


				$this->load->view('payroll/approve_payroll_routine', $data);

				else:
					redirect('/access_denied');
				endif;

			else:

				redirect('/access_denied');

			endif;

			else:

				redirect('subscription_expired');

				endif;
		else:
			redirect('/login');
		endif;

	}

	public function undo_payroll_routine(){

		$username = $this->session->userdata('user_username');
		//$employee_id = $this->uri->segment(2);

		if(isset($username)):
			$tenant_id = $this->users->get_user($username)->tenant_id;
			if($this->agent->referrer() !== site_url('approve_payroll_routine')):

				redirect('error_404');

			else:


				$permission = $this->users->check_permission($username);
				$data['employee_management'] = $permission->employee_management;
				$data['notifications'] = $this->employees->get_notifications(0, $tenant_id);
				$data['payroll_management'] = $permission->payroll_management;
				$data['biometrics'] = $permission->biometrics;
				$data['user_management'] = $permission->user_management;
				$data['configuration'] = $permission->configuration;
				$data['payroll_configuration'] = $permission->payroll_configuration;
				$data['hr_configuration'] = $permission->hr_configuration;

				if($permission->payroll_management == 1):

					$data['user_data'] = $this->users->get_user($username);
					$data['payment_definitions'] = $this->payroll_configurations->view_payment_definitions($tenant_id);
					$data['departments'] = $this->hr_configurations->view_departments($tenant_id);
					$data['employees'] = $this->employees->view_employees($tenant_id);
					$data['payroll'] = $this->payroll_configurations->get_payroll_month_year($tenant_id);
					$data['csrf_name'] = $this->security->get_csrf_token_name();
					$data['csrf_hash'] = $this->security->get_csrf_hash();

					$payroll_month = $this->payroll_configurations->get_payroll_month_year($tenant_id)->payroll_month_year_month;
					$payroll_year = $this->payroll_configurations->get_payroll_month_year($tenant_id)->payroll_month_year_year;

					$minimum_tax_rate = $this->payroll_configurations->get_minimum_tax_rate($tenant_id);
					$pension_rate = $this->payroll_configurations->get_pension_rate($tenant_id);

					// 1 == loan, 2 == tax, 3 ==  pension 4 == hmo
					$loan_payment_definition = $this->payroll_configurations->get_fixed_id(1, $tenant_id);
					$tax_payment_definition = $this->payroll_configurations->get_fixed_id(2, $tenant_id);
					$pension_payment_definition = $this->payroll_configurations->get_fixed_id(3, $tenant_id);




					$salaries = $this->salaries->view_salaries($tenant_id);

					$check_salary = 0;
					foreach ($salaries as $salary):

						if(($salary->salary_pay_month == $payroll_month) && ($salary->salary_pay_year == $payroll_year) && ($salary->salary_confirmed == 0)):

							$check_salary ++;

						endif;

					endforeach;

					if($check_salary == 0):

						$msg = array(
							'msg'=> 'No Routine to Undo',
							'location' => site_url('approve_payroll_routine'),
							'type' => 'error'

						);
						$this->load->view('swal', $msg);


					else:

						$this->salaries->undo_salary_routine($payroll_month, $payroll_year, $tenant_id);

						$loan_repayments = $this->loans->view_loan_repayments_by_my($payroll_month, $payroll_year, $tenant_id);

						foreach ($loan_repayments as $loan_repayment):

							if($loan_repayment->loan_repayment_type == 1):

								$loan_repayment_amount = $loan_repayment->loan_repayment_amount;

								$loan = $this->loans->view_loan($loan_repayment->loan_repayment_loan_id, $tenant_id);

								$new_loan_balance = $loan->loan_balance + $loan_repayment_amount;

								if($new_loan_balance > 0):

									$loan_array = array(
										'loan_balance' => $new_loan_balance,
										'loan_status' => 0
									);

								else:

									$loan_array = array(
										'loan_balance' => $new_loan_balance,
										'loan_status' => 1
									);

								endif;

								$loan_array = $this->security->xss_clean($loan_array);
								$this->loans->update_loan($loan_repayment->loan_repayment_loan_id, $loan_array, $tenant_id);




							endif;


						endforeach;

						$query = $this->loans->undo_loan_repayment($payroll_month, $payroll_year, $tenant_id);

						if($query == true):
							$log_array = array( 'tenant_id' => $tenant_id,
								'log_user_id' => $this->users->get_user($username)->user_id,
								'log_description' => "Undo Payroll Routine"
							);

							$this->logs->add_log($log_array);

							$msg = array(
								'msg'=> 'Action Successful',
								'location' => site_url('approve_payroll_routine'),
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


			endif;

		else:
			redirect('/login');
		endif;

	}

	public function run_approve_payroll_routine(){
		$username = $this->session->userdata('user_username');
		//$employee_id = $this->uri->segment(2);
		$tenant_id = $this->users->get_user($username)->tenant_id;
		if(isset($username)):
			if($this->agent->referrer() !== site_url('approve_payroll_routine')):

				redirect('error_404');

			else:


				$permission = $this->users->check_permission($username);
				$data['employee_management'] = $permission->employee_management;
				$data['notifications'] = $this->employees->get_notifications(0, $tenant_id);
				$data['payroll_management'] = $permission->payroll_management;
				$data['biometrics'] = $permission->biometrics;
				$data['user_management'] = $permission->user_management;
				$data['configuration'] = $permission->configuration;
				$data['payroll_configuration'] = $permission->payroll_configuration;
				$data['hr_configuration'] = $permission->hr_configuration;

				if($permission->payroll_management == 1):

					$data['user_data'] = $this->users->get_user($username);
					$data['payment_definitions'] = $this->payroll_configurations->view_payment_definitions($tenant_id);
					$data['departments'] = $this->hr_configurations->view_departments($tenant_id);
					$data['employees'] = $this->employees->view_employees($tenant_id);
					$data['payroll'] = $this->payroll_configurations->get_payroll_month_year($tenant_id);
					$data['csrf_name'] = $this->security->get_csrf_token_name();
					$data['csrf_hash'] = $this->security->get_csrf_hash();

					$payroll_month = $this->payroll_configurations->get_payroll_month_year($tenant_id)->payroll_month_year_month;
					$payroll_year = $this->payroll_configurations->get_payroll_month_year($tenant_id)->payroll_month_year_year;

					$minimum_tax_rate = $this->payroll_configurations->get_minimum_tax_rate($tenant_id);
					$pension_rate = $this->payroll_configurations->get_pension_rate($tenant_id);

					// 1 == loan, 2 == tax, 3 ==  pension 4 == hmo
					$loan_payment_definition = $this->payroll_configurations->get_fixed_id(1, $tenant_id);
					$tax_payment_definition = $this->payroll_configurations->get_fixed_id(2, $tenant_id);
					$pension_payment_definition = $this->payroll_configurations->get_fixed_id(3, $tenant_id);




					$salaries = $this->salaries->view_salaries($tenant_id);

					$check_salary = 0;
					foreach ($salaries as $salary):

						if(($salary->salary_pay_month == $payroll_month) && ($salary->salary_pay_year == $payroll_year) && ($salary->salary_confirmed == 0)):

							$check_salary ++;

						endif;

					endforeach;

					if($check_salary == 0):

						$msg = array(
							'msg'=> 'No Routine to Approve',
							'location' => site_url('approve_payroll_routine'),
							'type' => 'error'

						);
						$this->load->view('swal', $msg);


					else:


					$payroll_data = array(
						'salary_confirmed' => 1
					);
						$payroll_data = $this->security->xss_clean($payroll_data);

						$query = $this->salaries->approve_payroll($payroll_month, $payroll_year, $payroll_data, $tenant_id);

						if($query == true):
							
							$employees = $this->employees->view_employees($tenant_id);
							
							foreach ($employees as $employee):
								
								if($employee->employee_status == 3 || $employee->employee_status == 0):
								
								
								else:
									
									
									
									
									
									$userEmail= $employee->employee_official_email;
									
									$user = $this->users->get_user($employee->employee_unique_id);
									$user_id = $user->user_id;
									
									
									$subject='Your PaySlip is Ready';
									$config = Array(
										'mailtype' => 'html',
										'charset' => 'utf-8',
										'priority' => '1'
									);
									$this->load->library('email', $config);
									
									$this->email->set_newline("\r\n");
									
									$this->email->from('support@ihumane.net', 'iHumane');
									
									$this->email->to($userEmail);  // replace it with receiver mail id
									$this->email->subject($subject); // replace it with relevant subject
									$monthName = date('F', mktime(0, 0, 0, $payroll_month, 10));
									
									$data = array(
										'name' => $employee->employee_first_name." ".$employee->employee_last_name,
										'url' => 'https://app.ihumane.net/view_pay_slips/'.$user_id.'/'.$tenant_id.'/'.$payroll_month.'/'.$payroll_year,
										'month' => $payroll_month,
										'monthname' => $monthName,
										'year' => $payroll_year
									);
									
									
									
									$body = $this->load->view('emails/payslip',$data,TRUE);
									$this->email->message($body);
									$this->email->send();
								
								
								endif;
								
								
								endforeach;
							
							
							
							

							$log_array = array( 'tenant_id' => $tenant_id,
								'log_user_id' => $this->users->get_user($username)->user_id,
								'log_description' => "Approved Payroll Routine"
							);

							$this->logs->add_log($log_array);

							$msg = array(
								'msg'=> 'Action Successful',
								'location' => site_url('approve_payroll_routine'),
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


			endif;

		else:
			redirect('/login');
		endif;

	}

	public function tax_test(){

		//$taxable_incomes = $this->salaries->get_taxable_incomes($employee->employee_id, $payroll_year, $payroll_month);
		//$gross = 200000;
		$sum_taxable_income = 160000;
		$minimum_tax_rate = $this->payroll_configurations->get_minimum_tax_rate();


		$tax_relief = ((20/100) * $sum_taxable_income) + (200000/12);

		$minimum_tax = ($minimum_tax_rate->minimum_tax_rate/100) * ($sum_taxable_income - $tax_relief);

		//if($tax_relief <= 0 or $tax_relief <= $minimum_tax):

		//$tax_amount = $minimum_tax;

		//else:

		$total_tax_amount = 0;
		$temp_tax_amount = $sum_taxable_income - $tax_relief;
		$tax_rates = $this->payroll_configurations->view_tax_rates_asc();

		foreach ($tax_rates as $tax_rate):
			if($sum_taxable_income > 0):

				if($temp_tax_amount >= $tax_rate->tax_rate_band/12):
					$c_tax =  ($tax_rate->tax_rate_rate/100) * ($tax_rate->tax_rate_band/12);
				else:
					$c_tax = ($tax_rate->tax_rate_rate/100) * ($temp_tax_amount);
					$total_tax_amount = $c_tax + $total_tax_amount;
					break;
				endif;

				$temp_tax_amount = $temp_tax_amount - ($tax_rate->tax_rate_band/12);
			else:

				$c_tax = ($minimum_tax_rate->minimum_tax_rate/100) * ($sum_taxable_income - $tax_relief);


			endif;

			$total_tax_amount = $c_tax + $total_tax_amount;

		endforeach;

		//endif;


		if($total_tax_amount <= $minimum_tax):

			$total_tax_amount = $minimum_tax;

		endif;


echo $total_tax_amount;


	}

}
