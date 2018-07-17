<?php
add_action( 'wp_enqueue_scripts', 'nns_load_parent_stylesheets' );
add_action( 'storefront_content_top', 'custom_slider_storefront' );

add_action( 'storefront_header', 'nns_storefront_header_cart', 40 );

add_filter( 'storefront_recent_products_args', 'nns_storefront_recent_products_args' );

/**
 * Change a currency symbol
 */
add_filter( 'woocommerce_currency_symbol', 'change_existing_currency_symbol', 10, 2 );

add_action( 'storefront_footer', 'nns_footer_site_info', 20 );
add_action( 'widgets_init', 'nns_unregister_widget', 11 );
add_action( 'widgets_init', 'nns_register_footer_sidebar', 20 );