<?php
function nss_theme_slug_setup() {
	load_child_theme_textdomain( 'nns', get_stylesheet_directory() . '/languages' );
}

if(!function_exists('nns_enqueue_scripts')){
	function nns_enqueue_scripts()
	{
		wp_enqueue_script('child_theme_script_handle', get_stylesheet_directory_uri().'/assets/js/main.js', array('jquery'));
	}
}

function change_existing_currency_symbol( $currency_symbol, $currency ) {
	switch ( $currency ) {
		case 'VND':
			$currency_symbol = 'đ';
			break;
	}
	
	return $currency_symbol;
}

if ( ! function_exists( 'nns_load_parent_stylesheets' ) ) {
	function nns_load_parent_stylesheets() {
		wp_enqueue_style( 'fontawesome', get_stylesheet_directory_uri() . '/assets/vendors/fontawesome/css/all.css' );
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
			$slider_id = get_post_meta( get_the_ID(), 'metaslider_id', true );
			if ( $slider_id ) {
				$short_code = "[metaslider id=" . $slider_id . "]";
				echo do_shortcode( $short_code );
			}
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
		<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" <?php var_dump( 'test' ); ?>>
			<i class="fas fa-shopping-cart nns-icon"></i>
			<span>Giỏ hàng</span>
			<span class="nns-count"><?php echo wp_kses_data( sprintf( WC()->cart->get_cart_contents_count() ) ); ?></span>
		</a>
		<?php
	}
}
if ( ! function_exists( 'nns_footer_site_info' ) ) {
	/**
	 * Display the theme credit
	 *
	 * @since  1.0.0
	 * @return void
	 */
	function nns_footer_site_info() {
		?>
		<div class="footer">
			<div class="footer-column-1">
				<?php
				if ( is_active_sidebar( 'nns-footer-1' ) ) {
					dynamic_sidebar( 'nns-footer-1' );
				}
				?>
			</div>
			<div class="footer-column-2" >
				<?php
				if ( is_active_sidebar( 'nns-footer-2' ) ) {
					dynamic_sidebar( 'nns-footer-2' );
				}
				?>
			</div>
		</div><!-- .site-info -->
		<?php
	}
}

if ( ! function_exists( 'nns_unregister_widget' ) ) {
	function nns_unregister_widget() {
		unregister_sidebar( 'sidebar-1' );
		unregister_sidebar( 'header-1' );
		unregister_sidebar( 'footer-1' );
		unregister_sidebar( 'footer-2' );
		unregister_sidebar( 'footer-3' );
		unregister_sidebar( 'footer-4' );
	}
}
//Register sidebar

if ( ! function_exists( 'nns_register_footer_sidebar' ) ) {
	function nns_register_footer_sidebar() {
		
		$sidebar_args['nns_footer_column_1'] = array(
			'name'          => 'Footer Column 1',
			'id'            => 'nns-footer-1',
			'before_widget' => '<div>',
			'after_widget'  => '</div>',
			'before_title'  => '<span style="display: none;">',
			'after_title'   => '</span>',
			'description'   => '',
		);
		
		$sidebar_args['nns_footer_column_2'] = array(
			'name'          => 'Footer Column 2',
			'id'            => 'nns-footer-2',
			'before_widget' => '<div>',
			'after_widget'  => '</div>',
			'before_title'  => '<span style="display: none;">',
			'after_title'   => '</span>',
			'description'   => '',
		);
		register_sidebar( $sidebar_args['nns_footer_column_1'] );
		register_sidebar( $sidebar_args['nns_footer_column_2'] );
	}
}
if(!function_exists('nns_sticky_single_add_to_cart')){
	function nns_sticky_single_add_to_cart() {
	global $product;
	
	if ( class_exists( 'Storefront_Sticky_Add_to_Cart' ) || true !== get_theme_mod( 'storefront_sticky_add_to_cart' ) ) {
		return;
	}
	
	if ( ! is_product() ) {
		return;
	}
	
	$params = apply_filters( 'storefront_sticky_add_to_cart_params', array(
		'trigger_class' => 'entry-summary'
	) );
	
	wp_localize_script( 'storefront-sticky-add-to-cart', 'storefront_sticky_add_to_cart_params', $params );
	
	wp_enqueue_script( 'storefront-sticky-add-to-cart' );
	?>
	<section class="storefront-sticky-add-to-cart">
		<div class="col-full">
			<div class="storefront-sticky-add-to-cart__content">
		  <?php echo wp_kses_post( woocommerce_get_product_thumbnail() ); ?>
				<div class="storefront-sticky-add-to-cart__content-product-info">
					<span class="storefront-sticky-add-to-cart__content-title"><?php _e( 'Bạn đang xem: ', 'thaoduochoanggiaphat' ); ?> <strong><?php the_title(); ?></strong></span>
					<span class="storefront-sticky-add-to-cart__content-price"><?php echo wp_kses_post( $product->get_price_html() ); ?></span>
			<?php echo wp_kses_post( wc_get_rating_html( $product->get_average_rating() ) ); ?>
				</div>
				<a href="<?php echo esc_url( $product->add_to_cart_url() ); ?>" class="storefront-sticky-add-to-cart__content-button button alt">
			<?php echo esc_attr( $product->add_to_cart_text() ); ?>
				</a>
			</div>
		</div>
	</section><!-- .storefront-sticky-add-to-cart -->
	<?php
}
}

//Widget
// Register and load the widget
function wpb_load_widget() {
	register_widget( 'nns_footer_info_widget' );
}

add_action( 'widgets_init', 'wpb_load_widget' );

// Creating the widget
class nns_footer_info_widget extends WP_Widget {
	
	function __construct() {
		parent::__construct(

// Base ID of your widget
			'nns_footer_info_widget',

// Widget name will appear in UI
			__( 'Footer Information', 'thaoduochoanggiaphat' ),

// Widget description
			array( 'description' => __( 'Display information for footer', 'thaoduochoanggiaphat' ), )
		);
	}

// Creating widget front-end
	
	public function widget( $args, $instance ) {
		$name = apply_filters( 'widget_name', $instance['name'] );
		$address = apply_filters( 'widget_address', $instance['address'] );
		$phone = apply_filters( 'widget_phone', $instance['phone'] );
		$email = apply_filters( 'widget_email', $instance['email'] );

// before and after widget arguments are defined by themes
//		echo $args['before_widget'];
			echo '<div class="footer-info-widget">';
				if ( ! empty( $name ) ) {
					echo  '<p>' . $name . '</p>';
				}
				if ( ! empty( $address ) ) {
					echo  '<p>' . __( 'Address: ', 'nns' ). $address . '</p>';
				}
				if ( ! empty( $phone ) ) {
					echo  '<p>'. __( 'Phone: ' ,'nns') . $phone .'</p>';
				}
				if ( ! empty( $email ) ) {
					echo '<p>' . __( 'Email: ', 'nns' ) . $email . '</p>';
				}
			echo '</div>';

// This is where you run the code and display the output
//		echo $args['after_widget'];
	}

// Widget Backend
	public function form( $instance ) {
		$name = isset( $instance['name'] )? $instance['name']: '';
		$address = isset( $instance['address'] )? $instance['address']: '';
		$phone = isset( $instance['phone'] )? $instance['phone']: '';
		$email= isset( $instance['email'] )? $instance['email']: '';
// Widget admin form
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'name' ); ?>"><?php _e( 'Name:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'name' ); ?>"
			       name="<?php echo $this->get_field_name( 'name' ); ?>" type="text"
			       value="<?php echo esc_attr( $name ); ?>"/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'address' ); ?>"><?php _e( 'Address:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'address' ); ?>"
			       name="<?php echo $this->get_field_name( 'address' ); ?>" type="text"
			       value="<?php echo esc_attr( $address ); ?>"/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'phone' ); ?>"><?php _e( 'Phone number:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'phone' ); ?>"
			       name="<?php echo $this->get_field_name( 'phone' ); ?>" type="text"
			       value="<?php echo esc_attr( $phone ); ?>"/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'email' ); ?>"><?php _e( 'Email:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'email' ); ?>"
			       name="<?php echo $this->get_field_name( 'email' ); ?>" type="text"
			       value="<?php echo esc_attr( $email ); ?>"/>
		</p>
		<?php
	}

// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance          = array();
		$instance['name'] = ( ! empty( $new_instance['name'] ) ) ? strip_tags( $new_instance['name'] ) : '';
		$instance['address'] = ( ! empty( $new_instance['address'] ) ) ? strip_tags( $new_instance['address'] ) : '';
		$instance['phone'] = ( ! empty( $new_instance['phone'] ) ) ? strip_tags( $new_instance['phone'] ) : '';
		$instance['email'] = ( ! empty( $new_instance['email'] ) ) ? strip_tags( $new_instance['email'] ) : '';
		
		return $instance;
	}
} // Class wpb_widget ends here
