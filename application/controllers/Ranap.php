<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ranap extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('ModelRanap');
    $this->load->model("ModelAdmisi");
  }

  public function index(){
    $data = array(
      'body'            => 'Ranap/list',
      'kunjungan'       => $this->ModelRanap->get_data(null),
      'kunjungan_sudah' => $this->ModelRanap->get_data_sudah(null),

    );
		$this->load->view('index',$data);
  }
  public function pulang($id=null){
    $this->db->where('no_urutkunjungan',$id);
    $this->db->update('kunjungan',array('siap_pulang'=>1));
    $this->session->set_flashdata('notif',$this->Notif->berhasil("Pasien Telah Siap Di Pulangkan!!!"));
    redirect(base_url()."Ranap");
  }
  public function bataL_pulang($id=null){
    $this->db->where('no_urutkunjungan',$id);
    $this->db->update('kunjungan',array('siap_pulang'=>0));
    $this->session->set_flashdata('notif',$this->Notif->berhasil("Pasien Telah Dibatalkan Pulang!!!"));
    redirect(base_url()."Ranap");
  }
  public function history_tt(){
    $nokun = $this->input->post("nokun");
    $nik = $this->input->post("nik");
    $pasien = $this->db
    ->join("pasien","pasien.noRM=kunjungan.pasien_noRM")
    ->get_where("kunjungan",array("no_urutkunjungan"=>$nokun))->row_array();
    $tt = $this->db
    ->order_by("id_timbangterima","desc")
    ->join("pegawai","pegawai.NIK=timbang_terima.perawat_jaga")
    ->get_where("timbang_terima",array("kunjungan_no_urutkunjungan"=>$nokun))->result();
    $html = "";
    $no = 1;
    $tanggal = date("Y-m-d");
    foreach ($tt as $value) {
      $button_edit = "";

      $tanggal_tt = date("Y-m-d",strtotime($value->waktu_timbangterima));
      if ($nik==$value->NIK && $tanggal==$tanggal_tt) {
        $button_edit = '<a href="'.base_url().'Asesmen/edit_timbang_terima/'.$nokun.'/'.$pasien['noRM'].'/'.$value->id_timbangterima.'"><button type="button" class="btn btn-sm btn-warning">Edit</button></a>';
      }
      $html .= '<tr>
        <td>'.$no++.'</td>
        <td>'.date("d-m-Y",strtotime($value->waktu_timbangterima)).'</td>
        <td>'.date("h:i:s",strtotime($value->waktu_timbangterima)).'</td>
        <td>'.$value->nama.'</td>
        <td><a href="'.base_url().'Asesmen/detail_tt/'.$value->id_timbangterima.'/'.$nokun.'"><button type="button" class="btn btn-sm btn-success">Lihat Detail</button></a>'.$button_edit.'</td>
      </tr>
      ';
    }
    echo $html;
  }
  public function history_periksa(){
    $nokun = $this->input->post("nokun");
    $tt = $this->db
    ->order_by("idperiksa","desc")
    // ->join("pegawai","pegawai.NIK=timbang_terima.perawat_jaga")
    ->get_where("periksa",array("kunjungan_no_urutkunjungan"=>$nokun))->result();
    $html = "";
    $no = 1;
    foreach ($tt as $value) {
      $html .= '<tr>
        <td>'.$no++.'</td>
        <td>'.date("d-m-Y",strtotime($value->tanggal)).'</td>
        <td>'.date("h:i:s",strtotime($value->timestamp)).'</td>
        <td><a href="'.base_url().'PeriksaRanap/index/'.$nokun.'/'.$value->idperiksa.'"><button type="button" class="btn btn-sm btn-success">Lihat Detail</button></a></td>
      </tr>
      ';
    }
    echo $html;
  }

}
