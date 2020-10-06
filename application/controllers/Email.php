<?php

class Email extends CI_Controller{

	public function htmlmail() {
		$userEmail='oamanambu@yahoo.com';
    $subject='Test';
    $config = Array(
      'mailtype' => 'html',
      'charset' => 'utf-8',
      'priority' => '1',
	    'protocol' => 'smtp',
	    'smtp_host' => 'smtp.mailtrap.io',
	    'smtp_port' => 2525,
	    'smtp_user' => 'a67faaa8fd993a',
	    'smtp_pass' => '0929b459b04aa4',
	    'crlf' => "\r\n",
	    'newline' => "\r\n"
    );
    $this->load->library('email', $config);
    $this->email->set_newline("\r\n");

    $this->email->from('CJ Amanambu', 'Connexxion Group');
    $data = array(
      'userName'=> 'Pheonix solutions'
    );
    $this->email->to($userEmail);  // replace it with receiver mail id
    $this->email->subject($subject); // replace it with relevant subject

    $body = $this->load->view('emails/email_template.php',$data,TRUE);
    $this->email->message($body);
    $this->email->send();
	}
}