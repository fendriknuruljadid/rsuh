<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class Hutang extends CI_Controller{
    public function __construct()
    {
      parent::__construct();
      // $this->load->library(array('ion_auth', 'form_validation'));
      $this->load->helper(array('url', 'language'));
      $this->load->model('ModelHutang');
    }

    function index()
    {
      $data = array(
        'body' => 'Hutang/list',
        'hutang' => $this->ModelHutang->get_data(),
        'form_dialog' => 'Hutang/form_dialog'
       );
      $this->load->view('index', $data);
    }
    function lunasi($no_nota){
      $data_pembelian = $this->db->get_where("pembelian_obat",array('no_nota'=>$no_nota))->row_array();
      $data = array(
        'sisa' => 0,
        'status' => 'Lunas',
        'bayar' => $data_pembelian['sisa']
      );
      $this->db->where('no_nota',$no_nota);
      $this->db->update('pembelian_obat',$data);
      $this->db->reset_query();
      $this->db->where('pembelian_obat_no_nota',$no_nota);
      $this->db->update('hutang',array('total_hutang'=>0));
      $this->session->set_flashdata('notif',$this->Notif->berhasil("Hutang telah dilunasi"));
      redirect(base_url()."Hutang");
    }

  }
?>
