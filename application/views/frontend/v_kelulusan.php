<div class="intro route bg-image" style="background-image: url(<?php echo base_url(); ?>assets_frontend/img/latar-bg.jpg); height: 50vh;">
  <div class="overlay-itro"></div>
  <div class="intro-content display-table">
    <div class="table-cell">
      <div class="container">
        <h1 class="intro-title mb-4">Kelulusan</h1>
      </div>
    </div>
  </div>
</div>

<br/>
<br/>
<br/>

<section class="services-mf route">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="title-box text-center">
          <h3 class="title-a">
            Cek Kelulusan
          </h3>
          <p class="subtitle-a">
            Masukkan NISN dan tanggal lahir.
          </p>
          <div class="line-mf"></div>
        </div>
      </div>
    </div>

    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="service-box">
          <div class="service-content">
            <form method="post" action="<?php echo base_url('kelulusan/cek'); ?>">
              <div class="form-group">
                <label>NISN</label>
                <input type="text" name="nisn" class="form-control" placeholder="Masukkan NISN" value="<?php echo set_value('nisn'); ?>">
                <?php echo form_error('nisn'); ?>
              </div>
              <div class="form-group">
                <label>Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="form-control" value="<?php echo set_value('tanggal_lahir'); ?>">
                <?php echo form_error('tanggal_lahir'); ?>
              </div>
              <button type="submit" class="button button-a button-big button-rouded">Cek Kelulusan</button>
            </form>
          </div>
        </div>

        <br/>

        <?php if($hasil !== null){ ?>
          <?php if($hasil){ ?>
            <div class="alert alert-success" role="alert">
              <h4 class="alert-heading">Data ditemukan</h4>
              <hr>
              <p><b>NISN</b> : <?php echo $hasil->kelulusan_nisn; ?></p>
              <p><b>Nama</b> : <?php echo $hasil->kelulusan_nama; ?></p>
              <p><b>Tanggal Lahir</b> : <?php echo date('d-m-Y', strtotime($hasil->kelulusan_tanggal_lahir)); ?></p>
              <p><b>Status</b> : <?php echo $hasil->kelulusan_status; ?></p>
              <p><b>Keterangan</b> : <?php echo $hasil->kelulusan_keterangan; ?></p>
            </div>
          <?php }else{ ?>
            <div class="alert alert-danger" role="alert">
              Data tidak ditemukan. Pastikan NISN dan tanggal lahir sudah benar.
            </div>
          <?php } ?>
        <?php } ?>

      </div>
    </div>

  </div>
</section>
