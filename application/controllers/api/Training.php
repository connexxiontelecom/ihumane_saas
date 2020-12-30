<?php

require APPPATH . 'libraries/REST_Controller.php';

require_once APPPATH . '/libraries/JWT.php';
require_once APPPATH . '/libraries/SignatureInvalidException.php';
class Training extends REST_Controller
{
    /**
     * constructor
     */

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('users');
        $this->load->model('logs');
        $this->load->model('Employees');
        $this->load->helper('security');
    }

    public function fetch_All_Trainings_post()
    {
        $request = $this->post();
        $tenant_id = $request['tenant_id'];
        $headers = $this->input->request_headers();
        $isvalid = $this->verifyAuthToken($headers);
        if ($isvalid) {
            $this->db->select('*');
            $this->db->from('employee_training');
            $this->db->where('employee_training.tenant_id', $tenant_id);
            $this->db->join('employee', 'employee_id = employee_training_employee_id');
            $this->db->join('training', 'training_id = employee_training_training_id');
            $this->db->order_by("employee_training_id", "desc");
            $data = $this->db->get()->result();
            $data = $this->objectToArray($data);
            for ($i = 0; $i < count($data); $i++) {
                $data[$i]['employee_training_start_date'] = $this->formatDate($data[$i]['employee_training_start_date']);
                $data[$i]['employee_training_end_date'] = $this->formatDate($data[$i]['employee_training_end_date']);
            }
            $this->response($data, REST_Controller::HTTP_OK);
        } else {
            $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
        }
    }

    public function fetchMyTrainings_post()
    {
        $request = $this->post();
        $employee_id = $request['id'];
        $tenant_id = $request['tenant_id'];

        $headers = $this->input->request_headers();
        $isvalid = $this->verifyAuthToken($headers);
        if ($isvalid) {

            $this->db->select('*');
            $this->db->from('employee_training');
            $this->db->where('employee_training.tenant_id', $tenant_id);
            $this->db->join('employee', 'employee_id = employee_training_employee_id');
            $this->db->join('training', 'training_id = employee_training_training_id');
            $this->db->where('employee_training.employee_training_employee_id', $employee_id);
            $this->db->order_by("employee_training_id", "desc");
            $data = $this->db->get()->result();
            $data = $this->objectToArray($data);
            for ($i = 0; $i < count($data); $i++) {
                $data[$i]['employee_training_start_date'] = $this->formatDate($data[$i]['employee_training_start_date']);
                $data[$i]['employee_training_end_date'] = $this->formatDate($data[$i]['employee_training_end_date']);
            }
            $this->response($data, REST_Controller::HTTP_OK);
        } else {
            $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
        }
    }

    public function objectToArray($data)
    {
        if (is_object($data)) {
            $data = get_object_vars($data);
        }

        if (is_array($data)) {
            return array_map(array($this, 'objectToArray'), $data);
        }

        return $data;
    }

    public function formatDate($date)
    {
        $newDate = date("d-M-y ", strtotime($date));
        return $newDate;
    }

	public function verifyAuthToken($headers): bool
    {
        try {
            if (array_key_exists('authorization', $headers) && !empty($headers['authorization'])) {
                $decodedToken = AUTHORIZATION::validateToken($headers['authorization']);
                if ($decodedToken != false) {
                    //$this->set_response($decodedToken, REST_Controller::HTTP_OK);
                    return true;
                } else {
                    return false;
                }
			}
			
			else if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
                $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
                if ($decodedToken != false) {
                    //$this->set_response($decodedToken, REST_Controller::HTTP_OK);
                    return true;
                } else {
                    return false;
                }
			}
			
			else {

                return false;
            }
        } catch (Exception $e) {
            //$this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED)
            return false;
        }

    }
}
