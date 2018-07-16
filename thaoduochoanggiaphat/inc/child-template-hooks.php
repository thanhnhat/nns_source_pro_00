<?php
	add_action( 'wp_enqueue_scripts', 'nns_load_parent_stylesheets' );
	add_action( 'storefront_content_top', 'custom_slider_storefront' );
	
	add_action( 'storefront_header', 'nns_storefront_header_cart', 40 );
	
	add_filter('storefront_recent_products_args','nns_storefront_recent_products_args');

	/**
	 * Change a currency symbol
	 */
	add_filter('woocommerce_currency_symbol', 'change_existing_currency_symbol', 10, 2);
	
	function change_existing_currency_symbol( $currency_symbol, $currency ) {
		switch( $currency ) {
			case 'VND':
				$currency_symbol = 'đ';
				break;
		}
		return $currency_symbol;
	}