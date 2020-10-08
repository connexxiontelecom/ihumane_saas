<?php


class App_configuration extends CI_Controller
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
		$this->load->model('users');
		$this->load->model('configurations');
	}


	public function index(){

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

					if($permission->configuration == 1):

						$data['user_data'] = $this->users->get_user($username);

						$data['configurations'] = $this->configurations->view_config($tenant_id);

						$data['tenant_data'] = $this->users->get_tenant($tenant_id);
						$data['csrf_name'] = $this->security->get_csrf_token_name();
						$data['csrf_hash'] = $this->security->get_csrf_hash();

						//print_r($data['configurations']);

						$this->load->view('config/config', $data);

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

	public function new_options()
	{
		//error_reporting(0);
		$username = $this->session->userdata('user_username');

		if (isset($username)):
			$method = $this->input->server('REQUEST_METHOD');
$data['active_plan'] = 1; 

			if($method == 'POST' || $method == 'Post' || $method == 'post'):

				$tenant_id = $this->users->get_user($username)->tenant_id;
				$permission = $this->users->check_permission($username);
				$data['employee_management'] = $permission->employee_management;
				$data['payroll_management'] = $permission->payroll_management;
				$data['biometrics'] = $permission->biometrics;
				$data['user_management'] = $permission->user_management;
				$data['configuration'] = $permission->configuration;
				$data['payroll_configuration'] = $permission->payroll_configuration;
				$data['hr_configuration'] = $permission->hr_configuration;
				$data['notifications'] = $this->employees->get_notifications(0, $tenant_id);
				if ($permission->configuration == 1):
					$config['upload_path'] = 'uploads/config';
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$config['max_size'] = '8000000';
					$config['max_width'] = '102452';
					$config['max_height'] = '768555';
					//$config['overwrite'] = TRUE;
					$config['encrypt_name'] = TRUE;

					$this->load->library('upload', $config);
					$upload = $this->upload->do_upload('company_logo');

					if (!$upload):
						echo $this->upload->display_errors();
						die();
					else:
						$file_data = $this->upload->data();
						$company_logo_name = $file_data['file_name'];
					endif;


					$config2['upload_path'] = 'uploads/config';
					$config2['allowed_types'] = 'gif|jpg|png|pdf|jpeg';
					$config2['max_size'] = '8000000';
					$config2['max_width'] = '102452';
					$config2['max_height'] = '768555';
					//$config2['overwrite'] = TRUE;
					$config2['encrypt_name'] = TRUE;

					$this->upload->initialize($config2);
					$upload = $this->upload->do_upload('md_signature');

					if (!$upload):


					echo $this->upload->display_errors();
					die();
					else:
						$file_data = $this->upload->data();
						$md_signature_name = $file_data['file_name'];
					endif;


					$config3['upload_path'] = 'uploads/config';
					$config3['allowed_types'] = 'gif|jpg|png|pdf|jpeg';
					$config3['max_size'] = '8000000';
					$config3['max_width'] = '102452';
					$config3['max_height'] = '768555';
					//$config2['overwrite'] = TRUE;
					$config3['encrypt_name'] = TRUE;

					$this->upload->initialize($config3);
					$upload = $this->upload->do_upload('accountant_signature');

					if (!$upload):


						echo $this->upload->display_errors();
						die();
					else:
						$file_data = $this->upload->data();
						$accountant_signature_name = $file_data['file_name'];
					endif;


					$config4['upload_path'] = 'uploads/config';
					$config4['allowed_types'] = 'gif|jpg|png|pdf|jpeg';
					$config4['max_size'] = '8000000';
					$config4['max_width'] = '102452';
					$config4['max_height'] = '768555';
					//$config2['overwrite'] = TRUE;
					$config4['encrypt_name'] = TRUE;

					$this->upload->initialize($config4);
					$upload = $this->upload->do_upload('hr_signature');

					if (!$upload):


						echo $this->upload->display_errors();
						die();
					else:
						$file_data = $this->upload->data();
						$hr_signature_name = $file_data['file_name'];
					endif;

					$company_name = $this->input->post('company_name');
					$company_address = $this->input->post('company_address');



					$config_array = array(
						'configuration_company' => $company_name,
						'configuration_address' => $company_address,
						'configuration_logo' => $company_logo_name,
						'configuration_hr' => $hr_signature_name,
						'configuration_acc' => $accountant_signature_name,
						'configuration_md' => $md_signature_name,
						'tenant_id' => $tenant_id
					);

					$config_array = $this->security->xss_clean($config_array);

					$query = $this->configurations->insert_config($config_array);



					if ($query == true):
						$log_array = array(
							'tenant_id' => $tenant_id,
							'log_user_id' => $this->users->get_user($username)->user_id,
							'log_description' => "Set New Options",

						);

						$this->logs->add_log($log_array);


						$msg = array(
							'msg' => 'Options Set Successfully',
							'location' => site_url('app_configuration'),
							'type' => 'success'

						);
						$this->load->view('swal', $msg);
					else:
						$msg = array(
							'msg' => 'An Error Occurred',
							'location' => site_url('new_employee'),
							'type' => 'success'

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

	public function update_options()
	{
		//error_reporting(0);
		$username = $this->session->userdata('user_username');

		if (isset($username)):
			$method = $this->input->server('REQUEST_METHOD');
$data['active_plan'] = 1; 

			if($method == 'POST' || $method == 'Post' || $method == 'post'):

				$tenant_id = $this->users->get_user($username)->tenant_id;
				$permission = $this->users->check_permission($username);
				$data['employee_management'] = $permission->employee_management;
				$data['payroll_management'] = $permission->payroll_management;
				$data['biometrics'] = $permission->biometrics;
				$data['user_management'] = $permission->user_management;
				$data['configuration'] = $permission->configuration;
				$data['payroll_configuration'] = $permission->payroll_configuration;
				$data['hr_configuration'] = $permission->hr_configuration;
				$data['notifications'] = $this->employees->get_notifications(0, $tenant_id);
				$configurations = $this->configurations->view_config($tenant_id);
				if ($permission->configuration == 1):

					$config['upload_path'] = 'uploads/config';
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$config['max_size'] = '8000000';
					$config['max_width'] = '102452';
					$config['max_height'] = '768555';
					//$config['overwrite'] = TRUE;
					$config['encrypt_name'] = TRUE;

					$this->load->library('upload', $config);
					$upload = $this->upload->do_upload('company_logo');

					if (!$upload):
						$company_logo_name = $configurations->configuration_logo ;
					else:
						$file_data = $this->upload->data();
						$company_logo_name = $file_data['file_name'];
					endif;


					$config2['upload_path'] = 'uploads/config';
					$config2['allowed_types'] = 'gif|jpg|png|pdf|jpeg';
					$config2['max_size'] = '8000000';
					$config2['max_width'] = '102452';
					$config2['max_height'] = '768555';
					//$config2['overwrite'] = TRUE;
					$config2['encrypt_name'] = TRUE;

					$this->upload->initialize($config2);
					$upload = $this->upload->do_upload('md_signature');

					if (!$upload):

					$md_signature_name = $configurations->configuration_md;
					else:
						$file_data = $this->upload->data();
						$md_signature_name = $file_data['file_name'];
					endif;


					$config3['upload_path'] = 'uploads/config';
					$config3['allowed_types'] = 'gif|jpg|png|pdf|jpeg';
					$config3['max_size'] = '8000000';
					$config3['max_width'] = '102452';
					$config3['max_height'] = '768555';
					//$config2['overwrite'] = TRUE;
					$config3['encrypt_name'] = TRUE;

					$this->upload->initialize($config3);
					$upload = $this->upload->do_upload('accountant_signature');

					if (!$upload):


						$accountant_signature_name = $configurations->configuration_acc;
					else:
						$file_data = $this->upload->data();
						$accountant_signature_name = $file_data['file_name'];
					endif;


					$config4['upload_path'] = 'uploads/config';
					$config4['allowed_types'] = 'gif|jpg|png|pdf|jpeg';
					$config4['max_size'] = '8000000';
					$config4['max_width'] = '102452';
					$config4['max_height'] = '768555';
					//$config2['overwrite'] = TRUE;
					$config4['encrypt_name'] = TRUE;

					$this->upload->initialize($config4);
					$upload = $this->upload->do_upload('hr_signature');

					if (!$upload):


						$hr_signature_name = $configurations->configuration_hr;
					else:
						$file_data = $this->upload->data();
						$hr_signature_name = $file_data['file_name'];
					endif;

					$company_name = $this->input->post('company_name');
					$company_address = $this->input->post('company_address');



					$config_array = array(
						'configuration_company' => $company_name,
						'configuration_address' => $company_address,
						'configuration_logo' => $company_logo_name,
						'configuration_hr' => $hr_signature_name,
						'configuration_acc' => $accountant_signature_name,
						'configuration_md' => $md_signature_name,
						'tenant_id' => $tenant_id
					);

					$config_array = $this->security->xss_clean($config_array);

					$query = $this->configurations->update_configuration($configurations->configuration_id,$config_array);



					if ($query == true):
						$log_array = array(
							'tenant_id' => $tenant_id,
							'log_user_id' => $this->users->get_user($username)->user_id,
							'log_description' => "Updated Base Configuration",

						);

						$this->logs->add_log($log_array);


						$msg = array(
							'msg' => 'Options Updated Successfully',
							'location' => site_url('app_configuration'),
							'type' => 'success'

						);
						$this->load->view('swal', $msg);
					else:
						$msg = array(
							'msg' => 'An Error Occurred',
							'location' => site_url('app_configuration'),
							'type' => 'success'

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

}
