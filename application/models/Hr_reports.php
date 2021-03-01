<?php
	
	
	class Hr_reports extends CI_Model
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->database();
			$this->load->library('form_validation');
			$this->load->library('session');
			
		}
		
		public function get_top_performer_all($from_date, $to_date, $tenant_id){
			$this->db->select('*');
			$this->db->from('employee_appraisal');
			$this->db->join('employee', 'employee.employee_id = employee_appraisal.employee_appraisal_employee_id');
			$this->db->join('job_role', 'job_role.job_role_id = employee.employee_job_role_id');
			$this->db->join('department', 'department.department_id = job_role.department_id');
			$this->db->join('subsidiary', 'subsidiary.subsidiary_id = employee.employee_subsidiary_id');
			$this->db->where('employee_appraisal.employee_appraisal_period_from >=', $from_date);
			$this->db->where('employee_appraisal.employee_appraisal_period_from <=', $to_date);
			$this->db->where('employee_appraisal.employee_appraisal_status', 1);
			$this->db->where('employee_appraisal.tenant_id', $tenant_id);
			return $this->db->get()->result();
		}
		
		public function get_top_performer_job_role($from_date, $to_date, $job_role, $tenant_id){
			$this->db->select('*');
			$this->db->from('employee_appraisal');
			$this->db->join('employee', 'employee.employee_id = employee_appraisal.employee_appraisal_employee_id');
			$this->db->join('job_role', 'job_role.job_role_id = employee.employee_job_role_id');
			$this->db->join('department', 'department.department_id = job_role.department_id');
			$this->db->join('subsidiary', 'subsidiary.subsidiary_id = employee.employee_subsidiary_id');
			$this->db->where('employee_appraisal.employee_appraisal_period_from >=', $from_date);
			$this->db->where('employee_appraisal.employee_appraisal_period_from <=', $to_date);
			$this->db->where('employee_appraisal.employee_appraisal_status', 1);
			$this->db->where('employee.employee_job_role_id', $job_role);
			$this->db->where('employee_appraisal.tenant_id', $tenant_id);
			return $this->db->get()->result();
		}
		
		public function get_top_performer_subsidiary($from_date, $to_date, $subsidiary, $tenant_id){
			$this->db->select('*');
			$this->db->from('employee_appraisal');
			$this->db->join('employee', 'employee.employee_id = employee_appraisal.employee_appraisal_employee_id');
			$this->db->join('job_role', 'job_role.job_role_id = employee.employee_job_role_id');
			$this->db->join('department', 'department.department_id = job_role.department_id');
			$this->db->join('subsidiary', 'subsidiary.subsidiary_id = employee.employee_subsidiary_id');
			$this->db->where('employee_appraisal.employee_appraisal_period_from >=', $from_date);
			$this->db->where('employee_appraisal.employee_appraisal_period_from <=', $to_date);
			$this->db->where('employee_appraisal.employee_appraisal_status', 1);
			$this->db->where('employee.employee_subsidiary_id', $subsidiary);
			$this->db->where('employee_appraisal.tenant_id', $tenant_id);
			return $this->db->get()->result();
		}
		
		public function get_top_performer_al($from_date, $to_date, $job_role, $subsidiary, $tenant_id){
			$this->db->select('*');
			$this->db->from('employee_appraisal');
			$this->db->join('employee', 'employee.employee_id = employee_appraisal.employee_appraisal_employee_id');
			$this->db->join('job_role', 'job_role.job_role_id = employee.employee_job_role_id');
			$this->db->join('department', 'department.department_id = job_role.department_id');
			$this->db->join('subsidiary', 'subsidiary.subsidiary_id = employee.employee_subsidiary_id');
			$this->db->where('employee_appraisal.employee_appraisal_period_from >=', $from_date);
			$this->db->where('employee_appraisal.employee_appraisal_period_from <=', $to_date);
			$this->db->where('employee_appraisal.employee_appraisal_status', 1);
			$this->db->where('employee.employee_job_role_id', $job_role);
			$this->db->where('employee.employee_subsidiary_id', $subsidiary);
			$this->db->where('employee_appraisal.tenant_id', $tenant_id);
			return $this->db->get()->result();
		}
		
		
		
		public function get_new_hire_all($from_date, $to_date, $tenant_id){
			$this->db->select('*');
			$this->db->from('employee');
			$this->db->join('employee', 'employee.employee_id = employee_appraisal.employee_appraisal_employee_id');
			$this->db->join('job_role', 'job_role.job_role_id = employee.employee_job_role_id');
			$this->db->join('department', 'department.department_id = job_role.department_id');
			$this->db->join('subsidiary', 'subsidiary.subsidiary_id = employee.employee_subsidiary_id');
			$this->db->where('employee.employee_employment_date >=', $from_date);
			$this->db->where('employee.employee_employment_date <=', $to_date);
			$this->db->where('employee.tenant_id', $tenant_id);
			return $this->db->get()->result();
		}
		
		public function get_new_hire_job_role($from_date, $to_date, $job_role, $tenant_id){
			$this->db->select('*');
			$this->db->from('employee');
			$this->db->join('job_role', 'job_role.job_role_id = employee.employee_job_role_id');
			$this->db->join('department', 'department.department_id = job_role.department_id');
			$this->db->join('subsidiary', 'subsidiary.subsidiary_id = employee.employee_subsidiary_id');
			$this->db->where('employee.employee_employment_date >=', $from_date);
			$this->db->where('employee.employee_employment_date <=', $to_date);
			$this->db->where('employee.employee_job_role_id', $job_role);
			$this->db->where('employee.tenant_id', $tenant_id);
			return $this->db->get()->result();
		}
		
		
		public function get_new_hire_subsidiary($from_date, $to_date, $subsidiary, $tenant_id){
			$this->db->from('employee');
			$this->db->join('job_role', 'job_role.job_role_id = employee.employee_job_role_id');
			$this->db->join('job_role', 'job_role.job_role_id = employee.employee_job_role_id');
			$this->db->join('department', 'department.department_id = job_role.department_id');
			$this->db->join('subsidiary', 'subsidiary.subsidiary_id = employee.employee_subsidiary_id');
			$this->db->where('employee.employee_employment_date >=', $from_date);
			$this->db->where('employee.employee_employment_date <=', $to_date);
			$this->db->where('employee.employee_subsidiary_id', $subsidiary);
			$this->db->where('employee.tenant_id', $tenant_id);
			return $this->db->get()->result();
		}
		
		public function get_new_hire_al($from_date, $to_date, $job_role, $subsidiary, $tenant_id){
			$this->db->from('employee');
			$this->db->join('job_role', 'job_role.job_role_id = employee.employee_job_role_id');
			$this->db->join('job_role', 'job_role.job_role_id = employee.employee_job_role_id');
			$this->db->join('department', 'department.department_id = job_role.department_id');
			$this->db->join('subsidiary', 'subsidiary.subsidiary_id = employee.employee_subsidiary_id');
			$this->db->where('employee.employee_employment_date >=', $from_date);
			$this->db->where('employee.employee_employment_date <=', $to_date);
			$this->db->where('employee.employee_job_role_id', $job_role);
			$this->db->where('employee.employee_subsidiary_id', $subsidiary);
			$this->db->where('employee.tenant_id', $tenant_id);
			return $this->db->get()->result();
			
		}
		
		public function get_employee_year($tenant_id){
			$this->db->from('employee');
			$this->db->group_by('year(employee_employment_date)');
			$this->db->where('employee.tenant_id', $tenant_id);
			return $this->db->get()->result();
			
		}
		
		public function employee_before_year($year, $tenant_id){
			
			$this->db->from('employee');
			$this->db->join('job_role', 'job_role.job_role_id = employee.employee_job_role_id');
			$this->db->join('department', 'department.department_id = job_role.department_id');
			$this->db->join('subsidiary', 'subsidiary.subsidiary_id = employee.employee_subsidiary_id');
			$this->db->where('year(employee.employee_employment_date) <', $year);
			$this->db->where('employee.employee_status !=', 0);
			$this->db->where('employee.employee_status !=', 3);
			$this->db->where('employee.tenant_id', $tenant_id);
			return $this->db->get()->result();
		}
		
		public function employee_after_year($year, $tenant_id){
			$this->db->from('employee');
			$this->db->join('job_role', 'job_role.job_role_id = employee.employee_job_role_id');
			$this->db->join('department', 'department.department_id = job_role.department_id');
			$this->db->join('subsidiary', 'subsidiary.subsidiary_id = employee.employee_subsidiary_id');
			$this->db->where('year(employee.employee_employment_date) <=', $year);
			$this->db->where('employee.employee_status !=', 0);
			$this->db->where('employee.employee_status !=', 3);
			$this->db->where('employee.tenant_id', $tenant_id);
			return $this->db->get()->result();
		}
		
		public function employee_exit_year($year, $tenant_id){
			$this->db->from('employee');
			$this->db->join('job_role', 'job_role.job_role_id = employee.employee_job_role_id');
			$this->db->join('department', 'department.department_id = job_role.department_id');
			$this->db->join('subsidiary', 'subsidiary.subsidiary_id = employee.employee_subsidiary_id');
			$this->db->where('year(employee.employee_stop_date)', $year);
			$this->db->where('employee.employee_status !=', 1);
			$this->db->where('employee.employee_status !=', 2);
			$this->db->where('employee.tenant_id', $tenant_id);
			return $this->db->get()->result();
		}
	}
