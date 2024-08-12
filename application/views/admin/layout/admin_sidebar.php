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
      <a href="<?= base_url('admin');?>" class="brand-link">
        <img src="<?= base_url('assets/');?>images/icon.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <br>
        <span class="brand-text">Admin</span>
    </a>


      <!-- Sidebar -->
      <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
           <li class="nav-item">
            <a href="<?= base_url('admin')?>" class="nav-link <?php if($page == 'Dashboard'){echo 'active';} ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= base_url('admin/daftar_usulan_odp')?>" class="nav-link <?php if($page == 'Data Daftar Usulan ODP'){echo 'active';} ?>">
              <i class="nav-icon fas fa-file-alt"></i>
              <p>
                Daftar Usulan ODP
              </p>
            </a>
          </li>

          <li class="nav-item has-treeview <?php if($page == 'Master'){echo 'active';} ?>">
            <a href="#" class="nav-link <?php if($page == 'Master'){echo 'active';} ?>">
              <i class="nav-icon fas fa-database"></i>
              <p>
                Master
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('admin/kategori')?>" class="nav-link <?php if($page == 'Kategori'){echo 'active';} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Kategori
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('admin/kode_barang')?>" class="nav-link <?php if($page == 'Kode Barang'){echo 'active';} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Kode Barang
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?= base_url('admin/rekening_belanja')?>" class="nav-link <?php if($page == 'Rekening Belanja'){echo 'active';} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Rekening Belanja
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?= base_url('admin/satuan')?>" class="nav-link <?php if($page == 'Satuan'){echo 'active';} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Satuan
                  </p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview <?php if($page == 'Daftar Barang'){echo 'menu-open';} ?>">
            <a href="#" class="nav-link <?php if($page == 'Daftar Barang'){echo 'active';} ?>">
              <i class="nav-icon fas fa-tasks"></i>
              <p>
                Daftar Barang
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('admin/kelompok_barang')?>" class="nav-link <?php if($page == 'Kelompok Barang'){echo 'active';} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Kelompok Barang
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('admin/standar_harga')?>" class="nav-link <?php if($page == 'Standar Harga'){echo 'active';} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Standar Harga
                  </p>
                </a>
              </li>

            </ul>
          </li>

          <li class="nav-item has-treeview <?php if($page == 'Laporan'){echo 'menu-open';} ?>">
            <a href="#" class="nav-link <?php if($page == 'Laporan'){echo 'active';} ?>">
              <i class="nav-icon fas fa-clipboard"></i>
              <p>
                Laporan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('admin/laporan_shs') ;?>" class="nav-link <?php if($page == 'Laporan SHS'){echo 'active';} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan SHS</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?= base_url('admin/laporan_asb') ;?>" class="nav-link <?php if($page == 'Laporan ASB'){echo 'active';} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan ASB</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?= base_url('admin/laporan_sbu') ;?>" class="nav-link <?php if($page == 'Laporan SBU'){echo 'active';} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan SBU</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?= base_url('admin/laporan_hspk') ;?>" class="nav-link <?php if($page == 'Laporan HSPK'){echo 'active';} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan HSPK</p>
                </a>
              </li>

            </ul>
          </li>

          <li class="nav-item">
            <a href="<?= base_url('admin/user')?>" class="nav-link <?php if($page== 'User'){echo 'active';} ?>">
              <i class="nav-icon fas fa-user"></i>
              <p>
                User
              </p>
            </a>
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