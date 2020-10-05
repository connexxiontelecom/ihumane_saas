<?php


class Configurations extends CI_Model
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

	public function create_salary_table($i){

		$this->dbutil->optimize_table('salary_'.$i);
		$fields = array(
				'salary_id' => array(
					'type' => 'INT',
					'auto_increment' => TRUE
				),
				'salary_employee_id' => array(
					'type' => 'INT',

				),
				'salary_payment_definition_id' => array(
					'type' => 'INT',

				),
				'salary_pay_month' => array(
					'type' => 'INT',
				),
				'salary_pay_year' => array(
					'type' => 'INT',

				),
				'salary_amount' => array(

					'type' => 'DOUBLE',

				),
			'salary_confirmed' => array(

				'type' => 'INT',
				'default' => 0

			),

		);

			$this->dbforge->add_field($fields);

			$this->dbforge->add_key('salary_id', TRUE);

			$this->dbforge->create_table('salary_'.$i, TRUE);
	}

	public function create_tax_rate_table($i){

		$this->dbutil->optimize_table('tax_rate_'.$i);

		$fields = array(
			'tax_rate_id' => array(
				'type' => 'INT',
				'auto_increment' => TRUE
			),
			'tax_rate_band' => array(
				'type' => 'DOUBLE',

			),
			'tax_rate_rate' => array(
				'type' => 'DOUBLE',

			),

		);

		$this->dbforge->add_field($fields);

		$this->dbforge->add_key('tax_rate_id', TRUE);

		$this->dbforge->create_table('tax_rate_'.$i, TRUE);
	}

	public function create_loans_table($i){

		$this->dbutil->optimize_table('loans_'.$i);

		$fields = array(
			'loan_id' => array(
				'type' => 'INT',
				'auto_increment' => TRUE
			),
			'loan_employee_id' => array(
				'type' => 'INT',

			),

			'loan_payment_definition_id' => array(
				'type' => 'INT',
			),

			'loan_amount' => array(
				'type' => 'DOUBLE',

			),

			'loan_reason' => array(
				'type' => 'TEXT',

			),

			'loan_start_year' => array(
				'type' => 'INT',

			),

			'loan_start_month' => array(
				'type' => 'INT',

			),

			'loan_end_year' => array(
				'type' => 'INT',

			),

			'loan_end_month' => array(
				'type' => 'INT',

			),

			'loan_installments' => array(
				'type' => 'DOUBLE',

			),

			'loan_skip_year' => array(
				'type' => 'INT',
				'default' => null

			),

			'loan_skip_month' => array(
				'type' => 'INT',
				'default' => null

			),

			'loan_monthly_repayment' => array(
				'type' => 'DOUBLE',
			),

			'loan_balance' => array(
				'type' => 'DOUBLE',

			),

			'loan_status' => array(
				'type' => 'INT',
				'default' => 0

			),

		);

		$this->dbforge->add_field($fields);

		$this->dbforge->add_key('loan_id', TRUE);

		$this->dbforge->create_table('loans_'.$i, TRUE);
	}

	public function create_loan_repayment_table($i){

		$this->dbutil->optimize_table('loan_repayment_'.$i);

		$fields = array(
			'loan_repayment_id' => array(
				'type' => 'INT',
				'auto_increment' => TRUE
			),
			'loan_repayment_loan_id' => array(
				'type' => 'INT',

			),

			'loan_repayment_amount' => array(
				'type' => 'DOUBLE',

			),

			'loan_repayment_type' => array(
				'type' => 'INT',
			),

			'loan_repayment_payroll_month' => array(
				'type' => 'INT',

			),

			'loan_repayment_payroll_year' => array(
				'type' => 'INT',

			),
			'loan_repayment_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP',

		);

		$this->dbforge->add_field($fields);

		$this->dbforge->add_key('loan_repayment_id', TRUE);

		$this->dbforge->create_table('loan_repayment_'.$i, TRUE);
	}

	public function create_variational_payment_table($i){

		$this->dbutil->optimize_table('variational_payment_'.$i);

		$fields = array(
			'variational_payment_id' => array(
				'type' => 'INT',
				'auto_increment' => TRUE
			),
			'variational_employee_id' => array(
				'type' => 'INT',

			),

			'variational_payment_definition_id' => array(
				'type' => 'INT',

			),

			'variational_amount' => array(
				'type' => 'INT',
			),

			'variational_confirm' => array(
				'type' => 'INT',

			),

			'variational_payroll_month' => array(
				'type' => 'INT',

			),

			'variational_payroll_year' => array(
				'type' => 'INT',

			),


		);

		$this->dbforge->add_field($fields);

		$this->dbforge->add_key('variational_payment_id', TRUE);

		$this->dbforge->create_table('variational_payment_'.$i, TRUE);
	}

	public function create_loan_reschedule_log_table($i){

		$this->dbutil->optimize_table('loan_reschedule_log_'.$i);

		$fields = array(
			'loan_log_id' => array(
				'type' => 'INT',
				'auto_increment' => TRUE
			),
			'loan_log_loan_id' => array(
				'type' => 'INT',

			),

			'loan_log_reschedule_type' => array(
				'type' => 'INT',

			),

			'loan_log_reschedule_amount' => array(
				'type' => 'DOUBLE',
				'default' => null,
			),

			'loan_log_loan_balance' => array(
				'type' => 'DOUBLE',

			),

			'loan_log_skip_month' => array(
				'type' => 'INT',
				'default' => null

			),

			'loan_log_skip_year' => array(
				'type' => 'INT',
				'default' => null

			),


		);

		$this->dbforge->add_field($fields);

		$this->dbforge->add_key('loan_log_id', TRUE);

		$this->dbforge->create_table('loan_reschedule_log_'.$i, TRUE);
	}


	public function new_subscription($subscription_data){
		$this->db->insert('subscription', $subscription_data);
		return true;
	}

	public function view_config($tenant_id){

		$this->db->select('*');
		$this->db->from('configuration');
		$this->db->where('tenant_id', $tenant_id);
		return $this->db->get()->row();
	}

	public function insert_config($config_data){

		$this->db->insert('configuration', $config_data);
		return true;
	}

	public function update_configuration($config_id, $config_data){
		$this->db->where('configuration.configuration_id', $config_id);
		$this->db->update('configuration', $config_data);
		return true;

	}




}
