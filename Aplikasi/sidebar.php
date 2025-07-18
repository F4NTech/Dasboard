    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="https://www.linkedin.com/in/dimas-bagus-editya-baskoro-3aaab6248/" target="_blank" rel="noopener noreferrer" class="d-block">
              <?php echo "DIMAS BAGUS"; ?>
          </a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        
        <!-- <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div> -->
      </div>

      <!-- Sidebar Menu -->
      <?php 
         include('menu/Operator.php');
      ?>
      <!-- /.sidebar-menu -->
    </div>