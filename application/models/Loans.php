<?php


class Loans extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('form_validation');
		$this->load->library('session');

	}

	// Loan Setup begin
	public function add_loan($loan_data){

		$this->db->insert('loans', $loan_data);
		return true;
	}

	public function update_loan($loan_id, $loan_data){

		$this->db->where('loans.loan_id', $loan_id);
		$this->db->update('loans', $loan_data);
		return true;


	}

	public function view_loans(){
		$this->db->select('*');
		$this->db->from('loans');
		$this->db->join('payment_definition', 'payment_definition.payment_definition_id = loans.loan_payment_definition_id');
		$this->db->join('employee', 'employee.employee_id = loans.loan_employee_id');
		$this->db->join('job_role', 'job_role.job_role_id = employee.employee_job_role_id');
		$this->db->join('department', 'department.department_id = job_role.department_id');
		return $this->db->get()->result();
	}

	public function view_loan($loan_id){
		$this->db->select('*');
		$this->db->from('loans');
		$this->db->join('payment_definition', 'payment_definition.payment_definition_id = loans.loan_payment_definition_id');
		$this->db->join('employee', 'employee.employee_id = loans.loan_employee_id');
		$this->db->join('job_role', 'job_role.job_role_id = employee.employee_job_role_id');
		$this->db->join('department', 'department.department_id = job_role.department_id');
		$this->db->where('loans.loan_id', $loan_id);
		$query = $this->db->get();
		return $query->row();

	}

	public function view_loan_employee($employee_id){
		$this->db->select('*');
		$this->db->from('loans');
		$this->db->join('payment_definition', 'payment_definition.payment_definition_id = loans.loan_payment_definition_id');
		$this->db->join('employee', 'employee.employee_id = loans.loan_employee_id');
		$this->db->join('job_role', 'job_role.job_role_id = employee.employee_job_role_id');
		$this->db->join('department', 'department.department_id = job_role.department_id');
		$this->db->where('loans.loan_employee_id', $employee_id);
		return  $this->db->get()->result();

	}
	// 'Loan 'config end

	public function insert_loan_log($loan_data){

		$this->db->insert('loan_reschedule_log', $loan_data);
		return true;
	}

	public function view_loan_log($loan_id, $skip_month, $skip_year){

		$this->db->select('*');
		$this->db->from('loan_reschedule_log');
		$this->db->where('loan_reschedule_log.loan_log_loan_id', $loan_id);
		$this->db->where('loan_reschedule_log.loan_log_skip_month ', $skip_month);
		$this->db->where('loan_reschedule_log.loan_log_skip_year ', $skip_year);
		$query = $this->db->get();
		return $query->row();
	}

	public function insert_loan_repayment($repayment_data){
		$this->db->insert('loan_repayment', $repayment_data);
		return true;

	}

	public function compute_loan_payment ($loan_id){
		$this->db->select_sum('loan_repayment_amount');
		$this->db->from('loan_repayment');
		$this->db->where('loan_repayment_loan_id', $loan_id);
		$this->db->where('loan_repayment_type', 1);
		return $this->db->get()->row();
	}

	public function view_loan_repayments_by_my($payroll_month, $payroll_year){
		$this->db->select('*');
		$this->db->from('loan_repayment');
		$this->db->where('loan_repayment_payroll_month', $payroll_month);
		$this->db->where('loan_repayment_payroll_year', $payroll_year);
		return $this->db->get()->result();


	}

	public function undo_loan_repayment($payroll_month, $payroll_year){

		$this->db->where('loan_repayment_payroll_month', $payroll_month);
		$this->db->where('loan_repayment_payroll_year', $payroll_year);
		$this->db->delete('loan_repayment');
		return true;
	}

	public function count_pending_loans() {
    $this->db->select('*');
    $this->db->from('loans');
    $this->db->where('loans.loan_status', 2);
    return $this->db->count_all_results();
  }

  public function count_running_loans() {
    $this->db->select('*');
    $this->db->from('loans');
    $this->db->where('loans.loan_status', 0);
    return $this->db->count_all_results();
  }

}
