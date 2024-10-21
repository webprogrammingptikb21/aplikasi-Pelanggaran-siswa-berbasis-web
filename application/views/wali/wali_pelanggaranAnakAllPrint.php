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

	<p style="text-align:center"><img alt="" src="<?= base_url('assets/sips/');?>img/logo1.png" style="float:left; height:100px; width:100px " />
		<span style="font-size:20px"><span style="font-family:Times New Roman,Times,serif">PEMERINTAH KABUPATEN WONOSOBO
			<img class="hidden" alt="" src="<?= base_url('assets/sips/');?>img/logo1.png " style="float:right; height:100px; width:100px; " /><br />
			DINAS PENDIDIKAN PEMUDA DAN OLAHRAGA<br />
			<strong><?= $oneWeb->school_name ;?></strong><br />
			<span style="font-size: 16px;">Alamat : Jl. Nyi Wiro Kel. Kaliwiro Kab. Wonosobo 56364</span><br />
			<span style="font-size: 14px;">email : smkandalusia2kaliwiro@gmail.com HP : 08112888501</span></span></span></p>

			<hr style="border: 1px groove #000000; margin-top: -10px;" />
			<hr style="border: 2px groove #000000; margin-top: -5px;"/>

			<div style="padding-left: 15px; padding-right: 20px;">
				<div style="padding-left:15px; padding-right:20px">
					<p style="text-align:center"><span style="font-size:18px"><span style="font-family:Times New Roman,Times,serif"><strong>SURAT PELANGGARAN</strong></span></span></p>

					<p><span style="font-size:16px"><span style="font-family:Times New Roman,Times,serif">Data Pelanggaran Yang Telah DiLakukan Siswa:</span></span></p>

					<table border="0" cellpadding="0" cellspacing="0" style="width:100%">
						<tbody>
							<tr>
								<td style="width:170px"><span style="font-size:16px"><span style="font-family:Times New Roman,Times,serif">NISN</span></span></td>
								<td style="width:10px"><span style="font-size:16px"><span style="font-family:Times New Roman,Times,serif">:</span></span></td>
								<td><span style="font-size:16px"><span style="font-family:Times New Roman,Times,serif"><?= $hasilOne->nisn;?></span></span></td>
							</tr>
							<tr>
								<td style="width:170px"><span style="font-size:16px"><span style="font-family:Times New Roman,Times,serif">Nama Siswa</span></span></td>
								<td><span style="font-size:16px"><span style="font-family:Times New Roman,Times,serif">:</span></span></td>
								<td><span style="font-size:16px"><span style="font-family:Times New Roman,Times,serif"><?= $hasilOne->std_name;?></span></span></td>
							</tr>
							<tr>
								<td style="width:170px"><span style="font-size:16px"><span style="font-family:Times New Roman,Times,serif">Kelas</span></span></td>
								<td><span style="font-size:16px"><span style="font-family:Times New Roman,Times,serif">:</span></span></td>
								<td><span style="font-size:16px"><span style="font-family:Times New Roman,Times,serif"><?= $hasilOne->class_name;?></span></span></td>
							</tr>
							<tr>
								<td style="width:170px"><span style="font-size:16px"><span style="font-family:Times New Roman,Times,serif">Nama Orang Tua / Wali</span></span></td>
								<td><span style="font-size:16px"><span style="font-family:Times New Roman,Times,serif">:</span></span></td>
								<td><span style="font-size:16px"><span style="font-family:Times New Roman,Times,serif"><?= $hasilOne->parent_name;?></span></span></td>
							</tr>
							<tr>
								<td style="width:170px"><span style="font-size:16px"><span style="font-family:Times New Roman,Times,serif">Alamat</span></span></td>
								<td><span style="font-size:16px"><span style="font-family:Times New Roman,Times,serif">:</span></span></td>
								<td><span style="font-size:16px"><span style="font-family:Times New Roman,Times,serif"><?= $hasilOne->address;?></span></span></td>
							</tr>
							<tr>
								<td style="width:170px"><span style="font-size:16px"><span style="font-family:Times New Roman,Times,serif">No Telp / Hp </span></span></td>
								<td><span style="font-size:16px"><span style="font-family:Times New Roman,Times,serif">:</span></span></td>
								<td><span style="font-size:16px"><span style="font-family:Times New Roman,Times,serif"><?= $hasilOne->phone_number_wali;?></span></span></td>
							</tr>
						</tbody>
					</table>
					&nbsp;

					<div style="text-align:justify">
						<table border="1" cellpadding="2" cellspacing="0" style="width:100%" >
							<tbody>
								<tr>
									<th style="text-align:center"><span style="font-size:16px;"><span style="font-family:Times New Roman,Times,serif">#</span></span></th>
									<th style="text-align:center"><span style="font-size:16px;"><span style="font-family:Times New Roman,Times,serif">Nama Pelanggaran</span></span></th>
									<th style="text-align:center"><span style="font-size:16px;"><span style="font-family:Times New Roman,Times,serif">Catatan</span></span></th>
									<th style="text-align:center"><span style="font-size:16px;"><span style="font-family:Times New Roman,Times,serif">Di Laporkan Pada</span></span></th>
									<th style="text-align:center"><span style="font-size:16px;"><span style="font-family:Times New Roman,Times,serif">Point Pelanggaran</span></span></th>
								</tr>
								<?php 
								$i=0; foreach($hasilAll as $all): $i++; ?>
								<tr>
									<td style="text-align:center"><?= $i ;?></td>
									<td style="text-align:left"><?= $all->violation_name;?></td>
									<td style="text-align:left"><?= $all->note ;?></td>
									<td style="text-align:center"><?= date('d F Y', strtotime($all->reported_on)) ;?></td>
									<td style="text-align:center"><?= $all->point ;?></td>
								</tr>

							<?php endforeach ;?>

							<tr>
								<td colspan="2" rowspan="1" style="text-align:center"><span style="font-size:16px;"><span style="font-family:Times New Roman,Times,serif">Jumlah Pelanggaran</span></span></td>
								<td style="text-align:center"><?= $hasilTotal->total_pelanggaran ;?></td>
								<td style="text-align:center"><span style="font-size:16px;"><span style="font-family:Times New Roman,Times,serif">Jumlah Point</span></span></td>
								<td style="text-align:center"><?= $hasilTotal->total_point ;?></td>
							</tr>
						</tbody>
					</table>
					
					<p style="text-align:justify"><span style="font-size:16px"><span style="font-family:Times New Roman,Times,serif">Setelah Membaca dengan cermat tentang tata tertib yang berlaku di <?= $oneWeb->school_name ;?> dengan ini menyatakan :</span></span></p>

					<ol>
						<li style="text-align:justify"><span style="font-size:16px"><span style="font-family:Times New Roman,Times,serif">Saya memahami serta menerima sepenuhnya ketentuan tata tertib yang berlaku di <?= $oneWeb->school_name ;?></span></span></li>
						<li style="text-align:justify"><span style="font-size:16px"><span style="font-family:Times New Roman,Times,serif">Saya menaati dan melaksanakan tata tertib yang berlaku di <?= $oneWeb->school_name ;?> dengan sebaik-baiknnya dan penuh tanggung jawab</span></span></li>
						<li style="text-align:justify"><span style="font-size:16px"><span style="font-family:Times New Roman,Times,serif">Saya bersedia menerima dan melaksanakan sanksi-sanksi yang berlaku di <?= $oneWeb->school_name ;?>, bila saya melakukan pelanggaran tata tertib sekolah</span></span></li>
						<li style="text-align:justify"><span style="font-size:16px"><span style="font-family:Times New Roman,Times,serif">Saya berjanji untuk menghormati dan menunjung tinggi peraturan dan tata tertib yang berlaku di <?= $oneWeb->school_name ;?> demi untuk menjaga kehormatan, nama baik sekolah dan untuk kepentingan diri sendiri sebagai siswa, dimana saya menuntut ilmu</span></span></li>
						<li style="text-align:justify"><span style="font-size:16px"><span style="font-family:Times New Roman,Times,serif">Saya akan menghormati semua saran, teguran, maupun peringatan terhadap diri saya, baik yang berasal dari guru, karyawan maupun dari pihak sekolah, baik lisan maupun tertulis.</span></span></li>
					</ol>

					<div style="text-align:justify"><span style="font-size:16px"><span style="font-family:&quot;Times New Roman&quot;,&quot;serif&quot;">Demikian</span> <span style="font-family:&quot;Times New Roman&quot;,&quot;serif&quot;">pernyataan ini saya buat dengan sebenar-benarnya. Semoga dapat dipergunakan sebagaimana mestinya. Terimakasih.</span></span></div>

					<div style="text-align:justify">&nbsp;</div>

					<div style="text-align:justify">
						<table border="0" cellpadding="0" cellspacing="0" style="width:100%">
							<tbody>
								<tr>
									<td style="text-align:center; width:200px"><br />
										<span style="font-size:16px"><span style="font-family:Times New Roman,Times,serif">Orang Tua / Wali</span></span></td>
										<td>&nbsp;</td>
										<td style="width:200px">
											<p style="text-align:center"><span style="font-size:16px"><span style="font-family:Times New Roman,Times,serif">Wonosobo,<?=date('Y-m-d')?><br />
											Yang Membuat</span></span></p>
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
										<td><span style="font-size:16px"><span style="font-family:Times New Roman,Times,serif">Materai 6000,-</span></span></td>
									</tr>
									<tr>
										<td style="text-align:center"><span style="font-size:16px"><span style="font-family:Times New Roman,Times,serif"><?= $hasilOne->parent_name?></span></span></td>
										<td>&nbsp;</td>
										<td style="text-align:center"><span style="font-size:16px"><span style="font-family:Times New Roman,Times,serif"><?= $hasilOne->std_name?></span></span></td>
									</tr>
								</tbody>
							</table>

							<p>&nbsp;</p>
						</div>
					</div>

					<div class="s3gt_translate_tooltip_mini_box" id="s3gt_translate_tooltip_mini" style="background:initial !important; border-collapse:initial !important; border-radius:initial !important; border-spacing:initial !important; border:initial !important; box-sizing:initial !important; color:inherit !important; direction:ltr !important; display:initial !important; flex-direction:initial !important; font-family:X-LocaleSpecific,sans-serif,Tahoma,Helvetica !important; font-size:13px !important; font-weight:initial !important; height:initial !important; left:457px; letter-spacing:initial !important; line-height:13px !important; margin-bottom:0px; margin-left:0px; margin-right:0px; margin-top:0px; max-height:initial !important; max-width:initial !important; min-height:initial !important; min-width:initial !important; opacity:0.75; outline:initial !important; overflow-wrap:initial !important; padding:initial !important; position:absolute; table-layout:initial !important; text-align:initial !important; text-shadow:initial !important; top:95px; vertical-align:top !important; white-space:inherit !important; width:initial !important; word-break:initial !important; word-spacing:initial !important">
						<div class="s3gt_translate_tooltip_mini" id="s3gt_translate_tooltip_mini_logo" title="Translate selected text">&nbsp;</div>

						<div class="s3gt_translate_tooltip_mini" id="s3gt_translate_tooltip_mini_sound" title="Play">&nbsp;</div>

						<div class="s3gt_translate_tooltip_mini" id="s3gt_translate_tooltip_mini_copy" title="Copy text to Clipboard">&nbsp;</div>
					</div>
				</div>
			</div>

			<!-- jQuery -->
			<script src="<?= base_url('assets/AdminLTE-3.0.5/');?>plugins/jquery/jquery.min.js"></script>

		</body>
		</html>
