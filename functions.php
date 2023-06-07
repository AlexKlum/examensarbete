<?php

/*  --- Laddar in mina CSS scripts ---  */

function posterexperten_enqueue_scripts()
{
    wp_enqueue_style('style', get_stylesheet_uri(), array() . '/style.css');
}

add_action("wp_enqueue_scripts", "posterexperten_enqueue_scripts");




/*  --- WOOCOMMERCE ---   */


// Lägger till support för woocommerce.
function mytheme_add_woocommerce_support() {
    add_theme_support( 'woocommerce');
}

add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );


// Tar bort och filtrerar WooCommerce funktioner jag inte vill ha med på sidan.
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

add_filter( 'woocommerce_product_tabs', 'remove_product_tabs', 9999 );
add_filter( 'action_scheduler_pastdue_actions_check_pre', '__return_false' );
  
function remove_product_tabs( $tabs ) {
    unset( $tabs['additional_information'] ); 
    return $tabs;
}


// Lägger till en wrapper/container runt all WooCommerce kod. Gör så jag kan ändra CSS.
add_action('woocommerce_before_main_content', 'my_theme_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'my_theme_wrapper_end', 10);


function my_theme_wrapper_start() {
    echo '<section id="woocommerce-container">';
}

function my_theme_wrapper_end() {
    echo '</section>';
}

?>