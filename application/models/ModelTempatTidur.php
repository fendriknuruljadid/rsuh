<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelTempatTidur extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function get_data()
  {
    return $this->db->get('tempat_tidur')->result();
  }

  function get_data_edit($id)
  {
    return $this->db->get_where('tempat_tidur', array('no_tt' => $id , ))->row_array();
  }

}
