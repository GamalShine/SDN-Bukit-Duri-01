
<div class="intro route bg-image" style="background-image: url(<?php echo base_url(); ?>assets_frontend/img/latar-bg.jpg); height: 50vh;">
  <div class="overlay-itro"></div>
  <div class="intro-content display-table">
    <div class="table-cell">
      <div class="container">
        <h2 class="intro-title mb-4">Blog</h2>
      </div>
    </div>
  </div>
</div>
<!--/ Intro Skew End /-->

<!--/ Section Blog-Single Star /-->

<section class="blog-wrapper sect-pt4" id="blog">
  <div class="container">
    <div class="row align-items-stretch">
      <!-- Kolom Kiri: Artikel -->
      <div class="col-md-8 d-flex flex-column mb-4 mb-md-0">
        <div class="blog-articles h-100">
          <?php if(count($artikel) == 0){ ?>
            <div class="card border-0 shadow-sm text-center p-5 h-100 d-flex justify-content-center">
              <h4 class="text-muted"><i class="fa fa-folder-open-o fa-3x mb-3 d-block"></i>Belum Ada Artikel</h4>
            </div>
          <?php } ?>

          <?php foreach($artikel as $a){ ?>
            <div class="card shadow-sm border-0 mb-4 rounded overflow-hidden">
              <?php if($a->artikel_sampul != ""){ ?>
                <a href="<?php echo base_url().$a->artikel_slug ?>">
                  <img src="<?php echo base_url(); ?>gambar/artikel/<?php echo $a->artikel_sampul ?>" alt="<?php echo $a->artikel_judul ?>" class="card-img-top w-100" style="max-height: 400px; object-fit: cover;">
                </a>
              <?php } ?>
              <div class="card-body p-lg-5 p-4">
                <div class="d-flex flex-wrap text-muted mb-3" style="font-size: 0.9rem;">
                  <span class="mr-4 mb-2"><i class="fa fa-user mr-1 text-primary"></i> <?php echo $a->pengguna_nama ?></span>
                  <span class="mr-4 mb-2"><i class="fa fa-folder-open mr-1 text-warning"></i> <?php echo $a->kategori_nama ?></span>
                  <span class="mb-2"><i class="fa fa-calendar mr-1 text-success"></i> <?php echo date('d M Y', strtotime($a->artikel_tanggal)) ?></span>
                </div>
                <h2 class="font-weight-bold mb-3">
                  <a href="<?php echo base_url().$a->artikel_slug ?>" style="color: #333; text-decoration: none;"><?php echo $a->artikel_judul ?></a>
                </h2>
                <p class="text-muted mb-4" style="line-height: 1.8;">
                  <?php echo substr(strip_tags($a->artikel_konten), 0, 200); ?>...
                </p>
                <a href="<?php echo base_url().$a->artikel_slug ?>" class="btn btn-outline-dark px-4 py-2 text-uppercase font-weight-bold" style="border-radius: 50px; font-size: 0.85rem;">Baca Selengkapnya <i class="fa fa-angle-right ml-1"></i></a>
              </div>
            </div>
          <?php } ?>

          <!-- Pagination -->
          <div class="mt-4">
            <?php echo $this->pagination->create_links(); ?>
          </div>
        </div>
      </div>

      <!-- Kolom Kanan: Sidebar -->
      <div class="col-md-4">
        <?php $this->load->view('frontend/v_sidebar'); ?>
      </div>
    </div>
  </div>
</section>
  <!--/ Section Blog-Single End /