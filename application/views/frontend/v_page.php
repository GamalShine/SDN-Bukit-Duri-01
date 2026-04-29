<!--/ Intro Skew Star /-->
<div class="intro route bg-image" style="background-image: url(<?php echo base_url(); ?>assets_frontend/img/latar-bg.jpg); height: 50vh;">
  <div class="overlay-itro"></div>
  <div class="intro-content display-table">
    <div class="table-cell">
      <div class="container">
        <?php foreach($halaman as $h){ ?>
          <h2 class="intro-title mb-4"><?php echo $h->halaman_judul ?></h2>
        <?php } ?>
      </div>
    </div>
  </div>
</div>
<!--/ Intro Skew End /-->

<!--/ Section Blog-Single Star /-->

<section class="blog-wrapper sect-pt4" id="blog">
  <div class="container">
    <div class="row">
      <div class="col-md-12">

        <?php if(count($halaman) == 0){ ?>
          <center>
            <h3 class="mt-5 mb-5">Halaman Ini Tidak Ditemukan.</h3>
          </center>
        <?php } ?>

        <?php foreach($halaman as $a){ ?>

          <div class="post-box">
            
            <div class="post-meta">
              <center>
                <h1 class="article-title"><?php echo $a->halaman_judul ?></h1>
              </center>
              <br/>
              <br/>
            </div>
            <div class="article-content">
              <?php echo $a->halaman_konten ?>

              <?php if($a->halaman_slug == 'tentang'){ ?>
              <div class="mt-5">
                <div class="embed-responsive embed-responsive-16by9">
                  <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/hZPIqJDOB6w" allowfullscreen></iframe>
                </div>
              </div>
              <?php } ?>

            </div>
          </div>
        <?php } ?>
      </div>

    </div>
  </div>
</section>
  <!--/ Section Blog-Single End /-->