
<?php echo form_open('Mbesar/delete');?>

<div class="row">
  <div class="col-12">
    <div class="card card-cascade narrower z-depth-1">
      <div class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
        <div>
              <button type="button" class="btn btn_hapus btn-outline-white btn-rounded btn-sm px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Hapus Data"><i class="fas fa-trash-alt mt-0"></i></button>
              <button type="button" class="btn btn-outline-white btn-rounded btn-sm px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Jumlah Item Terpilih"><span id="jumlah_pilih">0</span></button>
            </div>
            <a href="" class="white-text mx-3">No Rekening</a>
            <div>
              <a href="<?php base_url(); ?>Mbesar/input" class="float-right">
              <button type="button" class="btn btn-outline-white btn-rounded btn-sm px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Tambah Data Baru"><i class="fas fa-pencil-alt mt-0"></i></button>
            </a>
            </div>
      </div>
      <div class="card-body">

        <div class="table-responsive">
          <table id="myTable" class="table table-striped table-bordered ">
          <thead>
              <tr>
                <th width="10%">
                  <input type="checkbox" class="form-check-input select-all" id="tableMaterialChec">
                  <label class="form-check-label" for="tableMaterialChec"></label>
                </th>
                <th>No Rek</th>
                  <th>Nama Rekening</th>
                  <th width="5%">Posisi</th>
                  <th width="5%">Pos Neraca</th>
                  <th>Opsi</th>
              </tr>
          </thead>
          <tbody>
            <?php $no=1; foreach ($buku_besar as $data) {?>
              <?php $id_check = $data->norek_mbesar;?>
              <tr>
                <td>
                  <input type="checkbox" class="form-check-input id_checkbox" id="tableMaterialCheck<?php echo $id_check ?>" name="id[]" value="<?php echo $id_check ?>">
                  <label class="form-check-label" for="tableMaterialCheck<?php echo $id_check ?>"></label>
                </td>
                <td><?php echo $data->norek_mbesar?></td>
                  <td><?php echo $data->namarek?></td>
                  <td><?php echo $data->posisi==1?"Rugi/Laba":"Neraca"?></td>
                  <td><?php if ($data->posneraca=1) {
                    echo "Aktiva Lancar";
                  }elseif($data->posneraca=2){
                    echo "Aktiva Tetap";
                  }elseif($data->posneraca=3){
                    echo "Pasiva (Hutang)";
                  }else{
                    echo "Pasiva (Modal)";
                  }?></td>
                  <td><a href="<?php base_url()?>Mbesar/edit/<?php echo str_replace(' ','',$data->norek_mbesar);?>">
                    <button type="button" class="btn btn-warning btn-sm btn-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                      <i class="fa fa-edit"></i>
                    </button>
                  </a></td>
              </tr>
            <?php
            $no++;
            }?>
          </tbody>
            </table>
        </div>
      </div>
    </div>
  </div>
</div>
<?php echo form_close();?>
<?php echo $this->Core->Fungsi_JS_Hapus(); ?>
