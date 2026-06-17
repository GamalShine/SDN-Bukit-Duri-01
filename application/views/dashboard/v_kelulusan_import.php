<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Kelulusan
			<small>Import Data dari Excel</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-8">
				<a href="<?php echo base_url().'dashboard/kelulusan'; ?>" class="btn btn-sm btn-default">Kembali</a>
				<a href="<?php echo base_url().'dashboard/kelulusan_template'; ?>" class="btn btn-sm btn-info">
					<i class="fa fa-download"></i> Download Template
				</a>

				<br/>
				<br/>

				<?php if(!empty($import_result) && isset($import_result['error'])){ ?>
					<div class="alert alert-danger">
						<?php echo $import_result['error']; ?>
					</div>
				<?php } ?>

				<div class="box box-default">
					<div class="box-header">
						<h3 class="box-title">Upload File Excel</h3>
					</div>
					<div class="box-body">

						<div class="callout callout-info">
							<h4>Petunjuk</h4>
							<p>Format file yang didukung: <strong>.xlsx</strong>, <strong>.xls</strong>, dan <strong>.csv</strong></p>
							<p>Urutan kolom: <strong>NISN | Nama | Tempat Lahir | Tanggal Lahir | Status</strong></p>
							<p>Tanggal lahir: <strong>DD/MM/YYYY</strong> (contoh: 06/12/2013)</p>
							<p>Status: <strong>LULUS</strong> atau <strong>TIDAK LULUS</strong></p>
							<p>Baris pertama boleh berupa header. NISN yang sudah ada di database akan dilewati.</p>
							<p>Format kolom NISN sebagai <strong>Text</strong> di Excel agar angka nol di depan tidak hilang.</p>
						</div>

						<form method="post" action="<?php echo base_url('dashboard/kelulusan_import_aksi'); ?>" enctype="multipart/form-data">
							<div class="form-group">
								<label>File Excel</label>
								<input type="file" name="file_excel" class="form-control" accept=".xlsx,.xls,.csv" required>
							</div>
							<button type="submit" class="btn btn-success">
								<i class="fa fa-upload"></i> Import Data
							</button>
						</form>

					</div>
				</div>

			</div>
		</div>

	</section>

</div>
