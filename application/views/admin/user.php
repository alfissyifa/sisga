
<style>
    /* Mengatur lebar kolom pertama menjadi 25% dari lebar kontainer induknya */

    .f1-column {
      width: 10%;
    }
    .f2-column {
      width: 20%;
    }
    .f3-column {
      width: 25%;
    }
    .f4-column {
      width: 25%;
    }
    .f5-column {
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
            <div class="card-header">
              <h6 style="margin-top:5px" class="card-title " text-align="center"><strong>DAFTAR USER</strong></h6>
              <a class="btn btn-sm btn-outline-info float-right btn_tambah_user"><i class="fas fa-plus"></i>&ensp;Tambah Data</a>
              <br>
              
            </div>
            <div class="card-body">
              <!-- SEARCH FORM -->
              


              <div class="input-group ">
                <input class="form-control col-sm-12" name="searchuser" id="searchuser" type="text" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                  <button class="btn btn-primary searchButtonuser">
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
              <table id="userData" class="table table-striped" style="width:100%;margin-top:5px;">
                <thead>
                  <tr>
                    <th scope="col" style="vertical-align:middle;"><center>NO</th>
                    <th scope="col" style="vertical-align:middle;"><center>USERNAME</th>
                    <th scope="col" style="vertical-align:middle;"><center>NAMA LENGKAP</th>
                    <th scope="col" style="vertical-align:middle;"><center>INSTANSI</th>
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
      <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document" style="width: 95%;box-shadow: inset 1px 1px 1px 1px black, 1px 1px 5px 1px black;border-radius:5px">

        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="labelform" name="labelform"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <!-- Form untuk input user -->
            <form id="userForm" enctype="multipart/form-data">
              <div class="form-group">
                <div class="row">
                  <div class="col-md-4">  
                      <label class="col-form-label">NAMA LENGKAP</label>
                    </div>
                    <div class="col-md-8">  
                        <input type="hidden" class="form-control" id="id" name="id">
                        <input type="text" name="full_name" class="form-control" id="full_name" required>
                    </div>
                </div>
              </div>

              <div class="form-group">
                <div class="row">
                  <div class="col-md-4">  
                      <label class="col-form-label">EMAIL</label>
                    </div>
                    <div class="col-md-8">  
                        <input type="text" name="email" class="form-control" id="email" required>
                    </div>
                </div>
              </div>

              <div class="form-group">
                <div class="row">
                  <div class="col-md-4">  
                      <label class="col-form-label">USERNAME</label>
                    </div>
                    <div class="col-md-8">  
                        <input type="hidden" name="username_a" class="form-control" id="username_a">
                        <input type="text" name="username" class="form-control" id="username" required>
                    </div>
                </div>
              </div>

              <div class="form-group">
                <div class="row">
                  <div class="col-md-4">  
                      <label class="col-form-label">PASSWORD</label>
                    </div>
                    <div class="col-md-8">  
                        <input type="text" name="password" class="form-control" id="password">
                    </div>
                </div>
              </div>

              <div class="form-group">
                <div class="row">
                  <div class="col-md-4">  
                      <label class="col-form-label">INSTANSI</label>
                    </div>
                    <div class="col-md-8">  
                        <input type="text" name="instansi" class="form-control" id="instansi" required>
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