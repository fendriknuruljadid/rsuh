<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelSupplier extends CI_Model{

  function get_data()
  {
    return $this->db->get('supplier')->result();
  }

  function get_data_edit($kode)
  {
    return $this->db->get_where('supplier', array('kode_sup' => $kode , ))->row_array();
  }

}
