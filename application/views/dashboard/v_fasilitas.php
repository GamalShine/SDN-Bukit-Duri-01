<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Fasilitas
			<small>Data Fasilitas</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-12">
				
				<a href="<?php echo base_url().'dashboard/fasilitas_tambah'; ?>" class="btn btn-sm btn-primary">Tambah fasilitas</a>

				<br/>
				<br/>

				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Fasilitas</h3>
					</div>
					<div class="box-body">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th width="1%">NO</th>
									<th>Nama</th>
									<th>Gambar</th>
									<th width="10%">OPSI</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$no = 1;
								foreach($fasilitas as $f){ 
									?>
									<tr>
										<td><?php echo $no++; ?></td>
										<td><?php echo $f->fasilitas_nama; ?></td>
										<td>
											<?php if($f->fasilitas_gambar != ""){ ?>
												<img src="<?php echo base_url(); ?>gambar/fasilitas/<?php echo $f->fasilitas_gambar; ?>" style="max-width: 150px; height: auto;">
											<?php } ?>
										</td>
										<td>
											<a href="<?php echo base_url().'dashboard/fasilitas_edit/'.$f->fasilitas_id; ?>" class="btn btn-warning btn-sm"> <i class="fa fa-pencil"></i> </a>
											<a href="<?php echo base_url().'dashboard/fasilitas_hapus/'.$f->fasilitas_id; ?>" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> </a>
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
