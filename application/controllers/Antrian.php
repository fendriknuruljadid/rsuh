<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Antrian extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('ModelAdmisi');
  }

  public function antrian(){
    $data = array(
      'body'            => 'Admisi/list',
      'kunjungan'       => $this->ModelAdmisi->get_data(null),
      'kunjungan_sudah' => $this->ModelAdmisi->get_data_sudah(null),
      'antrian' => $this->db->get_where("antrian",array('tanggal'=>date("Y-m-d")))->row_array()

    );
		$this->load->view('antrian',$data);
  }
  public function antrian1(){
    $data = array(
      'body'            => 'Admisi/list',
      'kunjungan'       => $this->ModelAdmisi->get_data(null),
      'kunjungan_sudah' => $this->ModelAdmisi->get_data_sudah(null),
      'antrian' => $this->db->get_where("antrian1",array('tanggal'=>date("Y-m-d")))->row_array()

    );
		$this->load->view('antrian1',$data);
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

  public function reset(){
    $date = date("Y-m-d");
    $this->db->where(array('tanggal'=>$date))->update('antrian',array('status'=>0));
    echo "berhasil";
  }
  public function reset1(){
    $date = date("Y-m-d");
    $this->db->where(array('tanggal'=>$date))->update('antrian1',array('status'=>0));
    echo "berhasil";
  }


  public function setuju(){
    $nokun = $this->uri->segment(3);
    $nama_wali = $this->input->post("namawali");
    $ktp = $this->input->post("ktp");
    $alamat = $this->input->post("alamat");
    $telp  = $this->input->post("telp");
    $kamar = $this->input->post("kamar");
    $data = array(
      'wali_ranap' => $nama_wali,
      'ktp_wali' => $ktp,
      'acc_ranap' => 1,
      'alamat_wali'=>$alamat,
      'tlp_wali' => $telp,
      'ttd_wali' => $this->input->post('signature'),
      'tempat_tidur_no_tt' => $kamar,
      'sts_wali' => $this->input->post('setuju'),
    );
    $this->db->where('no_urutkunjungan',$nokun);
    $this->db->update('kunjungan',$data);
    $this->db->where('no_tt',$kamar);
    $this->db->update('tempat_tidur',array('status_terisi'=>1));
    $this->session->set_flashdata('notif',$this->Notif->berhasil("Proses admisi berhasil dilakukan"));
    redirect(base_url()."Admisi");
  }

  public function signature(){
    $data = array(
      'kunjungan' => $this->ModelAdmisi->get_data(null)
    );
    // die(var_dump($data['kunjungan']));
    $this->load->view("Admisi/signature",$data);
  }
  public function panggil(){
    $antrian = $this->input->post('antrian');
    $antrian = "LAB-11-DD";
    // $signature = $this->input->post('ttd');
    // // echo $signature;
    // $hit = $this->db->get_where('kunjungan',array('no_urutkunjungan'=>$nokun))->num_rows();
    // if ($hit == 0) {
    //   $this->session->set_flashdata('pesan',"0");
    //   redirect(base_url()."Admisi/signature");
    // }else{
    $baru = explode("-",$antrian);
    $date = date("Y-m-d");
    $cek = $this->db->get_where("antrian",array('tanggal'=>$date))->num_rows();

    $no = $baru[1];
    if ($baru[0]=='UMU') {
      $data = array(
        'UMU' => $baru[2].$no,
        'antrian_terakhir' => $baru[2].$no,
        'unit_terakhir' => 'Poli Umum'
      );
    }
    if ($baru[0]=='OBG') {
      $data = array(
        'OBG' => $baru[2].$no,
        'antrian_terakhir' => $baru[2].$no,
        'unit_terakhir' => 'Poli Obgyn'
      );
    }
    if ($baru[0]=='INT') {
      $data = array(
        'INTERNIS' => $baru[2].$no,
        'antrian_terakhir' => $baru[2].$no,
        'unit_terakhir' => 'Poli Internis'
      );
    }
    if ($baru[0]=='GIG') {
      $data = array(
        'GIG' => $baru[2].$no,
        'antrian_terakhir' => $baru[2].$no,
        'unit_terakhir' => 'Poli Gigi'
      );
    }
    if ($baru[0]=='OZO') {
      $data = array(
        'OZO' => $baru[2].$no,
        'antrian_terakhir' => $baru[2].$no,
        'unit_terakhir' => 'Poli Ozon'
      );
    }
    if ($baru[0]=='LAB') {
      $data = array(
        'LAB' => $baru[2].$no,
        'antrian_terakhir' => $baru[2].$no,
        'unit_terakhir' => 'Laboratorium'
      );
    }
    if ($cek > 0) {
      $this->db->where("tanggal",$date);
      $this->db->update("antrian",$data);
    }else{
      $data['tanggal'] = $date;
      $this->db->insert('antrian',$data);
    }


    $dataku = $this->db->get_where("antrian",array('tanggal'=>$date))->row_array();
      if ($dataku['status']==0) {
        // code...
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
          'no_antrian' => $antrian
          // 'nokun' => $nokun
        );
        $pusher->trigger('ci_pusher3', 'my-event55',$data);
        $this->db->where(array('tanggal'=>$date))->update('antrian',array('status'=>1));
        if ($baru[0]=='LOKET1' || $baru[0]=="LOKET2") {
          $id=$this->input->post("id");
          $this->db->where('idantrian_loket',$id)->update('antrian_loket',array('panggilan'=>1));
        }
        echo "Panggilan dilakukan";
      }else{
        echo "Masih ada panggilan lain, mohon coba sesaat lagi";
      }
    //
    //   $this->session->set_flashdata('pesan',"1");
    //   redirect(base_url()."Admisi/signature");
    // }
  }
  public function panggil1(){
    $antrian = $this->input->post('antrian');
    $antrian = "APOTIK-3-DD";

    $baru = explode("-",$antrian);
    $date = date("Y-m-d");
    $cek = $this->db->get_where("antrian1",array('tanggal'=>$date))->num_rows();

    $no = $baru[1];

    if ($baru[0]=='LOKET1') {
      $data = array(
        'LOKET1' => $no,
        'antrian_terakhir' => "B".$no,
        'unit_terakhir' => "Loket 1"
      );
    }
    if ($baru[0]=='LOKET2') {
      $data = array(
        'LOKET2' => $no,
        'antrian_terakhir' => "L".$no,
        'unit_terakhir' => 'Loket 2'
      );
    }

    if ($baru[0]=='KASIR') {

        $data = array(
          'KASIR' => $baru[2].$no,
          'antrian_terakhir' => $baru[2].$no,
          'unit_terakhir' => 'APOTEK'
        );
    }

    if ($baru[0]=='APOTIK') {
      $data = array(
        'APOTEK' => $baru[2].$no,
        'antrian_terakhir' => $baru[2].$no,
        'unit_terakhir' => 'APOTEK'
      );
    }

    if ($cek > 0) {
      $this->db->where("tanggal",$date);
      $this->db->update("antrian1",$data);
    }else{
      $data['tanggal'] = $date;
      $this->db->insert('antrian1',$data);
    }


    $dataku = $this->db->get_where("antrian1",array('tanggal'=>$date))->row_array();
      if ($dataku['status']==0) {
        // code...
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
          'no_antrian' => $antrian
          // 'nokun' => $nokun
        );
        $pusher->trigger('ci_pusher3', 'my-event3',$data);
        $this->db->where(array('tanggal'=>$date))->update('antrian1',array('status'=>1));
        if ($baru[0]=='LOKET1' || $baru[0]=="LOKET2") {
          $id=$this->input->post("id");
          $this->db->where('idantrian_loket',$id)->update('antrian_loket',array('panggilan'=>1));
        }
        echo "Panggilan dilakukan";
      }else{
        echo "Masih ada panggilan lain, mohon coba sesaat lagi";
      }
    //
    //   $this->session->set_flashdata('pesan',"1");
    //   redirect(base_url()."Admisi/signature");
    // }
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
