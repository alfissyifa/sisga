<style>
  .form-box {
    text-align: center;
  }
  .icon-container {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
  }
  .icon-container i {
    position: absolute;
    left: 10px;
    top: 50%;
    transform: translateY(-50%);
    color: #463f3f;
  }
  .form-group {
    position: relative;
    margin-bottom: 15px;
  }
  .form-group input {
    width: 100%;
    padding-left: 30px; /* Extra padding for icon */
    border-radius: 10px;
  }
  .show-hide-btn {
    position: absolute;
    right: 35px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: #6c757d;
    cursor: pointer;
  }
</style>

    <div class="intro-section" id="home-section">

      <div class="slide-1" style="background-image: url('<?= base_url('assets/');?>images/login.jpg');" data-stellar-background-ratio="0.2">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="row align-items-center" style="margin-top:100px;">
                
                <div class="col-lg-2 mb-4">
                  <img src="<?= base_url('assets/');?>images/icon.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"style="opacity: .8;width:150px;">
                </div>

                <div class="col-lg-6 mb-4">
                  <h2 style="line-height:35px;margin-bottom:7px;" data-aos="fade-up" data-aos-delay="100">SELAMAT DATANG DI SISGA</h2>
                  <h3 style="line-height:35px;margin-bottom:7px;" data-aos="fade-up" data-aos-delay="100">Sistem Informasi Standar Satuan Harga</h3>
                  <h3 style="line-height:35px;margin-bottom:7px;" data-aos="fade-up" data-aos-delay="100">Kabupaten OKU TIMUR</h3>
                </div>

                <div class="col-lg-4 ml-auto" data-aos="fade-up" data-aos-delay="500">
                  <form action="<?= base_url('login/login');?>" method="post" class="form-box">
                    <h3 class="h4 text-black mb-4">Sign Up
										</h3>
                    <div class="form-group">
                      <div class="icon-container">
                        <i class="fas fa-user"></i>
                        <input style="border-radius:10px" type="text" name="username" class="form-control" placeholder="Username" autocomplete="off">
                        <?php echo form_error('username', '<small class="text-danger pl-3">', '</small>');?>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="icon-container">
                        <i class="fas fa-lock"></i>
                        <input style="border-radius:10px" type="password" name="password" id="password" class="form-control" placeholder="Password" autocomplete="off">
                        <button type="button" class="show-hide-btn" onclick="togglePassword()">
                          <i id="toggleIcon" class="fas fa-eye"></i>
                        </button>
                        <?php echo form_error('password', '<small class="text-danger pl-3">', '</small>');?>
                      </div>
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


