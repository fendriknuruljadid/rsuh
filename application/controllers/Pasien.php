<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pasien extends CI_Controller {
  private $data_pasien = array();
  private $jenis_pasien;
  public function __construct()
  {
    parent::__construct();
    $this->load->model('ModelPekerjaan');
    $this->load->model('ModelJenisPasien');
    $this->load->model('ModelPasien');
    $this->load->library('upload');
    $this->load->library('ciqrcode');
    $this->load->model('CoreUploadFoto');
    $this->jenis_kelamin = $this->input->post('jenis_kelamin');
    $this->data_pasien = array(
      'noRM' => $this->input->post('noRM'),
      'noBPJS' => $this->input->post('noBPJS'),
      'noAsuransiLain' => $this->input->post('noAsuransiLain'),
      'namapasien' => strtoupper($this->input->post('namapasien')),
      'tgl_lahir' => $this->input->post('tgl_lahir'),
      'jenis_kelamin' => $this->jenis_kelamin,
      'agama' => $this->input->post('agama'),
      'suku' => $this->input->post('suku'),
      'alamat' => strtoupper($this->input->post('alamat')),
      'kota' => $this->input->post('kota'),
      'telepon' => $this->input->post('telepon'),
      'pekerjaan' => $this->input->post('pekerjaan'),
      'tgl_daftar' => $this->input->post('tgl_daftar'),
      'email' => $this->input->post('email'),
      'tgl_masuk' => $this->input->post('tgl_masuk'),
      'kunjungan_terakhir' => $this->input->post('kunjungan_terakhir'),
      'jenis_pasien_kode_jenis' => $this->input->post('jenis_pasien'),
      'suami_istri' => strtoupper($this->input->post('suami_istri')),
      'orangtua' => strtoupper($this->input->post('orangtua')),
      'provinsi' => $this->input->post('provinsi')
    );
  }

	public function index()
	{
    $data = array(
      'body' => 'Pasien/list',
      'data_pasien' => $this->ModelPasien->get_data()
    );
		$this->load->view('index',$data);
	}

  public function input(){
    $data = array(
      'form' => 'Pasien/form2',
      'body' => 'Pasien/input',
      'jenis_pasien' => $this->ModelJenisPasien->get_data(),
      'noRM' => $this->ModelPasien->generete_noRM(),
      'list_pekerjaan' => $this->ModelPekerjaan->get_data()
    );
		$this->load->view('index',$data);
  }
  public function input2(){
    $data = array(
      'form' => 'Pasien/form2',
      'body' => 'Pasien/input',
      'jenis_pasien' => $this->ModelJenisPasien->get_data(),
      'noRM' => $this->ModelPasien->generete_noRM(),
      'list_pekerjaan' => $this->ModelPekerjaan->get_data()
    );
		$this->load->view('index',$data);
  }
  public function test()
  {
    echo $this->input->post('suku');
  }
  public function insert(){
    $hitung = $this->db->get_where("pasien",array("namapasien"=>$this->input->post('namapasien'),'tgl_lahir'=>$this->input->post("tgl_lahir")))->num_rows();
    if ($hitung > 0) {
      $this->session->set_flashdata('notif', $this->Notif->gagal('Tidak dapat membuat no rm baru,data pasien telah ada!!!'));
      redirect(base_url().'Pasien');
    }else{


    if ($this->input->post("tinggal_dengan")!='lain') {
      $tinggal_dengan = $this->input->post("tinggal_dengan");
    }else{
      $tinggal_dengan = $this->input->post("tinggal_dengan_lain");
    }
    $noRM = $this->input->post('noRM');
    $data_pasien = array(
      'provinsi' => $this->input->post('provinsi'),
      'tinggal_dengan' => $tinggal_dengan,
      'status_kawin' => $this->input->post('perkawinan') ,
      'noRM' => $this->ModelPasien->generete_noRM(),
      'noBPJS' => $this->input->post('noBPJS'),
      'noAsuransiLain' => $this->input->post('noAsuransiLain'),
      'namapasien' => strtoupper($this->input->post('namapasien')),
      'tgl_lahir' => $this->input->post('tgl_lahir'),
      'jenis_kelamin' => $this->jenis_kelamin,
      'agama' => $this->input->post('agama'),
      'suku' => $this->input->post('suku'),
      'alamat' => strtoupper($this->input->post('alamat')),
      'kota' => $this->input->post('kota'),
      'telepon' => $this->input->post('telepon'),
      'pekerjaan' => $this->input->post('pekerjaan'),
      'tgl_daftar' => $this->input->post('tgl_daftar'),
      'email' => $this->input->post('email'),
      'tgl_masuk' => $this->input->post('tgl_masuk'),
      'kunjungan_terakhir' => date("Y-m-d"),
      'jenis_pasien_kode_jenis' => $this->input->post('jenis_pasien'),
      'suami_istri' => strtoupper($this->input->post('suami_istri')),
      'orangtua' => strtoupper($this->input->post('orangtua'))
    );
    $insert_data = $this->db->insert('pasien',$data_pasien);
    if ($insert_data) {
      $path = "./foto/foto_pasien/";
      $config['cacheable']    = true; //boolean, the default is true
      $config['cachedir']     = './foto/qrcode_rm'; //string, the default is application/cache/
      $config['errorlog']     = './foto/qrcode_rm'; //string, the default is application/logs/
      $config['imagedir']     = './foto/qrcode_rm/'; //direktori penyimpanan qr code
      $config['quality']      = true; //boolean, the default is true
      $config['size']         = '1024'; //interger, the default is 1024
      $config['black']        = array(224,255,255); // array, default is array(255,255,255)
      $config['white']        = array(70,130,180); // array, default is array(0,0,0)
      $this->ciqrcode->initialize($config);
      $image_name=$noRM.'.png'; //buat name dari qr code sesuai dengan nim
      $params['data'] = $noRM; //data yang akan di jadikan QR CODE
      $params['level'] = 'H'; //H=High
      $params['size'] = 10;
      $params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
      $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
      if ($this->CoreUploadFoto->upload_foto($path)) {
        $data = array(
            'foto' => $this->CoreUploadFoto->get_nama_foto(),
            'qrcode' => $image_name,
        );
      }else{
        if ($this->jenis_kelamin=="L") {
          $data = array(
              'foto' => "default_l.png",
              'qrcode' => $image_name
          );
        }else{
          $data = array(
              'foto' => "default_p.png",
              'qrcode' => $image_name
          );
        }
      }
      $this->db->where('noRM',$noRM);
      $this->db->update('pasien',$data);
      redirect(base_url().'Kunjungan/input/'.$noRM);
    }else {
      redirect(base_url().'Pasien');
    }
    }
  }

  public function edit()
  {
    $noRM = $this->uri->segment(3);
    $data = array(
      'form' => 'Pasien/form_edit',
      'body' => 'Pasien/edit',
      'jenis_pasien' => $this->ModelJenisPasien->get_data(),
      'pasien' => $this->ModelPasien->get_data_edit($noRM)->row_array(),
      'list_pekerjaan' => $this->ModelPasien->list_pekerjaan()
     );
    $this->load->view('index', $data);
  }

  public function update()
  {
    if ($this->input->post("tinggal_dengan")!='lain') {
      $tinggal_dengan = $this->input->post("tinggal_dengan");
    }else{
      $tinggal_dengan = $this->input->post("tinggal_dengan_lain");
    }
    $this->data_pasien['tinggal_dengan'] = $tinggal_dengan;
    $this->data_pasien['status_kawin'] = $this->input->post("perkawinan");
    $noRM = $this->input->post('noRM');
    $data_edit = $this->ModelPasien->get_data_edit($noRM)->row_array();
    if (isset($_POST['simpan_data'])){
      if ($data_edit['jenis_kelamin']==$this->jenis_pasien) {
        $this->db->where('noRM',$noRM);
        $update_data = $this->db->update('pasien', $this->data_pasien);
        if ($update_data) {
          redirect(base_url().'Pasien');
        }
      }else{
        if ($data_edit['foto']=="default_l.png" || $data_edit['foto']=="default_p.png" ) {
          if ($this->jenis_kelamin=="L") {
            $data = array(
                'foto' => "default_l.png",
            );
          }else{
            $data = array(
                'foto' => "default_p.png",
            );
          }
          $this->db->where('noRM',$noRM);
          $this->db->update('pasien',$data);
          $this->db->where('noRM',$noRM);
          $update_data = $this->db->update('pasien', $this->data_pasien);
          $this->session->set_flashdata('alert', $this->Core->alert_succcess('Berhasil Update Data Pasien'));
          redirect(base_url().'Pasien');
        }else{
          $this->db->where('noRM',$noRM);
          $update_data = $this->db->update('pasien', $this->data_pasien);
          if ($update_data) {
            $this->session->set_flashdata('alert', $this->Core->alert_succcess('Berhasil Update Data Pasien'));
            redirect(base_url().'Pasien');
          }
        }
      }
    }else{
      if (empty($_FILES['filefoto']['name'])) {
          $this->session->set_flashdata('alert', $this->Core->alert_danger('Gagal,Harap Pilih Foto Pasien!!!!'));
          redirect(base_url().'Pasien/edit/'.$noRM);
      }else{
        $path = "./foto/foto_pasien/";
        if (!$data_edit['foto']=="default_l.png" || !$data_edit['foto']=="default_p.png") {
          unlink($path.$data_edit['foto']);
        }
        $this->CoreUploadFoto->upload_foto($path);
        $data = array(
            'foto' => $this->CoreUploadFoto->get_nama_foto(),
        );
        $this->db->where('noRM',$noRM);
        $this->db->update('pasien',$data);
        $this->session->set_flashdata('alert', $this->Core->alert_succcess('Berhasil Update Foto Pasien'));
        redirect(base_url().'Pasien/edit/'.$noRM);
      }
    }

  }


  public function delete()
  {
    $id = $this->input->post('id');
    $path = "./foto/foto_pasien/";
    $cek_data = $this->db->where_in('pasien_noRM',$id)->get('kunjungan')->num_rows();
    if ($cek_data>0) {
      $this->session->set_flashdata('alert', $this->Core->alert_danger('Gagal Hapus Data Pasien,Data Master Masih Digunakan!!!!'));
      redirect(base_url()."Pasien");
    }else{
      foreach ($id as $value) {
        $data = $this->ModelPasien->get_data_edit($value)->row_array();
        if (!$data['foto']=="default_l.png" || !$data['foto']=="default_p.png") {
          unlink($path.$data['foto']);
        }
      }
      $this->db->where_in('noRM', $id);
      $delete = $this->db->delete('pasien');
      if ($delete) {
        $this->session->set_flashdata('alert', $this->Core->alert_succcess('Berhasil Hapus Data Pasien'));
      }else{
        $this->session->set_flashdata('alert', $this->Core->alert_danger('Gagal Hapus Data Pasien'));
      };
      redirect(base_url().'Pasien');
    }
  }
  public function cek_nobpjs(){
    $noBPJS = $this->input->post("noBPJS");
    if ($this->ModelPasien->cek_nobpjs($noBPJS)>0) {
      $res = array(
        'status' => '1',
        'message' => "no BPJS telah terdaftar!!"
      );
    }else{
      $res = array(
        'status' => '0',
      );
    }
    echo json_encode($res);
  }

  function get_data_pasien()
{
  $list = $this->ModelPasien->get_datatables();
  $data = array();
  $no = $_POST['start'];
  foreach ($list as $field) {
      $no++;
      $row = array();
      // $row[] = $this->ModelPasien->no($field->noRM, $no);
      $row[] = $field->noRM;
      $row[] = $field->namapasien;
      $row[] = $field->jenis_kelamin;
      $row[] = $this->ModelPasien->umur($field->tgl_lahir);
      $row[] = $field->alamat.", ".$field->kota.", ".$field->provinsi;
      $row[] = date("d-m-Y",strtotime($field->kunjungan_terakhir));
      $row[] = $this->ModelPasien->edit($field->noRM);

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

  function searchrm()
  {
    $pasien = $this->ModelPasien->get_data_edit($this->uri->segment(3))->row_array();
    $jml = $this->ModelPasien->get_data_edit($this->uri->segment(3))->num_rows();
    if ($jml == 0) {
      echo $jml;
    }else {
      echo $pasien['namapasien'];
    }

  }

  function searchrma()
  {
    $pasien = $this->ModelPasien->get_data_edit($this->uri->segment(3))->row_array();
    if ($pasien['namapasien'] == null || $pasien['namapasien'] == "") {
      echo "PASIEN TIDAK DITEMUKAN";
    } else {
      echo $pasien['alamat'];
    }
  }

  public function cetak_kartu(){
    $noRM = $this->uri->segment(3);
    $data_edit = $this->ModelPasien->get_data_edit($noRM)->row_array();
    if($data_edit['qrcode']==null){
      $config['cacheable']    = true; //boolean, the default is true
      $config['cachedir']     = './foto/qrcode_rm'; //string, the default is application/cache/
      $config['errorlog']     = './foto/qrcode_rm'; //string, the default is application/logs/
      $config['imagedir']     = './foto/qrcode_rm/'; //direktori penyimpanan qr code
      $config['quality']      = true; //boolean, the default is true
      $config['size']         = '1024'; //interger, the default is 1024
      $config['black']        = array(224,255,255); // array, default is array(255,255,255)
      $config['white']        = array(70,130,180); // array, default is array(0,0,0)
      $this->ciqrcode->initialize($config);
      $image_name=$noRM.'.png'; //buat name dari qr code sesuai dengan nim
      $params['data'] = $noRM; //data yang akan di jadikan QR CODE
      $params['level'] = 'H'; //H=High
      $params['size'] = 10;
      $params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
      $this->ciqrcode->generate($params);
      $this->db->where('noRM',$noRM);
      $this->db->update('pasien',array('qrcode'=>$image_name));
    }
    $data = array(
      'data_pasien' => $this->ModelPasien->get_data_edit($noRM)->row_array(),
     );
    $this->load->view('Pasien/cetak_kartu',$data);
  }

  function insert_riwayatobgyn()
  {
    $dataobgyn = array(
      'tahunpartus'       => $this->input->post('thnpartus'),
      'tempatpartus'      => $this->input->post('tempatpartus'),
      'umurhamil'         => $this->input->post('umur'),
      'jenispersalinan'   => $this->input->post('jenis_persalinan'),
      'penolong'          => $this->input->post('penolong'),
      'penyulit'          => $this->input->post('penyulit'),
      'jk'                => $this->input->post('jk'),
      'bb'                => $this->input->post('bb'),
      'hm'                => $this->input->post('hm'),
      'pasien_noRM'       => $this->input->post('norm'),
      'opr'               => $_SESSION['nik'],
      'tanggal'           => date('Y-m-d H:i:s')
     );
     $this->db->insert('riwayat_obgyn', $dataobgyn);
     $this->session->set_flashdata("notif",$this->Notif->berhasil("Riwayat Telah Ditambahkan"));
     redirect(base_url().'Asesmen/input/'.$this->input->post('nokun')."/".$this->input->post('norm'));
  }
}
