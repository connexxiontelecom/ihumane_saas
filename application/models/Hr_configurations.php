<?php


class Hr_configurations extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('form_validation');
		$this->load->library('session');

	}

	// Bank setup begin
	public function add_bank($bank_data){

		$this->db->insert('bank', $bank_data);
		return true;
	}

	public function update_bank($bank_id, $bank_data){

		$this->db->where('bank.bank_id', $bank_id);
		$this->db->update('bank', $bank_data);
		return true;


	}

	public function view_banks($tenant_id){

		$this->db->select('*');
		$this->db->from('bank');
		$this->db->where('tenant_id', $tenant_id);
		return $this->db->get()->result();

	}

	public function view_bank($bank_id, $tenant_id){
		$this->db->select('*');
		$this->db->from('bank');
		$this->db->where('bank_id', $bank_id);
		$this->db->where('tenant_id', $tenant_id);
		$query = $this->db->get();
		return $query->row();

	}

	//Bank setup end

	// Grade setup begin
	public function add_grade($grade_data){

		$this->db->insert('grade', $grade_data);
		return true;
	}

	public function update_grade($grade_id, $grade_data){

		$this->db->where('grade.grade_id', $grade_id);
		$this->db->update('grade', $grade_data);
		return true;


	}

	public function view_grades($tenant_id){

		$this->db->select('*');
		$this->db->from('grade');
		$this->db->where('tenant_id', $tenant_id);
		return $this->db->get()->result();

	}

	public function view_grade($grade_id, $tenant_id){
		$this->db->select('*');
		$this->db->from('grade');
		$this->db->where('grade_id', $grade_id);
		$this->db->where('tenant_id', $tenant_id);
		$query = $this->db->get();
		return $query->row();

	}

	//Grade setup end

	//location setup begin
	public function add_location($location_data){

		$this->db->insert('location', $location_data);
		return true;
	}

	public function update_location($location_id, $location_data){

		$this->db->where('location.location_id', $location_id);
		$this->db->update('location', $location_data);
		return true;


	}

	public function view_locations($tenant_id){

		$this->db->select('*');
		$this->db->from('location');
		$this->db->where('tenant_id', $tenant_id);
		return $this->db->get()->result();

	}

	public function view_location($location_id){
		$this->db->select('*');
		$this->db->from('location');
		$this->db->where('location_id', $location_id);
		$query = $this->db->get();
		return $query->row();

	}

	//subsidiary setup end

	public function add_subsidiary($subsidiary_data){

		$this->db->insert('subsidiary', $subsidiary_data);
		return true;
	}

	public function update_subsidiary($subsidiary_id, $subsidiary_data){

		$this->db->where('subsidiary.subsidiary_id', $subsidiary_id);
		$this->db->update('subsidiary', $subsidiary_data);
		return true;


	}

	public function view_subsidiarys($tenant_id){

		$this->db->select('*');
		$this->db->from('subsidiary');
		$this->db->where('tenant_id', $tenant_id);
		return $this->db->get()->result();

	}

	public function view_subsidiary($subsidiary_id){
		$this->db->select('*');
		$this->db->from('subsidiary');
		$this->db->where('subsidiary_id', $subsidiary_id);
		$query = $this->db->get();
		return $query->row();

	}

	//subsidiary setup end


	//Leava setup end

	public function add_leave($leave_data){

		$this->db->insert('leave_type', $leave_data);
		return true;
	}

	public function update_leave($leave_id, $leave_data){

		$this->db->where('leave_type.leave_id', $leave_id);
		$this->db->update('leave_type', $leave_data);
		return true;


	}

	public function view_leaves($tenant_id){

		$this->db->select('*');
		$this->db->from('leave_type');
		$this->db->where('tenant_id', $tenant_id);
		return $this->db->get()->result();

	}

	public function view_leave($leave_id){
		$this->db->select('*');
		$this->db->from('leave_type');
		$this->db->where('leave_id', $leave_id);
		$query = $this->db->get();
		return $query->row();

	}

	//subsidiary setup end

	//qualification setup begin
	public function add_qualification($qualification_data){

		$this->db->insert('qualification', $qualification_data);
		return true;
	}

	public function update_qualification($qualification_id, $qualification_data){

		$this->db->where('qualification.qualification_id', $qualification_id);
		$this->db->update('qualification', $qualification_data);
		return true;


	}

	public function view_qualifications($tenant_id){

		$this->db->select('*');
		$this->db->from('qualification');
		$this->db->where('tenant_id', $tenant_id);
		return $this->db->get()->result();

	}

	public function view_qualification($qualification_id){
		$this->db->select('*');
		$this->db->from('bank');
		$this->db->where('qualification_id', $qualification_id);
		$query = $this->db->get();
		return $query->row();

	}

	//qualification setup end

	//department setup begin
	public function add_department($department_data){

		$this->db->insert('department', $department_data);
		return true;
	}

	public function update_department($department_id, $department_data){

		$this->db->where('department.department_id', $department_id);
		$this->db->update('department', $department_data);
		return true;


	}

	public function view_departments($tenant_id){

		$this->db->select('*');
		$this->db->from('department');
		$this->db->where('tenant_id', $tenant_id);
		return $this->db->get()->result();

	}

	public function view_department($department_id){
		$this->db->select('*');
		$this->db->from('department');
		$this->db->where('department_id', $department_id);
		$query = $this->db->get();
		return $query->row();

	}

	//department setup end

	//job_role setup begin
	public function add_job_role($job_role_data){

		$this->db->insert('job_role', $job_role_data);
		return true;
	}

	public function update_job_role($job_role_id, $job_role_data){

		$this->db->where('job_role.job_role_id', $job_role_id);
		$this->db->update('job_role', $job_role_data);
		return true;


	}

	public function view_job_roles($tenant_id){

		$this->db->select('*');
		$this->db->from('job_role');
		$this->db->where('job_role.tenant_id', $tenant_id);
		$this->db->join('department', 'department.department_id = job_role.department_id');

		return $this->db->get()->result();

	}

	public function view_job_role($job_role_id, $tenant_id){
		$this->db->select('*');
		$this->db->from('job_role');
		$this->db->where('job_role_id', $job_role_id);
		$this->db->join('department', 'department.department_id = job_role.department_id');
		$this->db->where('job_role.tenant_id', $tenant_id);
		$query = $this->db->get();
		return $query->row();

	}

	//job_role setup end

	//pension setup begin
	public function add_pension($pension_data){

		$this->db->insert('pension', $pension_data);
		return true;
	}

	public function update_pension($pension_id, $pension_data){

		$this->db->where('pension.pension_id', $pension_id);
		$this->db->update('pension', $pension_data);
		return true;


	}

	public function view_pensions($tenant_id){

		$this->db->select('*');
		$this->db->from('pension');
		$this->db->where('tenant_id', $tenant_id);
		return $this->db->get()->result();

	}

	public function view_pension($pension_id){
		$this->db->select('*');
		$this->db->from('pension');
		$this->db->where('pension_id', $pension_id);
		$query = $this->db->get();
		return $query->row();

	}

	//pension setup end



	//Health Insurance setup begin
	public function add_health_insurance($health_insurance_data){

		$this->db->insert('health_insurance', $health_insurance_data);
		return true;
	}


	public function update_health_insurance($health_insurance_id, $health_insurance_data){

		$this->db->where('health_insurance.health_insurance_id', $health_insurance_id);
		$this->db->update('health_insurance', $health_insurance_data);
		return true;


	}

	public function view_health_insurances($tenant_id){

		$this->db->select('*');
		$this->db->from('health_insurance');
		$this->db->where('tenant_id', $tenant_id);
		return $this->db->get()->result();

	}

	public function view_health_insurance($health_insurance_id){
		$this->db->select('*');
		$this->db->from('health_insurance');
		$this->db->where('health_insurance_id', $health_insurance_id);
		$query = $this->db->get();
		return $query->row();

	}

	//Health Insurance setup end


	//self assessment setup begin
	public function add_self_assessment($assessment_data){

		$this->db->insert('self_appraisee', $assessment_data);
		return true;
	}

	public function update_self_assessment($assessment_id, $assessment_data){

		$this->db->where('self_appraisee.self_appraisee_id', $assessment_id);
		$this->db->update('self_appraisee', $assessment_data);
		return true;


	}

	public function view_self_assessments($tenant_id){

		$this->db->select('*');
		$this->db->from('self_appraisee');
		$this->db->where('tenant_id', $tenant_id);
		return $this->db->get()->result();

	}

	public function view_self_assessment($assessment_id, $tenant_id){
		$this->db->select('*');
		$this->db->from('self_appraisee');
		$this->db->where('self_appraisee_id', $assessment_id);
		$this->db->where('tenant_id', $tenant_id);
		$query = $this->db->get();
		return $query->row();

	}


	//qualitative assessment setup begin
	public function add_qualitative_assessment($qualitative_assessment_data){

		$this->db->insert('qualitative', $qualitative_assessment_data);
		return true;
	}

	public function update_qualitative_assessment($assessment_id, $assessment_data){

		$this->db->where('qualitative.qualitative_id', $assessment_id);
		$this->db->update('qualitative', $assessment_data);
		return true;


	}

	public function view_qualitative_assessments($tenant_id){

		$this->db->select('*');
		$this->db->from('qualitative');
		$this->db->where('tenant_id', $tenant_id);
		return $this->db->get()->result();

	}

	public function view_qualitative_assessment($assessment_id, $tenant_id){
		$this->db->select('*');
		$this->db->from('qualitative');
		$this->db->where('qualitative_id', $assessment_id);
		$this->db->where('tenant_id', $tenant_id);
		$query = $this->db->get();
		return $query->row();

	}

	//supervisor assessment setup begin
	public function add_supervisor_assessment($supervisor_assessment_data){

		$this->db->insert('supervisor_appraisee', $supervisor_assessment_data);
		return true;
	}

	public function update_supervisor_assessment($assessment_id, $assessment_data){

		$this->db->where('supervisor_appraisee.supervisor_appraisee_id', $assessment_id);
		$this->db->update('supervisor_appraisee', $assessment_data);
		return true;


	}

	public function view_supervisor_assessments($tenant_id){

		$this->db->select('*');
		$this->db->from('supervisor_appraisee');
		$this->db->where('tenant_id', $tenant_id);
		return $this->db->get()->result();

	}

	public function view_supervisor_assessment($assessment_id, $tenant_id){
		$this->db->select('*');
		$this->db->from('supervisor_appraisee');
		$this->db->where('supervisor_appraisee_id', $assessment_id);
		$this->db->where('tenant_id', $tenant_id);
		$query = $this->db->get();
		return $query->row();

	}

	//supervisor assessment setup begin
	public function add_quantitative_assessment($quantitative_assessment_data){

		$this->db->insert('quantitative', $quantitative_assessment_data);
		return true;
	}

	public function update_quantitative_assessment($assessment_id, $assessment_data){

		$this->db->where('quantitative.quantitative_id', $assessment_id);
		$this->db->update('quantitative', $assessment_data);
		return true;


	}

	public function view_quantitative_assessments($job_role_id, $tenant_id){

		$this->db->select('*');
		$this->db->from('quantitative');
		$this->db->where('quantitative_job_role_id', $job_role_id);
		$this->db->where('tenant_id', $tenant_id);
		return $this->db->get()->result();

	}

	public function view_quantitative_assessment($assessment_id, $tenant_id){
		$this->db->select('*');
		$this->db->from('quantitative');
		$this->db->where('quantitative_id', $assessment_id);
		$this->db->where('tenant_id', $tenant_id);
		$query = $this->db->get();
		return $query->row();

	}

	public function view_trainings($tenant_id){
		$this->db->select('*');
		$this->db->from('training');
		$this->db->where('tenant_id', $tenant_id);
		return $this->db->get()->result();


	}

	public function view_training($training_id, $tenant_id){
		$this->db->select('*');
		$this->db->from('training');
		$this->db->where('training_id', $training_id);
		$this->db->where('tenant_id', $tenant_id);
		$query = $this->db->get();
		return $query->row();

	}

	public function add_training($training_data){

		$this->db->insert('training', $training_data);
		return $this->db->insert_id();
	}

	public function update_training($training_id, $training_data){

		$this->db->where('training.training_id', $training_id);
		$this->db->update('training', $training_data);
		return true;


	}

	public function view_training_materials($training_id, $tenant_id){
		$this->db->select('*');
		$this->db->from('training_material');
		$this->db->where('training_material_training_id', $training_id);
		$this->db->where('tenant_id', $tenant_id);
		return $this->db->get()->result();
	}

	public function add_training_materials($material_data){

		$this->db->insert('training_material', $material_data);
		return $this->db->insert_id();

	}

	public function remove_material($material_id){
		$this->db->delete('training_material', array('training_material_id' => $material_id));
		return true;
	}

	public function view_training_questions($training_id, $tenant_id){
		$this->db->select('*');
		$this->db->from('training_question');
		$this->db->where('training_question_training_id', $training_id);
		$this->db->where('tenant_id', $tenant_id);
		return $this->db->get()->result();
	}

	public function add_question($question_data){

		$this->db->insert('training_question', $question_data);
		return $this->db->insert_id();

	}

	public function update_question($question_id, $question_data){

		$this->db->where('training_question.training_question_id', $question_id);
		$this->db->update('training_question', $question_data);
		return true;


	}


	public function add_hr_document($document_data){

		$this->db->insert('hr_document', $document_data);
		return $this->db->insert_id();

	}

	public function view_hr_documents($tenant_id){
		$this->db->select('*');
		$this->db->from('hr_document');
		$this->db->where('tenant_id', $tenant_id);
		return $this->db->get()->result();
	}

	public function view_hr_document($document_id, $tenant_id){
			$this->db->select('*');
			$this->db->from('hr_document');
			$this->db->where('hr_document_id', $document_id);
			$this->db->where('tenant_id', $tenant_id);
			return $this->db->get()->row();

	}

	public function remove_hr_document($document_id){
		$this->db->delete('hr_document', array('hr_document_id' => $document_id));
		return true;
	}




}
