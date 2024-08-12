<style>
    .r1-column {
      width: 25%;
    }
    .r2-column {
      width: 55%;
    }
    .r3-column {
      width: 20%;
    }

    .k1-column {
      width: 70%;
    }
    .k2-column {
      width: 30%;
    }
</style>
  <!-- Logout Modal-->
  <div class="modal fade" id="logOutModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header card-outline">
          <h5 class="modal-title">Akan keluar ?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Klik "Logout" untuk keluar dari sistem informasi ini.</p>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i>&ensp;Close</button>
          <a class="btn btn-sm btn-danger" href="<?= base_url('login/logout') ;?>"><i class="fas fa-sign-out-alt"></i>&ensp;Logout</a>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>


  <div class="modal fade" id="carirekeningModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header card-outline">
          <h5 class="modal-title">DAFTAR REKENING BELANJA</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
            <div class="card-body">
              <!-- SEARCH FORM -->
              <input type="hidden" name="baris" class="form-control" id="baris">
              <input type="hidden" name="kode_brg" class="form-control" id="kode_brg">
              <div class="input-group ">
                <input class="form-control col-sm-12" name="searchcarirekening" id="searchcarirekening" type="text" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                  <button class="btn btn-primary searchButtoncarirekening">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </div>
              <div style="overflow: auto;">
              <table id="carirekeningData" class="table table-striped" style="width:100%;margin-top:5px;">
                <thead>
                  <tr>
                    <th scope="col" style="vertical-align:middle;"><center>KODE REKENING</th>
                    <th scope="col" style="vertical-align:middle;"><center>NAMA REKENING</th>
                    <th scope="col" style="vertical-align:middle;"><center>AKSI</th>  
                  </tr>
                </thead>
              </table>
              </div>
              <!-- /.row -->
            </div>
      </div>
      <!-- /.modal-content -->
    </div>

    </div>
  </div>


  <div class="modal fade" id="carikategoriModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header card-outline">
          <h5 class="modal-title">DAFTAR SATUAN</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
            <div class="card-body">
              <!-- SEARCH FORM -->
              <input type="hidden" name="baris" class="form-control" id="baris">
              <input type="hidden" name="kode_brg" class="form-control" id="kode_brg">
              <div class="input-group ">
                <input class="form-control col-sm-12" name="searchcarikategori" id="searchcarikategori" type="text" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                  <button class="btn btn-primary searchButtoncarikategori">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </div>
              <div style="overflow: auto;">
              <table id="carikategoriData" class="table table-striped" style="width:100%;margin-top:5px;">
                <thead>
                  <tr>
                    <th scope="col" style="vertical-align:middle;"><center>NAMA SATUAN</th>
                    <th scope="col" style="vertical-align:middle;"><center>AKSI</th>  
                  </tr>
                </thead>
              </table>
              </div>
              <!-- /.row -->
            </div>

      </div>
      <!-- /.modal-content -->
    </div>

    </div>
  </div>