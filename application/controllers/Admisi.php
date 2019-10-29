<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admisi extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('ModelAdmisi');
    $this->load->model('ModelKunjungan');
  }

  public function index(){
    $data = array(
      'body'            => 'Admisi/list',
      'kunjungan'       => $this->ModelAdmisi->get_data(null),
      'kunjungan_sudah' => $this->ModelAdmisi->get_data_sudah(null),
      'kamar' => $this->ModelAdmisi->get_kamar(),
    );
		$this->load->view('index',$data);
  }

  public function proses($id=null){
    $data_pasien = $this->ModelAdmisi->get_detail($id);
    $data = array(
      'body' => 'Admisi/proses',
      'data' => $data_pasien,
      'kamar' => $this->ModelAdmisi->get_kamar(),
      'pasien' => $this->ModelAdmisi->get_pasien($id)
    );
		$this->load->view('index',$data);
  }

  public function setuju(){
    $nokun = $this->uri->segment(3);
    $nama_wali = $this->input->post("namawali");
    $ktp = $this->input->post("ktp");
    $alamat = $this->input->post("alamat");
    $telp  = $this->input->post("telp");
    $kamar = $this->input->post("kamar");
    $data = array(
      'wali_ranap' => strtoupper($nama_wali),
      'ktp_wali' => $ktp,
      'acc_ranap' => 1,
      'alamat_wali'=> strtoupper($alamat),
      'tlp_wali' => $telp,
      'ttd_wali' => $this->input->post('signature'),
      'tempat_tidur_no_tt' => $kamar,
      'sts_wali' => $this->input->post('setuju'),
    );
    $this->db->where('no_urutkunjungan',$nokun);
    $this->db->update('kunjungan',$data);
    $this->db->where('no_tt',$kamar);
    $this->db->update('tempat_tidur',array('status_terisi'=>1));
    $update2 = array(
      'id_bed' => $kamar,
      'tanggal' => date("Y-m-d"),
      'id_kunjungan' => $nokun
    );
    $this->db->insert("riwayat_pindahkamar",$update2);
    $this->session->set_flashdata('notif',$this->Notif->berhasil("Proses admisi berhasil dilakukan"));
    redirect(base_url()."Admisi");
  }
  public function pindah($nokun,$kamar){
    $kunjungan = $this->ModelKunjungan->get_data_edit($nokun);
    $this->db->where('no_tt',$kunjungan['tempat_tidur_no_tt']);
    $this->db->update('tempat_tidur',array('status_terisi'=>0));
    $data = array(
      'tempat_tidur_no_tt' => $kamar,
    );
    $this->db->reset_query();
    $this->db->where(array('id_kunjungan'=>$nokun,'id_bed'=>$kunjungan['tempat_tidur_no_tt']));
    $this->db->update('riwayat_pindahkamar',array("tanggal_akhir"=>date("Y-m-d")));
    $this->db->reset_query();
    $this->db->where('no_urutkunjungan',$nokun);
    $this->db->update('kunjungan',$data);
    $update2 = array(
      'id_bed' => $kamar,
      'tanggal' => date("Y-m-d"),
      'id_kunjungan' => $nokun
    );
    $this->db->insert("riwayat_pindahkamar",$update2);
    $this->db->where('no_tt',$kamar);
    $this->db->update('tempat_tidur',array('status_terisi'=>1));
    $this->session->set_flashdata('notif',$this->Notif->berhasil("Pasien telah dipindah ke kamar lain"));
    redirect(base_url()."Admisi");
  }
  public function signature(){
    $data = array(
      'kunjungan' => $this->ModelAdmisi->get_data(null)
    );
    // die(var_dump($data['kunjungan']));
    $this->load->view("Admisi/signature",$data);
  }
  public function buat_signature(){
    $nokun = $this->input->post('nokun');
    $signature = $this->input->post('ttd');
    // echo $signature;
    $hit = $this->db->get_where('kunjungan',array('no_urutkunjungan'=>$nokun))->num_rows();
    if ($hit == 0) {
      $this->session->set_flashdata('pesan',"0");
      redirect(base_url()."Admisi/signature");
    }else{
      $this->load->view("vendor/autoload.php");
      $options = array(
        'cluster' => 'ap1',
        'useTLS' => true
      );
      $pusher = new Pusher\Pusher(
        '58f10ec738925cc9cf18',
        '989571a4920f2374328e',
        '627660',
        $options
      );
      $data = array(
        'gambar' => $signature,
        'nokun' => $nokun
      );
      $pusher->trigger('ci_pusher2', 'my-event2',$data);

      $this->session->set_flashdata('pesan',"1");
      redirect(base_url()."Admisi/signature");
    }
  }
  public function print($id=null){
    $data_pasien = $this->ModelAdmisi->get_detail($id);
    $data = array(
      'data' => $data_pasien,
      'pasien' => $this->ModelAdmisi->get_pasien($id),
      'rujuk' => $this->db->get_where('rujukan_internal',array('kunjungan_no_urutkunjungan'=>$id,'tujuan_poli'=>"RANAP"))->row_array()
    );
    $this->load->view('Admisi/print2',$data);
  }

}
