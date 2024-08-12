
<style>
    /* Mengatur lebar kolom pertama menjadi 25% dari lebar kontainer induknya */

    .f1-column {
      width: 10%;
    }
    .f2-column {
      width: 20%;
    }
    .f3-column {
      width: 20%;
    }
    .f4-column {
      width: 20%;
    }
    .f5-column {
      width: 20%;
    }
    .f6-column {
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
              <h6 style="margin-top:5px" class="card-title " text-align="center"><strong>DAFTAR KELOMPOK BARANG</strong></h6>
              <a class="btn btn-sm btn-outline-info float-right btn_tambah_kelompokbarang"><i class="fas fa-plus"></i>&ensp;Tambah Data</a>
              <br>
              
            </div>
            <div class="card-body">
              <!-- SEARCH FORM -->
              <div class="input-group ">
                <input class="form-control col-sm-12" name="searchkelompokbarang" id="searchkelompokbarang" type="text" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                  <button class="btn btn-primary searchButtonkelompokbarang">
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
              <table id="kelompokbarangData" class="table table-striped" style="width:100%;margin-top:5px;">
                <thead>
                  <tr>
                    <th scope="col" style="vertical-align:middle;"><center>NO</th>
                    <th scope="col" style="vertical-align:middle;"><center>KODE KELOMPOK BARANG</th>
                    <th scope="col" style="vertical-align:middle;"><center>URAIAN KELOMPOK BARANG</th>
                    <th scope="col" style="vertical-align:middle;"><center>REKENING</th>
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