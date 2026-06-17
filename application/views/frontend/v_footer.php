<!--/ Section Contact-Footer Star /-->
<section class="paralax-mf footer-paralax bg-image sect-mt4 route"
  style="background-image: url(<?php echo base_url(); ?>assets_frontend/img/overlay-bg.jpg)">
  <div class="overlay-mf"></div>

  <footer>
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="copyright-box">
            <div class="socials">
              <ul>
                <?php if(!empty($pengaturan->link_instagram)){ ?>
                <li><a href="<?php echo $pengaturan->link_instagram; ?>" target="_blank"><span class="ico-circle"><i
                        class="ion-social-instagram"></i></span></a></li>
                <?php } ?>
                <?php if(!empty($pengaturan->link_youtube)){ ?>
                <li><a href="<?php echo $pengaturan->link_youtube; ?>" target="_blank"><span class="ico-circle"><i
                        class="ion-social-youtube"></i></span></a></li>
                <?php } ?>
                <?php if(!empty($pengaturan->link_tiktok)){ ?>
                <li><a href="<?php echo $pengaturan->link_tiktok; ?>" target="_blank"><span class="ico-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" style="width: 0.8em; height: 0.8em; fill: currentColor; vertical-align: middle; margin-top: -4px;"><path d="M448,209.91a210.06,210.06,0,0,1-122.77-39.25V349.38A162.55,162.55,0,1,1,185,188.31V278.2a74.62,74.62,0,1,0,52.23,71.18V0l88,0a121.18,121.18,0,0,0,1.86,22.17h0A122.18,122.18,0,0,0,381,102.39a121.43,121.43,0,0,0,67,20.14Z"/></svg>
                        </span></a></li>
                <?php } ?>
              </ul>
            </div>
            <p class="copyright">&copy; Copyright <strong><?php echo $pengaturan->nama ?></strong>. All Rights Reserved
            </p>
            <div class="credits">
              Designed by <a href="https://unpam.ac.id/">Nisa Unpam</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>
</section>
<!--/ Section Contact-footer End /-->

<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
<div id="preloader"></div>

<!-- JavaScript Libraries -->
<script src="<?php echo base_url(); ?>assets_frontend/lib/jquery/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets_frontend/lib/jquery/jquery-migrate.min.js"></script>
<script src="<?php echo base_url(); ?>assets_frontend/lib/popper/popper.min.js"></script>
<script src="<?php echo base_url(); ?>assets_frontend/lib/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets_frontend/lib/easing/easing.min.js"></script>
<script src="<?php echo base_url(); ?>assets_frontend/lib/counterup/jquery.waypoints.min.js"></script>
<script src="<?php echo base_url(); ?>assets_frontend/lib/counterup/jquery.counterup.js"></script>
<script src="<?php echo base_url(); ?>assets_frontend/lib/owlcarousel/owl.carousel.min.js"></script>
<script src="<?php echo base_url(); ?>assets_frontend/lib/lightbox/js/lightbox.min.js"></script>
<script src="<?php echo base_url(); ?>assets_frontend/lib/typed/typed.min.js"></script>
<!-- Contact Form JavaScript File -->
<script src="<?php echo base_url(); ?>assets_frontend/contactform/contactform.js"></script>

<!-- Template Main Javascript File -->
<script src="<?php echo base_url(); ?>assets_frontend/js/main.js"></script>

</body>

</html>