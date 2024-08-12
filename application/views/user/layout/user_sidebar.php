<style>
  .brand-link {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    
}

.brand-text {
    font-weight: light;
}
</style>

    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="<?= base_url('user');?>" class="brand-link">
        <img src="<?= base_url('assets/');?>images/icon.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <br>
        <span class="brand-text">Admin OPD</span>
    </a>


      <!-- Sidebar -->
      <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
           <li class="nav-item">
            <a href="<?= base_url('user')?>" class="nav-link <?php if($page == 'Dashboard'){echo 'active';} ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-item has-treeview <?php if($page == 'Usulan Harga Satuan'){echo 'active';} ?>">
            <a href="#" class="nav-link <?php if($page == 'Usulan Harga Satuan'){echo 'active';} ?>">
              <i class="nav-icon fas fa-database"></i>
              <p>
                Usulan Harga Satuan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('user/buat_usulan_baru')?>" class="nav-link <?php if($page == 'Buat Usulan Baru'){echo 'active';} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Buat Usulan Baru
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('user/draft_usulan')?>" class="nav-link <?php if($page == 'Draft Usulan'){echo 'active';} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Draft Usulan
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?= base_url('user/daftar_usulan_saya')?>" class="nav-link <?php if($page == 'Daftar Usulan Saya'){echo 'active';} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Daftar Usulan Saya
                  </p>
                </a>
              </li>

            </ul>
          </li>

          <li class="nav-item has-treeview <?php if($page == 'Referensi'){echo 'menu-open';} ?>">
            <a href="#" class="nav-link <?php if($page == 'Referensi'){echo 'active';} ?>">
              <i class="nav-icon fas fa-tasks"></i>
              <p>
                Referensi
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('user/kode_barang')?>" class="nav-link <?php if($page == 'Kode Barang'){echo 'active';} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Kode Barang
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('user/kode_rekening')?>" class="nav-link <?php if($page == 'Kode Rekening'){echo 'active';} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Kode Rekening
                  </p>
                </a>
              </li>

            </ul>
          </li>

          <li class="nav-item has-treeview <?php if($page == 'Standar Harga'){echo 'menu-open';} ?>">
            <a href="#" class="nav-link <?php if($page == 'Standar Harga'){echo 'active';} ?>">
              <i class="nav-icon fas fa-clipboard"></i>
              <p>
                Standar Harga
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('user/ssh') ;?>" class="nav-link <?php if($page == 'SSH'){echo 'active';} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>SSH</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?= base_url('user/asb') ;?>" class="nav-link <?php if($page == 'ASB'){echo 'active';} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>ASB</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?= base_url('user/sbu') ;?>" class="nav-link <?php if($page == 'SBU'){echo 'active';} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>SBU</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?= base_url('user/hspk') ;?>" class="nav-link <?php if($page == 'HSPK'){echo 'active';} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>HSPK</p>
                </a>
              </li>

            </ul>
          </li>
          
          <li class="nav-item">
            <a href="#" class="nav-link" data-toggle="modal" data-target="#logOutModal">
              <i class="nav-icon fa-fw fas fa-sign-out-alt"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>