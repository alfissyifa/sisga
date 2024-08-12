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
							<p style="text-align:center"><span style="font-size:18px"><span style="font-family:Times New Roman,Times,serif"><strong>LAPORAN PINJAMAN</strong></span></span></p>
							<table>
								<tr>
									<td style="width:200px"><strong>Nama Anggota</strong></td>
									<td><strong>:</strong></td>
									<td><strong><?= $nama_anggota;?></strong></td>
								</tr>
								<tr>
									<td style="width:200px"><strong>NIK</strong></td>
									<td><strong>:</strong></td>
									<td><strong><?= $nik;?></strong></td>
								</tr>
								<tr>
									<td><strong>Jumlah Pinjaman</strong></td>
									<td><strong>:</strong></td>
									<td><strong><?=number_format($jumlah_pinjaman,0,',','.')?></strong></td>
								</tr>
								<tr>
									<td><strong>Tenor</strong></td>
									<td><strong>:</strong></td>
									<td><strong><?= $tenor;?></strong></td>
								</tr>
								<tr>
									<td><strong>Jumlah Pinjaman + Bunga</strong></td>
									<td><strong>:</strong></td>
									<td><strong><?=number_format($jumlah_pinjaman_bunga,0,',','.')?></strong></td>
								</tr>
							</table>
							
							&nbsp;

							<div style="text-align:justify">
								<table border="1" cellpadding="2" cellspacing="0" style="width:100%" >
									<tbody>
										<tr style="height:40px;background:#b7b5b5;">
											<th style="text-align:center"><span style="font-size:16px;"><span style="font-family:Times New Roman,Times,serif"> No </span></span></th>
											<th style="text-align:center"><span style="font-size:16px;"><span style="font-family:Times New Roman,Times,serif">Tanggal<br>Angsuran</span></span></th>
											<th style="text-align:center"><span style="font-size:16px;"><span style="font-family:Times New Roman,Times,serif">Jumlah<br>Angsuran</span></span></th>
											<th style="text-align:center"><span style="font-size:16px;"><span style="font-family:Times New Roman,Times,serif">Jumlah<br>Angsuran + Bunga</span></span></th>
										</tr>
										<?php 
										$i=0; foreach($hasilAll as $all): $i++; ?>
										<tr>
											<td style="text-align:center"><?= $i ;?></td>
											<td style="text-align:center;"><?= date('d/m/Y', strtotime($all->tanggal)) ?></td>
											<td style="text-align:right;padding-right: 5px"><?=number_format($all->jumlah_angsuran_pokok,0,',','.')?></td>
											<td style="text-align:right;padding-right: 5px"><?=number_format($all->jumlah_angsuran,0,',','.')?></td>
										</tr>
									 <?php endforeach ;?>
									 <tr>
											<td style="text-align:center"></td>
											<td style="text-align:center;"><strong>TOTAL</strong></td>
											<td style="text-align:right;padding-right: 5px"><strong><?=number_format($tot_pinjaman,0,',','.')?></strong></td>
											<td style="text-align:right;padding-right: 5px"><strong><?=number_format($tot_pinjamanb,0,',','.')?></strong></td>
										</tr>

								</tbody>
							</table>
							<p>
							<table>
								<tr>
									<td style="width:200px"><strong>Sisa Angsuran</strong></td>
									<td><strong>:</strong></td>
									<td><strong><?=number_format($sisa_pinjaman,0,',','.')?></strong></td>
								</tr>
								<tr>
									<td><strong>Sisa Angsuran + Bunga</strong></td>
									<td><strong>:</strong></td>
									<td><strong><?=number_format($sisa_pinjamanb,0,',','.')?></strong></td>
								</tr>
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
