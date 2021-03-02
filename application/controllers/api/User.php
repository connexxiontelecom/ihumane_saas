<?php

require APPPATH . 'libraries/REST_Controller.php';
use \Firebase\JWT\JWT;

require_once APPPATH . '/libraries/JWT.php';
require_once APPPATH . '/libraries/SignatureInvalidException.php';
class User extends REST_Controller
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
        $this->load->model('employees');
        $this->load->model('biometric');
    }

    public function privateKey()
    {
        $privateKey = "
            -----BEGIN RSA PRIVATE KEY-----
            MIICXAIBAAKBgQC8kGa1pSjbSYZVebtTRBLxBz5H4i2p/llLCrEeQhta5kaQu/Rn
            vuER4W8oDH3+3iuIYW4VQAzyqFpwuzjkDI+17t5t0tyazyZ8JXw+KgXTxldMPEL9
            5+qVhgXvwtihXC1c5oGbRlEDvDF6Sa53rcFVsYJ4ehde/zUxo6UvS7UrBQIDAQAB
            AoGAb/MXV46XxCFRxNuB8LyAtmLDgi/xRnTAlMHjSACddwkyKem8//8eZtw9fzxz
            bWZ/1/doQOuHBGYZU8aDzzj59FZ78dyzNFoF91hbvZKkg+6wGyd/LrGVEB+Xre0J
            Nil0GReM2AHDNZUYRv+HYJPIOrB0CRczLQsgFJ8K6aAD6F0CQQDzbpjYdx10qgK1
            cP59UHiHjPZYC0loEsk7s+hUmT3QHerAQJMZWC11Qrn2N+ybwwNblDKv+s5qgMQ5
            5tNoQ9IfAkEAxkyffU6ythpg/H0Ixe1I2rd0GbF05biIzO/i77Det3n4YsJVlDck
            ZkcvY3SK2iRIL4c9yY6hlIhs+K9wXTtGWwJBAO9Dskl48mO7woPR9uD22jDpNSwe
            k90OMepTjzSvlhjbfuPN1IdhqvSJTDychRwn1kIJ7LQZgQ8fVz9OCFZ/6qMCQGOb
            qaGwHmUK6xzpUbbacnYrIM6nLSkXgOAwv7XXCojvY614ILTK3iXiLBOxPu5Eu13k
            eUz9sHyD6vkgZzjtxXECQAkp4Xerf5TGfQXGXhxIX52yH+N2LtujCdkQZjXAsGdm
            B2zNzvrlgRmgBrklMTrMYgm1NPcW+bRLGcwgW2PTvNM=
            -----END RSA PRIVATE KEY-----
           ";
        return $privateKey;
    }

    public function index_get()
    {

    }


	public function header_post(){

		 $data =  $this->input->user_agent();
		 $headers =  $this->input->request_headers();
		$this->response(["headers" => $headers], REST_Controller::HTTP_OK);
	}


    public function users_get()
    {
        $this->db->select('*');
        $this->db->from('user');
        $data = $this->db->get()->result();
        $this->response($data, REST_Controller::HTTP_OK);
    }

    public function login_post()
    {
        $req = $this->post();
        /* var_dump($req);  */
        $data = array(
            'user_username' => $req['username'],
            'password' => $req['password'],
        );

        /* Attempt to login  with credentials  */
        $isloggedIn = $this->users->login($data);

        /* If Login Sucessfull Generate Token and Expiry Time */
        if (!empty($isloggedIn) && !is_null($isloggedIn) && $isloggedIn == true) {

            $secret_key = $this->privateKey();
            $issuer_claim = "APP.IHUMANE.NET"; // this can be the servername. Example: https://domain.com
            $audience_claim = "CONNEXXION_GROUP";
            $issuedat_claim = time(); // issued at
            $notbefore_claim = $issuedat_claim + 10; //not before in seconds
            $expire_claim = $issuedat_claim + 3600; // expire time in seconds
            $token = array(
                "iss" => $issuer_claim,
                "aud" => $audience_claim,
                "iat" => $issuedat_claim,
                "nbf" => $notbefore_claim,
                "exp" => $expire_claim,
                "data" => array(
                    "id" => $data['user_username'],
                    "email" => $data['password'],
                ),
            );

            // $token = JWT::encode($token, $secret_key);

            $token = AUTHORIZATION::generateToken($token);

            $response = [
                'status' => 200,
                'message' => 'login success',
                "token" => $token,
                "user_username" => $data["user_username"],
                "expireAt" => $expire_claim,
                "Details" => $this->get_user_details($data["user_username"]),

            ];
            $isemployee = $this->isUserEmployee($data["user_username"]);
            if ($isemployee != false) {
                $response["employee"] = $isemployee;
            }

            //log login action
            $this->AddLog($req['username'], "Logged in");

            $this->response($response, REST_Controller::HTTP_OK);

        }
        /* Return Invalid Login */
        else {
            $this->response(["status" => REST_Controller::HTTP_BAD_REQUEST, "msg" => "Username or Password is not valid"], REST_Controller::HTTP_BAD_REQUEST);
        }

    }

    public function Attendance_get()
    {
        $data = $this->today_present();
        $total = count($data);
        $this->response(["result" => $total], REST_Controller::HTTP_OK);
    }

    public function employee_attendance_get()
    {
        $data = $this->today_present();
        $data = $this->objectToArray($data);
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['employee_biometrics_login_time'] = date('h:i a', strtotime($data[$i]['employee_biometrics_login_time']));
            $data[$i]['date'] = date('d-M-Y', strtotime($data[$i]['employee_biometrics_login_time']));
        }
        $this->response($data, REST_Controller::HTTP_OK);
    }

    public function fetchNotificatiions_post()
    {
        $request = $this->post();
        //$request = $this->head();
        //$this->response($request,REST_Controller::HTTP_OK);
        $employee_id = $request['id'];
        $tenant_id = $request['tenant_id'];
        $data = $this->employees->get_notifications($employee_id, $tenant_id);
        $this->response($data, REST_Controller::HTTP_OK);
    }

    public function updateNotification_post()
    {
        $request = $this->post();
        $notification_id = $request['id'];
        $notification_data = array('notification_status' => 1);
        $this->employees->update_notification($notification_id, $notification_data);
        $this->response(["status" => REST_Controller::HTTP_BAD_REQUEST], REST_Controller::HTTP_OK);
    }

    public function Trainings_post()
    {
        $request = $this->post();
        $tenant_id = $request['tenant_id'];
        $headers = $this->input->request_headers();
        $isvalid = $this->verifyAuthToken($headers);
        if ($isvalid) {
            $data = $this->get_trainings($tenant_id);
            $this->response(["result" => $data], REST_Controller::HTTP_OK);
        } else {
            $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
        }

        // $data = $this->get_trainings($tenant_id);
        // $this->response(["result"=>$data],REST_Controller::HTTP_OK);
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
	
	
    public function MyTrainings_post()
    {
        $request = $this->post();
        $id = $request['id'];
        $tenant_id = $request['tenant_id'];
        $headers = $this->input->request_headers();
        $isvalid = $this->verifyAuthToken($headers);
        if ($isvalid) {
            $data = $this->get_mytrainings($id, $tenant_id);
            $this->response(["result" => $data], REST_Controller::HTTP_OK);
        } else {
            $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
        }
    }

    public function isUserEmployee($username)
    {
        $this->db->select('*');
        $this->db->from('employee');
        $this->db->where('employee_unique_id', $username);
        $this->db->join('grade', 'grade.grade_id = employee.employee_grade_id');
        $this->db->join('job_role', 'job_role.job_role_id = employee.employee_job_role_id');
        $this->db->join('department', 'department.department_id = job_role.department_id');
        $this->db->join('location', 'location.location_id = employee.employee_location_id');
        $this->db->join('subsidiary', 'subsidiary.subsidiary_id = employee.employee_subsidiary_id');
        $this->db->join('bank', 'bank.bank_id = employee.employee_bank_id');
        $result = $this->db->get();
        if ($result->num_rows()) {
            $data = $result->row();
            $data = $this->objectToArray($data);
            if ($data["employee_passport"] != null) {
                $data["employee_passport"] = base_url() . "uploads/employee_passports/" . $data["employee_passport"];
            }
            return $data;
        } else {
            return false;
        }
    }

    public function get_user_details($username)
    {
        $details = $this->_get_user_details($username);
        return $details;
    }

    private function _get_user_details($username)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->join('permission', 'permission.username = user.user_username');
        $this->db->where('user_username', $username);
        $query = $this->db->get();
        return $query->row();
    }

    public function savetoken_post()
    {
        $request = $this->post();
        $user_id = $request["user"];
        $token = $request["token"];
        $tenant_id = $request["tenant_id"];

        $headers = $this->input->request_headers();
        $isvalid = $this->verifyAuthToken($headers);
        if ($isvalid) {

            $query = $this->db->query("UPDATE user SET user_device_token = '$token' WHERE user_id ='$user_id' AND tenant_id = '$tenant_id'");
            if ($query) {
                $this->response(["status" => REST_Controller::HTTP_OK], REST_Controller::HTTP_OK);
            } else {
                $this->response(["status" => REST_Controller::HTTP_BAD_REQUEST], REST_Controller::HTTP_BAD_REQUEST);
            }

        } else {
            $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
        }

    }

    public function gettoken_post()
    {
        $request = $this->post();
        $user_id = $request["user"];
        $query = $this->db->query("SELECT user_device_token FROM  user  WHERE user_id ='$user_id'");
        if ($query) {
            $data = $this->objectToArray($query->result());
            return $data[0]["user_device_token"];
            //$this->response($query->result(), REST_Controller::HTTP_OK);
        } else {
            $this->response(["status" => REST_Controller::HTTP_BAD_REQUEST], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function gettoken($id)
    {
        $request = $this->post();
        $user_id = $request["user"];
        $query = $this->db->query("SELECT user_device_token FROM  user  WHERE user_id ='$id'");
        if ($query) {
            $data = $this->objectToArray($query->result());
            return $data[0]["user_device_token"];
            //$this->response($query->result(), REST_Controller::HTTP_OK);
        } else {
            $this->response(["status" => REST_Controller::HTTP_BAD_REQUEST], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function savepassword_post()
    {

        $request = $this->post();
        $user_id = $request["user"];
        $password = $request["password"];
        $username = $request["username"];
        $tenant_id = $request["tenant_id"];
        $password = password_hash($password, PASSWORD_BCRYPT);
        $headers = $this->input->request_headers();
        $isvalid = $this->verifyAuthToken($headers);
        if ($isvalid) {

            $query = $this->db->query("UPDATE user SET user_password = '$password' WHERE user_id ='$user_id' AND tenant_id = '$tenant_id'");
            if ($query) {
                $this->AddLog($username, "Changed Password");
                $this->response(["status" => REST_Controller::HTTP_OK], REST_Controller::HTTP_OK);
            } else {
                $this->response(["status" => REST_Controller::HTTP_BAD_REQUEST], REST_Controller::HTTP_BAD_REQUEST);
            }
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

    public function today_present()
    {

        $date = date('Y-m-d', time());
        //$date = date('Y-m-d', strtotime("2020-07-22"));
        $data = $this->biometric->check_today_attendance($date);
        $data = $this->objectToArray($data);
        return $data;
    }

    public function get_trainings($tenant_id)
    {
        $this->db->select('*');
        $this->db->from('employee_training');
        $this->db->where('employee_training_status', 0);
        $this->db->where('tenant_id', $tenant_id);
        $result = $this->db->get();
        return $result->num_rows();
    }

    public function get_mytrainings($id, $tenant_id)
    {
        $this->db->select('*');
        $this->db->from('employee_training');
        $this->db->where('employee_training_status', 0);
        $this->db->where('employee_training_employee_id', $id);
        $this->db->where('tenant_id', $tenant_id);
        $result = $this->db->get();
        return $result->num_rows();
    }

    public function AddLog($username, $info)
    {
        $log_array = array(
            'log_user_id' => $this->users->get_user($username)->user_id,
            'log_description' => $info,
        );

        $this->logs->add_log($log_array);
    }

    public function StripFormatting($array, $key)
    {
        for ($i = 0; $i < count($array); $i++) {
            $array[$i][$key] = strip_tags($array[$i][$key]);
        }

        return ($array);
    }

    private function verifyToken($authHeader)
    {
        $secret_key = $this->privateKey();
        $token = null;
		//$authHeader = $this->request->getServer('HTTP_AUTHORIZATION');

        $arr = explode(" ", $authHeader);
        if (!isset($arr[1])) {
            $output = [
                'message' => 'Token not Supplied',
            ];
            return $this->response($output, REST_Controller::HTTP_UNAUTHORIZED);
        } else {
            $token = $arr[1];
        }
        if ($token) {
            try {
                $decoded = JWT::decode($token, $secret_key, array('HS256'));
                // Access is granted.
                if ($decoded) {
                    // response true
                    $output = [
                        'message' => 'Access granted',
                    ];
                    return $this->response($output, REST_Controller::HTTP_ACCEPTED);
                }

            } catch (\Exception $e) {
                $output = [
                    'message' => 'Access denied',
                    "error" => $e->getMessage(),
                ];
                return $this->response($output, REST_Controller::HTTP_FORBIDDEN);
            }
        }
    }

}
