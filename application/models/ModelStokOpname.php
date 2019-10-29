<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelStokOpname extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function list_batch($id_obat)
  {
    $this->db->where("idobat",$id_obat);
    return $this->db->get("list_batch");
  }

  public function get_list_stokopname()
  {
    return $this->db->get("stok_opname");
  }

}
