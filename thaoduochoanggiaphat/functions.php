<?php
	require 'inc/storefront/storefront-template-hooks.php';
	require 'inc/storefront/storefront-template-functions.php';
	
	require 'inc/child-template-hooks.php';
	require 'inc/child-template-functions.php';
	function prefix_category_title( $title ) {
		if ( is_category() ) {
			$title = single_cat_title( '', false );
		}
		return $title;
	}
	add_filter( 'get_the_archive_title', 'prefix_category_title' );





