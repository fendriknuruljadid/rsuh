
<?php
          // ob_start();
          $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
          $pdf->AddPage('L');
          $i=0;
          $html='<h1 align="center">Rumah Sakit Utama Husada</h1><h4 align="center">Jl. Manggar No.134, Tegalsari, Ambulu,</h4><h4 align="center">
                Kabupaten Jember, Jawa Timur</h4><h4 align="center">
                (68172)</h4>&nbsp;&nbsp;<h2 align="center">LAPORAN 10 BESAR KESAKITAN</h2>
                  <p>DARI TGL: '.$mulai.' S/D TGL: '.$sampai.'</p>
                  <table cellspacing="1" border="1" bgcolor="#666666" cellpadding="2">
                      <tr bgcolor="#ffffff">
                          <th width="5%" align="center">KODE</th>
                          <th width="45%" align="center">JENIS PENYAKIT</th>
                          <th width="10%" align="center">Tanpa st B/L</th>
                          <th width="10%" align="center">B</th>
                          <th width="10%" align="center">L</th>
                          <th width="10%" align="center">TOTAL</th>
                      </tr>';
          foreach ($kesakitan as $value)
              {
                  $i++;
                  $html.='<tr bgcolor="#ffffff">
                          <td align="center">'.$value['kode'].'</td>
                          <td align="left">'.$value['nama'].'</td>
                          <td align="center">'.$value['no_sts'].'</td>
                          <td align="center">'.$value['baru'].'</td>
                          <td align="center">'.$value['lama'].'</td>
                          <td align="center">'.$value['total'].'</td>
                      </tr>';

              }
          $html.='</table>';
          $pdf->writeHTML($html, true, false, true, false, '');
          ob_end_clean();
          $pdf->Output('laporan_kesakitan_'.$sampai.'.pdf', 'I');
?>
