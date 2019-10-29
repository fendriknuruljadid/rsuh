<style>
.form-group{
  margin-bottom: 5px;
}
</style>
<div class="card">
  <div class="card-body card-block">
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="kategori_obat" class=" form-control-label">No inventaris</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="text" name="noinventaris" class="form-control" placeholder="no inventaris" value="<?php echo @$inventaris['noinventaris']; ?>" <?php if($this->uri->segment(2)=='edit'){ echo "disabled";}?> required>
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="kategori_obat" class=" form-control-label">Nama</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="text" name="nama_inventaris" id="kategori_obat" class="form-control" placeholder="nama inventaris" value="<?php echo @$mbesar['namarek']; ?>" required>
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="kategori_obat" class=" form-control-label">Tangal Beli/Catat</label>
            </div>
            <div class="col-12 col-md-9">
              <input type="date" name="tgl_catat" id="kategori_obat" class="form-control"  value="<?php echo @$mbesar['namarek']; ?>" required>
        </div>
    </div>

    <div class="row form-group">
            <div class="col col-md-3">
              <label for="kategori_obat" class=" form-control-label">Harga</label>
            </div>
            <div class="col-12 col-md-9">
              <input type="number" name="harga" id="kategori_obat" class="form-control" placeholder="0" value="<?php echo @$mbesar['namarek']; ?>" required>
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="kategori_obat" class=" form-control-label">Nilai Inventaris</label>
            </div>
            <div class="col-12 col-md-9">
              <input type="number" name="nilai_inventaris" id="kategori_obat" class="form-control" placeholder="0" value="<?php echo @$mbesar['namarek']; ?>" required>
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="kategori_obat" class=" form-control-label">Waktu penyusutan</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="number" name="waktu" id="kategori_obat" class="form-control" placeholder="0" value="<?php echo @$mbesar['namarek']; ?>" required>
                <small>Bulan</small>
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="kategori_obat" class=" form-control-label">Jumlah susut</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="number" name="jumlah_susut" id="kategori_obat" class="form-control" placeholder="0" value="<?php echo @$mbesar['namarek']; ?>" required>
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="kategori_obat" class=" form-control-label">NO rek akuntansi</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="text" name="rek_akuntansi" id="kategori_obat" class="form-control" placeholder="no rek akuntansi" value="<?php echo @$mbesar['namarek']; ?>" required>
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="kategori_obat" class=" form-control-label">NO rek by susut</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="text" name="rek_susut" id="kategori_obat" class="form-control" placeholder="no rek susut" value="<?php echo @$mbesar['namarek']; ?>" required>
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="kategori_obat" class=" form-control-label">Cara pembayaran</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="radio" name="cara_bayar" value="KAS" > KAS
                <input type="radio" name="cara_bayar" value="HUTANG" > HUTANG
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="kategori_obat" class=" form-control-label">Jumlah</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="number" name="jumlah" id="kategori_obat" class="form-control" placeholder="0" value="<?php echo @$mbesar['namarek']; ?>" required>
            </div>
    </div>

    <div class="row form-group">
            <div class="col col-md-3">
              <label for="kategori_obat" class=" form-control-label">Nilai residu</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="number" name="nilai_residu" id="kategori_obat" class="form-control" placeholder="0" value="<?php echo @$mbesar['namarek']; ?>" required>
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="kategori_obat" class=" form-control-label">Penyusutan</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="number" name="penyusutan" id="kategori_obat" class="form-control" placeholder="0" value="<?php echo @$mbesar['namarek']; ?>" required>
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="kategori_obat" class=" form-control-label">Nilai Buku</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="number" name="nama_rek" id="kategori_obat" class="form-control" placeholder="0" value="<?php echo @$mbesar['namarek']; ?>" required>
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="kategori_obat" class=" form-control-label">Nilai Rek Akuntansi</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="number" name="nilai_rek" id="kategori_obat" class="form-control" placeholder="0" value="<?php echo @$mbesar['namarek']; ?>" required>
            </div>
    </div>

    <div class="row form-group">
            <div class="col col-md-3">
              <label for="kategori_obat" class=" form-control-label">Nama Rek By Susut</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="text" name="nama_rek_susut" id="kategori_obat" class="form-control" placeholder="nama rekening susut" value="<?php echo @$mbesar['namarek']; ?>" required>
            </div>
    </div>

  </div>
</div>
