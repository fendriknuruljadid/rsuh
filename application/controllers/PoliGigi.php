<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class PoliGigi extends CI_Controller{
    public function __construct()
    {
      parent::__construct();
      // $this->load->library(array('ion_auth', 'form_validation'));
      $this->load->helper(array('url', 'language'));
      // $this->load->model('ModelPoliGigi');
      $this->load->model('ModelJenisPasien');
      $this->load->model('ModelPasien');
      $this->load->model('ModelPeriksa');
      $this->load->model('ModelKunjungan');
    }

    function input()
    {
      $kunjungan = $this->ModelKunjungan->get_data_edit($this->uri->segment(3));
      $pasien = $this->ModelPasien->get_data_edit($kunjungan['pasien_noRM'])->row_array();

      $data=array(
        'body' => 'Periksa/poli/gigi',
        'idkunjungan' => $this->uri->segment(3),
        'pasien'      => $this->ModelPasien->get_data_edit($kunjungan['pasien_noRM'])->row_array(),
        'jenispasien' => $this->ModelJenisPasien->get_data_edit($pasien['jenis_pasien_kode_jenis'])->row_array(),
        'periksa'     => $this->ModelPeriksa->get_periksa_pasien($this->uri->segment(3))
      );
      $this->load->view('index',$data);
    }

    function insert(){
      $periksa = array(
        'kunjungan_no_urutkunjungan' => $this->input->post('nokun'),
        'tanggal' => date('Y-m-d'),
        'no_rm'   => $this->input->post('no_rm'),
        'gigi_11' => $this->input->post('gigi_11'),
        'gigi_12' => $this->input->post('gigi_12'),
        'gigi_13' => $this->input->post('gigi_13'),
        'gigi_14' => $this->input->post('gigi_14'),
        'gigi_15' => $this->input->post('gigi_15'),
        'gigi_16' => $this->input->post('gigi_16'),
        'gigi_17' => $this->input->post('gigi_17'),
        'gigi_18' => $this->input->post('gigi_18'),
        'gigi_21' => $this->input->post('gigi_21'),
        'gigi_22' => $this->input->post('gigi_22'),
        'gigi_23' => $this->input->post('gigi_23'),
        'gigi_24' => $this->input->post('gigi_24'),
        'gigi_25' => $this->input->post('gigi_25'),
        'gigi_26' => $this->input->post('gigi_26'),
        'gigi_27' => $this->input->post('gigi_27'),
        'gigi_28' => $this->input->post('gigi_28'),
        'gigi_31' => $this->input->post('gigi_31'),
        'gigi_32' => $this->input->post('gigi_32'),
        'gigi_33' => $this->input->post('gigi_33'),
        'gigi_34' => $this->input->post('gigi_34'),
        'gigi_35' => $this->input->post('gigi_35'),
        'gigi_36' => $this->input->post('gigi_36'),
        'gigi_37' => $this->input->post('gigi_37'),
        'gigi_38' => $this->input->post('gigi_38'),
        'gigi_41' => $this->input->post('gigi_41'),
        'gigi_42' => $this->input->post('gigi_42'),
        'gigi_43' => $this->input->post('gigi_43'),
        'gigi_44' => $this->input->post('gigi_44'),
        'gigi_45' => $this->input->post('gigi_45'),
        'gigi_46' => $this->input->post('gigi_46'),
        'gigi_47' => $this->input->post('gigi_47'),
        'gigi_48' => $this->input->post('gigi_48'),
        'gigi_51' => $this->input->post('gigi_51'),
        'gigi_52' => $this->input->post('gigi_52'),
        'gigi_53' => $this->input->post('gigi_53'),
        'gigi_54' => $this->input->post('gigi_54'),
        'gigi_55' => $this->input->post('gigi_55'),
        'gigi_61' => $this->input->post('gigi_61'),
        'gigi_62' => $this->input->post('gigi_62'),
        'gigi_63' => $this->input->post('gigi_63'),
        'gigi_64' => $this->input->post('gigi_64'),
        'gigi_65' => $this->input->post('gigi_65'),
        'gigi_71' => $this->input->post('gigi_71'),
        'gigi_72' => $this->input->post('gigi_72'),
        'gigi_73' => $this->input->post('gigi_73'),
        'gigi_74' => $this->input->post('gigi_74'),
        'gigi_75' => $this->input->post('gigi_75'),
        'gigi_81' => $this->input->post('gigi_81'),
        'gigi_82' => $this->input->post('gigi_82'),
        'gigi_83' => $this->input->post('gigi_83'),
        'gigi_84' => $this->input->post('gigi_84'),
        'gigi_85' => $this->input->post('gigi_85'),
        'occulasi' => $this->input->post('occulasi'),
        'torus_palatinus' => $this->input->post('torus_palatinus'),
        'torus_mandibularis' => $this->input->post('torus_mandibularis'),
        'palatum' => $this->input->post('palatum'),
        'diastema' => $this->input->post('diastema'),
        'gigi_anomali' => $this->input->post('anomali'),
        'lain_lain' => $this->input->post('lain_lain'),
        'D' => $this->input->post('D'),
        'M' => $this->input->post('M'),
        'F' => $this->input->post('F'),
        'photo' => $this->input->post('jumlah_photo'),
        'rontgen' => $this->input->post('jumlah_rontgen'),
        'jenis_photo' => $this->input->post('jenis_photo'),
        'jenis_rontgen' => $this->input->post('jenis_rontgen'),
        'operator' => $_SESSION['nik']
      );
      if ($periksa['diastema'=='Ada']) {
        $periksa['diastema'] = 'Ada , '.$this->input->post('ada_diastema');
      }
      if ($periksa['gigi_anomali'=='Ada']) {
        $periksa['gigi_anomali'] = 'Ada , '.$this->input->post('ada_anomali');
      }
      if ($this->db->insert('periksa',$periksa)) {
        $this->db->reset_query();
        $this->db->where('no_urutkunjungan', $this->input->post('nokun'));
        $this->db->update('kunjungan',array('sudah' => '1', ));
        $this->session->set_flashdata('alert', $this->Core->alert_succcess('Berhasil Tersimpan'));
        redirect("Periksa/index/".$periksa['kunjungan_no_urutkunjungan']);
      }else{
        $this->session->set_flashdata('alert', $this->Core->alert_danger('Gagal Tersimpan'));
        redirect("Periksa/index/".$periksa['kunjungan_no_urutkunjungan']);
      }

    }
  }
?>
