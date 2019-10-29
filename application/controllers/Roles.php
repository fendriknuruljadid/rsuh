<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Roles extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model('ModelJabatan');
    $this->load->model('ModelUsers');
  }

  function index()
  {
    $data = array(
      'body'      => "User/Roles/list",
      'roles'     => $this->ModelUsers->roles()->result()
    );
    $this->load->view('index', $data);
  }

  function input()
  {
    $data = array(
      'body'      => "User/Roles/input",
      'group'     => $this->ModelUsers->get_group()->result()
    );
    $this->load->view('index', $data);
  }
  //
  // function edit()
  // {
  //   $id = $this->uri->segment(3);
  //   $jabatan = $this->ModelUsers->get_group_edit($id)->row_array();
  //   $data = array(
  //     'body'        => "User/Group/edit",
  //     'group'       => $this->ModelUsers->get_group()->result(),
  //     'idjabatan'   => $jabatan['idjabatan'],
  //     'namajabatan' => $jabatan['namajabatan'],
  //     'j_roles'     => explode(', ', $jabatan['j_roles']),
  //   );
  //   $this->load->view('index', $data);
  // }

  function insert()
  {
    $data = array(
      'roles'                        => $this->input->post('role'),
      'group_roles_idgroup_roles'   => $this->input->post('group')
    );
    $this->db->insert('roles', $data);
    redirect(base_url().'Roles');
  }

  // function update()
  // {
  //   $id = $this->input->post('kode');
  //   $data = array(
  //     'idjabatan'     => $this->input->post('kode'),
  //     'namajabatan'   => $this->input->post('namajabatan'),
  //     'j_roles'       => implode(', ', $this->input->post('roles'))
  //   );
  //   $this->db->where('idjabatan', $id);
  //   $this->db->update('jabatan', $data);
  //   redirect('Group');
  // }

  function hapus()
  {
    $id = $this->uri->segment(3);
    $this->db->where('roles', $id);
    $this->db->delete('roles');
    redirect(base_url().'Roles');
  }

}
