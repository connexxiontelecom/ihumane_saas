<?php


class Employees extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('form_validation');
		$this->load->library('session');

	}




	public function view_employees($tenant_id){
		$this->db->select('*');
		$this->db->from('employee');
		$this->db->join('grade', 'grade.grade_id = employee.employee_grade_id');
		$this->db->join('job_role', 'job_role.job_role_id = employee.employee_job_role_id');
		$this->db->join('department', 'department.department_id = job_role.department_id');
		$this->db->join('bank', 'bank.bank_id = employee.employee_bank_id');
		$this->db->join('subsidiary', 'subsidiary.subsidiary_id = employee.employee_subsidiary_id');
		$this->db->where('employee.tenant_id', $tenant_id);
		return $this->db->get()->result();

	}
	
	public function view__employees($tenant_id){
		$this->db->select('*');
		$this->db->from('employee');
//		$this->db->join('grade', 'grade.grade_id = employee.employee_grade_id');
//		$this->db->join('job_role', 'job_role.job_role_id = employee.employee_job_role_id');
//		$this->db->join('department', 'department.department_id = job_role.department_id');
//		$this->db->join('bank', 'bank.bank_id = employee.employee_bank_id');
		$this->db->where('employee.tenant_id', $tenant_id);
		return $this->db->get()->result();
		
	}
	
	

	public function get_employee($employee_id, $tenant_id){
		$this->db->select('*');
		$this->db->from('employee');
		$this->db->join('grade', 'grade.grade_id = employee.employee_grade_id');
		$this->db->join('job_role', 'job_role.job_role_id = employee.employee_job_role_id');
		$this->db->join('department', 'department.department_id = job_role.department_id');
		$this->db->join('location', 'location.location_id = employee.employee_location_id');
		$this->db->join('subsidiary', 'subsidiary.subsidiary_id = employee.employee_subsidiary_id');
		$this->db->join('bank', 'bank.bank_id = employee.employee_bank_id');
		$this->db->where('employee_id', $employee_id);
		$this->db->where('employee.tenant_id', $tenant_id);
		$query = $this->db->get()->row();
		if($query->employee_salary_structure_category == 0):
			return $query;
		else:

			$this->db->select('*');
			$this->db->from('employee');
			$this->db->join('grade', 'grade.grade_id = employee.employee_grade_id');
			$this->db->join('job_role', 'job_role.job_role_id = employee.employee_job_role_id');
			$this->db->join('department', 'department.department_id = job_role.department_id');
			$this->db->join('location', 'location.location_id = employee.employee_location_id');
			$this->db->join('subsidiary', 'subsidiary.subsidiary_id = employee.employee_subsidiary_id');
			$this->db->join('bank', 'bank.bank_id = employee.employee_bank_id');
			$this->db->join('salary_structure_category', 'salary_structure_category.salary_structure_id = employee.employee_salary_structure_category');
			$this->db->where('employee_id', $employee_id);
			$this->db->where('employee.tenant_id', $tenant_id);
			$query = $this->db->get()->row();


			return $query;
		endif;



	}
	
	public function get__employee($employee_id, $tenant_id){
		$this->db->select('*');
		$this->db->from('employee');
		
		$this->db->where('employee_id', $employee_id);
		$this->db->where('employee.tenant_id', $tenant_id);
		return $this->db->get()->row();
		
		
		
	}
	
	
	public function get_employee_by_unique($employee_unique_id, $tenant_id){
		$this->db->select('*');
		$this->db->from('employee');
		$this->db->join('grade', 'grade.grade_id = employee.employee_grade_id');
		$this->db->join('job_role', 'job_role.job_role_id = employee.employee_job_role_id');
		$this->db->join('department', 'department.department_id = job_role.department_id');
		$this->db->join('location', 'location.location_id = employee.employee_location_id');
		$this->db->join('subsidiary', 'subsidiary.subsidiary_id = employee.employee_subsidiary_id');
		$this->db->join('bank', 'bank.bank_id = employee.employee_bank_id');
		$this->db->where('employee_unique_id', $employee_unique_id);
		$this->db->where('employee.tenant_id', $tenant_id);
		$query = $this->db->get()->row();

		if($query->employee_salary_structure_category == 0):
			return $query;
		else:

			$this->db->select('*');
			$this->db->from('employee');
			$this->db->join('grade', 'grade.grade_id = employee.employee_grade_id');
			$this->db->join('job_role', 'job_role.job_role_id = employee.employee_job_role_id');
			$this->db->join('department', 'department.department_id = job_role.department_id');
			$this->db->join('location', 'location.location_id = employee.employee_location_id');
			$this->db->join('subsidiary', 'subsidiary.subsidiary_id = employee.employee_subsidiary_id');
			$this->db->join('bank', 'bank.bank_id = employee.employee_bank_id');
			$this->db->join('salary_structure_category', 'salary_structure_category.salary_structure_id = employee.employee_salary_structure_category');
			$this->db->where('employee_unique_id', $employee_unique_id);
			$this->db->where('employee.tenant_id', $tenant_id);
			$query = $this->db->get()->row();


			return $query;
		endif;



	}

	public function get_unique_employee($employee_unique_id){
		$this->db->select('*');
		$this->db->from('employee');
		$this->db->where('employee_unique_id', $employee_unique_id);
		$query = $this->db->get()->result();





	}

	public function update_employee($employee_id, $employee_data){

		$this->db->where('employee.employee_id', $employee_id);
		$this->db->update('employee', $employee_data);
		return true;


	}

	public function add_employee($employee_data){

		$this->db->insert('employee', $employee_data);
		return $this->db->insert_id();
	}

	public function add_work_experience($work_experience_data){

		$this->db->insert('work_experience', $work_experience_data);
		return true;
	}

	public function insert_other_document($other_document_data){

		$this->db->insert('other_document', $other_document_data);
		return true;
	}

	public function get_other_document($employee_id){
		$this->db->select('*');
		$this->db->from('other_document');
		$this->db->where('other_document_employee_id', $employee_id);
		return $this->db->get()->result();
	}

	public function get_work_experience($employee_id){
		$this->db->select('*');
		$this->db->from('work_experience');
		$this->db->where('employee_id', $employee_id);
		return $this->db->get()->result();
	}

	public function get_employee_by_salary_setup($tenant_id){
		$this->db->select('*');
		$this->db->from('employee');
		$this->db->join('grade', 'grade.grade_id = employee.employee_grade_id');
		$this->db->join('job_role', 'job_role.job_role_id = employee.employee_job_role_id');
		$this->db->join('department', 'department.department_id = job_role.department_id');
		$this->db->where('employee.tenant_id', $tenant_id);
		$this->db->order_by('employee_salary_structure_setup', 'ASC');

		return $this->db->get()->result();

	}

	public function get_employees_by_department($department_id, $tenant_id){
		$this->db->select('*');
		$this->db->from('employee');
		$this->db->join('grade', 'grade.grade_id = employee.employee_grade_id');
		$this->db->join('job_role', 'job_role.job_role_id = employee.employee_job_role_id');
		$this->db->join('department', 'department.department_id = job_role.department_id');
		$this->db->where('department.department_id', $department_id);
		$this->db->where('employee.employee_status !=', 0);
		$this->db->where('employee.employee_status !=', 3);
		$this->db->where('tenant_id', $tenant_id);
		return $this->db->get()->result();

	}

	public function insert_employee_history($employee_history_data){
		$this->db->insert('employee_history', $employee_history_data);
		return true;

	}

	public function get_employees_transfers($tenant_id){
		$this->db->select('*');
		$this->db->from('transfer');
		$this->db->join('employee', 'employee.employee_id = transfer.transfer_employee_id');
		$this->db->where('transfer.tenant_id', $tenant_id);
		$this->db->order_by('transfer_date', 'DESC');
		return $this->db->get()->result();

	}

	public function insert_transfer($transfer_data){
		$this->db->insert('transfer', $transfer_data);
		return true;

	}


	public function get_employees_leaves($tenant_id){
		$this->db->select('*');
		$this->db->from('employee_leave');
		$this->db->join('employee', 'employee.employee_id = employee_leave.leave_employee_id');
		$this->db->join('leave_type', 'leave_type.leave_id = employee_leave.leave_leave_type');
		$this->db->where('employee_leave.tenant_id', $tenant_id);
		//$this->db->order_by('transfer_date', 'DESC');
		return $this->db->get()->result();

	}

	public function check_existing_employee_leaves($employee_id, $tenant_id){
		$this->db->select('*');
		$this->db->from('employee_leave');
		$this->db->where('employee_leave.leave_employee_id', $employee_id);
		$this->db->join('leave_type', 'leave_type.leave_id = employee_leave.leave_leave_type');
		$this->db->where('employee_leave.tenant_id', $tenant_id);
		//$this->db->where('employee_leave.leave_status', 0 );
		//$this->db->or_where('employee_leave.leave_status', 1);
		return $this->db->get()->result();

	}

	public function insert_leave($data){

		$this->db->insert('employee_leave', $data);
		return true;
	}

	public function check_leave_end_date($date){
		$leave_array = array(
		'leave_status' => 2
		);
		$this->db->where('employee_leave.leave_end_date', $date);
		$this->db->update('employee_leave', $leave_array);
		return true;

	}

	public function get_leave($leave_id, $tenant_id){
		$this->db->select('*');
		$this->db->from('employee_leave');
		$this->db->join('employee', 'employee.employee_id = employee_leave.leave_employee_id');
		$this->db->join('leave_type', 'leave_type.leave_id = employee_leave.leave_leave_type');
		$this->db->where('employee_leave.employee_leave_id', $leave_id);
		$this->db->where('employee_leave.tenant_id', $tenant_id);
		return $this->db->get()->row();
	}

	public function update_leave($leave_id, $leave_data){
		$this->db->where('employee_leave.employee_leave_id', $leave_id);
		$this->db->update('employee_leave', $leave_data);
		return true;

	}

	public function get_appraisals($tenant_id){
		$this->db->select('*');
		$this->db->from('employee_appraisal');
		$this->db->join('employee', 'employee.employee_id = employee_appraisal.employee_appraisal_employee_id');
		$this->db->where('employee_appraisal.tenant_id', $tenant_id);
		return $this->db->get()->result();

	}

	public function check_employee_appraisal($employee_id){
		$this->db->select('*');
		$this->db->from('employee_appraisal');
		$this->db->where('employee_appraisal.employee_appraisal_employee_id', $employee_id);
		$this->db->where('employee_appraisal.employee_appraisal_status', 0);
		return $this->db->get()->result();

	}

	public function insert_appraisal($appraisal_data){

		$this->db->insert('employee_appraisal', $appraisal_data);
		return $this->db->insert_id();
	}

	public function insert_question_result($question_data){

		$this->db->insert('employee_appraisal_result', $question_data);
		return true;
	}


	public function view_employee_history($employee_id){
		$this->db->select('*');
		$this->db->from('employee_history');
		$this->db->where('employee_history.employee_history_employee_id', $employee_id);
		$this->db->order_by('employee_history_date', 'DESC');
		return $this->db->get()->result();

	}

	public function get_employee_appraisal($employee_id){
		$this->db->select('*');
		$this->db->from('employee_appraisal');
		$this->db->where('employee_appraisal.employee_appraisal_employee_id', $employee_id);
		$this->db->join('employee', 'employee.employee_id = employee_appraisal.employee_appraisal_supervisor_id');
		//$this->db->where('employee_appraisal.employee_appraisal_status', 0);
		return $this->db->get()->result();

	}

	public function update_appraisal($appraisal_id, $appraisal_data){
		$this->db->where('employee_appraisal.employee_appraisal_id', $appraisal_id);
		$this->db->update('employee_appraisal', $appraisal_data);
		return true;

	}


	public function get_appraise_employees($employee_id){
		$this->db->select('*');
		$this->db->from('employee_appraisal');
		$this->db->where('employee_appraisal.employee_appraisal_supervisor_id', $employee_id);
		$this->db->join('employee', 'employee.employee_id = employee_appraisal.employee_appraisal_employee_id');
		//$this->db->where('employee_appraisal.employee_appraisal_status', 0);
		return $this->db->get()->result();

	}


	public function get_appraisal_questions($appraisal_id, $tenant_id){

		$this->db->select('*');
		$this->db->from('employee_appraisal_result');
		$this->db->where('employee_appraisal_result.employee_appraisal_result_appraisal_id', $appraisal_id);
		$this->db->where('employee_appraisal_result.tenant_id', $tenant_id);
		return $this->db->get()->result();


	}

	public function get_appraisal($appraisal_id, $tenant_id){
		$this->db->select('*');
		$this->db->from('employee_appraisal');
		$this->db->where('employee_appraisal.employee_appraisal_id', $appraisal_id);
		$this->db->join('employee', 'employee.employee_id = employee_appraisal.employee_appraisal_employee_id');
		$this->db->where('employee_appraisal.tenant_id', $tenant_id);
		return $this->db->get()->row();
	}

	public function _get_appraisal($appraisal_id, $tenant_id){
		$this->db->select('*');
		$this->db->from('employee_appraisal');
		$this->db->where('employee_appraisal.employee_appraisal_id', $appraisal_id);
		$this->db->join('employee', 'employee.employee_id = employee_appraisal.employee_appraisal_supervisor_id');
		$this->db->where('employee_appraisal.tenant_id', $tenant_id);
		return $this->db->get()->row();
	}

	public function answer_question($question_id, $answer_data){
		$this->db->where('employee_appraisal_result.employee_appraisal_result_id', $question_id);
		$this->db->update('employee_appraisal_result', $answer_data);
		return true;

	}

	public function insert_termination($termination_data){

		$this->db->insert('termination', $termination_data);
		return true;
	}

	public function get_terminations($tenant_id){
		$this->db->select('*');
		$this->db->from('termination');
		$this->db->join('employee', 'employee.employee_id = termination.termination_employee_id');
		$this->db->where('termination.tenant_id', $tenant_id);
		return $this->db->get()->result();
	}

	public function get_employee_terminations($employee_id, $tenant_id){
		$this->db->select('*');
		$this->db->from('termination');
		$this->db->where('termination.termination_employee_id', $employee_id);
		$this->db->where('termination.tenant_id', $tenant_id);
		return $this->db->get()->result();
	}

	public function insert_resignation($resignation_data){

		$this->db->insert('resignation', $resignation_data);
		return true;
	}

	public function get_employee_resignations($employee_id, $tenant_id){
		$this->db->select('*');
		$this->db->from('resignation');
		$this->db->where('resignation.resignation_employee_id', $employee_id);
		$this->db->where('resignation.tenant_id', $tenant_id);
		return $this->db->get()->result();
	}
	public function get_resignations($tenant_id){
		$this->db->select('*');
		$this->db->from('resignation');
		$this->db->join('employee', 'employee.employee_id = resignation.resignation_employee_id');
		$this->db->where('resignation.tenant_id', $tenant_id);
		return $this->db->get()->result();
	}

	public function update_resignation($resignation_id, $resignation_data){
		$this->db->where('resignation.resignation_id', $resignation_id);
		$this->db->update('resignation', $resignation_data);
		return true;

	}

	public function get_resignation($resignation_id, $tenant_id){
		$this->db->select('*');
		$this->db->from('resignation');
		$this->db->where('resignation.resignation_id', $resignation_id);
		$this->db->where('resignation.tenant_id', $tenant_id);
		return $this->db->get()->row();

	}

	public function get_queries_employee($employee_id, $tenant_id){
		$this->db->select('*');
		$this->db->from('query');
		$this->db->where('query.query_employee_id', $employee_id);
		$this->db->where('query.tenant_id', $tenant_id);
		return $this->db->get()->result();

	}

	public function insert_query($query_data){

		$this->db->insert('query', $query_data);
		return true;
	}

	public function get_query($query_id, $tenant_id){
		$this->db->select('*');
		$this->db->from('query');
		$this->db->join('employee', 'employee.employee_id = query.query_employee_id');
		$this->db->where('query.query_id', $query_id);
		$this->db->where('query.tenant_id', $tenant_id);
		return $this->db->get()->row();

	}

	public function get_query_response($query_id, $tenant_id){
		$this->db->select('*');
		$this->db->from('query_response');
		//$this->db->join('employee', 'employee.employee_id = query_response.query_response_responder_id');
		$this->db->where('query_response.query_response_query_id', $query_id);
		$this->db->where('query_response.tenant_id', $tenant_id);
		return $this->db->get()->result();

	}

	public function insert_query_response($query_response_data){
		$this->db->insert('query_response', $query_response_data);
		return true;
	}

	public function update_query($query_id, $query_data){
		$this->db->where('query.query_id', $query_id);
		$this->db->update('query', $query_data);
		return true;

	}


	public function insert_memo($memo_data){
		$this->db->insert('memo', $memo_data);
		return true;
	}

	public function get_memos($tenant_id){
		$this->db->select('*');
		$this->db->from('memo');
		$this->db->where('tenant_id', $tenant_id);
		$this->db->order_by('memo_date', 'DESC');
		return $this->db->get()->result();
	}

	public function update_memo($memo_id, $memo_data){
		$this->db->where('memo.memo_id', $memo_id);
		$this->db->update('memo', $memo_data);
		return true;

	}

	public function insert_specific_memo($memo_data){
		$this->db->insert('specific_memo', $memo_data);
		return true;
	}

	public function get_specific_memos($tenant_id){
		$this->db->select('*');
		$this->db->from('specific_memo');
		$this->db->join('employee', 'employee.employee_id = specific_memo.specific_memo_employee_id');
		$this->db->where('specific_memo.tenant_id', $tenant_id);
		$this->db->order_by('specific_memo_date', 'DESC');
		return $this->db->get()->result();
	}

	public function update_specific_memo($memo_id, $memo_data){
		$this->db->where('specific_memo.specific_memo_id', $memo_id);
		$this->db->update('specific_memo', $memo_data);
		return true;

	}

	public function get_my_memo($employee_id){
		$this->db->select('*');
		$this->db->from('specific_memo');
		$this->db->where('specific_memo.specific_memo_employee_id', $employee_id);
		$this->db->order_by('specific_memo_date', 'DESC');
		return $this->db->get()->result();

	}

	public function insert_notifications($notification_data){
		$this->db->insert('notification', $notification_data);
		return true;
	}

	public function get_notifications($employee_id, $tenant_id){

		$this->db->select('*');
		$this->db->from('notification');
		$this->db->where('notification.notification_employee_id', $employee_id);
		$this->db->where('notification.notification_status', 0);
		$this->db->where('notification.tenant_id', $tenant_id);
		$this->db->order_by('notification_date', 'DESC');
		return $this->db->get()->result();
	}

	public function get_notification($notification_id, $tenant_id){

		$this->db->select('*');
		$this->db->from('notification');
		$this->db->where('notification.notification_id', $notification_id);
		$this->db->where('notification.tenant_id', $tenant_id);
		return $this->db->get()->row();
	}

	public function update_notification($notification_id, $notification_data){

		$this->db->where('notification.notification_id', $notification_id);
		$this->db->update('notification', $notification_data);
		return true;

	}

	public function get_my_leave_wallet($employee_id, $leave_id, $year){
		$this->db->select('*');
		$this->db->from('employee_leave');
		$this->db->where('leave_employee_id', $employee_id);
		$this->db->where('leave_leave_type', $leave_id);
		$this->db->where('leave_status !=', 0);
		$this->db->where('leave_status', 1);
		$this->db->or_where('leave_status', 2);
		$this->db->like('leave_start_date', $year);
		return $this->db->get()->result();

	}

	public function get_trainings($tenant_id){
		$this->db->select('*');
		$this->db->from('employee_training');
		$this->db->join('employee', 'employee.employee_id = employee_training.employee_training_employee_id');
		$this->db->join('training', 'training.training_id = employee_training.employee_training_training_id');
		$this->db->where('employee_training.tenant_id', $tenant_id);
		return $this->db->get()->result();

	}


	public function insert_employee_training($training_data){
		$this->db->insert('employee_training', $training_data);
		return $this->db->insert_id();
	}

	public function delete_employee_training($training_id){
		$this->db->delete('employee_training', array('employee_training_id' => $training_id));
		return true;
	}

	public function delete_work_experience($employee_id){
		$this->db->delete('work_experience', array('employee_id' => $employee_id));
		return true;
	}

	public function update_employee_training($employee_training_id, $training_data){
		$this->db->where('employee_training.employee_training_id', $employee_training_id);
		$this->db->update('employee_training', $training_data);
		return true;
	}

	public function get_employee_training($employee_id, $tenant_id){

		$this->db->select('*');
		$this->db->from('employee_training');
		$this->db->join('training', 'training.training_id = employee_training.employee_training_training_id');
		$this->db->where('employee_training.employee_training_employee_id', $employee_id);
		$this->db->where('employee_training.tenant_id', $tenant_id);
		return $this->db->get()->result();

	}

	public function get_employee_training_($employee_training_id, $tenant_id){
		$this->db->select('*');
		$this->db->from('employee_training');
		$this->db->join('training', 'training.training_id = employee_training.employee_training_training_id');
		$this->db->join('employee', 'employee.employee_id = employee_training.employee_training_employee_id');
		$this->db->where('employee_training.employee_training_id', $employee_training_id);
		$this->db->where('employee_training.tenant_id', $tenant_id);
		return $this->db->get()->row();

	}

	public function insert_training_result($result_data){
		$this->db->insert('training_result', $result_data);
		return $this->db->insert_id();

	}

	public function update_result($training_id, $employee_training_id, $result_data){
		$this->db->where('training_result.training_result_training_id', $training_id);
		$this->db->where('training_result.training_result_employee_training_id', $employee_training_id);
		$this->db->update('training_result', $result_data);
		return true;
	}

	public function count_pending_leaves($tenant_id) {
	  $this->db->select('*');
	  $this->db->from('employee_leave');
	  $this->db->where('employee_leave.leave_status', 0);
	  $this->db->where('tenant_id', $tenant_id);
	  return $this->db->count_all_results();
  }

  public function count_approved_leaves($tenant_id) {
    $this->db->select('*');
    $this->db->from('employee_leave');
    $this->db->where('employee_leave.leave_status', 1);
    $this->db->where('tenant_id', $tenant_id);
    return $this->db->count_all_results();
  }

  public function count_finished_leaves($tenant_id) {
    $this->db->select('*');
    $this->db->from('employee_leave');
    $this->db->where('employee_leave.leave_status', 2);
    $this->db->where('tenant_id', $tenant_id);
    return $this->db->count_all_results();
  }

  public function get_upcoming_leaves($tenant_id) {
    $this->db->select('*');
    $this->db->from('employee_leave');
    $this->db->where('employee_leave.leave_status', 1);
    $this->db->where('employee_leave.tenant_id', $tenant_id);
    $this->db->join('employee', 'employee.employee_id = employee_leave.leave_employee_id');
    $this->db->join('leave_type', 'leave_type.leave_id = employee_leave.leave_leave_type');
    $this->db->order_by('employee_leave.leave_start_date', 'ASC');
    $this->db->limit(3);
    return $this->db->get()->result();
  }

  public function count_open_queries($tenant_id) {
	  $this->db->select('*');
	  $this->db->from('query');
	  $this->db->where('query.query_status', 1);
	  $this->db->where('tenant_id', $tenant_id);
    return $this->db->count_all_results();
  }

  public function count_pending_trainings($tenant_id) {
	  $this->db->select('*');
	  $this->db->from('employee_training');
	  $this->db->where('employee_training.employee_training_status', 0);
	  $this->db->where('tenant_id', $tenant_id);
    return $this->db->count_all_results();
  }

  public function count_running_appraisals($tenant_id) {
    $this->db->select('*');
    $this->db->from('employee_appraisal');
    $this->db->where('employee_appraisal.employee_appraisal_status', 0);
    $this->db->where('tenant_id', $tenant_id);
    return $this->db->count_all_results();
  }

  public function count_finished_appraisals($tenant_id) {
    $this->db->select('*');
    $this->db->from('employee_appraisal');
    $this->db->where('employee_appraisal.employee_appraisal_status', 1);
    $this->db->where('tenant_id', $tenant_id);
    return $this->db->count_all_results();
  }

}
