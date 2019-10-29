<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Billing extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model("ModelKunjungan");
    $this->load->model("ModelBilling");
    $this->load->model('ModelPasien');
    $this->load->model('ModelObat');
    $this->load->model("ModelResep");
    $this->load->model("ModelAkuntansi");
  }

  function index()
  {
    $tgl = date('Y-m-d');
    $biaya = $this->ModelBilling->biaya()->row_array();
    $data = array(
      'body'      => "Billing/index",
      'kunjungan' => $this->ModelBilling->data_list()->result(),
      'biaya_adm' => $biaya['biaya_adm'],
    );
    $this->load->view('index',$data);
  }

  function laporan()
  {
    $tgl = date('Y-m-d');
    $biaya = $this->ModelBilling->biaya()->row_array();
    $data = array(
      'body'      => "Billing/laporan",
      'kunjungan' => $this->ModelBilling->list_laporan()->result(),
      'biaya_adm' => $biaya['biaya_adm'],
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

    $data_kunjungan = $this->ModelKunjungan->get_data_edit($id_kunjungan);
    if ($data_kunjungan['acc_ranap']!=0) {
      $biaya_administrasi = $biaya['rawat_inap'];
    }else{
      $biaya_administrasi = $biaya['rawat_jalan'];
    }
    $biaya_rekam_medis = $biaya['rekam_medis'];
    $data_periksa = $this->ModelBilling->data_periksa($id_kunjungan)->row_array();
    $prefix = $this->get_prefix($data_kunjungan['tupel_kode_tupel']);
    $no_invoice = $prefix.date('Ymd',strtotime($data_kunjungan['tgl'])).str_pad($data_kunjungan['no_antrian'],3,"0",STR_PAD_LEFT);
    $data_resep = $this->ModelBilling->data_resep($data_periksa['idperiksa'])->row_array();
    $detail_resep = $this->ModelBilling->total_resep($data_resep['no_resep'])->row_array();
    $data_tindakan = $this->ModelBilling->japel($id_kunjungan)->result();
    $lab = $this->ModelBilling->totallab($id_kunjungan)->row_array();
    $bhp = $this->ModelBilling->total_bhp($id_kunjungan);
    $detail_bhp = $this->ModelBilling->detail_bhp($id_kunjungan);

    $total_jasa = 0;
    // die(var_dump($data_tindakan));
    foreach ($data_tindakan as $data) {
      $total_jasa += $data->harga;
    }
    // $total_jasa = $data_tindakan['harga']+$data_tindakan['japel_dokter']+$data_tindakan['japel_perawat']+$data_tindakan['japel_admin']+$data_tindakan['japel_resepsionis'];
    $total_resep = $detail_resep['total_harga'];
    $total_resep += !empty($bhp)?$bhp['jumlah']:0;

    $data_billing = array();
    if(isset($_POST['simpan'])){
      $kode = $this->ModelAkuntansi->generete_notrans();
      $id_detail = $this->input->post('iddetail_resep');
      $idobat = $this->input->post('idobat');
      $jumlah_awal = $this->input->post('jumlah_awal');
      $jumlah_akhir = $this->input->post('jumlah_akhir');
      $harga = $this->input->post('harga');
      $total_1 = 0;
      $total_2 = 0;
      for($i=0;$i<count($id_detail);$i++){
        $total_1 += $harga[$i]*$jumlah_awal[$i];
        $total_2 += $harga[$i]*$jumlah_akhir[$i];
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

      //beban di bayar di muka
      $jurnal1 = array(
        'tanggal' => date("Y-m-d"),
        'keterangan' => 'Transaksi no kunjungan '.$id_kunjungan,
        'norek' => '10701',
        'debet' => 0,
        'kredit' => 0,
        'no_transaksi' => $kode,
        'jam' => date("H:i:s"),
        'no_urut' => $id_kunjungan,
        // 'pasien_noRM' =>
      );
      //persediaan obat
      $jurnal2 = array(
        'tanggal' => date("Y-m-d"),
        'keterangan' => 'Transaksi no kunjungan '.$id_kunjungan,
        'norek' => '10501',
        'debet' => 0,
        'kredit' => 0,
        'no_transaksi' => $kode,
        'jam' => date("H:i:s"),
        'no_urut' => $id_kunjungan,
        // 'pasien_noRM' =>
      );
      if ($total_2 > $total_1) {
        $sisa_total = $total_2-$total_1;
        $jurnal2['kredit'] = $sisa_total;
        $jurnal1['debet'] = $sisa_total;
      }else{
        $sisa_total = $total_1-$total_2;
        $jurnal1['kredit'] = $sisa_total;
        $jurnal2['debet'] = $sisa_total;
      }
      $this->db->insert("jurnal",$jurnal1);
      $this->db->insert("jurnal",$jurnal2);
      redirect(base_url()."Billing/invoice/".$id_kunjungan);
    }
    if ($data_kunjungan['administrasi']==0) {
      $biaya_administrasi = 0;
    }
    array_push($data_billing,array(
      'pembayaran' => 'Adminitrasi',
      'harga' => $biaya_administrasi,
      'opsi' => false
    ));

    array_push($data_billing,array(
      'pembayaran' => 'Administrasi Rekam Medis',
      'harga' => $biaya_rekam_medis,
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
      'harga' => $lab['harga'],
      'opsi' => 'lab'
    ));
    $deposit = $this->db->get_where('deposit',array('kunjungan_no_urutkunjungan'=>$id_kunjungan))->row_array();
    if (!empty($deposit)) {
      $depo = $deposit['jumlah_deposit'];
    }else{
      $depo = 0;
    }
    $total = $biaya_rekam_medis+$biaya_administrasi+$total_jasa+$total_resep+$lab['harga'];
    $total_akhir = $total-$depo;
    // $total = $biaya_rekam_medis+$biaya_administrasi+$total_jasa+$total_resep+$lab['harga'];
    $ppn = 0;
    $total_billing = $total+$ppn;
    if ($total_akhir==0) {
      $terbilang = "nol";
    }else{
      $terbilang = $this->ModelBilling->terbilang($total_akhir);
    }
    $no_tagihan = "TG/".date('m',strtotime($data_kunjungan['tgl']))."/".date('Y',strtotime($data_kunjungan['tgl']))."/".str_pad($data_kunjungan['no_urutkunjungan'],8,"0",STR_PAD_LEFT);

    $data = array(
      'body' => "Billing/invoice",
      'pasien' => $this->ModelPasien->get_data_edit($data_kunjungan['pasien_noRM'])->row_array(),
      'no_invoice' => $no_invoice,
      'data_billing' => $data_billing,
      'total_resep' => $total_resep,
      'total' => $total,
      'ppn' => $ppn,

      'data' => $data_kunjungan,
      'no' => $no_tagihan,
      'total_billing' => $total_billing,
      'terbilang' => $terbilang." rupiah",
      'detail_resep' => $this->ModelBilling->detail_resep($data_resep['no_resep'])->result(),
      'detail_bhp' => $detail_bhp,
      'total_akhir' => $total_akhir,
      'deposit' => $depo,
    );
    $this->load->view('index',$data);
  }
  function invoice2()
  {
    if(isset($_POST['simpan'])){
      $id_kunjungan = $this->input->post('no_kunjungan');
    }else{
      $id_kunjungan = $this->uri->segment(3);
    }
    $biaya = $this->ModelBilling->biaya()->row_array();

    $data_kunjungan = $this->ModelKunjungan->get_data_edit($id_kunjungan);
    if ($data_kunjungan['acc_ranap']!=0) {
      $biaya_administrasi = $biaya['rawat_inap'];
    }else{
      $biaya_administrasi = $biaya['rawat_jalan'];
    }
    $data_periksa = $this->ModelBilling->data_periksa($id_kunjungan)->row_array();
    $prefix = $this->get_prefix($data_kunjungan['tupel_kode_tupel']);
    $no_invoice = $prefix.date('Ymd',strtotime($data_kunjungan['tgl'])).str_pad($data_kunjungan['no_antrian'],3,"0",STR_PAD_LEFT);
    $data_resep = $this->ModelBilling->data_resep($data_periksa['idperiksa'])->row_array();
    $detail_resep = $this->ModelBilling->total_resep($data_resep['no_resep'])->row_array();
    $data_tindakan = $this->ModelBilling->japel($id_kunjungan)->result();
    $lab = $this->ModelBilling->totallab($id_kunjungan)->row_array();
    $bhp = $this->ModelBilling->total_bhp($id_kunjungan);
    $detail_bhp = $this->ModelBilling->detail_bhp($id_kunjungan);

    $total_jasa = 0;
    // die(var_dump($data_tindakan));
    foreach ($data_tindakan as $data) {
      $total_jasa += $data->harga;
    }
    // $total_jasa = $data_tindakan['harga']+$data_tindakan['japel_dokter']+$data_tindakan['japel_perawat']+$data_tindakan['japel_admin']+$data_tindakan['japel_resepsionis'];
    $total_resep = $detail_resep['total_harga'];
    $total_resep += !empty($bhp)?$bhp['jumlah']:0;

    $data_billing = array();
    if(isset($_POST['simpan'])){
      $id_detail = $this->input->post('iddetail_resep');
      $idobat = $this->input->post('idobat');
      $jumlah_awal = $this->input->post('jumlah_awal');
      $jumlah_akhir = $this->input->post('jumlah_akhir');
      $harga = $this->input->post('harga');
      $total_1 =0;
      $total_2 =0;
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

      redirect(base_url()."Billing/invoice/".$id_kunjungan);
    }
    array_push($data_billing,array(
      'pembayaran' => 'Adminitrasi',
      'harga' => $biaya_administrasi,
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
      'harga' => $lab['harga'],
      'opsi' => 'lab'
    ));
    $total = $biaya_administrasi+$total_jasa+$total_resep+$lab['harga'];
    $ppn = 0;
    $total_billing = $total+$ppn;
    $data = array(
      'body' => "Billing/invoice_baru",
      'pasien' => $this->ModelPasien->get_data_edit($data_kunjungan['pasien_noRM'])->row_array(),
      'no_invoice' => $no_invoice,
      'data_billing' => $data_billing,
      'total_resep' => $total_resep,
      'total' => $total,
      'ppn' => $ppn,
      'total_billing' => $total_billing,
      'terbilang' => $this->ModelBilling->terbilang($total_billing)." rupiah",
      'detail_resep' => $this->ModelBilling->detail_resep($data_resep['no_resep'])->result(),
      'detail_bhp' => $detail_bhp,

    );
    $this->load->view('index',$data);
  }

  function input($value='')
  {
    $noRM = $this->input->post("noRM");
    $nama = $this->input->post("nama");
    $kode = $this->ModelAkuntansi->generete_notrans();
    $data = array(
      'jam_keluar'  => date('Y-m-d H:i:s'),
      'billing'     => 1
    );
    $bayar_akhir = $this->input->post("bayar_akhir");
    $depo = $this->input->post("depo");
    $data_kunjungan = $this->ModelKunjungan->get_data_edit($this->input->post('id'));
    $this->db->where('no_urutkunjungan', $this->input->post('id'));
    $this->db->update('kunjungan', $data);
    $data_billing = array(
      'kunjungan_no_urutkunjungan'  => $this->input->post('id'),
      'kode_invoice' => $this->input->post('invoice'),
      'tanggal'                     => date('Y-m-d'),
      'admin'                       => $this->input->post('hrg[0]'),
      'rekam_medis'                 => $this->input->post('hrg[1]'),
      'tindakan'                    => $this->input->post('hrg[2]'),
      'obat'                        => $this->input->post('hrg[3]'),
      'laborat'                     => $this->input->post('hrg[4]'),
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
    $total_transaksi = $data_billing['tindakan']+$data_billing['laborat']+$data_billing['obat'];
    $jml_bayar = $data_billing['jml_bayar'];
    $nokun =$data_billing['kunjungan_no_urutkunjungan'];
    $norm = $data_kunjungan['pasien_noRM'];
    $tupel = $data_kunjungan['tupel_kode_tupel'];
    if ($jml_bayar > $bayar_akhir) {
      $jml_bayar = $bayar_akhir;
    }
    $jurnal = array(
      'tanggal' => date("Y-m-d"),
      'keterangan' => 'Transaksi nomor kunjungan '.$nokun,
      'norek' => '10201',
      'debet' => 0,
      'kredit' => $jml_bayar,
      'no_transaksi' => $kode,
      'jam' => date("H:i:s"),
      'no_urut' => $this->input->post('id'),
      'pasien_noRM' => $norm
    );
    $jurnal1 = array(
      'tanggal' => date("Y-m-d"),
      'keterangan' => 'Transaksi nomor kunjungan '.$nokun,
      'norek' => "10001",
      'debet' => $jml_bayar,
      'kredit' => 0,
      'no_transaksi' => $kode,
      'jam' => date("H:i:s"),
      'no_urut' => $this->input->post('id'),
      'pasien_noRM' => $norm
    );
    $this->db->insert('jurnal',$jurnal1);
    $this->db->insert('jurnal',$jurnal);

    $this->session->set_flashdata('notif',$this->Notif->berhasil("Pembayaran berhasil dilakukan"));
    redirect("Billing");
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
    }
    else if($data =='OZO'){
      $prefix = "POZO";
    }else{
      $prefix = "PIGD";
    }
    return $prefix;
  }


  function print()
  {
    if(isset($_POST['simpan'])){
      $id_kunjungan = $this->input->post('no_kunjungan');
    }else{
      $id_kunjungan = $this->uri->segment(3);
    }
    $biaya = $this->ModelBilling->biaya()->row_array();

    $data_kunjungan = $this->ModelKunjungan->get_data_edit($id_kunjungan);
    if ($data_kunjungan['acc_ranap']!=0) {
      $biaya_administrasi = $biaya['rawat_inap'];
    }else{
      $biaya_administrasi = $biaya['rawat_jalan'];
    }
    $biaya_rekam_medis = $biaya['rekam_medis'];
    $data_periksa = $this->ModelBilling->data_periksa($id_kunjungan)->row_array();
    $no_invoice = date('Ymd').$data_kunjungan['pasien_noRM'];
    $data_resep = $this->ModelBilling->data_resep($data_periksa['idperiksa'])->row_array();
    $detail_resep = $this->ModelBilling->total_resep($data_resep['no_resep'])->row_array();
    $data_tindakan = $this->ModelBilling->japel($id_kunjungan)->result();
    $lab = $this->ModelBilling->totallab($id_kunjungan)->row_array();
    $bhp = $this->ModelBilling->total_bhp($id_kunjungan);
    $detail_bhp = $this->ModelBilling->detail_bhp($id_kunjungan);
    $total_jasa = 0;
    // die(var_dump($data_tindakan));
    foreach ($data_tindakan as $data) {
      $total_jasa += $data->harga;
    }
    // $total_jasa = $data_tindakan['harga']+$data_tindakan['japel_dokter']+$data_tindakan['japel_perawat']+$data_tindakan['japel_admin']+$data_tindakan['japel_resepsionis'];
    $total_resep = $detail_resep['total_harga'];
    $total_resep += !empty($bhp)?$bhp['jumlah']:0;
    $data_billing = array();
    if(isset($_POST['simpan'])){
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
      redirect(base_url()."Billing/invoice/".$id_kunjungan);
    }
    if ($data_kunjungan['administrasi']==0) {
      $biaya_administrasi = 0;
    }
    array_push($data_billing,array(
      'pembayaran' => 'Adminitrasi',
      'harga' => $biaya_administrasi,
      'opsi' => false
    ));
    array_push($data_billing,array(
      'pembayaran' => 'Administrasi Rekam Medis',
      'harga' => $biaya_rekam_medis,
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
      'harga' => $lab['harga'],
      'opsi' => 'lab'
    ));
    $deposit = $this->db->get_where('deposit',array('kunjungan_no_urutkunjungan'=>$id_kunjungan))->row_array();
    if (!empty($deposit)) {
      $depo = $deposit['jumlah_deposit'];
    }else{
      $depo = 0;
    }
    $total = $biaya_rekam_medis+$biaya_administrasi+$total_jasa+$total_resep+$lab['harga'];
    $total_akhir = $total-$depo;
    $ppn = 0;
    $total_billing = $total+$ppn;

    $total_akhir = $total_akhir < 0? 0 : $total_akhir;
    if ($total_akhir==0) {
      $terbilang = "nol";
    }else{
      $terbilang = $this->ModelBilling->terbilang($total_akhir);
    }
    $data = array(
      'body' => "Billing/print",
      'pasien' => $this->ModelPasien->get_data_edit($data_kunjungan['pasien_noRM'])->row_array(),
      'no_invoice' => $no_invoice,
      'data_billing' => $data_billing,
      'total_resep' => $total_resep,
      'total' => $total,
      'ppn' => $ppn,
      'total_akhir' => $total_akhir,
      'deposit' => $depo,
      'total_billing' => $total_billing,
      'terbilang' => $terbilang." rupiah",
      'detail_resep' => $this->ModelBilling->detail_resep($data_resep['no_resep'])->result(),
      'detail_bhp' => $detail_bhp,
      'bayar_billing' => $this->db->get_where('billing',array('kunjungan_no_urutkunjungan'=>$id_kunjungan))->row_array(),
    );
    // die(var_dump($data['billing']));
    $this->load->view('index',$data);
  }
  function print_tagihan()
  {
    if(isset($_POST['simpan'])){
      $id_kunjungan = $this->input->post('no_kunjungan');
    }else{
      $id_kunjungan = $this->uri->segment(3);
    }
    $biaya = $this->ModelBilling->biaya()->row_array();
    $data_kunjungan = $this->ModelKunjungan->get_data_edit($id_kunjungan);
    if ($data_kunjungan['acc_ranap']!=0) {
      $biaya_administrasi = $biaya['rawat_inap'];
    }else{
      $biaya_administrasi = $biaya['rawat_jalan'];
    }
    $biaya_rekam_medis = $biaya['rekam_medis'];

    $data_periksa = $this->ModelBilling->data_periksa($id_kunjungan)->row_array();
    $no_invoice = date('Ymd').$data_kunjungan['pasien_noRM'];
    $data_resep = $this->ModelBilling->data_resep($data_periksa['idperiksa'])->row_array();
    $detail_resep = $this->ModelBilling->total_resep($data_resep['no_resep'])->row_array();
    $data_tindakan = $this->ModelBilling->japel($id_kunjungan)->result();
    $lab = $this->ModelBilling->totallab($id_kunjungan)->row_array();
    $bhp = $this->ModelBilling->total_bhp($id_kunjungan);
    $detail_bhp = $this->ModelBilling->detail_bhp($id_kunjungan);
    $total_jasa = 0;
    foreach ($data_tindakan as $data) {
      $total_jasa += $data->harga;
    }

    $total_resep = $detail_resep['total_harga'];
    $total_resep += !empty($bhp)?$bhp['jumlah']:0;
    $data_billing = array();
    if ($data_kunjungan['administrasi']==0) {
      $biaya_administrasi = 0;
    }
    array_push($data_billing,array(
      'pembayaran' => 'Adminitrasi',
      'harga' => $biaya_administrasi,
      'opsi' => false
    ));
    array_push($data_billing,array(
      'pembayaran' => 'Administrasi Rekam Medis',
      'harga' => $biaya_rekam_medis,
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
      'harga' => $lab['harga'],
      'opsi' => 'lab'
    ));
    $deposit = $this->db->get_where('deposit',array('kunjungan_no_urutkunjungan'=>$id_kunjungan))->row_array();
    if (!empty($deposit)) {
      $depo = $deposit['jumlah_deposit'];
    }else{
      $depo = 0;
    }
    $total = $biaya_rekam_medis+$biaya_administrasi+$total_jasa+$total_resep+$lab['harga'];
    $total_akhir = $total-$depo;
    $ppn = 0;
    $total_billing = $total+$ppn;

    $total_akhir = $total_akhir < 0? 0 : $total_akhir;
    if ($total_akhir==0) {
      $terbilang = "nol";
    }else{
      $terbilang = $this->ModelBilling->terbilang($total_akhir);
    }
    $no_tagihan = "TG/".date('m',strtotime($data_kunjungan['tgl']))."/".date('Y',strtotime($data_kunjungan['tgl']))."/".str_pad($data_kunjungan['no_urutkunjungan'],8,"0",STR_PAD_LEFT);

    $data = array(
      'body' => "Billing/print_tagihan",
      'pasien' => $this->ModelPasien->get_data_edit($data_kunjungan['pasien_noRM'])->row_array(),
      'no_invoice' => $no_invoice,
      'data_billing' => $data_billing,
      'total_resep' => $total_resep,
      'total' => $total,
      'ppn' => $ppn,
      'no' => $no_tagihan,
      'total_akhir' => $total_akhir,
      'deposit' => $depo,
      'total_billing' => $total_billing,
      'terbilang' => $terbilang." rupiah",
      'detail_resep' => $this->ModelBilling->detail_resep($data_resep['no_resep'])->result(),
      'detail_bhp' => $detail_bhp,
      'data' => $data_kunjungan,
      'bayar_billing' => $this->db->get_where('billing',array('kunjungan_no_urutkunjungan'=>$id_kunjungan))->row_array(),
    );
    // die(var_dump($data['billing']));
    $this->load->view('index',$data);
  }

  public function resep(){
    $data = $this->ModelResep->get_resep();
    die(var_dump($data));
  }

  public function filter_billing(){
    $tanggal = date("Y-m-d",strtotime($this->input->post("tanggal")));
    $sts = $this->input->post('sts');
    $poli = $this->input->post('poli');
    $data = $this->ModelBilling->data_filter($tanggal,$sts,$poli);
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
      $button = "";
      if ($value->cetak_billing==0) {
        if ($value->siap_pulang!=0) {
          $href = base_url().'Billing/tagihan/'.$value->no_urutkunjungan;
          $disable = "";
        }else{
          $href ="#";
          $disable = "disabled";
        }
        $button .= '<a href="'.$href.'">
        <button type="button" '.$disable.' class="btn btn-primary btn-sm"
        style="border-bottom-right-radius: 0rem !important;border-top-right-radius: 0rem !important;"> <i class="fa fa-credit-card"></i> Tagihan</button>
        </a>';
      }else{
        $button .= '<a href="'.base_url().'Billing/print_tagihan/'.$value->no_urutkunjungan.'">
        <button type="button" class="btn btn-danger btn-sm"
        style="border-bottom-right-radius: 0rem !important;border-top-right-radius: 0rem !important;"> <i class="fa fa-print"></i> Cetak Ulang Tagihan</button>
        </a>';
        if ($value->billing==null || $value->billing!=1) {
          $button .= '<a href="'.base_url().'Billing/invoice/'.$value->no_urutkunjungan.'">
          <button type="button" class="btn btn-primary btn-sm"
          style="border-bottom-right-radius: 0rem !important;border-top-right-radius: 0rem !important;"> <i class="fa fa-credit-card"></i> Bayar</button>
          </a>';
        }else{
          $button .= '<a  target="_blank" href="'.base_url().'Billing/kwitansi/'.$value->no_urutkunjungan.'">
          <button type="button" class="btn btn-warning btn-sm"
          style="border-bottom-right-radius: 0rem !important;border-top-right-radius: 0rem !important;"> <i class="fa fa-print"></i> Print pembayaran</button>
          </a>';

        }
      }
      $html .= '<tr>
      <td>'.$no.'</td>
      <td><h4><span class="badge badge-pill '.$warna.'">'.$value->tujuan_pelayanan.'</span></h4></td>
      <td>'.date("d-m-Y",strtotime($value->tgl)).'</td>
      <td>'.$value->jam_daftar.'</td>
      <td>'.$value->inisial.''.$value->no_antrian.'</td>
      <td>'.$value->pasien_noRM.'</td>
      <td>'.$value->namapasien.'</td>
      <td>'.$s.'</td>
      <td>'.$button.'</td>';
      $no+=1;

    }
    // die(var_dump($html));
    echo $html;
  }
  function tagihan()
  {
    if(isset($_POST['simpan'])){
      $id_kunjungan = $this->input->post('no_kunjungan');
    }else{
      $id_kunjungan = $this->uri->segment(3);
    }
    $biaya = $this->ModelBilling->biaya()->row_array();

    $data_kunjungan = $this->ModelKunjungan->get_data_edit($id_kunjungan);
    if ($data_kunjungan['acc_ranap']!=0) {
      $biaya_administrasi = $biaya['rawat_inap'];
    }else{
      $biaya_administrasi = $biaya['rawat_jalan'];
    }
    $biaya_rekam_medis = $biaya['rekam_medis'];
    $data_periksa = $this->ModelBilling->data_periksa($id_kunjungan)->row_array();
    $prefix = $this->get_prefix($data_kunjungan['tupel_kode_tupel']);
    $no_invoice = $prefix.date('Ymd',strtotime($data_kunjungan['tgl'])).str_pad($data_kunjungan['no_antrian'],3,"0",STR_PAD_LEFT);
    $data_resep = $this->ModelBilling->data_resep($data_periksa['idperiksa'])->row_array();
    $detail_resep = $this->ModelBilling->total_resep($data_resep['no_resep'])->row_array();
    $data_tindakan = $this->ModelBilling->japel($id_kunjungan)->result();
    $lab = $this->ModelBilling->totallab($id_kunjungan)->row_array();
    $bhp = $this->ModelBilling->total_bhp($id_kunjungan);
    $detail_bhp = $this->ModelBilling->detail_bhp($id_kunjungan);

    $total_jasa = 0;
    $total_monev = 0;
    // die(var_dump($data_tindakan));
    foreach ($data_tindakan as $data) {
      $total_jasa += $data->harga;
      $total_monev += $data->japel_dokter+$data->japel_perawat+$data->japel_admin+$data->japel_resepsionis;
    }
    // $total_jasa = $data_tindakan['harga']+$data_tindakan['japel_dokter']+$data_tindakan['japel_perawat']+$data_tindakan['japel_admin']+$data_tindakan['japel_resepsionis'];
    $total_resep = $detail_resep['total_harga'];
    $total_resep += !empty($bhp)?$bhp['jumlah']:0;

    $data_billing = array();
    if(isset($_POST['simpan'])){
      $kode = $this->ModelAkuntansi->generete_notrans();
      $id_detail = $this->input->post('iddetail_resep');
      $idobat = $this->input->post('idobat');
      $jumlah_awal = $this->input->post('jumlah_awal');
      $jumlah_akhir = $this->input->post('jumlah_akhir');
      $harga = $this->input->post('harga');
      $total_1 = 0;
      $total_2 = 0;
      for($i=0;$i<count($id_detail);$i++){
        $total_1 += $harga[$i]*$jumlah_awal[$i];
        $total_2 += $harga[$i]*$jumlah_akhir[$i];
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
      //beban di bayar di muka
      $jurnal1 = array(
        'tanggal' => date("Y-m-d"),
        'keterangan' => 'Transaksi no kunjungan '.$id_kunjungan,
        'norek' => '10701',
        'debet' => 0,
        'kredit' => 0,
        'no_transaksi' => $kode,
        'jam' => date("H:i:s"),
        'no_urut' => $id_kunjungan,
        // 'pasien_noRM' =>
      );
      //persediaan obat
      $jurnal2 = array(
        'tanggal' => date("Y-m-d"),
        'keterangan' => 'Transaksi no kunjungan '.$id_kunjungan,
        'norek' => '10501',
        'debet' => 0,
        'kredit' => 0,
        'no_transaksi' => $kode,
        'jam' => date("H:i:s"),
        'no_urut' => $id_kunjungan,
        // 'pasien_noRM' =>
      );
      if ($total_2 > $total_1) {
        $sisa_total = $total_2-$total_1;
        $jurnal2['kredit'] = $sisa_total;
        $jurnal1['debet'] = $sisa_total;
      }else{
        $sisa_total = $total_1-$total_2;
        $jurnal1['kredit'] = $sisa_total;
        $jurnal2['debet'] = $sisa_total;
      }
      // $this->db->insert("jurnal",$jurnal1);
      // $this->db->insert("jurnal",$jurnal2);
      redirect(base_url()."Billing/tagihan/".$id_kunjungan);
    }
    if ($data_kunjungan['administrasi']==0) {
      $biaya_administrasi = 0;
    }
    array_push($data_billing,array(
      'pembayaran' => 'Adminitrasi Loket',
      'harga' => $biaya_administrasi,
      'opsi' => false
    ));
    array_push($data_billing,array(
      'pembayaran' => 'Administrasi Rekam Medis',
      'harga' => $biaya_rekam_medis,
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
      'harga' => $lab['harga'],
      'opsi' => 'lab'
    ));
    $deposit = $this->db->get_where('deposit',array('kunjungan_no_urutkunjungan'=>$id_kunjungan))->row_array();
    if (!empty($deposit)) {
      $depo = $deposit['jumlah_deposit'];
    }else{
      $depo = 0;
    }
    $total = $biaya_rekam_medis+$biaya_administrasi+$total_jasa+$total_resep+$lab['harga'];
    $total_akhir = $total-$depo;
    $ppn = 0;
    $total_billing = $total+$ppn;
    $total_akhir = $total_akhir < 0? 0 : $total_akhir;

    if ($total_akhir==0) {
      $terbilang = "nol";
    }else{
      $terbilang = $this->ModelBilling->terbilang($total_akhir);
    }

    $no_tagihan = "TG/".date('m',strtotime($data_kunjungan['tgl']))."/".date('Y',strtotime($data_kunjungan['tgl']))."/".str_pad($data_kunjungan['no_urutkunjungan'],8,"0",STR_PAD_LEFT);

    $data = array(
      'body' => "Billing/tagihan",
      'kunjungan' => $this->ModelKunjungan->get_data_edit($id_kunjungan),
      'pasien' => $this->ModelPasien->get_data_edit($data_kunjungan['pasien_noRM'])->row_array(),
      'no_invoice' => $no_invoice,
      'data_billing' => $data_billing,
      'total_resep' => $total_resep,
      'total' => $total,
      'ppn' => $ppn,
      'no' => $no_tagihan,
      'total_akhir' => $total_akhir,
      'deposit' => $depo,
      'data' =>$data_kunjungan,
      'total_billing' => $total_billing,
      'terbilang' => $terbilang." rupiah",
      'detail_resep' => $this->ModelBilling->detail_resep($data_resep['no_resep'])->result(),
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
    $data_kunjungan = $this->ModelKunjungan->get_data_edit($nokun);
    $idobat = $this->input->post("idobat");
    $jumlah_akhir = $this->input->post("jumlah_akhir");
    $harga = $this->input->post("harga");
    $harga_beli = 0;
    $harga_jual = 0;
    $data = array(
      'cetak_billing'  => 1,
    );
    $this->db->where('no_urutkunjungan', $this->input->post('id'));
    $this->db->update('kunjungan', $data);
    for($i=0;$i<count($idobat);$i++){
      $data_obat = $this->ModelObat->get_data_edit($idobat[$i])->row_array();
      $stok_akhir = $data_obat['stok']-$jumlah_akhir[$i];
      $this->db->where("idobat",$idobat[$i]);
      $this->db->update("obat",array("stok"=>$stok_akhir));
      $harga_beli += $jumlah_akhir[$i]*$data_obat['harga_beli_satuan_kecil'];
      $harga_jual = $harga[$i];
    }
    $pendapatan_obat = $harga_jual-$harga_beli;
    $deposit = $this->input->post("deposit");
    $harus_bayar = $this->input->post("harus_bayar");
    $data_billing = array(
      'kunjungan_no_urutkunjungan'  => $this->input->post('id'),
      'kode_invoice' => $this->input->post('invoice'),
      'tanggal'                     => date('Y-m-d'),
      'admin'                       => $this->input->post('hrg[0]'),
      'rekam_medis'                 => $this->input->post('hrg[1]'),
      'obat'                        => $this->input->post('hrg[3]'),
      'tindakan'                    => $this->input->post('hrg[2]'),
      'laborat'                     => $this->input->post('hrg[4]'),
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
    $total_transaksi = $data_billing['tindakan']+$data_billing['laborat']+$data_billing['obat'];
    $total_transaksi1 = $data_billing['bayar'];
    $jml_bayar = $data_billing['jml_bayar'];
    $nokun =$data_billing['kunjungan_no_urutkunjungan'];
    $norm = $data_kunjungan['pasien_noRM'];
    $tupel = $data_kunjungan['tupel_kode_tupel'];
    $jasa = $data_billing['tindakan'];


    // $obat = $data_billing['obat'];
    $lab = $data_billing['laborat'];
    if ($tupel=='UMU') {
      $norek = "40801";
    }else if($tupel=='GIG'){
      $norek = "40802";
    }else if($tupel=="INT"){
      $norek = "40803";
    }else if($tupel=="OBG"){
      $norek = "40804";
    }else if($tupel == "OZO"){
      $norek = "40805";
    }else if($tupel=="IGD"){
      $norek = "40806";
    }else{
      $norek = NULL;
    }

    $pendapatan_poli = $total_transaksi1-($harga_jual+$data_billing['admin']+$jasa+$lab+$data_billing['rekam_medis']);
    $jurnal = array(
      'tanggal' => date("Y-m-d"),
      'keterangan' => 'Transaksi nomor kunjungan '.$nokun,
      'norek' => '10201',
      'debet' => $total_transaksi1,
      'kredit' => 0,
      'no_transaksi' => $kode,
      'jam' => date("H:i:s"),
      'no_urut' => $this->input->post('id'),
      'pasien_noRM' => $norm
    );
    $jurnal1 = array(
      'tanggal' => date("Y-m-d"),
      'keterangan' => 'Transaksi nomor kunjungan '.$nokun,
      'norek' => $norek,
      'debet' => 0,
      'kredit' => $pendapatan_poli,
      'no_transaksi' => $kode,
      'jam' => date("H:i:s"),
      'no_urut' => $this->input->post('id'),
      'pasien_noRM' => $norm
    );
    $this->db->insert('jurnal',$jurnal);
    if ($pendapatan_poli!=0) {
      $this->db->insert('jurnal',$jurnal1);
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
      'debet' => $harga_jual,
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
      'kredit' => $harga_jual,
      'no_transaksi' => $kode,
      'jam' => date("H:i:s"),
      'no_urut' => $this->input->post('id'),
      'pasien_noRM' => $norm
    );
    // $this->db->insert('jurnal',$jurnal);
    if ($harga_jual!=0) {
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

    redirect("Billing/print_tagihan/".$this->input->post('id'));
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
      'body'        => 'Billing/print_kwitansi',
      'nominal' => $data_depo['jml_bayar'],
      'operator' => $data_depo['nama'],
      'pasien' => $data_depo['namapasien'],
      'terbilang' => $terbilang." rupiah",
      'no' => $no_depo,
      'data' => $data_depo
    );
    $this->load->view('index',$data);
  }
}
?>
