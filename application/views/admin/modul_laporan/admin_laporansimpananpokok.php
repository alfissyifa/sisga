    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark"><?= $page ;?></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><small><?= $user->username ;?></small></li>
                <li class="breadcrumb-item"><a href="<?= base_url('admin/laporanSimpananpokok')?>"><small><?= $page ;?></small></a></li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
          <?php if(validation_errors()) : ?>
            <!-- Row Note -->
            <div class="row">
              <div class="col-12">
                <div class="alert callout callout-info bg-danger" role="alert">
                  <h5><i class="fas fa-info"></i> Note:</h5>
                  <?= validation_errors(); ?>
                </div>
              </div>
              <!--/. Col -->
            </div>
          <?php endif ;?>
          <?php if($this->session->flashdata('message') == TRUE) : ?>
            <!-- Row Note -->
            <div class="row">
              <div class="col-12">
                <div class="alert callout callout-info bg-danger" role="alert">
                  <h5><i class="fas fa-info"></i> Note:</h5>
                  <?= $this->session->flashdata('message'); ?>
                </div>
              </div>
              <!--/. Col -->
            </div>
          <?php endif ;?>             
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <!--/. Row -->
          <!-- Row Form Select Tabel -->
          <div class="row">
            <div class="col-md-9">
              <!-- general form elements -->
              <div class="card card-outline card-primary">
                <div class="card-header">
                  <h3 class="card-title">Pilih Periode Tanggal</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                 
                <form role="form" action="<?php echo base_url('admin/laporansimpananpokokPdf')?>" method="post" target="blank">
                  <div class="card-body">
                    <div class="form-group">
                      <label>Periode:</label>
                      <div class="row">
                        <div class="col-md-5">
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">
                                <i class="far fa-calendar-alt"></i>
                              </span>
                            </div>
                            <input type="date" name="awal" class="form-control">
                          </div>
                          <?php echo form_error('awal', '<small class="text-danger pl-3">', '</small>');?>
                          <!-- /.input group -->
                        </div>
                        <div class="col-md-2">
                          <p class="form-control text-center">S.D</p>
                        </div>
                        <div class="col-md-5">
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">
                                <i class="far fa-calendar-alt"></i>
                              </span>
                            </div>
                            <input type="date" name="akhir" class="form-control">
                          </div>
                          <?php echo form_error('akhir', '<small class="text-danger pl-3">', '</small>');?>
                          <!-- /.input group -->
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- /.card-body -->

                  <div class="card-footer justify-content-between">
                    <a class="btn btn-sm btn-danger" href="<?= base_url('admin/laporanSimpananpokok')?>"><i class="fa fa-undo"></i>&ensp;Reset</a>
                    <button type="submit" class="btn btn-sm btn-primary float-right"><i class="fa fa-check"></i>&ensp;Submit</button>
                  </div>
                </form>
              </div>
              <!-- /.card -->
            </div>

          </div>
          <!-- Default box -->

        </section>
        <!-- /.content -->
      </div>