<?php

function handle_parent_action() {
	remove_action('woocommerce_after_main_content','storefront_after_content', 10);
	remove_action('homepage', 'storefront_product_categories', 20);
	remove_action('homepage', 'storefront_featured_products', 40);
	remove_action('homepage', 'storefront_popular_products', 50);
	remove_action('homepage', 'storefront_on_sale_products', 60);
	remove_action('homepage', 'storefront_best_selling_products', 70);
	
	remove_action('storefront_header','storefront_header_cart', 60);
	remove_action('storefront_header','storefront_product_search', 40);
	add_action('storefront_header','storefront_product_search', 39);
	
}