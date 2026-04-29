<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Kelulusan
			<small>Edit Data Kelulusan</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-6">
				<a href="<?php echo base_url().'dashboard/kelulusan'; ?>" class="btn btn-sm btn-primary">Kembali</a>
				
				<br/>
				<br/>

				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Kelulusan</h3>
					</div>
					<div class="box-body">
						
						<?php foreach($kelulusan as $k){ ?>

							<form method="post" action="<?php echo base_url('dashboard/kelulusan_update') ?>">
								<div class="box-body">
									<div class="form-group">
										<label>NISN</label>
										<input type="hidden" name="id" value="<?php echo $k->kelulusan_id; ?>">
										<input type="text" name="nisn" class="form-control" placeholder="Masukkan NISN .." value="<?php echo $k->kelulusan_nisn; ?>">
										<?php echo form_error('nisn'); ?>
									</div>
									<div class="form-group">
										<label>Nama</label>
										<input type="text" name="nama" class="form-control" placeholder="Masukkan nama .." value="<?php echo $k->kelulusan_nama; ?>">
										<?php echo form_error('nama'); ?>
									</div>
									<div class="form-group">
										<label>Tanggal Lahir</label>
										<input type="date" name="tanggal_lahir" class="form-control" value="<?php echo $k->kelulusan_tanggal_lahir; ?>">
										<?php echo form_error('tanggal_lahir'); ?>
									</div>
									<div class="form-group">
										<label>Status</label>
										<select class="form-control" name="status">
											<option value="">- Pilih Status -</option>
											<option <?php if($k->kelulusan_status == "LULUS"){ echo "selected='selected'"; } ?> value="LULUS">LULUS</option>
											<option <?php if($k->kelulusan_status == "TIDAK LULUS"){ echo "selected='selected'"; } ?> value="TIDAK LULUS">TIDAK LULUS</option>
										</select>
										<?php echo form_error('status'); ?>
									</div>
									<div class="form-group">
										<label>Keterangan</label>
										<textarea name="keterangan" class="form-control" rows="4" placeholder="Masukkan keterangan .."><?php echo $k->kelulusan_keterangan; ?></textarea>
										<?php echo form_error('keterangan'); ?>
									</div>
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
