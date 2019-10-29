<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelJasaPelayanan extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function get_data(){
    return $this->db->get('jasa_pelayanan')->result();
  }

  public function get_data_edit($id){
    return $this->db->get_where('jasa_pelayanan',array('kode_jasa'=>$id));
  }
}
