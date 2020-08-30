<?php ?>

<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>

    </ul>

    <!-- SEARCH FORM -->

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto"> 
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <img style="height: 25px" src="<?php echo check_image(upload_url() . "vendor/" . get_vendordata("user_image")) ?>">
              <!--<span class="badge badge-warning navbar-badge">15</span>-->
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <div class="dropdown-item">
                   Hello , <?php echo get_vendordata("user_name")?>.
                </div>
                 

                <div class="dropdown-divider"></div>
                <a href="<?php echo vendor_url() ?>profile.php" class="dropdown-item">
                    <i class="fas fa-user mr-2"></i> Profile

                </a>

                <div class="dropdown-divider"></div>

                <a href="<?php echo vendor_url()?>logout.php" class="dropdown-item">
                    <i class="fas fa-folder mr-2"></i> Logout                 
                </a>

                <div class="dropdown-divider"></div>


            </div>
        </li>

    </ul>
</nav>
