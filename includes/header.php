<header class="version_2">
    <div class="layer"></div><!-- Mobile menu overlay mask -->
    <div class="main_header">
        <div class="container">
            <div class="row small-gutters">
                <div class="col-xl-3 col-lg-3 d-lg-flex align-items-center">
                    <div id="logo">
                        <a href="index.php"> <img src=<?php echo get_logo() ?> alt="" width="90" height="90"></a>
                    </div>
                </div>
                <nav class="col-xl-6 col-lg-7">
                    <a class="open_close" href="javascript:void(0);">
                        <div class="hamburger hamburger--spin">
                            <div class="hamburger-box">
                                <div class="hamburger-inner"></div>
                            </div>
                        </div>
                    </a>
                    <div class="row mt-4">
                        <h1 style="color:blue">Desired Gifts -  </h1>   <h4 style="color:blue" class=" mt-3 ml-3">  Complete Gift Solutions</h4>
                    </div>
                    <!-- Mobile menu button -->
                    <div class="main-menu">


                        <ul>


                            <!--                            <li>
                                                            <a href="index.php">Home</a>								
                                                        </li>
                                                        <li>
                                                            <a href="product-list.php">Product</a>								
                                                        </li>-->

                            <!--                            <li class="submenu">
                                                            <a href="javascript:void(0);" class="show-submenu">Extra Pages</a>
                                                            <ul>
                                                                <li><a href="header-2.php">Header Style 2</a></li>
                                                                <li><a href="header-3.php">Header Style 3</a></li>
                                                                <li><a href="header-4.php">Header Style 4</a></li>
                                                                <li><a href="header-5.php">Header Style 5</a></li>
                                                                <li><a href="404.php">404 Page</a></li>
                                                                <li><a href="sign-in-modal.php">Sign In Modal</a></li>
                                                                <li><a href="contacts.php">Contact Us</a></li>
                                                                <li><a href="about.php">About 1</a></li>
                                                                <li><a href="about-2.php">About 2</a></li>
                                                                <li><a href="modal-advertise.php">Modal Advertise</a></li>
                                                                <li><a href="modal-newsletter.php">Modal Newsletter</a></li>
                                                            </ul>
                                                        </li>							-->
                        </ul>
                    </div>
                    <!--/main-menu -->
                </nav>
                <div class="col-xl-3 col-lg-2 d-lg-flex align-items-center justify-content-end text-right">
                    <a class="phone_top" ><strong><span>Developed By</span> Group No :- 10</strong></a>
                </div>
            </div>
            <!-- /row -->
        </div>
    </div>
    <!-- /main_header -->
    <div class="main_nav Sticky">
        <div class="container">
            <div class="row small-gutters">
                <div class="col-xl-4 col-lg-3 col-md-3">
                    <nav class="categories">
                        <ul class="clearfix">
                            <li>
                                <span>
                                    <a href="#">
                                        <span class="hamburger hamburger--spin">
                                            <span class="hamburger-box">
                                                <span class="hamburger-inner"></span>
                                            </span>
                                        </span>
                                        Categories
                                    </a>
                                </span>
                                <div id="menu">
                                    <ul>

                                        <?php
                                        $cats = get_all("select * from tbl_category where is_delete = '0'");
                                        foreach ($cats as $cat) {
                                            ?>
                                            <li>
                                                <span>
                                                    <a href="products.php?cat_id=<?php echo $cat['cat_id'] ?>">
                                                        <?php echo ucwords($cat['cat_name']) ?>
                                                    </a>
                                                </span>
                                                <ul>
                                                    <?php
                                                    $sub_cats = get_all("select * from tbl_sub_category where cat_id = '{$cat['cat_id']}' and is_delete = '0' limit 3");
                                                    foreach ($sub_cats as $sub_cat) {
                                                        ?>
                                                        <li><a href="products.php?sub_cat_id=<?php echo $sub_cat['sc_id'] ?>"><?php echo ucwords($sub_cat['sc_name']) ?></a></li> 
                                                        <?php
                                                    }
                                                    ?>
                                                    <li><a href="products.php"> See All </a></li> 
                                                </ul>
                                            </li>
                                            <?php
                                        }
                                        ?>  <li>
                                            <a href="products.php">
                                                See All
                                            </a>

                                        </li>

                                    </ul>
                                </div>
                            </li>
                            <li>
                                <span>
                                    <a href="products.php">
                                        <span class="hamburger hamburger--spin">
                                            <span class="hamburger-box">
                                                <!--<span class="hamburger-inner"></span>-->
                                            </span>
                                        </span>
                                        Products
                                    </a>
                                </span>
                            </li>
                            <li>
                                <span>
                                    <a href="suggestions.php">
                                        <span class="hamburger hamburger--spin">
                                            <span class="hamburger-box">
                                                <!--<span class="hamburger-inner"></span>-->
                                            </span>
                                        </span>
                                        Suggestions
                                    </a>
                                </span>
                            </li>
                        </ul>
                    </nav>
                </div>

                <div class="col-xl-5 col-lg-7 col-md-6 d-none d-md-block">
                    <form method="get" action="products.php">
                        <div class="custom-search-input">
                            <input type="text" name="keyword" placeholder="Search Products">
                            <button type="submit"><i class="header-icon_search_custom"></i></button>
                        </div>
                    </form>
                </div>

                <div class="col-xl-3 col-lg-2 col-md-3">
                    <ul class="top_tools">
                        <li>
                            <div class="dropdown dropdown-cart">
                                <?php
                                if (isset($_SESSION['cust_id'])) {
                                    $cust_id = $_SESSION['cust_id'];
                                } else {
                                    $cust_id = 0;
                                }
                                $cart_data = get_all("Select * from tbl_cart where cust_id = '{$cust_id}'");
                                ?>
                                <a href="cart.php" class="cart_bt"><strong><?php echo count($cart_data) ?></strong></a>
                                <div class="dropdown-menu">
                                    <ul>
                                        <?php
                                        $total = 0;
                                        foreach ($cart_data as $cart) {
                                            $product = get_single("Select * from tbl_product where pro_id = '{$cart['pro_id']}'");
                                            $img = get_single("Select * from tbl_product_image where pro_id = '{$product['pro_id']}' limit 1");

                                            $total += $product['price'];
                                            ?>
                                            <li>
                                                <a href="product-details.php?id=<?php echo $cart['pro_id'] ?>">
                                                    <figure><img src="<?php echo check_image(upload_url() . "products/{$img['img']}") ?>" alt="" width="50" height="50" class="lazy"></figure>
                                                    <strong><span><?php echo ucwords($product['pro_name']) ?></span> <?php echo "₹ " . number_format($product['price']) ?></strong>
                                                </a>
                                                <!--<a onclick="" class="action"><i class="ti-trash"></i></a>-->
                                            </li>
                                            <?php
                                        }
                                        ?>

                                    </ul>
                                    <?php
                                    if ($total > 0) {
                                        ?>
                                        <div class="total_drop">
                                            <div class="clearfix"><strong>Total</strong><span> <?php echo "₹ " . number_format($total) ?></span></div>
                                            <a href="cart.php" class="btn_1 outline">View Cart</a>
                                        </div>
                                        <?php
                                    } else if ($cust_id == 0) {
                                        ?>
                                        <div class="total_drop">
                                            <div class="clearfix"><strong>Login To View Your Cart</strong></div>
                                            <a href="login.php" class="btn_1 outline">Login </a>
                                        </div>
                                        <?php
                                    } else {
                                        ?>
                                        <div class="total_drop">
                                            <div class="clearfix"><strong>Your Cart Is Empty</strong></div>
                                            <a href="products.php" class="btn_1 outline">View Products </a>
                                        </div>
                                    <?php }
                                    ?>

                                </div>
                            </div>
                            <!-- /dropdown-cart-->
                        </li>
                        <li>
                            <!--<a href="#0" class="wishlist"><span>Wishlist</span></a>-->
                        </li>
                        <li>
                            <div class="dropdown dropdown-access">
                                <a href="login.php" class="access_link"><span>Account</span></a>
                                <div class="dropdown-menu">
                                    <?php
                                    if ($cust_id == 0) {
                                        ?>
                                        <a href="login.php" class="btn_1">Sign In or Sign Up</a>
                                        <?php
                                    } else {
                                        ?>
                                        <a class="btn_1">Welcome <?= strtoupper(get_custdata('user_name')); ?></a>

                                        <ul> 
                                            <li>
                                                <a href="orders.php"><i class="ti-package"></i>My Orders</a>
                                            </li>
                                            <li>
                                                <a href="account.php"><i class="ti-user"></i>My Profile</a>
                                            </li> 
                                            <li>
                                                <a href="logout.php" id="logout-user"><i></i>Log out</a>
                                            </li>
                                        </ul>
                                    <?php } ?>

                                </div>
                            </div>
                            <!-- /dropdown-access-->
                        </li>
                        <li>
                            <a href="javascript:void(0);" class="btn_search_mob"><span>Search</span></a>
                        </li>
                        <li>
                            <a href="#menu" class="btn_cat_mob">
                                <div class="hamburger hamburger--spin" id="hamburger">
                                    <div class="hamburger-box">
                                        <div class="hamburger-inner"></div>
                                    </div>
                                </div>
                                Categories
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- /row -->
        </div>
        <div class="search_mob_wp">
            <input type="text" class="form-control" placeholder="Search over 10.000 products">
            <input type="submit" class="btn_1 full-width" value="Search">
        </div>
        <!-- /search_mobile -->
    </div>
    <!-- /main_nav -->
</header>