<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Obat extends CI_Controller{
  public $obat = array();
  public function __construct()
  {
    parent::__construct();
    $this->load->helper(array('url', 'language'));
    $this->load->model('ModelObat');
    $this->load->model('ModelJenisObat');
    $this->load->model('ModelKategoriObat');
    $this->load->model('ModelSatuan');
    $this->load->model('ModelAkuntansi');
    $this->obat = array(
      'idobat' => $this->input->post('idobat'),
      'nama_obat' => $this->input->post("nama_obat"),
      'dosis' => $this->input->post('dosis'),
      'kegunaan' => $this->input->post("kegunaan"),
      'jenis_obat_idjenis_obat' => $this->input->post('jenis_obat'),
      'kategori_obat_idkategori_obat' => $this->input->post("kategori_obat"),
      'kandungan_obat' => $this->input->post('kandungan'),
      'satuan_kecil' => $this->input->post("satuan_kecil"),
      'satuan_sedang' => $this->input->post("satuan_sedang"),
      'satuan_besar' => $this->input->post("satuan_besar"),
      'harga_beli_satuan_kecil' => $this->input->post("harga_satuan_kecil"),
      'harga_beli_satuan_sedang' => $this->input->post("harga_satuan_sedang"),
      'harga_beli_satuan_besar' => $this->input->post("harga_satuan_besar"),
      'jml_satuan_besar' => $this->input->post('jumlah_satuan_besar'),
      'jml_satuan_sedang' => $this->input->post('jumlah_satuan_sedang'),
      'jml_satuan_kecil' => 1,
      'harga_1' => $this->input->post('hrg_1'),
      'harga_2' => $this->input->post('hrg_2'),
      'harga_3' => $this->input->post('hrg_3'),
      'harga_4' => $this->input->post('hrg_4'),
      'harga_5' => $this->input->post('hrg_5'),
      'harga_ozon' => $this->input->post('hrg_ozon'),
      'kelompok_obat' => $this->input->post("kelompok_obat")
    );
  }

  function index()
  {
    $data = array(
      'body' => 'Obat/list',
      'obat' => $this->ModelObat->get_data(),
      'form_dialog' => 'Obat/form_dialog',
    );
    $this->load->view('index', $data);
  }
  function get_data_obat(){
    $id = $this->input->post('id_obat');
    // $data = array();
    echo json_encode($this->ModelObat->get_data_edit($id)->row_array());
  }
  function get_data_batch(){
    $id = $this->input->post('id_obat');
    // $data = array();
    echo json_encode($this->db->get_where('list_batch',array("idobat"=>$id,"stok!="=>0))->result());
  }
  function input()
  {
    $data = array(
      'form' => 'Obat/form',
      'body' => 'Obat/input',
      'satuan' => $this->ModelSatuan->get_data(),
      'jenis_obat' => $this->ModelJenisObat->get_data(),
      'kategori_obat' => $this->ModelKategoriObat->get_data()
    );
    $this->load->view('index', $data);
  }

  public function insert()
  {
    $hitung = $this->db->get_where("obat",array("idobat"=>$this->obat['idobat']))->num_rows();
    if ($hitung>0) {
      $this->session->set_flashdata('notif', $this->Notif->gagal('kode obat telah ada,silahkan gunakan kode obat lain yang masih belum ada'));
      redirect(base_url().'Obat');
    }else{

      if ($this->db->insert('obat', $this->obat)) {
        $this->session->set_flashdata('notif', $this->Notif->berhasil('Berhasil Tersimpan'));
        redirect(base_url().'Obat');
      } else {
        $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Tersimpan'));
        redirect(base_url().'Obat');
      }
    }

  }

  public function edit()
  {
    $id = $this->uri->segment(3);
    $data = array(
      'form' => 'Obat/form',
      'body' => 'Obat/edit',
      'obat' => $this->ModelObat->get_data_edit($id)->row_array(),
      'satuan' => $this->ModelSatuan->get_data(),
      'jenis_obat' => $this->ModelJenisObat->get_data(),
      'kategori_obat' => $this->ModelKategoriObat->get_data()
    );
    $this->load->view('index', $data);
  }

  public function update()
  {
    $idobat = $this->input->post('idobat');
    $this->db->where('idobat',$idobat);
    if ($this->db->update('obat', $this->obat)) {
      $this->session->set_flashdata('alert', $this->Core->alert_succcess('Berhasil Tersimpan'));
      redirect(base_url().'Obat');
    } else {
      $this->session->set_flashdata('alert', $this->Core->alert_danger('Gagal Tersimpan'));
      redirect(base_url().'Obat');
    }

  }

  public function delete()
  {
    $id = $this->input->post('id');
    // $cek_data = $this->db->where_in('obat_idobat	',$id)->get('obat')->num_rows();
    // if ($cek_data>0) {
    //   $this->session->set_flashdata('alert', $this->Core->alert_danger('Gagal Hapus Data Obat,Data Master Masih Digunakan!!!!'));
    // }else{
    $this->db->where_in('idobat', $id);
    $delete = $this->db->delete('obat');
    if ($delete) {
      $this->session->set_flashdata('alert', $this->Core->alert_succcess('Berhasil Hapus Data Obat'));
    }else{
      $this->session->set_flashdata('alert', $this->Core->alert_danger('Gagal Hapus Data Obat'));
    };
    // }
    redirect(base_url().'Obat');
  }

  public function stokAwal(){
    $data = array(
      'form' => 'Obat/formstokAwal',
      'body' => 'Obat/stokAwal',
      'obat' => $this->ModelObat->get_data()
    );
    $this->load->view('index', $data);
  }
  public function listStokAwal(){
    $data = array(
      // 'form' => 'Obat/formstokAwal',
      'body' => 'Obat/listStokAwal',
      'obat' => $this->db->order_by("tanggal","DESC")->select("tanggal,count(*) as jumlah,kode_input")->group_by("kode_input")->get_where("detail_pembelian_obat",array("stok_awal"=>1))->result()
    );
    $this->load->view('index', $data);
  }
  public function detailStokAwal($kode){
    $data = array(
      // 'form' => 'Obat/formstokAwal',
      'body' => 'Obat/detailStokAwal',
      'obat' => $this->db->join("obat","obat.idobat=detail_pembelian_obat.obat_idobat")->get_where("detail_pembelian_obat",array("kode_input"=>$kode))->result()
    );
    $this->load->view('index', $data);
  }
  public function insertStokAwal(){
    $kode = $this->ModelAkuntansi->generete_notrans();

    $id_obat = $this->input->post('id_obat');
    $no_batch = $this->input->post('no_batch');
    $jumlah = $this->input->post('jumlah');
    $harga = $this->input->post('harga');
    $satuan = $this->input->post('satuan');
    $tanggal_expired = $this->input->post('ed');
    $count = count($id_obat);
    $total_harga = 0;
    $kode_akun = $this->ModelAkuntansi->generete_notrans();
    $kode = $this->Core->generate_kode(10);
    for($i=0;$i<$count;$i++){
      $data_obat = $this->ModelObat->get_data_edit($id_obat[$i])->row_array();
      $jml_satuan_kecil = $jumlah[$i];
      $stok = $jml_satuan_kecil+$data_obat['stok'];
      $stok_berjalan = $jml_satuan_kecil+$data_obat['stok_berjalan'];
      $detail_pembelian_obat = array(
        'no_batch' => $no_batch[$i],
        'jumlah' => $jumlah[$i],
        'jumlah_satuan_kecil' => $jml_satuan_kecil,
        'tanggal_expired' => $tanggal_expired[$i],
        'obat_idobat' => $id_obat[$i],
        'stok_awal' => 1,
        'hrg_beli' => $harga[$i],
        'hrg_beli_satuan_kecil' => $harga[$i],
        'satuan_beli' => $satuan[$i],
        'kode_input' => $kode

      );
      $this->db->insert('detail_pembelian_obat', $detail_pembelian_obat);
      $update = array(
        'stok' => $stok,
        'stok_berjalan' => $stok_berjalan
      );
      $this->db->where('idobat',$id_obat[$i]);
      $this->db->update('obat',$update);
      $total_harga += $harga[$i]*$jumlah[$i];
    }
    $jurnal1 = array(
      'tanggal' => date("Y-m-d"),
      'keterangan' => 'Stok Awal Obat',
      'norek' => '30000',
      'debet' => 0,
      'kredit' => $total_harga,
      'no_transaksi' => $kode_akun,
      'jam' => date("H:i:s")
    );
    $jurnal2 = array(
      'tanggal' => date("Y-m-d"),
      'keterangan' => 'Stok Awal Obat',
      'norek' => '10501',
      'debet' => $total_harga,
      'kredit' => 0,
      'no_transaksi' => $kode_akun,
      'jam' => date("H:i:s")
    );
    $this->db->insert('jurnal',$jurnal1);
    $this->db->insert('jurnal',$jurnal2);
    $this->session->set_flashdata('notif', $this->Notif->berhasil('Berhasil Disimpan!!!!'));
    redirect(base_url().'Obat/stokAwal');

  }
  public function kadaluarsa(){
    $data = array(
      'body' => 'Obat/kadaluarsa',
      'obat' => $this->ModelObat->get_kadaluarsa(),
      // 'form_dialog' => 'Obat/form_dialog',
    );
    $this->load->view('index', $data);
  }
  // public function set_stok(){
  //   $data = $this->db->get("obat")->result();
  //   foreach ($data as $value) {
  //     $this->db->where("idobat",$value->idobat);
  //     $this->db->update("obat",array('stok'=>0,"stok_berjalan"=>0));
  //   }
  //   echo "Selesai";
  // }
  // public function set_kode(){
  //   $data = $this->db->group_by("DATE(tanggal)")->get("detail_pembelian_obat")->result();
  //   // var_dump($data);
  //   foreach ($data as $value) {
  //     $kode = $this->Core->generate_kode(10);
  //     // echo $value->tanggal."<br>";
  //     if ($value->stok_awal==0) {
  //       $kode = NULL;
  //     }
  //     $this->db->where_in("DATE(tanggal)",date("Y-m-d",strtotime($value->tanggal)));
  //     $this->db->update("detail_pembelian_obat",array("kode_input"=>$kode));
  //     // echo $kode."<br>";
  //
  //   }
  //   echo "Selesai";
  // }

  public function update_stok(){
    $data = $this->db
    ->select("SUM(jumlah_beri) as jumlah_pakai,detail_pembelian_obat.obat_idobat as idobat")
    ->group_by("detail_pembelian_obat.obat_idobat")
    // ->where("detail_pembelian_obat.obat_idobat","TBL0055")
    ->join("detail_pembelian_obat","detail_pembelian_obat.iddetail_pembelian_obat=detail_resep_diberikan.id_pengadaan")
    ->get("detail_resep_diberikan")
    ->result();
    foreach ($data as $value) {
      $data2 = $this->db
      ->select("SUM(jumlah_satuan_kecil) as pengadaan")
      ->get_where("detail_pembelian_obat",array("obat_idobat"=>$value->idobat))->row_array();
      $stok = $data2['pengadaan']-$value->jumlah_pakai;
      // die(var_dump($stok));
      $this->db->where("idobat",$value->idobat);
      $this->db->update("obat",array("stok"=>$stok));

    }
    // die(var_dump($data2));
    echo "Selesai";
  }


}
?>
