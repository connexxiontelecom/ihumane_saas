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

	}

	public function index(){

		$this->employees->check_leave_end_date(date('yy-m-d'));

		$username = $this->session->userdata('user_username');

		if(isset($username)):



			if($this->users->get_user($username)->user_type == 1 || $this->users->get_user($username)->user_type == 3):

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
								if($this->users->get_user($username)->user_type == 1 || $this->users->get_user($username)->user_type == 3):

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
									if($this->users->get_user($username)->user_type == 1 || $this->users->get_user($username)->user_type == 3):

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
		$this->employees->check_leave_end_date(date('yy-m-d'));

		$user_username = $this->session->userdata('user_username');



		if(isset($user_username)):
			redirect('home');
		else:
			$data['csrf_name'] = $this->security->get_csrf_token_name();
			$data['csrf_hash'] = $this->security->get_csrf_hash();
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

	public function timestamp(){
    date_default_timezone_set('Africa/Lagos');
    echo $timestamp = date('F j, Y g:i:s a');
  }


}
