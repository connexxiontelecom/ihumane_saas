<?php


class Payroll_configurations extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('form_validation');
		$this->load->library('session');

	}

	// Tax Rates Setup begin
	public function add_tax_rate($tax_rate_data, $tenant_id){

		$this->db->insert('tax_rate'.$tenant_id, $tax_rate_data);
		return true;
	}

	public function update_tax_rate($tax_rate_id, $tax_rate_data, $tenant_id){

		$this->db->where('tax_rate_'.$tenant_id.'.tax_rate_id', $tax_rate_id);
		$this->db->update('tax_rate_'.$tenant_id, $tax_rate_data);
		return true;


	}

	public function view_tax_rates($tenant_id){

		$this->db->select('*');
		$this->db->from('tax_rate_'.$tenant_id);
		$this->db->order_by('tax_rate_id', 'asc');
		return $this->db->get()->result();

	}

	public function view_tax_rates_asc($tenant_id){

		$this->db->select('*');
		$this->db->from('tax_rate_'.$tenant_id);
		$this->db->order_by('tax_rate_id', 'asc');
		return $this->db->get()->result();

	}

	public function view_tax_rate($tax_rate_id, $tenant_id){
		$this->db->select('*');
		$this->db->from('tax_rate_'.$tenant_id);
		$this->db->where('tax_rate_id', $tax_rate_id);
		$query = $this->db->get();
		return $query->row();

	}
	// tax rate config end
	
	//payment definition setup start

	public function view_tie_number_fields(){
		$this->db->select('employee_hmo_number, employee_pension_number, employee_paye_number');
		$this->db->from('employee');
		$query = $this->db->get();
		return $query->list_fields();

	}

	public function add_payment_definition($payment_definition_data){

		$this->db->insert('payment_definition', $payment_definition_data);
		return true;
	}

	public function update_payment_definition($payment_definition_id, $payment_definition_data){

		$this->db->where('payment_definition.payment_definition_id', $payment_definition_id);
		$this->db->update('payment_definition', $payment_definition_data);
		return true;


	}

	public function view_payment_definitions($tenant_id){

		$this->db->select('*');
		$this->db->from('payment_definition');
		$this->db->where('tenant_id', $tenant_id);
		return $this->db->get()->result();

	}

	public function view_standard_payment_definition($tenant_id){

		$this->db->select('*');
		$this->db->from('payment_definition');
		$this->db->where('payment_definition_variant', 0);
		$this->db->where('tenant_id', $tenant_id);
		return $this->db->get()->result();
	}

	public function view_payment_definition($payment_definition_id, $tenant_id){
		$this->db->select('*');
		$this->db->from('payment_definition');
		$this->db->where('payment_definition_id', $payment_definition_id);
		$this->db->where('tenant_id', $tenant_id);
		$query = $this->db->get();
		return $query->row();

	}

	public function get_fixed_id($is, $tenant_id){
		$this->db->select('*');
		$this->db->from('payment_definition');
		$this->db->where('payment_definition_desc', $is);
		$this->db->where('tenant_id', $tenant_id);
		$query = $this->db->get();
		return $query->row();
	}



	// payment definition setup end

	public function view_salary_structures(){
		$this->db->select('*');
		$this->db->from('salary_structure_category');
		return $this->db->get()->result();

	}

	public function add_salary_structure($salary_structure_data){

		$this->db->insert('salary_structure_category', $salary_structure_data);
		return true;

	}

	public function update_salary_structure($salary_structure_id, $salary_structure_data){

		$this->db->where('salary_structure_category.salary_structure_id', $salary_structure_id);
		$this->db->update('salary_structure_category', $salary_structure_data);
		return true;


	}

	public function view_salary_structure($salary_structure_id){

		$this->db->select('*');
		$this->db->from('salary_structure_category');
		$this->db->where('salary_structure_category.salary_structure_id', $salary_structure_id);
		return $this->db->get()->row();
	}





	public function view_allowances(){

		$this->db->select('*');
		$this->db->from('salary_structure_allowance');
		$this->db->join('payment_definition', 'payment_definition.payment_definition_id = salary_structure_allowance.payment_definition_id');
		$this->db->join('salary_structure_category', 'salary_structure_category.salary_structure_id = salary_structure_allowance.salary_structure_category_id');
		return $this->db->get()->result();
	}

	public function add_allowance($salary_structure_allowance_data){
		$this->db->insert('salary_structure_allowance', $salary_structure_allowance_data);
		return true;
	}

	public function update_allowance($salary_structure_allowance_id, $salary_allowance_data){

		$this->db->where('salary_structure_allowance.salary_structure_allowance_id', $salary_structure_allowance_id);
		$this->db->update('salary_structure_allowance', $salary_allowance_data);
		return true;


	}

	public function view_allowance($salary_structure_allowance_id){

		$this->db->select('*');
		$this->db->from('salary_structure_allowance');
		$this->db->join('payment_definition', 'payment_definition.payment_definition_id = salary_structure_allowance.payment_definition_id');
		$this->db->join('salary_structure_category', 'salary_structure_category.salary_structure_id = salary_structure_allowance.salary_structure_category_id');
		$this->db->where('salary_structure_allowance.salary_structure_allowance_id', $salary_structure_allowance_id);
		return $this->db->get()->row();
	}

	public function view_salary_structure_allowances($salary_structure_category_id){

		$this->db->select('*');
		$this->db->from('salary_structure_allowance');
		$this->db->join('payment_definition', 'payment_definition.payment_definition_id = salary_structure_allowance.payment_definition_id');
		//$this->db->join('salary_structure_category', 'salary_structure_category.salary_structure_id = salary_structure_allowance.salary_structure_category_id');
		$this->db->where('salary_structure_allowance.salary_structure_category_id', $salary_structure_category_id);
		return $this->db->get()->result();
	}


	public function insert_personalized($personalized_data){

		$this->db->insert('personalized_salary_structure', $personalized_data);
		return true;

	}

	public function view_employee_personalized($employee_id){
		$this->db->select('*');
		$this->db->from('personalized_salary_structure');
		$this->db->join('payment_definition', 'payment_definition.payment_definition_id = personalized_salary_structure.personalized_payment_definition');
		$this->db->where('personalized_salary_structure.personalized_employee_id', $employee_id);
		return $this->db->get()->result();

	}

	public function remove_from_personalized($employee_id){

		$this->db->delete('personalized_salary_structure', array('personalized_employee_id' => $employee_id));
	}

	public function insert_payroll_month_year($data){
		$this->db->insert('payroll_month_year', $data);
		return true;

	}

	public function update_payroll_month_year($id, $data){
		$this->db->where('payroll_month_year.payroll_month_year_id', $id);
		$this->db->update('payroll_month_year', $data);
		return true;
	}

	public function view_payroll_month_year(){

		$this->db->select('*');
		$this->db->from('payroll_month_year');
		return $this->db->get()->result();

	}

	public function get_payroll_month_year(){
		$this->db->select('*');
		$this->db->from('payroll_month_year');
		return $this->db->get()->row();
	}

	public function insert_variational_payment($data){

		$this->db->insert('variational_payment', $data);
		return true;
	}

	public function view_variational_payments(){

		$this->db->select('*');
		$this->db->from('variational_payment');
		$this->db->join('payment_definition', 'payment_definition.payment_definition_id = variational_payment.variational_payment_definition_id');
		$this->db->join('employee', 'employee.employee_id = variational_payment.variational_employee_id');
		$this->db->join('job_role', 'job_role.job_role_id = employee.employee_job_role_id');
		$this->db->join('department', 'department.department_id = job_role.department_id');
		$query = $this->db->get()->result();
		return $query;
	}

	public function view_variational_payment($id){
		$this->db->select('*');
		$this->db->from('variational_payment');
		$this->db->join('payment_definition', 'payment_definition.payment_definition_id = variational_payment.variational_payment_definition_id');
		$this->db->join('employee', 'employee.employee_id = variational_payment.variational_employee_id');
		$this->db->join('job_role', 'job_role.job_role_id = employee.employee_job_role_id');
		$this->db->join('department', 'department.department_id = job_role.department_id');
		$this->db->where('variational_payment.variational_payment_id', $id);
		$query = $this->db->get()->row();
		return $query;
	}

	public function view_variational_payments_previous_month($previous_month, $previous_year){
		$this->db->select('*');
		$this->db->from('variational_payment');
		$this->db->join('payment_definition', 'payment_definition.payment_definition_id = variational_payment.variational_payment_definition_id');
		$this->db->join('employee', 'employee.employee_id = variational_payment.variational_employee_id');
		$this->db->join('job_role', 'job_role.job_role_id = employee.employee_job_role_id');
		$this->db->join('department', 'department.department_id = job_role.department_id');
		$this->db->where('variational_payroll_month', $previous_month);
		$this->db->where('variational_payroll_year', $previous_year);
		$query = $this->db->get()->result();
		return $query;
	}

	public function update_variational_payments($id, $data){
		$this->db->where('variational_payment.variational_payment_id', $id);
		$this->db->update('variational_payment', $data);
		return true;
	}


	public function insert_minimum_tax_rate($data){
		$this->db->insert('minimum_tax_rate', $data);
		return true;

	}

	public function update_minimum_tax_rate($id, $data){
		$this->db->where('minimum_tax_rate.minimum_tax_rate_id', $id);
		$this->db->update('minimum_tax_rate', $data);
		return true;
	}

	public function view_minimum_tax_rate(){

		$this->db->select('*');
		$this->db->from('minimum_tax_rate');
		return $this->db->get()->result();

	}

	public function get_minimum_tax_rate(){
		$this->db->select('*');
		$this->db->from('minimum_tax_rate');
		return $this->db->get()->row();
	}


	public function insert_pension_rate($data){
		$this->db->insert('pension_rate', $data);
		return true;

	}

	public function update_pension_rate($id, $data){
		$this->db->where('pension_rate.pension_rate_id', $id);
		$this->db->update('pension_rate', $data);
		return true;
	}

	public function view_pension_rate(){

		$this->db->select('*');
		$this->db->from('pension_rate');
		return $this->db->get()->result();

	}

	public function get_pension_rate(){
		$this->db->select('*');
		$this->db->from('pension_rate');
		return $this->db->get()->row();
	}

	public function view_payment_definitions_order(){

		$this->db->select('*');
		$this->db->from('payment_definition');
		$this->db->order_by('payment_definition_type', 'desc');
		return $this->db->get()->result();

	}

	public function get_income_payments() {
    $this->db->select('*');
    $this->db->from('payment_definition');
    $this->db->where('payment_definition.payment_definition_type', 1);
    return $this->db->get()->result();
  }

  public function get_deduction_payments() {
    $this->db->select('*');
    $this->db->from('payment_definition');
    $this->db->where('payment_definition.payment_definition_type', 0);
    return $this->db->get()->result();
  }

  public function count_personalized_employees(){
	  $this->db->select('*');
	  $this->db->from('employee');
	  $this->db->where('employee.employee_salary_structure_category', 0);
	  return $this->db->count_all_results();
  }

  public function count_categorized_employees(){
	  $this->db->select('*');
	  $this->db->from('employee');
	  $this->db->where('employee.employee_salary_structure_category !=', 0);
	  return $this->db->count_all_results();
  }

  public function count_variational_payments(){
	  return $this->db->count_all('variational_payment');
  }








}
