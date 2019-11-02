<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class Register extends REST_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('mregister/Register_model');
		//$this->load->model('mregister/Email_model');
		//$this->load->library('email');
		$this->load->database();
	}
	public function daftar_post(){

		$data = array(
			'nama' => $this->post('nama'),
			'telepon' => $this->post('telepon'),
			'email' => $this->post('email'),
			'password' => $this->post('password'),

			);
		//$negara = $this->post('negara');
		//$jumlah = $this->Register_model->select_email($data['email']);
		/*foreach ($jumlah as $value) {
			echo "$value <br>";
		}*/
		if($jumlah>0)
		{
			$this->response(array('status'=>'fail1',502));
		}
		else
		{
			$success = $this->Register_model->insert_register_user($data);
			//$user = $this->Register_model->get_user_byemail($data['email']);
			//$this->Register_model->insert_negara($negara,$user['id_user']);


		}
	}

}

?>
