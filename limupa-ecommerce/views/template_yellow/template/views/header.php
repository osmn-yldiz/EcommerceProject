<!doctype html>
<html class="no-js" lang="zxx">

<!-- index28:48-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <base href="http://localhost:8080/osman/limupa-ecommerce/">
    <title>Home Version One || limupa - Digital Products Store eCommerce Bootstrap 4 Template</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="<?= TEMPLATE ?>images/favicon.png">

    <?php foreach ($css_array as $css) { ?>
        <link rel="stylesheet" href="<?php echo $css; ?>">
    <?php } ?>
    <script src="<?php echo TEMPLATE ?>/js/vendor/jquery-1.12.4.min.js"></script>
    <!-- Modernizr js -->
    <script src="../js/vendor/modernizr-2.8.3.min.js"></script>

</head>

<body>
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
    your browser</a> to improve your experience.</p>
<![endif]-->
<!-- Begin Body Wrapper -->
<div class="body-wrapper">
    <!-- Begin Header Area -->
    <header>
        <!-- Begin Header Top Area -->
        <div class="header-top">
            <div class="container">
                <div class="row">
                    <!-- Begin Header Top Left Area -->
                    <div class="col-lg-3 col-md-4">
                        <div class="header-top-left">
                            <ul class="phone-wrap">
                                <li><span>Telephone Enquiry:</span><a href="#">(+123) 123 321 345</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- Header Top Left Area End Here -->
                    <!-- Begin Header Top Right Area -->
                    <div class="col-lg-9 col-md-8">
                        <div class="header-top-right">
                            <ul class="ht-menu">
                                <!-- Begin Setting Area -->
                                <?php if (empty($_SESSION['userID'])) { ?>
                                    <li>
                                        <a href="index.php?func=login-register">GİRİŞ YAP / KAYIT OL</a>
                                    </li>
                                <?php } ?>
                                <li>
                                    <div class="ht-setting-trigger">
                                            <span><?php if (isset($_SESSION['userID']) && $_SESSION['userID'] > 0) echo "Hoşgeldin " . $_SESSION['FirstName'] . " " . $_SESSION['LastName']; ?>,
                                                Hesabım</span>
                                    </div>
                                    <div class="setting ht-setting">
                                        <ul class="ht-setting-list">
                                            <li><a href="login-register.html">My Account</a></li>
                                            <li><a href="checkout.html">Checkout</a></li>
                                            <li><a href="index.php?func=logout">Çıkış Yap</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <!-- Setting Area End Here -->
                                <!-- Begin Currency Area -->
                                <li>
                                    <span class="currency-selector-wrapper">Currency :</span>
                                    <div class="ht-currency-trigger"><span>USD $</span></div>
                                    <div class="currency ht-currency">
                                        <ul class="ht-setting-list">
                                            <li><a href="#">EUR €</a></li>
                                            <li class="active"><a href="#">USD $</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <!-- Currency Area End Here -->
                                <!-- Begin Language Area -->
                                <li>
                                    <span class="language-selector-wrapper">Language :</span>
                                    <div class="ht-language-trigger"><span>English</span></div>
                                    <div class="language ht-language">
                                        <ul class="ht-setting-list">
                                            <li class="active">
                                                <a href="#"><img src="<?= TEMPLATE ?>images/menu/flag-icon/1.jpg"
                                                                 alt="">English</a>
                                            </li>
                                            <li>
                                                <a href="#"><img src="<?= TEMPLATE ?>images/menu/flag-icon/2.jpg"
                                                                 alt="">Français</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <!-- Language Area End Here -->
                            </ul>
                        </div>
                    </div>
                    <!-- Header Top Right Area End Here -->
                </div>
            </div>
        </div>
        <!-- Header Top Area End Here -->
        <!-- Begin Header Middle Area -->
        <div class="header-middle pl-sm-0 pr-sm-0 pl-xs-0 pr-xs-0">
            <div class="container">
                <div class="row">
                    <!-- Begin Header Logo Area -->
                    <div class="col-lg-3">
                        <div class="logo pb-sm-30 pb-xs-30">
                            <a href="index.html">
                                <img src="<?= TEMPLATE ?>images/menu/logo/1.jpg" alt="">
                            </a>
                        </div>
                    </div>
                    <!-- Header Logo Area End Here -->
                    <!-- Begin Header Middle Right Area -->
                    <div class="col-lg-9 pl-0 ml-sm-15 ml-xs-15">
                        <!-- Begin Header Middle Searchbox Area -->
                        <form action="#" class="hm-searchbox">
                            <input type="text" placeholder="Enter your search key ...">
                            <button class="li-btn" type="submit"><i class="fa fa-search"></i></button>
                        </form>
                        <!-- Header Middle Searchbox Area End Here -->
                        <!-- Begin Header Middle Right Area -->
                        <div class="header-middle-right">
                            <ul class="hm-menu">
                                <!-- Begin Header Middle Wishlist Area -->
                                <li class="hm-wishlist">
                                    <a href="wishlist.html">
                                        <span class="cart-item-count wishlist-item-count">0</span>
                                        <i class="fa fa-heart-o"></i>
                                    </a>
                                </li>
                                <!-- Header Middle Wishlist Area End Here -->
                                <!-- Begin Header Mini Cart Area -->
                                <li class="hm-minicart">
                                    <div class="hm-minicart-trigger">
                                        <span class="item-icon"></span>
                                        <span class="item-text"><?php print $basket->toplam; ?> ₺
                                                <span class="cart-item-count">2</span>
                                            </span>
                                    </div>
                                    <span></span>
                                    <div class="minicart">
                                        <ul class="minicart-product-list">
                                            <?php
                                            foreach ($basketList as $basketList) { ?>
                                                <li class="basket_<?php echo $basketList['ID']; ?>">
                                                    <a href="single-product.html" class="minicart-product-image">
                                                        <img src="uploads/products/<?php echo $basketList['Images']; ?>"
                                                             alt="cart products">
                                                    </a>
                                                    <div class="minicart-product-details">
                                                        <h6>
                                                            <a href="single-product.html"><?php echo $basketList['Name']; ?></a>
                                                        </h6>
                                                        <span><?php echo $basketList['Price']; ?> ₺ x <?php echo $basketList['Quantity']; ?></span>
                                                    </div>
                                                    <button class="close" title="Remove"
                                                            onclick="removeBasket(<?php echo $basketList['ID']; ?>)">
                                                        <i class="fa fa-close"></i>
                                                    </button>
                                                </li>

                                            <?php } ?>
                                        </ul>
                                        <p class="minicart-total">Toplam Tutar:
                                            <span><?php echo $basket->toplam; ?> ₺</span></p>
                                        <div class="minicart-button">
                                            <a href="<?php echo URL ?>index.php?func=basket"
                                               class="li-button li-button-fullwidth li-button-dark">
                                                <span>SEPETE GİT</span>
                                            </a>
                                            <a href="<?php echo URL ?>iyzipay-php-master/samples/initialize_checkout_form.php"
                                               class="li-button li-button-fullwidth">
                                                <span>SİPARİŞİ TAMAMLA</span>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                                <!-- Header Mini Cart Area End Here -->
                            </ul>
                        </div>
                        <!-- Header Middle Right Area End Here -->
                    </div>
                    <!-- Header Middle Right Area End Here -->
                </div>
            </div>
        </div>
        <!-- Header Middle Area End Here -->
        <!-- Begin Header Bottom Area -->
        <div class="header-bottom header-sticky d-none d-lg-block d-xl-block">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Begin Header Bottom Menu Area -->
                        <div class="hb-menu">
                            <nav>
                                <ul>
                                    <!-- <li class="dropdown-holder"><a href="index.html">Home</a>
                                        <ul class="hb-dropdown">
                                            <li class="active"><a href="index.html">Home One</a></li>
                                            <li><a href="index-2.html">Home Two</a></li>
                                            <li><a href="index-3.html">Home Three</a></li>
                                            <li><a href="index-4.html">Home Four</a></li>
                                        </ul>
                                    </li>-->
                                    <?php
                                    foreach ($Kategori_List as $key => $value) {
                                        ?>
                                        <li class="megamenu-static-holder"><a
                                                    href="index.html"><?php echo $value['Name']; ?></a>
                                            <?php if (isset($value['sub_cats']) && count($value['sub_cats']) > 0) { ?>

                                                <ul class="megamenu hb-megamenu">
                                                    <?php foreach ($value['sub_cats'] as $key2 => $value2) { ?>
                                                        <li>
                                                            <a href="blog-left-sidebar.html"><?php echo $value2['Name']; ?></a>
                                                            <?php if (isset($value2['sub_cats']) && count($value2['sub_cats']) > 0) { ?>

                                                                <ul>
                                                                    <?php foreach ($value2['sub_cats'] as $key3 => $value3){ ?>
                                                                    <li><a
                                                                                href="index.php?func=products&CatID=<?php echo $value3['ID']; ?>"><?php echo $value3['Name']; ?></a>
                                                                        <?php } ?>
                                                                </ul>
                                                            <?php } ?>
                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                            <?php } ?>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                    <li class="megamenu-static-holder"><a href="index.html">Pages</a>
                                        <ul class="megamenu hb-megamenu">
                                            <li><a href="blog-left-sidebar.html">Blog Layouts</a>
                                                <ul>
                                                    <li><a href="blog-2-column.html">Blog 2 Column</a></li>
                                                    <li><a href="blog-3-column.html">Blog 3 Column</a></li>
                                                    <li><a href="blog-left-sidebar.html">Grid Left Sidebar</a></li>
                                                    <li><a href="blog-right-sidebar.html">Grid Right Sidebar</a>
                                                    </li>
                                                    <li><a href="blog-list.html">Blog List</a></li>
                                                    <li><a href="blog-list-left-sidebar.html">List Left Sidebar</a>
                                                    </li>
                                                    <li><a href="blog-list-right-sidebar.html">List Right
                                                            Sidebar</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="blog-details-left-sidebar.html">Blog Details Pages</a>
                                                <ul>
                                                    <li><a href="blog-details-left-sidebar.html">Left Sidebar</a>
                                                    </li>
                                                    <li><a href="blog-details-right-sidebar.html">Right Sidebar</a>
                                                    </li>
                                                    <li><a href="blog-audio-format.html">Blog Audio Format</a></li>
                                                    <li><a href="blog-video-format.html">Blog Video Format</a></li>
                                                    <li><a href="blog-gallery-format.html">Blog Gallery Format</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li><a href="index.html">Other Pages</a>
                                                <ul>
                                                    <li><a href="login-register.html">My Account</a></li>
                                                    <li><a href="checkout.html">Checkout</a></li>
                                                    <li><a href="compare.html">Compare</a></li>
                                                    <li><a href="wishlist.html">Wishlist</a></li>
                                                    <li><a href="shopping-cart.html">Shopping Cart</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="index.html">Other Pages 2</a>
                                                <ul>
                                                    <li><a href="contact.html">Contact</a></li>
                                                    <li><a href="about-us.html">About Us</a></li>
                                                    <li><a href="faq.html">FAQ</a></li>
                                                    <li><a href="404.html">404 Error</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>

                                </ul>
                            </nav>
                        </div>
                        <!-- Header Bottom Menu Area End Here -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Header Bottom Area End Here -->
        <!-- Begin Mobile Menu Area -->
        <div class="mobile-menu-area d-lg-none d-xl-none col-12">
            <div class="container">
                <div class="row">
                    <div class="mobile-menu">
                    </div>
                </div>
            </div>
        </div>
        <!-- Mobile Menu Area End Here -->
    </header>
    <!-- Header Area End Here -->

    <script>
        function removeBasket(ID) {

            $.post({
                url: "ajax/basket-delete.php",
                data: 'ID='+ID,
                cache: false,
                success: function (ajaxAnswer) {
                    console.log(ajaxAnswer);
                    $(".basket_"+ajaxAnswer).remove();

                },
                error: function (hata) {
                    console.log("test");

                }
            });
        }
    </script>