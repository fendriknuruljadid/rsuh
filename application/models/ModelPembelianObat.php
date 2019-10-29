<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelPembelianObat extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function get_data(){
    $this->db->order_by('no_nota',"DESC");
    $this->db->join('supplier','supplier.kode_sup=pembelian_obat.supplier_kode_sup');
    return $this->db->get('pembelian_obat')->result();
  }

  public function get_data_edit($id){
    $this->db->join('hutang','pembelian_obat.no_nota=hutang.pembelian_obat_no_nota');
    return $this->db->get_where('pembelian_obat',array('no_nota'=>$id));
  }
  public function generate_no_nota(){
    $get_data = $this->db->select_max("no_nota")->get('pembelian_obat')->row_array();
    if($get_data){
      $kode = (int) $get_data['no_nota'];
      $kode = $kode+1;
      $kode_nota = str_pad($kode,11,"0",STR_PAD_LEFT);
    }else{
      $kode_nota = "00000000001";
    }
    return $kode_nota;
  }

  public function get_detail_nota($no_nota){

    $this->db->join('supplier','supplier.kode_sup=pembelian_obat.supplier_kode_sup');
    $this->db->join('detail_pembelian_obat',"detail_pembelian_obat.pembelian_obat_no_nota=pembelian_obat.no_nota");
    $this->db->join('obat',"detail_pembelian_obat.obat_idobat=obat.idobat");
    $this->db->join('hutang',"pembelian_obat.no_nota=hutang.pembelian_obat_no_nota");
    // $this->db->group_by("obat.idobat");
    return $this->db->get_where('pembelian_obat',array('no_nota'=>$no_nota))->result();
  }
  public function get_detail($no_nota){
    $this->db->join('obat','obat.idobat=detail_pembelian_obat.obat_idobat');
    return $this->db->get_where('detail_pembelian_obat',array('pembelian_obat_no_nota'=>$no_nota))->result();
  }
}
