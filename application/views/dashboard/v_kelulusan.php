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
				
				<a href="<?php echo base_url().'dashboard/kelulusan_tambah'; ?>" class="btn btn-sm btn-primary">Tambah data kelulusan</a>

				<br/>
				<br/>

				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Kelulusan</h3>
					</div>
					<div class="box-body">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th width="1%">NO</th>
									<th>NISN</th>
									<th>Nama</th>
									<th>Tanggal Lahir</th>
									<th>Status</th>
									<th>Keterangan</th>
									<th width="10%">OPSI</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$no = 1;
								foreach($kelulusan as $k){ 
									?>
									<tr>
										<td><?php echo $no++; ?></td>
										<td><?php echo $k->kelulusan_nisn; ?></td>
										<td><?php echo $k->kelulusan_nama; ?></td>
										<td><?php echo date('d-m-Y', strtotime($k->kelulusan_tanggal_lahir)); ?></td>
										<td><?php echo $k->kelulusan_status; ?></td>
										<td><?php echo $k->kelulusan_keterangan; ?></td>
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
