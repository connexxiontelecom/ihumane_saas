<?php


class Home extends CI_Controller
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
		$this->load->model('employees');
		$this->load->model('users');
		$this->load->model('payroll_configurations');
		$this->load->model('hr_configurations');
		$this->load->model('configurations');
		$this->load->model('logs');
		$this->load->model('biometric');
		$this->load->model('backoffices');
		$this->load->model('salaries');

		$this->load->model('loans');


	}

	public function index(){

		$this->employees->check_leave_end_date(date('yy-m-d'));

		$username = $this->session->userdata('user_username');

		if(isset($username)):



			if($this->users->get_user($username)->user_type == 1 || $this->users->get_user($username)->user_type == 3 || $this->users->get_user($username)->user_type == 4):

				$permission = $this->users->check_permission($username);
				$data['employee_management'] = $permission->employee_management;
				$data['notifications'] = $this->employees->get_notifications(0);
				$data['payroll_management'] = $permission->payroll_management;
				$data['biometrics'] = $permission->biometrics;
				$data['user_management'] = $permission->user_management;
				$data['configuration'] = $permission->configuration;
				$data['payroll_configuration'] = $permission->payroll_configuration;
				$data['hr_configuration'] = $permission->hr_configuration;
				$data['configuration'] = $permission->configuration;
				$data['user_data'] = $this->users->get_user($username);

				$data['employees'] = $this->employees->view_employees();
				$data['users'] = $this->users->view_users();
				$data['departments'] = $this->hr_configurations->view_departments();
				$data['leaves'] = $this->employees->get_employees_leaves();

				$date = date('Y-m-d', time());
				$data['present_employees'] = $this->biometric->check_today_attendance($date);
        $online_users = $this->users->view_online_users();
        foreach ($online_users as $key => $user) {
          if ($user->user_token == ''){
            unset($online_users[$key]);
          }
        }
        $data['online_users'] = $online_users;
        $data['total_income_month'] = $this->get_total_income_month();
        $data['total_deduction_month'] = $this->get_total_deduction_month();
        $data['total_income_year'] = $this->get_total_income_year();
        $data['total_deduction_year'] = $this->get_total_deduction_year();
        $data['pending_loans'] = $this->loans->count_pending_loans();
        $data['running_loans'] = $this->loans->count_running_loans();
        $data['personalized_employees'] = $this->payroll_configurations->count_personalized_employees();
        $data['categorized_employees'] = $this->payroll_configurations->count_categorized_employees();
        $data['variational_payments'] = $this->payroll_configurations->count_variational_payments();
        $data['is_payroll_routine_run'] = $this->is_payroll_routine_run();
        $data['csrf_name'] = $this->security->get_csrf_token_name();
        $data['csrf_hash'] = $this->security->get_csrf_hash();
        $data['pending_leaves'] = $this->employees->count_pending_leaves();
        $data['approved_leaves'] = $this->employees->count_approved_leaves();
        $data['finished_leaves'] = $this->employees->count_finished_leaves();
        $data['upcoming_leaves'] = $this->employees->get_upcoming_leaves();
        $data['open_queries'] = $this->employees->count_open_queries();
        $data['pending_trainings'] = $this->employees->count_pending_trainings();
        $data['running_appraisals'] = $this->employees->count_running_appraisals();
        $data['finished_appraisals'] = $this->employees->count_finished_appraisals();
        $data['hr_documents'] = $this->hr_configurations->view_hr_documents();
//        print_r($this->hr_configurations->view_hr_documents());

				$this->load->view('index', $data);
			elseif($this->users->get_user($username)->user_type == 2):

				redirect('employee_main');
			endif;



		else:
			redirect('login');
		endif;

//		$user_data = array(
//			'user_username' => 'administrator',
//			'user_email'=> 'admin@admin.com',
//			'user_password'=> password_hash('password1234', PASSWORD_BCRYPT),
//			'user_name' => 'Administrator Administrator',
//			'user_status' => '1'
//		);
//
//		$permission_data = array(
//			'username' => 'administrator',
//			'employee_management'=> 1,
//			'payroll_management' => 1,
//			'biometrics' => 1,
//			'user_management' => 1
//
//		);
//
//		$user_data = $this->security->xss_clean($user_data);
//		$permission_data = $this->security->xss_clean($permission_data);
//
//
//		$query = $this->users->add($user_data, $permission_data);
//
//
//
//		echo $query;
	}

	public function logout(){

		$user_username = $this->session->userdata('user_username');

		if(isset($user_username)):

			$log_array = array(
				'log_user_id' => $this->users->get_user($user_username)->user_id,
				'log_description' => "Logged Out"
			);

			$query = $this->logs->add_log($log_array);

			if($query == true):

			$user_token_data = array(
				'user_token' => null,
			);
			$user_token_data = $this->security->xss_clean($user_token_data);
			$query = $this->users->update_token($user_username, $user_token_data);
			$this->session->unset_userdata('user_username');
			  $this->session->unset_userdata('login_time');
			  $this->session->sess_destroy();
			redirect('/login');
			endif;

		else:
			redirect('/access_denied');

		endif;


	}

	public function auth_login(){
		$this->employees->check_leave_end_date(date('yy-m-d'));

		$user_username = $this->session->userdata('user_username');



		if(isset($user_username)):
			redirect('home');
		else:

			$username = $this->input->post('username');
			$password = $this->input->post('password');

			if(empty($username) || empty($password)):
				$errormsg = ' ';
				$error_msg = array('error' => $errormsg);
				$data['error'] = $errormsg;

				$data['csrf_name'] = $this->security->get_csrf_token_name();
				$data['csrf_hash'] = $this->security->get_csrf_hash();

				$this->load->view('auth/login', $data);
			else:
				$data = array(
				'user_username' => $username,
				'password' => $password
				);
				$data = $this->security->xss_clean($data);
				$query = $this->users->login($data);
				$time = time();
				if($query == true):
					if($this->users->get_user($username)->user_status > 0):

						$check_user_login = $this->users->check_user_login($username);
						$user_token = $check_user_login->user_token;

						if(empty($user_token)):
							$user_token_data = array(
								'user_token' => $time
							);
							$user_token_data = $this->security->xss_clean($user_token_data);
							$query = $this->users->update_token($username, $user_token_data);
							if($query == true):
								$log_array = array(
									'log_user_id' => $this->users->get_user($username)->user_id,
									'log_description' => "Logged In"
								);

								$this->logs->add_log($log_array);
								if($this->users->get_user($username)->user_type == 1 || $this->users->get_user($username)->user_type == 3 || $this->users->get_user($username)->user_type == 4):

								redirect('home');
								elseif($this->users->get_user($username)->user_type == 2):

									$employee_id = $this->employees->get_employee_by_unique($username)->employee_id;

									$trainings =  $this->employees->get_employee_training($employee_id);

									$count_training = 0;

									foreach ($trainings as $training):
										if($training->employee_training_status == 0):
											$count_training++;

										endif;

									endforeach;

									if($count_training > 0):
										$notification_data = array(
											'notification_employee_id'=> $employee_id,
											'notification_link'=> 'my_trainings',
											'notification_type' => 'You Have A Pending Training',
											'notification_status'=> 0
										);

										$this->employees->insert_notifications($notification_data);
									endif;


									redirect('employee_main');
								endif;
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

								$this->load->view('auth/login', $data);
							elseif ($diff >=1800):
								$user_token_data = array(
									'user_token' => $time
								);
								$user_token_data = $this->security->xss_clean($user_token_data);
								$query = $this->users->update_token($username, $user_token_data);
								if($query == true):


									$log_array = array(
										'log_user_id' => $this->users->get_user($username)->user_id,
										'log_description' => "Logged In"
									);

									$this->logs->add_log($log_array);
									if($this->users->get_user($username)->user_type == 1 || $this->users->get_user($username)->user_type == 3 || $this->users->get_user($username)->user_type == 4):

										redirect('home');


									elseif($this->users->get_user($username)->user_type == 2):

										$employee_id = $this->employees->get_employee_by_unique($username)->employee_id;

										$trainings =  $this->employees->get_employee_training($employee_id);

										$count_training = 0;

										foreach ($trainings as $training):
											if($training->employee_training_status == 0):
												$count_training++;

											endif;

										endforeach;

										if($count_training > 0):
											$notification_data = array(
												'notification_employee_id'=> $employee_id,
												'notification_link'=> 'my_trainings',
												'notification_type' => 'You Have A Pending Training',
												'notification_status'=> 0
											);

											$this->employees->insert_notifications($notification_data);
										endif;


										redirect('employee_main');
									endif;
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

						$this->load->view('auth/login', $data);

					endif;
				else:
					$errormsg = 'Invalid Username or Password     ';
					$error_msg = array(
						'error' => $errormsg
					);
					$data['error'] = $errormsg;

					$data['csrf_name'] = $this->security->get_csrf_token_name();
					$data['csrf_hash'] = $this->security->get_csrf_hash();

					$this->load->view('auth/login', $data);


				endif;
			endif;
		endif;

		}


	public function register(){

		$plan_id = $this->uri->segment(2);

		$user_username = $this->session->userdata('user_username');



		if(isset($user_username)):
			redirect('home');
		else:
			$data['csrf_name'] = $this->security->get_csrf_token_name();
			$data['csrf_hash'] = $this->security->get_csrf_hash();

			if(!empty($plan_id)):

				$data['plan_id'] = $plan_id;
				$pla = $this->backoffices->get_plan($plan_id);

				if(empty($pla)):

					redirect('error_404');

					else:

				$data['pla'] = $pla;

					endif;

			endif;
			$data['plans'] = $this->backoffices->get_plans();

			$data['countries'] =   array(
				"Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla",
				"Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia",
				"Austria",
				"Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium",
				"Belize",
				"Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana",
				"Bouvet Island",
				"Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria",
				"Burkina Faso",
				"Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands",
				"Central African Republic", "Chad", "Chile", "China", "Christmas Island",
				"Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo",
				"Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire",
				"Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti",
				"Dominica",
				"Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador",
				"Equatorial Guinea",
				"Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands",
				"Fiji",
				"Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia",
				"French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana",
				"Gibraltar",
				"Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea",
				"Guinea-Bissau",
				"Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)",
				"Honduras",
				"Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)",
				"Iraq",
				"Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya",
				"Kiribati",
				"Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan",
				"Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia",
				"Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau",
				"Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia",
				"Maldives",
				"Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius",
				"Mayotte",
				"Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco",
				"Mongolia",
				"Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal",
				"Netherlands",
				"Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger",
				"Nigeria", "Niue",
				"Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau",
				"Panama",
				"Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland",
				"Portugal",
				"Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda",
				"Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa",
				"San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles",
				"Sierra Leone",
				"Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia",
				"South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka",
				"St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname",
				"Svalbard and Jan Mayen Islands",
				"Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic",
				"Taiwan, Province of China",
				"Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga",
				"Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands",
				"Tuvalu",
				"Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States",
				"United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu",
				"Venezuela",
				"Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)",
				"Wallis and Futuna Islands",
				"Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe"
			);

			$this->load->view('auth/register', $data);

		endif;

	}

	public function register_a(){

			$method = $this->input->server('REQUEST_METHOD');
			if($method == 'POST' || $method == 'Post' || $method == 'post'):

				extract($_POST);

			$check_email = $this->users->get_tenant_email($tenant_contact_email);
			$check_username = $this->users->get_tenant_username($tenant_username);

			if(empty($check_email) && empty($check_username)):

				$tenant_array = array(

					'tenant_username' => $tenant_username,
					'tenant_password' => password_hash($tenant_password, PASSWORD_BCRYPT),
					'tenant_contact_name' => $tenant_contact_name,
					'tenant_contact_email' => $tenant_contact_email,
					'tenant_contact_phone' => $tenant_contact_phone,
					'tenant_business_name' => $tenant_business_name,
					'tenant_business_website' => $tenant_business_website,
					'tenant_country' => $tenant_country,
					'tenant_city' => $tenant_city,
					'tenant_business_type' => $tenant_business_type,
					'tenant_usage' => $tenant_usage,
				);

				$tenant_array = $this->security->xss_clean($tenant_array);

				$tenant_id = $this->users->add_new_tenant($tenant_array);

				$this->configurations->create_salary_table($tenant_id);
				$this->configurations->create_tax_rate_table($tenant_id);
				$this->configurations->create_loans_table($tenant_id);
				$this->configurations->create_loan_repayment_table($tenant_id);
				$this->configurations->create_variational_payment_table($tenant_id);
				$this->configurations->create_loan_reschedule_log_table($tenant_id);

				$user_array = array(
					'user_username'=> $tenant_username,
					'user_email'=> $tenant_contact_email,
					'user_password'=> password_hash($tenant_password, PASSWORD_BCRYPT),
					'user_name'=> $tenant_contact_name,
					'user_status'=>1,
					'user_type' => 4, //original admin
					'tenant_id' => $tenant_id
				);

				$permission_array = array(
					'username'=> $tenant_username,
					'employee_management'=> 1,
					'payroll_management'=> 1,
					'biometrics' => 1,
					'user_management'=> 1,
					'configuration' => 1,
					'hr_configuration' => 1,
					'payroll_configuration' => 1,
					'tenant_id' => $tenant_id
				);
				$user_array = $this->security->xss_clean($user_array);
				$permission_array = $this->security->xss_clean($permission_array);

				$this->users->add($user_array, $permission_array);

				$plan = $this->backoffices->get_plan($tenant_plan);

				$duration = $plan->plan_duration;
				$Date = date('Y-m-d');
				$end_date =  date('Y-m-d', strtotime($Date. ' + '.$duration. 'days'));



				$subscription_array = array(

					'subscription_tenant_id'=> $tenant_id,
					'subscription_plan_id' => $tenant_plan,
					'subscription_start_date' => date('Y-m-d'),
					'subscription_end_date' => $end_date,
					'subscription_reference_code' => @$reference_code,
					'subscription_status' => 1
				);

				$subscription_array = $this->security->xss_clean($subscription_array);

				$query = $this->users->new_subscription($subscription_array);

				$salary_array = array(
					'salary_employee_id' => 0,
					'salary_payment_definition_id' =>0,
					'salary_pay_month' => 0,
					'salary_pay_year' => $payroll_start_year,
					'salary_amount' => 0,
					'salary_confirmed' => 0
				);
				$salary_table = 'salary_'.$tenant_id;

				$query = $this->salaries->add_salary($salary_array, $salary_table);


				if($query == true):

					$msg = array(
						'msg'=> 'Welcome to iHumane Click ok to Login',
						'location' => site_url('login'),
						'type' => 'success'

					);
					$this->load->view('swal', $msg);

				else:
					$msg = array(
						'msg'=> 'An Error Occurred',
						'location' => site_url('register'),
						'type' => 'error'

					);
					$this->load->view('swal', $msg);

				endif;

		else:
			$msg = array(
				'msg'=> 'Username or Email Already Exists',
				'location' => site_url('register'),
				'type' => 'error'

			);
			$this->load->view('swal', $msg);

		endif;

			else:

				redirect('error_404');


			endif;



	}

	public function check_username(){

		$username = $this->input->post('username');
		echo json_encode($this->users->get_tenant_username($username));
	}

	public function check_email(){
		$email = $this->input->post('email');
		echo json_encode($this->users->get_tenant_email($email));

	}

	public function access_denied(){
			$user_username = $this->session->userdata('user_username');

			if(isset($user_username)):

				$this->load->view('auth/access_denied');


			else:
				redirect('/login');

			endif;


		}

	public function error_404(){
		$user_username = $this->session->userdata('user_username');

		if(isset($user_username)):

			$this->load->view('auth/error_404');


		else:
			redirect('/login');

		endif;


	}

	public function test_table(){

//		$this->configurations->create_salary_table(1);
//		$this->configurations->create_tax_rate_table(1);
//		$this->configurations->create_loans_table(1);
//		$this->configurations->create_loan_repayment_table(1);
//		$this->configurations->create_variational_payment_table(1);



	}

	public function timestamp(){
    date_default_timezone_set('Africa/Lagos');
    echo $timestamp = date('F j, Y g:i:s a');
  }

  public function get_income_statistics() {
    $income_payments = $this->payroll_configurations->get_income_payments();
    $income_payments_id = array();
    foreach ($income_payments as $income_payment) {
      $income_payments_id[] = $income_payment->payment_definition_id;
    }
    echo $income_salaries = json_encode($this->salaries->get_salaries_by_payment_id($income_payments_id));
  }

  public function get_deduction_statistics() {
	  $deduction_payments = $this->payroll_configurations->get_deduction_payments();
	  $deduction_payments_id = array();
	  foreach ($deduction_payments as $deduction_payment) {
      $deduction_payments_id[] = $deduction_payment->payment_definition_id;
    }
	  echo $deduction_salaries = json_encode($this->salaries->get_salaries_by_payment_id($deduction_payments_id));
  }

  public function get_total_income_month(){
    $income_payments = $this->payroll_configurations->get_income_payments();
    $income_payments_id = array();
    foreach ($income_payments as $income_payment) {
      $income_payments_id[] = $income_payment->payment_definition_id;
    }
    $salaries_current_month = $this->salaries->get_salaries_current_month($income_payments_id);
    $sum = 0;
    foreach($salaries_current_month as $salary_current_month) {
      $sum += $salary_current_month->salary_amount;
    }
    return $sum;
  }

  public function get_total_income_year(){
    $income_payments = $this->payroll_configurations->get_income_payments();
    $income_payments_id = array();
    foreach ($income_payments as $income_payment) {
      $income_payments_id[] = $income_payment->payment_definition_id;
    }
    $salaries_current_year = $this->salaries->get_salaries_current_year($income_payments_id);
    $sum = 0;
    foreach($salaries_current_year as $salary_current_year) {
      $sum += $salary_current_year->salary_amount;
    }
    return $sum;
  }

  public function get_total_deduction_month(){
    $deduction_payments = $this->payroll_configurations->get_deduction_payments();
    $deduction_payments_id = array();
    foreach ($deduction_payments as $deduction_payment) {
      $deduction_payments_id[] = $deduction_payment->payment_definition_id;
    }
    $salaries_current_month = $this->salaries->get_salaries_current_month($deduction_payments_id);
    $sum = 0;
    foreach($salaries_current_month as $salary_current_month) {
      $sum += $salary_current_month->salary_amount;
    }
    return $sum;
  }

  public function get_total_deduction_year(){
    $deduction_payments = $this->payroll_configurations->get_deduction_payments();
    $deduction_payments_id = array();
    foreach ($deduction_payments as $deduction_payment) {
      $deduction_payments_id[] = $deduction_payment->payment_definition_id;
    }
    $salaries_current_year = $this->salaries->get_salaries_current_year($deduction_payments_id);
    $sum = 0;
    foreach($salaries_current_year as $salary_current_year) {
      $sum += $salary_current_year->salary_amount;
    }
    return $sum;
  }

  public function is_payroll_routine_run(){
	  $current_month = date('m');
//	  $current_month = 10;
	  $current_year = date('Y');

    $salaries = $this->salaries->view_salaries();
    $check_salary = 0;
    foreach ($salaries as $salary):
      if(($salary->salary_pay_month == $current_month) && ($salary->salary_pay_year == $current_year)):
        $check_salary ++;
      endif;
    endforeach;
    if($check_salary > 0):
      return true;
    else:
      return false;
    endif;
  }
}
