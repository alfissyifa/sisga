
<style>
    /* Mengatur lebar kolom pertama menjadi 25% dari lebar kontainer induknya */

    .f1-column {
      width: 10%;
    }
    .f2-column {
      width: 70%;
    }
    .f3-column {
      width: 20%;
    }

    /* Mengubah warna ikon pada tombol Next */
    .dataTables_wrapper .dataTables_paginate .paginate_button.page-item.next .page-link {
        color: white !important; /* Warna ikon pada tombol Next */
        border:1px solid #dee2e6
    }

    /* Mengubah warna latar belakang tombol Next */
    .dataTables_wrapper .dataTables_paginate .paginate_button.page-item.next .page-link {
        background-color: #dc3545 !important; /* Warna latar belakang tombol Next */
        border:1px solid #dee2e6
    }

    /* Mengubah warna latar belakang saat tombol Next dihover */
    .dataTables_wrapper .dataTables_paginate .paginate_button.page-item.next .page-link:hover {
        background-color: #e8a7ad !important; /* Warna latar belakang saat tombol Next dihover */
        border:1px solid #dee2e6
    }

    /* Mengubah warna ikon pada tombol Next */
    .dataTables_wrapper .dataTables_paginate .paginate_button.page-item.previous .page-link {
        color: white !important; /* Warna ikon pada tombol Next */
        border:1px solid #dee2e6
    }

    /* Mengubah warna latar belakang tombol Next */
    .dataTables_wrapper .dataTables_paginate .paginate_button.page-item.previous .page-link {
        background-color: #dc3545 !important; /* Warna latar belakang tombol Next */
        border:1px solid #dee2e6
    }

    /* Mengubah warna latar belakang saat tombol Next dihover */
    .dataTables_wrapper .dataTables_paginate .paginate_button.page-item.previous .page-link:hover {
        background-color: #e8a7ad !important; /* Warna latar belakang saat tombol Next dihover */
        border:1px solid #dee2e6
    }
        .progress {
        display: none;
            width: 100%;
            background-color: #f3f3f3;
            
        }

        .progress-bar {
            width: 0;
            height: 40px;
            background-color: #4caf50;
            text-align: center;
            line-height: 40px;
            color: white;
        }
  </style>

    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
      </div>
      <!-- /.content-header -->


      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <!-- Default box -->
          <div class="card card-outline card-danger">
            <?php if ($jkategori == 0) { ?>
                <div class="card-header card-uploadkategori">
                  <form id="uploadkategori-form" method="post" enctype="multipart/form-data">
                    
                    <div class="form-group">
                      <div class="row">
                        <div class="col-md-3">  
                            <label class="col-form-label">IMPORT DATA ['xls', 'xlsx']</label>
                          </div>
                          <div class="col-md-8" style="margin-top:6px">  
                              <input type="file" name="file" required>
                          </div>
                      </div>
                    </div>

                    <div class="form-group">
                       <div class="row">
                        <div class="col-md-3">  
                          </div>
                          <div class="col-md-8">  
                              <button type="submit" class="btn btn-primary btn-sm">Import Data</button>
                          </div>
                      </div>
                    </div>

                    <div class="form-group">
                       <div class="row">
                        <div class="col-md-12">  
                          <div class="progress">
                              <div class="progress-bar">0%</div>
                          </div>
                        </div>
                      </div>
                    </div>

                  </form>
                </div>
            <?php } ?>
            <div class="card-header">
              <h6 style="margin-top:5px" class="card-title " text-align="center"><strong>DAFTAR KATEGORI</strong></h6>
              <a class="btn btn-sm btn-outline-info float-right btn_tambah_kategori"><i class="fas fa-plus"></i>&ensp;Tambah Data</a>
              <br>
              
            </div>
            <div class="card-body">
              <!-- SEARCH FORM -->
              


              <div class="input-group ">
                <input class="form-control col-sm-12" name="searchkategori" id="searchkategori" type="text" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                  <button class="btn btn-primary searchButtonkategori">
                    <i class="fas fa-search"></i>
                  </button>
                  <button class="btn btn-danger searchButtonpdf">
                    <i class="fas fa-file-pdf"></i>
                  </button>
                  <button class="btn btn-success searchButtonexcel">
                    <i class="fas fa-file-excel"></i>
                  </button>
                </div>
              </div>
              <div style="overflow: auto;">
              <table id="kategoriData" class="table table-striped" style="width:100%;margin-top:5px;">
                <thead>
                  <tr>
                    <th scope="col" style="vertical-align:middle;"><center>NO</th>
                    <th scope="col" style="vertical-align:middle;"><center>KATEGORI</th>
                    <th scope="col" style="vertical-align:middle;"><center>AKSI</th>  
                  </tr>
                </thead>
              </table>
              </div>
              <!-- /.row -->
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.Container Fluid -->
      </section>
      <!-- /.content -->

    </div>
    
    <!-- Modal -->
      <div class="modal fade" id="kategoriModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document" style="width: 95%;box-shadow: inset 1px 1px 1px 1px black, 1px 1px 5px 1px black;border-radius:5px">

        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="labelform" name="labelform"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <!-- Form untuk input satuan -->
            <form id="kategoriForm" enctype="multipart/form-data">
              <div class="form-group">
                <div class="row">
                  <div class="col-md-4">  
                      <label class="col-form-label">KATEGORI</label>
                    </div>
                    <div class="col-md-8">  
                        <input type="hidden" class="form-control" id="id_kategori" name="id_kategori">
                        <input type="text" name="kategori" class="form-control" id="kategori" required>
                    </div>
                </div>
              </div>

               <div class="form-group text-right">
                <button type="submit" class="btn btn-primary btn-sm ">Submit &ensp;<i class="fas fa-arrow-right"></i></button>
            </div> 
            </form>
          </div>
        </div>
      </div>
    </div>
