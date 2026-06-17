<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Testimoni
			<small>Tambah Testimoni</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-8">
				<a href="<?php echo base_url().'dashboard/testimoni'; ?>" class="btn btn-sm btn-default">Kembali</a>
				
				<br/>
				<br/>

				<div class="box box-default">
					<div class="box-header">
						<h3 class="box-title">Testimoni</h3>
					</div>
					<div class="box-body">
						<?php if(isset($foto_error)){ echo $foto_error; } ?>
						
						<form method="post" enctype="multipart/form-data" action="<?php echo base_url('dashboard/testimoni_aksi') ?>">
							<div class="box-body">
								<div class="form-group">
									<label>Nama</label>
									<input type="text" name="nama" class="form-control" placeholder="Masukkan nama .." value="<?php echo set_value('nama'); ?>">
									<?php echo form_error('nama'); ?>
								</div>
								<div class="form-group">
									<label>Isi Testimoni</label>
									<textarea name="isi" class="form-control" rows="5" placeholder="Masukkan isi testimoni .."><?php echo set_value('isi'); ?></textarea>
									<?php echo form_error('isi'); ?>
								</div>
								<div class="form-group">
									<label>Urutan Tampil</label>
									<input type="number" name="urutan" class="form-control" placeholder="1" value="<?php echo set_value('urutan', '1'); ?>" min="1">
									<small class="text-muted">Angka lebih kecil tampil lebih dulu di homepage.</small>
									<?php echo form_error('urutan'); ?>
								</div>
								<div class="form-group">
									<label>Foto Profil</label>
									<input type="file" name="foto" class="form-control" accept="image/*">
									<small class="text-muted">Foto bulat di slider testimoni. Disarankan gambar persegi.</small>
									<?php echo form_error('foto'); ?>
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
