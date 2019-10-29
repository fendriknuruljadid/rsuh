<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Periksa extends CI_Controller{

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
    $this->load->model('ModelJasaBHP');
    $this->load->model('ModelAkuntansi');
  }

  function index()
  {
    $kunjungan = $this->ModelKunjungan->get_data_edit($this->uri->segment(3));
    $pasien = $this->ModelPasien->get_data_edit($kunjungan['pasien_noRM'])->row_array();
    $data = array(
      'idkunjungan' => $this->uri->segment(3),
      'kunjungan'   => $kunjungan,
      'body'        => 'Periksa/index2',
      'pasien'      => $this->ModelPasien->get_data_edit($kunjungan['pasien_noRM'])->row_array(),
      'jenispasien' => $this->ModelJenisPasien->get_data_edit($pasien['jenis_pasien_kode_jenis'])->row_array(),
      'tupel'       => $this->ModelTujuanPelayanan->get_data_edit($kunjungan['tupel_kode_tupel'])->row_array(),
      'riwayat_alergi'=> $this->ModelRiwayatAlergi->get_data($kunjungan['pasien_noRM'])->result(),
      'periksa'     => $this->ModelPeriksa->get_periksa_pasien($this->uri->segment(3)),
    );
    if ($this->ModelDemografi->get_asesmen_kunjungan($this->uri->segment(3))->num_rows() > 0) {
      $data['demografi'] = $this->ModelDemografi->get_asesmen_kunjungan($this->uri->segment(3))->row_array();
    }
    if ($this->ModelDemografi->get_asesmen_igd_kunjungan($this->uri->segment(3))->num_rows() > 0) {
      $data['asesmen'] = $this->ModelDemografi->get_asesmen_igd_kunjungan($this->uri->segment(3))->row_array();
    }
    $this->load->view('index', $data);
  }
  public function pulang($id=null){
    $this->db->where('no_urutkunjungan',$id);
    $this->db->update('kunjungan',array('siap_pulang'=>1));
    $this->session->set_flashdata('notif',$this->Notif->berhasil("Pasien Telah Siap Di Pulangkan!!!"));
    redirect(base_url()."Kunjungan");
  }
  public function bataL_pulang($id=null){
    $this->db->where('no_urutkunjungan',$id);
    $this->db->update('kunjungan',array('siap_pulang'=>0));
    $this->session->set_flashdata('notif',$this->Notif->berhasil("Pasien Telah Dibatalkan Pulang!!!"));
    redirect(base_url()."Kunjungan");
  }
  function pemeriksaan()
  {
    $kunjungan = $this->ModelKunjungan->get_data_edit($this->uri->segment(3));
    $pasien = $this->ModelPasien->get_data_edit($kunjungan['pasien_noRM'])->row_array();
    $data = array(
      'idkunjungan' => $this->uri->segment(3),
      'kunjungan'   => $kunjungan,
      'body'        => 'Periksa/pemeriksaan2',
      'pasien'      => $this->ModelPasien->get_data_edit($kunjungan['pasien_noRM'])->row_array(),
      'jenispasien' => $this->ModelJenisPasien->get_data_edit($pasien['jenis_pasien_kode_jenis'])->row_array(),
      'lab'         => $this->ModelLaborat->get_data(),
      'periksa'     => $this->ModelPeriksa->get_periksa_pasien($this->uri->segment(3))
    );

    $this->load->view('index', $data);
  }
  function pemeriksaan2()
  {
    $kunjungan = $this->ModelKunjungan->get_data_edit($this->uri->segment(3));
    $pasien = $this->ModelPasien->get_data_edit($kunjungan['pasien_noRM'])->row_array();
    $data = array(
      'idkunjungan' => $this->uri->segment(3),
      'body'        => 'Periksa/pemeriksaan',
      'pasien'      => $this->ModelPasien->get_data_edit($kunjungan['pasien_noRM'])->row_array(),
      'jenispasien' => $this->ModelJenisPasien->get_data_edit($pasien['jenis_pasien_kode_jenis'])->row_array(),
      'lab'         => $this->ModelLaborat->get_data(),
      'periksa'     => $this->ModelPeriksa->get_periksa_pasien($this->uri->segment(3))
    );

    $this->load->view('index', $data);
  }

  function input_pemeriksaan()
  {

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
      'operator' => $_SESSION['nik']

    );
    if ($this->db->insert('periksa', $periksa)) {
      $this->db->reset_query();
      $this->db->where('no_urutkunjungan', $this->input->post('nokun'));
      $this->db->update('kunjungan',array('sudah' => '1',));
      $this->session->set_flashdata('alert', $this->Core->alert_succcess('Berhasil Tersimpan'));
      redirect(base_url().'Periksa/index/'.$this->input->post('nokun'));
    } else {
      $this->session->set_flashdata('alert', $this->Core->alert_danger('Gagal Tersimpan'));
      redirect(base_url().'Periksa/index/'.$this->input->post('nokun'));
    }
  }



  function lab()
  {
    $periksa = $this->ModelPeriksa->get_data_edit($this->uri->segment(3));
    $kunjungan = $this->ModelKunjungan->get_data_edit($periksa['kunjungan_no_urutkunjungan']);
    $pasien = $this->ModelPasien->get_data_edit($kunjungan['pasien_noRM'])->row_array();
    $data = array(
      'idkunjungan' => $this->uri->segment(3),
      'body'        => 'Periksa/lab',
      'pasien'      => $this->ModelPasien->get_data_edit($kunjungan['pasien_noRM'])->row_array(),
      'jenispasien' => $this->ModelJenisPasien->get_data_edit($pasien['jenis_pasien_kode_jenis'])->row_array(),
      'lab'         => $this->ModelLaborat->get_data_type()->result(),
      'periksa'     => $this->ModelPeriksa->get_periksa_pasien($kunjungan['pasien_noRM'])
    );

    $this->load->view('index', $data);
    // echo $periksa['kunjungan_no_urutkunjungan'];
  }
  function edit_lab()
  {
    $periksa = $this->ModelPeriksa->get_data_edit($this->uri->segment(3));
    $kunjungan = $this->ModelKunjungan->get_data_edit($periksa['kunjungan_no_urutkunjungan']);
    $pasien = $this->ModelPasien->get_data_edit($kunjungan['pasien_noRM'])->row_array();
    $data = array(
      'idkunjungan' => $this->uri->segment(3),
      'body'        => 'Periksa/edit_lab',
      'pasien'      => $this->ModelPasien->get_data_edit($kunjungan['pasien_noRM'])->row_array(),
      'jenispasien' => $this->ModelJenisPasien->get_data_edit($pasien['jenis_pasien_kode_jenis'])->row_array(),
      'lab'         => $this->ModelLaborat->get_data_type()->result(),
      'periksa'     => $this->ModelPeriksa->get_periksa_pasien($kunjungan['pasien_noRM']),
      'permintaan_lab' => $this->ModelLaborat->get_permintaan($this->uri->segment(3))
    );

    $this->load->view('index', $data);
    // echo $periksa['kunjungan_no_urutkunjungan'];
  }
  function labsearch()
  {
    $lab = $this->ModelLaborat->get_datasub($this->uri->segment(3))->result();
    foreach ($lab as $data) {
      echo "<tr>
      <td><input hidden value='$data->kode_lab' name='kode_lab[]'>$data->kode_lab</td>
      <td><input hidden value='$data->jenis_lab' name='jenis_lab[]'><input hidden value='$data->hrg_1' name='harga_lab[]'>$data->jenis_lab</td>
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
    $kunjungan = $this->ModelKunjungan->get_data_edit($periksa['kunjungan_no_urutkunjungan']);
    $pasien = $this->ModelPasien->get_data_edit($kunjungan['pasien_noRM'])->row_array();
    $data = array(
      'idkunjungan' => $this->uri->segment(3),
      'body'        => 'Periksa/tindakan',
      'pasien'      => $this->ModelPasien->get_data_edit($kunjungan['pasien_noRM'])->row_array(),
      'jenispasien' => $this->ModelJenisPasien->get_data_edit($pasien['jenis_pasien_kode_jenis'])->row_array(),
      'penyakit'    => $this->ModelPenyakit->get_data(),
      'modaljapel'   => $this->ModelJasaPelayanan->get_data(),
      'periksa'     => $this->ModelPeriksa->get_periksa_pasien($this->uri->segment(3))

    );
    $this->load->view('index', $data);
  }
  function tindakan2()
  {
    $periksa = $this->ModelPeriksa->get_data_edit($this->uri->segment(3));
    $kunjungan = $this->ModelKunjungan->get_data_edit($periksa['kunjungan_no_urutkunjungan']);
    $pasien = $this->ModelPasien->get_data_edit($kunjungan['pasien_noRM'])->row_array();
    $data = array(
      'idkunjungan' => $this->uri->segment(3),
      'body'        => 'Periksa/tindakan2',
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
      'body'        => 'Periksa/edit_tindakan',
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
      $row[] = $field->indonesia;
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
      redirect(base_url()."Periksa/index/".$data_periksa['kunjungan_no_urutkunjungan']);
    } else {
      $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Tersimpan'));
      redirect(base_url()."Periksa/index/".$data_periksa['kunjungan_no_urutkunjungan']);
    }

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

    $total_jasa = 0;
    $total_menev = 0;
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
      $total_jasa += $harga[$i];
      $total_menev += $japeldokter[$i]+$japelperawat[$i]+$japeladmin[$i]+$japelresepsionis[$i];
    }
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
    $jurnal3 = array(
      'tanggal' => date("Y-m-d"),
      'keterangan' => 'Transaksi nomor kunjungan '.$nokun,
      'norek' => '50003',
      'debet' => 0,
      'kredit' => $total_jasa,
      'pasien_noRM' => $norm,
      'no_urut' => $nokun,
      'no_transaksi' => $kode,
      'jam' => $jam
    );
    $jurnal4 = array(
      'tanggal' => date("Y-m-d"),
      'keterangan' => 'Transaksi nomor kunjungan '.$nokun,
      'norek' => '10701',
      'debet' => $total_jasa,
      'kredit' => 0,
      'pasien_noRM' => $norm,
      'no_urut' => $nokun,
      'no_transaksi' => $kode,
      'jam' => $jam
    );
    if ($total_menev!=0) {
      // code...
      $this->db->insert('jurnal',$jurnal1);
      $this->db->insert('jurnal',$jurnal2);
    }
    // $this->db->insert('jurnal',$jurnal3);
    // $this->db->insert('jurnal',$jurnal4);

    if ($status == 1) {
      $this->session->set_flashdata('alert', $this->Core->alert_succcess('Berhasil Tersimpan'));
      redirect(base_url()."Periksa/index/".$data_periksa['kunjungan_no_urutkunjungan']);
    } else {
      $this->session->set_flashdata('alert', $this->Core->alert_danger('Gagal Tersimpan'));
      redirect(base_url()."Periksa/index/".$data_periksa['kunjungan_no_urutkunjungan']);
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
    $norm = $this->input->post("no_rm");
    $kode_akun = $this->ModelAkuntansi->generete_notrans();
    $nokun = $data_periksa['kunjungan_no_urutkunjungan'];

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
      $harga = $this->input->post('harga_lab');
      $list_kode = array();
      $status = 0;
      if ($count == 0) {
        $this->db->where('periksa_idperiksa',$this->input->post('nopem'))->delete('labkunjungan');
      }else{
        $total_harga_lab = 0;
        for ($i=0; $i < $count; $i++) {
          // die($kode);
          $kode = substr($kode_lab[$i],0,3);
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
              $total_harga_lab += $data['harga'];
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
          $data_lab = $this->db->get_where("laborat",array('kode_lab'=>$kode_lab[$i]))->row_array();
          $total_harga_lab += $data_lab['jasa_dokter_1']+$data_lab['jasa_perawat_1']+$data_lab['jasa_resepsionis_1']+$data_lab['jasa_analis_1']+$data_lab['jasa_ob_1']+$data_lab['jasa_admin_1'];
        }

      }
      if ($status == 1) {
        $jam = date("H:i:s");
        $jurnal1 = array(
          'tanggal' => date("Y-m-d"),
          'keterangan' => 'Transaksi nomor kunjungan '.$nokun,
          'norek' => '10701',
          'debet' => $total_harga_lab,
          'kredit' => 0,
          'pasien_noRM' => $norm,
          'no_urut' => $nokun,
          'no_transaksi' => $kode_akun,
          'jam' => $jam
        );
        $jurnal2 = array(
          'tanggal' => date("Y-m-d"),
          'keterangan' => 'Transaksi nomor kunjungan '.$nokun,
          'norek' => '20601',
          'debet' => 0,
          'kredit' => $total_harga_lab,
          'pasien_noRM' => $norm,
          'no_urut' => $nokun,
          'no_transaksi' => $kode_akun,
          'jam' => $jam
        );
        if ($total_harga_lab!=0) {
          // code...
          $this->db->insert('jurnal',$jurnal1);
          $this->db->insert('jurnal',$jurnal2);
        }
        $this->session->set_flashdata('notif', $this->Notif->berhasil('Berhasil Tersimpan'));
        redirect("Periksa/index/".$data_periksa['kunjungan_no_urutkunjungan']);
      } else {
        $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Tersimpan'));
        redirect("Periksa/index/".$data_periksa['kunjungan_no_urutkunjungan']);
      }

    } else {
      $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Tersimpan'));
      redirect("Periksa/index/".$data_periksa['kunjungan_no_urutkunjungan']);
    }

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
    $nokun = $data_periksa['kunjungan_no_urutkunjungan'];
    $norm = $data_periksa['no_rm'];
    $this->db->where('no_urutkunjungan',$data_periksa['kunjungan_no_urutkunjungan']);
    $this->db->update('kunjungan',array('sudah'=>3));
    $datakun_lab = $this->db->get_where('labkunjungan',array('periksa_idperiksa'=>$periksa))->row_array();
    $data_detail = $this->db->where_in('nourutlab',$datakun_lab['nokunjlab'])->get("detaillab")->result();
    $harga_awal=0;
    $harga_akhir=0;
    $kode_akun = $this->ModelAkuntansi->generete_notrans();
    foreach ($data_detail as $value) {
      $harga_awal += $value->harga;
    }

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
          $harga_akhir += $harga[$i];
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
        $jam = date("H:i:s");
        $jurnal1 = array(
          'tanggal' => date("Y-m-d"),
          'keterangan' => 'Transaksi nomor kunjungan '.$nokun,
          'norek' => '10701',
          'debet' => 0,
          'kredit' => 0,
          'pasien_noRM' => $norm,
          'no_urut' => $nokun,
          'no_transaksi' => $kode_akun,
          'jam' => $jam
        );
        $jurnal2 = array(
          'tanggal' => date("Y-m-d"),
          'keterangan' => 'Transaksi nomor kunjungan '.$nokun,
          'norek' => '50004',
          'debet' => 0,
          'kredit' => 0,
          'pasien_noRM' => $norm,
          'no_urut' => $nokun,
          'no_transaksi' => $kode_akun,
          'jam' => $jam
        );
        // if ($harga_awal>$harga_akhir) {
        //   $harga_selisih = $harga_awal-$harga_akhir;
        //   $jurnal1['kredit'] = $harga_selisih;
        //   $jurnal2['debet'] = $harga_selisih;
        // }else{
        //   $harga_selisih = $harga_akhir-$harga_awal;
        //   $jurnal1['debet'] = $harga_selisih;
        //   $jurnal2['kredit'] = $harga_selisih;
        // }
        // $this->db->insert('jurnal',$jurnal1);
        // $this->db->insert('jurnal',$jurnal2);
        $this->session->set_flashdata('notif', $this->Notif->berhasil('Berhasil Tersimpan'));
        redirect("Periksa/index/".$data_periksa['kunjungan_no_urutkunjungan']);
      } else {
        $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Tersimpan'));
        redirect("Periksa/index/".$data_periksa['kunjungan_no_urutkunjungan']);
      }
    } else {
      $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Tersimpan'));
      redirect("Periksa/index/".$data_periksa['kunjungan_no_urutkunjungan']);
    }

  }

  function resep(){
    $periksa = $this->ModelPeriksa->get_data_edit($this->uri->segment(3));
    $kunjungan = $this->ModelKunjungan->get_data_edit($periksa['kunjungan_no_urutkunjungan']);
    $pasien = $this->ModelPasien->get_data_edit($kunjungan['pasien_noRM'])->row_array();
    $data = array(
      'idkunjungan' => $this->uri->segment(3),
      'body'        => 'Periksa/resep',
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
    if ($_SESSION['poli']=='OZO') {
      $harga = $obat['harga_ozon'];
    }else{
      $harga = $obat['harga_1'];
    }
    $data = array(
      'id_obat' => $obat['idobat'],
      'nama_obat' => $obat['nama_obat'],
      'label_harga' => "Rp.".number_format($obat['harga_1'],2,",","."),
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
    $norm       = $this->input->post('no_rm');
    $perawat1       = $this->input->post('perawat1');
    $perawat2       = $this->input->post('perawat2');
    $no_resep       = $this->ModelResep->generate_no_resep();
    $periksa        = $this->input->post('nopem');
    $data_periksa = $this->ModelPeriksa->get_data_edit($periksa);
    $kode = $this->ModelAkuntansi->generete_notrans();
    $nokun = $data_periksa['kunjungan_no_urutkunjungan'];
    $row = $this->db->get_where("resep",array("periksa_idperiksa"=>$periksa))->num_rows();
      $daftar_obat      = $this->input->post('kode');
    if (empty($daftar_obat)) {
      $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal membuat resep, obat tidak dipilih'));
      redirect(base_url()."Periksa/index/".$data_periksa['kunjungan_no_urutkunjungan']);
    }else{
      if ($row > 0) {
        $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal,Resep telah dibuat sebelumnya'));
        redirect(base_url()."Periksa/index/".$data_periksa['kunjungan_no_urutkunjungan']);
      }else{
      $this->db->where('no_urutkunjungan',$data_periksa['kunjungan_no_urutkunjungan']);
      $this->db->update('kunjungan',array('sudah'=>4));
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

        $total_hpp_obat = 0;
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
          $total_hpp_obat += $obat['harga_beli_satuan_kecil']*$jumlah[$i];
        }

        $jam = date("H:i:s");
        $jurnal1 = array(
          'tanggal' => date("Y-m-d"),
          'keterangan' => 'Transaksi nomor kunjungan '.$nokun,
          'norek' => '10701',
          'debet' => $total_hpp_obat,
          'kredit' => 0,
          'pasien_noRM' => $norm,
          'no_urut' => $nokun,
          'no_transaksi' => $kode,
          'jam' => $jam
        );
        $jurnal2 = array(
          'tanggal' => date("Y-m-d"),
          'keterangan' => 'Transaksi nomor kunjungan '.$nokun,
          'norek' => '10501',
          'debet' => 0,
          'kredit' => $total_hpp_obat,
          'pasien_noRM' => $norm,
          'no_urut' => $nokun,
          'no_transaksi' => $kode,
          'jam' => $jam
        );
        // $this->db->insert('jurnal',$jurnal1);
        // $this->db->insert('jurnal',$jurnal2);

        if ($status == 1) {
          $this->session->set_flashdata('notif', $this->Notif->berhasil('Berhasil Tersimpan'));
          redirect(base_url()."Periksa/index/".$data_periksa['kunjungan_no_urutkunjungan']);
        } else {
          $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Tersimpan'));
          redirect(base_url()."Periksa/index/".$data_periksa['kunjungan_no_urutkunjungan']);
        }
      } else {
        $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Tersimpan'));
        redirect(base_url()."Periksa/index/".$data_periksa['kunjungan_no_urutkunjungan']);
      }
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
      'hpl'               => $this->input->post('hpl'),
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
      'lamakb_bln'  => $this->input->post('lamakb_bln'),
      'pernah_kb' => $this->input->post('pernahkb'),
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
      $this->session->set_flashdata('alert', $this->Core->alert_succcess('Berhasil Tersimpan'));
      redirect(base_url().'Periksa/index/'.$this->input->post('nokun'));
    } else {
      $this->session->set_flashdata('alert', $this->Core->alert_danger('Gagal Tersimpan'));
      redirect(base_url().'Periksa/index/'.$this->input->post('nokun'));
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
    $tgl = $this->input->post('hpht');
    $hpht1 = date("Y-m-d",strtotime($tgl));
    $hpl = date("d-m-Y",strtotime("+280 days",strtotime($hpht1)));
    $hpht      = strtotime($hpht1);
    $sekarang = time(); // Waktu sekarang
    $uk       = $sekarang - $hpht;
    $uk = floor($uk / (60 * 60 * 24));
    $uk = floor($uk/7)." Minggu";
    if ($tgl=='') {
      $res = array(
        'uk' => "ulangi pilih hpht",
        'hpl' => "ulangi pilih hpht"
      );
    }else{
      $res = array(
        'uk' => $uk ,
        'hpl' => $hpl
      );
    }
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
    $kunjungan = $this->ModelKunjungan->get_data_edit($periksa['kunjungan_no_urutkunjungan']);
    $pasien = $this->ModelPasien->get_data_edit($kunjungan['pasien_noRM'])->row_array();
    $data = array(
      'idkunjungan' => $this->uri->segment(3),
      'body'        => 'Periksa/resep_edit',
      'pasien'      => $this->ModelPasien->get_data_edit($kunjungan['pasien_noRM'])->row_array(),
      'jenispasien' => $this->ModelJenisPasien->get_data_edit($pasien['jenis_pasien_kode_jenis'])->row_array(),
      'resep'       => $this->ModelObat->get_data(),
      'no_resep'    => $this->ModelResep->generate_no_resep(),
      'periksa'     => $this->ModelPeriksa->get_periksa_pasien($this->uri->segment(3)),
      'obat' => $this->ModelObat->get_data()
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
    $nokun = $data_periksa['kunjungan_no_urutkunjungan'];
    $norm = $data_periksa['no_rm'];

    $detil_resep = $this->db->where_in('resep_no_resep',$no_resep)->get('detail_resep')->result();
    $harga_awal = 0;
    $harga_akhir=0;
    foreach ($detil_resep as $value) {
      $obat = $this->ModelObat->get_data_edit($value->obat_idobat)->row_array();
      $stok_saat_ini = (int)$obat['stok_berjalan']+(int)$value->jumlah;
      $this->db->where('idobat',$value->obat_idobat);
      $this->db->update('obat',array('stok_berjalan'=>$stok_saat_ini));
      $harga_awal+=$value->total_harga;
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
        $harga_akhir+=$total_harga[$i];
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
      $jurnal1 = array(
        'tanggal' => date("Y-m-d"),
        'keterangan' => 'Transaksi nomor kunjungan '.$nokun,
        'norek' => '10701',
        'debet' => 0,
        'kredit' => 0,
        'pasien_noRM' => $norm,
        'no_urut' => $nokun,
        'no_transaksi' => $kode_akun,
        'jam' => date("H:i:S")
      );
      $jurnal2 = array(
        'tanggal' => date("Y-m-d"),
        'keterangan' => 'Transaksi nomor kunjungan '.$nokun,
        'norek' => '10501',
        'debet' => 0,
        'kredit' => 0,
        'pasien_noRM' => $norm,
        'no_urut' => $nokun,
        'no_transaksi' => $kode_akun,
        'jam' => date("H:i:s")
      );

      // if ($harga_awal>$harga_akhir) {
      //   $harga_selisih = $harga_awal-$harga_akhir;
      //   $jurnal1['kredit'] = $harga_selisih;
      //   $jurnal2['debet'] = $harga_selisih;
      // }else{
      //   $harga_selisih = $harga_akhir-$harga_awal;
      //   $jurnal1['debet'] = $harga_selisih;
      //   $jurnal2['kredit'] = $harga_selisih;
      // }
      // $this->db->insert('jurnal',$jurnal1);
      // $this->db->insert('jurnal',$jurnal2);
      if ($status == 1) {
        $this->session->set_flashdata('notif', $this->Notif->berhasil('Berhasil Edit Resep'));
        redirect(base_url()."Periksa/index/".$data_periksa['kunjungan_no_urutkunjungan']);
      } else {
        $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Tersimpan'));
        redirect(base_url()."Periksa/index/".$data_periksa['kunjungan_no_urutkunjungan']);
      }
    } else {
      $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Tersimpan'));
      redirect(base_url()."Periksa/index/".$data_periksa['kunjungan_no_urutkunjungan']);
    }
  }

  public function get_bhp(){
    $japel = $this->input->post("kode");
    $bhp = $this->ModelJasaBHP->get_edit($japel);
    // $jml = count($bhp);
    $html = '';
    if (!empty($bhp)) {
      foreach ($bhp as $value) {
        $data_batch = $this->ModelPeriksa->get_bhp_batch($value->idobat);
        $option = '';
        foreach ($data_batch as $data) {
          $option .= "<option value='".$data->iddetail_pembelian_obat."'>".$data->no_batch."</option>";
        }
        $select = '<select name="id_pengadaan[]" id="select" class="select'.$japel.' mdb-select colorful-select dropdown-info sm-form">'.$option.'</select>';
        $html .= '<tr class="bhp'.$japel.'">
          <td>'.$value->idobat.'/'.$value->nama_obat.'</td>
          <td><input class="form-control" type="number" value="'.$value->jumlah.'"></td>
          <td>'.$select.'</td>
          <td><button type="button" onclick="deleteBhp(this)" class="btn-danger btn btn-circle" data-toggle="tooltip" data-placement="top" data-original-title="Hapus Jasa"><i class="fa fa-trash"></i></button></td>
        </tr>';
      }
    }
    echo $html;
  }



}
