<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelPegawai extends CI_Model{

  public function __construct()
  {
    parent::__construct();


  }

  public function get_data(){
    return $this->db->get('pegawai')->result();
  }

  public function get_data_edit($nik)
  {
    return $this->db->get_where('pegawai', array('NIK' => $nik))->row_array();
  }

}
