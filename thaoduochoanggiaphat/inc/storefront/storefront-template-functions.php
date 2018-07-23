<?php

function handle_parent_action() {
	remove_action('woocommerce_after_main_content','storefront_after_content', 10);
	remove_action( 'woocommerce_after_single_product_summary',    'storefront_single_product_pagination',     30 );
	remove_action('homepage', 'storefront_product_categories', 20);
	remove_action('homepage', 'storefront_featured_products', 40);
	remove_action('homepage', 'storefront_popular_products', 50);
	remove_action('homepage', 'storefront_on_sale_products', 60);
	remove_action('homepage', 'storefront_best_selling_products', 70);
	
	remove_action('storefront_header','storefront_header_cart', 60);
	remove_action('storefront_header','storefront_product_search', 40);
	
	add_action('storefront_header','storefront_product_search', 39);
	
	remove_action( 'storefront_footer', 'storefront_footer_widgets', 10 );
	remove_action( 'storefront_footer', 'storefront_credit', 20 );
	
	add_filter( 'woocommerce_product_tabs', 'remove_woocommerce_product_tabs', 98 );
	
	

}
function remove_woocommerce_product_tabs( $tabs ) {
	unset( $tabs['description'] );
	unset( $tabs['reviews'] );
	unset( $tabs['additional_information'] );
	return $tabs;
}
function remove_parent_action_in_init() {
	remove_action( 'storefront_after_footer', 'storefront_sticky_single_add_to_cart', 999);
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
}
