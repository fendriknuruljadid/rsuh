<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelObat extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function get_data(){
    $this->db->join('jenis_obat',"jenis_obat.idjenis_obat=obat.jenis_obat_idjenis_obat");
    $this->db->join('kategori_obat',"kategori_obat.idkategori_obat=obat.kategori_obat_idkategori_obat");
    return $this->db->get('obat')->result();
  }

  public function get_data_edit($id){
    $this->db->join('jenis_obat',"jenis_obat.idjenis_obat=obat.jenis_obat_idjenis_obat");
    $this->db->join('kategori_obat',"kategori_obat.idkategori_obat=obat.kategori_obat_idkategori_obat");
    return $this->db->get_where('obat',array('idobat'=>$id));
  }
  public function generate_kode($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
  }
  public function get_kadaluarsa()
  {
    $date = date("Y-m-d");
    $batas = date("Y-m-d",strtotime("+30 days"));
    return $this->db
    ->join("obat","obat.idobat=detail_pembelian_obat.obat_idobat")
    ->select("no_batch,nama_obat,idobat,(IFNULL(jumlah,0)-IFNULL(jumlah_terjual,0)) as jumlah,tanggal_expired")
    ->get_where("detail_pembelian_obat",array("DATE(tanggal_expired) >="=>$date,"DATE(tanggal_expired) <="=>$batas,'jumlah !='=>0))
    ->result();
  }
}
