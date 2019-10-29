<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelAdmisi extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function get_antrian($jenis,$status){
    $tanggal = date("Y-m-d");
    return $this->db->get_where('antrian_loket',array('tanggal'=>$tanggal,'jenis_kunjungan'=>$jenis,'panggilan'=>$status))->result();
  }
  public function get_data($tgl){
    $this->db->distinct();
    $this->db->group_by("no_urutkunjungan");
    $this->db->join('pasien', 'pasien.noRM = kunjungan.pasien_noRM');
    $this->db->join('tujuan_pelayanan', 'tujuan_pelayanan.kode_tupel = kunjungan.tupel_kode_tupel');
    $this->db->join('rujukan_internal','kunjungan.no_urutkunjungan=rujukan_internal.kunjungan_no_urutkunjungan');
    return $this->db->get_where('kunjungan',array('sudah <='=>5,'tujuan_poli'=>'RANAP','acc_ranap'=>0))->result();
  }
  public function hit_data($tgl){
    $this->db->distinct();
    $this->db->group_by("no_urutkunjungan");
    $this->db->join('pasien', 'pasien.noRM = kunjungan.pasien_noRM');
    $this->db->join('tujuan_pelayanan', 'tujuan_pelayanan.kode_tupel = kunjungan.tupel_kode_tupel');
    $this->db->join('rujukan_internal','kunjungan.no_urutkunjungan=rujukan_internal.kunjungan_no_urutkunjungan');
    return $this->db->get_where('kunjungan',array('sudah <='=>5,'tujuan_poli'=>'RANAP','acc_ranap'=>0))->num_rows();
  }

  public function get_data_sudah($tgl){
    $tanggal = date("Y-m-d",strtotime("-14 days"));
    $this->db->distinct();
    $this->db->group_by("kunjungan.no_urutkunjungan");
    $this->db->order_by("kunjungan_no_urutkunjungan","DESC");
    $this->db->join("tempat_tidur","tempat_tidur.no_tt=kunjungan.tempat_tidur_no_tt");
    $this->db->join('pasien', 'pasien.noRM = kunjungan.pasien_noRM');
    $this->db->join('tujuan_pelayanan', 'tujuan_pelayanan.kode_tupel = kunjungan.tupel_kode_tupel');
    $this->db->join('rujukan_internal','kunjungan.no_urutkunjungan=rujukan_internal.kunjungan_no_urutkunjungan');
    return $this->db->get_where('kunjungan',array('DATE(tgl) >'=>$tanggal,'sudah <'=>5,'tujuan_poli'=>'RANAP','acc_ranap'=>1))->result();
  }
  public function get_data_edit($no_urutkunjungan){
    $this->db->join("rujukan_internal","rujukan_internal.kunjungan_no_urutkunjungan=kunjungan.no_urutkunjungan");
    return $this->db->get_where('kunjungan',array('no_urutkunjungan' => $no_urutkunjungan ))->row_array();
  }
  public function get_detail($id){
    $this->db->join('pasien','kunjungan.pasien_noRM=pasien.noRM');
    $this->db->get_where('kunjungan',array('no_urutkunjungan'=>$id))->row_array();
  }
  public function get_pasien($id){
    $this->db->join('pasien',"kunjungan.pasien_noRM=pasien.noRM");
    return $this->db->get_where('kunjungan',array('no_urutkunjungan'=>$id))->row_array();
  }
  public function get_kamar(){
    return $this->db->get_where('tempat_tidur',array('status_terisi'=>0))->result();
  }


}
