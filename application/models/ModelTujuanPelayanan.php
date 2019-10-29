<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelTujuanPelayanan extends CI_Model{

  function get_data()
  {
    return $this->db->query("SELECT * FROM `tujuan_pelayanan` WHERE polisakit != 2 ORDER BY tujuan_pelayanan DESC")->result();
  }
  public function get_data_edit($id){
    return $this->db->get_where('tujuan_pelayanan',array('kode_tupel'=>$id));
  }


}
