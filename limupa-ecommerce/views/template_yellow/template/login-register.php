<?php

$css_array = array(
    TEMPLATE . "css/material-design-iconic-font.min.css",
    TEMPLATE . "css/font-awesome.min.css",
    TEMPLATE . "css/fontawesome-stars.css",
    TEMPLATE . "css/meanmenu.css",
    TEMPLATE . "css/owl.carousel.min.css",
    TEMPLATE . "css/slick.css",
    TEMPLATE . "css/animate.css",
    TEMPLATE . "css/jquery-ui.min.css",
    TEMPLATE . "css/venobox.css",
    TEMPLATE . "css/nice-select.css", // Select için geçerlidir required
    TEMPLATE . "css/magnific-popup.css",
    TEMPLATE . "css/bootstrap.min.css",
    TEMPLATE . "css/helper.css", // Sayfadaki padding ve marginleri ayarlıyor required
    TEMPLATE . "style.css", // Sistemin ana teması required
    TEMPLATE . "css/responsive.css", // required
    TEMPLATE . "css/validationEngine.jquery.css"
);

/*foreach ($css_array as $css) 
{
    $file .= file_get_contents($css);
}
$css_file = file_put_contents(TEMPLATE.'css/full.css',$file);

$css_array = array(
    TEMPLATE."css/full.css",
);*/

$js_array = array(
    //TEMPLATE."js/vendor/jquery-1.12.4.min.js",
    TEMPLATE . "js/vendor/popper.min.js",
    TEMPLATE . "js/bootstrap.min.js",
    TEMPLATE . "js/ajax-mail.js",
    TEMPLATE . "js/jquery.meanmenu.min.js",
    TEMPLATE . "js/wow.min.js",
    TEMPLATE . "js/slick.min.js",
    TEMPLATE . "js/owl.carousel.min.js",
    TEMPLATE . "js/jquery.magnific-popup.min.js",
    TEMPLATE . "js/isotope.pkgd.min.js",
    TEMPLATE . "js/imagesloaded.pkgd.min.js",
    TEMPLATE . "js/jquery.mixitup.min.js",
    TEMPLATE . "js/jquery.countdown.min.js",
    TEMPLATE . "js/jquery.counterup.min.js",
    TEMPLATE . "js/waypoints.min.js",
    TEMPLATE . "js/jquery.barrating.min.js",
    TEMPLATE . "js/jquery-ui.min.js",
    TEMPLATE . "js/venobox.min.js",
    TEMPLATE . "js/jquery.nice-select.min.js",
    TEMPLATE . "js/scrollUp.min.js",
    TEMPLATE . "js/main.js",
    TEMPLATE . "js/jquery.validationEngine.js",
    TEMPLATE . "js/jquery.validationEngine-tr.js",
    "http://cdn.jsdelivr.net/npm/sweetalert2@11"

);

include 'views/header.php';
include 'views/login-register.php';
include 'views/footer.php';

?>