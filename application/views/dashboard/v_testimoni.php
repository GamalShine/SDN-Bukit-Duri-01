<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Testimoni
			<small>Data Testimoni Homepage</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-12">
				
				<a href="<?php echo base_url().'dashboard/testimoni_tambah'; ?>" class="btn btn-sm btn-default">Tambah testimoni</a>

				<br/>
				<br/>

				<div class="box box-default">
					<div class="box-header">
						<h3 class="box-title">Testimoni</h3>
					</div>
					<div class="box-body">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th width="1%">URUTAN</th>
									<th>Nama</th>
									<th>Isi Testimoni</th>
									<th>Foto</th>
									<th width="10%">OPSI</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($testimoni as $t){ ?>
									<tr>
										<td><?php echo $t->testimoni_urutan; ?></td>
										<td><?php echo $t->testimoni_nama; ?></td>
										<td><?php echo character_limiter($t->testimoni_isi, 120); ?></td>
										<td>
											<?php if($t->testimoni_foto != ""){ ?>
												<img src="<?php echo base_url(); ?>gambar/testimoni/<?php echo $t->testimoni_foto; ?>" style="max-width: 80px; height: 80px; object-fit: cover; border-radius: 50%;">
											<?php } ?>
										</td>
										<td>
											<a href="<?php echo base_url().'dashboard/testimoni_edit/'.$t->testimoni_id; ?>" class="btn btn-warning btn-sm"> <i class="fa fa-pencil"></i> </a>
											<a href="<?php echo base_url().'dashboard/testimoni_hapus/'.$t->testimoni_id; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus testimoni ini?')"> <i class="fa fa-trash"></i> </a>
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
