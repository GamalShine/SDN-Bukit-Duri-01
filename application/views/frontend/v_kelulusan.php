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

<section class="services-mf sect-pt4 route mb-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-9">
        
        <!-- Header Text -->
        <div class="text-center mb-5">
          <i class="fa fa-graduation-cap fa-4x mb-3" style="color: #444;"></i>
          <h3 class="font-weight-bold" style="color: #333;">Cek Status Kelulusan</h3>
          <p class="text-muted lead">Silakan masukkan Nomor Induk Siswa Nasional (NISN) dan Tanggal Lahir untuk melihat pengumuman kelulusan.</p>
        </div>

        <!-- Form Card -->
        <div class="card shadow border-0 rounded mb-5" style="background-color: #fff;">
          <div class="card-body p-lg-5 p-4">
            <form method="post" action="<?php echo base_url('kelulusan/cek'); ?>">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group mb-4">
                    <label class="font-weight-bold" style="color: #444;">Nomor Induk Siswa Nasional (NISN)</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text bg-light border-right-0"><i class="fa fa-id-card-o text-muted"></i></span>
                      </div>
                      <input type="text" name="nisn" class="form-control border-left-0 form-control-lg" placeholder="Masukkan 10 digit NISN" value="<?php echo set_value('nisn'); ?>" required>
                    </div>
                    <?php echo form_error('nisn', '<small class="text-danger mt-1 d-block">', '</small>'); ?>
                  </div>
                </div>
                
                <div class="col-md-6">
                  <div class="form-group mb-4">
                    <label class="font-weight-bold" style="color: #444;">Tanggal Lahir Siswa <small class="text-muted font-weight-normal">(DD/MM/YYYY)</small></label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text bg-light border-right-0"><i class="fa fa-calendar text-muted"></i></span>
                      </div>
                      <input type="text" id="tgl_lahir_display" class="form-control border-left-0 form-control-lg" placeholder="DD/MM/YYYY" maxlength="10" required>
                      <input type="hidden" name="tanggal_lahir" id="tgl_lahir_value" value="<?php echo set_value('tanggal_lahir'); ?>">
                    </div>
                    <?php echo form_error('tanggal_lahir', '<small class="text-danger mt-1 d-block">', '</small>'); ?>
                  </div>
                </div>
              </div>

              <div class="text-center mt-3">
                <button type="submit" class="btn text-white btn-lg px-5 py-3 text-uppercase font-weight-bold" style="border-radius: 50px; letter-spacing: 1px; background-color: #444;">
                  <i class="fa fa-search mr-2"></i> Periksa Kelulusan
                </button>
              </div>
            </form>

            <script>
            // Auto-format DD/MM/YYYY as user types
            document.getElementById('tgl_lahir_display').addEventListener('input', function() {
              var val = this.value.replace(/\D/g, '');
              if (val.length >= 3 && val.length <= 4) val = val.slice(0,2) + '/' + val.slice(2);
              else if (val.length >= 5) val = val.slice(0,2) + '/' + val.slice(2,4) + '/' + val.slice(4,8);
              this.value = val;
            });

            // Restore display from hidden value on page load (after form submit)
            (function() {
              var hidden = document.getElementById('tgl_lahir_value').value;
              if (hidden) {
                var parts = hidden.split('-');
                if (parts.length === 3) {
                  document.getElementById('tgl_lahir_display').value = parts[2] + '/' + parts[1] + '/' + parts[0];
                }
              }
            })();

            // Convert DD/MM/YYYY -> YYYY-MM-DD before submit
            document.querySelector('form').addEventListener('submit', function(e) {
              var display = document.getElementById('tgl_lahir_display').value;
              var parts = display.split('/');
              if (parts.length === 3 && parts[0].length === 2 && parts[1].length === 2 && parts[2].length === 4) {
                document.getElementById('tgl_lahir_value').value = parts[2] + '-' + parts[1] + '-' + parts[0];
              } else {
                e.preventDefault();
                alert('Format tanggal harus DD/MM/YYYY, contoh: 06/12/2013');
              }
            });
            </script>
          </div>
        </div>

        <!-- Result Card -->
        <?php if($hasil !== null){ ?>
          <?php if($hasil){ ?>
            <!-- Menentukan warna badge berdasarkan status kelulusan (case insensitive) -->
            <?php 
              $status_lower = strtolower($hasil->kelulusan_status);
              if (strpos($status_lower, 'tidak') !== false) {
                  $badge_class = 'badge-danger';
                  $border_class = 'border-danger';
                  $icon = 'fa-times-circle text-danger';
              } else if (strpos($status_lower, 'lulus') !== false) {
                  $badge_class = 'badge-success';
                  $border_class = 'border-success';
                  $icon = 'fa-check-circle text-success';
              } else {
                  $badge_class = 'badge-secondary';
                  $border_class = 'border-secondary';
                  $icon = 'fa-info-circle text-secondary';
              }
            ?>
            <div class="card shadow border-0 rounded" style="border-top: 5px solid <?php echo ($border_class == 'border-danger' ? '#dc3545' : ($border_class == 'border-success' ? '#28a745' : '#6c757d')); ?> !important;">
              <div class="card-body p-lg-5 p-4">
                <div class="text-center mb-4">
                  <i class="fa <?php echo $icon; ?> fa-4x mb-3"></i>
                  <h3 class="font-weight-bold">Hasil Pengumuman Ditemukan</h3>
                </div>
                
                <div class="bg-light p-4 rounded mb-4 text-center border">
                  <h5 class="text-muted mb-2">Status Kelulusan</h5>
                  <h1 class="display-4 font-weight-bold text-uppercase mb-0"><span class="badge <?php echo $badge_class; ?> px-4 py-2" style="font-size: 2rem;"><?php echo $hasil->kelulusan_status; ?></span></h1>
                </div>

                <div class="table-responsive mt-4">
                  <table class="table table-borderless table-striped mb-0">
                    <tbody>
                      <tr>
                        <th width="35%" class="text-secondary align-middle">Nama Lengkap</th>
                        <td width="5%" class="align-middle">:</td>
                        <td class="font-weight-bold align-middle" style="font-size: 1.15rem; color: #333;"><?php echo $hasil->kelulusan_nama; ?></td>
                      </tr>
                      <tr>
                        <th class="text-secondary align-middle">NISN</th>
                        <td class="align-middle">:</td>
                        <td class="font-weight-bold align-middle" style="font-size: 1.15rem; color: #333;"><?php echo $hasil->kelulusan_nisn; ?></td>
                      </tr>
                      <tr>
                        <th class="text-secondary align-middle">Tempat & Tanggal Lahir</th>
                        <td class="align-middle">:</td>
                        <td class="font-weight-bold align-middle" style="font-size: 1.15rem; color: #333;">
                          <?php 
                            $bulan = array(
                              1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 5 => 'Mei', 6 => 'Juni',
                              7 => 'Juli', 8 => 'Agustus', 9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
                            );
                            $time = strtotime($hasil->kelulusan_tanggal_lahir);
                            $tgl_lahir = date('j', $time) . ' ' . $bulan[(int)date('m', $time)] . ' ' . date('Y', $time);
                            echo $hasil->kelulusan_tempat_lahir . ', ' . $tgl_lahir;
                          ?>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          <?php }else{ ?>
            <div class="card shadow border-0 rounded" style="border-top: 5px solid #dc3545 !important;">
              <div class="card-body p-5 text-center">
                <i class="fa fa-exclamation-triangle fa-4x text-danger mb-4"></i>
                <h4 class="font-weight-bold text-danger mb-3">Data Tidak Ditemukan!</h4>
                <p class="text-muted lead mb-0">Maaf, kami tidak dapat menemukan data kelulusan dengan NISN dan Tanggal Lahir tersebut. Mohon periksa kembali inputan Anda.</p>
              </div>
            </div>
          <?php } ?>
        <?php } ?>

      </div>
    </div>
  </div>
</section>
