<html>
<head>
	<title></title>
	<style>
		body {
			font-family: 'Times New Roman';
			margin-top: 10px;
			margin-bottom: 10px;
			margin-right: 30px;
			margin-left: 30px;
		}
		img.hidden {
			visibility: hidden;
		}
	</style>
</head>
<body onload="window.print()">

	
			<p style="text-align:center"><img alt="" src="<?= base_url('assets/');?>images/icon.png" style="float:left; height:80px; width:80px " />
				<span style="font-size:20px"><span style="font-family:Times New Roman,Times,serif"><strong>KOPERASI KARYAWAN LAJU PERDANA INDAH</strong>
					<br />
					<span style="font-size:16px">DESA MELUAI INDAH KECAMATAN CEMPAKA</span><br />
					<span style="font-size: 16px;">OKU TIMUR SUMATERA SELATAN</span></p>
					<br>
					<hr style="border: 1px groove #000000; margin-top: -10px;" />
					<hr style="border: 2px groove #000000; margin-top: -5px;"/>

					<div style="padding-left: 15px; padding-right: 20px;">
						<div style="padding-left:15px; padding-right:20px">
							<p style="text-align:center"><span style="font-size:18px"><span style="font-family:Times New Roman,Times,serif"><strong>LAPORAN SIMPANAN POKOK</strong></span></span></p>
							<p style="text-align:center"><span style="font-size:14px"><span style="font-family:Times New Roman,Times,serif">Periode tanggal : <?= date('d-m-Y', strtotime($periodea)) ?>  s.d  <?= date('d-m-Y', strtotime($periodeb)) ?></span></span></p>
							
							&nbsp;

							<div style="text-align:justify">
								<table border="1" cellpadding="2" cellspacing="0" style="width:100%" >
									<tbody>
										<tr style="height:40px;background:#b7b5b5;">
											<th style="text-align:center"><span style="font-size:16px;"><span style="font-family:Times New Roman,Times,serif"> No </span></span></th>
											<th style="text-align:center"><span style="font-size:16px;"><span style="font-family:Times New Roman,Times,serif">Tanggal<br>Simpanan Pokok</span></span></th>
											<th style="text-align:center"><span style="font-size:16px;"><span style="font-family:Times New Roman,Times,serif">Data Anggota</span></span></th>
											<th style="text-align:center"><span style="font-size:16px;"><span style="font-family:Times New Roman,Times,serif">Jumlah<br>Simpanan Pokok</span></span></th>
										</tr>
										<?php 
										$i=0; foreach($hasilAll as $all): $i++; ?>
										<tr>
											<td style="text-align:center"><?= $i ;?></td>
											<td style="text-align:center;"><?= date('d/m/Y', strtotime($all->tanggal)) ?></td>
											<td style="text-align:left;padding-left: 5px"><?= $all->nama_karyawan;?><br><?= $all->nik_karyawan;?></td>
											<td style="text-align:right;padding-right: 5px"><?=number_format($all->jumlah,0,',','.')?></td>
										</tr>

									<?php endforeach ;?>

								</tbody>
							</table>

							<p>&nbsp;</p>
						</div>

						 <div style="text-align:justify">
          <table border="0" cellpadding="0" cellspacing="0" style="width:100%">
            <tbody>
              <tr>
                <td style="text-align:center; width:200px"><br />
                  <span style="font-size:16px"><span style="font-family:Times New Roman,Times,serif"></span></span></td>
                  <td>&nbsp;</td>
                  <td style="width:200px">
                    <p style="text-align:center"><span style="font-size:16px"><span style="font-family:Times New Roman,Times,serif">Meluai Indah, <?=date('d-m-Y')?><br/>Ketua Koperasi
                    </span></span></p>
                  </td>
                </tr>
                <tr>
                  <td style="text-align:center">&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>
                    <p>&nbsp;</p>

                    <p>&nbsp;</p>
                  </td>
                </tr>
                <tr>
                  <td style="text-align:center">&nbsp;</td>
                  <td>&nbsp;</td>
                  <td style="text-align:center"> <span style="font-size:16px"><span style="font-family:Times New Roman,Times,serif">---------------------</span></span></td>
                </tr>
              </tbody>
            </table>

            <p>&nbsp;</p>
          </div>


					</div>
				</div>	

			

			<!-- jQuery -->
			<script src="<?= base_url('assets/AdminLTE-3.0.5/');?>plugins/jquery/jquery.min.js"></script>

		</body>
		</html>
