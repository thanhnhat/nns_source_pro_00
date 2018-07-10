<?php
	add_action( 'wp_enqueue_scripts', 'nns_load_parent_stylesheets' );
	add_action( 'storefront_content_top', 'custom_slider_storefront' );
	add_action( 'storefront_header', 'nns_storefront_header_cart', 60 );
	add_filter('storefront_recent_products_args','nns_storefront_recent_products_args');