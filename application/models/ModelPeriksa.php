<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelPeriksa extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }
  // function get_tindakan($idperiksa){
  //   return $this->db
  //   ->get_where("tindakan",array("periksa_idperiksa"=>$idperiksa))->result();
  // }
  // function get_diagnosa($idperiksa){
  //   return $this->db
  //   ->join("penyakit","penyakit.kodeicdx=diagnosa.kodesakit")
  //   ->get_where("diagnosa",array("periksa_idperiksa"=>$idperiksa))->result();
  // }
  function get_data_edit($idperiksa){
    return $this->db->get_where('periksa',array('idperiksa'=>$idperiksa))->row_array();
  }
  function get_periksa_pasien($periksa)
  {
    $this->db->where(array('kunjungan_no_urutkunjungan' => $periksa, ));
    return $this->db->get('periksa')->row_array();
  }

  function get_diagnosa($periksa)
  {
    $this->db->join('penyakit', 'penyakit.kodeicdx = diagnosa.kodesakit');
    $this->db->where(array('periksa_idperiksa' => $periksa, ));
    return $this->db->get('diagnosa');
  }

  function get_tindakan($periksa)
  {
    $this->db->where(array('periksa_idperiksa' => $periksa, ));
    return $this->db->get('tindakan');
  }

  function get_lab($periksa)
  {
    $this->db->where('periksa_idperiksa', $periksa);
    $lab = $this->db->get('labkunjungan')->row_array();
    return $this->db->get_where('detaillab', array('nourutlab' => $lab['nokunjlab']));
  }
  function get_bhp($periksa)
  {
    $this->db->join("obat","obat.idobat=pemakaian_obat.id_obat");
    $this->db->where_in('id_periksa', $periksa);
    return $this->db->get('pemakaian_obat');
  }
  public function get_resep($periksa){
    $resep = $this->db->get_where('resep',array('periksa_idperiksa'=>$periksa))->row_array();
    $this->db->join('resep','resep.no_resep=detail_resep.resep_no_resep');
    $this->db->join('obat','obat.idobat=detail_resep.obat_idobat');
    return $this->db->get_where('detail_resep',array('resep_no_resep'=>$resep['no_resep']));
  }

  function get_riwayat_obgyn($pasien)
  {
    $this->db->where('pasien_noRM', $pasien);
    return $this->db->get('riwayat_obgyn');
  }

  function get_riwayat_penyakit($no_rm){
    $this->db->join('penyakit','diagnosa.kodesakit=penyakit.kodeicdx');
    return $this->db->get_where('diagnosa',array('pasien_noRM'=>$no_rm))->result();
  }

  function get_riwayat_kunjungan($no_rm){
    $this->db->join('tujuan_pelayanan','kunjungan.tupel_kode_tupel=tujuan_pelayanan.kode_tupel');
    return $this->db->get_where('kunjungan',array('pasien_noRM'=>$no_rm))->result();
  }

  function get_bhp_batch($idobat){
    return $this->db
    ->get_where("list_batch",array("idobat"=>$idobat,"stok >"=>0))->result();
  }
}
