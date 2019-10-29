<style>
  .gigi{
    display: inline-block;width:50px;height:auto;cursor: pointer;
  }
</style>
<div class="main-content">
  <div class="section__content section__content--p30">
    <div class="container-fluid">
      <div class="row">

        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <strong>Poli Gigi</strong>
              <small>Form Periksa</small>
            </div>
            <div class="card-body card-block">
              <?php echo form_open_multipart('PoliGigi/insert');?>
              <?php echo @$error;?>
              <div class="card-body card-block">

                <div class="row form-group">
                      <div class="col col-md-2">
                        <label for="nokun" class=" form-control-label">NO.Kunjungan :</label>
                      </div>
                      <div class="col-12 col-md-4">
                          <input type="text" name="nokun" id="nokun" class="form-control" placeholder="nokun" value="<?php echo @$idkunjungan; ?>" required readonly>
                      </div>
                      <div class="col col-md-1">
                        <label for="tanggal" class=" form-control-label">Tanggal</label>
                      </div>
                      <div class="col-12 col-md-4">
                          <input type="date" name="tanggal" id="tanggal" class="form-control" placeholder="Tanggal" value="<?php echo date('Y-m-d'); ?>" required readonly>
                      </div>
                </div>

                <div class="row form-group">
                      <div class="col col-md-2">
                        <label for="norm" class=" form-control-label">Pasien :</label>
                      </div>
                      <div class="col-12 col-md-3">
                          <input type="text" name="no_rm" id="norm" class="form-control" placeholder="norm" value="<?php echo @$pasien['noRM']; ?>" required readonly>
                      </div>
                      <div class="col-12 col-md-4">
                          <input type="text" name="nama_pasien" id="nama_pasien" class="form-control" placeholder="nama_pasien" value="<?php echo @$pasien['namapasien']; ?>" required readonly>
                      </div>
                      <div class="col-12 col-md-3">
                          <input type="text" name="jenis_kunjungan" id="jenis_kunjungan" class="form-control" placeholder="jenis_kunjungan" value="<?php echo @$jenispasien['jenis_pasien']; ?>" required readonly>
                      </div>
                </div>

                <div class="card color-bordered-table info-bordered-table">
                  <div class="card-body card-block">
                    <div class="col-md-12 col">
                        <div class="col col-md-12">
                          <span tittle="Gigi 18" href="#" id="gigi_18" class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="Click Gambar Untuk Mendiagnosa"><span><center>18</center><img src="<?php echo base_url()?>desain/assets/images/gambar_gigi.PNG"></span></span>
                          <span tittle="Gigi 17" href="#" id="gigi_17" class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="Click Gambar Untuk Mendiagnosa"><span><center>17</center><img src="<?php echo base_url()?>desain/assets/images/gambar_gigi.PNG"></span></span>
                          <span tittle="Gigi 16" href="#" id="gigi_16" class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="Click Gambar Untuk Mendiagnosa"><span><center>16</center><img src="<?php echo base_url()?>desain/assets/images/gambar_gigi.PNG"></span></span>
                          <span tittle="Gigi 15" href="#" id="gigi_15" class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="Click Gambar Untuk Mendiagnosa"><span><center>15</center><img src="<?php echo base_url()?>desain/assets/images/gambar_gigi.PNG"></span></span>
                          <span tittle="Gigi 14" href="#" id="gigi_14" class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="Click Gambar Untuk Mendiagnosa"><span><center>14</center><img src="<?php echo base_url()?>desain/assets/images/gambar_gigi.PNG"></span></span>
                          <span tittle="Gigi 13" href="#" id="gigi_13" class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="Click Gambar Untuk Mendiagnosa"><span><center>13</center><img src="<?php echo base_url()?>desain/assets/images/gambar_gigi_2.PNG"></span></span>
                          <span tittle="Gigi 12" href="#" id="gigi_12" class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="Click Gambar Untuk Mendiagnosa"><span><center>12</center><img src="<?php echo base_url()?>desain/assets/images/gambar_gigi_2.PNG"></span></span>
                          <span tittle="Gigi 11" href="#" id="gigi_11" class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="Click Gambar Untuk Mendiagnosa"><span><center>11</center><img src="<?php echo base_url()?>desain/assets/images/gambar_gigi_2.PNG"></span></span>
                          <span>|</span>
                          <span tittle="Gigi 21" href="#" id="gigi_21" class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="Click Gambar Untuk Mendiagnosa"><span><center>21</center><img src="<?php echo base_url()?>desain/assets/images/gambar_gigi_2.PNG"></span></span>
                          <span tittle="Gigi 22" href="#" id="gigi_22" class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="Click Gambar Untuk Mendiagnosa"><span><center>22</center><img src="<?php echo base_url()?>desain/assets/images/gambar_gigi_2.PNG"></span></span>
                          <span tittle="Gigi 23" href="#" id="gigi_23" class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="Click Gambar Untuk Mendiagnosa"><span><center>23</center><img src="<?php echo base_url()?>desain/assets/images/gambar_gigi_2.PNG"></span></span>
                          <span tittle="Gigi 24" href="#" id="gigi_24" class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="Click Gambar Untuk Mendiagnosa"><span><center>24</center><img src="<?php echo base_url()?>desain/assets/images/gambar_gigi.PNG"></span></span>
                          <span tittle="Gigi 25" href="#" id="gigi_25" class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="Click Gambar Untuk Mendiagnosa"><span><center>25</center><img src="<?php echo base_url()?>desain/assets/images/gambar_gigi.PNG"></span></span>
                          <span tittle="Gigi 26" href="#" id="gigi_26" class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="Click Gambar Untuk Mendiagnosa"><span><center>26</center><img src="<?php echo base_url()?>desain/assets/images/gambar_gigi.PNG"></span></span>
                          <span tittle="Gigi 27" href="#" id="gigi_27" class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="Click Gambar Untuk Mendiagnosa"><span><center>27</center><img src="<?php echo base_url()?>desain/assets/images/gambar_gigi.PNG"></span></span>
                          <span tittle="Gigi 28" href="#" id="gigi_28" class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="Click Gambar Untuk Mendiagnosa"><span><center>28</center><img src="<?php echo base_url()?>desain/assets/images/gambar_gigi.PNG"></span></span>
                        </div>
                    </div><br>
                    <div class="col col-md-12" style="margin-left:150px;">
                      <div class="col-md-12 col">
                          <div class="col col-md-2"></div>
                          <div class="col col-md-8">
                            <span tittle="Gigi 55" href="#" id="gigi_55"  class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="Click Gambar Untuk Mendiagnosa"><span><center>55</center><img src="<?php echo base_url()?>desain/assets/images/gambar_gigi.PNG"></span></span>
                            <span tittle="Gigi 54" href="#" id="gigi_54"  class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="Click Gambar Untuk Mendiagnosa"><span><center>54</center><img src="<?php echo base_url()?>desain/assets/images/gambar_gigi.PNG"></span></span>
                            <span tittle="Gigi 53" href="#" id="gigi_53"  class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="Click Gambar Untuk Mendiagnosa"><span><center>53</center><img src="<?php echo base_url()?>desain/assets/images/gambar_gigi_2.PNG"></span></span>
                            <span tittle="Gigi 52" href="#" id="gigi_52"  class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="Click Gambar Untuk Mendiagnosa"><span><center>52</center><img src="<?php echo base_url()?>desain/assets/images/gambar_gigi_2.PNG"></span></span>
                            <span tittle="Gigi 51" href="#" id="gigi_51"  class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="Click Gambar Untuk Mendiagnosa"><span><center>51</center><img src="<?php echo base_url()?>desain/assets/images/gambar_gigi_2.PNG"></span></span>
                            <span>|</span>
                            <span tittle="Gigi 61" href="#" id="gigi_61"  class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="Click Gambar Untuk Mendiagnosa"><span><center>61</center><img src="<?php echo base_url()?>desain/assets/images/gambar_gigi_2.PNG"></span></span>
                            <span tittle="Gigi 62" href="#" id="gigi_62"  class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="Click Gambar Untuk Mendiagnosa"><span><center>62</center><img src="<?php echo base_url()?>desain/assets/images/gambar_gigi_2.PNG"></span></span>
                            <span tittle="Gigi 63" href="#" id="gigi_63"  class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="Click Gambar Untuk Mendiagnosa"><span><center>63</center><img src="<?php echo base_url()?>desain/assets/images/gambar_gigi_2.PNG"></span></span>
                            <span tittle="Gigi 64" href="#" id="gigi_64"  class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="Click Gambar Untuk Mendiagnosa"><span><center>64</center><img src="<?php echo base_url()?>desain/assets/images/gambar_gigi.PNG"></span></span>
                            <span tittle="Gigi 65" href="#" id="gigi_65"  class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="Click Gambar Untuk Mendiagnosa"><span><center>65</center><img src="<?php echo base_url()?>desain/assets/images/gambar_gigi.PNG"></span></span>
                          </div>
                          <div class="col-md-2 col"></div>
                      </div><br>
                      <div class="col-md-12 col">
                          <div class="col col-md-2"></div>
                          <div class="col col-md-8">
                            <span tittle="Gigi 85" href="#" id="gigi_85"  class="gigi" data-toggle="tooltip" data-placement="bottom" data-original-title="Click Gambar Untuk Mendiagnosa"><span><img src="<?php echo base_url()?>desain/assets/images/gambar_gigi.PNG"><center>85</center></span></span>
                            <span tittle="Gigi 84" href="#" id="gigi_84"  class="gigi" data-toggle="tooltip" data-placement="bottom" data-original-title="Click Gambar Untuk Mendiagnosa"><span><img src="<?php echo base_url()?>desain/assets/images/gambar_gigi.PNG"><center>84</center></span></span>
                            <span tittle="Gigi 83" href="#" id="gigi_83"  class="gigi" data-toggle="tooltip" data-placement="bottom" data-original-title="Click Gambar Untuk Mendiagnosa"><span><img src="<?php echo base_url()?>desain/assets/images/gambar_gigi_2.PNG"><center>83</center></span></span>
                            <span tittle="Gigi 82" href="#" id="gigi_82"  class="gigi" data-toggle="tooltip" data-placement="bottom" data-original-title="Click Gambar Untuk Mendiagnosa"><span><img src="<?php echo base_url()?>desain/assets/images/gambar_gigi_2.PNG"><center>82</center></span></span>
                            <span tittle="Gigi 81" href="#" id="gigi_81"  class="gigi" data-toggle="tooltip" data-placement="bottom" data-original-title="Click Gambar Untuk Mendiagnosa"><span><img src="<?php echo base_url()?>desain/assets/images/gambar_gigi_2.PNG"><center>81</center></span></span>
                            <span>|</span>
                            <span tittle="Gigi 71" href="#" id="gigi_71" class="gigi" data-toggle="tooltip" data-placement="bottom" data-original-title="Click Gambar Untuk Mendiagnosa"><span><img src="<?php echo base_url()?>desain/assets/images/gambar_gigi_2.PNG"><center>71</center></span></span>
                            <span tittle="Gigi 72" href="#" id="gigi_72" class="gigi" data-toggle="tooltip" data-placement="bottom" data-original-title="Click Gambar Untuk Mendiagnosa"><span><img src="<?php echo base_url()?>desain/assets/images/gambar_gigi_2.PNG"><center>72</center></span></span>
                            <span tittle="Gigi 73" href="#" id="gigi_73" class="gigi" data-toggle="tooltip" data-placement="bottom" data-original-title="Click Gambar Untuk Mendiagnosa"><span><img src="<?php echo base_url()?>desain/assets/images/gambar_gigi_2.PNG"><center>73</center></span></span>
                            <span tittle="Gigi 74" href="#" id="gigi_74" class="gigi" data-toggle="tooltip" data-placement="bottom" data-original-title="Click Gambar Untuk Mendiagnosa"><span><img src="<?php echo base_url()?>desain/assets/images/gambar_gigi.PNG"><center>74</center></span></span>
                            <span tittle="Gigi 75" href="#" id="gigi_75" class="gigi" data-toggle="tooltip" data-placement="bottom" data-original-title="Click Gambar Untuk Mendiagnosa"><span><img src="<?php echo base_url()?>desain/assets/images/gambar_gigi.PNG"><center>75</center></span></span>
                          </div>
                          <div class="col-md-2 col"></div>
                      </div><br>
                    </div>
                    <div class="col-md-12 col">
                        <div class="col col-md-12">
                          <span tittle="Gigi 48" href="#" id="gigi_48" class="gigi" data-toggle="tooltip" data-placement="bottom" data-original-title="Click Gambar Untuk Mendiagnosa"><span><img src="<?php echo base_url()?>desain/assets/images/gambar_gigi.PNG"><center>48</center></span></span>
                          <span tittle="Gigi 47" href="#" id="gigi_47" class="gigi" data-toggle="tooltip" data-placement="bottom" data-original-title="Click Gambar Untuk Mendiagnosa"><span><img src="<?php echo base_url()?>desain/assets/images/gambar_gigi.PNG"><center>47</center></span></span>
                          <span tittle="Gigi 46" href="#" id="gigi_46" class="gigi" data-toggle="tooltip" data-placement="bottom" data-original-title="Click Gambar Untuk Mendiagnosa"><span><img src="<?php echo base_url()?>desain/assets/images/gambar_gigi.PNG"><center>46</center></span></span>
                          <span tittle="Gigi 45" href="#" id="gigi_45" class="gigi" data-toggle="tooltip" data-placement="bottom" data-original-title="Click Gambar Untuk Mendiagnosa"><span><img src="<?php echo base_url()?>desain/assets/images/gambar_gigi.PNG"><center>45</center></span></span>
                          <span tittle="Gigi 44" href="#" id="gigi_44" class="gigi" data-toggle="tooltip" data-placement="bottom" data-original-title="Click Gambar Untuk Mendiagnosa"><span><img src="<?php echo base_url()?>desain/assets/images/gambar_gigi.PNG"><center>44</center></span></span>
                          <span tittle="Gigi 43" href="#" id="gigi_43" class="gigi" data-toggle="tooltip" data-placement="bottom" data-original-title="Click Gambar Untuk Mendiagnosa"><span><img src="<?php echo base_url()?>desain/assets/images/gambar_gigi_2.PNG"><center>43</center></span></span>
                          <span tittle="Gigi 42" href="#" id="gigi_42" class="gigi" data-toggle="tooltip" data-placement="bottom" data-original-title="Click Gambar Untuk Mendiagnosa"><span><img src="<?php echo base_url()?>desain/assets/images/gambar_gigi_2.PNG"><center>42</center></span></span>
                          <span tittle="Gigi 41" href="#" id="gigi_41" class="gigi" data-toggle="tooltip" data-placement="bottom" data-original-title="Click Gambar Untuk Mendiagnosa"><span><img src="<?php echo base_url()?>desain/assets/images/gambar_gigi_2.PNG"><center>41</center></span></span>
                          <span>|</span>
                          <span tittle="Gigi 31" href="#" id="gigi_31" class="gigi" data-toggle="tooltip" data-placement="bottom" data-original-title="Click Gambar Untuk Mendiagnosa"><span><img src="<?php echo base_url()?>desain/assets/images/gambar_gigi_2.PNG"><center>31</center></span></span>
                          <span tittle="Gigi 32" href="#" id="gigi_32" class="gigi" data-toggle="tooltip" data-placement="bottom" data-original-title="Click Gambar Untuk Mendiagnosa"><span><img src="<?php echo base_url()?>desain/assets/images/gambar_gigi_2.PNG"><center>32</center></span></span>
                          <span tittle="Gigi 33" href="#" id="gigi_33" class="gigi" data-toggle="tooltip" data-placement="bottom" data-original-title="Click Gambar Untuk Mendiagnosa"><span><img src="<?php echo base_url()?>desain/assets/images/gambar_gigi_2.PNG"><center>33</center></span></span>
                          <span tittle="Gigi 34" href="#" id="gigi_34" class="gigi" data-toggle="tooltip" data-placement="bottom" data-original-title="Click Gambar Untuk Mendiagnosa"><span><img src="<?php echo base_url()?>desain/assets/images/gambar_gigi.PNG"><center>34</center></span></span>
                          <span tittle="Gigi 35" href="#" id="gigi_35" class="gigi" data-toggle="tooltip" data-placement="bottom" data-original-title="Click Gambar Untuk Mendiagnosa"><span><img src="<?php echo base_url()?>desain/assets/images/gambar_gigi.PNG"><center>35</center></span></span>
                          <span tittle="Gigi 36" href="#" id="gigi_36" class="gigi" data-toggle="tooltip" data-placement="bottom" data-original-title="Click Gambar Untuk Mendiagnosa"><span><img src="<?php echo base_url()?>desain/assets/images/gambar_gigi.PNG"><center>36</center></span></span>
                          <span tittle="Gigi 37" href="#" id="gigi_37" class="gigi" data-toggle="tooltip" data-placement="bottom" data-original-title="Click Gambar Untuk Mendiagnosa"><span><img src="<?php echo base_url()?>desain/assets/images/gambar_gigi.PNG"><center>37</center></span></span>
                          <span tittle="Gigi 38" href="#" id="gigi_38" class="gigi" data-toggle="tooltip" data-placement="bottom" data-original-title="Click Gambar Untuk Mendiagnosa"><span><img src="<?php echo base_url()?>desain/assets/images/gambar_gigi.PNG"><center>38</center></span></span>
                        </div>
                    </div><br><br>
                    <div class="col col-md-12">
                      <div class="col col-md-12">
                      <div class="row form-group" id="diagnosa_gigi">
                        <!-- <select name="group" id="select" class="mdb-select colorful-select dropdown-info md-form" >
                          <option>...Pilih Group Role...</option></select> -->
                      </div>
                    </div>
                    </div>
                  </div>
                </div>
                <div class="card color-bordered-table info-bordered-table">
                  <div class="card-body card-block">
                    <div class="col col-md-12">
                      <div class="col col-md-12">
                        <div class="row form-group">
                          <div class="col-md-6">
                            <div class="col col-md-2">
                              <label class="form-control-label">Occulasi</label>
                            </div>
                            <div class="col-12 col-md-10">
                              <div class="custom-control custom-radio">
                                  <input type="radio" id="Occulasi1" name="occulasi" class="custom-control-input" value="Normal Bite" checked>
                                  <label class="custom-control-label" for="Occulasi1">Normal Bite</label>
                              </div>
                              <div class="custom-control custom-radio">
                                  <input type="radio" id="Occulasi2" name="occulasi" class="custom-control-input" value="Cross Bite">
                                  <label class="custom-control-label" for="Occulasi2">Cross Bite</label>
                              </div>
                              <div class="custom-control custom-radio">
                                  <input type="radio" id="Occulasi3" name="occulasi" class="custom-control-input" value="Steep Bite">
                                  <label class="custom-control-label" for="Occulasi3">Steep Bite</label>
                              </div>
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="col col-md-2">
                              <label class="form-control-label">Palatum</label>
                            </div>
                            <div class="col-12 col-md-10">
                              <div class="custom-control custom-radio">
                                  <input type="radio" id="Palatum1" name="palatum" class="custom-control-input" value="Dalam" checked>
                                  <label class="custom-control-label" for="Palatum1">Dalam</label>
                              </div>
                              <div class="custom-control custom-radio">
                                  <input type="radio" id="Palatum2" name="palatum" class="custom-control-input" value="Sedang">
                                  <label class="custom-control-label" for="Palatum2">Sedang</label>
                              </div>
                              <div class="custom-control custom-radio">
                                  <input type="radio" id="Palatum3" name="palatum" class="custom-control-input" value="Rendah">
                                  <label class="custom-control-label" for="Palatum3">Rendah</label>
                              </div>
                            </div>


                          </div>

                        </div>
                        <div class="row form-group">
                            <div class="col col-md-6">
                              <div class="col col-md-2">
                                <label class="form-control-label">Torus Mandibularis</label>
                              </div>
                              <div class="col-12 col-md-10">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="Bularis1" name="torus_mandibularis" class="custom-control-input" value="Tidak Ada" checked>
                                    <label class="custom-control-label" for="Bularis1">Tidak Ada</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="Bularis2" name="torus_mandibularis" class="custom-control-input" value="Sisi Kiri">
                                    <label class="custom-control-label" for="Bularis2">Sisi Kari</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="Bularis3" name="torus_mandibularis" class="custom-control-input" value="Sisi Kanan">
                                    <label class="custom-control-label" for="Bularis3">Sisi Kanan</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="Bularis4" name="torus_mandibularis" class="custom-control-input" value="Kedua Sisi">
                                    <label class="custom-control-label" for="Bularis4">Kedua Sisi</label>
                                </div>
                              </div>
                            </div>
                            <div class="col col-md-6">
                              <div class="col col-md-2">
                                <label class="form-control-label">Torus Palatinus</label>
                              </div>
                              <div class="col-12 col-md-10">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="Torus1" name="torus_palatinus" class="custom-control-input" value="Tidak Ada" checked>
                                    <label class="custom-control-label" for="Torus1">Tidak Ada</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="Torus2" name="torus_palatinus" class="custom-control-input" value="Kecil">
                                    <label class="custom-control-label" for="Torus2">Kecil</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="Torus3" name="torus_palatinus" class="custom-control-input" value="Sedang">
                                    <label class="custom-control-label" for="Torus3">Sedang</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="Torus4" name="torus_palatinus" class="custom-control-input" value="Besar">
                                    <label class="custom-control-label" for="Torus4">Besar</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="Torus5" name="torus_palatinus" class="custom-control-input" value="Multiple">
                                    <label class="custom-control-label" for="Torus5">Multiple</label>
                                </div>
                              </div>
                            </div>
                        </div>
                        <div class="row form-group">
                          <div class="col-md-12">
                            <div class="col col-md-2">
                              <label class="form-control-label">Diastema</label>
                            </div>
                            <div class="col-12 col-md-10">
                              <div class="custom-control custom-radio">
                                  <input type="radio" id="Diastema1" name="diastema" class="custom-control-input diastema" value="Tidak Ada" checked>
                                  <label class="custom-control-label" for="Diastema1">Tidak Ada</label>
                              </div>
                              <div class="custom-control custom-radio">
                                  <input type="radio" id="Diastema2" name="diastema" class="custom-control-input diastema" value="Ada">
                                  <label class="custom-control-label" for="Diastema2">Ada</label>
                              </div>

                            </div>
                            <input type="text" disabled class="form-control" id="ada_diastema" name="ada_diastema" placeholder="dijelaskan dimana dan berapa lebarnya">
                          </div>
                        </div>
                        <div class="row form-group">
                          <div class="col-md-12">
                            <div class="col col-md-2">
                              <label class="form-control-label">Gigi Anomali</label>
                            </div>
                            <div class="col-12 col-md-10">
                              <div class="custom-control custom-radio">
                                  <input type="radio" id="Anomali1" name="anomali" class="custom-control-input anomali" value="Tidak Ada" checked>
                                  <label class="custom-control-label" for="Anomali1">Tidak Ada</label>
                              </div>
                              <div class="custom-control custom-radio">
                                  <input type="radio" id="Anomali2" name="anomali" class="custom-control-input anomali" value="Ada">
                                  <label class="custom-control-label" for="Anomali2">Ada</label>
                              </div>

                            </div>
                            <input type="text" disabled class="form-control" id="ada_anomali" name="ada_anomali" placeholder="dijelaskan dimana dan berapa lebarnya">
                          </div>
                        </div>

                        <div class="row form-group">
                          <div class="col-md-12">
                            <div class="col col-md-2">
                              <label class="form-control-label">Lain lain</label>
                            </div>
                              <input type="text" class="form-control" name="lain_lain" placeholder="hal yang tidak tercakup diatas">

                          </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-4">
                              <div class="col col-md-2">
                                <label class="form-control-label">D</label>
                              </div>
                              <div class="col col-md-10">
                                <input type="number" class="form-control" name="D" placeholder="...">
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="col col-md-2">
                                <label class="form-control-label">M</label>
                              </div>
                              <div class="col col-md-10">
                                <input type="number" class="form-control" name="M" placeholder="...">
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="col col-md-2">
                                <label class="form-control-label">F</label>
                              </div>
                              <div class="col col-md-10">
                                <input type="number" class="form-control" name="F" placeholder="...">
                              </div>
                            </div>

                        </div>
                        <div class="row form-group">

                            <div class="col-md-6">
                              <div class="col col-md-8">
                                <label class="form-control-label">Jumlah Photo Diambil</label>
                              </div>
                              <div class="col col-md-4">
                                <input type="number" class="form-control" name="jumlah_photo" placeholder="...">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="col col-md-4">
                                <label class="form-control-label">Jenis Photo</label>
                              </div>
                              <div class="col col-md-8">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="jenis_photo1" name="jenis_photo" class="custom-control-input" value="Digital" checked>
                                    <label class="custom-control-label" for="jenis_photo1">Digital</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="jenis_photo2" name="jenis_photo" class="custom-control-input" value="Intraoral">
                                    <label class="custom-control-label" for="jenis_photo2">Intraoral</label>
                                </div>

                              </div>
                            </div>

                        </div>

                        <div class="row form-group">
                            <div class="col-md-6">
                              <div class="col col-md-8">
                                <label class="form-control-label">Jumlah photo rontgen yang diambil</label>
                              </div>
                              <div class="col col-md-4">
                                <input type="number" class="form-control" name="jumlah_rontgen" placeholder="...">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="col col-md-4">
                                <label class="form-control-label">Jenis Rontgen</label>
                              </div>
                              <div class="col col-md-8">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="jenis_rontgen1" name="jenis_rontgen" class="custom-control-input" value="Dental" checked>
                                    <label class="custom-control-label" for="jenis_rontgen1">Dental</label>
                                </div>
                                  <div class="custom-control custom-radio">
                                      <input type="radio" id="jenis_rontgen2" name="jenis_rontgen" class="custom-control-input" value="PA">
                                      <label class="custom-control-label" for="jenis_rontgen2">PA</label>
                                  </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="jenis_rontgen3" name="jenis_rontgen" class="custom-control-input" value="OPG">
                                        <label class="custom-control-label" for="jenis_rontgen3">OPG</label>
                                    </div>
                                      <div class="custom-control custom-radio">
                                          <input type="radio" id="jenis_rontgen4" name="jenis_rontgen" class="custom-control-input" value="Ceph">
                                          <label class="custom-control-label" for="jenis_rontgen4">Ceph</label>
                                      </div>
                            </div>
                          </div>

                        </div>

                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <?php echo $this->Core->btn_input(); ?>
              <?php echo form_close(); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
$(document).on('click','.anomali',function(){
  var id = $(this).attr('id');
  if (id=='Anomali1') {
    $("#ada_anomali").attr('disabled', true);
    $("#ada_anomali").val("");
  } else {
    $("#ada_anomali").attr('disabled', false)
    $("#ada_anomali").focus();;
  }
});
$(document).on('click','.diastema',function(){
  var id = $(this).attr('id');
  if (id=='Diastema1') {
    $("#ada_diastema").attr('disabled', true);
    $("#ada_diastema").val("");
  } else {
    $("#ada_diastema").attr('disabled', false)
    $("#ada_diastema").focus();;
  }
});
$(document).on("click",".gigi",function(){
  var id= $(this).attr('id');
  var label = $(this).attr('tittle');
  var html="";
  // alert(id);
  html+= '<div class="col col-md-2 text-right" id="label_'+id+'">'+
    '<label class="form-control-label"><h3>'+label+'</h3></label>'+
  '</div>'+
  '<div class="col-12 col-md-9" id="input_'+id+'">'+
    '<div class="">'+
    // '<select name="group" id="select" class="mdb-select colorful-select dropdown-info md-form" >'+
    //   '<option>...Pilih Group Role...</option></select>'+
      // '<input type="text" name="'+id+'" class="form-control" placeholder="diagnosa">'+
          '<select name="'+id+'" class="mdb-select'+id+' colorful-select dropdown-info" style="width: 100%">'+
      // '<select class="select2 m-b-10 select2-multiple form-control" style="width: 100%" multiple="multiple" data-placeholder="Pilih Diagnosa">'+
        '<option value="Un Erupted">Un Erupted</option>'+
        '<option value="Partial Erupted">Partial Erupted</option>'+
        '<option value="Normal">Normal</option>'+
        '<option value="Anomali">Anomali</option>'+
        '<option value="Caries">Caries</option>'+
        '<option value="Amalgam Fillings">Amalgam Fillings</option>'+
        '<option value="Full Metal Crown On Vital">Full Metal Crown On Vital</option>'+
        '<option value="Full Metal Croun On Non Vital">Full Metal Croun On Non Vital</option>'+
        '<option value="Porcelain Crown On Vital">Porcelain Crown On Vital</option>'+
        '<option value="Porcelain Crown On Non Vital">Porcelain Crown On Non Vital</option>'+
        '<option value="Venster Crouwn On Vital">Venster Crouwn On Vital</option>'+
        '<option value="Venster Crouwn On Non Vital">Venster Crouwn On Non Vital</option>'+
        '<option value="Composite Filling">Composite Filling</option>'+
        '<option value="Inlay (Metal/Composite)">Inlay (Metal/Composite)</option>'+
        '<option value="Non Vital Teeth">Non Vital Teeth</option>'+
        '<option value="Amalgam Filling On Non Vital">Amalgam Filling On Non Vital</option>'+
        '<option value="Composite Filling On Non Vital Teeth">Composite Filling On Non Vital Teeth</option>'+
        '<option value="Radix Dentis">Radix Dentis</option>'+
        '<option value="Full Metal Bridge 3 Units">Full Metal Bridge 3 Units</option>'+
        '<option value="Porcelain Bridge">Porcelain Bridge</option>'+
        '<option value="Full Metal Cantilever">Full Metal Cantilever</option>'+
        '<option value="Missing Teeth">Missing Teeth</option>'+
        '<option value="Removeable Partial Denture">Removeable Partial Denture</option>'+
      '</select>'+
    '</div>'+
  '</div>'+
  '<div class="col col-md-1" id="button_'+id+'">'+
        '<button type="button" class="btn btn-danger hapus_diagnosa" tittle="'+id+'" type="button"><i class="fa fa-trash"></i></button>'+
  '</div>';
  $("#diagnosa_gigi").append(html);
  $('.mdb-select'+id).material_select();
});
$(document).on('click','.hapus_diagnosa',function(){
  var id = $(this).attr('tittle');
  $("#label_"+id).remove();
  $("#input_"+id).remove();
  $("#button_"+id).remove();
});
</script>
