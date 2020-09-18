<?php


class Salaries extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->dbforge();
		$this->load->dbutil();

	}
	public function add_salary($salary_data, $salary_table){

		$this->db->insert($salary_table, $salary_data);
		return true;
	}

	public function view_salaries(){
		$this->db->select('*');
		$this->db->from('salary');
		return $this->db->get()->result();

	}


	public function get_personalized_income($employee_id){
		$this->db->select('*');
		$this->db->from('personalized_salary_structure');
		$this->db->join('payment_definition', 'payment_definition.payment_definition_id = personalized_salary_structure.personalized_payment_definition');
		$this->db->where('personalized_salary_structure.personalized_employee_id', $employee_id);
		return $this->db->get()->result();

	}

	public function get_categorized_income($salary_structure_category_id){
		$this->db->select('*');
		$this->db->from('salary_structure_allowance');
		$this->db->join('payment_definition', 'payment_definition.payment_definition_id = salary_structure_allowance.payment_definition_id');
		$this->db->where('salary_structure_allowance.salary_structure_category_id', $salary_structure_category_id);
		return $this->db->get()->result();

	}
	public function get_variational_payment($employee_id){
		$this->db->select('*');
		$this->db->from('variational_payment');
		$this->db->join('payment_definition', 'payment_definition.payment_definition_id = variational_payment.variational_payment_definition_id');
		$this->db->where('variational_payment.variational_employee_id', $employee_id);
		return $this->db->get()->result();

	}


	public function get_taxable_incomes($employee_id, $payroll_year, $payroll_month){

		$this->db->select('*');
		$this->db->from('salary');
		$this->db->join('payment_definition', 'payment_definition.payment_definition_id = salary.salary_payment_definition_id');
		$this->db->where('salary.salary_employee_id', $employee_id);
		$this->db->where('salary.salary_pay_year', $payroll_year);
		$this->db->where('salary.salary_pay_month', $payroll_month);
		return $this->db->get()->result();


	}

	public function undo_salary_routine($payroll_month, $payroll_year){

		$this->db->where('salary_pay_month', $payroll_month);
		$this->db->where('salary_pay_year', $payroll_year);
		$this->db->where('salary_confirmed', 0);
		$this->db->delete('salary');
		return true;
	}

	public function approve_payroll($payroll_month, $payroll_year, $payroll_data){

		$this->db->where('salary_pay_month', $payroll_month);
		$this->db->where('salary_pay_year', $payroll_year);
		$this->db->where('salary_confirmed', 0);
		$this->db->update('salary', $payroll_data);
		return true;
	}


	public function get_employee_income($employee_id, $payroll_month, $payroll_year, $in_de){
		$this->db->select('*');
		$this->db->from('salary');
		$this->db->join('payment_definition', 'payment_definition.payment_definition_id = salary.salary_payment_definition_id');
		$this->db->where('salary.salary_employee_id', $employee_id);
		$this->db->where('salary.salary_pay_month', $payroll_month);
		$this->db->where('salary.salary_pay_year', $payroll_year);
		$this->db->where('payment_definition.payment_definition_type', $in_de);
		return $this->db->get()->result();
	}

	public function view_min_payroll_year(){
		$this->db->select_min('salary_pay_year');
		$this->db->from('salary');
		return $this->db->get()->result();
	}

	public function new_column($fields){

		$this->dbforge->add_column('emolument_report', $fields);
	}

	public function optimize_emolument_report(){

		$this->dbutil->optimize_table('emolument_report');
	}

	public function insert_emolument($emolument_data){

		$this->db->insert('emolument_report', $emolument_data);
		return true;
	}

	public function view_salaries_emolument($employee_id, $month, $year){
		$this->db->select('*');
		$this->db->from('salary');
		$this->db->where('salary.salary_employee_id', $employee_id);
		$this->db->where('salary.salary_pay_month', $month);
		$this->db->where('salary.salary_pay_year', $year);
		$this->db->where('salary.salary_confirmed', 1);
		return $this->db->get()->result();

	}

	public function update_emolument($employee_id, $emolument_data){

		$this->db->where('emolument_report_employee_id', $employee_id);
		$this->db->update('emolument_report', $emolument_data);
		return true;

	}

	public function view_emolument_sheet(){
		$this->db->select('*');
		$this->db->from('emolument_report');
		$this->db->join('employee', 'employee.employee_id = emolument_report.emolument_report_employee_id');
		$this->db->join('job_role', 'job_role.job_role_id = employee.employee_job_role_id');
		$this->db->join('department', 'department.department_id = job_role.department_id');
		return $this->db->get()->result();
	}

	public function view_emolument_fields(){
		$this->db->select('*');
		$this->db->from('emolument_report');
		$query = $this->db->get();
		return $query->list_fields();

	}

	public function get_employee_income_pay($employee_id, $payment_definition_id, $month, $year){

		$this->db->select('*');
		$this->db->from('salary');
		$this->db->join('payment_definition', 'payment_definition.payment_definition_id = salary.salary_payment_definition_id');
		$this->db->where('salary.salary_employee_id', $employee_id);
		$this->db->where('salary.salary_pay_month', $month);
		$this->db->where('salary.salary_pay_year', $year);
		$this->db->where('salary.salary_payment_definition_id', $payment_definition_id);
		$this->db->where('salary.salary_confirmed', 1);
		return $this->db->get()->row();

	}

	public function clear_emolument(){

		$this->db->empty_table('emolument_report');

	}

	public function remove_field($field_name){

		$this->dbforge->drop_column('emolument_report', $field_name);
	}

	public function get_sheet($payroll_month, $payroll_year, $payment_definition_id, $in_de){
		$this->db->select('*');
		$this->db->from('salary');
		$this->db->join('employee', 'employee.employee_id = salary.salary_employee_id');
		$this->db->join('payment_definition', 'payment_definition.payment_definition_id = salary.salary_payment_definition_id');
		$this->db->where('salary.salary_pay_month', $payroll_month);
		$this->db->where('salary.salary_pay_year', $payroll_year);
		$this->db->where('payment_definition.payment_definition_type', $in_de);
		$this->db->where('salary.salary_payment_definition_id', $payment_definition_id);
		return $this->db->get()->result();
	}

	public function check_salary($payroll_month, $payroll_year){
		$this->db->select('*');
		$this->db->from('salary');
		$this->db->join('employee', 'employee.employee_id = salary.salary_employee_id');
		$this->db->join('payment_definition', 'payment_definition.payment_definition_id = salary.salary_payment_definition_id');
		$this->db->where('salary.salary_pay_month', $payroll_month);
		$this->db->where('salary.salary_pay_year', $payroll_year);
		$this->db->where('payment_definition.payment_definition_type', $in_de);
		$this->db->where('salary.salary_payment_definition_id', $payment_definition_id);
		return $this->db->get()->result();
	}

  public function get_salaries_by_payment_id($payment_ids) {
    $this->db->select('*');
    $this->db->from('salary');
    $this->db->where_in('salary.salary_payment_definition_id', $payment_ids);
    return $this->db->get()->result();
  }

  public function get_salaries_current_month($payment_ids) {
    $this->db->select('*');
    $this->db->from('salary');
    $this->db->where_in('salary.salary_payment_definition_id', $payment_ids);
    $this->db->where('salary.salary_pay_month', date('m'));
    $this->db->where('salary.salary_pay_year', date('Y'));
    return $this->db->get()->result();
  }

  public function get_salaries_current_year($payment_ids) {
    $this->db->select('*');
    $this->db->from('salary');
    $this->db->where_in('salary.salary_payment_definition_id', $payment_ids);
    $this->db->where('salary.salary_pay_year', date('Y'));
    return $this->db->get()->result();
  }



}
