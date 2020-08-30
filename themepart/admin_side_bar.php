<?php
?>
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo admin_url()?>" class="brand-link">
        <img src="<?php echo check_image(upload_url()."logo.png") ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light"> <?php echo get_setting("project_name") ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="<?php echo check_image(upload_url()."admin/". get_admindata("user_image")) ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="<?php echo admin_url()."profile.php"?>" class="d-block"><?php echo get_admindata("user_name")?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
   
          
           
          <li class="nav-item">
              <a href="<?php echo admin_url()?>" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item">
              <a href="<?php echo admin_url()."vendor/view.php"?>" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>Vendor</p>
            </a>
          </li>
          <li class="nav-item">
              <a href="<?php echo admin_url()."customer/view.php"?>" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>Customer</p>
            </a>
          </li>
          <li class="nav-item has-treeview ">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Product
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav-treeview">
              <li class="nav-item">
                <a href="<?php echo admin_url()."category/view.php"?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo admin_url()."sub-category/view.php"?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sub Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo admin_url()."products/view.php"?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Products</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
              <a href="<?php echo admin_url()."orders/view.php"?>" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>Orders</p>
            </a>
          </li>
           <li class="nav-item has-treeview ">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Requests
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav-treeview">
              <li class="nav-item">
                <a href="<?php echo admin_url()."category/request.php"?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo admin_url()."sub-category/request.php"?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sub Category</p>
                </a>
              </li> 
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
