<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrasi extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('ModelAdmisi');
    $this->load->model('ModelKunjungan');
  }

  public function index(){
    $admin = $this->db->get_where("biayaadmin",array("idbiaya"=>1))->row_array();
    $data = array(
      'body'            => 'Administrasi/index',
      'form'  => 'Administrasi/form',
      'adm' => $admin
    );
		$this->load->view('index',$data);
  }

  public function update(){
    $data = array(
      'rawat_jalan' => $this->input->post("rajal"),
      'rawat_inap' => $this->input->post("ranap"),
      'rekam_medis' => $this->input->post("medis_rajal"),
      "rekam_medis_ranap" => $this->input->post("medis_ranap"),
      'blanko' => $this->input->post("blanko"),
    );
    $this->db->where("idbiaya",1)
    ->update("biayaadmin",$data);
    redirect(base_url()."Administrasi");
  }

}
