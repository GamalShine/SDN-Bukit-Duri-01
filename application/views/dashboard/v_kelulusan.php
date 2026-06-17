<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Kelulusan
			<small>Data Kelulusan</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-12">
				
				<a href="<?php echo base_url().'dashboard/kelulusan_tambah'; ?>" class="btn btn-sm btn-default">Tambah data kelulusan</a>
				<a href="<?php echo base_url().'dashboard/kelulusan_import'; ?>" class="btn btn-sm btn-success">
					<i class="fa fa-upload"></i> Import Excel
				</a>
				<a href="<?php echo base_url().'dashboard/kelulusan_template'; ?>" class="btn btn-sm btn-info">
					<i class="fa fa-download"></i> Download Template
				</a>

				<br/>
				<br/>

				<?php if(!empty($import_result)){ ?>
					<?php if(isset($import_result['error'])){ ?>
						<div class="alert alert-danger"><?php echo $import_result['error']; ?></div>
					<?php } else { ?>
						<div class="alert alert-success">
							<strong>Import selesai.</strong> <?php echo (int)$import_result['success']; ?> data berhasil ditambahkan.
						</div>
						<?php if(!empty($import_result['skipped'])){ ?>
							<div class="alert alert-warning">
								<strong>NISN sudah terdaftar (<?php echo count($import_result['skipped']); ?> baris dilewati):</strong>
								<ul class="mb-0" style="margin-top:8px;">
									<?php foreach($import_result['skipped'] as $item){ ?>
										<li>Baris <?php echo $item['row']; ?> — NISN <strong><?php echo htmlspecialchars($item['nisn']); ?></strong>: <?php echo htmlspecialchars($item['message']); ?></li>
									<?php } ?>
								</ul>
							</div>
						<?php } ?>
						<?php if(!empty($import_result['failed'])){ ?>
							<div class="alert alert-danger">
								<strong>Gagal (<?php echo count($import_result['failed']); ?> baris):</strong>
								<ul class="mb-0" style="margin-top:8px;">
									<?php foreach($import_result['failed'] as $item){ ?>
										<li>Baris <?php echo $item['row']; ?>: <?php echo htmlspecialchars($item['message']); ?></li>
									<?php } ?>
								</ul>
							</div>
						<?php } ?>
					<?php } ?>
				<?php } ?>

				<div class="box box-default">
					<div class="box-header">
						<h3 class="box-title">Kelulusan</h3>
					</div>
					<div class="box-body">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th width="1%">NO</th>
									<th>NISN</th>
									<th>NAMA SISWA</th>
									<th>TEMPAT & TGL LAHIR</th>
									<th>KETERANGAN</th>
									<th width="10%">OPSI</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$bulan = array(
									1 => 'Januari',
									2 => 'Februari',
									3 => 'Maret',
									4 => 'April',
									5 => 'Mei',
									6 => 'Juni',
									7 => 'Juli',
									8 => 'Agustus',
									9 => 'September',
									10 => 'Oktober',
									11 => 'November',
									12 => 'Desember'
								);
								foreach($kelulusan as $k){ 
									$time = strtotime($k->kelulusan_tanggal_lahir);
									$tgl_lahir = date('j', $time) . ' ' . $bulan[(int)date('m', $time)] . ' ' . date('Y', $time);
									$tempat_tgl = $k->kelulusan_tempat_lahir . ', ' . $tgl_lahir;
									?>
									<tr>
										<td><?php echo $k->kelulusan_id; ?></td>
										<td><?php echo $k->kelulusan_nisn; ?></td>
										<td><?php echo $k->kelulusan_nama; ?></td>
										<td><?php echo $tempat_tgl; ?></td>
										<td>
											<?php if ($k->kelulusan_status == 'LULUS'): ?>
												<span class="label label-success">LULUS</span>
											<?php else: ?>
												<span class="label label-danger">TIDAK LULUS</span>
											<?php endif; ?>
										</td>
										<td>
											<a href="<?php echo base_url().'dashboard/kelulusan_edit/'.$k->kelulusan_id; ?>" class="btn btn-warning btn-sm"> <i class="fa fa-pencil"></i> </a>
											<a href="<?php echo base_url().'dashboard/kelulusan_hapus/'.$k->kelulusan_id; ?>" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> </a>
										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
						

					</div>
				</div>

			</div>
		</div>

	</section>

</div>
