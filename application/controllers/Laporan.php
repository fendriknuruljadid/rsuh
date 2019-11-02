<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Laporan extends CI_Controller {
  public function __construct()
  {
    parent::__construct();
    $this->load->model('ModelLaporan');
    $this->load->model('ModelTujuanPelayanan');
  }
  public function kesakitan()
  {
    $data = array(
      'body' => 'Laporan/kesakitan/index'
    );
    $this->load->view('index',$data);
  }
  public function cetak_kesakitan()
  {
    $from = $this->input->post('tgl_mulai');
    $till = $this->input->post('tgl_sampai');
    $data = array(
      'kesakitan' => $this->ModelLaporan->get_kesakitan($from,$till),
      'mulai' => date('d-m-Y',strtotime($from)),
      'sampai' => date('d-m-Y',strtotime($till))
    );
    // die(print_r($data));
    $this->load->view('Laporan/kesakitan/kesakitan',$data);
  }
  public function kunjungan()
  {
    $data = array(
      'body' => 'Laporan/kunjungan/index',
      'tupel' => $this->ModelTujuanPelayanan->get_data()
    );
    // die(print_r($data));
    $this->load->view('index',$data);
  }
  public function lab()
  {
    $data = array(
      'body' => 'Laporan/lab/index',
      // 'tupel' => $this->ModelTujuanPelayanan->get_data()
    );
    // die(print_r($data));
    $this->load->view('index',$data);
  }
  public function cetak_kunjungan()
  {
    $from = $this->input->post('tgl_mulai');
    $till = $this->input->post('tgl_sampai');
    $tupel = $this->input->post('tupel');
    if ($tupel=='') {
      $data = array(
        'kunjungan' => $this->ModelLaporan->get_kunjungan($from,$till),
        'mulai' => date('d-m-Y',strtotime($from)),
        'lama' => $this->ModelLaporan->get_kunjungan_lama($from,$till),
        'baru' => $this->ModelLaporan->get_kunjungan_baru($from,$till),
        'sampai' => date('d-m-Y',strtotime($till)),
        'tupel' => 'Semua'

      );
    }else{
      $data_tupel = $this->ModelTujuanPelayanan->get_data_edit($tupel)->row_array();
      $data = array(
        'kunjungan' => $this->ModelLaporan->get_kunjungan($from,$till,$tupel),
        'mulai' => date('d-m-Y',strtotime($from)),
        'lama' => $this->ModelLaporan->get_kunjungan_lama($from,$till,$tupel),
        'baru' => $this->ModelLaporan->get_kunjungan_baru($from,$till,$tupel),
        'sampai' => date('d-m-Y',strtotime($till)),
        'tupel' => $data_tupel['tujuan_pelayanan']
      );
    }

    // die(print_r($data));
    $this->load->view('Laporan/kunjungan/kunjungan',$data);
  }

  public function kesakitan_umur(){
    $data = array(
      'body' => 'Laporan/kesakitan/index_umur'
    );
    $this->load->view('index',$data);
  }
  public function kunjungan_umur(){
    $data = array(
      'body' => 'Laporan/kunjungan/index_umur'
    );
    $this->load->view('index',$data);
  }
  public function cetak_kesakitan_umur()
  {
    $from = $this->input->post('tgl_mulai');
    $till = $this->input->post('tgl_sampai');
    $data = array(
      'data_html' => $this->ModelLaporan->get_kesakitan_umur($from,$till),
      'mulai' => date('d-m-Y',strtotime($from)),
      'sampai' => date('d-m-Y',strtotime($till))
    );
    // die(print_r($data));
    $this->load->view('Laporan/kesakitan/kesakitan_umur',$data);
  }
  public function cetak_kunjungan_umur()
  {
    $from = $this->input->post('tgl_mulai');
    $till = $this->input->post('tgl_sampai');
    $data = array(
      'data_html' => $this->ModelLaporan->get_kunjungan_umur($from,$till),
      'mulai' => date('d-m-Y',strtotime($from)),
      'sampai' => date('d-m-Y',strtotime($till))
    );
    // die(print_r($data));
    $this->load->view('Laporan/kunjungan/kunjungan_umur',$data);
  }

  public function kunjungan_poli(){
    $data = array(
      'body' => 'Laporan/kunjungan/index_tupel'
    );
    $this->load->view('index',$data);
  }
  public function cetak_kunjungan_poli()
  {
    $from = $this->input->post('tgl_mulai');
    $till = $this->input->post('tgl_sampai');
    $data = array(
      'data_html' => $this->ModelLaporan->get_kunjungan_poli($from,$till),
      'mulai' => date('d-m-Y',strtotime($from)),
      'sampai' => date('d-m-Y',strtotime($till))
    );
    // die(print_r($data));
    $this->load->view('Laporan/kunjungan/kunjungan_poli',$data);
  }
  public function kunjungan_laborat(){
    $data = array(
      'body' => 'Laporan/kunjungan/index_laborat'
    );
    $this->load->view('index',$data);
  }
  public function cetak_kunjungan_laborat(){
    $from = $this->input->post('tgl_mulai');
    $till = $this->input->post('tgl_sampai');
    $data = array(
      'laborat' => $this->ModelLaporan->get_kunjungan_laborat($from,$till),
      'mulai' => date('d-m-Y',strtotime($from)),
      'sampai' => date('d-m-Y',strtotime($till))
    );
    // die(print_r($data));
    $this->load->view('Laporan/kunjungan/kunjungan_laborat',$data);
  }
  public function cetak_rekap_lab(){
    $from = $this->input->post('tgl_mulai');
    $till = $this->input->post('tgl_sampai');
    $data = array(
      'laborat' => $this->ModelLaporan->get_rekap_lab($from,$till),
      'mulai' => date('d-m-Y',strtotime($from)),
      'sampai' => date('d-m-Y',strtotime($till))
    );
    // die(print_r($data));
    $this->load->view('Laporan/lab/laborat',$data);
  }
  public function cetak_kunjungan_laborat_detail(){
    $from = $this->input->post('tgl_mulai');
    $till = $this->input->post('tgl_sampai');
    $tupel = $this->input->post('poli');
    $data = array(
      'laborat' => $this->ModelLaporan->get_rekap_lab_detail($from,$till,$tupel),
      'mulai' => date('d-m-Y',strtotime($from)),
      'sampai' => date('d-m-Y',strtotime($till))
    );

    // die(print_r($data));
    $this->load->view('Laporan/lab/laborat_detail',$data);
  }

  public function jasa(){
    $data = array(
      'body' => 'Laporan/jasa'
    );
    $this->load->view('index',$data);
  }
  public function jasa_all(){
    $data = array(
      'body' => 'Laporan/jasa_all',
      'pegawai' => $this->ModelLaporan->get_dokter()
    );
    $this->load->view('index',$data);
  }
  public function get_jasa_all(){
    $from = $this->input->post('tgl_mulai');
    $till = $this->input->post('tgl_sampai');
    $nik = $this->input->post('nik');
    // echo json_encode($nik);
    // $from = "2019-06-01";
    // $till = "2019-07-04";
    // $nik = "10804130";
    $data = $this->ModelLaporan->get_pendapatan_jasa_all($from,$till,$nik);
    // die(var_dump($data));
    // // die(var_dump($data));
    echo json_encode($data);
  }
  public function get_jasa(){
    $from = $this->input->post('tgl_mulai');
    $till = $this->input->post('tgl_sampai');
    // $from = "2019-06-15";
    // $till = "2019-06-21";
    $data = $this->ModelLaporan->get_pendapatan_jasa($from,$till);
    // die(var_dump($data));
    echo json_encode($data);
  }

  public function kunjungan_rajal_ranap()
  {
    $data = array(
      'body' => 'Laporan/rajal_ranap/index'
    );
    $this->load->view('index',$data);
  }

  public function cetak_rekap_ranap_rajal()
  {
    $from = $this->input->post('tgl_mulai');
    $till = $this->input->post('tgl_sampai');

    $rawat = $this->ModelLaporan->get_rajal_ranap($from,$till);
    $data = array(
      'rawat' => $rawat,
      'mulai' => date('d-m-Y',strtotime($from)),
      'sampai' => date('d-m-Y',strtotime($till))
    );
    // // die(print_r($data));
    $this->load->view('Laporan/rajal_ranap/rajal_ranap',$data);
  }

  public function laba(){
    $data = array(
      'body' => 'Laporan/laba'
    );
    $this->load->view('index',$data);
  }
  public function buku_besar(){
    $data = array(
      'body' => 'Laporan/buku_besar'
    );
    $this->load->view('index',$data);
  }
  public function buku_besar_detail(){
    $data = array(
      'body' => 'Laporan/buku_besar_detail',
      'buku' => $this->ModelLaporan->get_buku()
    );
    $this->load->view('index',$data);
  }
  public function get_buku_besar(){
    $from = $this->input->post('tgl_mulai');
    $till = $this->input->post('tgl_sampai');
    // $from = "2019-06-20";
    // $till = "2019-06-30";
    $data = $this->ModelLaporan->get_buku_besar($from,$till);
    echo json_encode($data);
  }
  public function get_buku_besar_detail(){
    $norek = $this->input->post("norek");
    $from = $this->input->post('tgl_mulai');
    $till = $this->input->post('tgl_sampai');
    // $from = "2019-06-20";
    // $till = "2019-06-30";
    $data = $this->ModelLaporan->get_buku_besar_detail($from,$till,$norek);
    echo json_encode($data);
  }
  public function get_laba(){
    $from = $this->input->post('tgl_mulai');
    $till = $this->input->post('tgl_sampai');
    // $from = "2019-08-20";
    // $till = "2019-08-30";
    $data = $this->ModelLaporan->get_laba_rugi($from,$till);
    echo json_encode($data);
  }

  public function rujukan()
  {
    $data = array(
      'body' => 'Laporan/rujukan/index'
    );
    $this->load->view('index',$data);
  }

  public function rekap_rujukan()
  {
      $from = $this->input->post('tgl_mulai');
      $till = $this->input->post('tgl_sampai');

      $rujukan = $this->ModelLaporan->get_rekap_rujukan_internal($from,$till, 1)->result();

      $data = array(
        'rujukan' => $rujukan,
        'mulai' => date('d-m-Y',strtotime($from)),
        'sampai' => date('d-m-Y',strtotime($till))
      );
      // // die(print_r($data));
      $this->load->view('Laporan/rujukan/rekap',$data);
  }

  public function rekap_rujukan_detail()
  {
      $from = $this->input->post('tgl_mulai');
      $till = $this->input->post('tgl_sampai');

      $rujukan = $this->ModelLaporan->get_rekap_rujukan_internal($from,$till)->result();

      $data = array(
        'rujukan' => $rujukan,
        'mulai' => date('d-m-Y',strtotime($from)),
        'sampai' => date('d-m-Y',strtotime($till))
      );
      // // die(print_r($data));
      $this->load->view('Laporan/rujukan/rekap_detail',$data);
  }



}
