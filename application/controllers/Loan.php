<?php


class Loan extends CI_Controller
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
		$this->load->model('loans');
		$this->load->model('logs');

	}

	public function loans(){
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

				$data['loans'] = $this->loans->view_loans($tenant_id);

				$data['csrf_name'] = $this->security->get_csrf_token_name();
				$data['csrf_hash'] = $this->security->get_csrf_hash();


				//print_r($data['loans']);
				$this->load->view('loan/loans', $data);
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

	public function new_loan(){
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

				$data['employees'] = $this->employees->view_employees($tenant_id);
				$data['payment_definitions'] = $this->payroll_configurations->view_payment_definitions($tenant_id);
				$data['csrf_name'] = $this->security->get_csrf_token_name();
				$data['csrf_hash'] = $this->security->get_csrf_hash();
				$data['payroll'] = $this->payroll_configurations->get_payroll_month_year($tenant_id);

				$this->load->view('loan/new_loan', $data);

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


	public function add_new_loan(){

		$username = $this->session->userdata('user_username');

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


				$payroll_month = $this->payroll_configurations->get_payroll_month_year($tenant_id)->payroll_month_year_month;
				$payroll_year = $this->payroll_configurations->get_payroll_month_year($tenant_id)->payroll_month_year_year;

				$employee_id = $this->input->post('employee_id');
				$payment_definition = $this->input->post('payment_definition_id');
				$start_month = $this->input->post('start_month');
				$start_year = $this->input->post('start_year');
				$end_month = $this->input->post('end_month');
				$end_year = $this->input->post('end_year');
				$amount = $this->input->post('amount');
				$reason =$this->input->post('reason');
				$monthly_repayment = $this->input->post('repayment_amount');

				if((empty($employee_id))|| (empty($payment_definition)) || (empty($start_month)) || (empty($start_year))
					|| (empty($end_month)) || (empty($end_year)) || (empty($amount))):

					redirect('error_404');

					else:

						$start_date = $start_year."-".$start_month;
						$end_date = $end_year."-".$end_month;
						$payroll_date = $payroll_year."-".$payroll_month;

						$installments = floor((strtotime($end_date) - strtotime($start_date))/ (30*60*60*24))+1;

						//echo $installments;

						if((strtotime($end_date) > strtotime($start_date)) && (strtotime($start_date) > strtotime($payroll_date))):
							$loan_array = array(
								'loan_employee_id'=> $employee_id,
								'loan_payment_definition_id'=>$payment_definition,
								'loan_amount' => $amount,
								'loan_reason' => $reason,
								'loan_start_year'=> $start_year,
								'loan_start_month' => $start_month,
								'loan_end_year' => $end_year,
								'loan_end_month' => $end_month,
								'loan_installments' => $installments,
								'loan_monthly_repayment' => $monthly_repayment,
								'loan_balance' => $amount,

							);

							$loan_array = $this->security->xss_clean($loan_array);

							//print_r($loan_array);
						 $query = $this->loans->add_loan($loan_array, $tenant_id);

						 if(($query == true)):
							 $log_array = array(
								 'log_user_id' => $this->users->get_user($username)->user_id,
								 'log_description' => "Initiated Loan Application"
							 );

							 $this->logs->add_log($log_array);
							 $msg = array(
								 'msg'=> 'Loan Added Successfully',
								 'location' => site_url('loans'),
								 'type' => 'success'

							 );
							 $this->load->view('swal', $msg);

						 else:
							 echo "An Error Occurred";
						 endif;

						else:
							$msg = array(
								'msg'=> 'Check year and Month Entry',
								'location' => site_url('loans'),
								'type' => 'error'

							);
							$this->load->view('swal', $msg);
								endif;


//				if($start_year > $payroll_year):
//					if($end_year > $start_year):
//						$loan_array = array(
//							'loan_employee_id'=> $employee_id,
//							'loan_payment_definition_id'=>$payment_definition,
//							'loan_amount' => $amount,
//							'loan_start_year'=> $start_year,
//							'loan_start_month' => $start_month,
//							'loan_end_year' => $end_year,
//							'loan_end_month' => $end_month,
//							'loan_installments' => $installments
//						);
//
//						$loan_array = $this->security->xss_clean($loan_array);
//
//						print_r($loan_array);
////						$query = $this->loans->add_loan($loan_array);
////
////						if(($query == true)):
////							$msg = array(
////								'msg'=> 'Loan Added Successfully',
////								'location' => site_url('loans'),
////								'type' => 'success'
////
////							);
////							$this->load->view('swal', $msg);
////
////						else:
////							echo "An Error Occurred";
////						endif;
//
//
//
//
//					endif;
//
//					if($end_month < $start_month ):
//						$msg = array(
//							'msg'=> 'Check year and Month Entry',
//							'location' => site_url('employee_salary_structure'),
//							'type' => 'error'
//
//						);
//						$this->load->view('swal', $msg);
//
//
//					endif;
//
//				endif;
//
//				if(($start_year === $payroll_year) || ($start_year === $end_year) ):
//					if($start_month < $payroll_month):
//						$msg = array(
//							'msg'=> 'Check year and Month Entry',
//							'location' => site_url('employee_salary_structure'),
//							'type' => 'error'
//
//						);
//						$this->load->view('swal', $msg);
//					 elseif($end_month > $start_month):
//						 $loan_array = array(
//							 'loan_employee_id'=> $employee_id,
//							 'loan_payment_definition_id'=>$payment_definition,
//							 'loan_amount' => $amount,
//							 'loan_start_year'=> $start_year,
//							 'loan_start_month' => $start_month,
//							 'loan_end_year' => $end_year,
//							 'loan_end_month' => $end_month,
//							 'loan_installments' => $installments
//
//						 );
//
//						 $loan_array = $this->security->xss_clean($loan_array);
//
//						 print_r($loan_array);
////						 $query = $this->loans->add_loan($loan_array);
////
////						 if(($query == true)):
////							 $msg = array(
////								 'msg'=> 'Loan Added Successfully',
////								 'location' => site_url('loans'),
////								 'type' => 'success'
////
////							 );
////							 $this->load->view('swal', $msg);
////
////						 else:
////							 echo "An Error Occurred";
////						 endif;
//
//
//
//					 else:
//
//						 $msg = array(
//							 'msg'=> 'Check year and Month Entry',
//							 'location' => site_url('employee_salary_structure'),
//							 'type' => 'error'
//
//						 );
//						 $this->load->view('swal', $msg);
//
//
//
//					endif;
//
//
//
//
//				endif;



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
	
	public function edit_loan(){
	$loan_id = $this->uri->segment(2);

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
			if(empty($loan_id)):
				redirect('error_404');
			else:

			if($permission->payroll_management == 1):
				$data['user_data'] = $this->users->get_user($username);

				$data['employees'] = $this->employees->view_employees($tenant_id);
				$data['payment_definitions'] = $this->payroll_configurations->view_payment_definitions($tenant_id);
				$data['csrf_name'] = $this->security->get_csrf_token_name();
				$data['csrf_hash'] = $this->security->get_csrf_hash();
				$data['payroll'] = $this->payroll_configurations->get_payroll_month_year($tenant_id);


				$data['loan'] = $this->loans->view_loan($loan_id, $tenant_id);

				if(empty($data['loan'])):

					redirect('error_404');

				else:
					//print_r($data['loan']);

				$this->load->view('loan/edit_loan', $data);

				endif;



			else:

				redirect('/access_denied');

			endif;


			endif;
			else:
				redirect('access_denied');

				endif;

				else:

				redirect('subscription_expired');
					endif;
	else:
			redirect('/login');
		endif;
		
	}

	public function update_loan(){
		$username = $this->session->userdata('user_username');

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

					$data['employees'] = $this->employees->view_employees($tenant_id);
					$data['payment_definitions'] = $this->payroll_configurations->view_payment_definitions($tenant_id);
					$data['csrf_name'] = $this->security->get_csrf_token_name();
					$data['csrf_hash'] = $this->security->get_csrf_hash();
					$data['payroll'] = $this->payroll_configurations->get_payroll_month_year($tenant_id);

					$reschedule_type = $this->input->post('reschedule_type');



					if($reschedule_type == 0):


					$skip_month = $this->input->post('skip_month');
					$skip_year = $this->input->post('skip_year');

					$loan_id = $this->input->post('loan_id');

					$end_month = $this->loans->view_loan($loan_id, $tenant_id)->loan_end_month;
					$end_year = $this->loans->view_loan($loan_id, $tenant_id)->loan_end_year;


//					$loan_skip_year =  $this->loans->view_loan($loan_id)->loan_skip_year;
//					$loan_skip_month =  $this->loans->view_loan($loan_id)->loan_skip_month;

					$loan_balance = $this->loans->view_loan($loan_id, $tenant_id)->loan_balance;
					$log = $this->loans->view_loan_log($loan_id, $skip_month, $skip_year, $tenant_id);

					if(!empty($log)):

						$msg = array(
							'msg'=> 'Month Already Skipped',
							'location' => site_url('loans'),
							'type' => 'error'

						);
						$this->load->view('swal', $msg);


						else:


					if($end_month == 12):

						$end_year = $end_year + 1;
						$end_month = 1;
					else:

						$end_month = $end_month + 1;
					endif;


					$loan_array = array(
						'loan_end_month' => $end_month,
						'loan_end_year' => $end_year
					);

					$loan_array = $this->security->xss_clean($loan_array);


					$log_array = array(
						'loan_log_loan_id' => $loan_id,
						'loan_log_reschedule_type'=> $reschedule_type,
						'loan_log_loan_balance' => $loan_balance,
						'loan_log_skip_month' => $skip_month,
						'loan_log_skip_year' => $skip_year
					);
					$log_array = $this->security->xss_clean($log_array);
					$query = $this->loans->update_loan($loan_id, $loan_array, $tenant_id);
					$query_log = $this->loans->insert_loan_log($log_array, $tenant_id);

					if(($query == true) && ($query_log == true)):
						$log_array = array(
							'log_user_id' => $this->users->get_user($username)->user_id,
							'log_description' => "Skipped A month for A Loan"
						);

						$notification_data = array(
							'notification_employee_id'=> $this->loans->view_loan($loan_id, $tenant_id)->employee_id,
							'notification_link'=> 'my_loan',
							'notification_type' => 'Your Loan has been Skipped for a Month',
							'notification_status'=> 0,
							'tenant_id' => $tenant_id
						);

						$this->employees->insert_notifications($notification_data);

						$this->logs->add_log($log_array);
						$msg = array(
							'msg'=> 'Update Successfully',
							'location' => site_url('loans'),
							'type' => 'success'
						);
						$this->load->view('swal', $msg);

					else:
						echo "An Error Occurred";
					endif;

					endif;

				elseif($reschedule_type == 1):

					$new_monthly_repayment = $this->input->post('new_repayment_amount');
					$new_end_year = $this->input->post('new_end_year');
					$new_end_month = $this->input->post('new_end_month');

					$loan_id = $this->input->post('loan_id');

					$loan_balance = $this->loans->view_loan($loan_id, $tenant_id)->loan_balance;

						$loan_array = array(
							'loan_monthly_repayment' => $new_monthly_repayment,
							'loan_end_month' => $new_end_month,
							'loan_end_year' => $new_end_year
						);

						$loan_array = $this->security->xss_clean($loan_array);

						$log_array = array(
							'loan_log_loan_id' => $loan_id,
							'loan_log_reschedule_type'=> $reschedule_type,
							'loan_log_reschedule_amount'=> $new_monthly_repayment,
							'loan_log_loan_balance' => $loan_balance,
							);

						$log_array = $this->security->xss_clean($log_array);

						$query = $this->loans->update_loan($loan_id, $loan_array, $tenant_id);
						$query_log = $this->loans->insert_loan_log($log_array, $tenant_id);

						if(($query == true) && ($query_log == true)):
							$log_array = array(
								'log_user_id' => $this->users->get_user($username)->user_id,
								'log_description' => "Updated Loan Repayment"
							);

							$this->logs->add_log($log_array);

							$notification_data = array(
								'notification_employee_id'=> $this->loans->view_loan($loan_id, $tenant_id)->employee_id,
								'notification_link'=> 'my_loan',
								'notification_type' => 'Your Loan Repayment Amount has been changed',
								'notification_status'=> 0,
								'tenant_id' => $tenant_id

							);

							$this->employees->insert_notifications($notification_data);

							$msg = array(
								'msg'=> 'Update Successfully',
								'location' => site_url('loans'),
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
					redirect('error_404');
					endif;

		else:
			redirect('/login');
		endif;

	}


	public function approve_loan(){
		$username = $this->session->userdata('user_username');

		if($this->agent->referrer() !== site_url('loans')):

			redirect('error_404');

		else:

			if(isset($username)):
				$user_type = $this->users->get_user($username)->user_type;

				$tenant_id = $this->users->get_user($username)->tenant_id;
				if($user_type == 1 || $user_type == 3 || $user_type == 4):

				$loan_id = $this->uri->segment(2);

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

					$data['employees'] = $this->employees->view_employees();
					$data['payment_definitions'] = $this->payroll_configurations->view_payment_definitions($tenant_id);
					$data['csrf_name'] = $this->security->get_csrf_token_name();
					$data['csrf_hash'] = $this->security->get_csrf_hash();
					$data['payroll'] = $this->payroll_configurations->get_payroll_month_year($tenant_id);


					$loan_array = array(

						'loan_status' => 0
					);

					$loan_array = $this->security->xss_clean($loan_array);



					$query = $this->loans->update_loan($loan_id, $loan_array, $tenant_id);

					if($query == true):

						$log_array = array(
							'log_user_id' => $this->users->get_user($username)->user_id,
							'log_description' => "Approved Loan",
							'tenant_id' => $tenant_id
						);

						$this->logs->add_log($log_array);

						$notification_data = array(
							'notification_employee_id'=> $this->loans->view_loan($loan_id, $tenant_id)->employee_id,
							'notification_link'=> 'my_loan',
							'notification_type' => 'Your Loan application has been approved',
							'notification_status'=> 0,
							'tenant_id' => $tenant_id
						);

						$this->employees->insert_notifications($notification_data);
						$msg = array(
							'msg'=> 'Loan Approved',
							'location' => site_url('loans'),
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
					redirect('access_denied');
					endif;

			else:
				redirect('/login');
			endif;

		endif;

	}

	public function discard_loan(){
		$username = $this->session->userdata('user_username');

		if($this->agent->referrer() !== site_url('loans')):

			redirect('error_404');

		else:

			if(isset($username)):
				$user_type = $this->users->get_user($username)->user_type;

				$tenant_id = $this->users->get_user($username)->tenant_id;
				if($user_type == 1 || $user_type == 3 || $user_type == 4):

				$loan_id = $this->uri->segment(2);

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

					$data['employees'] = $this->employees->view_employees();
					$data['payment_definitions'] = $this->payroll_configurations->view_payment_definitions();
					$data['csrf_name'] = $this->security->get_csrf_token_name();
					$data['csrf_hash'] = $this->security->get_csrf_hash();
					$data['payroll'] = $this->payroll_configurations->get_payroll_month_year();


					$loan_array = array(

						'loan_status' => 3
					);

					$loan_array = $this->security->xss_clean($loan_array);



					$query = $this->loans->update_loan($loan_id, $loan_array, $tenant_id);

					if($query == true):

						$log_array = array(
							'log_user_id' => $this->users->get_user($username)->user_id,
							'log_description' => "Discarded Loan"
						);

						$this->logs->add_log($log_array);

						$notification_data = array(
							'notification_employee_id'=> $this->loans->view_loan($loan_id, $tenant_id)->employee_id,
							'notification_link'=> 'my_loan',
							'notification_type' => 'Your Loan application was rejected',
							'notification_status'=> 0,
							'tenant_id' => $tenant_id
						);

						$this->employees->insert_notifications($notification_data);
						$msg = array(
							'msg'=> 'Loan Discarded',
							'location' => site_url('loans'),
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

					redirect('access_denied');
					endif;

			else:
				redirect('/login');
			endif;

		endif;

	}
}
