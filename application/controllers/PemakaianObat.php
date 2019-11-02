<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class PemakaianObat extends CI_Controller{

    public function __construct()
    {
      parent::__construct();
      $this->load->helper(array('url', 'language'));
      $this->load->model('ModelPembelianObat');
      $this->load->model('ModelSupplier');
      $this->load->model('ModelObat');
      $this->load->model("ModelPeriksa");
      $this->load->model("ModelAkuntansi");
    }

    function bhp()
    {
      $data = array(
        'form' => 'PemakaianObat/form',
        'body' => 'PemakaianObat/list',
        'obat' => $this->ModelObat->get_data()
      );
      $this->load->view('index', $data);
    }

    function insert($id=null){
      $id_obat = $this->input->post('id_obat');
      $no_batch = $this->input->post('no_batch');
      $jumlah = $this->input->post('jumlah');
      $tanggal_expired = $this->input->post('ed');
      $idp = $this->input->post('id_pengadaan');
      $kode = $this->ModelObat->generate_kode();
      if ($id==null||$id=='') {
        $periksa = null;
        $tupel = $this->input->post('tupel');
        $nourut = null;
      }else{
        $periksa = $id;
        $tupel =null;
        $data_periksa = $this->ModelPeriksa->get_data_edit($periksa);
        $nourut = $data_periksa['kunjungan_no_urutkunjungan'];
      }
      $count = count($id_obat);
      $total_obat = 0;
      for($i=0;$i<$count;$i++){
        $data_obat = $this->ModelObat->get_data_edit($id_obat[$i])->row_array();
        $jml_satuan_kecil = $jumlah[$i];
        $stok = $data_obat['stok']-$jml_satuan_kecil;
        $stok_berjalan = $data_obat['stok_berjalan']-$jml_satuan_kecil;
        // if ($nourut!=null) {
        //
        // }
        $harga = $data_obat['harga_1'];
        $total = $harga*$jml_satuan_kecil;
        $detail_pemakaian_obat = array(
          'jumlah' => $jumlah[$i],
          'id_obat' => $id_obat[$i],
          'tanggal' => date("Y-m-d"),
          'nik_akun' => $_SESSION['nik'],
          'id_periksa' => $periksa,
          'harga' => $harga,
          'total_harga' => $total,
          'tupel' => $tupel,
          'nourut_kunjungan' => $nourut,
          'id_pembelian' => $idp[$i],
          'kode' => $kode
        );
        $this->db->insert('pemakaian_obat', $detail_pemakaian_obat);
        $update = array(
          'stok' => $stok,
          'stok_berjalan' => $stok_berjalan
        );
        $this->db->where('idobat',$id_obat[$i]);
        $this->db->update('obat',$update);
        $detail = $this->db->get_where("detail_pembelian_obat",array('iddetail_pembelian_obat'=>$idp[$i]))->row_array();
        if ($detail['terjual_sementara']==null) {
          $jml = $jml_satuan_kecil ;
        }else{
          $jml = $detail['terjual_sementara']+$jml_satuan_kecil;
        }
        if ($detail['jumlah_terjual']==null) {
          $jml = $jml_satuan_kecil ;
        }else{
          $jml = $detail['jumlah_terjual']+$jml_satuan_kecil;
        }
        $this->db->where('iddetail_pembelian_obat',$idp[$i]);
        $this->db->update('detail_pembelian_obat',array('terjual_sementara'=>$jml,"jumlah_terjual"=>$jml));
        $total_obat += $data_obat['harga_beli_satuan_kecil'];
      }
      if ($id==null || $id='') {
        $this->session->set_flashdata('notif', $this->Notif->berhasil('Berhasil Disimpan!!!!'));
        redirect(base_url().'PemakaianObat/bhp');
      }else{
        $kode_akun = $this->ModelAkuntansi->generete_notrans();
        $jurnal = array(
          'tanggal' => date("Y-m-d"),
          'keterangan' => 'Transaksi no kunjungan '.$data_periksa['kunjungan_no_urutkunjungan'],
          'norek' => '10801',
          'debet' => $total_obat,
          'kredit' => 0,
          'no_transaksi' => $kode_akun,
          'jam' => date("H:i:s"),
          'no_urut' => $data_periksa['kunjungan_no_urutkunjungan'],
          // 'pasien_noRM' =>
        );
        $jurnal1 = array(
          'tanggal' => date("Y-m-d"),
          'keterangan' => 'Transaksi no kunjungan '.$data_periksa['kunjungan_no_urutkunjungan'],
          'norek' => '10501',
          'debet' => 0,
          'kredit' => $total_obat,
          'no_transaksi' => $kode_akun,
          'jam' => date("H:i:s"),
          'no_urut' => $data_periksa['kunjungan_no_urutkunjungan'],
          // 'pasien_noRM' =>
        );
        $this->db->insert("jurnal",$jurnal);
        $this->db->insert("jurnal",$jurnal1);
        $this->session->set_flashdata('notif', $this->Notif->berhasil('Berhasil Disimpan!!!!'));
         redirect(base_url()."Periksa/index/".$data_periksa['kunjungan_no_urutkunjungan']);
      }
    }

    function insert_ranap($id=null,$id2=null){
      $id_obat = $this->input->post('id_obat');
      $no_batch = $this->input->post('no_batch');
      $jumlah = $this->input->post('jumlah');
      $tanggal_expired = $this->input->post('ed');
      $idp = $this->input->post('id_pengadaan');
      $kode = $this->ModelObat->generate_kode();
      if ($id==null||$id=='') {
        $periksa = null;
        $tupel = $this->input->post('tupel');
        $nourut = null;
      }else{
        $periksa = $id;
        $tupel =null;
        $data_periksa = $this->ModelPeriksa->get_data_edit($periksa);
        $nourut = $data_periksa['kunjungan_no_urutkunjungan'];
      }
      $count = count($id_obat);
      $total_obat = 0;
      for($i=0;$i<$count;$i++){
        $data_obat = $this->ModelObat->get_data_edit($id_obat[$i])->row_array();
        $jml_satuan_kecil = $jumlah[$i];
        $stok = $data_obat['stok']-$jml_satuan_kecil;
        $stok_berjalan = $data_obat['stok_berjalan']-$jml_satuan_kecil;
        // if ($nourut!=null) {
        //
        // }
        $harga = $data_obat['harga_1'];
        $total = $harga*$jml_satuan_kecil;
        $detail_pemakaian_obat = array(
          'jumlah' => $jumlah[$i],
          'id_obat' => $id_obat[$i],
          'tanggal' => date("Y-m-d"),
          'nik_akun' => $_SESSION['nik'],
          'id_periksa' => $periksa,
          'harga' => $harga,
          'total_harga' => $total,
          'tupel' => $tupel,
          'nourut_kunjungan' => $nourut,
          'id_pembelian' => $idp[$i],
          'kode' => $kode
        );
        $this->db->insert('pemakaian_obat', $detail_pemakaian_obat);
        $update = array(
          'stok' => $stok,
          'stok_berjalan' => $stok_berjalan
        );
        $this->db->where('idobat',$id_obat[$i]);
        $this->db->update('obat',$update);
        $detail = $this->db->get_where("detail_pembelian_obat",array('iddetail_pembelian_obat'=>$idp[$i]))->row_array();
        if ($detail['terjual_sementara']==null) {
          $jml = $jml_satuan_kecil ;
        }else{
          $jml = $detail['terjual_sementara']+$jml_satuan_kecil;
        }
        if ($detail['jumlah_terjual']==null) {
          $jml = $jml_satuan_kecil ;
        }else{
          $jml = $detail['jumlah_terjual']+$jml_satuan_kecil;
        }
        $this->db->where('iddetail_pembelian_obat',$idp[$i]);
        $this->db->update('detail_pembelian_obat',array('terjual_sementara'=>$jml,"jumlah_terjual"=>$jml));
        $total_obat += $data_obat['harga_beli_satuan_kecil'];
      }
      if ($id==null || $id='') {
        $this->session->set_flashdata('notif', $this->Notif->berhasil('Berhasil Disimpan!!!!'));
        redirect(base_url().'PemakaianObat/bhp');
      }else{
        $kode_akun = $this->ModelAkuntansi->generete_notrans();
        $jurnal = array(
          'tanggal' => date("Y-m-d"),
          'keterangan' => 'Transaksi no kunjungan '.$data_periksa['kunjungan_no_urutkunjungan'],
          'norek' => '10801',
          'debet' => $total_obat,
          'kredit' => 0,
          'no_transaksi' => $kode_akun,
          'jam' => date("H:i:s"),
          'no_urut' => $data_periksa['kunjungan_no_urutkunjungan'],
          // 'pasien_noRM' =>
        );
        $jurnal1 = array(
          'tanggal' => date("Y-m-d"),
          'keterangan' => 'Transaksi no kunjungan '.$data_periksa['kunjungan_no_urutkunjungan'],
          'norek' => '10501',
          'debet' => 0,
          'kredit' => $total_obat,
          'no_transaksi' => $kode_akun,
          'jam' => date("H:i:s"),
          'no_urut' => $data_periksa['kunjungan_no_urutkunjungan'],
          // 'pasien_noRM' =>
        );
        $this->db->insert("jurnal",$jurnal);
        $this->db->insert("jurnal",$jurnal1);
        $this->session->set_flashdata('notif', $this->Notif->berhasil('Berhasil Disimpan!!!!'));
         redirect(base_url()."PeriksaRanap/index/".$data_periksa['kunjungan_no_urutkunjungan']."/".$data_periksa['idperiksa']);
      }
    }


  }
?>
