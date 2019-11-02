<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kunjungan extends CI_Controller {
  private $data_kunjungan = array();
  private $pasien ;

  public function __construct()
  {
    parent::__construct();
    $this->load->model('ModelPekerjaan');
    $this->load->model('ModelTujuanPelayanan');
    $this->load->model('ModelTempatTidur');
    $this->load->model('ModelPasien');
    $this->load->model('ModelJenisPasien');
    $this->load->model('ModelAkuntansi');
    $this->data_kunjungan = array(

      'no_urutkunjungan' => $this->input->post('no_urutkunjungan'),
      'tgl' => $this->input->post('tgl'),
      'tupel_kode_tupel' => $this->input->post('tujuan_pelayanan'),
      'jenis_kunjungan' => $this->input->post('jenis_kunjungan'),
      'sumber_dana' => $this->input->post('jenis_pembayaran'),
      'bb' => $this->input->post('bb'),
      'tb' => $this->input->post('tb'),
      'keluhan' => $this->input->post('keluhan'),
      'sudah' => '0',
      'pasien_baru' => $this->input->post('pasien_baru'),
      'kunjungansakit' => $this->input->post('kunjungansakit'),
      'sistole' => $this->input->post('diastole'),
      'diastole' => $this->input->post('diastole'),
      'nadi' => $this->input->post('nadi'),
      'rr' => $this->input->post('rr'),
      'pasien_noRM' => $this->input->post('pasien_noRM'),
      'asal_pasien' => $this->input->post('asal_pasien'),
      'administrasi' => 0

    );

    $this->load->model("ModelTujuanPelayanan");
    $this->load->model("ModelKunjungan");
    $this->load->model("ModelTempatTidur");

  }

	function index()
	{
    $tgl = date('Y-m-d');
    $no_antrian = null;
    if ($this->ModelKunjungan->total("UMU") > 0 ) {
      foreach ($this->ModelKunjungan->max_no("UMU")->result() as $value) {
        $no_antrian = $value->no_antrian;
      }
    } else {
      $no_antrian = 0;
    }
    $data = array(
      'body'            => 'Kunjungan/list',
      'kunjungan'       => $this->ModelKunjungan->get_data($tgl),
      'kunjungan_sudah' => $this->ModelKunjungan->get_data_sudah($tgl),
      'tupel' => $this->ModelTujuanPelayanan->get_data(),
      'no_antrian' => $no_antrian,
    );
		$this->load->view('index',$data);
	}

  function filter_belum()
  {
    $tgl = $this->uri->segment(3);
    $no = 0;
    echo "<table id=\"example_blm\" class=\"datatables table table-striped table-hover table-bordered\">
              <thead>
                  <tr>
                      <th>#</th>
                      <th>NO RM</th>
                      <th>Nama Pasien</th>
                      <th>Tujuan Pelayanan</th>
                      <th>No Antrian</th>
                      <th>Jam Kunjungan</th>
                      <th>Jenis Kunjungan</th>
                      <th>Opsi</th>
                  </tr>
              </thead>
              <tbody >";
    foreach ($this->ModelKunjungan->get_data($tgl) as $value) {
      $no++;
      $id_check = $value->no_urutkunjungan;
      $k = $value->kode_tupel;
      $warna = "badge-primary";
      $type = "IN";
      if ($k == "UMU"){$warna = "badge-success";$type = "U";}elseif ($k == "IGD") {$warna = "badge-danger";$type="IG";}elseif($k == "OBG"){$warna = "badge-info";$type = "O";}elseif ($k == "GIG") {$warna = "badge-warning";$type = "G";}
      if ($value->jenis_kunjungan == 1) {
        $jenis = "Lama";
      } else {
        $jenis = "Baru";
      }


      echo "
      <tr>
          <td>$no</td>
          <td>$value->pasien_noRM</td>
          <td>$value->namapasien</td>
          <td><h4><span class=\"badge badge-pill $warna \">$value->tujuan_pelayanan</span></h4></td>
          <td class=\"text-right\">$type$value->no_antrian</td>
          <td>$value->jam_daftar</td>
          <td>$jenis</td>
          <td>
            <a href='".base_url()."Periksa/index/".$value->no_urutkunjungan."'>
              <button type=\"button\" class=\"btn btn-primary ntn-sm periksa\">
                <i class=\"fa fa-medkit\"></i> Periksa
              </button>
            </a>
            <a href='".base_url()."Kunjungan/delete/".$value->no_urutkunjungan."'>
              <button type=\"button\" class=\"btn btn-danger hapus-kunjungan btn-sm\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"\" data-title=\"Hapus Kunjungan\">
                <i class=\"fa fa-cut\"></i>
              </button>
            </a>
            <a href='".base_url()."Pasien/edit/".$value->pasien_noRM."/".$value->no_urutkunjungan."'>
              <button type=\"button\" class=\"btn btn-warning hapus-kunjungan btn-sm\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"\" data-title=\"Edit Data Pasien\">
                <i class=\"fa fa-edit\"></i>
              </button>
            </a>

          </td>
      </tr>";
    }
    echo "</tbody>
      </table>";
  }

  function filter_sudah()
  {
    $tgl = $this->uri->segment(3);
    $no = 0;
    echo "<table id=\"example_blm\" class=\"datatables table table-striped table-hover table-bordered\">
          <thead>
              <tr>
                  <th>#</th>
                  <th>NO RM</th>
                  <th>Nama Pasien</th>
                  <th>Tujuan Pelayanan</th>
                  <th>No Antrian</th>
                  <th>Jam Kunjungan</th>
                  <th>Jenis Kunjungan</th>
                  <th>Status</th>
                  <th>Opsi</th>
              </tr>
          </thead>
          <tbody>";
    foreach ($this->ModelKunjungan->get_data_sudah($tgl) as $value) {
      $no++;
      $id_check = $value->no_urutkunjungan;
      $k = $value->kode_tupel;
      $warna = "badge-primary";
      $type = "IN";
      if ($k == "UMU"){$warna = "badge-success";$type = "U";}elseif ($k == "IGD") {$warna = "badge-danger";$type="IG";}elseif($k == "OBG"){$warna = "badge-info";$type = "O";}elseif ($k == "GIG") {$warna = "badge-warning";$type = "G";}
      if ($value->jenis_kunjungan == 1) {
        $jenis = "Lama";
      } else {
        $jenis = "Baru";
      }
      if ($value->sudah == 1) {
        $status = "Sudah Diperiksa";
      } elseif ($value->sudah == 2) {
        $status = "Pelayanan TINDAKAN";
      } elseif ($value->sudah == 3) {
        $status = "Permintaan Laborat";
      } elseif ($value->sudah == 4) {
        $status = "Pengambilan Resep";
      } elseif ($value->sudah == 5) {
        $status = "Pasien Pulang";
      }
      if ($value->siap_pulang==0) {
        $pulang = '<a href="'.base_url()."Periksa/pulang/".$value->no_urutkunjungan.'">
          <button type="button" class="btn btn-success periksa">
            <i class="fa fa-home"></i> Siap Pulang
          </button>
        </a>';
      }else{
        $pulang = "";
      }
      echo "
      <tr>
          <td>$no</td>
          <td>$value->pasien_noRM</td>
          <td>$value->namapasien</td>
          <td><h4><span class=\"badge badge-pill $warna \">$value->tujuan_pelayanan</span></h4></td>
          <td class=\"text-right\">$type$value->no_antrian</td>

          <td>$value->jam_daftar</td>
          <td>$jenis</td>
          <td>$status</td>
          <td>
            <a href='".base_url()."Periksa/index/".$value->no_urutkunjungan."'>
              <button type=\"button\" class=\"btn btn-primary btn-sm periksa\">
                <i class=\"fa fa-medkit\"></i> Periksa
              </button>
            </a>
            <a href='".base_url()."Kunjungan/delete/".$value->no_urutkunjungan."'>
              <button type=\"button\" class=\"btn btn-danger hapus-kunjungan btn-sm\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"\" data-title=\"Hapus Kunjungan\">
                <i class=\"fa fa-cut\"></i>
              </button>
            </a>
            <a href='".base_url()."Pasien/edit/".$value->pasien_noRM."/".$value->no_urutkunjungan."'>
              <button type=\"button\" class=\"btn btn-warning hapus-kunjungan btn-sm\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"\" data-title=\"Edit Data Pasien\">
                <i class=\"fa fa-edit\"></i>
              </button>
            </a>
            ".$pulang."
          </td>
      </tr>";
    }
    echo "</tbody>
      </table>";
  }

  function tgl()
  {
    echo date('Y-m-d');
  }

  function no_urut(){
      $tupel = $this->uri->segment(3);
      $no_antrian = null;
      if ($this->ModelKunjungan->total($tupel) > 0 ) {
          foreach ($this->ModelKunjungan->max_no($tupel)->result() as $value) {
              $no_antrian = $value->no_antrian;
          }
      } else {
          $no_antrian = 0;
      }
      echo $no_antrian;
  }

    function input()
   {
     $tupel = $this->input->post('tujuan_pelayanan');
     $no_antrian = null;
     if ($this->ModelKunjungan->total("UMU") > 0 ) {
       foreach ($this->ModelKunjungan->max_no("UMU")->result() as $value) {
         $no_antrian = $value->no_antrian;
       }
     } else {
       $no_antrian = 0;
     }

    $data = array(
      'form' => 'Kunjungan/form',
      'body' => 'Kunjungan/input',
      'tupel' => $this->ModelTujuanPelayanan->get_data(),
      'tempat_tidur' => $this->ModelTempatTidur->get_data(),
      'pasien' => $this->ModelPasien->get_data(),
      'no_antrian' => $no_antrian,
      'jenis_pasien' => $this->ModelJenisPasien->get_data(),
      'noRM' => $this->ModelPasien->generete_noRM(),
      'list_pekerjaan' => $this->ModelPekerjaan->get_data(),
    );
		$this->load->view('index',$data);
  }

  public function hitung_riwayat($noRM)
  {
    $hitung_riwayat = $this->ModelKunjungan->riwayat($noRM)->num_rows();
    echo $hitung_riwayat;
  }

  public function insert()
  {
    $tupel = $this->input->post('tujuan_pelayanan');
    $no_antrian = null;
    if ($this->ModelKunjungan->total($tupel) > 0 ) {
      foreach ($this->ModelKunjungan->max_no($tupel)->result() as $value) {
        $no_antrian = $value->no_antrian + 1;
      }
    } else {
      $no_antrian = 1;
    }
    $this->data_kunjungan['NIK'] = $_SESSION['nik'];
    $this->data_kunjungan['jam_daftar'] = date('H:i:s');
    $this->data_kunjungan['no_antrian'] = $no_antrian;
    $pasien = $this->ModelPasien->get_data_edit($this->data_kunjungan['pasien_noRM'])->row_array();
    if ($pasien['tgl_daftar']==date("Y-m-d")) {
      $this->data_kunjungan['administrasi'] =1;
    }
    if ($this->db->insert('kunjungan', $this->data_kunjungan)) {
      $this->db->reset_query();
      $hari_ini = date("Y-m-d");
      $this->db->where('noRM',$this->data_kunjungan['pasien_noRM']);
      $this->db->update('pasien',array('kunjungan_terakhir'=>$hari_ini));
      $this->load->view("vendor/autoload.php");
      $options = array(
        'cluster' => 'ap1',
        'useTLS' => true
      );
      $pusher = new Pusher\Pusher(
        '58f10ec738925cc9cf18',
        '989571a4920f2374328e',
        '627660',
        $options
      );
      $pasien = $this->ModelPasien->get_data_edit($this->data_kunjungan['pasien_noRM'])->row_array();
      $no_kunjungan = $this->db->select_max('no_urutkunjungan')->get('kunjungan')->row_array();
      $tujuan_pelayanan = $this->ModelTujuanPelayanan->get_data_edit($tupel)->row_array();
      $this->data_kunjungan['nama'] = $pasien['namapasien'];
      $this->data_kunjungan['tujuan_pelayanan'] = $tujuan_pelayanan['tujuan_pelayanan'];
      $this->data_kunjungan['url'] = base_url()."Periksa/index/".$no_kunjungan['no_urutkunjungan'];
      $pusher->trigger('ci_pusher', 'my-event',$this->data_kunjungan);
      $this->session->set_flashdata('notif', $this->Notif->berhasil('Berhasil Tersimpan'));

      redirect(base_url().'Kunjungan');
    } else {
      echo "salah";
    }


  }
  public function ganti_tupel()
  {
    $tupel = $this->input->post('tupel');
    $nokun = $this->input->post("nokun");
    $no_rm = $this->input->post("no_rm");
    $no_antrian = null;
    if ($this->ModelKunjungan->total($tupel) > 0 ) {
      foreach ($this->ModelKunjungan->max_no($tupel)->result() as $value) {
        $no_antrian = $value->no_antrian + 1;
      }
    } else {
      $no_antrian = 1;
    }
    // $data_update['NIK'] = $_SESSION['nik'];
    // $data_update['jam_daftar'] = date('H:i:s');
    $data_update['no_antrian'] = $no_antrian;
    $data_update['tupel_kode_tupel'] = $tupel;
    $this->db->where('no_urutkunjungan',$nokun);
    if ($this->db->update('kunjungan', $data_update)) {
      // $this->db->where('noRM',$data_kunjungan['pasien_noRM']);
      // $this->db->update('pasien',array('kunjungan_terakhir'=>date("Y-m-d")));
      $this->load->view("vendor/autoload.php");
      $options = array(
        'cluster' => 'ap1',
        'useTLS' => true
      );
      $pusher = new Pusher\Pusher(
        '58f10ec738925cc9cf18',
        '989571a4920f2374328e',
        '627660',
        $options
      );
      $pasien = $this->ModelPasien->get_data_edit($no_rm)->row_array();
      // die(var_dump($pasien));
      $no_kunjungan = $this->db->where('no_urutkunjungan',$nokun)->get('kunjungan')->row_array();
      $tujuan_pelayanan = $this->ModelTujuanPelayanan->get_data_edit($tupel)->row_array();
      $data_update['nama'] = $pasien['namapasien'];
      $data_update['pasien_noRM'] = $no_rm;
      $data_update['jenis_kunjungan'] = $no_kunjungan['jenis_kunjungan'];
      $data_update['jam_daftar'] = $no_kunjungan['jam_daftar'];
      $data_update['tujuan_pelayanan'] = $tujuan_pelayanan['tujuan_pelayanan'];
      $data_update['url'] = base_url()."Periksa/index/".$no_kunjungan['no_urutkunjungan'];
      $pusher->trigger('ci_pusher', 'my-event',$data_update);
      $this->session->set_flashdata('notif', $this->Notif->berhasil('Berhasil Tersimpan'));
      redirect(base_url().'Kunjungan');
    } else {
      echo "salah";
    }


  }
  public function edit()
  {
    $id = $this->uri->segment(3);
    $data = array(
      'form' => 'Kunjungan/form',
      'body' => 'Kunjungan/edit',
     // 'jenis_pasien' => $this->ModelJenisPasien->get_data(),
     // 'pasien' => $this->ModelPasien->get_data_edit($noRM)->row_array(),
     'tupel' => $this->ModelTujuanPelayanan->get_data(),
     'tempat_tidur' => $this->ModelTempatTidur->get_data(),
     'kunjungan' => $this->ModelKunjungan->get_data_edit($id)

     );
    $this->load->view('index', $data);
  }

  public function update()
  {
    $nik = $this->input->post('no_urutkunjungan_id');
    $this->db->where('no_urutkunjungan',$no_urutkunjungan);
    if ($this->db->update('kunjungan', $this->data_kunjungan)) {
      // code...
    } else {
      // code...
    }

  }

  function delete()
  {
    $no_urutkunjungan = $this->uri->segment(3);
    $kunjungan = $this->db->where('no_urutkunjungan', $no_urutkunjungan)->get('kunjungan')->row_array();
    if ($kunjungan['sudah']>=1) {
      $this->session->set_flashdata('notif', $this->Notif->gagal('Tidak dapat menghapus data kunjungan ini'));
    }else{
      $this->db->where_in('no_urutkunjungan', $no_urutkunjungan);
      $delete = $this->db->delete('kunjungan');
      if ($delete == true) {
          $this->session->set_flashdata('notif', $this->Notif->berhasil('Berhasil Hapus Data Kunjungan'));
      }else{
          $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Hapus Data Kunjungan, Pasien Sudah Di Periksa!!!'));
      };
    }
    redirect(base_url().'Kunjungan');

  }


  function get_data_pasien()
  {
  $list = $this->ModelPasien->get_datatables();
  $data = array();
  $no = $_POST['start'];
  foreach ($list as $field) {
      $no++;
      $row = array();
      $row[] = $no;
      $row[] = $field->noRM;
      $row[] = $field->namapasien;
      $row[] = $field->jenis_kelamin;
      $row[] = $field->umur;
      $row[] = $field->alamat;
      $row[] = "<button data-dismiss=\"modal\" onclick=\"pilih_pasien('$field->noRM', '$field->namapasien', '$field->alamat','$field->jenis_pasien_kode_jenis')\" type=\"button\" class=\"btn btn-circle btn-warning\" data-toggle=\"tooltip\" data-placement=\"top\" data-original-title=\"Pilih\">
                  <i class=\"fa fa-edit\"></i>
                </button>";

      $data[] = $row;
  }

  $output = array(
      "draw" => $_POST['draw'],
      "recordsTotal" => $this->ModelPasien->count_all(),
      "recordsFiltered" => $this->ModelPasien->count_filtered(),
      "data" => $data,
  );
  //output dalam format JSON
  echo json_encode($output);
  }

}

?>
