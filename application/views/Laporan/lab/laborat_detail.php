
<?php
          // ob_start();
          $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
          $pdf->AddPage('P');
          $i=0;
          $tupel = array(
            'OZO' => "Poli Ozon",
            'UMU' => "Poli Umum",
            'IGD' => "Unit Gawat Darurat",
            'OBG' => "Poli Obgyn",
            'INT' => "Poli Internis",
            'GIG' => "Poli Gigi",
            'RANAP' => "Rawat Inap"
          );
          $total = 0;
          $html='<h1 align="center">Rumah Sakit Utama Husada</h1><h4 align="center">Jl. Manggar No.134, Tegalsari, Ambulu,</h4><h4 align="center">
                Kabupaten Jember, Jawa Timur</h4><h4 align="center">
                (68172)</h4>&nbsp;&nbsp;<h2 align="center">LAPORAN KUNJUNGAN LABORAT PER POLI</h2>
                  <p>DARI TGL: '.$mulai.' S/D TGL: '.$sampai.'</p>
                  <table cellspacing="1" border="1" bgcolor="#666666" cellpadding="2">
                      <tr bgcolor="#ffffff">
                          <th width="15%" align="center">NO</th>
                          <th width="20%" align="center">No RM</th>
                          <th width="45%" >Nama Pasien</th>
                          <th width="20%" align="center">Unit</th>
                      </tr>';
          foreach ($laborat as $value)
              {
                  $i++;
                  // $total += $value->jumlah;
                  $html.='<tr bgcolor="#ffffff">
                          <td align="center">'.$i.'</td>
                          <td align="center">'.$value->no_rm.'</td>
                          <td align="center">'.$value->namapasien.'</td>
                          <td align="center">'.$tupel[$value->unit_layanan].'</td>
                      </tr>';

              }
          $html.='</table>';
          $pdf->writeHTML($html, true, false, true, false, '');
          ob_end_clean();
          $pdf->Output('laporan_kunjungan_laborat'.$sampai.'.pdf', 'I');
?>
