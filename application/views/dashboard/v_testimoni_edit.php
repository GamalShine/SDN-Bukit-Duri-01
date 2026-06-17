<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Testimoni
			<small>Edit Testimoni</small>
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
						
						<?php foreach($testimoni as $t){ ?>

							<form method="post" enctype="multipart/form-data" action="<?php echo base_url('dashboard/testimoni_update') ?>">
								<div class="box-body">
									<input type="hidden" name="id" value="<?php echo $t->testimoni_id; ?>">
									<div class="form-group">
										<label>Nama</label>
										<input type="text" name="nama" class="form-control" placeholder="Masukkan nama .." value="<?php echo $t->testimoni_nama; ?>">
										<?php echo form_error('nama'); ?>
									</div>
									<div class="form-group">
										<label>Isi Testimoni</label>
										<textarea name="isi" class="form-control" rows="5" placeholder="Masukkan isi testimoni .."><?php echo $t->testimoni_isi; ?></textarea>
										<?php echo form_error('isi'); ?>
									</div>
									<div class="form-group">
										<label>Urutan Tampil</label>
										<input type="number" name="urutan" class="form-control" value="<?php echo $t->testimoni_urutan; ?>" min="1">
										<?php echo form_error('urutan'); ?>
									</div>
									<div class="form-group">
										<label>Foto Profil (kosongkan jika tidak diubah)</label>
										<input type="file" name="foto" class="form-control" accept="image/*">
									</div>

									<?php if($t->testimoni_foto != ""){ ?>
										<div class="form-group">
											<img src="<?php echo base_url(); ?>gambar/testimoni/<?php echo $t->testimoni_foto; ?>" style="max-width: 120px; height: 120px; object-fit: cover; border-radius: 50%;">
										</div>
									<?php } ?>
								</div>

								<div class="box-footer">
									<input type="submit" class="btn btn-success" value="Simpan">
								</div>
							</form>

						<?php } ?>

					</div>
				</div>

			</div>
		</div>

	</section>

</div>
