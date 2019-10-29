<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelHutang extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function get_data(){
    $this->db->join('supplier',"supplier.kode_sup=pembelian_obat.supplier_kode_sup");
    $this->db->join('hutang',"hutang.pembelian_obat_no_nota=pembelian_obat.no_nota");
    return $this->db->get_where('pembelian_obat',array('status'=>'Belum Lunas'))->result();
  }
}
