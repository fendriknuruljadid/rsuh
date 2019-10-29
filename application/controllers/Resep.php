<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Resep extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model("ModelKunjungan");
    $this->load->model("ModelBilling");
    $this->load->model('ModelPasien');
    $this->load->model('ModelObat');
    $this->load->model('ModelResep');
  }

  function index()
  {
    // $tgl = date('Y-m-d');
    // $biaya = $this->ModelBilling->biaya()->row_array();
    $data = array(
      'body'      => "Resep/index",
      'resep' => $this->ModelResep->get_resep(),
    );
    $this->load->view('index',$data);
  }
  function detail(){
    $kode = $this->uri->segment(3);
    $data = array(
      'body' => "Resep/detail",
      'detail' => $this->ModelResep->get_tebusan($kode),
      'tebusan' => $this->ModelResep->get_resep_beri($kode),
      'pasien' => $this->ModelResep->get_pasien($kode)
    );
    $this->load->view('index',$data);
  }
  function tebusan(){
    $kode = $this->uri->segment(3);
    $data = array(
      'body' => "Resep/tebusan",
      'detail' => $this->ModelResep->get_tebusan($kode),
      'pasien' => $this->ModelResep->get_pasien($kode)
    );
    $this->load->view('index',$data);

  }
  function print(){
    $kode = $this->uri->segment(3);
    $pasien = $this->ModelResep->get_pasien($kode);
    $riwayat_alergi = $this->ModelResep->get_riwayat($pasien['noRM']);
    $data = array(
      // 'body' => "Resep/print",
      // 'detail' => $this->ModelResep->get_tebusan($kode),
      'dokter' => $this->ModelResep->get_dokter($kode),
      'resep' => $this->ModelResep->get_resep_beri($kode),
      'pasien' => $pasien,
      'alergi' => $riwayat_alergi
    );
    $this->load->view('Resep/print2',$data);

  }
  function get_batch(){
    $idobat = $this->input->post("kode_obat");
    // $idobat = "03o0o403";
    $data = $this->ModelResep->get_list_batch($idobat);
    // die(var_dump($data));
    echo json_encode($data);
  }

  function get_batch2(){
    $idobat = $this->input->post("kode_obat");
    // $idobat = "03o0o403";
    $data = $this->ModelResep->get_list_batch2($idobat);
    // die(var_dump($data));
    echo json_encode($data);
  }

  function insert_tebusan(){
    $no_resep = $this->input->post("kode_resep");
    $list_batch = $this->input->post("list_batch");
    $id_pengadaan = $this->input->post('id_pengadaan');
    $jml_resep = $this->input->post("jumlah_resep");
    $jml_beri = $this->input->post("jumlah_beri");
    $id_detail = $this->input->post("id_detail_resep");
    $id_obat = $this->input->post("kode_obat");
    $signa = $this->input->post("signa");
    $kunjungan = $this->ModelResep->get_kunjungan($no_resep);
    // if ($kunjungan['acc_ranap']!=null) {
    //   for ($i=0; $i < count($id_pengadaan) ; $i++) {
    //     $data_obat = $this->ModelObat->get_data_edit($id_obat[$i])->row_array();
    //     $this->db->where('idobat',$id_obat[$i]);
    //     $this->db->update('obat',array('stok'=>($data_obat['stok']-$jumlah_beri[$i])));
    //   }
    // }
    if (count($id_pengadaan)==0) {
      redirect(base_url()."Resep/tebusan/".$no_resep);
    }else{
      for ($i=0; $i < count($id_pengadaan) ; $i++) {
        $data = array(
          'id_detail_resep' => $id_detail[$i],
          'jumlah_resep' => $jml_resep[$i],
          'jumlah_beri' => $jml_beri[$i],
          'resep_no_resep' => $no_resep,
          'obat_idobat' => $id_obat[$i],
          'signa' => $signa[$i],
          'no_batch' => $list_batch[$i],
          'id_pengadaan' => $id_pengadaan[$i]
        );
        if($this->db->insert("detail_resep_diberikan",$data)){
          $data_pembelian = $this->db->get_where("detail_pembelian_obat",array('iddetail_pembelian_obat'=>$id_pengadaan[$i]))->row_array();
          if ($data_pembelian['jumlah_terjual']==null) {
            $jumlah = 0;
          }else{
            $jumlah = $data_pembelian['jumlah_terjual'];
          }
          $jumlah_sekarang = $jumlah+$jml_beri[$i];
          $this->db->where("iddetail_pembelian_obat",$id_pengadaan[$i]);
          $this->db->update('detail_pembelian_obat',array("jumlah_terjual"=>$jumlah_sekarang));
          $this->db->reset_query();
          $this->db->where("no_resep",$no_resep);
          $this->db->update("resep",array("status_resep"=>1));
          $data_obat = $this->ModelObat->get_data_edit($id_obat[$i])->row_array();
          if ($kunjungan['acc_ranap']!=null) {
            // code...
            $this->db->where('idobat',$id_obat[$i]);
            $this->db->update('obat',array('stok'=>($data_obat['stok']-$jumlah_beri[$i])));
          }

        }

      }
      redirect(base_url()."Resep/");
    }
  }
  function berikan(){
    $no = $this->uri->segment(3);
    $this->db->where("no_resep",$no);
    $this->db->update("resep",array("ambil"=>1));
    redirect(base_url()."Resep/");
  }

  public function filter_resep(){
    $tanggal = $this->input->post("tanggal");
    $sts = $this->input->post('sts');
    $poli = $this->input->post('poli');
    $ambil = $this->input->post('ambil');
    // $tanggal = date('Y-m-d');
    // $sts = 0;
    // $poli = 'UMU';
    // $ambil = 0;
    $data = $this->ModelResep->data_filter($tanggal,$sts,$poli,$ambil);
    // die(var_dump($data));
    $html = '';
    $no=1;

    foreach ($data as $value) {
      $tupel = $value->acc_ranap=='1'?'RANAP':$value->tujuan_pelayanan;
      $button = "";
      $sts_billing ="";
      if ($value->acc_ranap!=1) {
        // code...
        if ($value->billing==1) {
          $sts_billing = '<span class="badge badge-success">Sudah Dibayar</span>';
        }else{
          $sts_billing = '<span class="badge badge-danger">Belum Dibayar</span>';
        }
      }
      if ($value->ambil==1) {
        $sts_ambil = '<span class="badge badge-success">Sudah Diambil</span>';
      }else{
        $sts_ambil = '<span class="badge badge-secondary">Belum Diambil</span>';
      }

      if ($value->status_resep==1) {
        // die("dkaj");
        $button = '<a href="'.base_url().'Resep/detail/'.$value->no_resep.'" >
          <button id="'.$value->no_resep.'" type="button" class="detail_pembelian btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Detail Resep Pasien">
            Detail
          </button>
        </a> <a target="_blank" href="'.base_url().'Resep/print/'.$value->no_resep.'" >
          <button id="'.$value->no_resep.'" type="button" class="detail_pembelian btn btn-warning btn-sm"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Print Resep Pasien">
            Print Resep
          </button>
        </a>';
        // $button="hmmm";
        if ($value->ambil!=1) {
          $button.= '<a href="'.base_url().'Resep/berikan/'.$value->no_resep.'" >
            <button id="'.$value->no_resep.'" type="button" class="detail_pembelian btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Berikan Resep Pasien">
              Berikan Obat
            </button>
          </a>';
        }
      }else{
        if ($value->billing==1 || $value->acc_ranap==1) {
          $href = 'href="'.base_url().'Resep/tebusan/'.$value->no_resep.'"';
          $disable = "";
        }else{
          $href="#";
          $disable = "disabled";
        }
        $button = '<a '.$href.' >
          <button id="'.$value->no_resep.'" '.$disable.' type="button" class="detail_pembelian btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Buat Resep Pasien">
            Siapkan Obat
          </button>
        </a>';
      }
      $html .= '<tr>
        <td>'.$no.'</td>
        <td>'.$value->no_resep.'</td>
        <td>'.$value->noRM.'</td>
        <td>'.$value->namapasien.'</td>
        <td>'.$tupel.'</td>
        <td>'.date("d-m-Y h:i:s",strtotime($value->tanggal)).'</td>
        <td>'.$sts_billing.'</td>
        <td>'.$sts_ambil.'</td>
        <td>'.$button.'</td>';
      $no+=1;

    }
    // die(var_dump($html));
    echo $html;
  }

  public function get_resep(){
    $no_resep = $this->input->post("kode");
    $data = $this->db
    ->join("obat","obat.idobat=detail_resep.obat_idobat")
    ->where("resep_no_resep",$no_resep)->get("detail_resep")->result();
    echo json_encode($data);
  }

  public function edit_resep(){
      $id_detail = $this->input->post('iddetail_resep');
      $idobat = $this->input->post('idobat');
      $jumlah_awal = $this->input->post('jumlah_awal');
      $jumlah_akhir = $this->input->post('jumlah_akhir');
      $harga = $this->input->post('harga');
      for($i=0;$i<count($id_detail);$i++){
        if ($jumlah_awal[$i]!=$jumlah_akhir) {
          $harga_akhir = $jumlah_akhir[$i]*$harga[$i];
          $this->db->where('iddetail_resep',$id_detail[$i]);
          $this->db->update('detail_resep',array('total_harga'=>$harga_akhir,'jumlah'=>$jumlah_akhir[$i]));
          $sisa_jumlah = $jumlah_awal[$i]-$jumlah_akhir[$i];
          $data_obat = $this->ModelObat->get_data_edit($idobat[$i])->row_array();
          $this->db->where('idobat',$idobat[$i]);
          $this->db->update('obat',array('stok_berjalan'=>($data_obat['stok_berjalan']+$sisa_jumlah)));
        }
      }
      $this->session->set_flashdata('notif',$this->Notif->berhasil("Berhasil Simpan Data"));
      redirect(base_url()."Resep");
  }

}
?>
