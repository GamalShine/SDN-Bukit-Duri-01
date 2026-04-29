<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Fasilitas
			<small>Tambah Fasilitas</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-6">
				<a href="<?php echo base_url().'dashboard/fasilitas'; ?>" class="btn btn-sm btn-primary">Kembali</a>
				
				<br/>
				<br/>

				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Fasilitas</h3>
					</div>
					<div class="box-body">
						<?php if(isset($gambar_error)){ echo $gambar_error; } ?>
						
						<form method="post" enctype="multipart/form-data" action="<?php echo base_url('dashboard/fasilitas_aksi') ?>">
							<div class="box-body">
								<div class="form-group">
									<label>Nama</label>
									<input type="text" name="nama" class="form-control" placeholder="Masukkan nama fasilitas .." value="<?php echo set_value('nama'); ?>">
									<?php echo form_error('nama'); ?>
								</div>
								<div class="form-group">
									<label>Gambar</label>
									<input type="file" name="gambar" class="form-control">
									<?php echo form_error('gambar'); ?>
								</div>
							</div>

							<div class="box-footer">
								<input type="submit" class="btn btn-success" value="Simpan">
							</div>
						</form>

					</div>
				</div>

			</div>
		</div>

	</section>

</div>
