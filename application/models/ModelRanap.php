<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelRanap extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function get_data($tgl){
    $this->db->group_by("no_urutkunjungan");
    $this->db->join('tempat_tidur','tempat_tidur.no_tt=kunjungan.tempat_tidur_no_tt');
    $this->db->join('pasien', 'pasien.noRM = kunjungan.pasien_noRM');
    $this->db->join('tujuan_pelayanan', 'tujuan_pelayanan.kode_tupel = kunjungan.tupel_kode_tupel');
    $this->db->join('rujukan_internal','kunjungan.no_urutkunjungan=rujukan_internal.kunjungan_no_urutkunjungan');
    return $this->db->get_where('kunjungan',array('sudah <'=>5,'tujuan_poli'=>'RANAP','acc_ranap'=>1))->result();
  }
  public function get_data2($tgl){
    $tanggal = date("Y-m-d",strtotime("-28 days"));
    $this->db->order_by("no_urutkunjungan","DESC");
    $this->db->group_by('no_urutkunjungan');
    $this->db->join('tempat_tidur','tempat_tidur.no_tt=kunjungan.tempat_tidur_no_tt');
    $this->db->join('pasien', 'pasien.noRM = kunjungan.pasien_noRM');
    $this->db->join('tujuan_pelayanan', 'tujuan_pelayanan.kode_tupel = kunjungan.tupel_kode_tupel');
    $this->db->join('rujukan_internal','kunjungan.no_urutkunjungan=rujukan_internal.kunjungan_no_urutkunjungan');
    return $this->db->get_where('kunjungan',array('DATE(tgl) >'=>$tanggal,'sudah <='=>5,'tujuan_poli'=>'RANAP','acc_ranap'=>1))->result();
  }
  public function get_data_sudah($tgl){
    $this->db->join('tempat_tidur','tempat_tidur.no_tt=kunjungan.tempat_tidur_no_tt');
    $this->db->join('pasien', 'pasien.noRM = kunjungan.pasien_noRM');
    $this->db->join('tujuan_pelayanan', 'tujuan_pelayanan.kode_tupel = kunjungan.tupel_kode_tupel');
    $this->db->join('rujukan_internal','kunjungan.no_urutkunjungan=rujukan_internal.kunjungan_no_urutkunjungan');
    return $this->db->get_where('kunjungan',array('sudah'=>5,'tujuan_poli'=>'RANAP','acc_ranap'=>1))->result();
  }
  public function get_data_edit($no_urutkunjungan){
    $this->db->join("rujukan_internal","rujukan_internal.kunjungan_no_urutkunjungan=kunjungan.no_urutkunjungan");
    return $this->db->get_where('kunjungan',array('no_urutkunjungan' => $no_urutkunjungan ))->row_array();
  }
  public function get_timbang_terima($nokun){
    return $this->db
    ->get_where('timbang_terima',array('kunjungan_no_urutkunjungan'=>$nokun))->row_array();
  }
  public function get_all_resep1($id){
    $periksa = $this->db->get_where("periksa",array("kunjungan_no_urutkunjungan"=>$id))->result();
    $idperiksa = array();
    foreach ($periksa as $value) {
      array_push($idperiksa,$value->idperiksa);
    }
    // die(var_dump($periksa));
    $resep = $this->db->where_in("periksa_idperiksa",$idperiksa)->get("resep")->result();
    $no_resep = array();
    foreach ($resep as $value) {
      array_push($no_resep,$value->no_resep);
    }
    // die(var_dump($resep));
    return $this->db
    ->join("obat","obat.idobat=detail_resep.obat_idobat")
    ->where_in("resep_no_resep",$no_resep)
    ->get("detail_resep")
    ->result();
  }
  public function get_all_resep($id,$tupel){
    $periksa = $this->db->get_where("periksa",array("kunjungan_no_urutkunjungan"=>$id,'unit_layanan'=>$tupel))->result();
    $idperiksa = array();
    foreach ($periksa as $value) {
      array_push($idperiksa,$value->idperiksa);
    }
    if (empty($idperiksa)) {
      return null;
    }
    // die(var_dump($periksa));
    $resep = $this->db->where_in("periksa_idperiksa",$idperiksa)->get("resep")->result();
    $no_resep = array();
    foreach ($resep as $value) {
      array_push($no_resep,$value->no_resep);
    }
    if (empty($no_resep)) {
      return null;
    }
    // die(var_dump($resep));
    return $this->db
    ->join("obat","obat.idobat=detail_resep.obat_idobat")
    ->where_in("resep_no_resep",$no_resep)
    ->get("detail_resep")
    ->result();
  }
  public function get_all_bhp($id,$tupel){
    $periksa = $this->db->get_where("periksa",array("kunjungan_no_urutkunjungan"=>$id,'unit_layanan'=>$tupel))->result();
    $idperiksa = array();
    foreach ($periksa as $value) {
      array_push($idperiksa,$value->idperiksa);
    }

    return $this->db
    ->join("obat","obat.idobat=pemakaian_obat.id_obat")
    ->where_in("id_periksa",$idperiksa)
    ->get("pemakaian_obat")
    ->result();
  }
  public function get_tindakan($id,$tupel){
    $periksa = $this->db->get_where("periksa",array("kunjungan_no_urutkunjungan"=>$id,'unit_layanan'=>$tupel))->result();
    $idperiksa = array();
    foreach ($periksa as $value) {
      array_push($idperiksa,$value->idperiksa);
    }
    // die(var_dump($periksa));
    $tindakan = $this->db->select("SUM(harga) as jumlah")->where_in("periksa_idperiksa",$idperiksa)->get("tindakan")->row_array();
    return $tindakan['jumlah'];
  }
  public function get_monev($id){
    $periksa = $this->db->get_where("periksa",array("kunjungan_no_urutkunjungan"=>$id))->result();
    $idperiksa = array();
    foreach ($periksa as $value) {
      array_push($idperiksa,$value->idperiksa);
    }
    // die(var_dump($periksa));
    $tindakan = $this->db->where_in("periksa_idperiksa",$idperiksa)->get("tindakan")->result();
    $monev = 0;
    foreach ($tindakan as $value) {
      // code...
       $monev += $value->japel_dokter+$value->japel_perawat+$value->japel_admin+$value->japel_resepsionis;
    }
    return $monev;
  }
  public function get_jurnal_lab($id,$tupel){
    $periksa = $this->db->get_where("periksa",array("kunjungan_no_urutkunjungan"=>$id,'unit_layanan'=>$tupel))->result();
    $idperiksa = array();
    foreach ($periksa as $value) {
      array_push($idperiksa,$value->idperiksa);
    }
    // die(var_dump($periksa));
    $hitung_lab = $this->db->where_in("periksa_idperiksa",$idperiksa)->get("labkunjungan")->num_rows();
    if ($hitung_lab>0) {
      $idlabkun = array();
      $lab = $this->db->where_in("periksa_idperiksa",$idperiksa)->get("labkunjungan")->result();
      foreach ($lab as $value) {
        array_push($idlabkun,$value->nokunjlab);
      }
      $detail_lab = $this->db->select("SUM(harga) as jumlah")->where_in("nourutlab",$idlabkun)->get("detaillab")->row_array();
      return $detail_lab['jumlah'];
    }else{
      return 0;
    }
  }

}
