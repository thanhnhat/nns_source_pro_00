<?php
function nss_theme_slug_setup() {
	load_child_theme_textdomain( 'nns', get_stylesheet_directory() . '/languages' );
}

if(!function_exists('nns_load_parent_stylesheets')){
	function nns_load_parent_stylesheets(){
		wp_enqueue_style( 'fontawesome', get_stylesheet_directory_uri(). '/assets/vendors/fontawesome/css/all.css' );
	}
}

if ( ! function_exists( 'nns_storefront_recent_products_args' ) ) {
	function nns_storefront_recent_products_args( $args ) {
		$args['limit'] = 12;
		
		return $args;
	}
}

if ( ! function_exists( 'custom_slider_storefront' ) ) {
	function custom_slider_storefront() {
		if ( is_front_page() ) {
			echo do_shortcode( "[metaslider id=48]" );
		} else {
			return;
		}
	}
}
if ( ! function_exists( 'nns_storefront_header_cart' ) ) {
	function nns_storefront_header_cart() {
		if ( storefront_is_woocommerce_activated() ) {
			if ( is_cart() ) {
				$class = 'current-menu-item';
			} else {
				$class = '';
			}
			?>
			<ul id="site-header-cart" class="menu nns-card">
				<li class="<?php echo esc_attr( $class ); ?>">
					<?php nns_storefront_cart_link(); ?>
				</li>
			</ul>
			<?php
		}
	}
}

if ( ! function_exists( 'nns_storefront_cart_link' ) ) {
	/**
	 * Cart Link
	 * Displayed a link to the cart including the number of items present and the cart total
	 *
	 * @return void
	 * @since  1.0.0
	 */
	function nns_storefront_cart_link() {
		?>
		<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" <?php var_dump('test'); ?>>
			<i class="fas fa-shopping-cart nns-icon"></i>
			<span>Giỏ hàng</span>
			<span class="nns-count"><?php echo wp_kses_data( sprintf( WC()->cart->get_cart_contents_count())); ?></span>
		</a>
		<?php
	}
}
