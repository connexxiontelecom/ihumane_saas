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
		$this->load->helper('string');


	}

	public function index(){

		$this->employees->check_leave_end_date(date('yy-m-d'));

		$username = $this->session->userdata('user_username');

		if(isset($username)):

			$tenant_id = $this->users->get_user($username)->tenant_id;

			$active_plans = $this->users->get_sub_true_status($tenant_id);

			if(!empty($active_plans)):

				$data['active_plan'] = 1;

				if($this->users->get_user($username)->user_type == 1 || $this->users->get_user($username)->user_type == 3 || $this->users->get_user($username)->user_type == 4):

				$permission = $this->users->check_permission($username);
				$data['employee_management'] = $permission->employee_management;
				$data['notifications'] = $this->employees->get_notifications(0, $tenant_id);
				$data['payroll_management'] = $permission->payroll_management;
				$data['biometrics'] = $permission->biometrics;
				$data['user_management'] = $permission->user_management;
				$data['configuration'] = $permission->configuration;
				$data['payroll_configuration'] = $permission->payroll_configuration;
				$data['hr_configuration'] = $permission->hr_configuration;
				$data['configuration'] = $permission->configuration;
				$data['user_data'] = $this->users->get_user($username);

				$data['employees'] = $this->employees->view_employees($tenant_id);
				$data['users'] = $this->users->view_users($tenant_id);
				$data['departments'] = $this->hr_configurations->view_departments($tenant_id);
				$data['leaves'] = $this->employees->get_employees_leaves($tenant_id);

				$date = date('Y-m-d', time());
				$data['present_employees'] = $this->biometric->check_today_attendance($date);

        $data['online_users'] = $this->get_online_users($tenant_id);
        $data['total_income_month'] = $this->get_total_income_month();

        $data['total_deduction_month'] = $this->get_total_deduction_month();

        $data['total_income_year'] = $this->get_total_income_year();
        $data['total_deduction_year'] = $this->get_total_deduction_year();

        $data['pending_loans'] = $this->loans->count_pending_loans($tenant_id);
				//print_r($data['total_deduction_year']);

        $data['running_loans'] = $this->loans->count_running_loans($tenant_id);

        $data['personalized_employees'] = $this->payroll_configurations->count_personalized_employees($tenant_id);
        $data['categorized_employees'] = $this->payroll_configurations->count_categorized_employees($tenant_id);
        $data['variational_payments'] = $this->payroll_configurations->count_variational_payments($tenant_id);
        $data['is_payroll_routine_run'] = $this->is_payroll_routine_run($tenant_id);
        $data['csrf_name'] = $this->security->get_csrf_token_name();
        $data['csrf_hash'] = $this->security->get_csrf_hash();
        $data['pending_leaves'] = $this->employees->count_pending_leaves($tenant_id);
        $data['approved_leaves'] = $this->employees->count_approved_leaves($tenant_id);
        $data['finished_leaves'] = $this->employees->count_finished_leaves($tenant_id);
        $data['upcoming_leaves'] = $this->employees->get_upcoming_leaves($tenant_id);
        $data['open_queries'] = $this->employees->count_open_queries($tenant_id);
        $data['pending_trainings'] = $this->employees->count_pending_trainings($tenant_id);
        $data['running_appraisals'] = $this->employees->count_running_appraisals($tenant_id);
        $data['finished_appraisals'] = $this->employees->count_finished_appraisals($tenant_id);
        $data['hr_documents'] = $this->hr_configurations->view_hr_documents($tenant_id);
//        print_r($this->hr_configurations->view_hr_documents());


				$this->load->view('index', $data);
			elseif($this->users->get_user($username)->user_type == 2):

				redirect('employee_main');
			endif;

			else:

						if( $this->users->get_user($username)->user_type == 4):
				$data['active_plan'] = 0;

				$permission = $this->users->check_permission($username);
				$data['employee_management'] = $permission->employee_management;
				$data['notifications'] = $this->employees->get_notifications(0, $tenant_id);
				$data['payroll_management'] = $permission->payroll_management;
				$data['biometrics'] = $permission->biometrics;
				$data['user_management'] = $permission->user_management;
				$data['configuration'] = $permission->configuration;
				$data['payroll_configuration'] = $permission->payroll_configuration;
				$data['hr_configuration'] = $permission->hr_configuration;
				$data['configuration'] = $permission->configuration;
				$data['user_data'] = $this->users->get_user($username);

				$data['employees'] = $this->employees->view_employees($tenant_id);
				$data['users'] = $this->users->view_users($tenant_id);
				$data['departments'] = $this->hr_configurations->view_departments($tenant_id);
				$data['leaves'] = $this->employees->get_employees_leaves($tenant_id);

				$date = date('Y-m-d', time());
				$data['present_employees'] = $this->biometric->check_today_attendance($date);

				$data['online_users'] = $this->get_online_users($tenant_id);
				$data['total_income_month'] = $this->get_total_income_month();

				$data['total_deduction_month'] = $this->get_total_deduction_month();

				$data['total_income_year'] = $this->get_total_income_year();
				$data['total_deduction_year'] = $this->get_total_deduction_year();

				$data['pending_loans'] = $this->loans->count_pending_loans($tenant_id);
				//print_r($data['total_deduction_year']);

				$data['running_loans'] = $this->loans->count_running_loans($tenant_id);

				$data['personalized_employees'] = $this->payroll_configurations->count_personalized_employees($tenant_id);
				$data['categorized_employees'] = $this->payroll_configurations->count_categorized_employees($tenant_id);
				$data['variational_payments'] = $this->payroll_configurations->count_variational_payments($tenant_id);
				$data['is_payroll_routine_run'] = $this->is_payroll_routine_run($tenant_id);
				$data['csrf_name'] = $this->security->get_csrf_token_name();
				$data['csrf_hash'] = $this->security->get_csrf_hash();
				$data['pending_leaves'] = $this->employees->count_pending_leaves($tenant_id);
				$data['approved_leaves'] = $this->employees->count_approved_leaves($tenant_id);
				$data['finished_leaves'] = $this->employees->count_finished_leaves($tenant_id);
				$data['upcoming_leaves'] = $this->employees->get_upcoming_leaves($tenant_id);
				$data['open_queries'] = $this->employees->count_open_queries($tenant_id);
				$data['pending_trainings'] = $this->employees->count_pending_trainings($tenant_id);
				$data['running_appraisals'] = $this->employees->count_running_appraisals($tenant_id);
				$data['finished_appraisals'] = $this->employees->count_finished_appraisals($tenant_id);
				$data['hr_documents'] = $this->hr_configurations->view_hr_documents($tenant_id);
//        print_r($this->hr_configurations->view_hr_documents());


				$this->load->view('index', $data);
			else:

				redirect('subscription_expired');
			endif;





			endif;


		else:
			redirect('login');
		endif;


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
								$tenant_id = $this->users->get_user($username)->tenant_id;

								$active_plans = $this->users->get_sub_true_status($tenant_id);



								if(!empty($active_plans)):
									$id = array();
									$i = 0;

									foreach ($active_plans as $active_plan):

										$id[$i] = $active_plan->subscription_id;

										$i++;

									endforeach;

									$latest_id = min($id);

									$sub = $this->users->get_sub_details($latest_id);

									$sub_end_date = $sub->subscription_end_date;
									$sub_status = $sub->subscription_status;

									if($sub_end_date ==  date('Y-m-d') && $sub_status == 1 ):
										$subscription_array = array(
											'subscription_status' => 0
										);

											$this->users->update_subscription($sub->subscription_id, $subscription_array);


											$active_plans = $this->users->get_sub_true_status($tenant_id);

											if(!empty($active_plans)):
													$id = array();
													$i = 0;
													foreach ($active_plans as $active_plan):

														$id[$i] = $active_plan->subscription_id;

														$i++;

													endforeach;

													$latest_id = min($id);

													$sub = $this->users->get_sub_details($latest_id);


													$sub_status = $sub->subscription_status;

													if( $sub_status == 2 ):
														$subscription_array = array(
															'subscription_status' => 1
														);

														$this->users->update_subscription($sub->subscription_id, $subscription_array);
													endif;

													// sub is active

												$log_array = array(
													'log_user_id' => $this->users->get_user($username)->user_id,
													'log_description' => "Logged In"
												);

												$this->logs->add_log($log_array);




												if($this->users->get_user($username)->user_type == 1 || $this->users->get_user($username)->user_type == 3 || $this->users->get_user($username)->user_type == 4):

													redirect('home');


												elseif($this->users->get_user($username)->user_type == 2):




													$employee_id = $this->employees->get_employee_by_unique($username, $tenant_id)->employee_id;



													$trainings =  $this->employees->get_employee_training($employee_id, $tenant_id);

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
															'notification_status'=> 0,
															'tenant_id' => $tenant_id
														);

														$this->employees->insert_notifications($notification_data);
													endif;


													redirect('employee_main');
												endif;




											else:
												//no sub

													if($this->users->get_user($username)->user_type == 4):

														redirect('home');


													else:

														redirect('subscription_expired');

													endif;

												endif;


									else:
										//sub is active


										$log_array = array(
											'log_user_id' => $this->users->get_user($username)->user_id,
											'log_description' => "Logged In"
										);

										$this->logs->add_log($log_array);




										if($this->users->get_user($username)->user_type == 1 || $this->users->get_user($username)->user_type == 3 || $this->users->get_user($username)->user_type == 4):

											redirect('home');


										elseif($this->users->get_user($username)->user_type == 2):




											$employee_id = $this->employees->get_employee_by_unique($username, $tenant_id)->employee_id;



											$trainings =  $this->employees->get_employee_training($employee_id, $tenant_id);

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
													'notification_status'=> 0,
													'tenant_id'=> $tenant_id
												);

												$this->employees->insert_notifications($notification_data);
											endif;


											redirect('employee_main');
										endif;




									endif;



								else:

									// no sub

									if($this->users->get_user($username)->user_type == 4):

										redirect('home');


									else:

										redirect('subscription_expired');

									endif;

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
									$tenant_id = $this->users->get_user($username)->tenant_id;

									$active_plans = $this->users->get_sub_true_status($tenant_id);



									if(!empty($active_plans)):
										$id = array();
										$i = 0;

										foreach ($active_plans as $active_plan):

											$id[$i] = $active_plan->subscription_id;

											$i++;

										endforeach;

										$latest_id = min($id);

										$sub = $this->users->get_sub_details($latest_id);

										$sub_end_date = $sub->subscription_end_date;
										$sub_status = $sub->subscription_status;

										if($sub_end_date ==  date('Y-m-d') && $sub_status == 1 ):
											$subscription_array = array(
												'subscription_status' => 0
											);

											$this->users->update_subscription($sub->subscription_id, $subscription_array);


											$active_plans = $this->users->get_sub_true_status($tenant_id);

											if(!empty($active_plans)):
												$id = array();
												$i = 0;
												foreach ($active_plans as $active_plan):

													$id[$i] = $active_plan->subscription_id;

													$i++;

												endforeach;

												$latest_id = min($id);

												$sub = $this->users->get_sub_details($latest_id);


												$sub_status = $sub->subscription_status;

												if( $sub_status == 2 ):
													$subscription_array = array(
														'subscription_status' => 1
													);

													$this->users->update_subscription($sub->subscription_id, $subscription_array);
												endif;

												// sub is active

												$log_array = array(
													'log_user_id' => $this->users->get_user($username)->user_id,
													'log_description' => "Logged In"
												);

												$this->logs->add_log($log_array);




												if($this->users->get_user($username)->user_type == 1 || $this->users->get_user($username)->user_type == 3 || $this->users->get_user($username)->user_type == 4):

													redirect('home');


												elseif($this->users->get_user($username)->user_type == 2):




													$employee_id = $this->employees->get_employee_by_unique($username, $tenant_id)->employee_id;



													$trainings =  $this->employees->get_employee_training($employee_id, $tenant_id);

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
															'notification_status'=> 0,
															'tenant_id' => $tenant_id
														);

														$this->employees->insert_notifications($notification_data);
													endif;


													redirect('employee_main');
												endif;




											else:
												// no sub
												if($this->users->get_user($username)->user_type == 4):

													redirect('home');


												else:

													redirect('subscription_expired');

												endif;

											endif;


										else:
											//sub is active


											$log_array = array(
												'log_user_id' => $this->users->get_user($username)->user_id,
												'log_description' => "Logged In"
											);

											$this->logs->add_log($log_array);




											if($this->users->get_user($username)->user_type == 1 || $this->users->get_user($username)->user_type == 3 || $this->users->get_user($username)->user_type == 4):

												redirect('home');


											elseif($this->users->get_user($username)->user_type == 2):




												$employee_id = $this->employees->get_employee_by_unique($username, $tenant_id)->employee_id;



												$trainings =  $this->employees->get_employee_training($employee_id, $tenant_id);

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
														'notification_status'=> 0,
														'tenant_id' => $tenant_id
													);

													$this->employees->insert_notifications($notification_data);
												endif;


												redirect('employee_main');
											endif;




										endif;



									else:

										if($this->users->get_user($username)->user_type == 4):

											redirect('home');


										else:

											redirect('subscription_expired');

										endif;
										// no sub

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

						if($tenant_plan == 1):
							$userEmail= $tenant_contact_email;
							$subject='Welcome To iHumane - Interactive Human Resource Management System';
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

							$data = array(
								'name' => $tenant_contact_name,
								'login' => 'https://app.ihumane.net/login',
								'username' => $tenant_username,
								'plan_duration' => $plan->plan_duration,
								'start_date' => date('Y-m-d'),
								'end_date' => $end_date
							);

							$body = $this->load->view('emails/free_trial_plan',$data,TRUE);
							$this->email->message($body);
							$this->email->send();


							$this->email->set_newline("\r\n");

							$this->email->from('support@ihumane.net', 'iHumane');

							$this->email->to('support@ihumane.net');  // replace it with receiver mail id
							$this->email->subject('New Customer on iHumane - Interactive Human Resource Management System'); // replace it with relevant subject

							$data = array(
								'username' => $tenant_username,
								'name' => $tenant_contact_name,
								'login' => 'https://app.ihumane.net/login',
								'plan_duration' => $plan->plan_duration,
								'start_date' => date('Y-m-d'),
								'end_date' => $end_date,
								'customer_email' => $userEmail,
								'tenant_business_name' => $tenant_business_name,
								'tenant_business_website' => $tenant_business_website,
								'tenant_contact_phone' => $tenant_contact_phone
							);

							$body = $this->load->view('emails/new_customer-free',$data,TRUE);
							$this->email->message($body);
							$this->email->send();

						endif;


					if($tenant_plan > 1):
						$userEmail= $tenant_contact_email;
						$subject='Welcome To iHumane - Interactive Human Resource Management System';
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

						$data = array(
							'name' => $tenant_contact_name,
							'login' => 'https://app.ihumane.net/login',
							'username' => $tenant_username,
							'plan_name' => $plan->plan_name,
							'plan_duration' => $plan->plan_duration,
							'start_date' => date('Y-m-d'),
							'end_date' => $end_date
						);

						$body = $this->load->view('emails/main_plan',$data,TRUE);
						$this->email->message($body);
						$this->email->send();



						$this->email->set_newline("\r\n");

						$this->email->from('support@ihumane.net', 'iHumane');

						$this->email->to('support@ihumane.net');  // replace it with receiver mail id
						$this->email->subject('New Customer on iHumane - Interactive Human Resource Management System'); // replace it with relevant subject

						$data = array(
							'username' => $tenant_username,
							'name' => $tenant_contact_name,
							'login' => 'https://app.ihumane.net/login',
							'plan_name' => $plan->plan_name,
							'plan_duration' => $plan->plan_duration,
							'start_date' => date('Y-m-d'),
							'end_date' => $end_date,
							'customer_email' => $userEmail,
							'tenant_business_name' => $tenant_business_name,
							'tenant_business_website' => $tenant_business_website,
							'tenant_contact_phone' => $tenant_contact_phone
						);

						$body = $this->load->view('emails/new_customer-plan',$data,TRUE);
						$this->email->message($body);
						$this->email->send();



					endif;


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

	public function new_subscription_a(){

		$method = $this->input->server('REQUEST_METHOD');
		if($method == 'POST' || $method == 'Post' || $method == 'post'):

			extract($_POST);

		$active_plans = $this->users->get_sub_true_status($tenant_id);

		if(!empty($active_plans)):
			$id = array();
			$i = 0;

			foreach ($active_plans as $active_plan):

				$id[$i] = $active_plan->subscription_id;

				$i++;

				endforeach;

				$latest_id = max($id);

				$plan = $this->backoffices->get_plan($plan_id);

				$old_sub = $this->users->get_sub_details($latest_id);

				$start_date = $old_sub->subscription_end_date;

				$duration = $plan->plan_duration;

				$end_date = $end_date =  date('Y-m-d', strtotime($start_date. ' + '.$duration. 'days'));

			$subscription_array = array(

				'subscription_tenant_id'=> $tenant_id,
				'subscription_plan_id' => $plan_id,
				'subscription_start_date' => $start_date,
				'subscription_end_date' => $end_date,
				'subscription_reference_code' => $reference,
				'subscription_status' => 2
			);

			$subscription_array = $this->security->xss_clean($subscription_array);

			$query = $this->users->new_subscription($subscription_array);

			$tenant_details = $this->backoffices->get_tenant($tenant_id);

					$userEmail= $tenant_details->tenant_contact_email;
					$subject='New Subscription On iHumane - Interactive Human Resource Management System';
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

					$data = array(
						'username' => $tenant_details->tenant_username,
						'name' => $tenant_details->tenant_contact_name,
						'login' => 'https://app.ihumane.net/login',
						'plan_name' => $plan->plan_name,
						'plan_duration' => $plan->plan_duration,
						'start_date' => $start_date,
						'end_date' => $end_date
					);

					$body = $this->load->view('emails/new_subscription',$data,TRUE);
					$this->email->message($body);
					$this->email->send();

					$this->email->set_newline("\r\n");

					$this->email->from('support@ihumane.net', 'iHumane');

					$this->email->to('support@ihumane.net');  // replace it with receiver mail id
					$this->email->subject($subject); // replace it with relevant subject

					$data = array(
						'username' => $tenant_details->tenant_username,
						'name' => $tenant_details->tenant_contact_name,
						'login' => 'https://app.ihumane.net/login',
						'plan_name' => $plan->plan_name,
						'plan_duration' => $plan->plan_duration,
						'start_date' => date('Y-m-d'),
						'end_date' => $end_date,
						'customer_email' => $userEmail
					);

					$body = $this->load->view('emails/new_subscription-admin',$data,TRUE);
					$this->email->message($body);
					$this->email->send();





			else:
				$plan = $this->backoffices->get_plan($plan_id);

				$duration = $plan->plan_duration;
				$Date = date('Y-m-d');
				$end_date =  date('Y-m-d', strtotime($Date. ' + '.$duration. 'days'));



				$subscription_array = array(

					'subscription_tenant_id'=> $tenant_id,
					'subscription_plan_id' => $plan_id,
					'subscription_start_date' => date('Y-m-d'),
					'subscription_end_date' => $end_date,
					'subscription_reference_code' => $reference,
					'subscription_status' => 1
				);

				$subscription_array = $this->security->xss_clean($subscription_array);

				$query = $this->users->new_subscription($subscription_array);


				$tenant_details = $this->backoffices->get_tenant($tenant_id);

				$userEmail= $tenant_details->tenant_contact_email;
				$subject='New Subscription On iHumane - Interactive Human Resource Management System';
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

				$data = array(
					'username' => $tenant_details->tenant_username,
					'name' => $tenant_details->tenant_contact_name,
					'login' => 'https://app.ihumane.net/login',
					'plan_name' => $plan->plan_name,
					'plan_duration' => $plan->plan_duration,
					'start_date' => date('Y-m-d'),
					'end_date' => $end_date
				);

				$body = $this->load->view('emails/new_subscription',$data,TRUE);
				$this->email->message($body);
				$this->email->send();



				$this->email->set_newline("\r\n");

				$this->email->from('support@ihumane.net', 'iHumane');

				$this->email->to('support@ihumane.net');  // replace it with receiver mail id
				$this->email->subject($subject); // replace it with relevant subject

				$data = array(
					'username' => $tenant_details->tenant_username,
					'name' => $tenant_details->tenant_contact_name,
					'login' => 'https://app.ihumane.net/login',
					'plan_name' => $plan->plan_name,
					'plan_duration' => $plan->plan_duration,
					'start_date' => date('Y-m-d'),
					'end_date' => $end_date,
					'customer_email' => $userEmail
				);

				$body = $this->load->view('emails/new_subscription-admin',$data,TRUE);
				$this->email->message($body);
				$this->email->send();
		endif;


		else:
			redirect('error_404');

			endif;

	}

	public function check_user_username(){

		$username = $this->input->post('username');
		echo json_encode($this->users->check_existing_user_username($username));
	}



	public function check_user_email(){
		$email = $this->input->post('email');
		echo json_encode($this->users->check_existing_user_email($email));

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

	public function subscription_expired(){
		$this->load->view('auth/subscription_expired');
		$user_username = $this->session->userdata('user_username');

		if(isset($user_username)):




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

	public function get_online_users($tenant_id) {
		$online_users = $this->users->view_online_users($tenant_id);
		foreach ($online_users as $key => $user) {
			if ($user->user_token == '' || ((time() - $user->user_token) / 60) > 120){
				unset($online_users[$key]);
			}
		}
		return $online_users;
	}

	public function timestamp(){
    date_default_timezone_set('Africa/Lagos');
    echo $timestamp = date('D j M, Y g:i:s a');
  }

  public function get_income_statistics() {
	  $username = $this->session->userdata('user_username');
	  $tenant_id = $this->users->get_user($username)->tenant_id;
    $income_payments = $this->payroll_configurations->get_income_payments($tenant_id);
    $income_payments_id = array();
    foreach ($income_payments as $income_payment) {
      $income_payments_id[] = $income_payment->payment_definition_id;
    }
    echo $income_salaries = json_encode($this->salaries->get_salaries_by_payment_id($income_payments_id, $tenant_id));
  }

  public function get_deduction_statistics() {
	  $username = $this->session->userdata('user_username');
	  $tenant_id = $this->users->get_user($username)->tenant_id;
	  $deduction_payments = $this->payroll_configurations->get_deduction_payments($tenant_id);

	  $deduction_payments_id = array();
	  foreach ($deduction_payments as $deduction_payment) {
      $deduction_payments_id[] = $deduction_payment->payment_definition_id;
    }
	  echo $deduction_salaries = json_encode($this->salaries->get_salaries_by_payment_id($deduction_payments_id, $tenant_id));
  }

  public function get_total_income_month(){
	  $username = $this->session->userdata('user_username');
	  $tenant_id = $this->users->get_user($username)->tenant_id;
    $income_payments = $this->payroll_configurations->get_income_payments($tenant_id);
	  if(!empty($income_payments)):
    $income_payments_id = array();
    foreach ($income_payments as $income_payment) {
      $income_payments_id[] = $income_payment->payment_definition_id;
    }
    $salaries_current_month = $this->salaries->get_salaries_current_month($income_payments_id, $tenant_id);
    $sum = 0;
    foreach($salaries_current_month as $salary_current_month) {
      $sum += $salary_current_month->salary_amount;
    }
    return $sum;

    else:
		$sum = 0;
    	return $sum;

		endif;
  }

  public function get_total_income_year(){
	  $username = $this->session->userdata('user_username');
	  $tenant_id = $this->users->get_user($username)->tenant_id;
    $income_payments = $this->payroll_configurations->get_income_payments($tenant_id);
	  if(!empty($income_payments)):
    $income_payments_id = array();
    foreach ($income_payments as $income_payment) {
      $income_payments_id[] = $income_payment->payment_definition_id;
    }
    $salaries_current_year = $this->salaries->get_salaries_current_year($income_payments_id, $tenant_id);
    $sum = 0;
    foreach($salaries_current_year as $salary_current_year) {
      $sum += $salary_current_year->salary_amount;
    }
    return $sum;
    else:
		$sum = 0;
    return $sum;
		endif;
  }

  public function get_total_deduction_month(){
	  $username = $this->session->userdata('user_username');
	  $tenant_id = $this->users->get_user($username)->tenant_id;
    $deduction_payments = $this->payroll_configurations->get_deduction_payments($tenant_id);
   if(!empty($deduction_payments)):
    $deduction_payments_id = array();
    foreach ($deduction_payments as $deduction_payment) {
      $deduction_payments_id[] = $deduction_payment->payment_definition_id;
    }
    $salaries_current_month = $this->salaries->get_salaries_current_month($deduction_payments_id, $tenant_id);
    $sum = 0;
    foreach($salaries_current_month as $salary_current_month) {
      $sum += $salary_current_month->salary_amount;
    }
    return $sum;
    else:
		$sum = 0;
    	return  $sum;
		endif;
  }

  public function get_total_deduction_year(){
	  $username = $this->session->userdata('user_username');
	  $tenant_id = $this->users->get_user($username)->tenant_id;
    $deduction_payments = $this->payroll_configurations->get_deduction_payments($tenant_id);
	  if(!empty($deduction_payments)):
    $deduction_payments_id = array();
    foreach ($deduction_payments as $deduction_payment) {
      $deduction_payments_id[] = $deduction_payment->payment_definition_id;
    }
    $salaries_current_year = $this->salaries->get_salaries_current_year($deduction_payments_id, $tenant_id);
    $sum = 0;
    foreach($salaries_current_year as $salary_current_year) {
      $sum += $salary_current_year->salary_amount;
    }
    return $sum;
    else:
		$sum = 0;

    	return  $sum;
		endif;
  }

  public function is_payroll_routine_run($tenant_id){
	  $current_month = date('m');
	  $current_year = date('Y');
    $salaries = $this->salaries->view_salaries($tenant_id);
    foreach ($salaries as $salary):
      if(($salary->salary_pay_month == $current_month) && ($salary->salary_pay_year == $current_year)):
        return true;
      endif;
    endforeach;
    return false;
  }


	public function forgot_password(){

		$username = $this->session->userdata('user_username');

		if(isset($username)):

			redirect('home');
		else:
			$data['csrf_name'] = $this->security->get_csrf_token_name();
			$data['csrf_hash'] = $this->security->get_csrf_hash();

			$this->load->view('auth/forgot_password', $data);

		endif;
	}

	public function forgot_password_action(){

		$method = $this->input->server('REQUEST_METHOD');


		if($method == 'POST' || $method == 'Post' || $method == 'post'):

			extract($_POST);

			$details = $this->users->get_user_email($official_email);

			if(!empty($details)):

				$token = random_string('alnum', 4);


				$token_array = array(
					'password_reset_user_name' => $details->user_username,
					'password_reset_token' => $token,
					'password_reset_time' => date("Y-m-d H:i:s"),
				);

				$query = $this->users->insert_token($token_array);
				//$query = true;

				if($query == true):

					$dat = array(
						'password_token'=>$token,

					);
					$this->session->set_userdata($dat);


					$subject='Token For Password Reset On iHumane - Interactive Human Resource Management System';
					$config = Array(
						'mailtype' => 'html',
						'charset' => 'utf-8',
						'priority' => '1'
					);
					$this->load->library('email', $config);
					$this->email->set_newline("\r\n");

					$this->email->from('support@ihumane.net', 'iHumane');

					$this->email->to($official_email);  // replace it with receiver mail id
					$this->email->subject($subject); // replace it with relevant subject

					$data = array(
						'token' => $token,
						'name' => $details->user_name,
						'email' => $official_email

					);

					$body = $this->load->view('emails/password_reset',$data,TRUE);
					$this->email->message($body);
					$this->email->send();

					$data['csrf_name'] = $this->security->get_csrf_token_name();
					$data['csrf_hash'] = $this->security->get_csrf_hash();
					$this->load->view('auth/token', $data);

				else:

					$msg = array(
						'msg'=> 'Account Could Not be Found',
						'location' => site_url('forgot_password'),
						'type' => 'error'

					);
					$this->load->view('swal', $msg);

				endif;


			else:

				$msg = array(
					'msg'=> 'Account Could Not be Found',
					'location' => site_url('forgot_password'),
					'type' => 'error'

				);
				$this->load->view('swal', $msg);

			endif;



		else:

			redirect('error_404');

		endif;
	}

	public function reset_password(){

		$method = $this->input->server('REQUEST_METHOD');


		if($method == 'POST' || $method == 'Post' || $method == 'post'):

			extract($_POST);

			$details = $this->users->get_user_email($official_email);

			$password_resets = $this->users->get_token($details->user_username);

			$trials = count($password_resets);

			$token = $password_resets[$trials - 1]->password_reset_token;
			$date = $password_resets[$trials - 1]->password_reset_time;

			$start_date = new DateTime($date);
			$time_diff = $start_date->diff(new DateTime(date("Y-m-d H:i:s")));

			if($time_diff->i > 10):


				$msg = array(
					'msg'=> 'Token Has Expired',
					'location' => site_url('forgot_password'),
					'type' => 'error'

				);
				$this->load->view('swal', $msg);

			else:

				if($token == $entered_token):

					$new_password = random_string('alnum', 8);

					$user_array = array(

						'user_password'=> password_hash($new_password, PASSWORD_BCRYPT),

					);

					$query_user = $this->users->update_user($details->user_id, $user_array);

					if($query_user == true):

						$subject='New Password For iHumane - Interactive Human Resource Management System';
						$config = Array(
							'mailtype' => 'html',
							'charset' => 'utf-8',
							'priority' => '1'
						);
						$this->load->library('email', $config);
						$this->email->set_newline("\r\n");

						$this->email->from('support@ihumane.net', 'iHumane');

						$this->email->to($official_email);  // replace it with receiver mail id
						$this->email->subject($subject); // replace it with relevant subject

						$data = array(

							'name' => $details->user_name,
							'password' => $new_password

						);

						$body = $this->load->view('emails/new_password',$data,TRUE);
						$this->email->message($body);
						$this->email->send();
						$msg = array(
							'msg'=> 'Password Reset Successfully, Check your Email.',
							'location' => site_url('login'),
							'type' => 'success'

						);
						$this->load->view('swal', $msg);

					else:
						$msg = array(
							'msg'=> 'An Error Occurred',
							'location' => site_url('login'),
							'type' => 'error'

						);
						$this->load->view('swal', $msg);

					endif;


				else:
					$msg = array(
						'msg'=> 'Token Doesnt Match',
						'location' => site_url('forgot_password'),
						'type' => 'error'

					);
					$this->load->view('swal', $msg);


				endif;



			endif;








		else:

			redirect('error_404');

		endif;


	}



	public function test_email(){
		$userEmail='peterejiro96@gmail.com';
        $subject='Test';
        $config = Array(
			'mailtype' => 'html',
			'charset' => 'utf-8',
			'priority' => '1'
		);
        $this->load->library('email', $config);
    $this->email->set_newline("\r\n");

        $this->email->from('noreply@ihumane.net', 'iHumane');

        $this->email->to($userEmail);  // replace it with receiver mail id
    $this->email->subject($subject); // replace it with relevant subject

		$data = array(
		'lol' => 'lol'
		);

        $body = $this->load->view('emails/free_trial_plan',$data,TRUE);
    $this->email->message($body);
        $this->email->send();
    }
}
