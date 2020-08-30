<?php
include 'class/class.php';
include "themepart/toast-script.php";
print_toast();
print_sweet_alert();
?>
<!DOCTYPE html>
<html lang="en">



    <?php include './includes/head.php' ?>	

    <body>
        <div id="page">
            <?php include './includes/header.php' ?>    
            <?php include './includes/dashboard.php' ?>     

            <main>

                <!--/carousel-->
                <?php
//                include './includes/carasoul.php';
                ?>
                <ul id="banners_grid" class="clearfix">
                    <?php
                    $cats = get_all("select * from tbl_category where is_delete = '0'");
                    foreach ($cats as $cat) {
                        ?><li>
                            <a href="products.php?cat_id=<?php echo $cat['cat_id'] ?>" class="img_container">
                                <img src="<?php echo check_image(upload_url() . "category/{$cat['img']}") ?>"   alt="" class="lazy">
                                <div class="short_info opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.5)">
                                    <h3><?php echo $cat['cat_name'] ?></h3>
                                    <div><span class="btn_1">View Products</span></div>
                                </div>
                            </a>
                        </li> 
                        <?php
                    }
                    ?>

                </ul>
                <!--/banners_grid -->

                <div class="container margin_60_35">
                    <div class="main_title">
                        <h2>Top Selling</h2>
                        <span>Products</span>
                        <!--<p>Cum doctus civibus efficiantur in imperdiet deterruisset</p>-->
                    </div>
                    <div class="row small-gutters">
                        <?php
                        $products = get_all("select *  from tbl_product where is_delete = '0' limit 12");
                        foreach ($products as $product) {
                            $img = get_single("select *  from tbl_product_image where pro_id = '{$product['pro_id']}'  order by rand() limit 1");
                            ?>
                            <div class="col-6 col-md-4 col-xl-3">
                                <div class="grid_item">
                                    <figure style="height: 300px">
                                        <!--<span class="ribbon off">-30%</span>-->
                                        <a href="product-details.php?id=<?php echo $product['pro_id'] ?>">
                                            <img style="height: 300px" class="img-fluid lazy" src="<?php echo check_image(upload_url() . "products/{$img['img']}") ?>"   alt="">
                                        </a>
                                        <!--<div data-countdown="2020/03/15" class="countdown"></div>-->
                                    </figure>
                                    <hr>
                                    <!--<div class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i></div>-->
                                    <a href="product-details.php?id=<?php echo $product['pro_id'] ?>">
                                        <h3><?php echo $product['pro_name'] ?></h3>
                                    </a>
                                    <div class="price_box">
                                        <span class="new_price">&#8377; <?php echo $product['price'] ?></span> 
                                    </div>
                                    <ul>
    <!--                                        <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to favorites"><i class="ti-heart"></i><span>Add to favorites</span></a></li>
                                        <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to compare"><i class="ti-control-shuffle"></i><span>Add to compare</span></a></li>
                                        <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to cart"><i class="ti-shopping-cart"></i><span>Add to cart</span></a></li>-->
                                    </ul>
                                </div>
                                <!-- /grid_item -->
                            </div>	
                        <?php } ?>			
                    </div>
                    <!-- /row -->
                </div>
                <!-- /container -->

                <!--                <div class="featured lazy" data-bg="url(assets/frontEnd/img/featured_home.jpg)">
                                    <div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.5)">
                                        <div class="container margin_60">
                                            <div class="row justify-content-center justify-content-md-start">
                                                <div class="col-lg-6 wow" data-wow-offset="150">
                                                    <h3>Armor<br>Air Color 720</h3>
                                                    <p>Lightweight cushioning and durable support with a Phylon midsole</p>
                                                    <div class="feat_text_block">
                                                        <div class="price_box">
                                                            <span class="new_price">$90.00</span>
                                                            <span class="old_price">$170.00</span>
                                                        </div>
                                                        <a class="btn_1" href="listing-grid-1-full.html" role="button">Shop Now</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>-->
                <!-- /featured -->

                <!--                <div class="container margin_60_35">
                                    <div class="main_title">
                                        <h2>Featured</h2>
                                        <span>Products</span>
                                        <p>Cum doctus civibus efficiantur in imperdiet deterruisset</p>
                                    </div>
                                    <div class="owl-carousel owl-theme products_carousel">
                                        <div class="item">
                                            <div class="grid_item">
                                                <span class="ribbon new">New</span>
                                                <figure>
                                                    <a href="product-detail-1.html">
                                                        <img class="owl-lazy" src="assets/frontEnd/img/products/product_placeholder_square_medium.jpg" data-src="assets/frontEnd/img/products/shoes/4.jpg" alt="">
                                                    </a>
                                                </figure>
                                                <div class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i></div>
                                                <a href="product-detail-1.html">
                                                    <h3>ACG React Terra</h3>
                                                </a>
                                                <div class="price_box">
                                                    <span class="new_price">$110.00</span>
                                                </div>
                                                <ul>
                                                    <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to favorites"><i class="ti-heart"></i><span>Add to favorites</span></a></li>
                                                    <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to compare"><i class="ti-control-shuffle"></i><span>Add to compare</span></a></li>
                                                    <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to cart"><i class="ti-shopping-cart"></i><span>Add to cart</span></a></li>
                                                </ul>
                                            </div>
                                             /grid_item 
                                        </div>
                                         /item 
                                        <div class="item">
                                            <div class="grid_item">
                                                <span class="ribbon new">New</span>
                                                <figure>
                                                    <a href="product-detail-1.html">
                                                        <img class="owl-lazy" src="assets/frontEnd/img/products/product_placeholder_square_medium.jpg" data-src="assets/frontEnd/img/products/shoes/5.jpg" alt="">
                                                    </a>
                                                </figure>
                                                <div class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i></div>
                                                <a href="product-detail-1.html">
                                                    <h3>Air Zoom Alpha</h3>
                                                </a>
                                                <div class="price_box">
                                                    <span class="new_price">$140.00</span>
                                                </div>
                                                <ul>
                                                    <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to favorites"><i class="ti-heart"></i><span>Add to favorites</span></a></li>
                                                    <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to compare"><i class="ti-control-shuffle"></i><span>Add to compare</span></a></li>
                                                    <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to cart"><i class="ti-shopping-cart"></i><span>Add to cart</span></a></li>
                                                </ul>
                                            </div>
                                             /grid_item 
                                        </div>
                                         /item 
                                        <div class="item">
                                            <div class="grid_item">
                                                <span class="ribbon hot">Hot</span>
                                                <figure>
                                                    <a href="product-detail-1.html">
                                                        <img class="owl-lazy" src="assets/frontEnd/img/products/product_placeholder_square_medium.jpg" data-src="assets/frontEnd/img/products/shoes/8.jpg" alt="">
                                                    </a>
                                                </figure>
                                                <div class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i></div>
                                                <a href="product-detail-1.html">
                                                    <h3>Air Color 720</h3>
                                                </a>
                                                <div class="price_box">
                                                    <span class="new_price">$120.00</span>
                                                </div>
                                                <ul>
                                                    <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to favorites"><i class="ti-heart"></i><span>Add to favorites</span></a></li>
                                                    <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to compare"><i class="ti-control-shuffle"></i><span>Add to compare</span></a></li>
                                                    <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to cart"><i class="ti-shopping-cart"></i><span>Add to cart</span></a></li>
                                                </ul>
                                            </div>
                                             /grid_item 
                                        </div>
                                         /item 
                                        <div class="item">
                                            <div class="grid_item">
                                                <span class="ribbon off">-30%</span>
                                                <figure>
                                                    <a href="product-detail-1.html">
                                                        <img class="owl-lazy" src="assets/frontEnd/img/products/product_placeholder_square_medium.jpg" data-src="assets/frontEnd/img/products/shoes/2.jpg" alt="">
                                                    </a>
                                                </figure>
                                                <div class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i></div>
                                                <a href="product-detail-1.html">
                                                    <h3>Okwahn II</h3>
                                                </a>
                                                <div class="price_box">
                                                    <span class="new_price">$90.00</span>
                                                    <span class="old_price">$170.00</span>
                                                </div>
                                                <ul>
                                                    <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to favorites"><i class="ti-heart"></i><span>Add to favorites</span></a></li>
                                                    <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to compare"><i class="ti-control-shuffle"></i><span>Add to compare</span></a></li>
                                                    <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to cart"><i class="ti-shopping-cart"></i><span>Add to cart</span></a></li>
                                                </ul>
                                            </div>
                                             /grid_item 
                                        </div>
                                         /item 
                                        <div class="item">
                                            <div class="grid_item">
                                                <span class="ribbon off">-50%</span>
                                                <figure>
                                                    <a href="product-detail-1.html">
                                                        <img class="owl-lazy" src="assets/frontEnd/img/products/product_placeholder_square_medium.jpg" data-src="assets/frontEnd/img/products/shoes/3.jpg" alt="">
                                                    </a>
                                                </figure>
                                                <div class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i></div>
                                                <a href="product-detail-1.html">
                                                    <h3>Air Wildwood ACG</h3>
                                                </a>
                                                <div class="price_box">
                                                    <span class="new_price">$75.00</span>
                                                    <span class="old_price">$155.00</span>
                                                </div>
                                                <ul>
                                                    <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to favorites"><i class="ti-heart"></i><span>Add to favorites</span></a></li>
                                                    <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to compare"><i class="ti-control-shuffle"></i><span>Add to compare</span></a></li>
                                                    <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to cart"><i class="ti-shopping-cart"></i><span>Add to cart</span></a></li>
                                                </ul>
                                            </div>
                                             /grid_item 
                                        </div>
                                         /item 
                                    </div>
                                     /products_carousel 
                                </div>-->
                <!-- /container -->

                <!--                <div class="bg_gray">
                                    <div class="container margin_30">
                                        <div id="brands" class="owl-carousel owl-theme">
                                            <div class="item">
                                                <a href="#0"><img src="assets/frontEnd/img/brands/placeholder_brands.png" data-src="assets/frontEnd/img/brands/logo_1.png" alt="" class="owl-lazy"></a>
                                            </div> /item 
                                            <div class="item">
                                                <a href="#0"><img src="assets/frontEnd/img/brands/placeholder_brands.png" data-src="assets/frontEnd/img/brands/logo_2.png" alt="" class="owl-lazy"></a>
                                            </div> /item 
                                            <div class="item">
                                                <a href="#0"><img src="assets/frontEnd/img/brands/placeholder_brands.png" data-src="assets/frontEnd/img/brands/logo_3.png" alt="" class="owl-lazy"></a>
                                            </div> /item 
                                            <div class="item">
                                                <a href="#0"><img src="assets/frontEnd/img/brands/placeholder_brands.png" data-src="assets/frontEnd/img/brands/logo_4.png" alt="" class="owl-lazy"></a>
                                            </div> /item 
                                            <div class="item">
                                                <a href="#0"><img src="assets/frontEnd/img/brands/placeholder_brands.png" data-src="assets/frontEnd/img/brands/logo_5.png" alt="" class="owl-lazy"></a>
                                            </div> /item 
                                            <div class="item">
                                                <a href="#0"><img src="assets/frontEnd/img/brands/placeholder_brands.png" data-src="assets/frontEnd/img/brands/logo_6.png" alt="" class="owl-lazy"></a>
                                            </div> /item  
                                        </div> /carousel 
                                    </div> /container 
                                </div>-->
                <!-- /bg_gray -->

                <!--                <div class="container margin_60_35">
                                    <div class="main_title">
                                        <h2>Latest news</h2>
                                        <span>Blog</span>
                                        <p>Cum doctus civibus efficiantur in imperdiet deterruisset</p>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <a class="box_news" href="blog.html">
                                                <figure>
                                                    <img src="assets/frontEnd/img/blog-thumb-placeholder.jpg" data-src="assets/frontEnd/img/blog-thumb-1.jpg" alt="" width="400" height="266" class="lazy">
                                                    <figcaption><strong>28</strong>Dec</figcaption>
                                                </figure>
                                                <ul>
                                                    <li>by Mark Twain</li>
                                                    <li>20.11.2017</li>
                                                </ul>
                                                <h4>Pri oportere scribentur eu</h4>
                                                <p>Cu eum alia elit, usu in eius appareat, deleniti sapientem honestatis eos ex. In ius esse ullum vidisse....</p>
                                            </a>
                                        </div>
                                         /box_news 
                                        <div class="col-lg-6">
                                            <a class="box_news" href="blog.html">
                                                <figure>
                                                    <img src="assets/frontEnd/img/blog-thumb-placeholder.jpg" data-src="assets/frontEnd/img/blog-thumb-2.jpg" alt="" width="400" height="266" class="lazy">
                                                    <figcaption><strong>28</strong>Dec</figcaption>
                                                </figure>
                                                <ul>
                                                    <li>By Jhon Doe</li>
                                                    <li>20.11.2017</li>
                                                </ul>
                                                <h4>Duo eius postea suscipit ad</h4>
                                                <p>Cu eum alia elit, usu in eius appareat, deleniti sapientem honestatis eos ex. In ius esse ullum vidisse....</p>
                                            </a>
                                        </div>
                                         /box_news 
                                        <div class="col-lg-6">
                                            <a class="box_news" href="blog.html">
                                                <figure>
                                                    <img src="assets/frontEnd/img/blog-thumb-placeholder.jpg" data-src="assets/frontEnd/img/blog-thumb-3.jpg" alt="" width="400" height="266" class="lazy">
                                                    <figcaption><strong>28</strong>Dec</figcaption>
                                                </figure>
                                                <ul>
                                                    <li>By Luca Robinson</li>
                                                    <li>20.11.2017</li>
                                                </ul>
                                                <h4>Elitr mandamus cu has</h4>
                                                <p>Cu eum alia elit, usu in eius appareat, deleniti sapientem honestatis eos ex. In ius esse ullum vidisse....</p>
                                            </a>
                                        </div>
                                         /box_news 
                                        <div class="col-lg-6">
                                            <a class="box_news" href="blog.html">
                                                <figure>
                                                    <img src="assets/frontEnd/img/blog-thumb-placeholder.jpg" data-src="assets/frontEnd/img/blog-thumb-4.jpg" alt="" width="400" height="266" class="lazy">
                                                    <figcaption><strong>28</strong>Dec</figcaption>
                                                </figure>
                                                <ul>
                                                    <li>By Paula Rodrigez</li>
                                                    <li>20.11.2017</li>
                                                </ul>
                                                <h4>Id est adhuc ignota delenit</h4>
                                                <p>Cu eum alia elit, usu in eius appareat, deleniti sapientem honestatis eos ex. In ius esse ullum vidisse....</p>
                                            </a>
                                        </div>
                                         /box_news 
                                    </div>
                                     /row 
                                </div>-->
                <!-- /container -->
            </main>
            <!-- /main -->
            <?php include 'footer.php' ?>
            <!--/footer-->
        </div>
        <!-- page -->	
        <div id="toTop"></div><!-- Back to top button -->	
        <?php include 'include-script.php' ?>
 

    </body>

</html>