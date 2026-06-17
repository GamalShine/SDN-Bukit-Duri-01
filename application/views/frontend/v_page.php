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
            
            <?php if($a->halaman_slug != 'tentang' && $a->halaman_slug != 'kontak-kami'){ ?>
            <div class="post-meta">
              <center>
                <h1 class="article-title"><?php echo $a->halaman_judul ?></h1>
              </center>
              <br/>
              <br/>
            </div>
            <?php } ?>
            <div class="article-content">
              <?php if($a->halaman_slug == 'tentang'){ ?>
                <div class="tentang-section mt-4" style="color: #333;">
                  <div class="row mb-5">
                    <!-- KOLOM KIRI (Lebar): Narasi Utama -->
                    <!-- Analisa: Teks naratif (sejarah, visi, penjelasan lokasi) sangat ideal untuk kolom yang lebih lebar agar mudah dibaca dan tidak terpotong-potong. -->
                    <div class="col-lg-8 pr-lg-5">
                      <h4 class="font-weight-bold text-uppercase border-bottom pb-2 mb-4" style="border-color: #444 !important;">Profil Sekolah</h4>
                      <p class="text-justify">
                        <strong>Sekolah Dasar Negeri Bukit Duri 01 Pagi</strong> (SDN Bukit Duri 01 Pagi) adalah institusi pendidikan dasar negeri yang berlokasi di Kelurahan Bukit Duri, Kecamatan Tebet, Jakarta Selatan. Didirikan pada tanggal <strong>21 Maret 1987</strong>, sekolah ini terus berkomitmen dalam melayani masyarakat setempat dengan menyediakan layanan pendidikan dasar yang berkualitas.
                      </p>
                      <p class="text-justify">
                        SDN Bukit Duri 01 Pagi memainkan peran krusial dalam infrastruktur pendidikan di kawasan Tebet. Sebagai sekolah negeri, institusi ini tidak hanya menyediakan pendidikan dasar bagi anak-anak di lingkungan sekitar, tetapi juga berkontribusi pada struktur tata kota dengan menghadirkan fasilitas pendidikan yang terjangkau di pusat kawasan permukiman.
                      </p>
                      
                      <h4 class="font-weight-bold text-uppercase border-bottom pb-2 mt-5 mb-4" style="border-color: #444 !important;">Lokasi & Lingkungan Sekitar</h4>
                      <p class="text-justify">
                        Sekolah ini terletak secara strategis di <strong>Jl. Bukit Duri Tanjakan GG. SD</strong>. Kawasan ini merupakan lingkungan lokal yang padat dan terkoneksi dengan baik di dalam wilayah Jakarta Selatan. Kecamatan Tebet sendiri dikenal mencakup berbagai zona perumahan dan komersial yang dinamis.
                      </p>
                      <p class="text-justify mb-0">
                        Keberadaan sekolah ini juga didukung oleh sinergi dengan berbagai lembaga pendidikan dasar lainnya di area terdekat, yang meliputi:
                      </p>
                      <ul class="mt-2">
                        <li>SDN Bukit Duri 03</li>
                        <li>SDN Bukit Duri 09 Pagi</li>
                        <li>SDN Bukit Duri 11 Pagi</li>
                      </ul>
                    </div>

                    <!-- KOLOM KANAN (Sempit): Informasi & Data Singkat -->
                    <!-- Analisa: Data tabular, metrik, dan daftar fasilitas sangat cocok untuk sidebar/kolom sempit karena informasinya padat, pendek, dan langsung pada intinya. -->
                    <div class="col-lg-4 mt-4 mt-lg-0">
                      <div class="card rounded-0" style="border: 1px solid #ddd; border-top: 4px solid #444;">
                        <div class="card-header bg-light font-weight-bold text-uppercase rounded-0" style="border-bottom: 1px solid #ddd;">
                          Informasi Umum
                        </div>
                        <ul class="list-group list-group-flush rounded-0" style="font-size: 15px;">
                          <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Berdiri</span>
                            <strong>21 Mar 1987</strong>
                          </li>
                          <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Akreditasi</span>
                            <strong>B (BAN-S/M)</strong>
                          </li>
                          <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Kurikulum</span>
                            <strong class="text-right">Merdeka</strong>
                          </li>
                          <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Sistem Belajar</span>
                            <strong class="text-right">5 Hari<br/><small>(Full Day)</small></strong>
                          </li>
                          <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Luas Lahan</span>
                            <strong>1.355 m²</strong>
                          </li>
                        </ul>
                      </div>

                      <div class="card rounded-0 mt-4" style="border: 1px solid #ddd; border-top: 4px solid #444;">
                        <div class="card-header bg-light font-weight-bold text-uppercase rounded-0" style="border-bottom: 1px solid #ddd;">
                          Fasilitas & Infrastruktur
                        </div>
                        <div class="card-body" style="font-size: 15px;">
                          <ul class="pl-3 mb-0 text-justify">
                            <li class="mb-2"><strong>15 Ruang Kelas</strong> fungsional.</li>
                            <li class="mb-2"><strong>1 Perpustakaan</strong> lengkap.</li>
                            <li class="mb-2">Kapasitas daya listrik <strong>13.200 watt</strong> (PLN).</li>
                            <li>Konektivitas internet via <strong>Telkom Astinet</strong>.</li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row mt-5">
                    <!-- KOLOM PENUH (Full Width): Video -->
                    <!-- Analisa: Video sangat tidak cocok ditaruh di 2 kolom (side-by-side) karena aspek rasio 16:9 akan membuatnya terlihat terlalu kecil. Format full-width di bagian bawah adalah pilihan terbaik secara UI/UX. -->
                    <div class="col-12">
                      <h4 class="font-weight-bold text-uppercase border-bottom pb-2 mb-4 text-center" style="border-color: #444 !important;">Video Profil Instansi</h4>
                      <div class="embed-responsive embed-responsive-16by9 border p-1" style="border-color: #ddd !important; background: #f9f9f9;">
                        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/hZPIqJDOB6w" allowfullscreen></iframe>
                      </div>
                    </div>
                  </div>
                </div>
              <?php } else if($a->halaman_slug == 'kontak-kami'){ ?>
                <div class="kontak-section mt-4" style="color: #333;">
                  <div class="row">
                    <!-- KOLOM KIRI: Informasi Kontak -->
                    <div class="col-md-6 pr-lg-4 mb-4">
                      <h4 class="font-weight-bold text-uppercase border-bottom pb-2 mb-4" style="border-color: #444 !important;">Informasi Kontak</h4>
                      <p class="text-justify mb-4">
                        Jika Anda memiliki pertanyaan, masukan, atau ingin mengetahui informasi lebih lanjut mengenai pendaftaran dan kegiatan di <strong>SDN Bukit Duri 01 Pagi</strong>, silakan hubungi kami melalui informasi di bawah ini. Tim kami akan dengan senang hati membantu Anda.
                      </p>
                      
                      <ul class="list-unstyled">
                        <li class="mb-4 d-flex align-items-start">
                          <div class="bg-light p-3 mr-3 border text-center d-flex align-items-center justify-content-center" style="width: 55px; height: 55px;">
                            <i class="fa fa-map-marker fa-2x text-danger"></i>
                          </div>
                          <div>
                            <h6 class="font-weight-bold mb-1 text-uppercase">Alamat Lengkap</h6>
                            <span class="text-muted">Jl. Bukit Duri Tanjakan GG. SD, Kelurahan Bukit Duri, Kecamatan Tebet, Jakarta Selatan.</span>
                          </div>
                        </li>
                        <li class="mb-4 d-flex align-items-start">
                          <div class="bg-light p-3 mr-3 border text-center d-flex align-items-center justify-content-center" style="width: 55px; height: 55px;">
                            <i class="fa fa-phone fa-2x text-success"></i>
                          </div>
                          <div>
                            <h6 class="font-weight-bold mb-1 text-uppercase">Telepon</h6>
                            <span class="text-muted">(021) - 12345678</span>
                          </div>
                        </li>
                        <li class="mb-4 d-flex align-items-start">
                          <div class="bg-light p-3 mr-3 border text-center d-flex align-items-center justify-content-center" style="width: 55px; height: 55px;">
                            <i class="fa fa-envelope fa-2x text-info"></i>
                          </div>
                          <div>
                            <h6 class="font-weight-bold mb-1 text-uppercase">Email Resmi</h6>
                            <span class="text-muted">info@sdnbukitduri01.sch.id</span>
                          </div>
                        </li>
                        <li class="mb-4 d-flex align-items-start">
                          <div class="bg-light p-3 mr-3 border text-center d-flex align-items-center justify-content-center" style="width: 55px; height: 55px;">
                            <i class="fa fa-clock-o fa-2x text-warning"></i>
                          </div>
                          <div>
                            <h6 class="font-weight-bold mb-1 text-uppercase">Jam Operasional</h6>
                            <span class="text-muted">Senin - Jumat : 06:30 - 15:00 WIB</span>
                          </div>
                        </li>
                      </ul>
                    </div>

                    <!-- KOLOM KANAN: Peta Lokasi -->
                    <div class="col-md-6 mb-4">
                      <h4 class="font-weight-bold text-uppercase border-bottom pb-2 mb-4" style="border-color: #444 !important;">Peta Lokasi Instansi</h4>
                      <div class="embed-responsive border p-1" style="background: #f9f9f9; border-color: #ddd !important; height: 420px;">
                        <iframe class="embed-responsive-item" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.2736184517336!2d106.85233631526463!3d-6.227607995491953!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f39000000000%3A0x0!2zNsKwMTMnMzkuNCJTIDEwNsKwNTEnMTYuMyJF!5e0!3m2!1sen!2sid!4v1620000000000!5m2!1sen!2sid" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                      </div>
                    </div>
                  </div>

                  <div class="row mt-4">
                    <!-- KOLOM PENUH: Form Kontak -->
                    <div class="col-12">
                      <div class="card rounded-0" style="border: 1px solid #ddd; border-top: 4px solid #444;">
                        <div class="card-header bg-light font-weight-bold text-uppercase rounded-0" style="border-bottom: 1px solid #ddd;">
                          Kirim Pesan Langsung
                        </div>
                        <div class="card-body p-4">
                          <form action="" method="post" role="form" class="contactForm">
                            <div class="row">
                              <div class="col-md-6 mb-3">
                                <div class="form-group">
                                  <label class="font-weight-bold">Nama Lengkap</label>
                                  <input type="text" name="name" class="form-control rounded-0" id="name" placeholder="Masukkan nama Anda" />
                                </div>
                              </div>
                              <div class="col-md-6 mb-3">
                                <div class="form-group">
                                  <label class="font-weight-bold">Alamat Email</label>
                                  <input type="email" class="form-control rounded-0" name="email" id="email" placeholder="contoh@email.com" />
                                </div>
                              </div>
                              <div class="col-md-12 mb-3">
                                <div class="form-group">
                                  <label class="font-weight-bold">Subjek Pesan</label>
                                  <input type="text" class="form-control rounded-0" name="subject" id="subject" placeholder="Subjek" />
                                </div>
                              </div>
                              <div class="col-md-12 mb-3">
                                <div class="form-group">
                                  <label class="font-weight-bold">Pesan Anda</label>
                                  <textarea class="form-control rounded-0" name="message" rows="5" placeholder="Tuliskan isi pesan Anda di sini..."></textarea>
                                </div>
                              </div>
                              <div class="col-md-12 text-center mt-2">
                                <button type="button" class="btn text-white rounded-0 px-5 py-2 font-weight-bold text-uppercase" style="background-color: #444;">Kirim Pesan</button>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php } else { ?>
                <?php echo $a->halaman_konten ?>
              <?php } ?>

            </div>
          </div>
        <?php } ?>
      </div>

    </div>
  </div>
</section>
  <!--/ Section Blog-Single End /-->