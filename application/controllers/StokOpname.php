<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StokOpname extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model("ModelObat");
    $this->load->model("ModelAkuntansi");
    $this->load->model("ModelStokOpname");
  }

  function index()
  {
    $data = array(
      // 'form' => 'StokOpname/form',
      'body'          => 'StokOpname/list',
      'stok_opname'   => $this->ModelStokOpname->get_list_stokopname()->result()
      // 'obat' => $this->ModelObat->get_data()
    );
    $this->load->view('index', $data);
  }

  function input()
  {
    $data = array(
      // 'form' => 'Kunjungan/form',
      'body' => 'StokOpname/form',
      'obat' => $this->ModelObat->get_data()
     );
    $this->load->view('index', $data);
  }

  function list_batch()
  {
    $idobat = $this->input->post("kode_obat");
    // $idobat = "03o0o403";
    $data = $this->ModelStokOpname->list_batch($idobat)->result();
    // die(var_dump($data));
    echo json_encode($data);
  }

  function insert()
  {
    $kode = $this->ModelAkuntansi->generete_notrans();
    $jam = date("H:i:s");
    $id = $this->input->post("id_pengadaan");
    for ($i=0; $i < count($id); $i++) {
      $data = array(
        'tanggal'     => $this->input->post("tanggal"),
        'id_pengadaan'=> $id[$i],
        'no_batch'    => $this->input->post("no_batch")[$i],
        'nama'        => $this->input->post("nama")[$i],
        'satuan'      => $this->input->post("satuan")[$i],
        'harga_beli'  => $this->input->post("harga_beli")[$i],
        'jumlah_real' => $this->input->post("jumlah_real")[$i],
        'jumlah_komp' => $this->input->post("jumlah_komp")[$i],
        'selisih'     => $this->input->post("selisih")[$i],
        'selisih_harga'=> $this->input->post("selisih_harga")[$i],
      );
      $this->db->insert("stok_opname", $data);
      $this->db->reset_query();
      $jurnal_kredit = array(
        'tanggal' => $this->input->post("tanggal"),
        'keterangan' => 'Selisih harga dari obat '.$this->input->post("nama")[$i].' ,nomor batch '.$this->input->post("no_batch")[$i].', sejumlah '.$this->input->post("selisih")[$i].', dengan harga beli per satuan Rp. '.$this->input->post("harga_beli")[$i].' ,tanggal '.date("d-m-Y"),
        'norek' => '10501',
        'debet' => 0,
        'kredit' => $this->input->post("selisih_harga")[$i],
        'no_transaksi' => $kode,
        'jam' => $jam
      );
      $this->db->insert("jurnal", $jurnal_kredit);
      $this->db->reset_query();
      $jurnal_debet = array(
        'tanggal' => $data_billing['tanggal'],
        'keterangan' => 'Selisih harga dari obat '.$this->input->post("nama")[$i].' ,nomor batch '.$this->input->post("no_batch")[$i].', sejumlah '.$this->input->post("selisih")[$i].', dengan harga beli per satuan Rp. '.$this->input->post("harga_beli")[$i].' ,tanggal '.date("d-m-Y"),
        'norek' => '60009',
        'debet' => $this->input->post("selisih_harga")[$i],
        'kredit' => 0,
        'no_transaksi' => $kode,
        'jam' => $jam,
        // 'pasien_noRM' =>
      );
      $this->db->insert("jurnal", $jurnal_debet);
      $this->db->reset_query();

      $data_obat = $this->ModelObat->get_data_edit($this->input->post("kode_obat")[$i])->row_array();
      $stok_baru = $data_obat['stok'] + ($this->input->post("selisih")[$i]);
      $stok_berjalan_baru = $data_obat['stok_berjalan'] + ($this->input->post("selisih")[$i]);
      $update = array(
        'stok'          => $stok_baru,
        'stok_berjalan' => $stok_berjalan_baru
     );
     $this->db->where("idobat", $this->input->post("kode_obat")[$i]);
     $this->db->update("obat", $update);
    }

    $this->session->set_flashdata('notif', $this->Notif->berhasil('Berhasil Disimpan!!!!'));
    redirect(base_url().'StokOpname/input');
  }


}
