<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class KunjunganLab extends CI_Controller{

    public function __construct()
    {
      parent::__construct();
      //Codeigniter : Write Less Do More
      $this->load->model("ModelKunjunganLab");
      $this->load->model("ModelPasien");
      $this->load->model("ModelLaborat");
    }

    function index()
    {
      $tgl = date('Y-m-d');
      $data = array(
        'body'        => 'KunjunganLab/index',
        'permintaan'  => $this->ModelKunjunganLab->list_permintaan($tgl)->result()
      );
      $this->load->view('index',$data);
    }

    function filter()
    {
      $tgl = $this->uri->segment(3);
      $no = 0;

      foreach ($this->ModelKunjunganLab->list_permintaan($tgl)->result() as $value) {
        $no++;
        $id_check = $value->no_urutkunjungan;
        $k = $value->kode_tupel;
        $warna = "badge-primary";
        if ($k == "UMU"){$warna = "badge-success";}elseif($k == "IGD"){$warna = "badge-danger";}elseif($k == "OBG"){$warna = "badge-info";}elseif ($k == "GIG") {$warna = "badge-warning";}
        if ($value->jenis_kunjungan == 1) {
          $jenis = "Baru";
        } else {
          $jenis = "Lama";
        }
        if ($value->status==1) {
          $sts_input = '<span class="badge badge-pill badge-danger">Belum Input</span>';
        }else{
          $sts_input = '<span class="badge badge-pill badge-success">Sudah Input</span>';
        }
        if ($value->billing != 1 ) {
          $status = '<span class="badge badge-pill badge-danger">Belum Billing</span>';
        }else{
          $status = '<span class="badge badge-pill badge-success">Sudah Billing</span>';
        }
        $button_edit = '';
        if ($value->billing != 1 ) {
          if ($value->status == 1) {
            $button_edit = '<a href="'.base_url().'KunjunganLab/periksa/'.$value->no_urutkunjungan.'/'.$value->nokunjlab.'">
              <button type="button" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Analisa">
                <i class="fa fa-flask"></i> Analisa
              </button>
            </a>';
          }else{
            $button_edit = '<a href="'.base_url().'KunjunganLab/edit/'.$value->no_urutkunjungan.'/'.$value->nokunjlab.'">
              <button type="button" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Analisa">
                <i class="fa fa-edit"></i> Edit
              </button>
            </a>';
          }
        }else{
          if ($value->status==1) {
            $button_edit .= '<a href="'.base_url().'KunjunganLab/periksa/'.$value->no_urutkunjungan.'/'.$value->nokunjlab.'">
              <button type="button" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Analisa">
                <i class="fa fa-flask"></i> Analisa
              </button>
            </a>';
          }
        }
        $button_edit .= '<a href="'.base_url().'KunjunganLab/cetak_hasil/'.$value->no_urutkunjungan.'/'.$value->nokunjlab.'" target="_blank">
          <button type="button" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Cetak Hasil">
            <i class="fa fa-print"></i>
          </button>
        </a>';

        echo "
        <tr>
            <td>$no</td>
            <td>$value->pasien_noRM</td>
            <td>$value->namapasien</td>
            <td><h4><span class=\"badge badge-pill $warna \">$value->tujuan_pelayanan</span></h4></td>
            <td>".date("H:i:s",strtotime($value->jam))."</td>
            <td>".$sts_input."</td>
            <td>".$status."</td>
            <td>".$button_edit."
            </td>
        </tr>";
      }
    }

    function periksa()
    {
      $id     = $this->uri->segment(3);
      $nokun  = $this->uri->segment(4);
      $data = array(
        'body'        => 'KunjunganLab/periksa',
        'kunjungan'   => $this->ModelKunjunganLab->data_kunjungan_lab($nokun)->row_array(),
        'lab'         => $this->ModelKunjunganLab->periksa_lab($nokun)->result()
      );
      $this->load->view('index',$data);
    }

    function edit()
    {
      $id     = $this->uri->segment(3);
      $nokun  = $this->uri->segment(4);
      $data = array(
        'body'        => 'KunjunganLab/edit',
        'kunjungan'   => $this->ModelKunjunganLab->data_kunjungan_lab($nokun)->row_array(),
        'lab'         => $this->ModelKunjunganLab->periksa_lab($nokun)->result()
      );
      $this->load->view('index',$data);
    }


    function input_labkun()
    {
        $idlab        = $this->input->post('idlab');
        $id           = $this->input->post('id');
        $harga        = $this->input->post('hrg');
        $nilai_normal = $this->input->post('nilai_normal');
        $hasil        = $this->input->post('hasil');
        $analis  = $_SESSION['karyawan'];
        $nik = $this->input->post("nik");
        $count = count($id);
        $status = 0;
        for ($i=0; $i < $count; $i++) {
          $data = array(
            'hasil'         => $hasil[$i],
            'nilainormal'   => $nilai_normal[$i],
            'opr'           => $_SESSION['nik'],
            'jam'           => date('H:i:s'),
            'harga'         => $harga[$i],
            'komisi'        => $harga[$i]
          );
          $this->db->where('iddetaillab', $id[$i]);
          $insert = $this->db->update('detaillab', $data);
          $this->db->reset_query();
          if ($insert == true) {
            $status = 1;
          }else {
            $status = 0;
          }
        }
        if ($status == 1) {
          $this->db->where('nokunjlab', $idlab);
          $this->db->update('labkunjungan', array('status' => 2,'lab_out'=>date("Y-m-d h:i:s"),'analis' => $_SESSION['nik']));

          $this->session->set_flashdata('notif', $this->Notif->berhasil('Berhasil Tersimpan'));
          redirect(base_url()."KunjunganLab");
        } else {
          $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Tersimpan'));
          redirect(base_url()."KunjunganLab");
        }
    }
    public function cetak_hasil()
    {
      $id = $this->uri->segment(4);
      $data = array(
        'hasil_lab' => $this->ModelKunjunganLab->periksa_lab($id)->result(),
        'data_lab' => $this->ModelKunjunganLab->data_kunjungan_lab($id)->row_array(),
        'data_lab_2' => $this->ModelKunjunganLab->data_kunjungan_lab_2($id)->row_array(),

        // 'data_pasien' => $this->ModelKunjunganLab->get_data_pasien($id)
      );
      // die(print_r($data));
      $this->load->view('KunjunganLab/hasil2',$data);
    }
    public function hapus($id1=null,$id2=null,$idlab=null,$url){
      $nourut = $this->db->get_where("detaillab",array("iddetaillab"=>$idlab))->row_array();
      $this->db->where("iddetaillab",$idlab);
      $this->db->delete("detaillab");
      $nums = $this->db->get_where("detaillab",array("nourutlab"=>$nourut['nourutlab']))->num_rows();
      if ($nums==0) {
        $this->db->where("nokunjlab",$nourut['nourutlab']);
        $this->db->delete("labkunjungan");
        $this->session->set_flashdata("notif",$this->Notif->berhasil("Berhasil Menghapus Data"));
        redirect(base_url()."KunjunganLab");
      }else{
        $this->session->set_flashdata("notif",$this->Notif->berhasil("Berhasil Menghapus Data"));
        redirect(base_url()."KunjunganLab/".$url."/".$id1."/".$id2);
      }

    }

    public function hapus_kunjungan($id){
      $this->db->where_in("nourutlab",$id);
      $this->db->delete("detaillab");
      $this->db->where("nokunjlab",$id);
      $this->db->delete("labkunjungan");
      $this->session->set_flashdata("notif",$this->Notif->berhasil('Berhasil hapus data'));
      redirect(base_url()."KunjunganLab");
    }

  }
 ?>
