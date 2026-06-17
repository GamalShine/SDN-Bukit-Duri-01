<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Kelulusan
			<small>Tambah Data Kelulusan</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-6">
				<a href="<?php echo base_url().'dashboard/kelulusan'; ?>" class="btn btn-sm btn-default">Kembali</a>
				
				<br/>
				<br/>

				<div class="box box-default">
					<div class="box-header">
						<h3 class="box-title">Kelulusan</h3>
					</div>
					<div class="box-body">
						
						<form method="post" action="<?php echo base_url('dashboard/kelulusan_aksi') ?>">
							<div class="box-body">
								<div class="form-group">
									<label>NISN</label>
									<input type="text" name="nisn" class="form-control" placeholder="Masukkan NISN .." value="<?php echo set_value('nisn'); ?>">
									<?php echo form_error('nisn'); ?>
								</div>
								<div class="form-group">
									<label>Nama</label>
									<input type="text" name="nama" class="form-control" placeholder="Masukkan nama .." value="<?php echo set_value('nama'); ?>">
									<?php echo form_error('nama'); ?>
								</div>
								<div class="form-group">
									<label>Tempat Lahir</label>
									<input type="text" name="tempat_lahir" class="form-control" placeholder="Masukkan tempat lahir .." value="<?php echo set_value('tempat_lahir'); ?>">
									<?php echo form_error('tempat_lahir'); ?>
								</div>
								<div class="form-group">
									<label>Tanggal Lahir <small class="text-muted">(DD/MM/YYYY)</small></label>
									<input type="text" id="tgl_tambah_display" class="form-control" placeholder="DD/MM/YYYY" maxlength="10">
									<input type="hidden" name="tanggal_lahir" id="tgl_tambah_value" value="<?php echo set_value('tanggal_lahir'); ?>">
									<?php echo form_error('tanggal_lahir'); ?>
								</div>
								<div class="form-group">
									<label>Status</label>
									<select class="form-control" name="status">
										<option value="">- Pilih Status -</option>
										<option <?php if(set_value('status') == "LULUS"){ echo "selected='selected'"; } ?> value="LULUS">LULUS</option>
										<option <?php if(set_value('status') == "TIDAK LULUS"){ echo "selected='selected'"; } ?> value="TIDAK LULUS">TIDAK LULUS</option>
									</select>
									<?php echo form_error('status'); ?>
								</div>
							</div>

							<div class="box-footer">
								<input type="submit" class="btn btn-success" value="Simpan">
							</div>
						</form>

						<script>
						(function() {
							var display = document.getElementById('tgl_tambah_display');
							var hidden  = document.getElementById('tgl_tambah_value');

							// Restore display value jika ada error validasi
							if (hidden.value) {
								var p = hidden.value.split('-');
								if (p.length === 3) display.value = p[2] + '/' + p[1] + '/' + p[0];
							}

							// Auto-format saat mengetik
							display.addEventListener('input', function() {
								var v = this.value.replace(/\D/g, '');
								if (v.length >= 3 && v.length <= 4) v = v.slice(0,2) + '/' + v.slice(2);
								else if (v.length >= 5) v = v.slice(0,2) + '/' + v.slice(2,4) + '/' + v.slice(4,8);
								this.value = v;
							});

							// Konversi DD/MM/YYYY -> YYYY-MM-DD sebelum submit
							display.closest('form').addEventListener('submit', function(e) {
								var parts = display.value.split('/');
								if (parts.length === 3 && parts[0].length === 2 && parts[1].length === 2 && parts[2].length === 4) {
									hidden.value = parts[2] + '-' + parts[1] + '-' + parts[0];
								} else {
									e.preventDefault();
									alert('Format tanggal harus DD/MM/YYYY, contoh: 06/12/2013');
								}
							});
						})();
						</script>

					</div>
				</div>

			</div>
		</div>

	</section>

</div>
