<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BillingRanap extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model("ModelKunjungan");
    $this->load->model("ModelBilling");
    $this->load->model('ModelPasien');
    $this->load->model('ModelObat');
    $this->load->model("ModelResep");
    $this->load->model("ModelRanap");
    $this->load->model("ModelAkuntansi");
  }

  function index()
  {
    $tgl = date('Y-m-d');
    $biaya = $this->ModelBilling->biaya()->row_array();
    $data = array(
      'body'      => "BillingRanap/index",
      'kunjungan' => $this->ModelRanap->get_data2(null),
      'biaya_adm' => $biaya['biaya_adm'],
    );
    $this->load->view('index',$data);
  }

  function laporan()
  {
    $tgl = date('Y-m-d');
    $biaya = $this->ModelBilling->biaya()->row_array();
    $data = array(
      'body'      => "BillingRanap/laporan",
      'kunjungan' => $this->ModelBilling->list_laporan()->result(),
      'biaya_adm' => $biaya['biaya_adm'],
    );
    $this->load->view('index',$data);
  }
  function tagihan()
  {
    if(isset($_POST['simpan'])){
      $id_kunjungan = $this->input->post('no_kunjungan');
    }else{
      $id_kunjungan = $this->uri->segment(3);
    }
    $biaya = $this->ModelBilling->biaya()->row_array();
    $biaya_administrasi = $biaya['rawat_inap'];
    $biaya_blanko = $biaya['blanko'];
    $biaya_rekam_medis = $biaya['rekam_medis'];
    $data_kunjungan = $this->ModelBilling->data_ranap($id_kunjungan);
    if ($data_kunjungan['administrasi']==0) {
      $biaya_administrasi = 0;
    }
    $prefix = "RANAP";
    $no_invoice = $prefix.date('Ymd',strtotime($data_kunjungan['tgl'])).str_pad($data_kunjungan['no_antrian'],3,"0",STR_PAD_LEFT);
    // $all_periksa = $this->ModelBilling->get_all_periksa($data_kunjungan['idrujukan_internal']);
    $all_periksa = $this->ModelBilling->get_all_periksa2($id_kunjungan);
    $total_jasa = 0;
    $total_lab = 0;
    $total_resep = 0;
    $total_dapur = 0;
    $dapur = $this->ModelBilling->get_tot_dapur($id_kunjungan);
    // die(var_dump($dapur));
    $total_dapur += $dapur['jumlah'];
    $tanggal1 = new DateTime($data_kunjungan['tgl']);
    $tanggal2 = new DateTime();
    $lama = $tanggal2->diff($tanggal1)->format("%a");
    if ($lama==0) {
      $lama=1;
    }
    $data_kamar = $this->ModelBilling->get_riwayat_kamar($id_kunjungan);
    $harga_kamar = 0;
    foreach ($data_kamar as $data) {
      $tanggal1 = new DateTime($data->tanggal);
      if ($data->tanggal_akhir!=NULL) {
        $tanggal2 = new DateTime($data->tanggal_akhir);
        // die();
      }else{
        $tanggal2 = new DateTime();
      }
      $perbedaan = $tanggal2->diff($tanggal1)->format("%a");
      if ($perbedaan==0) {
        $perbedaan=1;
      }
      $harga_kamar += $data->tarif*$perbedaan;
    }


    $detil_dapur = $this->ModelBilling->get_detil_dapur($id_kunjungan);
    $id_resep = array();
    if (!empty($all_periksa)) {

      foreach ($all_periksa as $value) {
        $data_resep = $this->ModelBilling->data_resep($value->idperiksa)->row_array();
        $detail_resep = $this->ModelBilling->total_resep($data_resep['no_resep'])->row_array();

        $data_tindakan = $this->ModelBilling->japel_ranap($value->idperiksa)->result();
        $lab = $this->ModelBilling->totallab_ranap($value->idperiksa)->row_array();

        $total_js = 0;
        foreach ($data_tindakan as $data) {
          $total_js += $data->harga;
        }
        array_push($id_resep,$data_resep['no_resep']);
        $total_lab += $lab['harga'];
        $total_jasa += $total_js;
        $total_resep += $detail_resep['total_harga'];
      }
    }
    $bhp = $this->ModelBilling->total_bhp($id_kunjungan);
    $detail_bhp = $this->ModelBilling->detail_bhp($id_kunjungan);
    $total_resep += !empty($bhp)?$bhp['jumlah']:0;
    $data_billing = array();
    array_push($data_billing,array(
      'pembayaran' => 'Adminitrasi Loket',
      'harga' => $biaya_administrasi,
      'opsi' => false
    ));

    array_push($data_billing,array(
      'pembayaran' => 'Adminitrasi Rekam Medis',
      'harga' => $biaya_rekam_medis,
      'opsi' => false
    ));
    array_push($data_billing,array(
      'pembayaran' => 'Blanko',
      'harga' => $biaya_blanko,
      'opsi' => false
    ));
    array_push($data_billing,array(
      'pembayaran' => 'Jasa/Tindakan Medis',
      'harga' => $total_jasa,
      'opsi' => 'japel'
    ));
    array_push($data_billing,array(
      'pembayaran' => 'Obat Dan Bahan',
      'harga' => $total_resep,
      'opsi' => 'resep'
    ));

    array_push($data_billing,array(
      'pembayaran' => 'Laboratorium',
      'harga' => $total_lab,
      'opsi' => 'lab'
    ));
    array_push($data_billing,array(
      'pembayaran' => 'Sewa Kamar '.$lama.' Hari',
      'harga' => $harga_kamar,
      'opsi' => 'kamar'
    ));
    array_push($data_billing,array(
      'pembayaran' => 'Biaya Makan',
      'harga' => $total_dapur,
      'opsi' => 'dapur'
    ));

    $total = $biaya_rekam_medis+$biaya_administrasi+$total_jasa+$total_resep+$total_lab+$harga_kamar+$total_dapur+$biaya_blanko;
    $ppn = 0;
    $total_billing = $total+$ppn;
    if (!empty($id_resep)) {
      $detil_res = $this->ModelBilling->detail_resep2($id_resep)->result();
    }else{
      $detil_res = null;
    }

    $deposit = $this->db->select("SUM(jumlah_deposit) as jumlah_deposit")->get_where('deposit',array('kunjungan_no_urutkunjungan'=>$id_kunjungan))->row_array();
    if (!empty($deposit)) {
      $depo = $deposit['jumlah_deposit'];
    }else{
      $depo = 0;
    }
    $total_akhir = $total-$depo;
    $total_akhir = $total_akhir < 0? 0 : $total_akhir;

    if ($total_akhir==0) {
      $terbilang = "nol";
    }else{
      $terbilang = $this->ModelBilling->terbilang($total_akhir);
    }

    $no_tagihan = "TG/".date('m',strtotime($data_kunjungan['tgl']))."/".date('Y',strtotime($data_kunjungan['tgl']))."/".str_pad($data_kunjungan['no_urutkunjungan'],8,"0",STR_PAD_LEFT);

    $data = array(
      'id'=>$id_kunjungan,
      'body' => "BillingRanap/tagihan",
      'kunjungan' => $data_kunjungan,
      'pasien' => $this->ModelPasien->get_data_edit($data_kunjungan['pasien_noRM'])->row_array(),
      'no_invoice' => $no_invoice,
      'data_billing' => $data_billing,
      'total_resep' => $total_resep,
      'total' => $total,
      'detil_dapur' => $detil_dapur,
      'ppn' => $ppn,
      'data' => $data_kunjungan,
      'no' => $no_tagihan,
      'total_akhir' => $total_akhir,
      'deposit' => $depo,
      'total_billing' => $total_billing,
      'terbilang' => $this->ModelBilling->terbilang($total_billing)." rupiah",
      'detail_resep' => $detil_res,
      'riwayat_kamar' => $data_kamar,
      'detail_bhp' => $detail_bhp,

    );
    $this->load->view('index',$data);
  }
  function invoice()
  {
    if(isset($_POST['simpan'])){
      $id_kunjungan = $this->input->post('no_kunjungan');
    }else{
      $id_kunjungan = $this->uri->segment(3);
    }
    $biaya = $this->ModelBilling->biaya()->row_array();
    $data_kunjungan = $this->ModelBilling->data_ranap($id_kunjungan);
    $biaya_administrasi = $biaya['rawat_inap'];
    $biaya_blanko = $biaya['blanko'];
    $biaya_rekam_medis = $biaya['rekam_medis'];
    if ($data_kunjungan['administrasi']==0) {
      $biaya_administrasi = 0;
    }
    $prefix = "RANAP";
    $no_invoice = $prefix.date('Ymd',strtotime($data_kunjungan['tgl'])).str_pad($data_kunjungan['no_antrian'],3,"0",STR_PAD_LEFT);
    // $all_periksa = $this->ModelBilling->get_all_periksa($data_kunjungan['idrujukan_internal']);
    $all_periksa = $this->ModelBilling->get_all_periksa2($id_kunjungan);
    $total_jasa = 0;
    $total_lab = 0;
    $total_resep = 0;
    $total_dapur = 0;
    $dapur = $this->ModelBilling->get_tot_dapur($id_kunjungan);
    // die(var_dump($dapur));
    $total_dapur += $dapur['jumlah'];
    $tanggal1 = new DateTime($data_kunjungan['tgl']);
    $tanggal2 = new DateTime();
    $lama = $tanggal2->diff($tanggal1)->format("%a");
    if ($lama==0) {
      $lama=1;
    }
    $data_kamar = $this->ModelBilling->get_riwayat_kamar($id_kunjungan);
    $harga_kamar = 0;
    foreach ($data_kamar as $data) {
      $tanggal1 = new DateTime($data->tanggal);
      if ($data->tanggal_akhir!=NULL) {
        $tanggal2 = new DateTime($data->tanggal_akhir);
        // die();
      }else{
        $tanggal2 = new DateTime();
      }
      $perbedaan = $tanggal2->diff($tanggal1)->format("%a");
      if ($perbedaan==0) {
        $perbedaan=1;
      }
      $harga_kamar += $data->tarif*$perbedaan;
    }

    $detil_dapur = $this->ModelBilling->get_detil_dapur($id_kunjungan);
    $id_resep = array();
    if (!empty($all_periksa)) {
      foreach ($all_periksa as $value) {
        $data_resep = $this->ModelBilling->data_resep($value->idperiksa)->row_array();
        $detail_resep = $this->ModelBilling->total_resep($data_resep['no_resep'])->row_array();
        $data_tindakan = $this->ModelBilling->japel_ranap($value->idperiksa)->result();
        $lab = $this->ModelBilling->totallab_ranap($value->idperiksa)->row_array();
        $total_js = 0;
        foreach ($data_tindakan as $data) {
          $total_js += $data->harga;
        }
        array_push($id_resep,$data_resep['no_resep']);
        $total_lab += $lab['harga'];
        $total_jasa += $total_js;
        $total_resep += $detail_resep['total_harga'];
      }
    }
    $bhp = $this->ModelBilling->total_bhp($id_kunjungan);
    $detail_bhp = $this->ModelBilling->detail_bhp($id_kunjungan);
    $total_resep += !empty($bhp)?$bhp['jumlah']:0;
    $data_billing = array();
    array_push($data_billing,array(
      'pembayaran' => 'Adminitrasi Loket',
      'harga' => $biaya_administrasi,
      'opsi' => false
    ));

    array_push($data_billing,array(
      'pembayaran' => 'Adminitrasi Rekam Medis',
      'harga' => $biaya_rekam_medis,
      'opsi' => false
    ));

    array_push($data_billing,array(
      'pembayaran' => 'Blanko',
      'harga' => $biaya_blanko,
      'opsi' => false
    ));
    array_push($data_billing,array(
      'pembayaran' => 'Jasa/Tindakan Medis',
      'harga' => $total_jasa,
      'opsi' => 'japel'
    ));
    array_push($data_billing,array(
      'pembayaran' => 'Obat Dan Bahan',
      'harga' => $total_resep,
      'opsi' => 'resep'
    ));
    array_push($data_billing,array(
      'pembayaran' => 'Laboratorium',
      'harga' => $total_lab,
      'opsi' => 'lab'
    ));
    array_push($data_billing,array(
      'pembayaran' => 'Sewa Kamar '.$lama.' Hari',
      'harga' => $harga_kamar,
      'opsi' => 'kamar'
    ));
    array_push($data_billing,array(
      'pembayaran' => 'Biaya Makan',
      'harga' => $total_dapur,
      'opsi' => 'dapur'
    ));
    $total = $biaya_rekam_medis+$biaya_administrasi+$total_jasa+$total_resep+$total_lab+$harga_kamar+$total_dapur+$biaya_blanko;

    $deposit = $this->db->select("SUM(jumlah_deposit) as jumlah_deposit")->get_where('deposit',array('kunjungan_no_urutkunjungan'=>$id_kunjungan))->row_array();
    if (!empty($deposit)) {
      $depo = $deposit['jumlah_deposit'];
    }else{
      $depo = 0;
    }
    $ppn = 0 ;
    $total_akhir = $total-$depo;
    $total_akhir = $total_akhir < 0? 0 : $total_akhir;
    $total_billing = $total;

    if ($total_akhir==0) {
      $terbilang = "nol";
    }else{
      $terbilang = $this->ModelBilling->terbilang($total_akhir);
    }

    $no_tagihan = "TG/".date('m',strtotime($data_kunjungan['tgl']))."/".date('Y',strtotime($data_kunjungan['tgl']))."/".str_pad($data_kunjungan['no_urutkunjungan'],8,"0",STR_PAD_LEFT);

    if (!empty($id_resep)) {
      $detil_res = $this->ModelBilling->detail_resep2($id_resep)->result();
    }else{
      $detil_res = null;
    }

    $data = array(
      'id'=>$id_kunjungan,
      'body' => "BillingRanap/invoice",
      'pasien' => $this->ModelPasien->get_data_edit($data_kunjungan['pasien_noRM'])->row_array(),
      'no_invoice' => $no_invoice,
      'data_billing' => $data_billing,
      'total_resep' => $total_resep,
      'total' => $total,
      'detil_dapur' => $detil_dapur,
      'ppn' => $ppn,
      'data' => $data_kunjungan,
      'no' => $no_tagihan,
      'total_akhir' => $total_akhir,
      'deposit' => $depo,
      'total_billing' => $total_billing,
      'terbilang' => $this->ModelBilling->terbilang($total_billing)." rupiah",
      'detail_resep' => $detil_res,
      'riwayat_kamar' => $data_kamar,
      'detail_bhp' => $detail_bhp,
    );
    $this->load->view('index',$data);
  }
  function input_tagihan($value='')
  {
    $noRM = $this->input->post("noRM");
    $nama = $this->input->post("nama");
    $kode = $this->ModelAkuntansi->generete_notrans();
    $nokun = $this->input->post('id');
    $jam = date("H:i:s");
    $data_kunjungan = $this->ModelKunjungan->get_data_edit($nokun);
    $norm = $noRM;
    $data = array(
      'cetak_billing'     => 1
    );
    $this->db->where('no_urutkunjungan', $this->input->post('id'));
    $this->db->update('kunjungan', $data);
    //semua resep rawat jalan
    $resep_rajal = $this->ModelRanap->get_all_resep($nokun,$data_kunjungan['tupel_kode_tupel']);
    $persediaan_obat1 = 0;
    $pendapatan1 = 0;
    if (!empty($resep_rajal)) {
      foreach ($resep_rajal as $value) {
        $tot_persediaan = $value->harga_beli_satuan_kecil*$value->jumlah;
        $tot_pendapatan = $value->total_harga;
        $persediaan_obat1 += $tot_persediaan;
        $pendapatan1 += $tot_pendapatan;
      }
    }
    $bhp_rajal = $this->ModelRanap->get_all_bhp($nokun,$data_kunjungan['tupel_kode_tupel']);
    if (!empty($bhp_rajal)) {
      foreach ($bhp_rajal as $value) {
        $tot_persediaan = $value->harga_beli_satuan_kecil*$value->jumlah;
        $tot_pendapatan = $value->total_harga;
        $persediaan_obat1 += $tot_persediaan;
        $pendapatan1 += $tot_pendapatan;
      }
    }
    //semua resep rawat inap
    $resep_ranap = $this->ModelRanap->get_all_resep($nokun,"RANAP");
    $persediaan_obat2 = 0;
    $pendapatan2 = 0;
    foreach ($resep_ranap as $value) {
      $tot_persediaan = $value->harga_beli_satuan_kecil*$value->jumlah;
      $tot_pendapatan = $value->total_harga;
      $persediaan_obat2 += $tot_persediaan;
      $pendapatan2 += $tot_pendapatan;
    }
    $bhp_ranap = $this->ModelRanap->get_all_bhp($nokun,"RANAP");
    if (!empty($bhp_ranap)) {
      // code...
      foreach ($bhp_ranap as $value) {
        $tot_persediaan = $value->harga_beli_satuan_kecil*$value->jumlah;
        $tot_pendapatan = $value->total_harga;
        $persediaan_obat2 += $tot_persediaan;
        $pendapatan2 += $tot_pendapatan;
      }
    }
    $pendapatan_obat = $pendapatan1+$pendapatan2;
    $harga_beli = $persediaan_obat1+$persediaan_obat2;

    //total tindakan rajal dan ranap
    $tindakan_rajal =$this->ModelRanap->get_tindakan($nokun,$data_kunjungan['tupel_kode_tupel']);
    $tindakan_ranap = $this->ModelRanap->get_tindakan($nokun,"RANAP");

    //remunerasi
    $total_monev = $this->ModelRanap->get_monev($nokun);
    //get_lab
    $lab_rajal = $this->ModelRanap->get_jurnal_lab($nokun,$data_kunjungan['tupel_kode_tupel']);
    $lab_ranap = $this->ModelRanap->get_jurnal_lab($nokun,"RANAP");

    $deposit = $this->input->post("deposit");
    $harus_bayar = $this->input->post("harus_bayar");
    $data_billing = array(
      'kunjungan_no_urutkunjungan'  => $this->input->post('id'),
      'kode_invoice' => $this->input->post('invoice'),
      'tanggal'                     => date('Y-m-d'),
      'admin'                       => $this->input->post('hrg[0]'),
      'rekam_medis'                 => $this->input->post('hrg[1]'),
      'blanko'                      => $this->input->post('hrg[2]'),
      'obat'                        => $this->input->post('hrg[4]'),
      'tindakan'                    => $this->input->post('hrg[3]'),
      'laborat'                     => $this->input->post('hrg[5]'),
      'kamar'                       => $this->input->post('hrg[6]'),
      'umakan'                      => $this->input->post('hrg[7]'),
      'total'                       => $this->input->post('total'),
      'ppn'                         => $this->input->post('ppn'),
      'byasuransi'                  => $this->input->post('asuransi'),
      'diskon'                      => $this->input->post('diskon'),
      'bayar'                       => $this->input->post('bayar'),
      'jml_bayar'                   => $this->Core->combine_harga($this->input->post('jml_bayar')),
      'kembalian'                   => $this->Core->combine_harga($this->input->post('kembalian')),
      'status_bayar'                => 1,
      'jam'                         => date('H:i:s'),
      'opr'                         => $_SESSION['nik']
    );
    $jasa = $data_billing['tindakan'];
    $lab = $data_billing['laborat'];
    $total_transaksi = $data_billing['bayar'];

    $pendapatan_ranap = $total_transaksi-($pendapatan_obat+$data_billing['admin']+$jasa+$lab+$data_billing['rekam_medis']+$data_billing['blanko']+$data_billing['kamar']+$data_billing['umakan']);
    $jurnal = array(
      'tanggal' => date("Y-m-d"),
      'keterangan' => 'Transaksi nomor kunjungan '.$nokun,
      'norek' => '40807',
      'debet' => 0,
      'kredit' => $pendapatan_ranap,
      'no_transaksi' => $kode,
      'jam' => date("H:i:s"),
      'no_urut' => $this->input->post('id'),
      'pasien_noRM' => $norm
    );
    $jurnal1 = array(
      'tanggal' => date("Y-m-d"),
      'keterangan' => 'Transaksi nomor kunjungan '.$nokun,
      'norek' => "10201",
      'debet' => $total_transaksi,
      'kredit' => 0,
      'no_transaksi' => $kode,
      'jam' => date("H:i:s"),
      'no_urut' => $this->input->post('id'),
      'pasien_noRM' => $norm
    );

    $this->db->insert('jurnal',$jurnal1);
    if ($pendapatan_ranap!=0) {
      $this->db->insert('jurnal',$jurnal);
    }
    if ($deposit !=0 && $deposit<$total_transaksi) {
      $jurnal = array(
        'tanggal' => date("Y-m-d"),
        'keterangan' => 'Transaksi nomor kunjungan '.$nokun,
        'norek' => '20701',
        'debet' => $deposit,
        'kredit' => 0,
        'no_transaksi' => $kode,
        'jam' => date("H:i:s"),
        'no_urut' => $this->input->post('id'),
        'pasien_noRM' => $norm
      );
      $jurnal1 = array(
        'tanggal' => date("Y-m-d"),
        'keterangan' => 'Transaksi nomor kunjungan '.$nokun,
        'norek' => "10201",
        'debet' => 0,
        'kredit' => $deposit,
        'no_transaksi' => $kode,
        'jam' => date("H:i:s"),
        'no_urut' => $this->input->post('id'),
        'pasien_noRM' => $norm
      );

      $this->db->insert('jurnal',$jurnal);
      $this->db->insert('jurnal',$jurnal1);
    }
    if ($deposit != 0 && $deposit>=$total_transaksi1) {
      // code...
      $data_billing['jml_bayar'] = $deposit ;
      $kembalian1 = $deposit-$total_transaksi1;
      $data_billing['kembalian'] = $kembalian1;
      $this->db->insert("billing",$data_billing);
      $jurnal = array(
        'tanggal' => date("Y-m-d"),
        'keterangan' => 'Transaksi nomor kunjungan '.$nokun,
        'norek' => '10201',
        'debet' => 0,
        'kredit' => $total_transaksi1,
        'no_transaksi' => $kode,
        'jam' => date("H:i:s"),
        'no_urut' => $this->input->post('id'),
        'pasien_noRM' => $norm
      );
      $jurnal1 = array(
        'tanggal' => date("Y-m-d"),
        'keterangan' => 'Transaksi nomor kunjungan '.$nokun,
        'norek' => '20701',
        'debet' => $deposit,
        'kredit' => 0,
        'no_transaksi' => $kode,
        'jam' => date("H:i:s"),
        'no_urut' => $this->input->post('id'),
        'pasien_noRM' => $norm
      );
      $jurnal2 = array(
        'tanggal' => date("Y-m-d"),
        'keterangan' => 'Transaksi nomor kunjungan '.$nokun,
        'norek' => "10001",
        'debet' => 0,
        'kredit' => $kembalian1,
        'no_transaksi' => $kode,
        'jam' => date("H:i:s"),
        'no_urut' => $this->input->post('id'),
        'pasien_noRM' => $norm
      );
      $this->db->insert('jurnal',$jurnal1);
      $this->db->insert('jurnal',$jurnal);
      $this->db->insert('jurnal',$jurnal2);
      $data = array(
        'jam_keluar'  => date('Y-m-d H:i:s'),
        'billing'     => 1
      );
      $this->db->where('no_urutkunjungan', $this->input->post('id'));
      $this->db->update('kunjungan', $data);
    }
    //piutang obat terhadap pendapatan obat
    $jurnal = array(
      'tanggal' => date("Y-m-d"),
      'keterangan' => 'Transaksi nomor kunjungan '.$nokun,
      'norek' => '10207',
      'debet' => $pendapatan_obat,
      'kredit' => 0,
      'no_transaksi' => $kode,
      'jam' => date("H:i:s"),
      'no_urut' => $this->input->post('id'),
      'pasien_noRM' => $norm
    );
    $jurnal1 = array(
      'tanggal' => date("Y-m-d"),
      'keterangan' => 'Transaksi nomor kunjungan '.$nokun,
      'norek' => "40401",
      'debet' => 0,
      'kredit' => $pendapatan_obat,
      'no_transaksi' => $kode,
      'jam' => date("H:i:s"),
      'no_urut' => $this->input->post('id'),
      'pasien_noRM' => $norm
    );
    if ($pendapatan_obat!=0) {
      // code...
      // $this->db->insert('jurnal',$jurnal);
      $this->db->insert('jurnal',$jurnal1);
    }

    //Adminitrasi
    $jurnal = array(
      'tanggal' => date("Y-m-d"),
      'keterangan' => 'Transaksi nomor kunjungan '.$nokun,
      'norek' => '10203',
      'debet' => $data_billing['admin'],
      'kredit' => 0,
      'no_transaksi' => $kode,
      'jam' => date("H:i:s"),
      'no_urut' => $this->input->post('id'),
      'pasien_noRM' => $norm
    );
    $jurnal1 = array(
      'tanggal' => date("Y-m-d"),
      'keterangan' => 'Transaksi nomor kunjungan '.$nokun,
      'norek' => "40701",
      'debet' => 0,
      'kredit' => $data_billing['admin'],
      'no_transaksi' => $kode,
      'jam' => date("H:i:s"),
      'no_urut' => $this->input->post('id'),
      'pasien_noRM' => $norm
    );
    if ($data_billing['admin']!=0) {
      // code...
      // $this->db->insert('jurnal',$jurnal);
      $this->db->insert('jurnal',$jurnal1);
    }

    //jasa dan tindakan medis
    $jurnal = array(
      'tanggal' => date("Y-m-d"),
      'keterangan' => 'Transaksi nomor kunjungan '.$nokun,
      'norek' => '10204',
      'debet' => $jasa,
      'kredit' => 0,
      'no_transaksi' => $kode,
      'jam' => date("H:i:s"),
      'no_urut' => $this->input->post('id'),
      'pasien_noRM' => $norm
    );
    $jurnal1 = array(
      'tanggal' => date("Y-m-d"),
      'keterangan' => 'Transaksi nomor kunjungan '.$nokun,
      'norek' => '40001',
      'debet' => 0,
      'kredit' => $jasa,
      'no_transaksi' => $kode,
      'jam' => date("H:i:s"),
      'no_urut' => $this->input->post('id'),
      'pasien_noRM' => $norm
    );
    if ($jasa!=0) {
      // code...
      // $this->db->insert('jurnal',$jurnal);
      $this->db->insert('jurnal',$jurnal1);
    }

    //Laborat
    $jurnal = array(
      'tanggal' => date("Y-m-d"),
      'keterangan' => 'Transaksi nomor kunjungan '.$nokun,
      'norek' => '10205',
      'debet' => $lab,
      'kredit' => 0,
      'no_transaksi' => $kode,
      'jam' => date("H:i:s"),
      'no_urut' => $this->input->post('id'),
      'pasien_noRM' => $norm
    );
    $jurnal1 = array(
      'tanggal' => date("Y-m-d"),
      'keterangan' => 'Transaksi nomor kunjungan '.$nokun,
      'norek' => '40501',
      'debet' => 0,
      'kredit' => $lab,
      'no_transaksi' => $kode,
      'jam' => date("H:i:s"),
      'no_urut' => $this->input->post('id'),
      'pasien_noRM' => $norm
    );

    if ($lab!=0) {
      // code...
      // $this->db->insert('jurnal',$jurnal);
      $this->db->insert('jurnal',$jurnal1);
    }

    //rekam medis
    $jurnal = array(
      'tanggal' => date("Y-m-d"),
      'keterangan' => 'Transaksi nomor kunjungan '.$nokun,
      'norek' => '10206',
      'debet' => $data_billing['rekam_medis'],
      'kredit' => 0,
      'no_transaksi' => $kode,
      'jam' => date("H:i:s"),
      'no_urut' => $this->input->post('id'),
      'pasien_noRM' => $norm
    );
    $jurnal1 = array(
      'tanggal' => date("Y-m-d"),
      'keterangan' => 'Transaksi nomor kunjungan '.$nokun,
      'norek' => '40704',
      'debet' => 0,
      'kredit' => $data_billing['rekam_medis'],
      'no_transaksi' => $kode,
      'jam' => date("H:i:s"),
      'no_urut' => $this->input->post('id'),
      'pasien_noRM' => $norm
    );
    if ($data_billing['rekam_medis']!=0) {
      // code...
      // $this->db->insert('jurnal',$jurnal);
      $this->db->insert('jurnal',$jurnal1);
    }

    //beban di muka terhadap hpp obat
    $jurnal = array(
      'tanggal' => date("Y-m-d"),
      'keterangan' => 'Transaksi nomor kunjungan '.$nokun,
      'norek' => '50002',
      'debet' => $harga_beli,
      'kredit' => 0,
      'no_transaksi' => $kode,
      'jam' => date("H:i:s"),
      'no_urut' => $this->input->post('id'),
      'pasien_noRM' => $norm
    );
    $jurnal1 = array(
      'tanggal' => date("Y-m-d"),
      'keterangan' => 'Transaksi nomor kunjungan '.$nokun,
      'norek' => "10701",
      'debet' => 0,
      'kredit' => $harga_beli,
      'no_transaksi' => $kode,
      'jam' => date("H:i:s"),
      'no_urut' => $this->input->post('id'),
      'pasien_noRM' => $norm
    );
    if ($harga_beli!=0) {
      // code...
      $this->db->insert('jurnal',$jurnal);
      $this->db->insert('jurnal',$jurnal1);
    }

    //beban di muka terhadap hpp jasa medis
    $jurnal = array(
      'tanggal' => date("Y-m-d"),
      'keterangan' => 'Transaksi nomor kunjungan '.$nokun,
      'norek' => '50003',
      'debet' => $total_monev,
      'kredit' => 0,
      'no_transaksi' => $kode,
      'jam' => date("H:i:s"),
      'no_urut' => $this->input->post('id'),
      'pasien_noRM' => $norm
    );
    $jurnal1 = array(
      'tanggal' => date("Y-m-d"),
      'keterangan' => 'Transaksi nomor kunjungan '.$nokun,
      'norek' => "10701",
      'debet' => 0,
      'kredit' => $total_monev,
      'no_transaksi' => $kode,
      'jam' => date("H:i:s"),
      'no_urut' => $this->input->post('id'),
      'pasien_noRM' => $norm
    );
    if ($total_monev!=0) {
      // code...
      $this->db->insert('jurnal',$jurnal);
      $this->db->insert('jurnal',$jurnal1);
    }

    //piutang blanko terhadap pendapatan blanko
    $jurnal = array(
      'tanggal' => date("Y-m-d"),
      'keterangan' => 'Transaksi nomor kunjungan '.$nokun,
      'norek' => '10208',
      'debet' => $data_billing['blanko'],
      'kredit' => 0,
      'no_transaksi' => $kode,
      'jam' => date("H:i:s"),
      'no_urut' => $this->input->post('id'),
      'pasien_noRM' => $norm
    );
    $jurnal1 = array(
      'tanggal' => date("Y-m-d"),
      'keterangan' => 'Transaksi nomor kunjungan '.$nokun,
      'norek' => "40705",
      'debet' => 0,
      'kredit' => $data_billing['blanko'],
      'no_transaksi' => $kode,
      'jam' => date("H:i:s"),
      'no_urut' => $this->input->post('id'),
      'pasien_noRM' => $norm
    );
    if ($data_billing['blanko']!=0) {
      // code...
      // $this->db->insert('jurnal',$jurnal);
      $this->db->insert('jurnal',$jurnal1);
    }

    //kamar
    $jurnal = array(
      'tanggal' => date("Y-m-d"),
      'keterangan' => 'Transaksi nomor kunjungan '.$nokun,
      'norek' => '10209',
      'debet' => $data_billing['kamar'],
      'kredit' => 0,
      'no_transaksi' => $kode,
      'jam' => date("H:i:s"),
      'no_urut' => $this->input->post('id'),
      'pasien_noRM' => $norm
    );
    $jurnal1 = array(
      'tanggal' => date("Y-m-d"),
      'keterangan' => 'Transaksi nomor kunjungan '.$nokun,
      'norek' => "40601",
      'debet' => 0,
      'kredit' => $data_billing['kamar'],
      'no_transaksi' => $kode,
      'jam' => date("H:i:s"),
      'no_urut' => $this->input->post('id'),
      'pasien_noRM' => $norm
    );
    if ($data_billing['kamar']!=0) {
      // code...
      // $this->db->insert('jurnal',$jurnal);
      $this->db->insert('jurnal',$jurnal1);
    }

    //makan pasien
    $jurnal = array(
      'tanggal' => date("Y-m-d"),
      'keterangan' => 'Transaksi nomor kunjungan '.$nokun,
      'norek' => '10210',
      'debet' => $data_billing['umakan'],
      'kredit' => 0,
      'no_transaksi' => $kode,
      'jam' => date("H:i:s"),
      'no_urut' => $this->input->post('id'),
      'pasien_noRM' => $norm
    );
    $jurnal1 = array(
      'tanggal' => date("Y-m-d"),
      'keterangan' => 'Transaksi nomor kunjungan '.$nokun,
      'norek' => "40602",
      'debet' => 0,
      'kredit' => $data_billing['umakan'],
      'no_transaksi' => $kode,
      'jam' => date("H:i:s"),
      'no_urut' => $this->input->post('id'),
      'pasien_noRM' => $norm
    );
    if ($data_billing['umakan']!=0) {
      // code...
      // $this->db->insert('jurnal',$jurnal);
      $this->db->insert('jurnal',$jurnal1);
    }

    redirect("BillingRanap/print_tagihan/".$this->input->post('id'));
  }

  function input($value='')
  {
    $noRM = $this->input->post("noRM");
    $nama = $this->input->post("nama");
    $kode = $this->ModelAkuntansi->generete_notrans();
    $nokun = $this->input->post('id');
    $data = array(
      'jam_keluar'  => date('Y-m-d H:i:s'),
      'billing'     => 1,
      'sudah' => 5,
    );
    $jam = date("H:i:s");
    $data_kunjungan = $this->ModelKunjungan->get_data_edit($nokun);
    $this->db->where('no_tt',$data_kunjungan['tempat_tidur_no_tt'])->update('tempat_tidur',array('status_terisi'=>0));
    $this->db->where('no_urutkunjungan', $this->input->post('id'));
    $this->db->update('kunjungan', $data);

    //koding jurnal
    //semua resep rawat jalan
    $resep_rajal = $this->ModelRanap->get_all_resep($nokun,$data_kunjungan['tupel_kode_tupel']);
    $persediaan_obat1 = 0;
    $pendapatan1 = 0;
    // die(var_dump($resep_rajal));
    if (!empty($resep_rajal) || $resep_rajal!=0) {
      foreach ($resep_rajal as $value) {
        $tot_persediaan = $value->harga_beli_satuan_kecil*$value->jumlah;
        $tot_pendapatan = $value->total_harga;
        $persediaan_obat1 += $tot_persediaan;
        $pendapatan1 += $tot_pendapatan;
      }
    }
    $bhp_rajal = $this->ModelRanap->get_all_bhp($nokun,$data_kunjungan['tupel_kode_tupel']);
    if (!empty($bhp_rajal)) {
      foreach ($bhp_rajal as $value) {
        $tot_persediaan = $value->harga_beli_satuan_kecil*$value->jumlah;
        $tot_pendapatan = $value->total_harga;
        $persediaan_obat1 += $tot_persediaan;
        $pendapatan1 += $tot_pendapatan;
      }
    }
    //semua resep rawat inap
    $resep_ranap = $this->ModelRanap->get_all_resep($nokun,"RANAP");
    $persediaan_obat2 = 0;
    $pendapatan2 = 0;
    if (!empty($resep_ranap) || $resep_ranap!=null) {
      // code...
      foreach ($resep_ranap as $value) {
        $tot_persediaan = $value->harga_beli_satuan_kecil*$value->jumlah;
        $tot_pendapatan = $value->total_harga;
        $persediaan_obat2 += $tot_persediaan;
        $pendapatan2 += $tot_pendapatan;
      }
    }
    $bhp_ranap = $this->ModelRanap->get_all_bhp($nokun,"RANAP");
    if (!empty($bhp_ranap)) {
      // code...
      foreach ($bhp_ranap as $value) {
        $tot_persediaan = $value->harga_beli_satuan_kecil*$value->jumlah;
        $tot_pendapatan = $value->total_harga;
        $persediaan_obat2 += $tot_persediaan;
        $pendapatan2 += $tot_pendapatan;
      }
    }
    $pendapatan_selisih_rajal = $pendapatan1-$persediaan_obat1;
    $pendapatan_selisih_ranap = $pendapatan2-$persediaan_obat2;
    //total tindakan rajal dan ranap
    $tindakan_rajal =$this->ModelRanap->get_tindakan($nokun,$data_kunjungan['tupel_kode_tupel']);
    $tindakan_ranap = $this->ModelRanap->get_tindakan($nokun,"RANAP");

    //get_lab
    $lab_rajal = $this->ModelRanap->get_jurnal_lab($nokun,$data_kunjungan['tupel_kode_tupel']);
    $lab_ranap = $this->ModelRanap->get_jurnal_lab($nokun,"RANAP");

    $data_billing = array(
      'kunjungan_no_urutkunjungan'  => $this->input->post('id'),
      'kode_invoice' => $this->input->post('invoice'),
      'tanggal'                     => date('Y-m-d'),
      'admin'                       => $this->input->post('hrg[0]')+$this->input->post('hrg[1]'),
      'obat'                        => $this->input->post('hrg[3]'),
      'tindakan'                    => $this->input->post('hrg[2]'),
      'laborat'                     => $this->input->post('hrg[4]'),
      'kamar'                       => $this->input->post('hrg[5]'),
      'umakan'                      => $this->input->post('hrg[6]'),
      'total'                       => $this->input->post('total'),
      'ppn'                         => $this->input->post('ppn'),
      'byasuransi'                  => $this->input->post('asuransi'),
      'diskon'                      => $this->input->post('diskon'),
      'bayar'                       => $this->input->post('bayar'),
      'jml_bayar'                   => $this->Core->combine_harga($this->input->post('jml_bayar')),
      'kembalian'                   => $this->Core->combine_harga($this->input->post('kembalian')),
      'status_bayar'                => 1,
      'jam'                         => date('H:i:s'),
      'opr'                         => $_SESSION['nik']
    );
    $this->db->reset_query();
    $this->db->insert('billing', $data_billing);
    $jml_bayar = $data_billing['jml_bayar'];
    if ($jml_bayar > $data_billing['bayar']) {
      $jml_bayar = $data_billing['bayar'];
    }
    //piutang terhadap kas
    $jurnal = array(
      'tanggal' => date("Y-m-d"),
      'keterangan' => 'Transaksi nomor kunjungan '.$nokun,
      'norek' => '10001',
      'debet' => $jml_bayar,
      'kredit' => 0,
      'no_transaksi' => $kode,
      'jam' => date("H:i:s"),
      'no_urut' => $this->input->post('id'),
      'pasien_noRM' => $norm
    );
    $jurnal1 = array(
      'tanggal' => date("Y-m-d"),
      'keterangan' => 'Transaksi nomor kunjungan '.$nokun,
      'norek' => "10201",
      'debet' => 0,
      'kredit' => $jml_bayar,
      'no_transaksi' => $kode,
      'jam' => date("H:i:s"),
      'no_urut' => $this->input->post('id'),
      'pasien_noRM' => $norm
    );
    $this->db->insert('jurnal',$jurnal);
    $this->db->insert('jurnal',$jurnal1);


    $this->session->set_flashdata('notif',$this->Notif->berhasil("Pembayaran berhasil dilakukan"));
    redirect("BillingRanap");
  }

  function coba()
  {
    echo $this->Core->combine_harga($this->input->post('jml_bayar'));
  }
  function get_prefix($data){
    if ($data =='UMU') {
      $prefix = "PUMU";
    }else if($data =='GIG'){
      $prefix = "PGIG";
    }else if($data =='OBG'){
      $prefix = "POBG";
    }else if($data =='INT'){
      $prefix = "PINT";
    }else{
      $prefix = "PIGD";
    }
    return $prefix;
  }
  function print_tagihan()
  {
    if(isset($_POST['simpan'])){
      $id_kunjungan = $this->input->post('no_kunjungan');
    }else{
      $id_kunjungan = $this->uri->segment(3);
    }
    $hasil_billing = $this->db->get_where('billing',array('kunjungan_no_urutkunjungan'=>$id_kunjungan))->row_array();
    $biaya = $this->ModelBilling->biaya()->row_array();
    $biaya_administrasi = $biaya['rawat_inap'];
    $biaya_blanko = $biaya['blanko'];
    $data_kunjungan = $this->ModelBilling->data_ranap($id_kunjungan);
    $biaya_rekam_medis = $biaya['rekam_medis'];
    if ($data_kunjungan['administrasi']==0) {
      $biaya_administrasi = 0;
    }
    $prefix = "RANAP";
    $no_invoice = $prefix.date('Ymd',strtotime($data_kunjungan['tgl'])).str_pad($data_kunjungan['no_antrian'],3,"0",STR_PAD_LEFT);
    $all_periksa = $this->ModelBilling->get_all_periksa2($id_kunjungan);

    $total_jasa = 0;
    $total_lab = 0;
    $total_resep = 0;
    $total_dapur = 0;
    $dapur = $this->ModelBilling->get_tot_dapur($id_kunjungan);
    // die(var_dump($dapur));
    $total_dapur += $dapur['jumlah'];
    $tanggal1 = new DateTime($data_kunjungan['tgl']);
    $tanggal2 = new DateTime($data_kunjungan['jam_keluar']);


    $lama = $tanggal2->diff($tanggal1)->format("%a");
    if ($lama==0) {
      $lama=1;
    }
    $data_kamar = $this->ModelBilling->get_riwayat_kamar($id_kunjungan);
    $harga_kamar = 0;
    foreach ($data_kamar as $data) {
      $tanggal1 = new DateTime($data->tanggal);
      $perbedaan = $tanggal2->diff($tanggal1)->format("%a");
      if ($perbedaan==0) {
        $perbedaan=1;
      }
      $harga_kamar += $data->tarif*$perbedaan;

    }
    $detil_dapur = $this->ModelBilling->get_detil_dapur($id_kunjungan);
    $id_resep = array();
    if (!empty($all_periksa)) {

      foreach ($all_periksa as $value) {
        $data_resep = $this->ModelBilling->data_resep($value->idperiksa)->row_array();
        $detail_resep = $this->ModelBilling->total_resep($data_resep['no_resep'])->row_array();

        $data_tindakan = $this->ModelBilling->japel_ranap($value->idperiksa)->result();
        $lab = $this->ModelBilling->totallab_ranap($value->idperiksa)->row_array();

        $total_js = 0;
        foreach ($data_tindakan as $data) {
          $total_js += $data->harga;
        }
        array_push($id_resep,$data_resep['no_resep']);
        $total_lab += $lab['harga'];
        $total_jasa += $total_js;
        $total_resep += $detail_resep['total_harga'];
      }
    }

    $bhp = $this->ModelBilling->total_bhp($id_kunjungan);
    $detail_bhp = $this->ModelBilling->detail_bhp($id_kunjungan);
    $total_resep += !empty($bhp)?$bhp['jumlah']:0;
    $data_billing = array();
    array_push($data_billing,array(
      'pembayaran' => 'Adminitrasi Loket',
      'harga' => $biaya_administrasi,
      'opsi' => false
    ));

    array_push($data_billing,array(
      'pembayaran' => 'Adminitrasi Rekam Medis',
      'harga' => $biaya_rekam_medis,
      'opsi' => false
    ));
    array_push($data_billing,array(
      'pembayaran' => 'Blanko',
      'harga' => $biaya_blanko,
      'opsi' => false
    ));
    array_push($data_billing,array(
      'pembayaran' => 'Jasa/Tindakan Medis',
      'harga' => $total_jasa,
      'opsi' => 'japel'
    ));
    array_push($data_billing,array(
      'pembayaran' => 'Obat Dan Bahan',
      'harga' => $total_resep,
      'opsi' => 'resep'
    ));

    array_push($data_billing,array(
      'pembayaran' => 'Laboratorium',
      'harga' => $total_lab,
      'opsi' => 'lab'
    ));
    array_push($data_billing,array(
      'pembayaran' => 'Sewa Kamar '.$lama.' Hari',
      'harga' => $harga_kamar,
      'opsi' => 'kamar'
    ));
    array_push($data_billing,array(
      'pembayaran' => 'Biaya Makan',
      'harga' => $total_dapur,
      'opsi' => 'dapur'
    ));
    $total = $biaya_rekam_medis+$biaya_administrasi+$total_jasa+$total_resep+$total_lab+$harga_kamar+$total_dapur+$biaya_blanko;
    $ppn = 0;
    $total_billing = $total+$ppn;
    $data = array(
      'id'=>$id_kunjungan,
      'body' => "BillingRanap/print_tagihan",
      'pasien' => $this->ModelPasien->get_data_edit($data_kunjungan['pasien_noRM'])->row_array(),
      'no_invoice' => $no_invoice,
      'data_billing' => $data_billing,
      'total_resep' => $total_resep,
      'total' => $total,
      'detil_dapur' => $detil_dapur,
      'ppn' => $ppn,
      'total_billing' => $total_billing,
      'terbilang' => $this->ModelBilling->terbilang($total_billing)." rupiah",
      'detail_resep' => $this->ModelBilling->detail_resep2($id_resep)->result(),
      'bayar_billing' => $hasil_billing,
      'riwayat_kamar' => $data_kamar,
      'detail_bhp' => $detail_bhp,
    );
    // die(var_dump($data['billing']));
    $this->load->view('index',$data);
  }
  function print()
  {
    if(isset($_POST['simpan'])){
      $id_kunjungan = $this->input->post('no_kunjungan');
    }else{
      $id_kunjungan = $this->uri->segment(3);
    }
    $hasil_billing = $this->db->get_where('billing',array('kunjungan_no_urutkunjungan'=>$id_kunjungan))->row_array();
    $biaya = $this->ModelBilling->biaya()->row_array();
    $data_kunjungan = $this->ModelBilling->data_ranap($id_kunjungan);
    $biaya_administrasi = $biaya['rawat_inap'];
    $biaya_blanko = $biaya['blanko'];
    $biaya_rekam_medis = $biaya['rekam_medis'];
    if ($data_kunjungan['administrasi']==0) {
      $biaya_administrasi = 0;
    }
    $prefix = "RANAP";
    $no_invoice = $prefix.date('Ymd',strtotime($data_kunjungan['tgl'])).str_pad($data_kunjungan['no_antrian'],3,"0",STR_PAD_LEFT);
    $all_periksa = $this->ModelBilling->get_all_periksa2($id_kunjungan);

    $total_jasa = 0;
    $total_lab = 0;
    $total_resep = 0;
    $total_dapur = 0;
    $dapur = $this->ModelBilling->get_tot_dapur($id_kunjungan);
    // die(var_dump($dapur));
    $total_dapur += $dapur['jumlah'];
    $tanggal1 = new DateTime($data_kunjungan['tgl']);
    $tanggal2 = new DateTime($data_kunjungan['jam_keluar']);


    $lama = $tanggal2->diff($tanggal1)->format("%a");
    if ($lama==0) {
      $lama=1;
    }
    $data_kamar = $this->ModelBilling->get_riwayat_kamar($id_kunjungan);
    $harga_kamar = 0;
    foreach ($data_kamar as $data) {
      $tanggal1 = new DateTime($data->tanggal);
      $perbedaan = $tanggal2->diff($tanggal1)->format("%a");
      if ($perbedaan==0) {
        $perbedaan=1;
      }
      $harga_kamar += $data->tarif*$perbedaan;

    }
    $detil_dapur = $this->ModelBilling->get_detil_dapur($id_kunjungan);
    $id_resep = array();
    if (!empty($all_periksa)) {

      foreach ($all_periksa as $value) {
        $data_resep = $this->ModelBilling->data_resep($value->idperiksa)->row_array();
        $detail_resep = $this->ModelBilling->total_resep($data_resep['no_resep'])->row_array();

        $data_tindakan = $this->ModelBilling->japel_ranap($value->idperiksa)->result();
        $lab = $this->ModelBilling->totallab_ranap($value->idperiksa)->row_array();

        $total_js = 0;
        foreach ($data_tindakan as $data) {
          $total_js += $data->harga;
        }
        array_push($id_resep,$data_resep['no_resep']);
        $total_lab += $lab['harga'];
        $total_jasa += $total_js;
        $total_resep += $detail_resep['total_harga'];
      }
    }

    $bhp = $this->ModelBilling->total_bhp($id_kunjungan);
    $detail_bhp = $this->ModelBilling->detail_bhp($id_kunjungan);
    $total_resep += !empty($bhp)?$bhp['jumlah']:0;
    $data_billing = array();
    array_push($data_billing,array(
      'pembayaran' => 'Adminitrasi Loket',
      'harga' => $biaya_administrasi,
      'opsi' => false
    ));

    array_push($data_billing,array(
      'pembayaran' => 'Adminitrasi Rekam Medis',
      'harga' => $biaya_rekam_medis,
      'opsi' => false
    ));
    array_push($data_billing,array(
      'pembayaran' => 'Blanko',
      'harga' => $biaya_blanko,
      'opsi' => false
    ));
    array_push($data_billing,array(
      'pembayaran' => 'Jasa/Tindakan Medis',
      'harga' => $total_jasa,
      'opsi' => 'japel'
    ));
    array_push($data_billing,array(
      'pembayaran' => 'Obat Dan Bahan',
      'harga' => $total_resep,
      'opsi' => 'resep'
    ));

    array_push($data_billing,array(
      'pembayaran' => 'Laboratorium',
      'harga' => $total_lab,
      'opsi' => 'lab'
    ));
    array_push($data_billing,array(
      'pembayaran' => 'Sewa Kamar '.$lama.' Hari',
      'harga' => $harga_kamar,
      'opsi' => 'kamar'
    ));
    array_push($data_billing,array(
      'pembayaran' => 'Biaya Makan',
      'harga' => $total_dapur,
      'opsi' => 'dapur'
    ));
    $total = $biaya_rekam_medis+$biaya_administrasi+$total_jasa+$total_resep+$total_lab+$harga_kamar+$total_dapur+$biaya_blanko;
    $ppn = 0;
    $total_billing = $total+$ppn;
    $data = array(
      'id'=>$id_kunjungan,
      'body' => "BillingRanap/print",
      'pasien' => $this->ModelPasien->get_data_edit($data_kunjungan['pasien_noRM'])->row_array(),
      'no_invoice' => $no_invoice,
      'data_billing' => $data_billing,
      'total_resep' => $total_resep,
      'total' => $total,
      'detil_dapur' => $detil_dapur,
      'ppn' => $ppn,
      'total_billing' => $total_billing,
      'terbilang' => $this->ModelBilling->terbilang($total_billing)." rupiah",
      'detail_resep' => $this->ModelBilling->detail_resep2($id_resep)->result(),
      'bayar_billing' => $hasil_billing,
      'riwayat_kamar' => $data_kamar,
      'detail_bhp' => $detail_bhp,
    );
    // die(var_dump($data['billing']));
    $this->load->view('index',$data);
  }

  public function resep(){
    $data = $this->ModelResep->get_resep();
    die(var_dump($data));
  }

  public function filter_billing(){
    $tanggal = $this->input->post("tanggal");
    $sts = $this->input->post('sts');
    $poli = $this->input->post('poli');
    // $tanggal = date('Y-m-d');
    // $sts = 0;
    // $poli = 'UMU';
    $data = $this->ModelBilling->data_filter($tanggal,$sts,$poli);
    // die(var_dump($data));
    $html = '';
    $no=1;
    foreach ($data as $value) {
      $id = $value->no_urutkunjungan;
      $warna = "badge-primary";
      $type = "IN";
      $k = $value->kode_tupel;
      if ($k == "UMU"){$warna = "badge-success"; $type="U";}
      elseif($k == "OBG"){$warna = "badge-info";$type="O";}
      elseif ($k == "GIG") {$warna = "badge-warning";$type="G";}
      elseif ($k == "IGD") {$warna = "badge-danger";$type="IG";}
      if ($value->jenis_kunjungan == 0) {
        $s = "Baru";
      } else {
        $s = "Lama";
      }
      if ($value->billing==null || $value->billing!=1) {
        $button = '<a href="'.base_url().'"BillingRanap/invoice/"'.$value->no_urutkunjungan.'">
        <button type="button" class="btn btn-primary btn-sm"
        style="border-bottom-right-radius: 0rem !important;border-top-right-radius: 0rem !important;"> <i class="fa fa-credit-card"></i> Bayar</button>
        </a>';
      }else{
        $button = '<a  target="_blank" href="'.base_url().'"BillingRanap/print/"'.$value->no_urutkunjungan.'">
        <button type="button" class="btn btn-success btn-sm"
        style="border-bottom-right-radius: 0rem !important;border-top-right-radius: 0rem !important;"> <i class="fa fa-print"></i> Print</button>
        </a>';

      }
      $html .= '<tr>
      <td>'.$no.'</td>
      <td><h4><span class="badge badge-pill '.$warna.'">'.$value->tujuan_pelayanan.'</span></h4></td>
      <td>'.date("d-m-Y",strtotime($value->tgl)).'</td>
      <td>'.$value->jam_daftar.'</td>
      <td>'.$type.''.$value->no_antrian.'</td>
      <td>'.$value->pasien_noRM.'</td>
      <td>'.$value->namapasien.'</td>
      <td>'.$s.'</td>
      <td>'.$button.'</td>';
      $no+=1;

    }
    // die(var_dump($html));
    echo $html;
  }
  public function kwitansi(){
    $nokun = $this->uri->segment(3);
    $data_depo = $this->db
    ->join("kunjungan","kunjungan.no_urutkunjungan=billing.kunjungan_no_urutkunjungan")
    ->join("pasien","pasien.noRM=kunjungan.pasien_noRM")
    ->join("pegawai","pegawai.NIK=billing.opr")
    ->join("tujuan_pelayanan","tujuan_pelayanan.kode_tupel=kunjungan.tupel_kode_tupel")
    ->get_where("billing",array("no_urutkunjungan"=>$nokun))->row_array();
    if ($data_depo['jml_bayar']==0) {
      $terbilang = "nol";
    }else{
      $terbilang = $this->ModelBilling->terbilang($data_depo['jml_bayar']);
    }
    $no_depo = "KW/BL/".date('m',strtotime($data_depo['tanggal']))."/".date('Y',strtotime($data_depo['tgl']))."/".str_pad($data_depo['idbilling'],8,"0",STR_PAD_LEFT);
    $data = array(
      'body'        => 'BillingRanap/print_kwitansi',
      'nominal' => $data_depo['jml_bayar'],
      'operator' => $data_depo['nama'],
      'pasien' => $data_depo['namapasien'],
      'terbilang' => $terbilang." rupiah",
      'no' => $no_depo,
      'data' => $data_depo
    );
    $this->load->view('index',$data);
  }
  // public function set_bil(){
  //   $data = $this->db
  //   ->get_where("kunjungan",array("billing"=>1))->result();
  //   // die(var_dump($data));
  //   foreach ($data as $value) {
  //     $this->db->where('no_urutkunjungan',$value->no_urutkunjungan);
  //     $this->db->update("kunjungan",array('cetak_billing'=>1));
  //   }
  //   echo "selesai";
  //
  // }

}
?>
