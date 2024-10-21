    <div class="intro-section" id="home-section">

      <div class="slide-1" style="background-image: url('<?= base_url('assets/oneschool/');?>images/hero_1.jpg');" data-stellar-background-ratio="0.5">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-12">
              <div class="row align-items-center">
                <div class="col-lg-6 mb-4">
                  <h1  data-aos="fade-up" data-aos-delay="100">MADRASAH ALIYAH</h1>
                  <p class="mb-4"  data-aos="fade-up" data-aos-delay="200">Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime ipsa nulla sed quis rerum amet natus quas necessitatibus.</p>

                </div>

                <div class="col-lg-5 ml-auto" data-aos="fade-up" data-aos-delay="500">
                  <form action="<?= base_url('home/login');?>" method="post" class="form-box">
                    <h3 class="h4 text-black mb-4">Sign Up
										</h3>
                    <div class="form-group">
                      <input type="text" name="username" class="form-control" placeholder="Username" autocomplete="off">
                      <?php echo form_error('username', '<small class="text-danger pl-3">', '</small>');?>
                    </div>
                    <div class="form-group">
                      <input type="password" name="password" class="form-control" placeholder="Password" autocomplete="off">
                      <?php echo form_error('password', '<small class="text-danger pl-3">', '</small>');?>
                    </div>
                    <div class="form-group">
                      <input type="submit" class="btn btn-primary btn-pill" value="Sign up">
                    </div>
                  </form>

                </div>
              </div>
            </div>
            
          </div>
        </div>
      </div>
    </div>


    <div class="site-section bg-light" id="about-section">
      <div class="container">

        <div class="row">
          <div class="col-md-6">
            <h3>About Madrasah Aliyah Negeri</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Porro consectetur ut hic ipsum et veritatis corrupti. Itaque eius soluta optio dolorum temporibus in, atque, quos fugit sunt sit quaerat dicta.</p>
          </div>

          <div class="col-md-6 ml-auto">
            <h3>Links</h3>
            <ul class="list-unstyled footer-links">
              <li><a href="#home-section">Home</a></li>
              <li><a href="#about-section">About</a></li>
            </ul>
          </div>

        </div>
      </div>
    </div>
