<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelKunjungan extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }
  public function get_data_jenis($id){
    return $this->db
    ->select("jenis_pasien.*")
    ->join("jenis_pasien","kunjungan.sumber_dana=jenis_pasien.kode_jenis")
    ->get_where("kunjungan",array("no_urutkunjungan"=>$id))->row_array();
  }

  public function get_data($tgl){
    $poli = $_SESSION['poli'];
    $this->db->join('pasien', 'pasien.noRM = kunjungan.pasien_noRM');

    $this->db->join('pegawai', 'pegawai.NIK = kunjungan.pegawai_NIK');
    $this->db->join('tujuan_pelayanan', 'tujuan_pelayanan.kode_tupel = kunjungan.tupel_kode_tupel');
    if ($poli == null) {
      $this->db->where(array('sudah' => 0, 'tgl'=>$tgl,'acc_ranap !='=>1));
    }else {
      $this->db->where(array('sudah' => 0, 'tgl'=>$tgl, 'tupel_kode_tupel' => $poli ,'acc_ranap !='=>1));
    }
    // $this->db->where('acc_ranap !=',1);
    return $this->db->get('kunjungan')->result();
  }

  public function get_data_sudah($tgl){
    $poli = $_SESSION['poli'];
    $poliwhere = "";
    if ($poli == null) {
      $poliwhere = "";
    }else{
      $poliwhere = "&& kunjungan.tupel_kode_tupel = '$poli'";
    }
    $query = $this->db->query("Select * from kunjungan,tujuan_pelayanan,pegawai, pasien where sudah != 0 && pegawai.NIK=kunjungan.pegawai_NIK && kunjungan.pasien_noRM = pasien.noRM && tujuan_pelayanan.kode_tupel = kunjungan.tupel_kode_tupel && kunjungan.tgl = '$tgl'".$poliwhere);
    return $query->result();
  }
  public function get_data1($tgl){
    $poli = $_SESSION['poli'];

    $this->db->join('pegawai', 'pegawai.NIK = kunjungan.pegawai_NIK');
    $this->db->join('pasien', 'pasien.noRM = kunjungan.pasien_noRM');
    $this->db->join('tujuan_pelayanan', 'tujuan_pelayanan.kode_tupel = kunjungan.tupel_kode_tupel');
    if ($poli == null) {
      $this->db->where(array('sudah' => 0, 'tgl'=>$tgl,'acc_ranap !='=>1));
    }else {
      $this->db->where(array('sudah' => 0, 'tgl'=>$tgl,'pegawai_NIK'=>$_SESSION['nik'], 'tupel_kode_tupel' => $poli ,'acc_ranap !='=>1));
    }
    // die(var_dump($_SESSION['poli']));
    // $this->db->where('acc_ranap !=',1);
    return $this->db->get('kunjungan')->result();
  }

  public function get_data_sudah1($tgl){
    $poli = $_SESSION['poli'];
    $poliwhere = "";
    if ($poli == null) {
      $poliwhere = "";
    }else{
      $poliwhere = "&& kunjungan.tupel_kode_tupel = '$poli' && pegawai_NIK = '".$_SESSION['nik']."'";
    }
    $query = $this->db->query("Select * from kunjungan,tujuan_pelayanan, pasien,pegawai where sudah != 0 && pegawai.NIK=kunjungan.pegawai_NIK && kunjungan.pasien_noRM = pasien.noRM && tujuan_pelayanan.kode_tupel = kunjungan.tupel_kode_tupel && kunjungan.tgl = '$tgl'".$poliwhere);
    return $query->result();
  }


  function max_no($tupel)
  {
    $tgl = date('Y-m-d');
    $this->db->select_max('no_antrian');
    $this->db->where(array('tgl' => $tgl , 'pegawai_NIK' => $tupel ));
    $result = $this->db->get('kunjungan');
    return $result;
  }

  function total($tupel)
  {
    $date = date('Y-m-d');
    $query = $this->db->query("Select * from kunjungan where tgl = '$date' and tupel_kode_tupel = '$tupel'");
    return $query->num_rows();
  }

  public function get_data_edit($no_urutkunjungan){
    return $this->db->get_where('kunjungan',array('no_urutkunjungan' => $no_urutkunjungan ))->row_array();
  }
  public function get_data_edit_baru($no_urutkunjungan){
    return $this->db
    ->join("tempat_tidur","tempat_tidur.no_tt=kunjungan.tempat_tidur_no_tt")
    ->get_where('kunjungan',array('no_urutkunjungan' => $no_urutkunjungan ))->row_array();
  }
  public function get_data_edit_ranap($no_urutkunjungan){
    return $this->db
    ->join("tempat_tidur","kunjungan.tempat_tidur_no_tt=tempat_tidur.no_tt")
    ->get_where('kunjungan',array('no_urutkunjungan' => $no_urutkunjungan ))->row_array();
  }

  function riwayat($noRM)
  {
    $this->db->where('pasien_noRM', $noRM);
    return $this->db->get('kunjungan');
  }

}
