<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Deposit extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('ModelAdmisi');
    $this->load->model('ModelDeposit');
    $this->load->model('ModelAkuntansi');
    $this->load->model("ModelBilling");
  }

  public function index(){
    $data = array(
      'body'        => 'Deposit/list',
      'kunjungan'   =>  $this->ModelDeposit->get_kunjungan()

    );
		$this->load->view('index',$data);
  }

  public function bayar(){
    $nokun = $this->input->post("nokun");
    $norm = $this->input->post('no_rm');
    $jumlah = $this->Core->combine_harga($this->input->post("jumlah_bayar"));
    $kode = $this->ModelAkuntansi->generete_notrans();
    $data = array(
      'kunjungan_no_urutkunjungan' => $nokun,
      'jumlah_deposit' => $jumlah,
      'operator' => $_SESSION['nik']
    );
    $this->db->insert("deposit",$data);
    $this->db->where("no_urutkunjungan",$nokun)->update('kunjungan',array("status_deposit"=>1));
    $jurnal1 = array(
      'tanggal' => date("Y-m-d"),
      'keterangan' => 'Transaksi no kunjungan '.$nokun,
      'norek' => '10001',
      'debet' => $jumlah,
      'kredit' => 0,
      'no_transaksi' => $kode,
      'jam' => date("H:i:s"),
      'no_urut' => $nokun,
      // 'pasien_noRM' =>
    );
    $jurnal2 = array(
      'tanggal' => date("Y-m-d"),
      'keterangan' => 'Transaksi no kunjungan '.$nokun,
      'norek' => '20701',
      'debet' => 0,
      'kredit' => $jumlah,
      'no_transaksi' => $kode,
      'jam' => date("H:i:s"),
      'no_urut' => $nokun,
      // 'pasien_noRM' =>
    );
    $this->db->insert('jurnal',$jurnal1);
    $this->db->insert('jurnal',$jurnal2);
    $this->session->set_flashdata('notif',$this->Notif->berhasil("Transaksi Berhasil"));
    redirect(base_url()."Deposit");


  }
  public function bayar_ranap(){
    $nokun = $this->input->post("nokun");
    $norm = $this->input->post('no_rm');
    $jumlah = $this->Core->combine_harga($this->input->post("jumlah_bayar"));
    $kode = $this->ModelAkuntansi->generete_notrans();
    $data = array(
      'kunjungan_no_urutkunjungan' => $nokun,
      'jumlah_deposit' => $jumlah,
      'operator' => $_SESSION['nik']
    );
    $this->db->insert("deposit",$data);
    $this->db->where("no_urutkunjungan",$nokun)->update('kunjungan',array("depo_ranap"=>1));
    $jurnal1 = array(
      'tanggal' => date("Y-m-d"),
      'keterangan' => 'Transaksi no kunjungan '.$nokun,
      'norek' => '10001',
      'debet' => $jumlah,
      'kredit' => 0,
      'no_transaksi' => $kode,
      'jam' => date("H:i:s"),
      'no_urut' => $nokun,
      // 'pasien_noRM' =>
    );
    $jurnal2 = array(
      'tanggal' => date("Y-m-d"),
      'keterangan' => 'Transaksi no kunjungan '.$nokun,
      'norek' => '20701',
      'debet' => 0,
      'kredit' => $jumlah,
      'no_transaksi' => $kode,
      'jam' => date("H:i:s"),
      'no_urut' => $nokun,
      // 'pasien_noRM' =>
    );
    $this->db->insert('jurnal',$jurnal1);
    $this->db->insert('jurnal',$jurnal2);
    $this->session->set_flashdata('notif',$this->Notif->berhasil("Transaksi Berhasil"));
    redirect(base_url()."Admisi");


  }

  public function print(){
    $nokun = $this->uri->segment(3);
    $data_depo = $this->db
    ->join("kunjungan","kunjungan.no_urutkunjungan=deposit.kunjungan_no_urutkunjungan")
    ->join("pasien","pasien.noRM=kunjungan.pasien_noRM")
    ->join("pegawai","pegawai.NIK=deposit.operator")
    ->get_where("deposit",array("no_urutkunjungan"=>$nokun))->row_array();
    if ($data_depo['jumlah_deposit']==0) {
      $terbilang = "nol";
    }else{
      $terbilang = $this->ModelBilling->terbilang($data_depo['jumlah_deposit']);
    }
    $no_depo = "KW/DP/".date('m',strtotime($data_depo['tgl']))."/".date('Y',strtotime($data_depo['tgl']))."/".str_pad($data_depo['iddeposit'],8,"0",STR_PAD_LEFT);
    $data = array(
      'body'        => 'Deposit/print',
      'nominal' => $data_depo['jumlah_deposit'],
      'operator' => $data_depo['nama'],
      'pasien' => $data_depo['namapasien'],
      'terbilang' => $terbilang." rupiah",
      'no' => $no_depo,
      'data' => $data_depo
    );
    $this->load->view('index',$data);
  }



}
