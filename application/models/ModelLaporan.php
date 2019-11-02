<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelLaporan extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function get_buku(){
    return $this->db->get("mbesar")->result();
  }
  public function get_buku_besar($from,$till){
    return $this->db
    ->select("norek,tanggal,namarek,SUM(debet) as debet,SUM(kredit) as kredit")
    ->join("mbesar","mbesar.norek_mbesar=jurnal.norek")
    ->where(array("DATE(tanggal)>="=>$from,"DATE(tanggal) <="=>$till,"debet !="=>NULL,"kredit !="=>NULL))
    ->group_by('norek')
    ->get("jurnal")->result();
  }
  public function get_buku_besar_detail($from,$till,$kode){
    return $this->db
    ->select("norek,tanggal,namarek,SUM(debet) as debet,SUM(kredit) as kredit")
    ->join("mbesar","mbesar.norek_mbesar=jurnal.norek")
    ->where(array("DATE(tanggal)>="=>$from,"DATE(tanggal) <="=>$till,"debet !="=>NULL,"kredit !="=>NULL))
    ->group_by('norek')
    ->like('norek',$kode,"after")
    ->get("jurnal")->result();
  }
  public function get_laba_rugi($from,$till){
    $data_pendapatan = $this->db
    ->select("norek,tanggal,namarek,SUM(debet) as debet,SUM(kredit) as kredit")
    ->join("mbesar","mbesar.norek_mbesar=jurnal.norek")
    ->where(array("DATE(tanggal) >="=>$from,"DATE(tanggal) <="=>$till))
    ->like("norek","4","after")
    ->or_like("norek","8","after")
    ->group_by('norek')
    ->get("jurnal")->result();
    $data_pengeluaran = $this->db
    ->select("norek,tanggal,namarek,SUM(debet) as debet")
    ->join("mbesar","mbesar.norek_mbesar=jurnal.norek")
    ->where(array("DATE(tanggal)>="=>$from,"DATE(tanggal) <="=>$till))
    ->like("norek","5","after")
    ->or_like("norek","6","after")
    ->or_like("norek","7","after")
    ->group_by('norek')
    ->get("jurnal")->result();
    $respon = array(
      'pendapatan' => $data_pendapatan,
      'pengeluaran' => $data_pengeluaran
    );
    // die(var_dump($respon));
    return $respon;
  }
  public function get_dokter(){
    return $this->db
    ->like('jabatan',"DOKTER","both")
    ->get('pegawai')->result();
  }
  public function get_pendapatan_jasa_all($from,$till,$nik){
    $this->db->join("periksa","periksa.idperiksa=tindakan.periksa_idperiksa");
    $this->db->select("jsmedis,SUM(japel_dokter) as jumlah");
    $this->db->group_by("kodejasa");
    return $this->db->get_where("tindakan",array("japel_dokter !="=>0,"DATE(tanggal) >="=>$from,'DATE(tanggal) <='=>$till,'tindakan.operator'=>$nik))->result();
    // die(var_dump($data));
  }
  public function get_pendapatan_jasa($from,$till){
    $this->db->join("periksa","periksa.idperiksa=tindakan.periksa_idperiksa");
    $this->db->select("jsmedis,SUM(japel_dokter) as jumlah");
    $this->db->group_by("kodejasa");
    return $this->db->get_where("tindakan",array("japel_dokter !="=>0,"DATE(tanggal) >="=>$from,'DATE(tanggal) <='=>$till,'tindakan.operator'=>$_SESSION['nik']))->result();
    // die(var_dump($data));
  }




  function get_kesakitan($from,$till)
  {
    $response = array();
    $data_penyakit = $this->db->select('nama_penyakit,kodeicdx,count(*) as jumlah')
    ->limit(10,0)
    ->order_by('jumlah',"DESC")
    ->get_where('view_kunjungan_pasien',array('DATE(tgl_kunjungan) >='=>$from,'DATE(tgl_kunjungan) <='=>$till))
    ->result();
    $t_lama = 0;
    $t_baru = 0;
    $t_nosts = 0;
    $grand = 0;
    foreach ($data_penyakit as $value) {
      $lama = $this->db->select('count(*) as lama')
      ->get_where('view_kunjungan_pasien',array('DATE(tgl_kunjungan) >='=>$from,'DATE(tgl_kunjungan) <='=>$till,'jenis_kunjungan'=>1))->row_array();
      $baru = $this->db->select('count(*) as baru')
      ->get_where('view_kunjungan_pasien',array('DATE(tgl_kunjungan) >='=>$from,'DATE(tgl_kunjungan) <='=>$till,'jenis_kunjungan'=>0))->row_array();
      $no_sts = $this->db->select('count(*) as no_sts')
      ->get_where('view_kunjungan_pasien',array('DATE(tgl_kunjungan) >='=>$from,'DATE(tgl_kunjungan) <='=>$till,'jenis_kunjungan'=>null))->row_array();
      $data = array(
        'kode' => $value->kodeicdx,
        'nama' => $value->nama_penyakit,
        'no_sts' => $no_sts['no_sts'],
        'lama' => $lama['lama'],
        'baru' => $baru['baru'],
        'total' => $value->jumlah,
      );
      $t_lama = $t_lama + $lama['lama'];
      $t_baru = $t_baru + $baru['baru'];
      $t_nosts = $t_nosts + $no_sts['no_sts'];
      array_push($response,$data);
    }
    $grand = $t_lama+$t_baru+$t_nosts;
    $data = array(
      'kode' => "#",
      'nama' => "GRAND TOTAL",
      'no_sts' => $t_nosts,
      'lama' => $t_lama,
      'baru' => $t_baru,
      'total' => $grand,
    );
    array_push($response,$data);
    // die(print_r($response));
    return $response;
    // return $this->db->get('mbesar')->result();
  }
  public function get_rekap_lab($from,$till){
    return $this->db
    ->group_by("periksa.unit_layanan")
    ->select("COUNT(*) as jumlah,unit_layanan")
    ->join("periksa","periksa.idperiksa=labkunjungan.periksa_idperiksa")
    ->get_where("labkunjungan",array("DATE(labkunjungan.tanggal) >="=>$from,"DATE(labkunjungan.tanggal) <="=>$till))
    ->result();
  }
  public function get_rekap_lab_detail($from,$till,$tupel){
    $this->db->join("periksa","periksa.idperiksa=labkunjungan.periksa_idperiksa");
    $this->db->join("pasien","periksa.no_rm=pasien.noRM");
    $this->db->where(array("DATE(labkunjungan.tanggal) >="=>$from,"DATE(labkunjungan.tanggal) <="=>$till));
    $this->db->group_start();
    for($i=0;$i<count($tupel);$i++){
      // if ($i==0) {
        $this->db->or_where("unit_layanan",$tupel[$i]);
      // }else{
      //   $this->db->or_where("unit_layanan",$tupel[$i]);
      // }

    }
    $this->db->group_end();
    return $this->db->get("labkunjungan")->result();
  }
  public function get_kunjungan($from,$till,$tupel=null){

    if ($tupel==null || $tupel=='' || $tupel==NULL) {
      return $this->db
      ->join("pasien","pasien.noRM=kunjungan.pasien_noRM")
      ->order_by("no_urutkunjungan")
      ->group_by("no_urutkunjungan")
      ->get_where('kunjungan',array('DATE(tgl) >='=>$from,'DATE(tgl) <='=>$till))
      ->result();
    }else{
      // $kunjungan = $this->db->order_by("no_urutkunjungan")->group_by("no_urutkunjungan")->get_where('view_kunjungan_pasien',array('DATE(tgl_kunjungan) >='=>$from,'DATE(tgl_kunjungan) <='=>$till,'kode_tupel'=>$tupel))
      // ->result();
      return $this->db
      ->join("pasien","pasien.noRM=kunjungan.pasien_noRM")
      ->order_by("no_urutkunjungan")
      ->group_by("no_urutkunjungan")
      ->get_where('kunjungan',array('DATE(tgl) >='=>$from,'DATE(tgl) <='=>$till,'tupel_kode_tupel'=>$tupel))
      ->result();

    }

  }
  public function get_kunjungan_baru($from,$till,$tupel=null){
    if ($tupel==null || $tupel=='' || $tupel==NULL) {
      $kunjungan = $this->db->select('count(*) as jumlah')->get_where('view_kunjungan_pasien',array('DATE(tgl_kunjungan) >='=>$from,'DATE(tgl_kunjungan) <='=>$till,'jenis_kunjungan'=>0))
      ->row_array();
    }else{
      $kunjungan = $this->db->select('count(*) as jumlah')->get_where('view_kunjungan_pasien',array('DATE(tgl_kunjungan) >='=>$from,'DATE(tgl_kunjungan) <='=>$till,'jenis_kunjungan'=>0,'kode_tupel'=>$tupel))
      ->row_array();
    }
    return $kunjungan['jumlah'];
  }
  public function get_kunjungan_lama($from,$till,$tupel=null){
    if ($tupel==null || $tupel=='' || $tupel==NULL) {
      $kunjungan = $this->db->select('count(*) as jumlah')->get_where('view_kunjungan_pasien',array('DATE(tgl_kunjungan) >='=>$from,'DATE(tgl_kunjungan) <='=>$till,'jenis_kunjungan'=>1))
      ->row_array();
    }else{
      $kunjungan = $this->db->select('count(*) as jumlah')->get_where('view_kunjungan_pasien',array('DATE(tgl_kunjungan) >='=>$from,'DATE(tgl_kunjungan) <='=>$till,'jenis_kunjungan'=>1,'kode_tupel'=>$tupel))
      ->row_array();
    }
    return $kunjungan['jumlah'];
  }
      function get_kesakitan_umur($from,$till){
        $data_res = array();
        $res_akhir = array();
        $data = $this->db->group_by("kodeicdx")->get_where("view_kunjungan_pasien",array("DATE(tgl_kunjungan) >="=>$from,"DATE(tgl_kunjungan) <="=>$till))->result();
        // die(print_r($data));
        foreach ($data as $value) {
          $data_orang = $this->db->get_where("view_kunjungan_pasien",array("DATE(tgl_kunjungan) >="=>$from,"DATE(tgl_kunjungan) <="=>$till,"kodeicdx"=>$value->kodeicdx))->result();
          // die(print_r($data_orang));
          $u_0hr = 0;
          $u_8hr = 0;
          $u_1bln = 0;
          $u_1thn = 0;
          $u_5thn = 0;
          $u_10thn = 0;
          $u_15thn = 0;
          $u_20thn = 0;
          $u_45thn =0;
          $u_55thn = 0;
          $u_60thn = 0;
          $u_65thn =0;
          $u_70thn =0;
          foreach ($data_orang as $key) {
            $biday = new DateTime($key->tgl_lahir);
          	$today = new DateTime();
          	$diff = $today->diff($biday);
            // die(print_r($diff));
            if ($diff->y<=1) {
              if ($diff->m<=0) {
                if ($diff->d==0 && $diff->y<=7 ) {
                  $u_0hr +=1;
                }else if($diff->d>7 && $diff->d<=28){
                  $u_8hr+=1;
                }else{
                  $u_1bln +=1;
                }
              }else{
                $u_1bln+=1;
              }
            }else if($diff->y>0 && $diff->y<=4){
              $u_1thn +=1;
            }else if($diff->y>4 && $diff->y<=9){
              $u_5thn +=1;
            }else if($diff->y>9 && $diff->y<=14){
              $u_10thn +=1;
            }else if($diff->y>14 && $diff->y<=19){
              $u_15thn +=1;
            }else if($diff->y>19 && $diff->y<=44){
              $u_20thn +=1;
            }else if($diff->y>44 && $diff->y<=54){
              $u_45thn +=1;
            }else if($diff->y>54 && $diff->y<=59){
              $u_55thn +=1;
            }else if($diff->y>59 && $diff->y<=64){
              $u_60thn +=1;
            }else if($diff->y>64 && $diff->y<=69){
              $u_65thn +=1;
            }else{
              $u_70thn +=1;
            }
          }
          $total = $u_0hr+$u_8hr+$u_1bln+$u_1thn+$u_5thn+$u_10thn+$u_15thn+$u_20thn+$u_45thn+$u_55thn+$u_60thn+$u_65thn+$u_70thn;
          $data_sakit = array(
            "ID_ICD" => $value->kodeicdx,
            "ENG" => $value->nama_penyakit,
            "IND" => $value->nama_penyakit,
            "NOL_HARI" => $u_0hr,
            "LAPAN_HARI" => $u_8hr,
            "BULAN" => $u_1bln,
            "TAHUN_1" => $u_1thn,
            "TAHUN_2" => $u_5thn,
            "TAHUN_3" => $u_10thn,
            "TAHUN_4" => $u_15thn,
            "TAHUN_5" => $u_20thn,
            "TAHUN_6" => $u_45thn,
            "TAHUN_7" => $u_45thn,
            "TAHUN_8" => $u_55thn,
            "TAHUN_9" => $u_60thn,
            "TAHUN_9" => $u_65thn,
            "TAHUN_9" => $u_70thn,
            "TOTAL" => $total,
          );
          array_push($data_res,$data_sakit);
          // die(print_r($data_res));
        }
        foreach ($data_res as $key => $value) {
          $tt[$key] = $value['TOTAL'];
        }
        array_multisort($tt,SORT_DESC,$data_res);
        $pnjng = count($data_res);
        if ($pnjng>10) {
          for ($i=0; $i <= 9 ; $i++) {
            array_push($res_akhir,$data_res[$i]);
          }
        }else{
          for ($i=0; $i < $pnjng ; $i++) {
            array_push($res_akhir,$data_res[$i]);
          }
        }
        // echo "<pre>";
          // die(print_r($res_akhir));
        // echo "</pre>";
        // die();
        $u_0hr = 0;
        $u_8hr = 0;
        $u_1bln = 0;
        $u_1thn = 0;
        $u_5thn = 0;
        $u_10thn = 0;
        $u_15thn = 0;
        $u_20thn = 0;
        $u_45thn =0;
        $u_55thn = 0;
        $u_60thn = 0;
        $u_65thn =0;
        $u_70thn =0;
        $total = 0;
        foreach ($res_akhir as $value) {
          $u_0hr += $value['NOL_HARI'];
          $u_8hr += $value["LAPAN_HARI"];
          $u_1bln += $value["BULAN"];
          $u_1thn += $value["TAHUN_1"];
          $u_5thn += $value["TAHUN_2"];
          $u_10thn += $value["TAHUN_3"];
          $u_15thn += $value["TAHUN_4"];
          $u_20thn += $value["TAHUN_5"];
          $u_45thn += $value["TAHUN_6"];
          $u_45thn += $value["TAHUN_7"];
          $u_55thn += $value["TAHUN_8"];
          $u_60thn += $value["TAHUN_9"];
          $u_65thn += $value["TAHUN_9"];
          $u_70thn += $value["TAHUN_9"];
          $total += $value["TOTAL"];
        }
        $data_sakit = array(
          "ID_ICD" => "#",
          "ENG" => "<b>GRAND TOTAL</b>",
          "IND" => "<b>GRAND TOTAL</b>",
          "NOL_HARI" => $u_0hr,
          "LAPAN_HARI" => $u_8hr,
          "BULAN" => $u_1bln,
          "TAHUN_1" => $u_1thn,
          "TAHUN_2" => $u_5thn,
          "TAHUN_3" => $u_10thn,
          "TAHUN_4" => $u_15thn,
          "TAHUN_5" => $u_20thn,
          "TAHUN_6" => $u_45thn,
          "TAHUN_7" => $u_45thn,
          "TAHUN_8" => $u_55thn,
          "TAHUN_9" => $u_60thn,
          "TAHUN_9" => $u_65thn,
          "TAHUN_9" => $u_70thn,
          "TOTAL" => $total,
        );
        array_push($res_akhir,$data_sakit);
        // die(print_r($res_akhir));
        return $res_akhir;
      }
      function get_kunjungan_umur($from,$till){
        $data_res = array();
        $res_akhir = array();
        // $data = $this->db->group_by("kodeicdx")->get_where("view_kunjungan_pasien",array("DATE(tgl_kunjungan) >="=>$from,"DATE(tgl_kunjungan) <="=>$till))->result();
        // die(print_r($data));
        // foreach ($data as $value) {
          $data_orang = $this->db->group_by("no_urutkunjungan")->get_where("view_kunjungan_pasien",array("DATE(tgl_kunjungan) >="=>$from,"DATE(tgl_kunjungan) <="=>$till))->result();
          // die(print_r($data_orang));
          $u_0hr = 0;
          $u_8hr = 0;
          $u_1bln = 0;
          $u_1thn = 0;
          $u_5thn = 0;
          $u_10thn = 0;
          $u_15thn = 0;
          $u_20thn = 0;
          $u_45thn =0;
          $u_55thn = 0;
          $u_60thn = 0;
          $u_65thn =0;
          $u_70thn =0;
          foreach ($data_orang as $key) {
            $biday = new DateTime($key->tgl_lahir);
          	$today = new DateTime();
          	$diff = $today->diff($biday);
            // die(print_r($diff));
            if ($diff->y<=1) {
              if ($diff->m<=0) {
                if ($diff->d==0 && $diff->y<=7 ) {
                  $u_0hr +=1;
                }else if($diff->d>7 && $diff->d<=28){
                  $u_8hr+=1;
                }else{
                  $u_1bln +=1;
                }
              }else{
                $u_1bln+=1;
              }
            }else if($diff->y>0 && $diff->y<=4){
              $u_1thn +=1;
            }else if($diff->y>4 && $diff->y<=9){
              $u_5thn +=1;
            }else if($diff->y>9 && $diff->y<=14){
              $u_10thn +=1;
            }else if($diff->y>14 && $diff->y<=19){
              $u_15thn +=1;
            }else if($diff->y>19 && $diff->y<=44){
              $u_20thn +=1;
            }else if($diff->y>44 && $diff->y<=54){
              $u_45thn +=1;
            }else if($diff->y>54 && $diff->y<=59){
              $u_55thn +=1;
            }else if($diff->y>59 && $diff->y<=64){
              $u_60thn +=1;
            }else if($diff->y>64 && $diff->y<=69){
              $u_65thn +=1;
            }else{
              $u_70thn +=1;
            }
          }
          $total = $u_0hr+$u_8hr+$u_1bln+$u_1thn+$u_5thn+$u_10thn+$u_15thn+$u_20thn+$u_45thn+$u_55thn+$u_60thn+$u_65thn+$u_70thn;
          $data_sakit = array(
            "ID_ICD" => "Tidak Ada",
            "ENG" => "Tidak Ada",
            "IND" => "Tidak Ada",
            "NOL_HARI" => $u_0hr,
            "LAPAN_HARI" => $u_8hr,
            "BULAN" => $u_1bln,
            "TAHUN_1" => $u_1thn,
            "TAHUN_2" => $u_5thn,
            "TAHUN_3" => $u_10thn,
            "TAHUN_4" => $u_15thn,
            "TAHUN_5" => $u_20thn,
            "TAHUN_6" => $u_45thn,
            "TAHUN_7" => $u_45thn,
            "TAHUN_8" => $u_55thn,
            "TAHUN_9" => $u_60thn,
            "TAHUN_9" => $u_65thn,
            "TAHUN_9" => $u_70thn,
            "TOTAL" => $total,
          );
          array_push($data_res,$data_sakit);
          // die(print_r($data_res));
        // }
        // foreach ($data_res as $key => $value) {
        //   $tt[$key] = $value['TOTAL'];
        // }
        // array_multisort($tt,SORT_DESC,$data_res);
        // $pnjng = count($data_res);
        // if ($pnjng>10) {
        //   for ($i=0; $i <= 9 ; $i++) {
        //     array_push($res_akhir,$data_res[$i]);
        //   }
        // }else{
        //   for ($i=0; $i < $pnjng ; $i++) {
        //     array_push($res_akhir,$data_res[$i]);
        //   }
        // }
        // echo "<pre>";
          // die(print_r($res_akhir));
        // echo "</pre>";
        // die();
        // $u_0hr = 0;
        // $u_8hr = 0;
        // $u_1bln = 0;
        // $u_1thn = 0;
        // $u_5thn = 0;
        // $u_10thn = 0;
        // $u_15thn = 0;
        // $u_20thn = 0;
        // $u_45thn =0;
        // $u_55thn = 0;
        // $u_60thn = 0;
        // $u_65thn =0;
        // $u_70thn =0;
        // $total = 0;
        // foreach ($res_akhir as $value) {
        //   $u_0hr += $value['NOL_HARI'];
        //   $u_8hr += $value["LAPAN_HARI"];
        //   $u_1bln += $value["BULAN"];
        //   $u_1thn += $value["TAHUN_1"];
        //   $u_5thn += $value["TAHUN_2"];
        //   $u_10thn += $value["TAHUN_3"];
        //   $u_15thn += $value["TAHUN_4"];
        //   $u_20thn += $value["TAHUN_5"];
        //   $u_45thn += $value["TAHUN_6"];
        //   $u_45thn += $value["TAHUN_7"];
        //   $u_55thn += $value["TAHUN_8"];
        //   $u_60thn += $value["TAHUN_9"];
        //   $u_65thn += $value["TAHUN_9"];
        //   $u_70thn += $value["TAHUN_9"];
        //   $total += $value["TOTAL"];
        // }
        // $data_sakit = array(
        //   "ID_ICD" => "#",
        //   "ENG" => "<b>GRAND TOTAL</b>",
        //   "IND" => "<b>GRAND TOTAL</b>",
        //   "NOL_HARI" => $u_0hr,
        //   "LAPAN_HARI" => $u_8hr,
        //   "BULAN" => $u_1bln,
        //   "TAHUN_1" => $u_1thn,
        //   "TAHUN_2" => $u_5thn,
        //   "TAHUN_3" => $u_10thn,
        //   "TAHUN_4" => $u_15thn,
        //   "TAHUN_5" => $u_20thn,
        //   "TAHUN_6" => $u_45thn,
        //   "TAHUN_7" => $u_45thn,
        //   "TAHUN_8" => $u_55thn,
        //   "TAHUN_9" => $u_60thn,
        //   "TAHUN_9" => $u_65thn,
        //   "TAHUN_9" => $u_70thn,
        //   "TOTAL" => $total,
        // );
        // array_push($res_akhir,$data_sakit);
        // die(print_r($res_akhir));
        return $data_res;
      }
      function get_kunjungan_poli($from,$till){
      $data_res = array();
      $this->db->group_by("kode_tupel");
      $data = $this->db->get("view_kunjungan_pasien")->result();
      foreach ($data as $value) {
        // $total = 0;
        $data_BL = $this->db->select("COUNT(*) as JUMLAH")->get_where("view_kunjungan_pasien",array('tujuan_pelayanan'=>$value->tujuan_pelayanan,"jenis_kelamin"=>'L',"jenis_kunjungan ="=>"0","DATE(tgl_kunjungan) >="=>$from,"DATE(tgl_kunjungan) <="=>$till))->row_array();
        $data_BP = $this->db->select("COUNT(*) as JUMLAH")->get_where("view_kunjungan_pasien",array('tujuan_pelayanan'=>$value->tujuan_pelayanan,"jenis_kelamin !="=>'L',"jenis_kunjungan ="=>"0","DATE(tgl_kunjungan) >="=>$from,"DATE(tgl_kunjungan) <="=>$till))->row_array();
        $data_LL = $this->db->select("COUNT(*) as JUMLAH")->get_where("view_kunjungan_pasien",array('tujuan_pelayanan'=>$value->tujuan_pelayanan,"jenis_kelamin"=>'L',"jenis_kunjungan"=>"1","DATE(tgl_kunjungan) >="=>$from,"DATE(tgl_kunjungan) <="=>$till))->row_array();
        $data_LP = $this->db->select("COUNT(*) as JUMLAH")->get_where("view_kunjungan_pasien",array('tujuan_pelayanan'=>$value->tujuan_pelayanan,"jenis_kelamin !="=>'L',"jenis_kunjungan"=>"1","DATE(tgl_kunjungan) >="=>$from,"DATE(tgl_kunjungan) <="=>$till))->row_array();
        $total = $data_BL['JUMLAH']+$data_BP['JUMLAH']+$data_LL['JUMLAH']+$data_LP['JUMLAH'];
        $dt = array(
          "TUPEL" => $value->tujuan_pelayanan,
          "BARU_L" => $data_BL['JUMLAH'],
          "BARU_P" => $data_BP['JUMLAH'],
          "LAMA_L" => $data_LL['JUMLAH'],
          "LAMA_P" => $data_LP['JUMLAH'],
          "TOTAL" => $total
        );
        array_push($data_res,$dt);
      }
      // die(print_r($data_res));
      return $data_res;
    }

    public function get_kunjungan_laborat($from,$till){
      return $this->db->select("kodelab,nama,count(*) as jumlah")
      ->join('detaillab','detaillab.nourutlab=labkunjungan.nokunjlab')
      ->group_by('kodelab')
      ->get_where('labkunjungan',array('DATE(tanggal) >='=>$from,'DATE(tanggal) <='=>$till))
      ->result();
    }

    public function get_opname($from,$till,$kelompok){
      $response = array();
      if ($kelompok=='semua') {
        $obat = $this->db->order_by('nama_obat')->get('obat')->result();
      }else{
        $obat = $this->db->order_by('nama_obat')->get_where('obat',array("kelompok_obat"=>$kelompok))->result();
      }
      // die(var_dump($obat));
      foreach ($obat as $value) {
        $hitung =  $this->db->get_where('batch_pengadaan',array('DATE(tgl) <='=>$from))->row_array();
        if ($hitung<=0) {
          $stok_awal = $this->db->select('SUM(jumlah) as jumlah')->get_where('view_pengadaan',array('status_stok_awal'=>1,'idobat'=>$value->idobat))->row_array();
          $pengadaan = $this->db->select('SUM(jumlah) as jumlah')->get_where('view_pengadaan',array('idobat'=>$value->idobat,'status_stok_awal'=>0,'DATE(tgl) >='=>$from,'DATE(tgl)<='=>$till))->row_array() ;
          $pemakaian = $this->db->select('SUM(jumlah) as jumlah')->get_where('view_pemakaian',array('idobat'=>$value->idobat,'DATE(tgl) >='=>$from,'DATE(tgl) <='=>$till))->row_array();
          // $resep = $this->db->select('SUM(jumlah) as jumlah')->get_where('view_resep',array('idobat'=>$value->idobat,'DATE(tgl) >='=>$from,'DATE(tgl) <='=>$till))->row_array();
          $resep = $this->db
          ->select("SUM(jumlah_beri) as jumlah")
          ->join('detail_resep',"detail_resep.iddetail_resep=detail_resep_diberikan.id_detail_resep")
          ->get_where('detail_resep_diberikan',array('detail_resep.obat_idobat'=>$value->idobat,'DATE(tanggal) >='=>$from,'DATE(tanggal) <='=>$till))->row_array();
          $retur = $this->db->select('SUM(jumlah) as jumlah')->get_where('view_retur',array('idobat'=>$value->idobat,'DATE(tgl) >='=>$from,'DATE(tgl) <='=>$till))->row_array();
          $obat_rusak = $this->db->select('SUM(jumlah) as jumlah')->get_where('view_obat_rusak',array('idobat'=>$value->idobat,'DATE(tgl) >='=>$from,'DATE(tgl) <='=>$till))->row_array();

          $stok_awal = ($stok_awal['jumlah']!=null) ? $stok_awal['jumlah'] : 0;
          $pengadaan = ($pengadaan['jumlah']!=null) ? $pengadaan['jumlah'] : 0;
          $pemakaian = ($pemakaian['jumlah']!=null) ? $pemakaian['jumlah'] : 0;
          $resep = ($resep['jumlah']!=null) ? $resep['jumlah'] : 0;
          $retur = ($retur['jumlah']!=null) ? $retur['jumlah'] : 0;
          $obat_rusak = ($obat_rusak['jumlah']!=null) ? $obat_rusak['jumlah'] : 0;

          $persediaan = $pengadaan+$stok_awal;
          $total_pakai = (int)$pemakaian+$retur+$resep+$obat_rusak;
          $sisa = $persediaan-$total_pakai;
          // die(var_dump($sisa));

        }
        else{
          $stok = $this->db->select('SUM(jumlah) as jumlah')->get_where('view_pengadaan',array('DATE(tgl) <='=>$from,'idobat'=>$value->idobat))->row_array();
          $pemakaian1 = $this->db->select('SUM(jumlah) as jumlah')->get_where('view_pemakaian',array('idobat'=>$value->idobat,'DATE(tgl) <='=>$from,'DATE(tgl) >=' => "2019-06-28"))->row_array();
          // $resep1 = $this->db->select('SUM(jumlah) as jumlah')->get_where('view_resep',array('idobat'=>$value->idobat,'DATE(tgl) <='=>$from))->row_array();
          $resep1 = $this->db
          ->select("SUM(jumlah_beri) as jumlah")
          ->join('detail_resep',"detail_resep.iddetail_resep=detail_resep_diberikan.id_detail_resep")
          ->get_where('detail_resep_diberikan',array('detail_resep.obat_idobat'=>$value->idobat,'DATE(tanggal) >='=>"2019-06-30",'DATE(tanggal) <='=>$from))->row_array();

          $retur1 = $this->db->select('SUM(jumlah) as jumlah')->get_where('view_retur',array('idobat'=>$value->idobat,'DATE(tgl) <='=>$from,'DATE(tgl) >='=>"2019-06-30"))->row_array();
          $obat_rusak1 = $this->db->select('SUM(jumlah) as jumlah')->get_where('view_obat_rusak',array('idobat'=>$value->idobat,'DATE(tgl) <='=>$from,'DATE(tgl) >='=>"2019-06-28"))->row_array();
          $stok = ($stok['jumlah']!=null) ? $stok['jumlah'] : 0;
          $pemakaian1 = ($pemakaian1['jumlah']!=null) ? $pemakaian1['jumlah'] : 0;
          $resep1 = ($resep1['jumlah']!=null) ? $resep1['jumlah'] : 0;
          $retur1 = ($retur1['jumlah']!=null) ? $retur1['jumlah'] : 0;
          $obat_rusak1 = ($obat_rusak1['jumlah']!=null) ? $obat_rusak1['jumlah'] : 0;
          $total_pakai1 = $pemakaian1+$retur1+$resep1+$obat_rusak1;
          $stok_awal = $stok-$total_pakai1;
          $pengadaan = $this->db->select('SUM(jumlah) as jumlah')->get_where('view_pengadaan',array('idobat'=>$value->idobat,'DATE(tgl) >='=>$from,'DATE(tgl) <='=>$till))->row_array();
          $pemakaian = $this->db->select('SUM(jumlah) as jumlah')->get_where('view_pemakaian',array('idobat'=>$value->idobat,'DATE(tgl) >='=>$from,'DATE(tgl) <='=>$till))->row_array();
          // $resep = $this->db->select('SUM(jumlah) as jumlah')->get_where('view_resep',array('idobat'=>$value->idobat,'DATE(tgl) >='=>$from,'DATE(tgl) <='=>$till))->row_array();
          $resep = $this->db
          ->select("SUM(jumlah) as jumlah")
          ->join('detail_resep',"detail_resep.iddetail_resep=detail_resep_diberikan.id_detail_resep")
          ->get_where('detail_resep_diberikan',array('detail_resep.obat_idobat'=>$value->idobat,'DATE(tanggal) >='=>$from,'DATE(tanggal) <='=>$till))->row_array();

          $retur = $this->db->select('SUM(jumlah) as jumlah')->get_where('view_retur',array('idobat'=>$value->idobat,'DATE(tgl) >='=>$from,'DATE(tgl) <='=>$till))->row_array();
          $obat_rusak = $this->db->select('SUM(jumlah) as jumlah')->get_where('view_obat_rusak',array('idobat'=>$value->idobat,'DATE(tgl) >='=>$from,'DATE(tgl) <='=>$till))->row_array();
          $pengadaan = ($pengadaan['jumlah']!=null) ? $pengadaan['jumlah'] : 0;
          $pemakaian = ($pemakaian['jumlah']!=null) ? $pemakaian['jumlah'] : 0;
          $resep = ($resep['jumlah']!=null) ? $resep['jumlah'] : 0;
          $retur = ($retur['jumlah']!=null) ? $retur['jumlah'] : 0;
          $obat_rusak = ($obat_rusak['jumlah']!=null) ? $obat_rusak['jumlah'] : 0;
          $persediaan = $pengadaan+$stok_awal;
          $total_pakai = (int)$pemakaian+$retur+$resep+$obat_rusak;
          $sisa = $persediaan-$total_pakai;
        }
        $data = array(
          'idobat' => $value->idobat,
          'nama' => $value->nama_obat,
          'harga' => "Rp.".number_format($value->harga_beli_satuan_kecil),
          'satuan_kecil' => $value->satuan_kecil,
          'stok_awal' => $stok_awal,
          'pengadaan' => $pengadaan,
          'persediaan' => $persediaan,
          'pemakaian' => $total_pakai,
          'retur' => $retur,
          'rusak' => $obat_rusak,
          'sisa' => $sisa,
        );
        array_push($response,$data);
      }
      // die(var_dump($response));
      return $response;
    }


    public function get_lplpo($from,$till,$kelompok){
      if ($kelompok==NULL || $kelompok=='') {
        $obat = $this->db
        ->order_by("idobat")
        ->get('obat')->result();
      }else if($kelompok=="Lainnya"){
        $obat = $this->db
        ->order_by("idobat")
        ->get_where('obat')->result();
      }
      else{
        $obat = $this->db
        ->order_by('idobat')
        ->get_where('obat',array("kelompok_obat"=>$kelompok))->result();
      }
    }

    // public function get_stok_batch($from,$till){
    //   return $this->db->order_by('id')->get_where('list_batch',$)
    // }

    public function get_rajal_ranap($from,$till)
    {
      $data = array();
      $data['rajal'] = $this->db->select("COUNT(acc_ranap) AS jml_rajal")
                        ->get_where("kunjungan",array('acc_ranap' => 0,'billing' => 1,"DATE(tgl) >="=>$from,"DATE(tgl) <="=>$till ))
                        ->row_array()['jml_rajal'];
      $data['ranap'] = $this->db->select("COUNT(acc_ranap) AS jml_ranap")
                        ->get_where("kunjungan",array('acc_ranap' => 1,'billing' => 1,"DATE(tgl) >="=>$from,"DATE(tgl) <="=>$till ))
                        ->row_array()['jml_ranap'];
      $data['jumlah'] = $data['rajal'] + $data['ranap'];
      return $data;
    }

    public function get_rekap_rujukan_internal($from,$till,$group = 0)
    {

                        if ($group == 1) {
                          $this->db->select("COUNT(rujukan_internal.tujuan_poli) as jml, rujukan_internal.tujuan_poli as tujuan_poli, rujukan_internal.poli as asal_poli");
                          $this->db->group_by("rujukan_internal.tujuan_poli, rujukan_internal.poli");
                        }else{
                          $this->db->select("rujukan_internal.poli as asal_poli, rujukan_internal.tujuan_poli as tujuan_poli,
                                            LEFT(rujukan_internal.tanggal_rujuk, 10) as tanggal,
                                            pasien.namapasien as nama, pasien.noRM as norm, kunjungan.no_antrian as no_antrian");
                        }
      $this->db->where(array("DATE(LEFT(rujukan_internal.tanggal_rujuk, 10)) >="=>$from,"DATE(LEFT(rujukan_internal.tanggal_rujuk, 10)) <="=>$till ));
      $this->db->join("kunjungan","kunjungan.no_urutkunjungan = rujukan_internal.kunjungan_no_urutkunjungan");
      $this->db->join("pasien","pasien.noRM = kunjungan.pasien_noRM");

      return $this->db->get("rujukan_internal");
    }

    public function get_rujukan_poli($from,$till)
    {
      // code...
    }
}
