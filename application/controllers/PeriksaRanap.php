<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PeriksaRanap extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('ModelPasien');
    $this->load->model('ModelKunjungan');
    $this->load->model('ModelJenisPasien');
    $this->load->model('ModelLaborat');
    $this->load->model('ModelPenyakit');
    $this->load->model('ModelJasaPelayanan');
    $this->load->model('ModelResep');
    $this->load->model('ModelObat');
    $this->load->model('ModelPeriksa');
    $this->load->model('ModelTujuanPelayanan');
    $this->load->model('ModelDemografi');
    $this->load->model('ModelRiwayatAlergi');
    $this->load->model('ModelRanap');
    $this->load->model('ModelAkuntansi');
  }

  function index()
  {
    $kunjungan = $this->ModelRanap->get_data_edit($this->uri->segment(3));
    $pasien = $this->ModelPasien->get_data_edit($kunjungan['pasien_noRM'])->row_array();
    $data = array(
      'idkunjungan' => $this->uri->segment(3),
      'kunjungan'   => $kunjungan,
      'body'        => 'PeriksaRanap/index',
      'timbang'     => $this->ModelRanap->get_timbang_terima($this->uri->segment(3)),
      'pasien'      => $this->ModelPasien->get_data_edit($kunjungan['pasien_noRM'])->row_array(),
      'jenispasien' => $this->ModelJenisPasien->get_data_edit($pasien['jenis_pasien_kode_jenis'])->row_array(),
      'tupel'       => $this->ModelTujuanPelayanan->get_data_edit($kunjungan['tujuan_poli'])->row_array(),
      'riwayat_alergi'=> $this->ModelRiwayatAlergi->get_data($kunjungan['pasien_noRM'])->result(),
      'periksa'     => $this->ModelPeriksa->get_data_edit($this->uri->segment(4)),
    );
    // die(var_dump($data['timbang']));
    // die(var_dump($data['kunjungan']));
    if ($this->ModelDemografi->get_asesmen_kunjungan($this->uri->segment(3))->num_rows() > 0) {
      $data['demografi'] = $this->ModelDemografi->get_asesmen_kunjungan($this->uri->segment(3))->row_array();
    }
    if ($this->ModelDemografi->get_asesmen_igd_kunjungan($this->uri->segment(3))->num_rows() > 0) {
      $data['asesmen'] = $this->ModelDemografi->get_asesmen_igd_kunjungan($this->uri->segment(3))->row_array();
    }

    $this->load->view('index', $data);
  }

  function pemeriksaan()
  {
    $kunjungan = $this->ModelKunjungan->get_data_edit($this->uri->segment(3));
    $pasien = $this->ModelPasien->get_data_edit($kunjungan['pasien_noRM'])->row_array();
    $data = array(
      'idkunjungan' => $this->uri->segment(3),
      'kunjungan'   => $kunjungan,
      'body'        => 'PeriksaRanap/pemeriksaan2',
      'pasien'      => $this->ModelPasien->get_data_edit($kunjungan['pasien_noRM'])->row_array(),
      'jenispasien' => $this->ModelJenisPasien->get_data_edit($pasien['jenis_pasien_kode_jenis'])->row_array(),
      'lab'         => $this->ModelLaborat->get_data(),
      'periksa'     => $this->ModelPeriksa->get_periksa_pasien($this->uri->segment(3))
    );

    $this->load->view('index', $data);
  }

  function input_pemeriksaan()
  {
    $id_rujuk = $this->input->post('id_rujuk');
    // die($id_rujuk);
    // $id_rujuk = $this->uri->segment(4);
    // $id_periksa = $this->uri->segment(4);
    $riwayat_dulu = $this->input->post('riwayat_dulu');
    if ($this->input->post('riwayat_dulu') == "lain") {
      $riwayat_dulu = $this->input->post('lain_ridul');
    } else {
      $riwayat_dulu = $this->input->post('riwayat_dulu');
    }

    $periksa = array(
      'kunjungan_no_urutkunjungan' => $this->input->post('nokun'),
      'tanggal' => date('Y-m-d'),
      'no_rm'   => $this->input->post('no_rm'),
      'keluhan' => $this->input->post('keluhan'),
      'riwayat_dulu'      => $riwayat_dulu,
      'riwayat_skrg'      => $this->input->post('riwayat_skrg'),
      'otemp'             => $this->input->post('temp'),
      'obb'               => $this->input->post('bb'),
      'otb'               => $this->input->post('tb'),
      'osadar'            => $this->input->post('kesadaran'),
      'osiastole'         => $this->input->post('siastole'),
      'odiastole'         => $this->input->post('diastole'),
      'onadi'             => $this->input->post('nadi'),
      'orr'               => $this->input->post('rr'),
      'kmata'             => $this->input->post('mata'),
      'ktelinga'          => $this->input->post('telinga'),
      'ktonsil'           => $this->input->post('tonsil'),
      'kleher'            => $this->input->post('leher'),
      'khidung'           => $this->input->post('hidung'),
      'kgilut'            => $this->input->post('gigimulut'),
      'klain'             => $this->input->post('lainkl'),
      'phepar'            => $this->input->post('hepar'),
      'pusus'             => $this->input->post('usus'),
      'pdinperut'         => $this->input->post('dinperut'),
      'puluhati'          => $this->input->post('uluhati'),
      'plien'             => $this->input->post('lien'),
      'plain'             => $this->input->post('lainperut'),
      'tcor'              => $this->input->post('corejantung'),
      'tparu'             => $this->input->post('paru'),
      'tlain'             => $this->input->post('lainthorak'),
      'uginjal'           => $this->input->post('ginjal'),
      'ulain'             => $this->input->post('lainurogenital'),
      'eatas'             => $this->input->post('exatas'),
      'ebawah'            => $this->input->post('exbawah'),
      'elain'             => $this->input->post('lainex'),
      'unit_layanan'      => $_SESSION['poli'],
      'operator' => $_SESSION['nik'],
      'rujukan_internal_idrujukan_internal' => $id_rujuk,
      'unit_layanan' => 'RANAP'

    );
    if ($this->db->insert('periksa', $periksa)) {
      $id_periksa = $this->db->insert_id();
      $this->db->reset_query();
      $this->db->where('no_urutkunjungan', $this->input->post('nokun'));
      $this->db->update('kunjungan',array('sudah' => '1',));
      $this->session->set_flashdata('notif', $this->Notif->berhasil('Berhasil Tersimpan'));
      redirect(base_url().'PeriksaRanap/index/'.$this->input->post('nokun')."/".$id_periksa);
    } else {
      $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Tersimpan'));
      redirect(base_url().'PeriksaRanap/index/'.$this->input->post('nokun')."/".$id_periksa);
    }
  }



  function lab()
  {
    $periksa = $this->ModelPeriksa->get_data_edit($this->uri->segment(3));
    $kunjungan = $this->ModelKunjungan->get_data_edit_ranap($periksa['kunjungan_no_urutkunjungan']);
    $pasien = $this->ModelPasien->get_data_edit($kunjungan['pasien_noRM'])->row_array();
    $data = array(
      'idkunjungan' => $this->uri->segment(3),
      'kunjungan' => $kunjungan,
      'body'        => 'PeriksaRanap/lab',
      'pasien'      => $this->ModelPasien->get_data_edit($kunjungan['pasien_noRM'])->row_array(),
      'jenispasien' => $this->ModelJenisPasien->get_data_edit($pasien['jenis_pasien_kode_jenis'])->row_array(),
      'lab'         => $this->ModelLaborat->get_data_type()->result(),
      'periksa'     => $this->ModelPeriksa->get_periksa_pasien($kunjungan['pasien_noRM'])
    );

    $this->load->view('index', $data);
    // echo $periksa['kunjungan_no_urutkunjungan'];
  }

  function labsearch()
  {
    $lab = $this->ModelLaborat->get_datasub($this->uri->segment(3))->result();
    $kelas = $this->uri->segment(4);
    foreach ($lab as $data) {
      if ($kelas==3) {
        $harga = $data->hrg_2;
      }
      else if ($kelas==2) {
        $harga = $data->hrg_3;
      }else if ($kelas==1) {
        $harga = $data->hrg_4;
      }else{
        $harga = $data->hrg_1;
      }
      echo "<tr>
        <td><input hidden value='$data->kode_lab' name='kode_lab[]'>$data->kode_lab</td>
        <td><input hidden value='$data->jenis_lab' name='jenis_lab[]'><input hidden value='$harga' name='harga_lab[]'>$data->jenis_lab</td>
        <td><button type=\"button\" onclick='deleteRowlab(this)' class=\"btn btn-circle btn-danger\" data-toggle=\"tooltip\" data-placement=\"top\" data-original-title=\"Hapus Lab\"><i class=\"fa fa-trash\"></i></button></td>
        </tr>
        ";
    }
  }

  function labsearchkode()
  {
    $lab = $this->ModelLaborat->get_data_edit($this->uri->segment(3));
    echo $lab['kode_lab'];
  }

  function tindakan()
  {
    $periksa = $this->ModelPeriksa->get_data_edit($this->uri->segment(3));
    $kunjungan = $this->ModelKunjungan->get_data_edit_ranap($periksa['kunjungan_no_urutkunjungan']);
    $pasien = $this->ModelPasien->get_data_edit($kunjungan['pasien_noRM'])->row_array();
    $data = array(
      'idkunjungan' => $this->uri->segment(3),
      'body'        => 'PeriksaRanap/tindakan',
      'kunjungan' => $kunjungan,
      'pasien'      => $this->ModelPasien->get_data_edit($kunjungan['pasien_noRM'])->row_array(),
      'jenispasien' => $this->ModelJenisPasien->get_data_edit($pasien['jenis_pasien_kode_jenis'])->row_array(),
      'penyakit'    => $this->ModelPenyakit->get_data(),
      'modaljapel'   => $this->ModelJasaPelayanan->get_data(),
      'periksa'     => $this->ModelPeriksa->get_periksa_pasien($this->uri->segment(3))

    );
    $this->load->view('index', $data);
  }
  function edit_tindakan()
  {
    $periksa = $this->ModelPeriksa->get_data_edit($this->uri->segment(3));
    $kunjungan = $this->ModelKunjungan->get_data_edit($periksa['kunjungan_no_urutkunjungan']);
    $pasien = $this->ModelPasien->get_data_edit($kunjungan['pasien_noRM'])->row_array();
    $dignosa = $this->ModelPeriksa->get_diagnosa($periksa['idperiksa'])->result();
    $tindakan = $this->ModelPeriksa->get_tindakan($periksa['idperiksa'])->result();
    $data = array(
      'idkunjungan' => $this->uri->segment(3),
      'body'        => 'PeriksaRanap/edit_tindakan',
      'tindakan' => $tindakan,
      'diagnosa' => $dignosa,
      'pasien'      => $this->ModelPasien->get_data_edit($kunjungan['pasien_noRM'])->row_array(),
      'jenispasien' => $this->ModelJenisPasien->get_data_edit($pasien['jenis_pasien_kode_jenis'])->row_array(),
      'penyakit'    => $this->ModelPenyakit->get_data(),
      'modaljapel'   => $this->ModelJasaPelayanan->get_data(),
      'periksa'     => $this->ModelPeriksa->get_periksa_pasien($this->uri->segment(3))

    );
    $this->load->view('index', $data);
  }
  function update_ditin()
  {
    $operator   = $_SESSION['nik'];
    $jam        = date('Y-m-d H:i:s');
    $periksa    = $this->input->post('nopem');
    $norm       = $this->input->post('no_rm');
    $kodesakit  = $this->input->post('kode_penyakit');
    $status_penyakit = $this->input->post('status_penyakit');
    $data_periksa = $this->ModelPeriksa->get_data_edit($periksa);
    $this->db->where('no_urutkunjungan',$data_periksa['kunjungan_no_urutkunjungan']);
    $this->db->update('kunjungan',array('sudah'=>2));
    $this->db->where_in("periksa_idperiksa",$periksa);
    $this->db->delete("diagnosa");
    $this->db->reset_query();
    $this->db->where_in("periksa_idperiksa",$periksa);
    $this->db->delete("tindakan");
    $this->db->reset_query();
    $count    = count($kodesakit);
    $status   = 0;
    for ($i=0; $i < $count; $i++) {
      $data = array(
        'kodesakit'         => $kodesakit[$i],
        'operator'          => $operator,
        'jam'               => $jam,
        'status_sakit'      => $status_penyakit[$i],
        'periksa_idperiksa' => $periksa,
        'pasien_noRM'       => $norm
      );
      $insert = $this->db->insert('diagnosa', $data);
      $this->db->reset_query();
      if ($insert == true) {
        $status = 1;
      }else {
        $status = 0;
      }
    }

    $kode_jasa        = $this->input->post('kode_jasa');
    $jasa             = $this->input->post('jasa');
    $harga            = $this->input->post('harga');
    $japeldokter      = $this->input->post('japeldokter');
    $japelperawat     = $this->input->post('japelperawat');
    $japeladmin       = $this->input->post('japeladmin');
    $japelresepsionis = $this->input->post('japelresepsionis');

    $count_jasa = count($kode_jasa);
    for ($i=0; $i < $count_jasa; $i++) {
      $data = array(
        'kodejasa'          => $kode_jasa[$i],
        'jsmedis'           => $jasa[$i],
        'harga'             => $harga[$i],
        'operator'          => $operator,
        'japel_dokter'      => $japeldokter[$i],
        'japel_perawat'     => $japelperawat[$i],
        'japel_admin'       => $japeladmin[$i],
        'japel_resepsionis' => $japelresepsionis[$i],
        'pasien_noRM'       => $norm,
        'periksa_idperiksa' => $periksa,
      );
      $insert = $this->db->insert('tindakan', $data);
      $this->db->reset_query();
      if ($insert == true) {
        $status = 1;
      }else {
        $status = 0;
      }
    }
    if ($status == 1) {
      $this->session->set_flashdata('notif', $this->Notif->berhasil('Berhasil Tersimpan'));
      // die();
      redirect(base_url()."PeriksaRanap/index/".$data_periksa['kunjungan_no_urutkunjungan']."/".$data_periksa['idperiksa']);
    } else {
      $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Tersimpan'));
      redirect(base_url()."PeriksaRanap/index/".$data_periksa['kunjungan_no_urutkunjungan']."/".$data_periksa['idperiksa']);
    }

  }
  function get_data_penyakit()
{
  $list = $this->ModelPenyakit->get_datatables();
  $data = array();
  $no = $_POST['start'];
  foreach ($list as $field) {
      $no++;
      $row = array();
      $row[] = $no;
      $row[] = $field->kodeicdx;
      $row[] = $field->nama_penyakit;
      $row[] = $this->ModelPenyakit->yatidak($field->wabah);
      $row[] = $this->ModelPenyakit->yatidak($field->nular);
      $row[] = $this->ModelPenyakit->yatidak($field->bpjs);
      $row[] = $this->ModelPenyakit->yatidak($field->non_spesialis);
      $row[] = "<button onclick=\"select_diagnosa('$field->kodeicdx','$field->nama_penyakit')\" type=\"button\" class=\"btn btn-circle btn-primary\" data-toggle=\"tooltip\" data-placement=\"right\" data-original-title=\"SUBMIT\" data-dismiss=\"modal\"><i class=\"fas fa-edit\"></i></button>";

      $data[] = $row;
  }

  $output = array(
      "draw" => $_POST['draw'],
      "recordsTotal" => $this->ModelPenyakit->count_all(),
      "recordsFiltered" => $this->ModelPenyakit->count_filtered(),
      "data" => $data,
  );
  //output dalam format JSON
  echo json_encode($output);
}

  function caridiagnosa()
  {
    $penyakit = $this->ModelPenyakit->get_data_edit($this->uri->segment(3));
    echo $penyakit['kodeicdx']." ".$penyakit['nama_penyakit'];
  }


function input_ditin()
{
      $operator   = $_SESSION['nik'];
      $jam        = date('Y-m-d H:i:s');
      $periksa    = $this->input->post('nopem');
      $norm       = $this->input->post('no_rm');
      $kodesakit  = $this->input->post('kode_penyakit');
      $status_penyakit = $this->input->post('status_penyakit');
      $data_periksa = $this->ModelPeriksa->get_data_edit($periksa);
      $this->db->where('no_urutkunjungan',$data_periksa['kunjungan_no_urutkunjungan']);
      $this->db->update('kunjungan',array('sudah'=>2));

      $kode = $this->ModelAkuntansi->generete_notrans();
      $nokun = $data_periksa['kunjungan_no_urutkunjungan'];
      $count    = count($kodesakit);
      $status   = 0;
      for ($i=0; $i < $count; $i++) {
        $data = array(
          'kodesakit'         => $kodesakit[$i],
          'operator'          => $operator,
          'jam'               => $jam,
          'status_sakit'      => $status_penyakit[$i],
          'periksa_idperiksa' => $periksa,
          'pasien_noRM'       => $norm
        );
        $insert = $this->db->insert('diagnosa', $data);
        $this->db->reset_query();
        if ($insert == true) {
          $status = 1;
        }else {
          $status = 0;
        }
      }

      $kode_jasa        = $this->input->post('kode_jasa');
      $jasa             = $this->input->post('jasa');
      $harga            = $this->input->post('harga');
      $japeldokter      = $this->input->post('japeldokter');
      $japelperawat     = $this->input->post('japelperawat');
      $japeladmin       = $this->input->post('japeladmin');
      $japelresepsionis = $this->input->post('japelresepsionis');

      $count_jasa = count($kode_jasa);
      for ($i=0; $i < $count_jasa; $i++) {
        $data = array(
          'kodejasa'          => $kode_jasa[$i],
          'jsmedis'           => $jasa[$i],
          'harga'             => $harga[$i],
          'operator'          => $operator,
          'japel_dokter'      => $japeldokter[$i],
          'japel_perawat'     => $japelperawat[$i],
          'japel_admin'       => $japeladmin[$i],
          'japel_resepsionis' => $japelresepsionis[$i],
          'pasien_noRM'       => $norm,
          'periksa_idperiksa' => $periksa,
        );
        $insert = $this->db->insert('tindakan', $data);
        $this->db->reset_query();
        if ($insert == true) {
          $status = 1;
        }else {
          $status = 0;
        }
        $total_menev += $japeldokter[$i]+$japelperawat[$i]+$japeladmin[$i]+$japelresepsionis[$i];
      }
      if ($status == 1) {
        $jam = date("H:i:s");
        $jurnal1 = array(
          'tanggal' => date("Y-m-d"),
          'keterangan' => 'Transaksi nomor kunjungan '.$nokun,
          'norek' => '20601',
          'debet' => 0,
          'kredit' => $total_menev,
          'pasien_noRM' => $norm,
          'no_urut' => $nokun,
          'no_transaksi' => $kode,
          'jam' => $jam
        );
        $jurnal2 = array(
          'tanggal' => date("Y-m-d"),
          'keterangan' => 'Transaksi nomor kunjungan '.$nokun,
          'norek' => '10701',
          'debet' => $total_menev,
          'kredit' => 0,
          'pasien_noRM' => $norm,
          'no_urut' => $nokun,
          'no_transaksi' => $kode,
          'jam' => $jam
        );
        if ($total_menev != 0) {
          // code...
          $this->db->insert("jurnal",$jurnal1);
          $this->db->insert("jurnal",$jurnal2);
        }
        $this->session->set_flashdata('notif', $this->Notif->berhasil('Berhasil Tersimpan'));
        redirect(base_url()."PeriksaRanap/index/".$data_periksa['kunjungan_no_urutkunjungan']."/".$periksa);
      } else {
        $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Tersimpan'));
        redirect(base_url()."PeriksaRanap/index/".$data_periksa['kunjungan_no_urutkunjungan']."/".$periksa);
      }

}

function input_labkun()
{
  $tanggal        = date('Y-m-d ');
  $jam            = date('Y-m-d H:i:d');
  $kodedok        = $_SESSION['nik'];
  $periksa_idperiksa = $this->input->post('nopem');
  $rujukan        = $this->input->post('rujukan');
  $perawat1       = $this->input->post('perawat1');
  $perawat2       = $this->input->post('perawat2');
  $periksa        = $this->input->post('nopem');
  $data_periksa = $this->ModelPeriksa->get_data_edit($periksa);
  $this->db->where('no_urutkunjungan',$data_periksa['kunjungan_no_urutkunjungan']);
  $this->db->update('kunjungan',array('sudah'=>3));

  $labkunjungan = array(
    'tanggal'     => $tanggal,
    'rujukan'     => $rujukan,
    'kodedok'     => $kodedok,
    'jam'         => $jam,
    'perawat1'    => $perawat1,
    'perawat2'    => $perawat2,
    'yan_lab'     => "0",
    'periksa_idperiksa' => $this->input->post('nopem')
  );
  if ($this->db->insert('labkunjungan', $labkunjungan)) {
    $labkun = $this->db->get_where('labkunjungan', $labkunjungan)->row_array();
    $idlabkun = $labkun['nokunjlab'];
    $kode_lab     = $this->input->post('kode_lab');
    $jenis        = $this->input->post('jenis_lab');
    $count = count($kode_lab);
    for ($i=0; $i < $count; $i++) {
      $data = array(
        'nourutlab'           => $idlabkun,
        'kodelab'             => $kode_lab[$i],
        'nama'                => $jenis[$i]
      );
      $insert = $this->db->insert('detaillab', $data);
      $this->db->reset_query();
      if ($insert == true) {
        $status = 1;
      }else {
        $status = 0;
      }
    }
    if ($status == 1) {
      $this->session->set_flashdata('notif', $this->Notif->berhasil('Berhasil Tersimpan'));
      redirect("PeriksaRanap/index/".$data_periksa['kunjungan_no_urutkunjungan']."/".$periksa);
    } else {
      $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Tersimpan')."/".$periksa);
      redirect("PeriksaRanap/index/".$data_periksa['kunjungan_no_urutkunjungan']."/".$periksa);
    }
  } else {
    $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Tersimpan'));
    redirect("PeriksaRanap/index/".$data_periksa['kunjungan_no_urutkunjungan']."/".$periksa);
  }

}

 function resep(){
   $periksa = $this->ModelPeriksa->get_data_edit($this->uri->segment(3));
   $kunjungan = $this->ModelKunjungan->get_data_edit_ranap($periksa['kunjungan_no_urutkunjungan']);
   $pasien = $this->ModelPasien->get_data_edit($kunjungan['pasien_noRM'])->row_array();
   $data = array(
     'idkunjungan' => $this->uri->segment(3),
     'kunjungan' => $kunjungan,
     'body'        => 'PeriksaRanap/resep',
     'pasien'      => $this->ModelPasien->get_data_edit($kunjungan['pasien_noRM'])->row_array(),
     'jenispasien' => $this->ModelJenisPasien->get_data_edit($pasien['jenis_pasien_kode_jenis'])->row_array(),
     'resep'       => $this->ModelObat->get_data(),
     'no_resep'    => $this->ModelResep->generate_no_resep(),
     'periksa'     => $this->ModelPeriksa->get_periksa_pasien($this->uri->segment(3)),
     'obat' => $this->ModelObat->get_data()
   );
   $this->load->view('index',$data);
 }

 function cariobat()
 {
   $idobat = $this->input->post('idobat');
   $obat = $this->ModelObat->get_data_edit($idobat)->row_array();
   if($obat['stok_berjalan']<=0){
     $status = 0;
   }else{
     $status = 1;
   }
   $kelas = $this->input->post("kelas_rawat");
   if ($kelas==3) {
     $harga = $obat['harga_2'];
   }else if ($kelas==2) {
     $harga = $obat['harga_3'];
   }else if ($kelas==1) {
     $harga=$obat['harga_4'];
   }else{
     $harga=$obat['harga_1'];
   }
   $data = array(
     'id_obat' => $obat['idobat'],
     'nama_obat' => $obat['nama_obat'],
     'label_harga' => "Rp.".number_format($harga,2,",","."),
     'harga' => $harga,
     'dosis' => $obat['dosis'],
     'stok' => $obat['stok_berjalan'],
     'status' => $status
   );
   echo json_encode($data);
 }

 public function input_resep(){

   $tanggal        = date('Y-m-d h:i:s');
   $kode_dokter    = $_SESSION['nik'];
   $perawat1       = $this->input->post('perawat1');
   $perawat2       = $this->input->post('perawat2');
   $no_resep       = $this->ModelResep->generate_no_resep();
   $periksa        = $this->input->post('nopem');
   $data_periksa = $this->ModelPeriksa->get_data_edit($periksa);
   $this->db->where('no_urutkunjungan',$data_periksa['kunjungan_no_urutkunjungan']);
   $this->db->update('kunjungan',array('sudah'=>4));
   $daftar_obat      = $this->input->post('kode');
   if (empty($daftar_obat)) {
     $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal membuat resep, obat tidak dipilih'));
     redirect(base_url()."PeriksaRanap/index/".$data_periksa['kunjungan_no_urutkunjungan']."/".$periksa);
   }else{

   $resep = array(
     'tanggal'     => $tanggal,
     'kode_dokter' => $kode_dokter,
     'perawat1'    => $perawat1,
     'perawat2'    => $perawat2,
     'no_resep'    => $no_resep,
     'periksa_idperiksa' => $periksa
   );
   if ($this->db->insert('resep', $resep)) {
     $id_obat      = $this->input->post('kode');
     $harga     = $this->input->post('harga');
     $jumlah       = $this->input->post('jumlah');
     $signa       = $this->input->post('signa');
     $total_harga       = $this->input->post('ttl_harga');
     $count = count($id_obat);
     for ($i=0; $i < $count; $i++) {
       $obat = $this->ModelObat->get_data_edit($id_obat[$i])->row_array();
       $data = array(
         'harga'          => $harga[$i],
         'jumlah'         => $jumlah[$i],
         'total_harga'    => $total_harga[$i],
         'resep_no_resep' => $no_resep,
         'obat_idobat'    => $id_obat[$i],
         'signa' => $signa[$i]
       );
       $stok_saat_ini = (int)$obat['stok_berjalan']-(int)$jumlah[$i];
       $this->db->where('idobat',$id_obat[$i]);
       $this->db->update('obat',array('stok_berjalan'=>$stok_saat_ini));
       $insert = $this->db->insert('detail_resep', $data);
       $this->db->reset_query();
       // $this->db->where('kunjungan',$periksa);
       if ($insert == true) {
         $status = 1;
       }else {
         $status = 0;
       }
     }
     if ($status == 1) {
       $this->session->set_flashdata('notif', $this->Notif->berhasil('Berhasil Tersimpan'));
       redirect(base_url()."PeriksaRanap/index/".$data_periksa['kunjungan_no_urutkunjungan']."/".$periksa);
     } else {
       $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Tersimpan'));
       redirect(base_url()."PeriksaRanap/index/".$data_periksa['kunjungan_no_urutkunjungan']."/".$periksa);
     }
   } else {
     $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Tersimpan'));
     redirect(base_url()."PeriksaRanap/index/".$data_periksa['kunjungan_no_urutkunjungan']."/".$periksa);
   }
 }

 }

 function obgyn()
 {
   $kunjungan = $this->ModelKunjungan->get_data_edit($this->uri->segment(3));
   $pasien = $this->ModelPasien->get_data_edit($kunjungan['pasien_noRM'])->row_array();
   $data = array(
     'idkunjungan' => $this->uri->segment(3),
     'body'        => 'Periksa/poli/obgyn',
     'pasien'      => $this->ModelPasien->get_data_edit($kunjungan['pasien_noRM'])->row_array(),
     'jenispasien' => $this->ModelJenisPasien->get_data_edit($pasien['jenis_pasien_kode_jenis'])->row_array(),
     'lab'         => $this->ModelLaborat->get_data(),
     'periksa'     => $this->ModelPeriksa->get_periksa_pasien($this->uri->segment(3)),
     'riwayat'     => $this->ModelPeriksa->get_riwayat_obgyn($kunjungan['pasien_noRM'])->result()
   );

   $this->load->view('index', $data);
 }

 function insert_obgyn($value='')
 {
   $dataobgyn= array(
     'manarche_umur'     => $this->input->post('manarcheumur'),
     'lamahaid'          => $this->input->post('lamahaid'),
     'siklus'            => $this->input->post('siklus'),
     'keluhan_obgyn'     => implode(', ',$this->input->post('keluhan_obgyn')),
     'g'                 => $this->input->post('g'),
     'p'                 => $this->input->post('p'),
     'a'                 => $this->input->post('a'),
     'hpht'              => $this->input->post('hpht'),
     'hpl'               => date("Y-m-d",$this->input->post('hpl')),
     'uk'                => $this->input->post('uk'),
     'keluhanhamil'      => $this->input->post('keluhan_kehamilan'),
     'infertilitas'      => $this->input->post('infertilitas'),
     'infeksivirus'      => $this->input->post('Infeksi'),
     'pms'               => $this->input->post('PMS'),
     'cervitiscronis'    => $this->input->post('Cervitiscronis'),
     'endometriosis'     => $this->input->post('Endometriosis'),
     'myoma'             => $this->input->post('Myoma'),
     'ok'                => $this->input->post('ok'),
     'perkosaan'         => '',
     'pcb'               => $this->input->post('pcb'),
     'fag'               => $this->input->post('fag'),
     'gatal'             => $this->input->post('gatal'),
     'berbau'            => $this->input->post('berbau'),
     'warna'             => $this->input->post('warna'),
     'metodekb'          => $this->input->post('metodekb'),
     'lamakb'            => $this->input->post('lamakb'),
     'komplikasi'        => implode(', ',$this->input->post('Komplikasi')),
     'kunjungan_no_urutkunjungan' => $this->input->post('nokun'),
     'tanggal' => date('Y-m-d'),
     'no_rm'   => $this->input->post('no_rm'),
     'unit_layanan'  => $_SESSION['poli']
   );
   if ($this->db->insert('periksa', $dataobgyn)) {
     $this->db->reset_query();
     $this->db->where('no_urutkunjungan', $this->input->post('nokun'));
     $this->db->update('kunjungan',array('sudah' => '1', ));
     $this->session->set_flashdata('notif', $this->Notif->berhasil('Berhasil Tersimpan'));
     redirect(base_url().'PeriksaRanap/index/'.$this->input->post('nokun')."/".$periksa);
   } else {
     $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Tersimpan'));
     redirect(base_url().'PeriksaRanap/index/'.$this->input->post('nokun')."/".$periksa);
   }
 }
 public function pemakaianObat(){
   $data = array(
     'form' => 'PemakaianObat/form',
     'body' => 'PemakaianObat/list',
     'obat' => $this->ModelObat->get_data()
   );
   $this->load->view('index', $data);
 }

 public function kandungan(){
   $hpht1 = $this->input->post('hpht');
   // $hpht1 = "2019-01-01";
   // Convert Ke Date Time
   $hpht = new DateTime($hpht1);
   $today = new DateTime();

   $diff = $today->diff($hpht);
   // $hpl = $hpht->modify('+280 days');
   // $hpl->format("Y-m-d");
   $hpl = date("d-m-Y",strtotime($hpht1."+280 days"));
   $res = array(
      'uk' => $diff->d." Hari",
      'hpl' => $hpl
   );
   // die(var_dump($res));
   echo json_encode($res);
 }
 public function rujuk(){
   $nokun = $this->uri->segment(3);
   $tujuan = $this->input->post("tujuan_poli");
   $data = array(
     'poli' => $_SESSION['poli'],
     'tujuan_poli' => $tujuan,
     'kunjungan_no_urutkunjungan' => $nokun
   );
   $this->db->insert('rujukan_internal',$data);
   $this->db->where('no_urutkunjungan',$nokun);
   $this->db->update('kunjungan',array('rujukan_internal'=>1));
   $this->session->set_flashdata('notif',$this->Notif->berhasil("Pasien telah dirujuk atau dialihkan ke unit layanan lain"));
   redirect(base_url()."Kunjungan");
 }
 function edit_resep(){
 $periksa = $this->ModelPeriksa->get_data_edit($this->uri->segment(3));
 $kunjungan = $this->ModelKunjungan->get_data_edit_baru($periksa['kunjungan_no_urutkunjungan']);
 $pasien = $this->ModelPasien->get_data_edit($kunjungan['pasien_noRM'])->row_array();
 $data = array(
   'idkunjungan' => $this->uri->segment(3),
   'body'        => 'PeriksaRanap/resep_edit',
   'pasien'      => $this->ModelPasien->get_data_edit($kunjungan['pasien_noRM'])->row_array(),
   'jenispasien' => $this->ModelJenisPasien->get_data_edit($pasien['jenis_pasien_kode_jenis'])->row_array(),
   'resep'       => $this->ModelObat->get_data(),
   'no_resep'    => $this->ModelResep->generate_no_resep(),
   'periksa'     => $this->ModelPeriksa->get_periksa_pasien($this->uri->segment(3)),
   'obat' => $this->ModelObat->get_data(),
   'kunjungan' => $kunjungan
 );
 if ($this->uri->segment(4)!='') {
   $data_obat = $this->db->join('obat','obat.idobat=detail_resep.obat_idobat')
                ->where_in("resep_no_resep",$this->uri->segment(4))
                ->get('detail_resep')->result();
   $data['resep_lama'] = $data_obat;
 }
 $this->load->view('index',$data);
}
public function update_resep($no_resep){
 $tanggal        = date('Y-m-d h:i:s');
 $kode_dokter    = $_SESSION['nik'];
 $periksa        = $this->input->post('nopem');
 $data_periksa = $this->ModelPeriksa->get_data_edit($periksa);
 $detil_resep = $this->db->where_in('resep_no_resep',$no_resep)->get('detail_resep')->result();
 foreach ($detil_resep as $value) {
   $obat = $this->ModelObat->get_data_edit($value->obat_idobat)->row_array();
   $stok_saat_ini = (int)$obat['stok_berjalan']+(int)$value->jumlah;
   $this->db->where('idobat',$value->obat_idobat);
   $this->db->update('obat',array('stok_berjalan'=>$stok_saat_ini));
 }
 $this->db->where_in('resep_no_resep',$no_resep);
 $this->db->delete('detail_resep');
 $resep = array(
   'tanggal'     => $tanggal,
   'kode_dokter' => $kode_dokter,
 );
 if ($this->db->where('no_resep',$no_resep)->update('resep', $resep)) {
   $id_obat      = $this->input->post('kode');
   $harga     = $this->input->post('harga');
   $jumlah       = $this->input->post('jumlah');
   $signa       = $this->input->post('signa');
   $total_harga       = $this->input->post('ttl_harga');
   $count = count($id_obat);
   for ($i=0; $i < $count; $i++) {
     $obat = $this->ModelObat->get_data_edit($id_obat[$i])->row_array();
     $data = array(
       'harga'          => $harga[$i],
       'jumlah'         => $jumlah[$i],
       'total_harga'    => $total_harga[$i],
       'resep_no_resep' => $no_resep,
       'obat_idobat'    => $id_obat[$i],
       'signa' => $signa[$i]
     );
     $stok_saat_ini = (int)$obat['stok_berjalan']-(int)$jumlah[$i];
     $this->db->where('idobat',$id_obat[$i]);
     $this->db->update('obat',array('stok_berjalan'=>$stok_saat_ini));
     $insert = $this->db->insert('detail_resep', $data);
     $this->db->reset_query();
     // $this->db->where('kunjungan',$periksa);
     if ($insert == true) {
       $status = 1;
     }else {
       $status = 0;
     }
   }
   if ($status == 1) {
     $this->session->set_flashdata('notif', $this->Notif->berhasil('Berhasil Edit Resep'));
     redirect(base_url()."PeriksaRanap/index/".$data_periksa['kunjungan_no_urutkunjungan']."/".$periksa);
   } else {
     $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Tersimpan'));
     redirect(base_url()."PeriksaRanap/index/".$data_periksa['kunjungan_no_urutkunjungan']."/".$periksa);
   }
 } else {
   $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Tersimpan'));
   redirect(base_url()."PeriksaRanap/index/".$data_periksa['kunjungan_no_urutkunjungan']."/".$periksa);
 }

}
function edit_lab()
{
  $periksa = $this->ModelPeriksa->get_data_edit($this->uri->segment(3));
  $kunjungan = $this->ModelKunjungan->get_data_edit($periksa['kunjungan_no_urutkunjungan']);
  $pasien = $this->ModelPasien->get_data_edit($kunjungan['pasien_noRM'])->row_array();
  $data = array(
    'idkunjungan' => $this->uri->segment(3),
    'body'        => 'PeriksaRanap/edit_lab',
    'pasien'      => $this->ModelPasien->get_data_edit($kunjungan['pasien_noRM'])->row_array(),
    'jenispasien' => $this->ModelJenisPasien->get_data_edit($pasien['jenis_pasien_kode_jenis'])->row_array(),
    'lab'         => $this->ModelLaborat->get_data_type()->result(),
    'periksa'     => $this->ModelPeriksa->get_periksa_pasien($kunjungan['pasien_noRM']),
    'permintaan_lab' => $this->ModelLaborat->get_permintaan($this->uri->segment(3))
  );

  $this->load->view('index', $data);
  // echo $periksa['kunjungan_no_urutkunjungan'];
}
function edit_labkun()
{
  $tanggal        = date('Y-m-d ');
  $jam            = date('Y-m-d H:i:d');
  $kodedok        = $_SESSION['nik'];
  $periksa_idperiksa = $this->input->post('nopem');
  $rujukan        = $this->input->post('rujukan');
  $perawat1       = $this->input->post('perawat1');
  $perawat2       = $this->input->post('perawat2');
  $periksa        = $this->input->post('nopem');
  $data_periksa = $this->ModelPeriksa->get_data_edit($periksa);
  $this->db->where('no_urutkunjungan',$data_periksa['kunjungan_no_urutkunjungan']);
  $this->db->update('kunjungan',array('sudah'=>3));
  $datakun_lab = $this->db->get_where('labkunjungan',array('periksa_idperiksa'=>$periksa))->row_array();
  $this->db->where_in('nourutlab',$datakun_lab['nokunjlab']);
  $this->db->delete('detaillab');
  $labkunjungan = array(
    'tanggal'     => $tanggal,
    'rujukan'     => $rujukan,
    'kodedok'     => $kodedok,
    'jam'         => $jam,
    'perawat1'    => $perawat1,
    'perawat2'    => $perawat2,
    'yan_lab'     => "0",
    'periksa_idperiksa' => $this->input->post('nopem')
  );
  $this->db->where('periksa_idperiksa',$periksa);
  if ($this->db->update('labkunjungan', $labkunjungan)) {
    $labkun = $this->db->get_where('labkunjungan', $labkunjungan)->row_array();
    $idlabkun = $labkun['nokunjlab'];
    $kode_lab     = $this->input->post('kode_lab');
    $jenis        = $this->input->post('jenis_lab');
    $count = count($kode_lab);
    $harga = $this->input->post('harga_lab');

    $list_kode = array();
    $status = 0;
    if ($count == 0) {
      $this->db->where('periksa_idperiksa',$this->input->post('nopem'))->delete('labkunjungan');
    }else{
      for ($i=0; $i < $count; $i++) {
        $kode = substr($kode_lab[$i],0,3);
        // die($kode);
        if ($harga[$i]==0 && !in_array($kode,$kode_lab,TRUE) && !in_array($kode,$list_kode,TRUE)) {

          $hit = $this->db->get_where('laborat', array('kode_lab' => $kode , ))->num_rows();
          // die(var_dump($hit));
          if ($hit > 0) {
            $lab = $this->ModelLaborat->get_data_edit($kode);
            // die(var_dump($lab));
            $data = array(
              'nourutlab'           => $idlabkun,
              'kodelab'             => $lab['kode_lab'],
              'nama'                => $lab['jenis_lab'],
              'harga' => $lab['hrg_1'],
              'komisi' => $lab['hrg_1']
            );
            $insert = $this->db->insert('detaillab', $data);
            $this->db->reset_query();
            array_push($list_kode,$kode);
          }
        }
        $data = array(
          'nourutlab'           => $idlabkun,
          'kodelab'             => $kode_lab[$i],
          'nama'                => $jenis[$i],
          'harga' => $harga[$i],
          'komisi' => $harga[$i]
        );
        $insert = $this->db->insert('detaillab', $data);
        $this->db->reset_query();
        if ($insert == true) {
          $status = 1;
        }else {
          $status = 0;
        }
      }

    }
    if ($status == 1) {
      $this->session->set_flashdata('notif', $this->Notif->berhasil('Berhasil Tersimpan'));
      redirect("PeriksaRanap/index/".$data_periksa['kunjungan_no_urutkunjungan']."/".$periksa);
    } else {
      $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Tersimpan'));
      redirect("PeriksaRanap/index/".$data_periksa['kunjungan_no_urutkunjungan']."/".$periksa);
    }
  } else {
    $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Tersimpan'));
    redirect("PeriksaRanap/index/".$data_periksa['kunjungan_no_urutkunjungan']."/".$periksa);
  }

}

}
